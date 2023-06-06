<?php 
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLog'] = "Авторизуйтесь!";
    header("Location: ../../login.php");
} else {
    if($_COOKIE['id_group'] != 3) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        require_once("../../db/db.php");
        
        $login = $_POST['login'];
        $treatment = $_POST['treatment'];

        $select_pation = mysqli_query($link, "SELECT * FROM `users` WHERE `login` = '$login'");
        $select_pation = mysqli_fetch_assoc($select_pation);
        $select_pation_id = $select_pation['id'];
        $date_now = date("Y-m-d");

        $select_appoint = mysqli_query($link, "SELECT * FROM `appointment` WHERE `id_pation` = '$select_pation_id' AND `date` = '$date_now'");
        $select_appoint = mysqli_fetch_assoc($select_appoint);
        $select_appoint_id = $select_appoint['id'];

        if(empty($select_appoint)) {
            $_SESSION['errPatAccept'] = "Данного пользователя нельзя принять";
            header("Location: ../dash.php");
        } else {
            mysqli_query($link, "INSERT INTO `accept-appointment`
                                (`id_appoint`, `treatment`) 
                                VALUES 
                                ('$select_appoint_id','$treatment')
            ");
            header("Location: ../dash.php");
        }
    }
}
?>