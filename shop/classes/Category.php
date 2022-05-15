<?php

    class Category
    {
        public function __construct($name){
            $this->name=$name["name"];
        }
        public function saveCategory($db){
            $db->query("INSERT INTO category(name) VALUES ('$this->name')");
        }
        public function editCategory($db,$id){
            $db->query("UPDATE category SET name='$this->name' WHERE category_id=$id");
        }
        public static function delCategory($db,$id){
            $db->query("DELETE FROM category WHERE category_id='$id'");
        }
        public static function getCategory($db,$id="%"){
            $result = $db->query("SELECT * FROM category WHERE category_id LIKE '$id'");
            return $result;
        }
    }

?>