<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="/img/roll.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoyalRolls - Регистрация</title>
    <link rel="stylesheet" href="/css/signup_style.css">
</head>
<body>
    <?php if((($_COOKIE['signup_error'] ?? '') == '1')) : ?>
        <script>alert("Вы ввели не все данные");</script>
        <?php unset($_COOKIE['signup_error']); setcookie('signup_error', null, -1, '/signin.php') ?>
    <?php endif; ?>

    <?php if((($_COOKIE['signup_error'] ?? '') == '2')) : ?>
        <script>alert("Некорректный номер телефона, формат - 89*");</script>
        <?php unset($_COOKIE['signup_error']); setcookie('signup_error', null, -1, '/signin.php') ?>
    <?php endif; ?>

    <?php if((($_COOKIE['signup_error'] ?? '') == '3')) : ?>
        <script>alert("Пароли не совпадают");</script>
        <?php unset($_COOKIE['signup_error']); setcookie('signup_error', null, -1, '/signin.php') ?>
    <?php endif; ?>

    <?php if((($_COOKIE['signup_error'] ?? '') == '4')) : ?>
        <script>alert("Пользователь с таким номером телефона уже существует");</script>
        <?php unset($_COOKIE['signup_error']); setcookie('signup_error', null, -1, '/signin.php') ?>
    <?php endif; ?>

    <?php if((($_COOKIE['signup_error'] ?? '') == '5')) : ?>
        <script>alert("В имени и фамилии не должно быть чисел");</script>
        <?php unset($_COOKIE['signup_error']); setcookie('signup_error', null, -1, '/signin.php') ?>
    <?php endif; ?>

    <a href="/signin.php"><p class="back">🠔</p></a>
    <main role="main" class="wrapper">
        <div class="headline_block">
            <h1 class="headline">Регистрация</h1>
        </div>
        <div class="signup_block">
            <form method="POST" action="/php/signup.php">
            <label class="text_label">Имя</label>
                </br><input type="text" name="name" class="text_field1">
                </br><label class="text_label">Фамилия</label>
                </br><input type="text" name="surname" class="text_field2">
                </br><label class="text_label">Номер телефона</label>
                </br><input type="number" name="phone" class="text_field2">
                </br><label class="text_label">Пароль</label>
                </br><input type="password" name="pass" class="text_field2">
                </br><label class="text_label">Повторите пароль</label>
                </br><input type="password" name="pass_again" class="text_field2">
                </br><button type="submit" class="btn_signup">Создать аккаунт</button>
            </form>
        </div>
    </main>
</body>
</html>