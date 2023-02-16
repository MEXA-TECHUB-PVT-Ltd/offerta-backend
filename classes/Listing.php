<?php
use Stripe\Product;
class Listing{
    public $id;
    public $user_id;
    public $category_id;
    public $subcategory_id;
    public $title;
    public $search;
    public $description;
    public $price;
    public $shipping_cost;
    public $location;
    public $location_lat;
    public $location_log;
    public $youtube_link;
    public $product_condition;
    public $fixed_price;
    public $giveaway;
    public $exchange;
    public $created_at;
    public $listing_img;
    
    
    public $conn;
    public $Listing_table;
    public function __construct($db){
        $this->conn = $db;
        $this->Listing_table = "listing";
        $this->created_at = date("Y-m-d h:i");
    }
    public function createListing(){
        $query = "INSERT INTO ".$this->Listing_table." (user_id,category_id,subcategory_id,
        title,description,product_condition,price,shipping_cost,youtube_link,
        giveaway,fixed_price,exchange,location,location_lat,location_log,created_at) VALUES 
        ('$this->user_id','$this->category_id','$this->subcategory_id','$this->title','$this->description',
        '$this->product_condition','$this->price','$this->shipping_cost','$this->youtube_link',
        '$this->giveaway','$this->fixed_price','$this->exchange','$this->location','$this->location_lat','$this->location_log','$this->created_at')";

