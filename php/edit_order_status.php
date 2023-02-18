<?php 
    $id_status = $_GET['status'];
    $id_order = $_GET['order'];
    $mysql = new mysqli('localhost', 'root', '', 'royalrolls2');
    $mysql->query("UPDATE `orders` SET `id_status` = '$id_status' WHERE `id` = '$id_order'");
    $mysql->close();
    header("Location: /orders.php");
    exit();
?>