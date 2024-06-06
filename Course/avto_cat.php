<?php
include "../Course/includes/nav_user.php"; 

require_once "database/Query.php";

$cover = new Query();

$coverage = $cover -> coverage($_GET["id"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/design/css/reset.css">
    <link rel="stylesheet" href="/design/css/avto_cat.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel = "stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <!-- <div class="category">
        <div class="category_up">
            <div class="category_up_text">
                <div class="category_up_text_div">
                    <p class="category_up_text1">ОСАГО</p>
                    <p class="category_up_text2">Рассчитайте стоимость полиса ОСАГО с помощью удобного калькулятора.</p>
                </div>
                <button onclick="document.location='/avto_cat.php'">Рассчитать стоимость</button>
            </div>
            <div>
                <img src="/design/img/Corvette-Car-PNG-Transparent 1.png" alt="">
            </div>
        </div>
        <div class="category_up">
            <div class="category_up_text">
                <div class="category_up_text_div">
                    <p class="category_up_text1">КАСКО</p>
                    <p class="category_up_text2">Вы можете рассчитать стоимость вашего полиса КАСКО и оформить заявку на страхование онлайн.</p>
                </div>
                <button onclick="document.location='/avto_cat.php'">Рассчитать стоимость</button>
            </div>
            <div>
                <img src="/design/img/Corvette-Car-PNG-Transparent 1.png" alt="">
            </div>
        </div>
    </div> -->
    <!-- <div class="catalog">
        <?php foreach($coverage as $item) {?>
            <div class="catalog_div1">
                <p><?=$item[1]?></p>
                <button onclick="document.location='/property_apartment.php'">Подробнее</button>
            </div>
        <div class="catalog_div1">
            <p>Ответственность перед соседями</p>
            <button onclick="document.location='/property_fire.php'">Подробнее</button>
        </div>
        <?php } ?>
    </div> -->
    <div class="question">
        <p class="question_text">Зачем необходимо страховать автомобиль?</p>
        <div class="question_div">
            <img src="/design/img/image 7.png" alt="">
            <div class="question_div_text">
                <p>Безопасность на дороге </p>
                <span>Независимо от вашего опыта вождения и уверенности  в своих навыках, нельзя быть полностью защищенным от возможных аварийных ситуаций.  Потому что ДТП могут быть вызваны другими водителями и пешеходами, плохими погодными условиями, плохим состоянием дороги и  другими факторами, на которые вы не  имеете контроля.</span>
            </div>
        </div>
    </div>
    <div class="card_div">
        <?php foreach($coverage as $item) {?>
            <form action="/user/add_order.php" method="POST">
                <div class="div_programms">
                    <div class="div_programms_div1">
                        <input type="hidden" name="id" value = "<?=$item[0]?>">
                        <p><input readonly type="text" name="name" id="" value="<?=$item[1]?>"></p>
                            <div class="valid_period">
                                <span><input type="text" readonly name="price" id="" value="<?=$item[2]?>">₽</span>/ <input readonly type="text" name="" id="" value = "<?=$item[6]?>"> месяцев
                            </div>
                        <p>Страховая сумма</p>
                        <span><?=$item[3]?>₽</span>
                    </div>
                    <div class="div_descrs3">
                            <!-- <p><input readonly type="text" name="descr" id="" value = "<?=$item[5]?>"></p> -->
                            <textarea name="descr" id="" value = "<?=$item[5]?>" rows="5" cols="28"><?=$item[5]?></textarea>
                        </div>
                    <?php if(isset($_SESSION['auth'])) {?>
                        <button type = "submit">Купить</button>
                    <?php } else { ?>
                    <?php } ?>
                </div>
            </form>
        <?php } ?>
    </div>
    <div class="difference">
        <p class="difference_text1">В чем отличие ОСАГО и КАСКО?</p>
        <div class="difference_div">
            <div class="difference_div1">
                <img src="/design/img/OSAGO.png" alt="">
                <p class="difference_text2">Аббревиатура ОСАГО расшифровывается как Обязательное Страхование Автогражданской Ответственности. То есть это не страховка самой машины, а защита на случай, если водитель стал виновником аварии и повредил чужое имущество или есть пострадавшие: тогда страховая компания возместит ущерб.</p>
            </div>
            <div class="difference_div1">
                <img src="/design/img/KASKO.png" alt="">
                <p class="difference_text2">Каско — страховой продукт, предназначенный для защиты застрахованного автомобиля на случай ущерба или хищения. В отличие от ОСАГО, каско не обязательный, а добровольный вид страхования.</p>
            </div>
        </div>
    </div>
    <!-- <footer class="footer1">
        <div class="footer_div1">
            <a href="">Главная</a>
            <a href="">О нас</a>
            <a href="">Офисы</a>
            <a href="">Новости</a>
            <a href="">Спецпредложения</a>
        </div>
        <div class="footer_div2">
            <p>450000, г. Уфа, <br> ул. Кирова, д. 65/1</p>
            <p>График работы главного<br> офиса 450000, г. Уфа, <br>
                ул. Кирова, д. 65/1 <br>
                Пн. - Чт. с 9:00 до 18:00 <br>
                Пт.  с 9:00 до 16:45  <br>
                Сб-Вс выходной
            </p>
        </div>
        <div class="footer_div3">
            <p class="footer_div3_text2">Адрес для почтовых отправлений: <br>450000, г. Уфа</p>
            <p class="footer_div3_text">тел.: +7 (999) 888 77 66</p>
            <p class="footer_div3_text2">Email для связи с нами yandex@mail.ru</p>
            <div class="footer_div3_icon">
                <a href=""><img src="/design/img/vk.png" alt=""></a>
                <a href=""><img src="/design/img/telegramm.png" alt=""></a>
            </div>
        </div>    
    </footer> -->
    <?php require_once "footer.php";?>

</body>
</html>