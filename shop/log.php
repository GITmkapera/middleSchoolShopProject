<div class=" offset-sm-3 miniform">
    <p class="fat">Logowanie</p>
    <form method="POST" action="index.php?mode=log">
    <div class="row">
        <div class="col">
        <input type="text" name="login" class="form-control" placeholder="Email">
        <input type="hidden" name="logUser">
        </div>
    </div><br>
    <div class="row">
        <div class="col">
        <input type="password"  name="pass"  class="form-control" placeholder="Hasło">
        </div>
    </div><br>
    <div class="row">
        <div class="col">
        <input type="submit" class="form-control" value="Zaloguj">
        </div>
    </div>
    </form>
</div>