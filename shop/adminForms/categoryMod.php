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
        require_once("../classes/Category.php");
        //error_reporting(0);
        session_start();

        $connect = new mysqli("localhost","root","","db_sklep");
        $cats = Category::getCategory($connect,$_POST["obj"])->fetch_object();
    ?>
    <div class="container">
        <div class="main">
            <!-------------------------------------------------------------------------------------------------------------------------------------->
                <form id="regForm1" style="display:<?php if($_POST["action"]!="add") echo 'none'?>" method="POST" action="addCategory.php">
                <h1>Dodaj kategorię</h1><br>
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">
                        <input type="text" id="name1" name="name" class="form-control" placeholder="Nazwa kategorii">
                    </div>
                    
                </div><br>
                    <div class="col-sm-4 offset-sm-4">
                        <button class="form-control" type="submit">Dodaj</button>
                    </div>
                </form>
            <!-------------------------------------------------------------------------------------------------------------------------------------->
                <form id="regForm2" style="display:<?php if($_POST["action"]!="mod") echo 'none'?>" method="POST" action="editCategory.php">
                <h1>Edytuj kategorię</h1><br>
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">
                        <input type="text" id="name2" value='<?php echo "$cats->name" ?>' name="name" class="form-control" placeholder="Nazwa kategorii">
                        <input type="hidden" value='<?php echo $_POST['obj'] ?>' name="mod">
                    </div>
                    </div><br>
                    <div class="col-sm-4 offset-sm-4">
                        <button class="form-control" type="submit">Zapisz</button>
                    </div>
                </form>
            <?php
                if($_POST["action"]=="del"){
                    echo "<h2>Usunięto kategorię!</h2>";
                    Category::delCategory($connect,$_POST["obj"]);
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
        var inp1=document.querySelector("#name1");
        var form2=document.querySelector("#regForm2");
        var inp2=document.querySelector("#name2");
        form1.addEventListener("submit",val);
        form2.addEventListener("submit",val);
        
        function val(){
            event.preventDefault();
            if(inp1.value!="" || inp2.value!="") event.target.submit();
            else alert("Kategoria musi mieć nazwę!");
        }
    </script>
</body>
</html>

