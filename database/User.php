<?php
require_once "connectdb.php";
session_start();
class User extends Connect {

    protected $name;

    protected $date;

    protected $phone;

    protected $email;

    protected $password;

    protected $age;

    protected $role;

    protected $ins_id;

    protected $check;

    protected $check2;

    protected $check_update;

    private $error_valid = false;

    private $error_valid_text = [];

    public function signin($email, $password) {
        $this -> check = mysqli_query($this->connection, "SELECT * FROM `users` WHERE `email` = '$email'");
        if(mysqli_num_rows($this->check) == 1){ 
            $check_2 = mysqli_fetch_assoc($this->check);
            if($password == $check_2["password"]){
                $_SESSION['user_id'] = $check_2["id_user"];
                $_SESSION['role'] = $check_2["role"];
                $_SESSION['auth'] = true;
            } else {
                $_SESSION['message'] = "Неправильный логин или пароль!";
            }
        } else {
            $_SESSION["message"] = "Такого пользователя не существует";
        }
    }

    public function signup($name, $date, $phone, $email, $password, $age) {
        $this -> check = mysqli_query($this->connection, "SELECT * FROM `users` WHERE `email` = '$email'");
        if(mysqli_num_rows($this->check) == 0) {
            return mysqli_query($this->connection, "INSERT INTO `users` (`FIO`, `date_of_birthday`, `phone`, `email`, `password`, `age`) VALUES ('$name', '$date', '$phone', '$email', '$password', $age)");
            $_SESSION["message"] = "Успешно";
        } else {
            $_SESSION["message"] = "Пользователь с таким логином же существует";
        }
    }

    public function update_user($id, $name, $date, $phone, $email, $pass, $age) {
        $query1 = mysqli_fetch_assoc(mysqli_query($this->connection, "SELECT * FROM `users` WHERE `id_user` = '$id'"));

        $query = "UPDATE `users` SET ";
        if ($query1["FIO"] != $name) {
            $query .= " `FIO` = '$name', ";
            $this->check_update = true;
        }
        if ($query1["date_of_birthday"] != $date) {
            $query .= " `date_of_birthday` = '$date', ";
            $this->check_update = true;
        }
        if ($query1["phone"] != $phone) {
            $query .= " `phone` = '$phone', ";
            $this->check_update = true;
        }
        if ($query1["email"] != $email) {
            $query .= " `email` = '$email', ";
            $this->check_update = true;
        }
        if ($query1["password"] != $pass) {
            $query .= " `password` = '$pass', ";
            $this->check_update = true;
        }
        if ($query1["age"] != $age) {
            $query .= " `age` = '$age', ";
            $this->check_update = true;
        }

        if ($this->check_update) {
            $query = substr($query, 0, -2);
            $query .= " WHERE `id_user` = $id";
            $result = mysqli_query($this->connection, $query);
            if ($result) {
                return $_SESSION["message"] = "Данные обновленны";
            }
        } else {
            return $_SESSION["message"] = "Данные актуальны";
        }
    }

    public function add_order($ins_id, $total_price, $validity_period) {
        $this -> check = mysqli_query($this->connection, "SELECT * FROM `order` WHERE `insurance_id` = '$ins_id'");
        $this -> check2 = mysqli_query($this->connection, "SELECT * FROM `insurance` WHERE `insurance_id` = '$ins_id'");
        $query = mysqli_fetch_assoc($this -> check2);
        $price = $query["price"];
        $total_price = $price * $validity_period;
        var_dump($price);
        $date = date('Y-m-d');
        $id_user = $_SESSION['user_id'];
        if(mysqli_num_rows($this->check) == 0) {
            $_SESSION["message"] = "Заказ успешно создан";
            return mysqli_query($this->connection, "INSERT INTO `order`(`insurance_id`, `id_user`, `total_price`, `date_of_order`, `validity_period`) VALUES ('$ins_id','$id_user','$total_price','$date', '$validity_period')");
        } else {
            $_SESSION["message"] = "Данная страховка приобретена другим пользователем!";
        }
    }

    public function insurance() {
        $id_user = $_SESSION['user_id'];
        $query = "SELECT * FROM `order` INNER JOIN `insurance` ON insurance.insurance_id = order.insurance_id WHERE `id_user` = '$id_user'";
        $result = mysqli_fetch_all(mysqli_query($this->connection, $query));
        return $result;
    }
    // public function signup($name, $date, $phone, $email, $password, $age) {
    //     $this -> validate($name, $date, $phone, $email, $password, $age);
    //     if (!$this->error_valid) {
    //         return mysqli_query($this->connection, "INSERT INTO `users` (`FIO`, `date_of_birthday`, `phone`, `email`, `password`, `age`) VALUES ('$name', '$date', '$phone', '$email', '$password', $age)");
    //     }
    //     else {
    //         return ["error_valid" => $this -> error_valid, 
    //         "error_valid_text" => $this -> error_valid_text
    //     ];
    //     }
    // }
    // public function signin($email, $password) {
    //     $this -> validate_signin($email, $password);
    //     if (!$this -> error_valid) {
    //         $user = mysqli_fetch_assoc(mysqli_query($this -> connection, "SELECT * FROM `users` WHERE `email` = '$email'"));
    //         if ($user) {
    //             if($password == $user["password"]) {
    //                 return [
    //                     "id_user" => $user["id_user"],
    //                     "role" => $user["role"],
    //                     "name" => $user["name"]
    //                 ];
    //             }
    //             return [
    //                 "error_valid" => true,
    //                 "error_valid_text" => ["password" => "Неверный пароль"]
    //             ];
    //         }
    //         return [
    //             "error_valid" => true,
    //             "error_valid_text" => ["login" => "Такой пользователь не найден!"]
    //         ];
    //     } return [
    //         "error_valid" => $this -> error_valid,
    //         "error_valid_text" => $this -> error_valid_text
    //     ];
    // }
    // private function validate($name, $email, $password, $phone, $login, $age){
    //     $this->checkEmpty($name, 'name', 'Введите ФИО');
    //     $this->checkEmpty($email, 'email', 'Введите email');
    //     $this->checkEmpty($password, 'password', 'Введите пароль');
    //     $this->checkEmpty($phone, 'phone', 'Введите телефон');
    //     $this->checkEmpty($login, 'login', 'Введите логин');
    //     $this->checkEmpty($age, 'age', 'Введите возраст');
        
    //     if (!empty($phone) && strlen($phone) != 11) {
    //         $this->error_valid = true;
    //         $this->error_valid_text["phone"] = 'Введите корректный телефон';
    //     }
    // }
    // private function validate_signin($email) {
    //     $this -> checkEmpty($email, 'login', 'Введите логин');
    //     $this -> checkEmpty($email, 'password', 'Введите пароль');
    // }

    // private function checkEmpty($value, $field, $message) {
    //     if (empty($value)) {
    //         $this->error_valid = true;
    //         $this->error_valid_text[$field] = $message;
    //     }
    // }
}
?>