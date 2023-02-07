<?php
class Sort{
    public $id;
    public $feature;

    public $conn;
    public $Promtion;
    public $Features;
    public function __construct($db){
        $this->conn = $db;
        $this->Promtion = "promotions";
        $this->Features = "features";
    }
    public function Sort(){
            $rows = array();
                # code...
                $query2 = "SELECT * FROM ".$this->Promtion." WHERE features_id = '$this->id'";
                $result2 = mysqli_query($this->conn, $query2);
                if ($result2) {
                    while ($r2 = mysqli_fetch_assoc($result2)) {
                    $rows[] = $r2;
            }
            return $rows;
        }
    
    return array();
}
}
