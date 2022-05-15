<?php
    require_once("../classes/Product.php");
    error_reporting(0);

    $connect = new mysqli("localhost","root","","db_sklep");
    $prod = new Product($_POST);
    $prod->editProduct($connect,$_POST["mod"],$_FILES);

    header("Location:../admin.php");

    $connect->close();
?>