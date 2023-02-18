<?php
session_start();
$id = $_SESSION['user']['id'];
$address = $_POST['address'];
$comment = $_POST['comment'];
$promocode = $_POST['promocode'];
$delivery_type = $_POST['delivery_type'];
$count_person = $_POST['count_person'];
$type_order = $_POST['type_order'];
$ident = time();
$promocode_flag = false;
$promocode_discount = 0;


if($id == 0){
    $_SESSION['error'] = '---';
    header("Location: /basket.php");
    exit();
}

if (strlen($address) == 0 || strlen($count_person) == 0 || strlen($comment) == 0) {
    $_SESSION['error'] = '-';
    header("Location: /basket.php");
    exit();
}
$mysql = new mysqli('localhost', 'root', '', 'royalrolls2');
$check = $mysql->query("SELECT * FROM `basket` WHERE `id_user` = '$id'");
$check_basket = $check->fetch_row();
if (empty($check_basket) || count($check_basket) === 0) {
    $_SESSION['error'] = '--';
    header("Location: /basket.php");
    exit();
}
if (strlen($promocode) > 0) {
    $id_current_promocode = 0;
    $promocodes = $mysql->query("SELECT * FROM `promocodes`");
    while ($row = mysqli_fetch_row($promocodes)) {
        if (password_verify($promocode, $row[1])) {
            $id_current_promocode = $row[0];
            $promocode_discount = $row[2];
        }
    }
    if ($id_current_promocode == 0) {
        $_SESSION['error'] = '----';
        header("Location: /basket.php");
        exit();
    }

    $result3 = $mysql->query("SELECT * FROM `users_promocodes` WHERE `id_user` = '$id' AND `id_promocode` = '$id_current_promocode'");
    $check_promocode_use = $result3->fetch_row();
    if (empty($check_promocode_use) || count($check_promocode_use) === 0) {
        $promocode_flag = true;
        $mysql->query("INSERT INTO `users_promocodes` (`id_user`, `id_promocode`) VALUES ('$id', '$id_current_promocode')");
    } else {
        $_SESSION['error'] = '-----';
        header("Location: /basket.php");
        exit();
    }
}
$total_price = 0;
$all_basket_items = $mysql->query("SELECT `id_menu`, `count` FROM `basket` WHERE `id_user` = '$id'");
while ($row = mysqli_fetch_row($all_basket_items)) {
    $menu_id = $row[0];
    $count_item = $row[1];
    $result = $mysql->query("SELECT `name`, `decription`, `price`, `img_path` FROM `menu` WHERE `id` = '$menu_id'");
    $menu_item = $result->fetch_row();
    if ($count_item == 1) {
        $price = $menu_item[2];
    } else {
        $price = $menu_item[2] * $count_item;
    }
    $total_price += $price;
}
if($promocode_flag){
    $total_price = $total_price - ($promocode_discount / 100 * $total_price);
}
$mysql->query("INSERT INTO `orders` (`id_user`, `ident`, `address`, `count_tools`, `type_order`, `delivery_type`, `total_price`, `comment`, `id_status`) 
               VALUES ('$id', '$ident', '$address', '$count_person', '$type_order', '$delivery_type', '$total_price', '$comment', 1)");

$all_basket_items = $mysql->query("SELECT `id_menu`, `count` FROM `basket` WHERE `id_user` = '$id'");
$result2 = $mysql->query("SELECT `id` FROM `orders` WHERE `ident` = '$ident'");
$iid = $result2->fetch_row();
$id_current_order = $iid[0];
while ($row = mysqli_fetch_row($all_basket_items)) {
    $id_menu = $row[0];
    $count_item = $row[1];
    $mysql->query("INSERT INTO `orders_products` (`id_order`, `id_menu`, `count`) VALUES ('$id_current_order', '$id_menu', '$count_item')");
}
$mysql->query("DELETE FROM `basket` WHERE `id_user` = '$id'");
$_SESSION['success'] = '+';
$mysql->close();
header("Location: /basket.php");
