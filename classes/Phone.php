<?php
class Phone
{
    public $user_id;
    public $number;
    public $country_code;
    public $code;
    public $conn;
    public $user_table;
    public function __construct($db){
        $this->conn = $db;
        $this->user_table = "logins";
    }
    public function searchById(){
        $query = "SELECT * FROM ".$this->user_table." WHERE id = " . $this->user_id;
    $result = mysqli_query($this->conn, $query);

    if ($result) {
        return $row = mysqli_fetch_assoc($result);
    }

    return array();
    }
    public function phoneStatus(){
        $query = "UPDATE logins SET
        phone_no_verified_status = '1'
        WHERE id = '$this->user_id'";

    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
    public function code(){
        $query = "UPDATE logins SET
        email_code = '$this->code'
        WHERE id = '$this->user_id'";

    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
}
