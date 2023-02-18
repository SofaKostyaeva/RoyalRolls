<?php

    session_start();
    $name = $_POST['name'];
    $decr = $_POST['decr'];
    $price = $_POST['price'];
    $cat = $_POST['cat'];
    $subcat = $_POST['subcat'];
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


    if(strlen($name) == 0 || strlen($decr) == 0 || strlen($price) == 0 || strlen($cat) == 0 || strlen($subcat) == 0)
    {
        $_SESSION['error'] = '-';
        header("Location: /add_item_menu.php");
        exit();
    }



    $mysql = new mysqli('localhost', 'root', '', 'royalrolls2');

    $result1 = $mysql->query("SELECT `id` FROM `categories` WHERE `name` = '$cat'");
    $idcat = $result1->fetch_row();

    if($subcat != "none")
    {
        $result2 = $mysql->query("SELECT `id` FROM `subcategories` WHERE `name` = '$subcat'");
        $idsubcat = $result2->fetch_row();
    }

    if($subcat != "none")
    {
        $mysql->query("INSERT INTO `menu` (`name`, `decription`, `price`, `id_category`, `id_subcategory`, `img_path`) VALUES ('$name', '$decr', '$price', '$idcat[0]', '$idsubcat[0]', '$img_path')");
    }
    else
    {
        $mysql->query("INSERT INTO `menu` (`name`, `decription`, `price`, `id_category`, `id_subcategory`, `img_path`) VALUES ('$name', '$decr', '$price', '$idcat[0]', NULL, '$img_path')");
    }
    $_SESSION['success'] = '+';
    header("Location: /add_item_menu.php");
