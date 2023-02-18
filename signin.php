<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="/img/roll.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoyalRolls - Авторизация</title>
    <link rel="stylesheet" href="/css/signin_style.css">
</head>
<body>
    <?php if((($_COOKIE['signin_error'] ?? '') == '1')) : ?>
        <script>alert("Вы не ввели номер телефона или пароль");</script>
        <?php unset($_COOKIE['signin_error']); setcookie('signin_error', null, -1, '/signin.php') ?>
    <?php endif; ?>

    <?php if((($_COOKIE['signin_error'] ?? '') == '2')) : ?>
        <script>alert("Пользователь с таким номером телефона не найден");</script>
        <?php unset($_COOKIE['signin_error']); setcookie('signin_error', null, -1, '/signin.php') ?>
    <?php endif; ?>

    <?php if((($_COOKIE['signin_error'] ?? '') == '3')) : ?>
        <script>alert("Неправильный пароль");</script>
        <?php unset($_COOKIE['signin_error']); setcookie('signin_error', null, -1, '/signin.php') ?>
    <?php endif; ?>

    <a href="/index.php"><p class="back">🠔</p></a>
    <main role="main" class="wrapper">
        <div class="headline_block">
            <h1 class="headline">Вход в аккаунт</h1>
        </div>
        <div class="signin_block">
            <form method="POST" action="/php/signin.php">
            <label class="text_label">Номер телефона</label>
                </br><input type="number" name="phone" class="text_field1">
                </br><label class="text_label">Пароль</label>
                </br><input type="password" name="pass" class="text_field2">
                </br><button type="submit" class="btn_signin">Войти</button>
            </form>
        </div>
        <p class="no_account">Нет аккаунта? - <a href="/signup.php">Регистрация</a></p>
    </main>
</body>
</html>