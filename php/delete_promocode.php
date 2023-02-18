<?php
    $id_promocode = $_POST['post_data'];
    $responce = array();
    $mysql = new mysqli('localhost', 'root', '', 'royalrolls2');
    $mysql->query("DELETE FROM `promocodes` WHERE `id` = '$id_promocode'");
    $responce['success'] = '1';
    echo json_encode($responce);
    exit();
?>