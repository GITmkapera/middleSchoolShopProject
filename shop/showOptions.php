<div class='row'>
    <div class="col-4">
        <h3>Sortuj wg</h3>
    </div>
    <div class="col-4">
        <h3>Wyszukaj</h3>
    </div>
    <div class="col-4">
        <h3>Wybierz kategorię</h3>
    </div>
</div>
<div class='row options'>
    <div class="col-4">
        <select class="custom-select" name="sort" id="sort">
            <option value="az">Alfabetycznie: A-Z</option>
            <option value="za">Alfabetycznie: Z-A</option>
            <option value="cr">Cena: rosnąco</option>
            <option value="cm">Cena: malejąco</option>
        </select>
    </div>
    <div class="col-4">
        <?php
            if(isset($_GET['promoLink'])){
                $pl = $_GET['promoLink'];
                echo '<input type="text" id="searchInput" value="'.$pl.'" class="form-control">';
            }
            else echo '<input type="text" id="searchInput" class="form-control">';
        ?>
    </div>
    <div class="col-4">
        <select class="custom-select" name="cat" id="cat">
        <option value="all">Wszystkie</option>
        <?php
            $categories = Product::getCategory($connect);
            while($r=$categories->fetch_object()){
                echo "<option value=$r->category_id>$r->name</option>";
            }
        ?>
        </select>
    </div>
</div><br><br><br>