<?php
    require_once("../classes/Category.php");
    error_reporting(0);

    $connect = new mysqli("localhost","root","","db_sklep");
    $cat = new Category($_POST);
    $cat->saveCategory($connect);

    header("Location:../admin.php");


    $connect->close();
?>