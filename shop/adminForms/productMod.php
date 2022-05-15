<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MKgames</title>
    <link rel="shortcut icon" href="../files/logo_black.png">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php
        require_once("../classes/Product.php");
        //error_reporting(0);
        session_start();

        $connect = new mysqli("localhost","root","","db_sklep");
        $prod = Product::getProduct($connect,$_POST["obj"])->fetch_object();
        $cats = Product::getCategory($connect);
    ?>
    <div class="container">
        <div class="main">
            <!-------------------------------------------------------------------------------------------------------------------------------------->
                <form id="regForm1" style="display:<?php if($_POST["action"]!="add") echo 'none'?>" method="POST" action="addProduct.php" enctype="multipart/form-data">
                <h1>Dodaj produkt</h1><br>
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">
                        <input type="text" id="title" name="title" class="form-control" placeholder="Tytuł">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">
                        <input type="text" id="price" name="price" class="form-control" placeholder="Cena">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">
                        <input type="text" id="description" name="description" class="form-control" placeholder="Opis">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">
                        <input type="text" id="num" name="num" class="form-control" placeholder="Ilość">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">
                        <select class="form-control" name="cat" id="cat">
                            <?php 
                                while($row=$cats->fetch_object()){
                                    echo "<option value='$row->category_id'>$row->name</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">
                        <input class="form-control" type="file" name="pic" accept="image/*" id="pic">
                    </div>
                </div><br>
                    <div class="col-sm-4 offset-sm-4">
                        <button class="form-control" type="submit">Dodaj</button>
                    </div>
                </form>
            <!-------------------------------------------------------------------------------------------------------------------------------------->
                <form id="regForm2" style="display:<?php if($_POST["action"]!="mod") echo 'none'?>" method="POST" action="editProduct.php" enctype="multipart/form-data">
                <h1>Edytuj produkt</h1><br>
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">Tytuł
                        <input type="text" id="title2" value='<?php echo "$prod->title" ?>' name="title" class="form-control" placeholder="Tytuł">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">Cena
                        <input type="text" id="price2" value=<?php echo "$prod->price" ?> name="price" class="form-control" placeholder="Cena">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">Opis
                        <input type="textarea" id="description2" value='<?php print "$prod->description" ?>' name="description" class="form-control" placeholder="Opis">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">Ilość
                        <input type="text" id="num2" value=<?php print "$prod->number_of_products" ?> name="num" class="form-control" placeholder="Ilość">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">Kategoria
                        <select class="form-control" name="cat" id="cat2">
                            <?php 
                            $cats = Product::getCategory($connect);
                                while($r=$cats->fetch_object()){
                                    if($prod->category_id==$r->category_id)
                                        echo "<option selected value='$r->category_id'>$r->name</option>";
                                    else echo "<option value='$r->category_id'>$r->name</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">Zdjęcie
                        <input class="form-control" type="file" name="pic" accept="image/*" id="pic2">
                    </div>
                </div><br>
                    <div class="col-sm-4 offset-sm-4">
                        <input type="hidden" name="mod" value=<?php echo $_POST["obj"]; ?>>
                        <button class="form-control" type="submit">Zapisz</button>
                    </div>
                </form>
            <?php
                if($_POST["action"]=="del"){
                    echo "<h2>Usunięto produkt!</h2>";
                    Product::delProduct($connect,$_POST["obj"]);
                }
                $connect->close();
            ?>
        </div>
    </div>

    

    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
    <script>
        var form1=document.querySelector("#regForm1");
        var form2=document.querySelector("#regForm2");
        form1.addEventListener("submit",val1);
        form2.addEventListener("submit",val2);
        function val1(){
            event.preventDefault();
            while(true){
                inp1 = document.querySelector("#title").value;
                if(inp1==""){
                    alert("Gra musi posiadać tytuł!");
                    break;
                }
                inp1 = document.querySelector("#price").value;
                reg = /\d/;
                if(inp1==""){
                    alert("Gra musi mieć cenę!");
                    break;
                }
                if(!reg.test(inp1)){
                    alert("Cena musi być liczbą!");
                    break;
                }
                inp1 = document.querySelector("#description").value;
                if(inp1==""){
                    alert("Gra nie może mieć pustego opisu!");
                    break;
                }
                inp1 = document.querySelector("#num").value;
                reg = /\d/;
                if(inp1==""){
                    alert("Jeśli jest brak produktów, proszę wpisać 0!");
                    break;
                }
                if(!reg.test(inp1)){
                    alert("Ilość musi być liczbą!");
                    break;
                }
                event.target.submit();
                break;
            }
        }
        function val2(){
            event.preventDefault();
            while(true){
                inp2 = document.querySelector("#title2").value;
                if(inp2==""){
                    alert("Gra musi posiadać tytuł!");
                    break;
                }
                inp2 = document.querySelector("#price2").value;
                reg = /\d/;
                if(inp2==""){
                    alert("Gra musi mieć cenę!");
                    break;
                }
                if(!reg.test(inp2)){
                    alert("Cena musi być liczbą!");
                    break;
                }
                inp2 = document.querySelector("#description2").value;
                if(inp2==""){
                    alert("Gra nie może mieć pustego opisu!");
                    break;
                }
                inp2 = document.querySelector("#num2").value;
                reg = /\d/;
                if(inp2==""){
                    alert("Jeśli jest brak produktów, proszę wpisać 0!");
                    break;
                }
                if(!reg.test(inp2)){
                    alert("Ilość musi być liczbą!");
                    break;
                }
                event.target.submit();
                break;
            }
        }
    </script>
</body>
</html>

