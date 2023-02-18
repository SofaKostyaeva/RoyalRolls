<!DOCTYPE html>
<html lang="en">

<head>
<link rel="icon" href="/img/roll.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoyalRolls - Меню</title>
    <link rel="stylesheet" href="/css/admin_menu_style.css">
    </link>
</head>

<body>
    <?php
    $mysql1 = new mysqli('localhost', 'root', '', 'royalrolls2');
    $counter1 = 0;
    $items1 = $mysql1->query("SELECT `name`, `decription`, `price`, `img_path`, `id` FROM `menu`");
    ?>
    <nav>
        <div class="link_block1">
        </div>
        <div class="block_logo">
            <h1 class="logo">R<span>O</span>YALR<span>O</span>LLS</h1>
        </div>
        <div class="link_block2">
        </div>
        <a href="/admin_nav.php"><p class="back">🠔</p></a>
    </nav>
    <div class="type_list">
        <div class="rolls btn">Все роллы</div>
        <div class="zha_rolls btn">Жаренные роллы</div>
        <div class="za_rolls btn">Запеченные роллы</div>
        <div class="hol_rolls btn">Холодные роллы</div>
        <div class="sets btn">Сеты</div>
        <div class="pizza btn">Пицца</div>
        <div class="hot btn">Всё горячее</div>
        <div class="vok btn">Вок</div>
        <div class="pasta btn">Паста</div>
        <div class="plov btn">Плов</div>
        <div class="sup btn">Суп</div>
        <div class="drink btn">Напитки</div>
    </div>
    <div class="menu_content">
        <div class="wrapper">
            <div class="headline_block">
                <h1 class="headline">
                    Меню
                </h1>
            </div>
            <a href="add_item_menu.php"><div class="add">+</div></a>
            <div class="menu_list_block">
                <?php while ($row1 = mysqli_fetch_row($items1)) : ?>
                    <?php $counter1++; ?>
                    <div class="menu_item">
                        <div style="background-image: url(<?= $row1[3] ?>)" class="menu_avatar"></div>
                        <div class="menu_info">
                            <p class="menu_name">
                                <?= $row1[0] ?>
                            </p>
                            <p class="menu_desc">
                                Состав: <?= $row1[1] ?>
                            </p>
                        </div>
                        <p class="delete" id="i<?=$counter1?>">×</p>
                        <p class="name_hid"><?= $row1[0] ?></p>
                        <a href="/edit_item_menu.php?id=<?=$row1[4]?>"><div class="editt"></div></a>
                        <p class="menu_price"><?= $row1[2] ?> Р</p>
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
    <script src="/js/admin_menu_script.js"></script>


</body>

</html>