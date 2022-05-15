<?php

$prod = "p".$_REQUEST["id"];

session_start();

if(!isset($_SESSION["isLog"])) echo "LogNeeded";
else{
    if(!isset($_SESSION[$prod])){
        $_SESSION[$prod]=1;
        $_SESSION["products"]+=1;
        $_SESSION["productsList"] .="$prod,"; 
    }else{
        $_SESSION["products"]+=1;
        $_SESSION[$prod]+=1;
    } 
}

?>