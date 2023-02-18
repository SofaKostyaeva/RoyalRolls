<?php 
    session_start();
    $id = $_SESSION['user']['id'];
    $idBasket = $_POST['sourceData'];
    $response = array();
    $mysql = new mysqli('localhost', 'root', '', 'royalrolls2');
    $result = $mysql->query("SELECT `count` FROM `basket` WHERE `id` = '$idBasket' && `id_user` = '$id'");
    $count_item = $result->fetch_row();
    $new_count = $count_item[0] - 1;
    if($new_count != 0){
        $mysql->query("UPDATE `basket` SET `count` = '$new_count' WHERE `id` = '$idBasket' && `id_user` = '$id'");
    }
    else{
        $mysql->query("DELETE FROM `basket` WHERE `id` = '$idBasket' && `id_user` = '$id'");
    }
    $response['success'] = '1';
    echo json_encode($response);
?>