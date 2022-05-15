<?php
    class Product
    {
        public function __construct($postTable){
            $this->title = $postTable["title"];
            $this->price = $postTable["price"];
            $this->category_id = $postTable["cat"];
            $this->description = $postTable["description"];
            $this->numberOfProducts = $postTable["num"];
        }
        public static function getCategory(mysqli $db,$name="%"){
            $result = $db->query("SELECT * FROM category WHERE category_id LIKE '$name'");
            return $result;
        }
        public static function getProducts(mysqli $db,$search="%",$sort="az",$cat="all"){
            switch($sort){
                case "az":
                    $sort = "title";
                break;
                case "za":
                    $sort = "title DESC";
                break;
                case "cr":
                    $sort = "price";
                break;
                case "cm":
                    $sort = "price DESC";
                break;
            }
            if($cat=="all") $cat = "%";
            $search = strtolower($search);
            $result = $db->query("SELECT * FROM products INNER JOIN category USING(category_id) WHERE category_id LIKE '$cat' AND LOWER(title) LIKE '%$search%'  ORDER BY $sort");
            return $result;
        }
        public static function getPromotion(mysqli $db){
            $result = $db->query("SELECT p.product_id,date,pr.title,pr.picture_path FROM promotion p,products pr WHERE p.product_id=pr.product_id");
            return $result;
        }
        public static function setPromotion(mysqli $db){
            $daily=$db->query("UPDATE promotion SET product_id=(SELECT product_id FROM products ORDER BY RAND() LIMIT 1 ),date=CURDATE() WHERE promotion_id=1");
        }
        public static function getProduct($db,$id="%"){
            $result = $db->query("SELECT * FROM products WHERE product_id LIKE '$id'");
            return $result;
        }
        public function saveProduct($db,$id="%"){
            $db->query("INSERT INTO products(title,price,category_id,description,number_of_products) 
                                    VALUES ('$this->title',$this->price,$this->category_id,'$this->description',$this->numberOfProducts)");
        }
        public function addPicture($db,$img){
            $result = $db->query("SELECT product_id FROM products WHERE product_id ORDER BY product_id DESC LIMIT 1")->fetch_object();
            
            $pic = "dataBasePics/".$result->product_id.".jpg";
            if($_FILES['pic']["tmp_name"]!=""){
                move_uploaded_file($img['pic']['tmp_name'],"../".$pic);
            }else{
                copy("../files/easterEgg.png", "../".$pic);
            }

            $db->query("UPDATE products SET picture_path='$pic' WHERE product_id=$result->product_id");
        }
        public function editProduct($db,$id="%",$img=""){
            $db->query("UPDATE products SET title='$this->title',price=$this->price,category_id=$this->category_id,description='$this->description',number_of_products=$this->numberOfProducts 
                        WHERE product_id=$id");
            $pic = "dataBasePics/".$id.".jpg";
            if($_FILES['pic']["tmp_name"]!=""){
                if(file_exists("../".$pic)){
                    unlink("../".$pic);
                }
                move_uploaded_file($_FILES['pic']['tmp_name'],"../".$pic);
            }
        }
        public function delProduct($db,$id){
            $db->query("DELETE FROM products WHERE product_id=$id");
        }
    }

?>