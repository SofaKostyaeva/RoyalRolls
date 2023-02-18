<?php 
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];
    $pass = $_POST['pass'];
    $pass_again = $_POST['pass_again'];

    unset($_COOKIE['signin_error']);
    setcookie('signin_empty', null, -1, '/signin.php');

    if(strlen($name) == 0 || strlen($surname) == 0 || 
    strlen($phone) == 0 || strlen($pass) == 0 || 
    strlen($pass_again) == 0){
        setcookie('signup_error', 1, time() + 60, '/signup.php');
        header("Location: /signup.php");
        exit();
    }

    for($i = 0; $i < strlen($name); $i++){
        if($name[$i] == '0' || $name[$i] == '1' || $name[$i] == '2' || $name[$i] == '3' || $name[$i] == '4' || $name[$i] == '5' ||
        $name[$i] == '6' || $name[$i] == '7' || $name[$i] == '8' || $name[$i] == '9'){
            setcookie('signup_error', 5, time() + 60, '/signup.php');
            header("Location: /signup.php");
            exit();
        }
    }

    for($i = 0; $i < strlen($surname); $i++){
        if($surname[$i] == '0' || $surname[$i] == '1' || $surname[$i] == '2' || $surname[$i] == '3' || $surname[$i] == '4' || $surname[$i] == '5' ||
        $surname[$i] == '6' || $surname[$i] == '7' || $surname[$i] == '8' || $surname[$i] == '9'){
            setcookie('signup_error', 5, time() + 60, '/signup.php');
            header("Location: /signup.php");
            exit();
        }
    }

    if(strlen($phone) != 11){
        setcookie('signup_error', 2, time() + 60, '/signup.php');
        header("Location: /signup.php");
        exit();
    }

    if($phone[0] != '8' || $phone[1] != '9'){
        setcookie('signup_error', 2, time() + 60, '/signup.php');
        header("Location: /signup.php");
        exit();
    }

    if($pass != $pass_again){
        setcookie('signup_error', 3, time() + 60, '/signup.php');
        header("Location: /signup.php");
        exit();
    }


    $options = [
        'cost' => 12,
    ];
    $pass = password_hash($pass, PASSWORD_BCRYPT, $options);

    $mysql = new mysqli('localhost', 'root', '', 'royalrolls2');
    $result = $mysql->query("SELECT * FROM `users` WHERE `phone` = '$phone'");
    $checkphone = $result->fetch_assoc();
    if(is_countable($checkphone) && count($checkphone) != 0){
        setcookie('signup_error', 4, time() + 60, '/signup.php');
        header("Location: /signup.php");
        exit();
    }

    $mysql->query("INSERT INTO `users` (`name`, `surname`, `phone`, `password`) 
    VALUES ('$name', '$surname', '$phone', '$pass')");
    $mysql->close();
    header("Location: /signin.php");
    exit();
?>