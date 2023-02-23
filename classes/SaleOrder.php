<?php
class SaleOrder{
    public $id;
    public $user_id;
    public $sale_by;
    public $order_by;
    public $shipping_id;
    public $listing_id;
    public $listing;
    public $status;
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
        $query = "INSERT INTO ".$this->order." (sale_by,order_by,listing_id,shipping_id,status,created_at) VALUES ('$this->sale_by','$this->order_by','$this->listing_id','$this->shipping_id','pending','$this->created_at')";

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
                $order_by=$r["order_by"];
                $user_data=$this->users($order_by);
                $saller=$r["sale_by"];
                $seller_data=$this->users($saller);
                $listing=$r["listing_id"];
                $listing_data=$this->listing($listing);
                $shipping_id=$r["shipping_id"];
                $query2 = "SELECT * FROM shipping_addresses WHERE id = '$shipping_id'";
                $result2 = mysqli_query($this->conn, $query2);
                $r2 = mysqli_fetch_assoc($result2);
                    $rows[] = array(
                        "order_by"=>$user_data,
                        "sale_by"=>$seller_data,
                        "listing"=>$listing_data,
                        "shipping_address"=>$r2
                    );

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
                $order_by=$r["order_by"];
                $user_data=$this->users($order_by);
                $saller=$r["sale_by"];
                $seller_data=$this->users($saller);
                $listing=$r["listing_id"];
                $listing_data=$this->listing($listing);
                $shipping_id=$r["shipping_id"];
                $query2 = "SELECT * FROM shipping_addresses WHERE id = '$shipping_id'";
                $result2 = mysqli_query($this->conn, $query2);
                $r2 = mysqli_fetch_assoc($result2);
                    $rows[] = array(
                        "order_by"=>$user_data,
                        "sale_by"=>$seller_data,
                        "listing"=>$listing_data,
                        "shipping_address"=>$r2
                    );

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
            $order_by=$r["order_by"];
            $user_data=$this->users($order_by);
            $saller=$r["sale_by"];
            $seller_data=$this->users($saller);
            $listing=$r["listing_id"];
            $listing_data=$this->listing($listing);
            $shipping_id=$r["shipping_id"];
            $query2 = "SELECT * FROM shipping_addresses WHERE id = '$shipping_id'";
            $result2 = mysqli_query($this->conn, $query2);
            $r2 = mysqli_fetch_assoc($result2);
                $rows[] = array(
                    "order_by"=>$user_data,
                    "sale_by"=>$seller_data,
                    "listing"=>$listing_data,
                    "shipping_address"=>$r2
                );
            
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
    function users($id)
    {
        $query = "SELECT * FROM logins WHERE id = '$id'";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        if (!empty($row["id"])) {
            # code...
            $id=$row["id"];
        
            if (!empty($row["full_name"])) {
                $full_name = $row["full_name"];
            }else{
                $full_name = "";
            }
            if (!empty($row["image"])) {
                $image = $row["image"];
            }else{
                $image = "";
            }
            if (!empty($row["user_name"])) {
                $user_name = $row["user_name"];
            }else{
                $user_name = "";
            }
            if (!empty($row["password"])) {
                $password = $row["password"];
            }else{
                $password = "";
            }
            if (!empty($row["email"])) {
                $email = $row["email"];
            }else{
                $email = "";
            }
            if (!empty($row["location_address"])) {
                $location_address = $row["location_address"];
            }else{
                $location_address = "";
            }
            if (!empty($row["phone_no"])) {
                $phone_no = $row["phone_no"];
            }else{
                $phone_no = "";
            }
            if (!empty($row["email_verified_status"])) {
                $email_verified_status = $row["email_verified_status"];
            }else{
                $email_verified_status = "";
            }
            if (!empty($row["status"])) {
                $status = $row["status"];
            }else{
                $status = "";
            }
            if (!empty($row["created_at"])) {
                $created_at = $row["created_at"];
            }else{
                $created_at = "";
            }
            $query2 = "SELECT * FROM reviews WHERE reviewed_user_id='$id'";
            $result2 = mysqli_query($this->conn, $query2);
            $rows_count=mysqli_num_rows($result2);
            if($rows_count == 0){
                $avarage = 0;
            }else{
            $count = 0;
                while($row = mysqli_fetch_assoc($result2)){
                $count = $count + $row["review"];
                }
            $avarage = $count / $rows_count;
            }
            $query5 = "SELECT * FROM follow WHERE following_id=".$id;
            $result5 = mysqli_query($this->conn, $query5);
                $rows=mysqli_num_rows($result5);
            $query6 = "SELECT * FROM follow WHERE user_id=".$id;
            $result6 = mysqli_query($this->conn, $query6);
                $rows2=mysqli_num_rows($result6);
            
                    # code...
            $array = array(
                "id"=>$id,
                "full_name"=>$full_name,
                "image"=>$image,
                "user_name"=>$user_name,
                "password"=>$password,
                "email"=>$email,
                "location_address"=>$location_address,
                "phone_no"=>$phone_no,
                "email_verified_status"=>$email_verified_status,
                "status"=>$status,
                "review"=>$avarage,
                "followers"=>$rows,
                "following"=>$rows2,
                "created_at"=>$created_at,
            );
            return $array;
        }else{
            $id = '';
    }
    return array();
    }

