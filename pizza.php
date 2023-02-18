<!DOCTYPE html>
<html lang="en">

<head>
<link rel="icon" href="/img/roll.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoyalRolls - Пицца</title>
    <link rel="stylesheet" href="/css/menu_style.css">
</head>

<body>
    <?php
    session_start();
    $mysql = new mysqli('localhost', 'root', '', 'royalrolls2');
    $count_items_basket = 0;
    $id_current_user = $_SESSION['user']['id'];
    $count_basket = $mysql->query("SELECT `count` FROM `basket` WHERE `id_user` = $id_current_user");
    while ($row = mysqli_fetch_row($count_basket)) {
        $count_items_basket += $row[0];
    }
    $counter = 0;
    $items = $mysql->query("SELECT `name`, `decription`, `price`, `img_path` FROM `menu` WHERE `id_category` = '1'");
    ?>

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
                        <p class="link basket">Корзина(<?= $count_items_basket ?>)</p>
                    <?php endif; ?>
                </a>
                <a href="contacts.php">
                    <p class="link contacts">Контакты</p>
                </a>
            </div>
        </div>
    </nav>
    <div class="type_list">
        <a href="/rolls.php">
            <div class="rolls btn">Все роллы</div>
        </a>
        <a href="/zha_rolls.php">
            <div class="zha_rolls btn">Жареные роллы</div>
        </a>
        <a href="/za_rolls.php">
            <div class="za_rolls btn">Запеченные роллы</div>
        </a>
        <a href="/hol_rolls.php">
            <div class="hol_rolls btn">Холодные роллы</div>
        </a>
        <a href="/sets.php">
            <div class="sets btn">Сеты</div>
        </a>
        <a href="/pizza.php">
            <div class="pizza btn">Пицца</div>
        </a>
        <a href="/hot.php">
            <div class="hot btn">Всё горячее</div>
        </a>
        <a href="/vok.php">
            <div class="vok btn">Вок</div>
        </a>
        <a href="/pasta.php">
            <div class="pasta btn">Паста</div>
        </a>
        <a href="/plov.php">
            <div class="plov btn">Плов</div>
        </a>
        <a href="/sup.php">
            <div class="sup btn">Суп</div>
        </a>
        <a href="/drink.php">
            <div class ="drink btn">Напитки</div> 
        </a>
    </div>
    <div class="menu_content">
        <div class="wrapper">
            <div class="headline_block">
                <h1 class="headline">
                    Меню
                </h1>
            </div>
            <div class="menu_list_block">
                <?php while ($row = mysqli_fetch_row($items)) : ?>
                    <?php $counter++; ?>
                    <div class="menu_item">
                        <div style="background-image: url(<?= $row[3] ?>)" class="menu_avatar"></div>
                        <div class="menu_info">
                            <p class="menu_name">
                                <?= $row[0] ?>
                            </p>
                            <p class="menu_desc">
                                Состав: <?= $row[1] ?>
                            </p>
                        </div>
                        <?php if (($_COOKIE['user_enter'] ?? '') == '') : ?>
                            <div class="btn_error">
                                Добавить
                            </div>
                        <?php else : ?>
                            <div class="add_to_basket" id="i<?= $counter ?>">
                                Добавить
                            </div>
                            <p class="name_hid"><?= $row[0] ?></p>
                        <?php endif; ?>
                        <p class="menu_price"><?= $row[2] ?> Р</p>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
    <footer>
        <div class="wrapper">
            <p class="footer_text1">© Royal Rolls | 2019 - 2022</p>
            <p class="footer_text2">+7 (904) 663-75-07</p>
            <p class="footer_text3">royalrolls.kzn@gmail.com</p>
            <p class="footer_text4">ул. Азата Аббасова, 8</p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        $('.btn_error').click(function() {
            alert("Сперва вам нужно войти в свой аккаунт");
        });
        $('.add_to_basket').click(function() {
            let id = $(this).attr("id");
            let name = $(`#${id} + .name_hid`).text();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/php/add_to_basket.php',
                data: {
                    sourceData: name
                },
                success: function(data) {
                    if (data['success']) {
                        location.reload();
                    } else {
                        alert("Ошибка!");
                    }
                }
            });
        });
    </script>
</body>
</html>