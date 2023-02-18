<?php

    $password = $_POST['password'];

    if($password == "5469")
    {
        setcookie('admin', '1', time() + 365 * 12 * 24 * 360, "/");
        header("Location: /admin_nav.php");
    }
?>