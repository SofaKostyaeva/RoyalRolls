<?php 
    $ident = $_POST['postData'];
    $response = array();
    $mysql = new mysqli('localhost', 'root', '', 'royalrolls2');
    $mysql->query("DELETE FROM `orders` WHERE `ident` = '$ident'");
    $response['success'] = '1';
    echo json_encode($response); 
?>