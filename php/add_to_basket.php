<?php 
    session_start();
    $name = $_POST['sourceData'];
    $id = $_SESSION['user']['id'];
    $response = array();
    $mysql = new mysqli('localhost', 'root', '', 'royalrolls2');
    $result = $mysql->query("SELECT `id` FROM `menu` WHERE `name` = '$name'");
    $result1 = $result->fetch_row();
    $idMenu = $result1[0];
    $result2 = $mysql->query("SELECT * FROM `basket` WHERE `id_menu` = '$idMenu' && `id_user` = '$id'");
    $count_same = $result2->fetch_assoc();
    if (empty($count_same) || count($count_same) === 0) {
        $mysql->query("INSERT INTO `basket` (`id_menu`, `id_user`, `count`) VALUES ('$idMenu', '$id', 1)");
    }
    else
    {
        $result3 = $mysql->query("SELECT `count` FROM `basket` WHERE `id_menu` = '$idMenu' && `id_user` = '$id'");
        $new_count_db = $result3->fetch_row();
        $new_count = $new_count_db[0] + 1;
        $mysql->query("UPDATE `basket` SET `count` = '$new_count' WHERE `id_menu` = '$idMenu' && `id_user` = '$id'");
    }
    $response['success'] = '1';
    echo json_encode($response);
?>