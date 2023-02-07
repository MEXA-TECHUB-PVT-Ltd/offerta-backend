<?php
class SaleOrder{
    public $id;
    public $user_id;
    public $sale_by;
    public $order_by;
    public $shipping_id;
    public $listing_id;
    public $listing;
    public $conn;
    public $created_at;
    public $order;
    public function __construct($db){
        $this->conn = $db;
        $this->order = "sale_order";
        $this->listing = "listing";
        $this->created_at = date("Y-m-d h:i");
    }

    public function createOrder(){
        $query = "INSERT INTO ".$this->order." (sale_by,order_by,listing_id,shipping_id,created_at) VALUES ('$this->sale_by','$this->order_by','$this->listing_id','$this->shipping_id','$this->created_at')";

       $insert = mysqli_query($this->conn, $query);
        if($insert){
            return true;
        }
        return false;
    }
    public function myOrders(){
        $query = "SELECT * FROM ".$this->order." WHERE order_by = '$this->user_id'";
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
    public function mySales(){
        $query = "SELECT * FROM ".$this->order." WHERE sale_by = '$this->user_id'";
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
    public function selectAllOrder(){
        $query = "SELECT * FROM ".$this->order." ";
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
    public function TotalCity(){
        
        $query = "SELECT * FROM ".$this->order." WHERE listing_id= $this->listing_id";
        $result = mysqli_query($this->conn, $query);

    if ($result) {
            $total = mysqli_num_rows($result);
            $rows = array();
        while($data=mysqli_fetch_assoc($result)){
                $shipping_id = $data["shipping_id"];
                // city
                $query2 = "SELECT * FROM shipping_addresses WHERE id = $shipping_id";
                $result2 = mysqli_query($this->conn, $query2);
                $data2 = mysqli_fetch_assoc($result2);
                $city = $data2["city"];
                $rows[] = $city;

                
        }
            $array = array(
                "total_visted_city"=>"$total",
                "visted_cities"=>$rows
            );
            return $array;
    }

    return array();
    }
}
