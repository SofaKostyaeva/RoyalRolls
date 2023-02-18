<?php
    session_start();
    $id = $_POST['id'];
    $name = $_POST['name'];
    $decr = $_POST['decr'];
    $price = $_POST['price'];
    $cat = $_POST['cat'];
    $subcat = $_POST['subcat'];

    if(strlen($name) == 0 || strlen($decr) == 0 || strlen($price) == 0 || strlen($cat) == 0 || strlen($subcat) == 0)
    {
        $_SESSION['error'] = '-';
        header("Location: edit_item_menu.php?id=$id");
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
        $mysql->query("UPDATE `menu` SET `name` = '$name', `decription` = '$decr', `price` = '$price', `id_category` = '$idcat[0]', `id_subcategory` = '$idsubcat[0]' WHERE `id` = '$id'");
    }
    else
    {
        $mysql->query("UPDATE `menu` SET `name` = '$name', `decription` = '$decr', `price` = '$price', `id_category` = '$idcat[0]', `id_subcategory` = NULL WHERE `id` = '$id'");
    }

    header("Location: /edit_item_menu.php?id=$id");

?>