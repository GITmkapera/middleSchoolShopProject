<?php

class Order
{
    public function __construct($val,$us,$t){
        $this->value=(float)$val;
        $this->user=$us;
        $this->type=$t;
    }

    public function saveOrder($db){
        $u = User::getUser($db,$this->user)->fetch_object();
        $db->query("INSERT INTO orders(date,value,type,user_id) VALUES (CURDATE(),$this->value,'$this->type',$u->user_id)");
        $this->fillDetails($db);
        Cart::removeCart();
        $_SESSION["products"]=0;
        unset($_SESSION["fin"]);
    }
    public static function getOrder($db,$user="%",$id="%"){
        $result = $db->query("SELECT * FROM orders INNER JOIN users USING(user_id) WHERE email LIKE '$user' AND order_id LIKE '$id'");
        return $result;
    }
    public static function getDetails($db,$id){
        $result = $db->query("SELECT * FROM order_detail d INNER JOIN orders o USING(order_id) INNER JOIN products p USING (product_id) WHERE d.order_id='$id'");
        return $result;
    }

    private function fillDetails($db){
        $r = Cart::getCart();
        $o = $db->query("SELECT order_id FROM orders ORDER BY order_id DESC LIMIT 1")->fetch_object();
        foreach($r as $a){
            $num = (int)$_SESSION[$a];
            $id = substr($a,1);
            $id = (int)$id;
            $db->query("INSERT INTO order_detail(product_id,number,order_id) VALUES($id,$num,$o->order_id)");
            $db->query("UPDATE products SET number_of_products=number_of_products-$num WHERE product_id=$id");
        }
    }
}

?>