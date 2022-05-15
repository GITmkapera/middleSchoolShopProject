<?php
$se = $_REQUEST["search"];
$so = $_REQUEST["sort"];
$ca = $_REQUEST["category"];



require("../classes/Product.php");
$connect = new mysqli("localhost","root","","db_sklep");
    $promoProduct = Product::getPromotion($connect)->fetch_object();
    $products = Product::getProducts($connect,$se,$so,$ca);
    while($row=$products->fetch_object()){
        echo '<div class="row showP">';
            echo'<div class="col-md-6">';
                echo"<img class='border border-dark' width='300' height='400' src=$row->picture_path alt=$row->title>";
            echo '</div>';
            echo'<div class="col-md-6">';		
                echo"<br><h3>$row->title</h3></p>";
                if($promoProduct->product_id==$row->product_id){
                    echo"<p class='products'><b>Cena: </b> <s>$row->price</s> &#8658 ". 0.75*$row->price ."zł</p><a id=promo></a>"; 
                }else{
                    echo"<p class='products'><b>Cena: </b>$row->price zł</p>"; 
                }                                                                               
                echo"<p class='products'><b>Kategoria:</b> $row->name</p>";
                echo"<p class='products'><b>Opis:</b> $row->description</p>";
                if($row->number_of_products>0){
                    echo "<p class='products'>Produkt dostępny($row->number_of_products)</p><br>";
                    echo "<button id='$row->product_id' class='btn btn-light addToCart'>Dodaj do koszyka</button>";
                }else{
                    echo "<p class='products'>Produkt niedostępny</p><br>";
                    echo "<button disabled=disabled class='btn btn-light'>Dodaj do koszyka</button>";
                }                        
                
            echo '</div>';
        echo '</div><br><br>';
    }
    $connect->close();

?>