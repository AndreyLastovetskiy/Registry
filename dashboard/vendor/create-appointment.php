<?php
session_start();

if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLog'] = "Авторизуйтесь!";
    header("Location: ../../login.php");
} else {
    if($_COOKIE['id_group'] != 2) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        require_once("../../db/db.php");
        $login_pat = $_POST['login_pat'];
        $login_doc = $_POST['login_doc'];
        $date = $_POST['date'];
        $time = $_POST['time'];

        $select_doctor = mysqli_query($link, "SELECT * FROM `users` WHERE `login` = '$login_doc'");
        $select_pation = mysqli_query($link, "SELECT * FROM `users` WHERE `login` = '$login_pat'");
        $select_doctor = mysqli_fetch_assoc($select_doctor);
        $select_pation = mysqli_fetch_assoc($select_pation);

        if(empty($select_doctor)) {
            $_SESSION['errAppoint'] = "Такого доктора не существует!";
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } elseif(empty($select_pation)) {
            $_SESSION['errAppoint'] = "Такого пациента не существует!";
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } elseif($date < date("Y-m-d")) {
            $_SESSION['errAppoint'] = "Дата записи выставленна неверно!";
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            $select_doctor_id = $select_doctor['id'];
            $select_pation_id = $select_pation['id'];
            mysqli_query($link, "INSERT INTO `appointment`
                                (`id_doctor`, `id_pation`, `date`, `time`) 
                                VALUES 
                                ('$select_doctor_id','$select_pation_id','$date','$time')
            ");
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }
}

?>