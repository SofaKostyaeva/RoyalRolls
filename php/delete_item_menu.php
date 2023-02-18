<?php 
    $name = $_POST['postData'];
    $response = array();
    $mysql = new mysqli('localhost', 'root', '', 'royalrolls2');
    $result1 = $mysql->query("SELECT `img_path` FROM `menu` WHERE `name` = '$name'");
    $current_img = $result1->fetch_row();
    unlink($current_img[0]);
    $mysql->query("DELETE FROM `menu` WHERE `name` = '$name'");
    $response['success'] = '1';
    echo json_encode($response);
?>