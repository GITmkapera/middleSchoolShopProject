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
        require_once("classes/User.php");
        require_once("classes/Product.php");
        require_once("classes/Cart.php");
        error_reporting(0);
        session_start();

        $connect = new mysqli("localhost","root","","db_sklep");
    ?>
    
    <header>
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php"><img src="files/logo_white.png" alt="MK" width="60" height="60">games.pl</a>
            <span class="navbar-brand"><a class="navbar-brand" href="index.php"> Powrót</a></span>  
        </nav>
    </header>
    <div class="container">
        <div class="main">
            <?php
            $promoProduct = Product::getPromotion($connect)->fetch_object();
            if(isset($_SESSION["productsList"])) $products = Cart::getCart();
            

            if(isset($_GET["del"])){
                $_SESSION["products"] -= $_SESSION[$_GET["del"]];
                unset($_SESSION[$_GET["del"]]);
                Cart::unsetItem($_GET["del"]);
                header("Location:orderSite.php");
            }
            if(isset($_GET["final"])){
                if(!isset($_SESSION["fin"])) $_SESSION["fin"] = $_GET["final"];
                print "<h3>Podsumowanie</h3><br>";               
                    foreach($products as $a){
                        $sess = $_SESSION[$a];
                        $product = Product::getProduct($connect,substr($a,1));
                        $row=$product->fetch_object();
                        if($row->product_id==$promoProduct->product_id) $row->price*=0.75;
                        echo '<div class="row">';
                            echo'<div class="col-md-3 offset-md-3">';		
                                echo"$row->title</p>";                      
                            echo '</div>';
                            echo'<div class="col-md-3">';		
                                echo"x$sess</p>";                      
                            echo '</div>';
                        echo '</div>';
                    }
                    echo '<div class="row">';
                        echo'<div class="col-md-3 offset-md-3">';		
                            echo"Razem do zapłaty: </p>";                      
                        echo '</div>';
                        echo'<div class="col-md-3">';		
                            echo $_GET["final"]."</p>";
                        echo '</div>';
                    echo '</div><br>';

                print "<h3>Dane do faktury/wysyłki:</h3><br>"; 
                $user = User::getUser($connect,$_SESSION["user"]);
                while($r=$user->fetch_object()){
                    echo '<div class="row">';
                        echo'<div class="col-md-3 offset-md-3">';		
                            echo "<b>Imię:</b> $r->name";                      
                        echo '</div>';
                        echo'<div class="col-md-3">';		
                            echo "<b>Nazwisko: </b> $r->surname";                      
                        echo '</div>';
                    echo '</div><br>';
                    echo '<div class="row">';
                        echo'<div class="col-md-3 offset-md-3">';		
                            echo "<b>Adres: </b>$r->address";                      
                        echo '</div>';
                        echo'<div class="col-md-3">';		
                            echo "<b>Numer domu: </b>$r->house_number";                      
                        echo '</div>';
                    echo '</div><br>';
                    echo '<div class="row">';
                        echo'<div class="col-md-3 offset-md-3">';		
                            echo "<b>Kod pocztowy: </b>$r->postal_code";                      
                        echo '</div>';
                        echo'<div class="col-md-3">';		
                            echo "<b>Województwo: </b>$r->province";                      
                        echo '</div>';
                    echo '</div><br>';
                    echo '<div class="row">';
                        echo'<div class="col-md-3 offset-md-3">';		
                            echo "<b>Numer telefony: </b>$r->phone_number";                      
                        echo '</div>';
                        echo'<div class="col-md-3">';		
                            echo "<b>Email: </b>$r->email";                      
                        echo '</div>';
                    echo '</div><br>';
                }
                include("buy.php");
            }
            else{
                if($_SESSION["products"]!=0){
                    echo '<div class="row">';
                            echo'<div class="col-md-2">';
                                echo"<b>Zdjęcie</b></p>";
                            echo '</div>';
                            echo'<div class="col-md-2">';		
                                echo"<b>Tytuł</b></p>";                      
                            echo '</div>';
                            echo'<div class="col-md-2">';		
                                echo"<b>Ilość</b></p>";                      
                            echo '</div>';
                            echo'<div class="col-md-2">';		
                                echo"<b>Cena</b></p>";                      
                            echo '</div>';
                            echo'<div class="col-md-2">';		
                                echo"</p>";                      
                            echo '</div>';
                        echo '</div><br>';                   
                    foreach($products as $a){
                        $sess = $_SESSION[$a];
                        $product = Product::getProduct($connect,substr($a,1));
                        $row=$product->fetch_object();
                        if($row->product_id==$promoProduct->product_id) $row->price*=0.75;
                        echo '<div class="row">';
                            echo'<div class="col-md-2">';
                                echo"<img class='border border-dark' width='100' height='120' src=$row->picture_path alt=$row->title>";
                            echo '</div>';
                            echo'<div class="col-md-2">';		
                                echo"<br><br>$row->title</p>";                      
                            echo '</div>';
                            echo'<div id='.$a.' class="col-md-2">';		
                                echo"<br><br><input id='i$row->price' class='priceInput' type='number' min=1 max=$row->number_of_products style='width:50px' value=$sess></p>";                      
                            echo '</div>';
                            echo'<div class="col-md-2">';		
                                echo"<br><br><span class=priceSpan>".$row->price*$_SESSION[$a]."</span> zł</p>";                      
                            echo '</div>';
                            echo'<div class="col-md-2">';		
                                echo"<br><br><a href=orderSite.php?del=".$a."><button class='btn btn-light addToCart'>Usuń</button></a></p>";                      
                            echo '</div>';
                        echo '</div><br><br>';
                    }
                    echo '<div class="row">';
                            echo'<div class="col-md-2 offset-md-4">';
                                echo"<h3>Razem:</h3></p>";
                            echo '</div>';
                            echo'<div class="col-md-2">';		
                                echo"<b><span id='sum'></span></b></p>";                      
                            echo '</div>';
                            echo'<div class="col-md-2">';		
                                echo"<a id='all'><button class='btn btn-light addToCart'>Finalizacja</button></a></p>";                      
                            echo '</div>';
                        echo '</div>';
                }else print "<h3>Koszyk jest pusty!</h3>";
            }

            ?>
        </div>
        
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark d-flex flex-column">
        <div class="footer">
            Strona została wykonana przez: Maciej Kapera © 2020 Copyright
        </div>
    </nav>
    <?php
        $connect->close();
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
    <script>
        var pi = document.getElementsByClassName("priceInput");
        for(b of pi){
            b.addEventListener("change",ajaxBuy);
            b.addEventListener("keydown",function(){
                reg = /\D/;
                if(reg.test(event.key)&&event.key!="Backspace"&&event.key!="ArrowLeft"&&event.key!="ArrowRight"){
                    event.preventDefault();
                }
            });
            b.addEventListener("keyup",function(){
                if(parseInt(this.value)>parseInt(this.max)) this.value = this.max;
                if(this.value=="") this.value = 1;
            });
            b.addEventListener("keyup",ajaxBuy);
        }
        var ps = document.querySelectorAll(".priceSpan");
        var sum = document.querySelector("#sum");
        var all = document.querySelector("#all");
        
        var wholePrice = 0;
        for(c of ps){
            wholePrice+=parseFloat(c.innerHTML);
        }
        sum.innerHTML=wholePrice+" zł";
        all.href="orderSite.php?final="+wholePrice;
        console.log(all);

        function ajaxBuy(){
            var spanPrice = this.offsetParent.nextSibling.childNodes[2];
            var singlePrice = this.id.replace("i","");
            var newPrice = parseFloat(this.value)*parseFloat(singlePrice);

            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){  
                    spanPrice.innerHTML=newPrice;
                    wholePrice = 0;
                    for(c of ps){
                        wholePrice+=parseFloat(c.innerHTML);
                    }
                    sum.innerHTML=wholePrice+" zł";
                    all.href="orderSite.php?final="+sum.innerHTML;
                }
            }
            
            var wholeProd = 0;
            for(b of pi){
                wholeProd += parseInt(b.value);
            }
            xhr.open("GET","ajax/ajaxBuy.php?id="+this.offsetParent.id+"&value="+this.value+"&whole="+wholeProd,true);
            xhr.send();
        }
    </script>
</body>
</html>