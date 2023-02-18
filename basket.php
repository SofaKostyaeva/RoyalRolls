<?php
session_start();
$_SESSION['error'];
$_SESSION['success'];
$id = $_SESSION['user']['id'];
$mysql = new mysqli('localhost', 'root', '', 'royalrolls2');
$count_menu_basketl = $mysql->query("SELECT `count` FROM `basket` WHERE `id_user` = '$id'");
$all_basket_items = $mysql->query("SELECT `id`, `id_menu`, `count` FROM `basket` WHERE `id_user` = '$id'");
$check_price = $mysql->query("SELECT `id`, `id_menu`, `count` FROM `basket` WHERE `id_user` = '$id'");
$counter = 0;
$total_price = 0;
$count = 0;
$count_position = 0;
while ($row = mysqli_fetch_row($count_menu_basketl)) {
    $count += $row[0];
    $count_position++;
}
while ($row = mysqli_fetch_row($check_price)) {
    $result2 = $mysql->query("SELECT `price` FROM `menu` WHERE `id` = '$row[1]'");
    $price_item = $result2->fetch_row();
    if ($row[2] == 1) {
        $total_price += $price_item[0];
    } else {
        $total_price += $price_item[0] * $row[2];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="icon" href="/img/roll.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoyalRolls - Корзина</title>
    <link rel="stylesheet" href="/css/basket_style.css">
    <style>
        .block_buy {
            position: absolute;
            width: calc(1vh + 1vw * 22);
            height: calc(1vh + 1vw * 59);
            border-radius: calc(1vh + 1vw * 1.5);
            right: calc(1vh + 1vw * 9);
            top: calc(1vh + 1vw * 17.4);
            z-index: 1;
            background-color: rgb(80, 80, 80);
        }

        .count_item {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: rgb(137, 21, 21);
            font-weight: 800;
            font-size: calc(1vh + 1vw * 0.6);
            position: relative;
            top: calc(1vh + 1vw * 3);
            left: calc(1vh + 1vw * -1.7);
        }

        .separator {
            width: 100%;
            height: calc(1vh + 1vw * 56);
        }

        .separator2 {
            width: 100%;
            height: calc(1vh + 1vw * 39);
        }

        .separator3 {
            width: 100%;
            height: calc(1vh + 1vw * 22);
        }

        .separator4 {
            width: 100%;
            height: calc(1vh + 1vw * 5);
        }
    </style>
</head>

<body>
    <nav>
        <?php if (($_COOKIE['user_enter'] ?? '') == '') : ?>
            <a href="signin.php">
                <p class="signin_profile link">Войти</p>
            </a>
        <?php else : ?>
            <a href="profile.php">
                <p class="signin_profile link">Профиль</p>
            </a>
        <?php endif; ?>
        <a href="foradmin.php">
            <p class="foradmin">A</p>
        </a>
        <?php ?>
        <div class="link_block1">
            <div class="link_subblock1">
                <a href="index.php">
                    <p class="link main">Главная</p>
                </a>
                <a href="menu.php">
                    <p class="link menu">Меню</p>
                </a>
            </div>
        </div>
        <div class="block_logo">
            <h1 class="logo">R<span>O</span>YALR<span>O</span>LLS</h1>
        </div>
        <div class="link_block2">
            <div class="link_subblock2">
                <a href="basket.php">
                    <?php if (($_COOKIE['user_enter'] ?? '') == '') : ?>
                        <p class="link basket">Корзина(0)</p>
                    <?php else : ?>
                        <p class="link basket">Корзина(<?= $count ?>)</p>
                    <?php endif; ?>
                </a>
                <a href="contacts.php">
                    <p class="link contacts">Контакты</p>
                </a>
            </div>
        </div>
    </nav>
    <div class="basket_content">
        <div class="wrapper">
            <div class="headline_block">
                <?php if(($_COOKIE['user_enter'] ?? '') == ''): ?>
                    <h1 class="headline">Корзина (0)</h1>
                <?php else: ?>
                    <h1 class="headline">Корзина (<?= $count ?>)</h1>
                <?php endif; ?>
            </div>
            <div class="basket_list_block">
                <?php while ($row = mysqli_fetch_row($all_basket_items)) : ?>
                    <?php
                    $id = $row[1];
                    $idBasket = $row[0];
                    $counter++;
                    $result = $mysql->query("SELECT `name`, `decription`, `price`, `img_path` FROM `menu` WHERE `id` = '$id'");
                    $menu_item = $result->fetch_row();
                    ?>
                    <div class="basket_item">
                        <div style="background-image: url(<?= $menu_item[3] ?>);" class="basket_item_avatar"></div>
                        <div class="basket_item_info">
                            <p class="name_basket_item"><?= $menu_item[0] ?></p>
                            <p class="descripton_basket_item">Состав: <?= $menu_item[1] ?></p>
                            <p class="price_basket_item"><?= $menu_item[2] ?> Р</p>
                        </div>
                        <div class="basket_item_delete">
                            <p class="delete_item" id="i<?= $counter ?>">✕</p>
                            <p class="name-hid"><?= $idBasket ?></p>
                            <p class="count_item">X<?= $row[2] ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
    <div class="block_buy">
        <?php if ($_SESSION['error'] == '-') : ?>
            <script>
                alert("Вы ввели не все данные");
            </script>
            <?php
            $_SESSION['error'] = '+';
            ?>
        <?php else : ?>
        <?php endif; ?>
        <?php if ($_SESSION['error'] == '--') : ?>
            <script>
                alert("Корзина пустая");
            </script>
            <?php $_SESSION['error'] = '+'; ?>
        <?php else : ?>
        <?php endif; ?>
        <?php if ($_SESSION['error'] == '---') : ?>
            <script>
                alert("Сперва вам нужно войти в свой профиль");
            </script>
            <?php $_SESSION['error'] = '+'; ?>
        <?php else : ?>
        <?php endif; ?>
        <?php if ($_SESSION['error'] == '----') : ?>
            <script>
                alert("Промокод не найден");
            </script>
            <?php $_SESSION['error'] = '+'; ?>
        <?php else : ?>
        <?php endif; ?>
        <?php if ($_SESSION['error'] == '-----') : ?>
            <script>
                alert("Вы уже использовали данный промокод");
            </script>
            <?php $_SESSION['error'] = '+'; ?>
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
        <h2 class="total_price">Итого: <?= $total_price ?> Р</h2>
        <form method="POST" action="/php/buy.php">
            <p class="textblock_form">Введите адрес доставки:</p>
            <input class="textbox_form" name="address" type="text" />
            <p class="textblock_form">Введите кол-во персон:</p>
            <input class="textbox_form" name="count_person" type="number" />
            <p class="textblock_form">Введите комментарий к заказу:</p>
            <input class="textbox_form" name="comment" type="text" />
            <p class="textblock_form">Промокод:</p>
            <input class="textbox_form promocode_tbox" name="promocode" type="text" />
            <br><a class="access_promocode"><div class="btn_access">Применить</div></a>
            <br><br><br><input type="radio" name="type_order" checked value="Банковская карта" /> <label>Карта</label>
            <input type="radio" name="type_order" value="Наличные" /> <label>Наличные </label>
            <br><br><br><input type="radio" name="delivery_type" checked value="Доставка" /> <label>Доставка</label>
            <input type="radio" name="delivery_type" value="Самовывоз" /> <label>Самовывоз </label>
            <br><input type="radio" name="delivery_type" value="В зале" /> <label>В зале </label>
            <br><button type="submit" class="btn_buy">Заказать</button>
        </form>
        <?php if(($_COOKIE['user_enter'] ?? '') != ''): ?>
            <a href="my_orders.php"><p class="show_orders">Показать текущие заказы</p></a>
        <?php endif; ?>    
    </div>
    <?php if ($count_position == 0) : ?>
        <div class="separator"></div>
    <?php endif; ?>
    <?php if ($count_position == 1) : ?>
        <div class="separator2"></div>
    <?php endif; ?>
    <?php if ($count_position == 2) : ?>
        <div class="separator3"></div>
    <?php endif; ?>
    <?php if ($count_position == 3) : ?>
        <div class="separator4"></div>
    <?php endif; ?>
    <footer>
        <div class="wrapper">
            <p class="footer_text1">© Royal Rolls | 2019 - 2022</p>
            <p class="footer_text2">+7 (904) 663-75-07</p>
            <p class="footer_text3">royalrolls.kzn@gmail.com</p>
            <p class="footer_text4">ул. Азата Аббасова, 8</p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="/js/basket_script.js"></script>
</body>

</html>