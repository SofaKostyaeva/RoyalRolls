<?php
    session_start();
    $_SESSION['user']['id'] = 0;
    unset($_COOKIE['user_enter']);
    setcookie('user_enter', null, -1, '/');
    header("Location: /");
?>