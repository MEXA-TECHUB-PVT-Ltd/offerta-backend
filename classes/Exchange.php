<?php
class Exchange{
    public $id;
    public $user_id;
    public $second_user;
    public $notification;
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
            $user = $this->users($this->user_id);
            $user_name = $user["full_name"];
            $my = $this->listing($this->item);
            $product_name_my = $my["title"];
            $your = $this->listing($this->item2);
            $product_name_your = $your["title"];
            $this->notification = "Hi, $user_name Want to exchange your Product  $product_name_your with $product_name_my";
            $query2 = "INSERT INTO  notification (from_user,to_user,item1,item2,notification) VALUES ('$this->user_id','$this->second_user','$this->item','$this->item2','$this->notification')";
            $insert2 = mysqli_query($this->conn, $query2);
            if ($insert2) {
                return true;
            }
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
                $id = $r["id"];
                $user_id = $r["user_id"];
                $second_user = $r["second_user"];
                $item = $r["item"];
                $item2 = $r["item2"];
                $status = $r["status"];
                $user_data = $this->Users($user_id);
                $user2_data = $this->Users($second_user);
                $user_item = $this->listing($item);
                $user2_item2= $this->listing($item2);
                    $rows[] = array(
                        "id"=>$id,
                        "user"=>$user_data,
                        "user2"=>$user2_data,
                        "user_item"=>$user_item,
                        "user2_item"=>$user2_item2,
                        "status"=>$status
                    );
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
                $id = $r["user_id"];
                $list = $r["id"];
                $second_user = $r["second_user"];
                $item = $r["item"];
                $item2 = $r["item2"];
                $status = $r["status"];
                $user_data = $this->Users($id);
                $user2_data = $this->Users($second_user);
                $user_item = $this->listing($item);
                $user2_item2= $this->listing($item2);
                    $rows[] = array(
                        "id"=>$list,
                        "user"=>$user_data,
                        "user2"=>$user2_data,
                        "user_item"=>$user_item,
                        "user2_item"=>$user2_item2,
                        "status"=>$status
                    );
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
                $list = $r["id"];
                $id = $r["user_id"];
                $second_user = $r["second_user"];
                $item = $r["item"];
                $item2 = $r["item2"];
                $status = $r["status"];
                $user_data = $this->Users($id);
                $user2_data = $this->Users($second_user);
                $user_item = $this->listing($item);
                $user2_item2= $this->listing($item2);
                    $rows[] = array(
                        "ids"=>$list,
                        "user"=>$user_data,
                        "user2"=>$user2_data,
                        "user_item"=>$user_item,
                        "user2_item"=>$user2_item2,
                        "status"=>$status
                    );
            }
            return $rows;
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
    public function GetUserExchangeFailed(){
        $query = "SELECT * FROM ".$this->exchange_table." WHERE user_id = '$this->user_id' AND status = 'failed'";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $rows = array();
            while ($r = mysqli_fetch_assoc($result)) {
                    $list = $r["id"];
                    $id = $r["user_id"];
                    $second_user = $r["second_user"];
                    $item = $r["item"];
                    $item2 = $r["item2"];
                    $status = $r["status"];
                    $user_data = $this->Users($id);
                    $user2_data = $this->Users($second_user);
                    $user_item = $this->listing($item);
                    $user2_item2= $this->listing($item2);
                        $rows[] = array(
                            "ids"=>$list,
                            "user"=>$user_data,
                            "user2"=>$user2_data,
                            "user_item"=>$user_item,
                            "user2_item"=>$user2_item2,
                            "status"=>$status
                        );
            }
            return $rows;
        }
        return array();
    }
    public function getUserNotification()
    {
        $query = "SELECT * FROM notification WHERE to_user = $this->user_id AND status = ''";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            # code...
        
        $array = array();
        while($row = mysqli_fetch_assoc($result)){
            $id = $row["id"];
            $requester_id = $row["from_user"];
            $requester_list = $row["item1"];
            $mylist = $row["item2"];
            $notification = $row["notification"];
            $user_data = $this->users($requester_id);
            $his_list =$this->listing($requester_list);
            $my_list =$this->listing($mylist);
            if (empty($mylist)) {
                $array[] = array(
                    "id"=>$id,
                    "requester"=>$user_data,
                    "list"=>$his_list,
                    "notification"=>$notification,
                    "type"=>"price_offer"
                );
            }else{
                $array[] = array(
                    "id"=>$id,
                    "requester"=>$user_data,
                    "requester_list"=>$his_list,
                    "list"=>$my_list,
                    "notification"=>$notification,
                    "type"=>"exchange"
                );
            }
        }
            return $array;
        }
    return array();
    }
    public function readNotification(){
        $query = "UPDATE notification SET
        status = 'read'
        WHERE id =$this->id";

    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
}
