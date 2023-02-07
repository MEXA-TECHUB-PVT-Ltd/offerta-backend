<?php
class Exchange{
    public $id;
    public $user_id;
    public $second_user;
    public $item;
    public $item2;
    public $status;
    public $conn;
    public $created_at;
    public $exchange_table;
    public function __construct($db){
        $this->conn = $db;
        $this->exchange_table = "exchange";
        $this->created_at = date("Y-m-d h:i");
    }
    public function createExchange(){
        $query = "INSERT INTO ".$this->exchange_table." (user_id,second_user,item,item2,status,created_at) VALUES ('$this->user_id','$this->second_user','$this->item','$this->item2','outgoing','$this->created_at')";

    $insert = mysqli_query($this->conn, $query);
        if($insert){
            return true;
        }
        return false;
    }

    public function updateExchange(){
        $query = "UPDATE ".$this->exchange_table." SET
        user_id = '$this->user_id',
        second_user = '$this->second_user',
        item = '$this->item',
        item2 = '$this->item2',
        status = '$this->status'
        WHERE id =$this->id";

    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }

    public function totalExchanges(){
        $query = "SELECT * FROM exchange WHERE status ='success'";
    $result = mysqli_query($this->conn, $query);
        return mysqli_num_rows($result);
    }

    public function checkuser_id(){
    
        $query2 = "SELECT * FROM logins WHERE id = '$this->user_id'";
            $result2 = mysqli_query($this->conn, $query2);
            if(mysqli_num_rows($result2) > 0){
                return true;
            }
            return false;
    }
    public function checksecond_user(){
    
        $query2 = "SELECT * FROM logins WHERE id = '$this->second_user'";
            $result2 = mysqli_query($this->conn, $query2);
            if(mysqli_num_rows($result2) > 0){
                return true;
            }
            return false;
    }
    public function checkitem(){
    
        $query2 = "SELECT * FROM listing WHERE id = '$this->item'";
            $result2 = mysqli_query($this->conn, $query2);
            if(mysqli_num_rows($result2) > 0){
                return true;
            }
            return false;
    }
    public function checkitem2(){
    
        $query2 = "SELECT * FROM listing WHERE id = '$this->item2'";
            $result2 = mysqli_query($this->conn, $query2);
            if(mysqli_num_rows($result2) > 0){
                return true;
            }
            return false;
    }
    public function GetUserExchangeOutgoing(){
        $query = "SELECT * FROM ".$this->exchange_table." WHERE user_id = '$this->user_id' AND status = 'outgoing'";
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
    public function GetUserExchangeIncoming(){
        $query = "SELECT * FROM ".$this->exchange_table." WHERE user_id = '$this->user_id' AND status = 'incoming'";
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
    public function GetUserExchangeSuccess(){
        $query = "SELECT * FROM ".$this->exchange_table." WHERE user_id = '$this->user_id' AND status = 'success'";
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
    public function GetUserExchangeFailed(){
        $query = "SELECT * FROM ".$this->exchange_table." WHERE user_id = '$this->user_id' AND status = 'failed'";
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
