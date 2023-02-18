<?php
session_start();
$_SESSION['error'] = '+';
$_SESSION['success'] = '-';
if (($_COOKIE['user_enter'] ?? '') == ''){
    $_SESSION['user'] = [
        "id" => 0,
        "name" => "",
        "surname" => "",
        "phone" => ""
    ];
}
else{
    if(isset($_SESSION['user'])) { 
    }
    else{
        unset($_COOKIE['user_enter']);
        setcookie('user_enter', null, -1, '/');
        header("Refresh:0");
    }
}
$mysql = new mysqli('localhost', 'root', '', 'royalrolls2');
$menu = $mysql->query("SELECT `name`, `decription`, `price`, `img_path` FROM `menu`");
$count_items_basket = 0;
$id_current_user = $_SESSION['user']['id'];
$count_basket = $mysql->query("SELECT `count` FROM `basket` WHERE `id_user` = $id_current_user");
while ($row = mysqli_fetch_row($count_basket)) {
    $count_items_basket += $row[0];
}
$counter = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="icon" href="/img/roll.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoyalRolls - Главная</title>
    <link rel="stylesheet" href="/css/index_style.css">
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
    <header>
        <div class="hat">
            <div class="wrapper">
                <div class="arc"></div>
                <div class="arc2"></div>
                <div class="hat_headline_block">
                    <h1 class="hat_headline">RoyalRolls</h1>
                </div>
                <div class="hat_text_block">
                    <p class="hat_text">Когда хочется чего-нибудь вкусненького :)</p>
                </div>
                <div class="hat_headline_block2">
                    <h1 class="hat_headline2">Вы можете попробовать:</h1>
                </div>
                <div class="hat_text_block2">
                    <p class="hat_text2">Огненный Том Ям <br> Нежнейшие суши и роллы <br> Ароматная пицца</p>
                </div>
            </div>
        </div>
    </header>
    <div class="menu_block">
        <div class="wrapper">
            <div class="menu_headline_block">
                <h1 class="menu_headline">Меню (популярное)</h1>
            </div>
            <div class="menu_list_block">
                <?php while ($row = mysqli_fetch_row($menu)) : ?>
                    <?php $counter++;
                    if ($counter == 9) {
                        break;
                    }
                    ?>
                    <div class="menu_item">
                        <div style="background-image: url(<?= $row[3] ?>);" class="menu_img_block"></div>
                        <div class="menu_info_block">
                            <p class="menu_name"><?= $row[0] ?></p>
                            <p class="menu_desc">Состав: <?= $row[1] ?></p>
                            <label class="menu_price"><?= $row[2] ?> Р</label>
                            <?php if (($_COOKIE['user_enter'] ?? '') == '') : ?>
                                <div class="btn_error">
                                    <p class="btn_buy_text">Добавить</p>
                                </div>
                            <?php else : ?>
                                <div class="btn_buy" id="i<?= $counter ?>">
                                    <p class="btn_buy_text">Добавить</p>
                                </div>
                            <?php endif; ?>
                            <p class="none"><?= $row[0] ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="menu_link_block">
                <a href="menu.php">
                    <p class="menu_link">Посмотреть все меню</p>
                </a>
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
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="/js/index_script.js"></script>
</body>

</html>