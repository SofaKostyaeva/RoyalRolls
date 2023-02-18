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
    <title>RoyalRolls - Профиль</title>
    <link rel="stylesheet" href="/css/profile_style.css">
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
    <main role="main" class="profile_block">
        <div class="wrapper">
            <div class="headline_block">
                <h1 class="headline">Профиль</h1>
            </div>
            <div class="profile_information">
                <p class="name_surname"><?= $_SESSION['user']['name'] ?> <?= $_SESSION['user']['surname'] ?></p>
                <div class="profie_photo"></div>
                <p class="phone"><?= $_SESSION['user']['phone'] ?></p>
                <a href="/php/exit.php">
                    <div class="btn_exit">
                        <p class="btn_text">Выйти</p>
                    </div>
                </a>
                <a href="/php/delete_account.php">
                    <div class="btn_delete_account">
                        <p class="btn_text">Удалить аккаунт</p>
                    </div>
                </a>
            </div>
        </div>
    </main>
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