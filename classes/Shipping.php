<?php
class Shipping{
    public $id;
    public $user_id;
    public $country;
    public $address_1;
    public $address_2;
    public $city;
    public $state;
    public $zipcode;
    public $phone_no;

    public $conn;
    public $created_at;
    public $shipping;

    public function __construct($db){
        $this->conn = $db;
        $this->shipping = "shipping_addresses";
        $this->created_at = date("Y-m-d h:i");
    }
    public function createShipping(){
        $query = "INSERT INTO ".$this->shipping." (user_id,country,address_1,address_2,city,state,zip_code,phone_no,created_at) VALUES ('$this->user_id','$this->country','$this->address_1','$this->address_2','$this->city','$this->state','$this->zipcode','$this->phone_no','$this->created_at')";
        $insert = mysqli_query($this->conn, $query);
            if($insert){
                return true;
            }
            return false;
        }
        public function checkuser_id(){
    
            $query2 = "SELECT * FROM logins WHERE id = '$this->user_id'";
                $result2 = mysqli_query($this->conn, $query2);
                if(mysqli_num_rows($result2) > 0){
                    return true;
                }
                return false;
        }
    public function updateShipping(){
        $query = "UPDATE ".$this->shipping." SET
        user_id = '$this->user_id',
        country = '$this->country',
        address_1 = '$this->address_1',
        address_2 = '$this->address_2',
        city = '$this->city',
        state = '$this->state',
        zip_code = '$this->zipcode',
        phone_no = '$this->phone_no'
        WHERE id = '$this->id'";

    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
        }
        public function deleteShipping(){
            $delete = "SELECT * FROM ".$this->shipping." WHERE id =".$this->id." ";
            $deleteresult = mysqli_query($this->conn, $delete);
            if (mysqli_num_rows($deleteresult) == 1) {
            $query = "DELETE FROM ".$this->shipping." WHERE id =" . $this->id;
            $upload = mysqli_query($this->conn, $query);
            if($upload){
                return true;
            }}
            return false;
            }
            public function GetUserShipping(){
                $query = "SELECT * FROM ".$this->shipping." WHERE user_id = '$this->user_id'";
                $result = mysqli_query($this->conn, $query);
                if ($result) {
                    $rows = array();
                    while ($r = mysqli_fetch_assoc($result)) {
                            $rows[] = $r;
                        
                    }
                    return $rows;
                }
            
                return array();
            }
            public function GetAllShipping(){
                $query = "SELECT * FROM ".$this->shipping."";
                $result = mysqli_query($this->conn, $query);
                if ($result) {
                    $rows = array();
                    while ($r = mysqli_fetch_assoc($result)) {
                            $rows[] = $r;
                        
                    }
                    return $rows;
                }
            
                return array();
            }

}