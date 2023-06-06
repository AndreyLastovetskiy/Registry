<?php
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLog'] = "Авторизуйтесь!";
    header("Location: ../login.php");
} else {
    if($_COOKIE['id_group'] != 4) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        require_once("../db/db.php");
        $id_doctor = $_GET['id'];
        
        $select_doctor = mysqli_query($link, "SELECT * FROM `users` WHERE `id` = '$id_doctor'");
        $select_doctor = mysqli_fetch_assoc($select_doctor);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Доктор - <?= $select_doctor['full_name'] ?></title>
</head>
<body>
    <a href="./dash.php">На Главную</a>
    <h2>Информация о пользователе</h2>
    <p>ФИО: <?= $select_doctor['full_name'] ?></p>
    <p>Email: <?= $select_doctor['email'] ?></p>
    <p>Телефон: <?= $select_doctor['phone'] ?></p>
    <?php 
    if($select_doctor['dismiss'] == 0) { ?>
        <a href="./vendor/dismiss.php?id=<?= $id_doctor ?>">Уволить</a>
    <?php } else { ?>
        <a href="./vendor/adopt.php?id=<?= $id_doctor ?>">Принять</a>
    <?php } ?>
    
</body>
</html>