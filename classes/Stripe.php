<?php
class Stripe{
    public $id;
    public $user_id;
    public $private_key;
    public $public_key;
    public $conn;
    public $created_at;
    public $stripe_table;
    public function __construct($db){
        $this->conn = $db;
        $this->stripe_table = "stripe_credentials";
        $this->created_at = date("Y-m-d h:i");
    }
    public function createStripe(){
        $query = "INSERT INTO ".$this->stripe_table." (user_id,private_key,public_key,created_at) VALUES ('$this->user_id','$this->private_key','$this->public_key','$this->created_at')";

    $insert = mysqli_query($this->conn, $query);
        if($insert){
            return true;
        }
        return false;
    }
    public function deleteStrip(){
        $delete = "SELECT * FROM ".$this->stripe_table." WHERE id =".$this->id." ";
        $deleteresult = mysqli_query($this->conn, $delete);
        if (mysqli_num_rows($deleteresult) == 1) {
            # code...
            $query = "DELETE FROM ".$this->stripe_table." WHERE id =".$this->id;
            $upload = mysqli_query($this->conn, $query);
            if($upload){
                return true;
            }
        }

        return false;
    }
    public function keys(){
        $query = "SELECT * FROM admin ";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
           return mysqli_fetch_assoc($result);
        }
        return array();
    }
    public function selectAllStripe(){
        $query = "SELECT stripe_credentials.id,stripe_credentials.private_key,stripe_credentials.public_key,logins.full_name FROM stripe_credentials LEFT JOIN logins ON stripe_credentials.user_id = logins.id ";
        
        $result = mysqli_query($this->conn, $query);

        if ($result) {
            // $r = mysqli_fetch_assoc($result);
            $rows = array();
            while ($r = mysqli_fetch_array($result)) {
                    $rows[] = $r;
                
            }
            return $rows;
        }

    return array();
    }
    public function getstripByUserId(){
        $query = "SELECT * FROM stripe_credentials WHERE user_id =".$this->user_id;
        
        $result = mysqli_query($this->conn, $query);

        if ($result) {
            // $r = mysqli_fetch_assoc($result);
            $rows = array();
            while ($r = mysqli_fetch_assoc($result)) {
                    $rows[] = $r;
                
            }
            return $rows;
        }

    return array();
    }
}