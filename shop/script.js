document.addEventListener("DOMContentLoaded",function(){
    
    ///////////////////////////////////// AJAX //////////////////////////////////////////
    
    srch = document.getElementById("searchInput");
    sor = document.getElementById("sort");
    categ = document.getElementById("cat");

    srch.addEventListener("keyup",ajaxProducts);
    sor.addEventListener("change",ajaxProducts);
    categ.addEventListener("change",ajaxProducts);
    ajaxProducts();

    function ajaxProducts(){
        search = document.getElementById("searchInput").value;
        sort = document.getElementById("sort").value;
        cat = document.getElementById("cat").value;
        gamesDiv= document.getElementById("games");
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                if(this.responseText!="") gamesDiv.innerHTML=this.responseText;
                else gamesDiv.innerHTML="Brak produktów o takich wymaganiach";

                cart = document.getElementsByClassName("addToCart");
                for(a of cart){
                    a.addEventListener("click",ajaxCart);
                }
            }
        }
        if(search=="") search="%%";
        xhr.open("GET","ajax/ajaxProd.php?search="+search+"&sort="+sort+"&category="+cat,true);
        xhr.send();    
    }
     
    function ajaxCart(){   
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                ajaxProducts();
                if(this.responseText=="LogNeeded") alert("Tylko zalogowani użytkownicy mogą kupować produkty!");
                cartSpan = document.getElementById("cartCounter");
                cartSpan.innerHTML=parseInt(cartSpan.innerHTML)+1;
            }
        }
        xhr.open("GET","ajax/ajaxCart.php?id="+this.id,true);
        xhr.send();    
    }

/////////////////////////////////////////////////////////////////////////////////////////

});