<?php
class offer{
    public $id;
    public $user_id;
    public $sale_by;
    public $listing_id;
    public $price;
    public $status;
    public $notification;
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
            $user = $this->users($this->user_id);
            $user_name = $user["full_name"];
            $my = $this->listing($this->listing_id);
            $product_name_my = $my["title"];
            $this->notification = "Hi, $user_name Want to make offer on your Product $product_name_my";
            $query2 = "INSERT INTO  notification (from_user,to_user,item1,notification) VALUES ('$this->user_id','$this->sale_by','$this->listing_id','$this->notification')";
            $insert2 = mysqli_query($this->conn, $query2);
            if ($insert2) {
                return true;
            }
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
                $user=$r["user_id"];
                $user_data=$this->users($user);
                $saller=$r["sale_by"];
                $seller_data=$this->users($saller);
                $listing=$r["listing_id"];
                $listing_data=$this->listing($listing);
                $price=$r["price"];
                $status=$r["status"];
                    $rows[] = array(
                        "user"=>$user_data,
                        "sale_by"=>$seller_data,
                        "listing"=>$listing_data,
                        "price"=>$price,
                        "status"=>$status
                    );
                
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
                $user=$r["user_id"];
                $user_data=$this->users($user);
                $saller=$r["sale_by"];
                $seller_data=$this->users($saller);
                $listing=$r["listing_id"];
                $listing_data=$this->listing($listing);
                $price=$r["price"];
                $status=$r["status"];
                    $rows[] = array(
                        "user"=>$user_data,
                        "sale_by"=>$seller_data,
                        "listing"=>$listing_data,
                        "price"=>$price,
                        "status"=>$status
                    );
                
            }
            return $rows;
        }
    
        return array();
    }
    public function getOfferByUserId(){
        $query = "SELECT * FROM ".$this->Offers." WHERE user_id = '$this->id'";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $rows = array();
            while ($r = mysqli_fetch_assoc($result)) {
                $user=$r["user_id"];
                $user_data=$this->users($user);
                $saller=$r["sale_by"];
                $seller_data=$this->users($saller);
                $listing=$r["listing_id"];
                $listing_data=$this->listing($listing);
                $price=$r["price"];
                $status=$r["status"];
                    $rows[] = array(
                        "user"=>$user_data,
                        "sale_by"=>$seller_data,
                        "listing"=>$listing_data,
                        "price"=>$price,
                        "status"=>$status
                    );
            }
            return $rows;
        }
    
        return array();
    }
    public function getSelerOffers(){
        $query = "SELECT * FROM ".$this->Offers." WHERE sale_by = '$this->id'";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $rows = array();
            while ($r = mysqli_fetch_assoc($result)) {
                $user=$r["user_id"];
                $user_data=$this->users($user);
                $saller=$r["sale_by"];
                $seller_data=$this->users($saller);
                $listing=$r["listing_id"];
                $listing_data=$this->listing($listing);
                $price=$r["price"];
                $status=$r["status"];
                    $rows[] = array(
                        "user"=>$user_data,
                        "sale_by"=>$seller_data,
                        "listing"=>$listing_data,
                        "price"=>$price,
                        "status"=>$status
                    );
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
}