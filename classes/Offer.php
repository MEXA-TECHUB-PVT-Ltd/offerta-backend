<?php
class offer{
    public $id;
    public $user_id;
    public $sale_by;
    public $listing_id;
    public $price;
    public $status;
    public $conn;
    public $created_at;
    public $Offers;
    public $listing;
    public function __construct($db){
        $this->conn = $db;
        $this->Offers = "offers";
        $this->listing = "listing";
        $this->created_at = date("Y-m-d h:i");
    }
    public function createOffer(){
        $query = "INSERT INTO ".$this->Offers." (user_id,sale_by,listing_id,price,status,created_at) VALUES ('$this->user_id','$this->sale_by','$this->listing_id','$this->price','pending','$this->created_at')";

    $insert = mysqli_query($this->conn, $query);
        if($insert){
            return true;
        }
        return false;
    }
    public function updateOffer(){
        $query = "UPDATE ".$this->Offers." SET
        user_id = '$this->user_id',
        sale_by = '$this->sale_by',
        listing_id = '$this->listing_id',
        price = '$this->price'
        WHERE id =$this->id";

    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
    public function updateStatus(){
        $query = "UPDATE ".$this->Offers." SET
        status = '$this->status'
        WHERE id =$this->id";

    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
    public function deleteOffer(){
        $query = "DELETE FROM ".$this->Offers." WHERE id =" . $this->id;
        $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
    public function getAllOnListId(){
        $query = "SELECT * FROM ".$this->Offers." WHERE listing_id = '$this->id'";
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
    public function getOfferById(){
        $query = "SELECT * FROM ".$this->Offers." WHERE id = '$this->id'";
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
    public function checklisting(){
    
        $query2 = "SELECT * FROM ".$this->listing." WHERE id = '$this->listing_id'";
            $result2 = mysqli_query($this->conn, $query2);
            if(mysqli_num_rows($result2) > 0){
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
    public function checksale_by(){
    
        $query2 = "SELECT * FROM logins WHERE id = '$this->sale_by'";
            $result2 = mysqli_query($this->conn, $query2);
            if(mysqli_num_rows($result2) > 0){
                return true;
            }
            return false;
    }
}