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
        $login = $_POST['login'];
        $password = $_POST['password'];
        $password = password_hash($password, PASSWORD_DEFAULT);
        $email = $_POST['email'];
        $full_name = $_POST['full_name'];
        $phone = $_POST['phone'];
        $personal_role = $_POST['personal_role'];

        $select_personal = mysqli_query($link, "SELECT * FROM `users` WHERE `login` = '$login'");
        $select_personal = mysqli_fetch_assoc($select_personal);

        if($select_personal) {
            $_SESSION['errPers'] = "Такой персонал уже существует!";
            header("Location: ../dash.php");
        } else {
            mysqli_query($link, "INSERT INTO `users`
                                (`id_group`, `login`, `password`, `email`, `full_name`, `phone`) 
                                VALUES 
                                ('$personal_role','$login','$password','$email','$full_name','$phone')
            ");
            header("Location: ../dash.php");
        }
    }
}

?>