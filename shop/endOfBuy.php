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
        require_once("classes/Order.php");
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
            <h2>Dziękujemy za zamówienie!</h2><br>
            (Wcześniej powinno nastąpić przekierowanie do strony związanej z płatnością lub okazanie informacji do przelewu. Jest to oczywiście nieobecne ze względu, iż jest to tylko projekt szkolny)
            <?php
                $order = new Order($_POST["val"],$_SESSION["user"],$_POST["type"]);
                $order->saveOrder($connect);
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