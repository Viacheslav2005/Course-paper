<?php
include "../Course/includes/nav_user.php";
require_once "database/Query.php";

$cat = new Query();

$user = $cat -> categories();

$news = $cat -> news();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/design/css/reset.css">
    <link rel="stylesheet" href="/design/css/catalog.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel = "stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <p class="text1">Каталог категорий страхования</p>
    <div class="category">
        <!-- <div class="category_up">
            <div class="category_up_text">
                <div>
                    <p class="category_up_text1">Автомобили</p>
                    <p class="category_up_text2">Осаго, Каско</p>
                </div>
                <button onclick="document.location='/avto_cat.php'">Подробнее</button>
            </div>
            <div>
                <img src="/design/img/2019-Dodge-Challenger-PNG-HD-Isolated 1.png" alt="">
            </div>
        </div> -->
        <div class="category_down">
            <!-- <div class="property">
                <div class="property_text">
                    <div>
                        <p class="property_text1">Имущество</p>
                        <p class="property_text2">Страхование квартиры, страхование перед соседями</p>
                    </div>
                    <button onclick="document.location='/property.php'">Подробнее</button>
                </div>
                <div>
                    <img src="/design/img/House.png" alt="">
                </div>
            </div>
            <div class="health">
                <div class="health_text">
                    <div>
                        <p class="health_text1">Здоровье</p>
                        <p class="health_text2">Спортивная страховка, страховка вождения</p>
                    </div>
                    <button onclick="document.location='/health.php'">Подробнее</button>
                </div>
                <div>
                    <img src="/design/img/Emergency.png" alt="">
                </div>
            </div> -->
            <?php foreach($user as $item) { ?>
                <div class="cards">
                    <div class="cards_text">
                        <div>
                            <p class="cards_text1"><?=$item[1]?></p>
                            <p class="cards_text2"></p>
                        </div>
                        <a href="/<?=$item[3]?>?id=<?=$item[0]?>">Подробнее</a>
                        <!-- <button onclick="document.location='/<?=$item[3]?>'" value = "<?=$item[0]?>">Подробнее</button> -->
                    </div>
                    <div>
                        <img src="/design/img/<?=$item[2]?>" alt="">
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="news"> <!-- Сделать через foreach-->
        <p class="news_text">Последние новости</p>
        <div class="news_cards1">
            <?php foreach($news as $item) { ?>
                <div class="news_card">
                    <div>
                        <img src="/design/img/<?=$item[3]?>" alt="" class="news_card_img">
                        <p><?=$item[1]?></p>
                        <p><img src="/design/img/calendar.png" alt=""><?=$item[2]?></p>
                    </div>
                </div>
            <?php } ?>
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