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
    <a href="index.php">Powrót</a>
    <?php
        require_once("classes/User.php");
        require_once("classes/Product.php");
        require_once("classes/Order.php");
        require_once("classes/Category.php");
        error_reporting(0);
        session_start();

        $connect = new mysqli("localhost","root","","db_sklep");
    ?>
    <div class="container">
        <div class="main">
            <div class="row">
                <div class="col-md-4">
                    <div class="col-md-12">
                    <h1>Zarządzaj użytkownikiem</h1><br>
                        <form action="adminForms/userMod.php" method="post">
                            <select id="actionU" class="form-control" name="action">
                                <option value="add">Dodaj</option>
                                <option value="mod">Edytuj</option>
                                <option value="del">Usuń</option>
                            </select><br>
                            <select id="showU" style="display: none" class="form-control" name="obj">
                            <?php 
                                $users = User::getUser($connect);
                                while($row=$users->fetch_object()){
                                    echo "<option value=$row->email>$row->email</option>";
                                }
                            ?>
                            </select><br>
                            <div class="col-md-6 offset-md-3">
                                <button class="form-control" type="submit">Przejdź</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-12">
                    <h1>Zarządzaj produktem</h1><br>
                        <form action="adminForms/productMod.php" method="post">
                            <select id="actionP" class="form-control" name="action">
                                <option value="add">Dodaj</option>
                                <option value="mod">Edytuj</option>
                                <option value="del">Usuń</option>
                            </select><br>
                            <select id="showP" style="display: none" class="form-control" name="obj">
                            <?php 
                                $prod = Product::getProduct($connect);
                                while($row=$prod->fetch_object()){
                                    echo "<option value=$row->product_id>$row->title</option>";
                                }
                            ?>
                            </select><br>
                            <div class="col-md-6 offset-md-3">
                                <button class="form-control" type="submit">Przejdź</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-12">
                    <h1>Zarządzaj kategorią</h1><br>
                        <form action="adminForms/categoryMod.php" method="post">
                            <select id="actionC" class="form-control" name="action">
                                <option value="add">Dodaj</option>
                                <option value="mod">Edytuj</option>
                                <option value="del">Usuń</option>
                            </select><br>
                            <select id="showC" style="display: none" class="form-control" name="obj">
                            <?php 
                                $cat = Category::getCategory($connect);
                                while($row=$cat->fetch_object()){
                                    echo "<option value=$row->category_id>$row->name</option>";
                                }
                            ?>
                            </select><br>
                            <div class="col-md-6 offset-md-3">
                                <button class="form-control" type="submit">Przejdź</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php
        $connect->close();
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

<script>
    selU = document.querySelector("#showU");
    selUser = document.querySelector("#actionU");
    selUser.addEventListener("change",function(){
        if(this.value=="add"){
            selU.style.display="none";
        }
        else selU.style.display="block";
    })
    selP = document.querySelector("#showP");
    selProd = document.querySelector("#actionP");
    selProd.addEventListener("change",function(){
        if(this.value=="add"){
            selP.style.display="none";
        }
        else selP.style.display="block";
    })
    selC = document.querySelector("#showC");
    selCat = document.querySelector("#actionC");
    selCat.addEventListener("change",function(){
        if(this.value=="add"){
            selC.style.display="none";
        }
        else if(this.value=="del"){
            alert("UWAGA! Usuwając kategorię usuniesz też wszystkie produkty o tej kategorii!!!");
            selC.style.display="block";
        }
        else selC.style.display="block";
    })

</script>