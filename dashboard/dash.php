<?php
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLog'] = "Авторизуйтесь!";
    header("Location: ../login.php");
}
require_once("../db/db.php");
$id_user = $_COOKIE['id_user'];
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
    <?php if($_COOKIE['id_group'] == 4) { ?>
        <h2>Добавить персонал</h2>
        <form action="./vendor/create-personal.php" method="post" class="create-personal">
            <input type="text" name="login" placeholder="Логин" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="full_name" placeholder="ФИО Персонала" required>
            <input type="text" name="phone" placeholder="Телефон" required>
            <select name="personal_role">
                <option value="3">Доктор</option>
                <option value="2">Регистратура</option>
            </select>
            <button>Добавить</button>
        </form>
        <br>
        
        <?php if(empty($_SESSION['errPers'])) {
            echo "";
        } else {
            echo $_SESSION['errPers'];
        } 
        session_destroy();
        ?>

        <h2>Все доктора</h2>
        <?php 
            $select_doctor = mysqli_query($link, "SELECT * FROM `users` WHERE `id_group` = '3'");
            $select_doctor = mysqli_fetch_all($select_doctor);

            foreach($select_doctor as $sd) { ?>
                <a href="./doctor.php?id=<?= $sd[0] ?>"><?= $sd[5] ?></a>
            <?php } ?>

        <h2>Все регистраторы</h2>
        <?php 
            $select_registry = mysqli_query($link, "SELECT * FROM `users` WHERE `id_group` = '2'");
            $select_registry = mysqli_fetch_all($select_registry);

            foreach($select_registry as $sr) { ?>
                <a href="./registry.php?id=<?= $sr[0] ?>"><?= $sr[5] ?></a>
            <?php } ?>
    <?php } ?>
    <?php if($_COOKIE['id_group'] == 3) { ?>
        <h2>Принять пациента</h2>
        <form action="./vendor/accept-appointment.php" method="post" class="create-personal">
            <input type="text" name="login" placeholder="Логин пациента" required>
            <textarea name="treatment" cols="30" rows="10" placeholder="Лечение" required></textarea>
            <button>Принять</button>
        </form>
        <br>
        
        <?php if(empty($_SESSION['errPatAccept'])) {
            echo "";
        } else {
            echo $_SESSION['errPatAccept'];
        } 
        ?>
    <?php } ?>
    <?php if($_COOKIE['id_group'] == 2) { ?>
        <h2>Зарегистрировать пациента</h2>
        <form action="./vendor/create-pation.php" method="post" class="create-personal">
            <input type="text" name="login" placeholder="Логин" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="full_name" placeholder="ФИО Пациента" required>
            <input type="text" name="phone" placeholder="Телефон" required>
            <button>Зарегистрировать</button>
        </form>
        <br>
        
        <?php if(empty($_SESSION['errPat'])) {
            echo "";
        } else {
            echo $_SESSION['errPat'];
        } 
        ?>
        
        <h2>Записать пациента</h2>
        <form action="./vendor/create-appointment.php" method="post" class="create-personal">
            <input type="text" name="login_pat" placeholder="Логин пациента" required>
            <input type="text" name="login_doc" placeholder="Логин доктора" required>
            <input type="date" name="date" required>
            <input type="text" name="time" placeholder="Время записи" required>
            <button>Записать</button>
        </form>
        <br>

        <?php if(empty($_SESSION['errAppoint'])) {
            echo "";
        } else {
            echo $_SESSION['errAppoint'];
        } 
        session_destroy();
        ?>
    <?php } ?>
    <?php if($_COOKIE['id_group'] == 1) { ?>
        <h2>Записи на прием</h2>
        <?php 
            $date_now = date('Y-m-d');
            $select_appoint = mysqli_query($link, "SELECT * FROM `appointment` WHERE `id_pation` = '$id_user' AND `date` = '$date_now'");
            $select_appoint = mysqli_fetch_all($select_appoint);

            foreach($select_appoint as $sa) { 
                $sa_id = $sa[1];
                $select_appoint_doctor = mysqli_query($link, "SELECT * FROM `users` WHERE `id` = '$sa_id'");
                $select_appoint_doctor = mysqli_fetch_assoc($select_appoint_doctor);
            ?>
                <a href="./appoint.php?id=<?= $sa[0] ?>"><?= $select_appoint_doctor['login'] ?></a>
                <br><br>
            <?php } ?>
        <h2>Моя карточка</h2>
        <?php 
            $select_accept_appoint = mysqli_query($link, "SELECT * FROM `accept-appointment`");
            $select_accept_appoint = mysqli_fetch_all($select_accept_appoint);

            foreach($select_accept_appoint as $saa) { 
                    $saa_id_appoint = $saa[1];
                    $select_appoint_medcard = mysqli_query($link, "SELECT * FROM `appointment` WHERE `id` = '$saa_id_appoint'");
                    $select_appoint_medcard = mysqli_fetch_assoc($select_appoint_medcard);

                    $select_appoint_medcard_id_doctor = $select_appoint_medcard['id_doctor'];
                    $select_appoint_medcard_doctor = mysqli_query($link, "SELECT * FROM `users` WHERE `id` = '$select_appoint_medcard_id_doctor'");
                    $select_appoint_medcard_doctor = mysqli_fetch_assoc($select_appoint_medcard_doctor);
                ?>
                <a href="./med_card.php?id=<?= $saa[0] ?>"><?= $select_appoint_medcard_doctor['full_name'] ?></a>
            <?php } ?>
    <?php } ?>
</body>
</html>