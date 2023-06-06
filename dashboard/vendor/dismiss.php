<?php 
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLog'] = "Авторизуйтесь!";
    header("Location: ../../login.php");
} else {
    if($_COOKIE['id_group'] != 4) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        require_once("../../db/db.php");
        $id = $_GET['id'];
        
        mysqli_query($link, "UPDATE `users` SET `dismiss`='1' WHERE `id` = '$id'");
        header("Location: ../dash.php");
    }
}
?>