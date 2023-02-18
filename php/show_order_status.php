<?php 
    $id_order = $_GET['id_order'];
    $mysql = new mysqli('localhost', 'root', '', 'royalrolls2');
    $result = $mysql->query("SELECT `id_status` FROM `orders` WHERE `id` = '$id_order'");
    $id_status = $result->fetch_row();
    $result2 = $mysql->query("SELECT `status` FROM `order_status` WHERE `id` = '$id_status[0]'");
    $status = $result2->fetch_row();
    $name_of_status = $status[0];
    setcookie('order_status', $name_of_status, time() + 1000, '/my_orders.php');
    header("Location: /my_orders.php");
    exit();
?>