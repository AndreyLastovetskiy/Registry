<?php 
setcookie("id_user", null, time()-28800, "/");
setcookie("id_group", null, time()-28800, "/");

header("Location: ../index.php");
?>