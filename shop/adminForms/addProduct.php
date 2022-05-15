<?php
    require_once("../classes/Product.php");
    error_reporting(0);

    $connect = new mysqli("localhost","root","","db_sklep");
    $pro = new Product($_POST);
    $pro->saveProduct($connect);
    $pro->addPicture($connect,$_FILES);

    header("Location:../admin.php");

    $connect->close();
?>