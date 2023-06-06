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
        $login = $_POST['login'];
        $password = $_POST['password'];
        $password = password_hash($password, PASSWORD_DEFAULT);
        $email = $_POST['email'];
        $full_name = $_POST['full_name'];
        $phone = $_POST['phone'];

        $select_pation = mysqli_query($link, "SELECT * FROM `users` WHERE `login` = '$login'");
        $select_pation = mysqli_fetch_assoc($select_pation);

        if($select_pation) {
            $_SESSION['errPat'] = "Такой пациент уже существует!";
            header("Location: ../dash.php");
        } else {
            mysqli_query($link, "INSERT INTO `users`
                                (`id_group`, `login`, `password`, `email`, `full_name`, `phone`) 
                                VALUES 
                                ('1','$login','$password','$email','$full_name','$phone')
            ");
            header("Location: ../dash.php");
        }
    }
}

?>