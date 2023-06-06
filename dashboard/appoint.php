<?php
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLog'] = "Авторизуйтесь!";
    header("Location: ../login.php");
}
require_once("../db/db.php");
$id_user = $_COOKIE['id_user'];
$id_appoint = $_GET['id'];
$select_appoint = mysqli_query($link, "SELECT * FROM `appointment` WHERE `id` = '$id_appoint'");
$select_appoint = mysqli_fetch_assoc($select_appoint);
if($select_appoint['id_pation'] != $id_user) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
}
$select_appoint_id_doctor = $select_appoint['id_doctor'];
$select_appoint_doctor = mysqli_query($link, "SELECT * FROM `users` WHERE `id`='$select_appoint_id_doctor'");
$select_appoint_pation = mysqli_query($link, "SELECT * FROM `users` WHERE `id`='$id_user'");
$select_appoint_doctor = mysqli_fetch_assoc($select_appoint_doctor);
$select_appoint_pation = mysqli_fetch_assoc($select_appoint_pation);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <title>Панель управления</title>
</head>
<body>
    <a href="./logout.php">Выйти</a> 
    <br>
    <br>
    <a href="./dash.php">Назад</a>
    <h2>Информация о записи</h2>
    <p>К кому: <?= $select_appoint_doctor['full_name']; ?></p>
    <p>Кто: <?= $select_appoint_pation['full_name']; ?></p>
    <p>Дата: <?= $select_appoint['date']; ?></p>
    <p>Время: <?= $select_appoint['time'] ?></p>
</body>
</html>