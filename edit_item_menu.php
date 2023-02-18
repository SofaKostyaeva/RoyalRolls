<?php

session_start();
$_SESSION['error'];
$_SESSION['success'];

$id = $_GET['id'];
$mysql = new mysqli('localhost', 'root', '', 'royalrolls2');
    $result = $mysql->query("SELECT `name`, `decription`, `price`, `id_category`, `id_subcategory` FROM `menu` WHERE `id` = '$id'");
    $menu = $result->fetch_row();
    $Mname = $menu[0];
    $Mdecr = $menu[1];
    $Mprice = $menu[2];
    $result1 = $mysql->query("SELECT `name` FROM `categories` WHERE `id` = '$menu[3]'");
    $result2 = $mysql->query("SELECT `name` FROM `subcategories` WHERE `id` = '$menu[4]'");
    $cat = $result1->fetch_row();
    $subcat = $result2->fetch_row();
    $Mcat = $cat[0];

    if(is_null($menu[4]))
    {
        $Msubcat = "NULL";
    }
    else
    {
        $Msubcat = $subcat[0];
    }

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
        .fimg{
            position: absolute;
            left: calc(1vh + 1vw * 41);
            top: calc(1vh + 1vw * 6);
        }
        .inp_hid{
            display: none;
        }
    </style>
</head>

<body>
    <a href="/admin_menu.php">
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
            <form method="POST" action="/php/edit_menu.php">
                <input type="number" name="id" value="<?=$id?>" class="inp_hid">
                <label>Наименование</label>
                <br><input type="text" name="name" value="<?= $Mname ?>">
                <br><label>Описание</label>
                <br><input type="text" name="decr" value="<?= $Mdecr ?>">
                <br><label>Цена</label>
                <br><input type="number" name="price" value="<?= $Mprice ?>">
                <br><label>Категория</label>
                <br><select name="cat">
                    <?php if ($Mcat == "Пицца") : ?>
                        <option selected="selected" value="Пицца">Пицца</option>
                    <?php else : ?>
                        <option value="Пицца">Пицца</option>
                    <?php endif; ?>
                    <?php if ($Mcat == "Роллы") : ?>
                        <option selected="selected" value="Роллы">Роллы</option>
                    <?php else : ?>
                        <option value="Роллы">Роллы</option>
                    <?php endif; ?>
                    <?php if ($Mcat == "Горячее") : ?>
                        <option selected="selected" value="Горячее">Горячее</option>
                    <?php else : ?>
                        <option value="Горячее">Горячее</option>
                    <?php endif; ?>
                    <?php if ($Mcat == "Сеты") : ?>
                        <option selected="selected" value="Сеты">Сеты</option>
                    <?php else : ?>
                        <option value="Сеты">Сеты</option>
                    <?php endif; ?>
                    <?php if ($Mcat == "Напитки") : ?>
                        <option selected="selected" value="Напитки">Напитки</option>
                    <?php else : ?>
                        <option value="Напитки">Напитки</option>
                    <?php endif; ?>
                </select>
                <br><label>Подкатегория</label>
                <br><select name="subcat">
                    <?php if ($Msubcat == "NULL") : ?>
                        <option selected="selected" value="none">NULL</option>
                    <?php else : ?>
                        <option value="none">NULL</option>
                    <?php endif; ?>
                    <?php if ($Msubcat == "Вок") : ?>
                        <option selected="selected" value="Вок">Вок</option>
                    <?php else : ?>
                        <option value="Вок">Вок</option>
                    <?php endif; ?>
                    <?php if ($Msubcat == "Плов") : ?>
                        <option selected="selected" value="Плов">Плов</option>
                    <?php else : ?>
                        <option value="Плов">Плов</option>
                    <?php endif; ?>
                    <?php if ($Msubcat == "Паста") : ?>
                        <option selected="selected" value="Паста">Паста</option>
                    <?php else : ?>
                        <option value="Паста">Паста</option>
                    <?php endif; ?>
                    <?php if ($Msubcat == "Суп") : ?>
                        <option selected="selected" value="Суп">Суп</option>
                    <?php else : ?>
                        <option value="Суп">Суп</option>
                    <?php endif; ?>
                    <?php if ($Msubcat == "Жаренные") : ?>
                        <option selected="selected" value="Жаренные">Жаренные</option>
                    <?php else : ?>
                        <option value="Жаренные">Жаренные</option>
                    <?php endif; ?>
                    <?php if ($Msubcat == "Холодные") : ?>
                        <option selected="selected" value="Холодные">Холодные</option>
                    <?php else : ?>
                        <option value="Холодные">Холодные</option>
                    <?php endif; ?>
                    <?php if ($Msubcat == "Запеченные") : ?>
                        <option selected="selected" value="Запеченные">Запеченные</option>
                    <?php else : ?>
                        <option value="Запеченные">Запеченные</option>
                    <?php endif; ?>
                </select>
                <br><button type="submit">Изменить</button>
            </form>
        </div>        
    </div>
    <form class="fimg" method="POST" action="/php/edit_photo.php" enctype="multipart/form-data">
        <input type="number" name="id" value="<?=$id?>" class="inp_hid">
        <br><label>Изображение</label>
        <br><input class="file_class" type="file" name="file" accept=".jpg,.jpeg,.png">
        <br><button type="submit">Изменить</button>
    </form>
</body>

</html>