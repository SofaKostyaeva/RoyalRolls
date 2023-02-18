<?php
session_start();
$count_items_basket = 0;
$mysql = new mysqli('localhost', 'root', '', 'royalrolls2');
$id_current_user = $_SESSION['user']['id'];
$count_basket = $mysql->query("SELECT `count` FROM `basket` WHERE `id_user` = $id_current_user");
while ($row = mysqli_fetch_row($count_basket)) {
    $count_items_basket += $row[0];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="icon" href="/img/roll.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoyalRolls - Контакты</title>
    <link rel="stylesheet" href="/css/contacts_style.css">
</head>

<body>
    <nav>
        <?php if (($_COOKIE['user_enter'] ?? '') == '') : ?>
            <a href="signin.php">
                <p class="signin_profile link">Войти</p>
            </a>
        <?php else : ?>
            <a href="profile.php">
                <p class="signin_profile link">Профиль</p>
            </a>
        <?php endif; ?>
        <a href="foradmin.php">
            <p class="foradmin">A</p>
        </a>
        <?php ?>
        <div class="link_block1">
            <div class="link_subblock1">
                <a href="index.php">
                    <p class="link main">Главная</p>
                </a>
                <a href="menu.php">
                    <p class="link menu">Меню</p>
                </a>
            </div>
        </div>
        <div class="block_logo">
            <h1 class="logo">R<span>O</span>YALR<span>O</span>LLS</h1>
        </div>
        <div class="link_block2">
            <div class="link_subblock2">
                <a href="basket.php">
                    <?php if (($_COOKIE['user_enter'] ?? '') == '') : ?>
                        <p class="link basket">Корзина(0)</p>
                    <?php else : ?>
                        <p class="link basket">Корзина(<?= $count_items_basket ?>)</p>
                    <?php endif; ?>
                </a>
                <a href="contacts.php">
                    <p class="link contacts">Контакты</p>
                </a>
            </div>
        </div>
    </nav>

    <div class="contacts_block">
        <div class="wrapper">
            <div class="headline_block">
                <h1 class="headline">Где нас найти?</h1>
            </div>
            <section class="map">
                <div class="map_container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1121.48247844429!2d49.24544696673056!3d55.79384640000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x415eb21558a6131d%3A0x8b92c0d527534164!2z0YPQuy4g0JDQt9Cw0YLQsCDQkNCx0LHQsNGB0L7QstCwLCA4LCDQmtCw0LfQsNC90YwsINCg0LXRgdC_LiDQotCw0YLQsNGA0YHRgtCw0L0sIDQyMDAyNQ!5e0!3m2!1sru!2sru!4v1651309491406!5m2!1sru!2sru" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </section>
            <div class="contacts2">
                <div class="headline_block2">
                    <h1 class="headline2">Контакты</h1>
                </div>
                <div class="contacts_content">
                    <a href="https://vk.com/royalrollskzn">
                        <div class="vk"></div>
                    </a>
                    <a href="https://www.instagram.com/royal.rolls.kzn/">
                        <div class="inst"></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="wrapper">
            <p class="footer_text1">© Royal Rolls | 2019 - 2022</p>
            <p class="footer_text2">+7 (904) 663-75-07</p>
            <p class="footer_text3">royalrolls.kzn@gmail.com</p>
            <p class="footer_text4">ул. Азата Аббасова, 8</p>
        </div>
    </footer>
</body>

</html>