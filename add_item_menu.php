<?php

session_start();
$_SESSION['error'];
$_SESSION['success'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="icon" href="/img/roll.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoyalRolls - Добавление товара</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            height: 100%;
            background-color: rgb(69, 69, 69);
        }

        .main_content {
            width: 50%;
            height: 100%;
            display: flex;
            justify-content: left;
            margin-left: calc(1vh + 1vw * 14);
            align-items: center;
        }

        label {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: calc(1vh + 1vw * 0.6);
            color: white;
            font-weight: 200;
        }

        input {
            width: calc(1vh + 1vw * 20);
            height: calc(1vh + 1vw * 1.6);
            outline: 0;
            border: 0;
            border-radius: calc(1vh + 1vw * 0.3);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: calc(1vh + 1vw * 0.4);
            font-weight: 200;
            margin-bottom: calc(1vh + 1vw * 0.8);
            margin-top: calc(1vh + 1vw * 0.2);
        }

        select {
            width: calc(1vh + 1vw * 20);
            height: calc(1vh + 1vw * 1.6);
            outline: 0;
            border: 0;
            border-radius: calc(1vh + 1vw * 0.1);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: calc(1vh + 1vw * 0.4);
            font-weight: 200;
            margin-bottom: calc(1vh + 1vw * 0.8);
            margin-top: calc(1vh + 1vw * 0.2);
        }

        button {
            width: calc(1vh + 1vw * 11);
            height: calc(1vh + 1vw * 2.7);
            outline: 0;
            border: 0;
            border-radius: calc(1vh + 1vw * 1);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: calc(1vh + 1vw * 0.4);
            font-weight: 200;
            color: white;
            background-color: rgb(102, 61, 61);
            margin-top: calc(1vh + 1vw * 0.5);
            transition: .3s all ease-in-out;
            cursor: pointer;
        }

        button:hover {
            background-color: rgb(137, 21, 21);
        }

        p {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: calc(1vh + 1vw * 0.8);
            font-weight: 600;
            color: white;
            position: absolute;
            right: calc(1vh + 1vw * 3);
            top: calc(1vh + 1vw * 1);
            cursor: pointer;
            transition: .3s all ease-in-out;
        }

        p:hover {
            transform: scale(0.9);
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <a href="admin_menu.php">
        <p style="font-size: calc(1vh + 1vw * 3); margin-top: calc(1vh + 1vw * 0);">🠔</p>
    </a>
    <?php if ($_SESSION['error'] == '-') : ?>
        <script>
            alert("Вы ввели не все данные!");
        </script>
        <?php
        $_SESSION['error'] = '+';
        ?>
    <?php else : ?>
    <?php endif; ?>
    <?php if ($_SESSION['success'] == '+') : ?>
        <script>
            alert("Успешно!");
        </script>
        <?php
        $_SESSION['success'] = '-';
        ?>
    <?php else : ?>
    <?php endif; ?>
    <div class="main_content">
        <div class="form_block">
            <form method="POST" action="/php/add_item_menu.php" enctype="multipart/form-data">
                <label>Наименование</label>
                <br><input type="text" name="name">
                <br><label>Описание</label>
                <br><input type="text" name="decr">
                <br><label>Цена</label>
                <br><input type="number" name="price">
                <br><label>Категория</label>
                <br><select name="cat">
                    <option value="Пицца">Пицца</option>
                    <option value="Роллы">Роллы</option>
                    <option value="Горячее">Горячее</option>
                    <option value="Сеты">Сеты</option>
                    <option value="Напитки">Напитки</option>
                </select>
                <br><label>Подкатегория</label>
                <br><select name="subcat">
                    <option value="none">NULL</option>
                    <option value="Вок">Вок</option>
                    <option value="Плов">Плов</option>
                    <option value="Паста">Паста</option>
                    <option value="Суп">Суп</option>
                    <option value="Жаренные">Жаренные</option>
                    <option value="Холодные">Холодные</option>
                    <option value="Запеченные">Запеченные</option>
                </select>
                <br><label>Изображение</label>
                <br><input class="file_class" type="file" name="file" accept=".jpg,.jpeg,.png">
                <br><button type="submit">Добавить</button>
            </form>
        </div>
    </div>
</body>

</html>