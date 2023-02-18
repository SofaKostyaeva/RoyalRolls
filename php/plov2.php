<?php
$mysql = new mysqli('localhost', 'root', '', 'royalrolls2');
$counter = 0;
$items = $mysql->query("SELECT `name`, `decription`, `price`, `img_path`, `id` FROM `menu` WHERE `id_subcategory` = '2'");
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
        <a href="add_item_menu.php">
            <div class="add">+</div>
        </a>
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
                    <p class="delete" id="i<?= $counter ?>">×</p>
                    <p class="name_hid"><?= $row[0] ?></p>
                    <a href="/edit_item_menu.php?id=<?= $row[4] ?>">
                        <div class="editt"></div>
                    </a>
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
<script src="/js/admin_menu_script.js"></script>