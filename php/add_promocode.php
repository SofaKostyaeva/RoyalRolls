<?php
    session_start();
    $name_promocode = $_POST['name'];
    $code_promocode = $_POST['code'];
    $discount_promocode = $_POST['discount'];
    if(strlen($name_promocode) === 0 || 
    strlen($code_promocode) === 0 || 
    strlen($discount_promocode) === 0){
        $_SESSION['error'] = '_';
        header("Location: /promocodes.php");
        exit();
    }
    if($discount_promocode > 100 || $discount_promocode < 1){
        $_SESSION['error'] = '__';
        header("Location: /promocodes.php");
        exit();
    }
    $mysql = new mysqli('localhost', 'root', '', 'royalrolls2');
    $options = [
        'cost' => 12,
    ];
    $code_promocode_hash = password_hash($code_promocode, PASSWORD_BCRYPT, $options);
    $mysql->query("INSERT INTO `promocodes` (`code`, `discount`, `name`) VALUES ('$code_promocode_hash', '$discount_promocode', '$name_promocode')");
    header("Location: /promocodes.php");
    exit();
?>