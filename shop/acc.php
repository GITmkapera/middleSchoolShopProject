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
        require_once("classes/Order.php");
        //error_reporting(0);
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
                if(isset($_SESSION['isLog'])){
                    if(!isset($_GET["mode"])){
                        echo "<div class='row'>";
                            echo "<div class='col-md-6'>";
                                echo "<h2>Dane konta: </h2>";
                                echo "<div class='row'>";
                                    echo "<div class='col-md-12'>";
                                        $userData = User::getUser($connect,$_SESSION["user"])->fetch_object();
                                        $all = User::getUser($connect);
                                        include("regEdit.php");
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                            echo "<div class='col-md-6'>";
                                echo "<h2>Zamówienia: </h2>";
                                echo "<div class='row'>";
                                    echo "<div class='col-md-12'>";
                                        $ord = Order::getOrder($connect,$_SESSION['user']);
                                        while($r=$ord->fetch_object()){
                                            echo "Zamówienie nr $r->order_id - $r->date <a href=acc.php?mode=info&value=$r->order_id >szczegóły</a><br>";
                                        }
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div><br>";
                    }else{
                        if($_GET["mode"]=="info"){
                            $ord = Order::getOrder($connect,$_SESSION['user'],$_GET["value"])->fetch_object();
                            echo "<h3>Zamówienie nr $ord->order_id</h3><br>";
                            echo "Data złożenia: $ord->date <br>";
                            echo "Wartość: $ord->value zł<br>";
                            echo "Typ: $ord->type<br>";
                            echo "Produkty:<br>";
                            $details = Order::getDetails($connect,$_GET["value"]);
                            while($r=$details->fetch_object()){
                                echo "$r->title x$r->number ";
                                if($ord->type=="steam") echo "Klucz:<b> ".md5($r->number)."</b>";
                                else echo "<br>Stan: Wysłane";
                                echo "<br>";
                            }
                        }
                        else if($_GET["mode"]=="change"){
                            $mod = new User($_POST);
                            $mod->editUser($connect,$_SESSION["user"]);
                            header("Location:index.php?mode=logout");
                        }
                    }
                }
                else{
                    if(isset($_GET['mode'])){
                        if($_GET['mode']="add"){
                            $user = new User($_POST);
                            $res = $user->checkEmail($connect);
                            if($res==1) $user->saveUser($connect);
                            header("Location:acc.php?correct=".$res);
                        }
                    }else if(isset($_GET['correct'])){
                        if($_GET['correct']==1){
                            echo "<p class='fat'>Rejestracja powiodła się!</p>";
                            echo "<a style='font-size: 30px; color: white' href=index.php?mode=log>Zaloguj</a>";
                        }else{
                            echo "<p class='fat'>Istnieje konto o takim emailu!</p>";
                        }
                        
                    }
                    else{
                        echo "<p class='fat'>Rejestracja</p>";
                        include("reg.php");
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
    <?php
        $connect->close();
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>