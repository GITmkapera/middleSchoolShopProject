<?php
    require_once("../classes/User.php");
    error_reporting(0);

    $connect = new mysqli("localhost","root","","db_sklep");
    $user = new User($_POST);
    $user->saveUser($connect,$_POST["mod"]);

    header("Location:../admin.php");

    $connect->close();
?>