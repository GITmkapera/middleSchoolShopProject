
<form action="endOfBuy.php" method="POST">
    <h3>Wybierz rodzaj zamówienia:</h3>
    Klucz Steam <input class="form-control" checked type="radio" name="type" value="steam">
    Wersja pudełkowa - kurier <input class="form-control" type="radio" name="type" value="box">
    <h3>Wybierz sposób zapłaty:</h3>
    Karta bankowa <input class="form-control" checked type="radio" name="payment" id="first">
    Przelew <input class="form-control" type="radio" name="payment" id="second">
    <input type="hidden" name=val value=<?php print $_SESSION["fin"];?>>
    <button type="submit">Zakup</button>
    
</form>