<?php
class Cart
{
    public static function unsetItem($item){
        $ui = Cart::getCart();
        $tmp = "";
        foreach($ui as $t){
            if($t!=$item){
                $tmp.=$t.",";
            }
        }
        if($tmp=="") unset($_SESSION["productsList"]);
        else $_SESSION["productsList"] = $tmp;
    }
    public static function getCart(){           
        $tmp = explode(",",substr($_SESSION['productsList'],0,-1));
        return $tmp;
    }
    public static function removeCart(){
        $rm = Cart::getCart();
        foreach($rm as $a){
            unset($_SESSION[$a]);
        }
        unset($_SESSION['productsList']);
    }
}

?>