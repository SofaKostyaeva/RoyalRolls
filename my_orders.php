<?php 
    session_start();
    $id = $_SESSION['user']['id'];
    $mysql = new mysqli('localhost', 'root', '', 'royalrolls2');
    $myorders = $mysql->query("SELECT * FROM `orders` WHERE `id_user` = '$id'");
    $count_items_basket = 0;
    $count_basket = $mysql->query("SELECT `count` FROM `basket` WHERE `id_user` = $id");
    while ($row = mysqli_fetch_row($count_basket)) {
        $count_items_basket += $row[0];
    }
    $result = $mysql->query("SELECT * FROM `orders` WHERE `id_user` = '$id'");
    $check_count = $result->fetch_row();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="/img/roll.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoyalRolls - Мои заказы</title>
    <link rel="stylesheet" href="/css/my_orders_style.css">
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
    <main role="my_orders" class="my_orders_block">
        <div class="wrapper">
            <div class="headline_block">
                <h1 class="headline">
                    Мои заказы
                </h1>
            </div>
            <div class="orders_list">
                <?php if (empty($check_count) || count($check_count) === 0) : ?>
                <?php else : ?>
                    <?php while($row = mysqli_fetch_row($myorders)): ?>
                        <?php
                        $result = $mysql->query("SELECT * FROM `users` WHERE `id` = '$row[1]'");
                        $client_info = $result->fetch_row();
                        ?>
                        <div class="order_item">
                            <div class="order_info">
                                <p class="fi"><?= $client_info[1] ?> <?= $client_info[2] ?></p>
                                <p class="address"><?= $row[3] ?></p>
                                <p class="phone"><?= $client_info[3] ?></p>
                                <p class="count_person">Кол-во персон: <?= $row[4] ?></p>
                                <p class="buy_tipe">Оплата: <?= $row[5] ?></p>
                                <p class="delivery_type">Тип доставки: <?= $row[6]?></p>
                                <p class="comment_order">Комментарий к заказу: <?= $row[8]?></p>
                            </div>
                            <ol>
                                <?php $orders_products = $mysql->query("SELECT * FROM `orders_products` WHERE `id_order` = '$row[0]'"); ?>
                                <?php while ($row2 = mysqli_fetch_row($orders_products)) : ?>
                                    <?php
                                    $result = $mysql->query("SELECT `name` FROM `menu` WHERE `id` = '$row2[2]'");
                                    $product_name = $result->fetch_row();
                                    ?>
                                    <li><?= $product_name[0] ?> (x<?=$row2[3]?>)</li>
                                <?php endwhile; ?>
                            </ol>
                            <p class="total_price">ИТОГО: <?= $row[7] ?> Р</p>
                            <a href="/php/show_order_status.php?id_order=<?=$row[0]?>"><div class="btn_status">Узнать статус заказа</div></a>
                            <?php if(!(($_COOKIE['order_status'] ?? '') == '')): ?>
                                <?php  
                                echo "<script>alert(\"Статус заказа: ".$_COOKIE['order_status']."\");</script>";
                                    unset($_COOKIE['order_status']);
                                    setcookie('order_status', null, -1, '/my_orders.php');
                                ?>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
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