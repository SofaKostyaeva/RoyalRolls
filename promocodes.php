<?php
session_start();
$mysql = new mysqli('localhost', 'root', '', 'royalrolls2');
$all_promocodes = $mysql->query("SELECT * FROM `promocodes`");
$counter = 0;
?>

<?php if ($_SESSION['error'] == '_') : ?>
    <script>
        alert("Вы ввели не все данные");
    </script>
    <?php $_SESSION['error'] = '+' ?>
<?php else : ?>
<?php endif; ?>
<?php if ($_SESSION['error'] == '__') : ?>
    <script>
        alert("Процент скидки должен варьироваться от 1 до 100 %");
    </script>
    <?php $_SESSION['error'] = '+' ?>
<?php else : ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="icon" href="/img/roll.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoyalRolls - Промокоды</title>
    <link rel="stylesheet" href="/css/promocodes_style.css">
</head>

<body>
    <nav>
        <div class="link_block1">
        </div>
        <div class="block_logo">
            <h1 class="logo">R<span>O</span>YALR<span>O</span>LLS</h1>
        </div>
        <div class="link_block2">
        </div>
        <a href="/admin_nav.php">
            <p class="back">🠔</p>
        </a>
    </nav>
    <div class="promocodes_content">
        <div class="wrapper">
            <div class="promocodes_operations_block">
                <div class="promocodes_list_block">
                    <div id="hl_block_add1" class="headline1_block">
                        <h1 class="headline1">Промокоды</h1>
                    </div>
                    <?php while ($row = mysqli_fetch_row($all_promocodes)) : ?>
                        <?php $counter++; ?>
                        <div class="promocode_block">
                            <p class="promocode_discount"><?= $row[2] ?>%</p>
                            <p class="promocode_name"><?= $row[3] ?></p>
                            <p class="delete_promocode" id="i<?= $counter ?>">×&nbsp;&nbsp;&nbsp;</p>
                            <p id="id_promocode"><?= $row[0] ?></p>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="add_promocodes_block">
                    <div id="hl_block_add2" class="headline1_block">
                        <h1 id="hl1" class="headline1">Добавить промокод</h1>
                    </div>
                    <div class="form_promocodes_block">
                        <form method="POST" action="/php/add_promocode.php">
                            <label class="tblock_form frst_label">Название промокода:</label>
                            <br><input type="text" name="name" class="tbox_form" />
                            <br><label class="tblock_form">Код промокода:</label>
                            <br><input type="text" name="code" class="tbox_form" />
                            <br><label class="tblock_form">Процент скидки:</label>
                            <br><input type="number" name="discount" class="tbox_form" />
                            <br><button type="submit" class="btn_add_promocode">Добавить</button>
                        </form>
                    </div>
                </div>
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
    <script src="/js/promocode_script.js"></script>
</body>

</html>