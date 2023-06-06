<?php
session_start();
require_once("../db/db.php");

$login = $_POST['login'];
$password = $_POST['password'];

$select_user = mysqli_query($link, "SELECT * FROM `users` WHERE `login` = '$login'");
$select_user = mysqli_fetch_assoc($select_user);

if(empty($select_user)) {
    $_SESSION['errLog'] = "Такого пользователя не существует!";
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    if(password_verify($password, $select_user['password'])) {
        setcookie("id_user", $select_user['id'], time()+28800, "/");
        setcookie("id_group", $select_user['id_group'], time()+28800, "/");
        header("Location: ../dashboard/dash.php");
    } else {
        $_SESSION['errLog'] = "Пароль неверный!";
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}

?>