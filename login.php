<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
</head>
<body>
    <h2>Авторизация</h2>
    <form action="./vendor/login.php" method="post">
        <input type="text" name="login" placeholder="Логин" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button>Войти</button>
    </form>
    <?php 
    if(empty($_SESSION['errLog'])) {
        echo "";
    } else {
        echo $_SESSION['errLog'];
    }

    session_destroy();
    ?>
    <br>
    <a href="./index.php">На Главную</a>
</body>
</html>