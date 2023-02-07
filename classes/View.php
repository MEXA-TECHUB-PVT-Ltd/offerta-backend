<?php
class View
{
    public $id;
    public $user_id;
    public $list_id;
    public $views;
    public $conn;
    public $Listing_table;
    public function __construct($db)
    {
        $this->conn = $db;
        $this->Listing_table = "views";
    }
    public function createView()
    {
        $query2 = "SELECT * FROM ".$this->Listing_table." WHERE user_id=$this->user_id AND listing_id=$this->list_id";
        $result2 = mysqli_query($this->conn, $query2);
        if ($result2) {
            if (mysqli_num_rows($result2) == 0) {
                $query = "INSERT INTO " . $this->Listing_table . " (user_id,listing_id) VALUES 
                ('$this->user_id','$this->list_id')";
                $insert = mysqli_query($this->conn, $query);
                if ($insert) {
                    return true;
                }
            }else{
                return true;
            }

        }
        return false;
    }
    public function getViewOnList(){
        $query = "SELECT * FROM ".$this->Listing_table." WHERE listing_id = $this->id";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $rows = array();
            while ($r = mysqli_fetch_assoc($result)) {
                    $rows[] = $r;
            }
            $total = mysqli_num_rows($result);
            $array = array(
                "viewed"=>$rows,
                "total_views" => $total
            );
            return $array;
        }
    
        return array();
    }
}