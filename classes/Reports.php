<?php
class Reports{
    public $reported_user_id;
    public $reportedBy_user_id;
    public $conn;
    public $created_at;
    public $reports;
    public function __construct($db){
        $this->conn = $db;
        $this->reports = "reported_users";
        $this->created_at = date("Y-m-d h:i");
    }
    public function createReport(){
        $query = "INSERT INTO ".$this->reports." (reportedBy_user_id,reported_user_id,created_at) VALUES ('$this->reportedBy_user_id','$this->reported_user_id','$this->created_at')";
        $insert = mysqli_query($this->conn, $query);
            if($insert){
                return true;
            }
            return false;
        }

}