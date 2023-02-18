<?php 
    $name = $_POST['postData'];
    $response = array();
    $mysql = new mysqli('localhost', 'root', '', 'royalrolls2');
    $result = $mysql->query("SELECT `name`, `decription`, `price`, `id_category`, `id_subcategory` FROM `menu` WHERE `name` = '$name'");
    $menu = $result->fetch_row();
    $Mname = $menu[0];
    $Mdect = $menu[1];
    $Mprice = $menu[2];
    $result1 = $mysql->query("SELECT `name` FROM `categories` WHERE `id` = '$menu[3]'");
    $result2 = $mysql->query("SELECT `name` FROM `subcategories` WHERE `id` = '$menu[4]'");
    $cat = $result1->fetch_row();
    $subcat = $result2->fetch_row();
    $Mcat = $cat[0];
    if($subcat[0] == null)
    {
        $Msubcat = "NULL";
    }
    else
    {
        $Msubcat = $subcat[0];
    }
    include('/edit_item_menu.php');
    $response['success'] = '1';
    echo json_encode($response);
?>