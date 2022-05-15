<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MKgames</title>
    <link rel="shortcut icon" href="files/logo_black.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        require_once("classes/Product.php");
        require_once("classes/User.php");
        require_once("classes/Cart.php");
        error_reporting(0);
        session_start();

        if(!isset($_SESSION["products"])){
            $_SESSION["products"]=0;
            if(isset($_SESSION['productsList'])) Cart::removeCart();
        }
        $connect = new mysqli("localhost","root","","db_sklep");
    ?>
    
    <header>
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php"><img src="files/logo_white.png" alt="MK" width="60" height="60">games.pl</a>
            <span class="navbar-brand"><a class="navbar-brand" href="index.php?mode=products"> Produkty</a></span>  
            <span class="navbar-brand"><a class="navbar-brand" href="index.php?mode=about">O nas</a></span>  
            <?php
                if(!isset($_SESSION['isLog']))
                    echo '<span class="navbar-brand"><a class="navbar-brand" href="index.php?mode=log">Zaloguj</a><a class="navbar-brand" href="acc.php">Zarejestruj</a></span>';
                else{
                    if($_SESSION['userMod']==1){
                       echo '<span class="navbar-brand"><a class="navbar-brand" href="admin.php">Panel Administratora</a></span>'; 
                    }                    
                    echo '<span class="navbar-brand">';
                    echo '<a class="navbar-brand" href="acc.php">Konto</a></span>';
                    echo '<a class="navbar-brand" href="orderSite.php"><img src="files/shop.png" alt="koszyk" width="50" height="50"><span id="cartCounter">'.$_SESSION["products"].'</span></a>';
                    echo '<a class="navbar-brand" href="index.php?mode=logout">Wyloguj</a></span>';
                }
            ?>
        </nav>
    </header>
    <div class="container">
        <div class="main">
            
                <?php   
                    $promoProduct = Product::getPromotion($connect)->fetch_object();
                    if(!isset($_GET["mode"])){
                        if(date("Y-m-d")!=$promoProduct->date){
                            Product::setPromotion($connect);
                            $promoProduct = Product::getPromotion($connect)->fetch_object();
                        }
                        echo "<span class='info'> Witamy w sklepie MKgames! <br> U nas kupisz najnowsze gry w bardzo korzystnej cenie oraz z możliwością zwrotu aż do dwóch tygodni! <br><br> Zachęcamy sprawdzić naszą:<p class='fat'><i>Promocję na dziś</i></p><p>";                      
                        echo "<a id='promoLink' href=index.php?mode=products&promoLink=$promoProduct->title><img class='border border-dark' src='$promoProduct->picture_path' alt='$promoProduct->title' width='300' height='400'></a></p>"."$promoProduct->title"." -25%</span>";
                    }
                    else{
                        if($_GET["mode"]=="log"){
                            include("log.php");
                            if(isset($_POST["logUser"])){
                                if(User::checkUser($connect,$_POST)){
                                    $_SESSION["isLog"]=1;
                                    $_SESSION["user"]=$_POST["login"];
                                    $_SESSION["userMod"]=User::isAdmin($connect,$_POST["login"]);
                                    header("Location:index.php");
                                }
                                else{
                                    echo "<script>alert('Nie udało się zalogować!');</script>";
                                }
                            }
                        }
                        if($_GET["mode"]=="about"){
                            include("readme.html");
                        }
                        if($_GET["mode"]=="logout"){
                            unset($_SESSION["isLog"]);
                            unset($_SESSION["user"]);
                            unset($_SESSION["userMod"]);
                            unset($_SESSION["products"]);
                            header("Location:index.php");
                        }
                        if($_GET["mode"]=="products"){
                            require("showOptions.php");
                            echo "<div id='games'></div>";
                        }
                    }
                ?>
                
        </div>
        
    </div>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark d-flex flex-column">
            <div class="footer">
                Strona została wykonana przez: Maciej Kapera © 2020 Copyright
            </div>
        </nav>
            
    <?php $connect->close(); ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>
</html>