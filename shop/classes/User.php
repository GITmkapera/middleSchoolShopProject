<?php

class User
{
    public function __construct($postTable){
        $this->email = $postTable["email"];
        $this->name = $postTable["name"];
        $this->surname = $postTable["surname"];
        $this->address = $postTable["address"];
        $this->houseNumber = $postTable["hnumber"];
        $this->postalCode = $postTable["postal"];
        $this->province_id = $postTable["province"];
        $this->phone = $postTable["phone"];
        $this->password = md5($postTable["password"]);
    }
    public function saveUser($db,$mode=0){
        $db->query("INSERT INTO users(email,name,surname,address,house_number,postal_code,province_id,phone_number,isAdmin,password) VALUES
                    ('$this->email','$this->name','$this->surname','$this->address',$this->houseNumber,'$this->postalCode','$this->province_id','$this->phone',$mode,'$this->password')");
    }
    public function editUser($db,$user,$mode=0){
        $db->query("UPDATE users SET email='$this->email',name='$this->name',surname='$this->surname',address='$this->address',house_number=$this->houseNumber,
                    postal_code='$this->postalCode', province_id='$this->province_id',phone_number='$this->phone', password='$this->password', isAdmin=$mode  WHERE email='$user'");
    }
    public static function delUser($db,$user){
        $db->query("DELETE FROM users WHERE email='$user'");
    }
    public static function checkUser($db,$postTable){
        $mail=$postTable["login"];
        $result = $db->query("SELECT password FROM users WHERE email='$mail'");
        $pass = $result->fetch_object();
        if($pass){
            if($pass->password==md5($postTable["pass"])){
                return 1;
            }else return 0;
        }else return 0;  
    }
    public function checkEmail($db){
        $result = $db->query("SELECT email FROM users WHERE email='$this->email'");
        if($result->num_rows==0) return 1;
        else return 0;
    }
    public static function isAdmin($db,$user){
        $result = $db->query("SELECT isAdmin FROM users WHERE email='$user'");
        $ia = $result->fetch_object();
        return $ia->isAdmin;
    }
    public static function getProvince($db,$prov="brak"){
        $result = $db->query("SELECT * FROM province");
        while($r = $result->fetch_object()){
            if($r->province_id==$prov) echo "<option selected value=$r->province_id>$r->province</option>";
            else  echo "<option value=$r->province_id>$r->province </option>";
        }
    }
    public static function getUser($db,$mail="%"){
        $result = $db->query("SELECT * FROM users INNER JOIN province USING(province_id) WHERE email LIKE '$mail'");
        return $result;
    }
}

?>