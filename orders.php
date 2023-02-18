<?php

$mysql = new mysqli('localhost', 'root', '', 'royalrolls2');
$orders = $mysql->query("SELECT * FROM `orders`");
$result = $mysql->query("SELECT * FROM `orders`");
$check_count = $result->fetch_row();
$counter = 0;
$status = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="icon" href="/img/roll.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoyalRolls - Заказы</title>
    <link rel="stylesheet" href="/css/orders_style.css">
</head>

<body>
    <nav>
        <div class="link_block1">
        </div>
        <div class="block_logo">
            <h1 class="logo">R<span>O</span>YALR<span>O</span>LLS</h1>
        </div>
        <div class="link_block2">
        </div>
        <a href="/admin_nav.php"><p class="back">🠔</p></a>
    </nav>
    <div class="orders_content">
        <div class="wrapper">
            <div class="orders_headline_block">
                <h1 class="orders_headline">Заказы</h1>
            </div>
            <div class="orders_list">
                <?php if (empty($check_count) || count($check_count) === 0) : ?>
                <?php else : ?>
                    <?php while($row = mysqli_fetch_row($orders)) : ?>
                        <?php
                            $counter++;           
                            $result = $mysql->query("SELECT * FROM `users` WHERE `id` = '$row[1]'");
                            $client_info = $result->fetch_row();
                        ?>
                        <div class="order_item">
                            <div class="order_info">
                                <p class="delete" id="i<?= $counter ?>">×</p>
                                <p class="ident_hid"><?= $ident_list[$i] ?></p>
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
                                    $status = $row[9];
                                    $result = $mysql->query("SELECT `name` FROM `menu` WHERE `id` = '$row2[2]'");
                                    $menu_name = $result->fetch_row();
                                    ?>
                                    <li><?= $menu_name[0] ?> (x<?=$row2[3]?>)</li>
                                <?php endwhile; ?>
                            </ol>
                            <p class="total_price">ИТОГО: <?= $row[7] ?> Р</p>
                            <?php if($status == 2) : ?>
                                <div class="btn_status_check2">Заказ готовится</div>
                            <?php else: ?>
                                <a href="/php/edit_order_status.php?status=2&order=<?=$row[0]?>"><div class="btn_status">Заказ готовится</div></a>
                            <?php endif; ?>
                            <?php if($status == 3) : ?>
                                <div class="btn_status_check3">Заказ готов</div>
                            <?php else: ?>
                                <a href="/php/edit_order_status.php?status=3&order=<?=$row[0]?>"><div class="btn_status">Заказ готов</div></a>
                            <?php endif; ?>
                            <?php if($status == 4) : ?>
                                <div class="btn_status_check4">Заказ отправлен</div>
                            <?php else: ?>
                                <a href="/php/edit_order_status.php?status=4&order=<?=$row[0]?>"><div class="btn_status">Заказ отправлен</div></a>
                            <?php endif; ?>
                            <?php if($status == 5) : ?>
                                <div class="btn_status_check5">Заказ доставлен</div>
                            <?php else: ?>
                                <a href="/php/edit_order_status.php?status=5&order=<?=$row[0]?>"><div class="btn_status">Заказ доставлен</div></a>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
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
    <script src="/js/orders_script.js"></script>
</body>

</html>