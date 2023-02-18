<?php
    session_start();
    $phone = $_POST['phone'];
    $pass = $_POST['pass'];

    unset($_COOKIE['signin_error']);
    setcookie('signin_empty', null, -1, '/signin.php');

    if(strlen($phone) == 0 || strlen($pass) == 0){
        setcookie("signin_error", 1, time() + 60, '/signin.php');
        header("Location: /signin.php");
        exit();
    }

    $mysql = new mysqli('localhost', 'root', '', 'royalrolls2');
    $result = $mysql->query("SELECT * FROM `users` WHERE `phone` = '$phone'");

    $user = $result->fetch_assoc();
    if(empty($user) || count($user) === 0){
        setcookie("signin_error", 2, time() + 60, '/signin.php');
        header("Location: /signin.php");
        exit();
    }
    $hash = $user['password'];
    if(password_verify($pass, $hash)){
        setcookie('user_enter', 1, time() + 3600 * 24 * 30 * 12, '/');
        $_SESSION['user'] = [
            "id" => $user['id'],
            "name" => $user['name'],
            "surname" => $user['surname'],
            "phone" => $user['phone']
        ];
        $mysql->close();
        header("Location: /");
        exit();
    }
    else{
        setcookie("signin_error", 3, time() + 60, '/signin.php');
        header("Location: /signin.php");
        exit();
    }
?>