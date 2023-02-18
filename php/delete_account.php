<?php 
    session_start();
    $id = $_SESSION['user']['id'];
    $mysql = new mysqli('localhost','root','','royalrolls2');
    $mysql->query("DELETE FROM `users` WHERE `id` = '$id'");
    $mysql->close();
    unset($_COOKIE['user_enter']);
    setcookie('user_enter', null, -1, '/');
    header("Location: /");
?>