    $insert = mysqli_query($this->conn, $query);
        if($insert){
            return true;
        }
        return false;
    }

    public function updateListing(){
        $query = "UPDATE ".$this->Listing_table." SET
        user_id = '$this->user_id',
        category_id = '$this->category_id',
        subcategory_id = '$this->subcategory_id',
        title = '$this->title',
        description = '$this->description',
        product_condition = '$this->product_condition',
        price = '$this->price',
        shipping_cost = '$this->shipping_cost',
        exchange = '$this->exchange',
        youtube_link = '$this->youtube_link',
        giveaway = '$this->giveaway',
        fixed_price = '$this->fixed_price',
        location = '$this->location'
        WHERE id ='$this->id'";

    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
    public function deleteList(){
        $query = "DELETE FROM ".$this->Listing_table." WHERE id =" . $this->id;
        $upload = mysqli_query($this->conn, $query);
        if($upload){
            $query2 = "DELETE FROM likes WHERE list_id =" . $this->id;
            $upload2 = mysqli_query($this->conn, $query2);
            if ($upload2) {
                $query3 = "DELETE FROM comments WHERE listing_id =" . $this->id;
                $upload2 = mysqli_query($this->conn, $query3);
                if ($upload2) {
                    return true;
                }
            }
        }
        return false;
    }
    public function Sold(){
        $query = "UPDATE ".$this->Listing_table." SET
        sold = 'sold'
        WHERE id ='$this->id'";

    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }

    public function searchList(){
        $query = "SELECT * FROM ".$this->Listing_table." WHERE title LIKE '" .$this->search. "%' OR description LIKE '%" .$this->search. "%'";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $rows = array();
            while ($r = mysqli_fetch_assoc($result)) {
                $id = $r["id"];
                $insert="INSERT INTO most_search (listing_id) VALUES ('$id')";
                $result3 = mysqli_query($this->conn, $insert);
                $user_id = $r["user_id"];
                $title = $r["title"];
                $description = $r["description"];
                $price = $r["price"];
                $location = $r["location"];
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
                $query5 = "SELECT * FROM categories WHERE id = '$category'";
            $result5 = mysqli_query($this->conn, $query5);
            $r3 = mysqli_fetch_assoc($result5);
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
                    $query2 = "SELECT * FROM product_images WHERE product_id = '$id'";
                    $result2 = mysqli_query($this->conn, $query2);
                    $rows2 = array();
                    while ($r2 = mysqli_fetch_assoc($result2)) {
                        $img = $r2["image"];
                        $rows2[] = $img;
                    }
                    $data= array(
                        "id"=>$id,
                        "user_id"=>$user_id,
                        "title"=>$title,
                        "description"=>$description,
                        "price"=>$price,
                        "location"=>$location,
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
                    $rows[] = $data;
            }
            return $rows;
        }
        return array();
    }
    
    public function getAllList(){
        $query = "SELECT * FROM ".$this->Listing_table." ORDER BY created_at DESC";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $rows = array();
            while ($r = mysqli_fetch_assoc($result)) {
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
                // category
                $query3 = "SELECT * FROM categories WHERE id = '$category'";
                $result3 = mysqli_query($this->conn, $query3);
                $r3 = mysqli_fetch_assoc($result3);
                if (empty($r3["name"])) {
                $category_name = null;
                }else{
                $category_name = $r3["name"] ;
                }
                // sub Category
                $query4 = "SELECT * FROM sub_categories WHERE id = '$subcategory'";
                $result4 = mysqli_query($this->conn, $query4);
                $r4 = mysqli_fetch_assoc($result4);
                if (empty($r4["name"])) {
                    # code...
                        $sub_category_name = null;
                }else{
                $sub_category_name = $r4["name"] ;
                }
                // images
                $query2 = "SELECT * FROM product_images WHERE product_id = '$id'";
                $result2 = mysqli_query($this->conn, $query2);
                $rows2 = array();
                while ($r2 = mysqli_fetch_assoc($result2)) {
                    $img = $r2["image"];
                    $rows2[] = $img;
                }
                $query4 = "SELECT * FROM promotions WHERE listing_id = '$id'";
                $result4 = mysqli_query($this->conn, $query4);
                $r4 = mysqli_fetch_assoc($result4);
                if (mysqli_num_rows($result4) > 0) {
                    if ($r4["features_id"] == '0') {
                        $ad_id=$r4["advertisement_detail_id"];
                        $query5 = "SELECT * FROM advertisement_detail WHERE id =$ad_id";
                        $result5 = mysqli_query($this->conn, $query5);
                        $r5 = mysqli_fetch_assoc($result5);
                        $data= array(
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
                            "images"=>$rows2,
                            "promotion"=>array(
                                "type"=>"advertisement",
                                "offer_time"=>$r5["offer_time"],
                                "feature"=>$r5["feature"],
                                "price"=>$r5["price"],
                                "tag"=>$r5["tag"],
                                "color"=>$r5["color"],
                            )
                    );
                    $rows[] = $data;         
                    }else{
                        $ad_id=$r4["features_id"];
                        $query5 = "SELECT * FROM features WHERE id =$ad_id";
                        $result5 = mysqli_query($this->conn, $query5);
                        $r5 = mysqli_fetch_assoc($result5);
                        $data= array(
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
                            "images"=>$rows2,
                            "promotion"=>array(
                                "type"=>"urgent",
                                "feature"=>$r5["title"],
                                "price"=>$r5["price"],
                                "tag"=>$r5["tag"],
                                "color"=>$r5["color"],
                            )
                    );
                    $rows[] = $data;
                    }
                    
                }else {
                    $data= array(
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
                        "images"=>$rows2,
                );
                $rows[] = $data;
                }
            }
            usort($rows, function($a, $b) {
                if (isset($a['promotion']) && !isset($b['promotion'])) {
                  return -1;
                } else if (!isset($a['promotion']) && isset($b['promotion'])) {
                  return 1;
                } else {
                  return 0;
                }
              });
            return $rows;
        }
    
        return array();
    }

    public function getListById(){
        $query = "SELECT * FROM ".$this->Listing_table." WHERE id = '$this->id'";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $rows2 = array();
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
                    $query2 = "SELECT * FROM product_images WHERE product_id = '$this->id'";
                    $result2 = mysqli_query($this->conn, $query2);
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
    
    public function getListByCategoryId(){
        $query = "SELECT * FROM ".$this->Listing_table." WHERE category_id = '$this->id' ORDER BY created_at DESC";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            if (mysqli_num_rows($result) >0) {
            while($r = mysqli_fetch_assoc($result)){
            $data = array();
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
            $category = $r["category_id"];
            $subcategory = $r["subcategory_id"];
            $created_at = $r["created_at"];
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
                    $query2 = "SELECT * FROM product_images WHERE product_id = '$id'";
                    $result2 = mysqli_query($this->conn, $query2);
                    $rows2 = array();
                    while ($r2 = mysqli_fetch_assoc($result2)) {
                        $img = $r2["image"];
                        $rows2[] = $img;
                    }
            $data= array(
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
                    $array[] = $data;
        }
                return $array;
        }else {
            return $data = array(
                "status"=>true,
                "message" => "No data available"
            );
    }
        }
    
        return array();
    }

    public function getListByCategoryLocation(){
        define("EARTH_RADIUS", 6371);
        $query = "SELECT * FROM ".$this->Listing_table." WHERE category_id = '$this->id'";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            if (mysqli_num_rows($result) >0) {
            while($r = mysqli_fetch_assoc($result)){
            $data = array();
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
            $category = $r["category_id"];
            $subcategory = $r["subcategory_id"];
            $created_at = $r["created_at"];
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
                    $query2 = "SELECT * FROM product_images WHERE product_id = '$id'";
                    $result2 = mysqli_query($this->conn, $query2);
                    $rows2 = array();
                    while ($r2 = mysqli_fetch_assoc($result2)) {
                        $img = $r2["image"];
                        $rows2[] = $img;
                    }
                    $product_lat = $r['location_lat'];
                    $product_lng = $r['location_log'];
                    $lat_diff = deg2rad($product_lat - $this->location_lat);
                    $lng_diff = deg2rad($product_lng - $this->location_log);
                    $a = sin($lat_diff / 2) * sin($lat_diff / 2) + cos(deg2rad($this->location_lat)) * cos(deg2rad($product_lat)) * sin($lng_diff / 2) * sin($lng_diff / 2);
                    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
                    $distance = EARTH_RADIUS * $c;
                    if ($distance <= '500') {
                        $data= array(
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
                    $array[] = $data;
                    }
        }
                return $array;
        }else {
            return $data = array(
                "status"=>true,
                "message" => "No data available"
            );
    }
        }
    
        return array();
    }
    public function selectAllByLocation(){
        $query = "SELECT * FROM ".$this->Listing_table." WHERE location LIKE '" .$this->location. "%' ";
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
    public function mostSearchList(){
        $query = "SELECT listing_id FROM most_search GROUP BY listing_id ORDER BY COUNT(*) DESC LIMIT 6";
        $result = mysqli_query($this->conn,$query);
        if ($result) {
        $array=array();
        while($row = mysqli_fetch_assoc($result)){
            $id=$row["listing_id"];
            $query2 = "SELECT * FROM ".$this->Listing_table." WHERE id = '$id'";
            $result2 = mysqli_query($this->conn,$query2);
            if ($result2) {
                $row2 = mysqli_fetch_assoc($result2);
                $title=$row2["title"];
            }
            $array[] = array(
                "listing_id"=>$row["listing_id"],
                "item"=>$title
        
        );
        }
        return $array;
        }
return array();
    }
    function users($id){
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
}