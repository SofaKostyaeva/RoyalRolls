<?php 
    session_start();
    $id = $_SESSION['user']['id'];
    $promocode = $_POST['sourceData'];
    $response = array();
    $promocode_flag = false;
    $error1 = false;
    $error2 = false;
    $promocode_discount = 0;
    $id_current_promocode = 0;
    $total_price = 0;
    $price = 0;
    $mysql = new mysqli('localhost', 'root', '', 'royalrolls2');
    if (strlen($promocode) > 0) {        
        $promocodes = $mysql->query("SELECT * FROM `promocodes`");
        while ($row = mysqli_fetch_row($promocodes)) {
            if (password_verify($promocode, $row[1])) {
                $id_current_promocode = $row[0];
                $promocode_discount = $row[2];
            }
        }
        if ($id_current_promocode == 0) {
            $error1 = true;
        }
    
        $result = $mysql->query("SELECT * FROM `users_promocodes` WHERE `id_user` = '$id' AND `id_promocode` = '$id_current_promocode'");
        $check_promocode_use = $result->fetch_row();
        if (empty($check_promocode_use) || count($check_promocode_use) === 0) {
            $promocode_flag = true;
        } else {
            $error2 = true;
        }
        $all_basket_items = $mysql->query("SELECT `id_menu`, `count` FROM `basket` WHERE `id_user` = '$id'");
        while ($row = mysqli_fetch_row($all_basket_items)) {
            $menu_id = $row[0];
            $count_item = $row[1];
            $result2 = $mysql->query("SELECT `name`, `decription`, `price`, `img_path` FROM `menu` WHERE `id` = '$menu_id'");
            $menu_item = $result2->fetch_row();
            if ($count_item == 1) {
                $price = $menu_item[2];
            } else {
                $price = $menu_item[2] * $count_item;
            }
            $total_price += $price;
        }
        if($error1){
            $response['success'] = '1';
            echo json_encode($response);
            exit();
        }
        if($error2){
            $response['success'] = '2';
            echo json_encode($response);
            exit();
        }
        if ($promocode_flag) {
            $total_price = $total_price - ($promocode_discount / 100 * $total_price);
            $response['success'] = $total_price;
            echo json_encode($response);
        }
    }
?>