    function listing($id)
    {
        $query = "SELECT * FROM listing WHERE id = '$id'";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            if (mysqli_num_rows($result) >0) {
                # code...
            $r = mysqli_fetch_assoc($result);
            $id = $r["id"];
            $user_id = $r["user_id"];
            $title = $r["title"];
            $description = $r["description"];
            $price = $r["price"];
            $location = $r["location"];
            $location_lat = $r["location_lat"];
            $location_log = $r["location_log"];
            $num_lat = floatval($location_lat);
            $num_log = floatval($location_log);
            $product_condition = $r["product_condition"];
            $exchange = $r["exchange"];
            $fixed_price = $r["fixed_price"];
            $giveaway = $r["giveaway"];
            $shipping_cost = $r["shipping_cost"];
            $sold = $r["sold"];
            $youtube_link = $r["youtube_link"];
            $created_at = $r["created_at"];
            $category = $r["category_id"];
            $subcategory = $r["subcategory_id"];
            $query3 = "SELECT * FROM categories WHERE id = '$category'";
            $result3 = mysqli_query($this->conn, $query3);
            $r3 = mysqli_fetch_assoc($result3);
            $query4 = "SELECT * FROM sub_categories WHERE id = '$subcategory'";
            $result4 = mysqli_query($this->conn, $query4);
            $r4 = mysqli_fetch_assoc($result4);
            if (empty($r4["name"])) {
                # code...
                    $sub_category_name = null;
            }else{
            $sub_category_name = $r4["name"] ;
            }
            if (empty($r3["name"])) {
                # code...
                    $category_name = null;
            }else{
            $category_name = $r3["name"] ;
            }
                    $query2 = "SELECT * FROM product_images WHERE product_id =  $id ";
                    $result2 = mysqli_query($this->conn, $query2);
                    $rows2 = array();
                    while ($r2 = mysqli_fetch_assoc($result2)) {
                        $img = $r2["image"];
                        $rows2[] = $img;
                    }
            return $data= array(
                    "id"=>$id,
                    "user_id"=>$user_id,
                    "title"=>$title,
                    "description"=>$description,
                    "price"=>$price,
                    "location"=>$location,
                    "location_lat"=>$num_lat,
                    "location_log"=>$num_log,
                    "product_condition"=>$product_condition,
                    "exchange"=>$exchange,
                    "fixed_price"=>$fixed_price,
                    "giveaway"=>$giveaway,
                    "shipping_cost"=>$shipping_cost,
                    "sold"=>$sold,
                    "youtube_link"=>$youtube_link,
                    "created_at"=>$created_at,
                    "category"=>array(
                        "category_id"=>$category,
                        "category_name"=>$category_name,
                    ),
                    "subcategory"=>array(
                        "sub_category_id"=>$subcategory,
                        "sub_category_name"=>$sub_category_name,

                    ),
                "images"=>$rows2
            );
        }else {
                return $data = array(
                    "status"=>true,
                    "message" => "No data available"
                );
        }
        }
    
        return array();

    }
    public function completeOrder(){
        $query = "UPDATE ".$this->order." SET
        status = 'complete'
        WHERE id ='$this->id'";
    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
}
