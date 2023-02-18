<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="/img/roll.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoyalRolls - Панель администратора</title>
    <style>
        body, html{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            height: 100%;
            background-color: rgb(69, 69, 69);
        }
        .main_content{
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        a{
            text-decoration: none;
        }
        .btn{
            width: calc(1vh + 1vw * 13);
            height: calc(1vh + 1vw * 3);
            background-color:  rgb(137, 21, 21);
            border-radius: calc(1vh + 1vw * 1.5);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: calc(1vh + 1vw * 0.5);
            font-weight: 500;
            color: white;
            cursor: pointer;
            transition: .3s all ease-in-out;
            border: 0;
            outline: 0;
            margin-left: calc(1vh + 1vw * 2);
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .btn:nth-child(0){
            margin-left: 0;
        }
        .btn:hover{
            background-color: rgb(151, 86, 86);
        }
    </style>
</head>
<body>
    <div class="main_content">
        <a href="/admin_menu.php"><div class="btn">Управление меню</div></a>
        <a href="/orders.php"><div class="btn">Управление заказами</div></a>
        <a href="/promocodes.php"><div class="btn">Промокоды</div></a>
        <a href="/index.php"><div class="btn">Выйти</div></a>
    </div>
</body>
</html>