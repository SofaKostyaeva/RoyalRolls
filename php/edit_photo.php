<?php 
    session_start();
    $id = $_POST['id'];
    $ras = '';
    $i = 0;
    if(!empty($_FILES['file'])){
        $file = $_FILES['file'];

        $i = strlen($file['name']) - 1;
        for(; $i > 0; $i--)
        {
            if($file['name'][$i] !== '.')
            {
                $ras = $file['name'][$i].$ras;
            }
            else
            {
                break;
            }
        }
    
        $name_file = uniqid().'.'.$ras; 
        //$pathfile = __DIR__ .'/img/'.$name_file;
        $img_path = "../img/" . $name_file;

        if(!move_uploaded_file($file['tmp_name'], $img_path)){
            //ошибка
        }
    }
    $mysql = new mysqli('localhost', 'root', '', 'royalrolls2');
    $result1 = $mysql->query("SELECT `img_path` FROM `menu` WHERE `id` = '$id'");
    $current_img = $result1->fetch_row();
    unlink($current_img[0]);
    $mysql->query("UPDATE `menu` SET `img_path` = '$img_path' WHERE `id` = '$id'");
    
    header("Location: edit_item_menu.php?id=$id");
?>