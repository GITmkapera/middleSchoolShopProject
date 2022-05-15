<?php

session_start();
$ses = $_REQUEST["id"];
$val = $_REQUEST["value"];
$wh = $_REQUEST["whole"];
$sum = $_REQUEST["sum"];

$_SESSION[$ses] = $val;
$_SESSION["products"] = $wh;

?>