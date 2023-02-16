<?php
class Like{
    public $id;
    public $user_id;
    public $second_user;
    public $listing_id;
    public $following_id;
    public $reviewed_user_id;
    public $comment;
    public $conn;
    public $created_at;
    public $like;
    public $follow;
    public $comments;
    public $review;
    public $reviews;
    public function __construct($db){
        $this->conn = $db;
        $this->like = "likes";
        $this->follow = "follow";
        $this->comments = "comments";
        $this->reviews = "reviews";
        $this->created_at = date("Y-m-d h:i");
    }
    public function comment(){
        $query = "INSERT INTO ".$this->comments." (user_id,listing_id,comment,created_at) VALUES ('$this->user_id','$this->listing_id','$this->comment','$this->created_at')";

    $insert = mysqli_query($this->conn, $query);
        if($insert){
            return true;
        }
        return false;
    }
    
    public function updateComment(){
        $query = "UPDATE ".$this->comments." SET
        user_id = '$this->user_id',
        listing_id = '$this->listing_id',
        comment = '$this->comment'
        WHERE id =$this->id";

    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
    
    public function deleteComment(){
        $query = "DELETE FROM ".$this->comments." WHERE id =" . $this->id;
        $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
    public function searchById(){
        $query = "SELECT * FROM logins WHERE id = " . $this->id;
    $result = mysqli_query($this->conn, $query);

    if ($result) {
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
    }
    return array();
    }
    public function getAllOnListId(){
        $query = "SELECT * FROM ".$this->comments." WHERE listing_id = '$this->listing_id'";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $rows = array();
            while ($r = mysqli_fetch_assoc($result)) {
                $user_id = $r["user_id"];
                $listing_id = $r["listing_id"];
                $comment = $r["comment"];
                $listing=$this->listing($listing_id);
                $query2 = "SELECT * FROM logins WHERE id = '$user_id'";
                $result2 = mysqli_query($this->conn, $query2);
                $r2 = mysqli_fetch_assoc($result2);
                $data = array(
                    "listing"=>$listing,
                    "user"=>$r2,
                    "comment"=>$comment
                );
                    $rows[] = $data;
            }
            return $rows;
        }
        return array();
    }
    public function getAllOnUserId(){
        $query = "SELECT * FROM ".$this->like." WHERE user_id = '$this->user_id'";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $rows = array();
            while ($r9 = mysqli_fetch_assoc($result)) {
                $listing_id = $r9["list_id"];
                $query2 = "SELECT * FROM listing WHERE id = '$listing_id'";
                $result2 = mysqli_query($this->conn, $query2);
                $r = mysqli_fetch_assoc($result2);
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
                $query6 = "SELECT * FROM likes WHERE list_id = '$id'";
                $result6 = mysqli_query($this->conn, $query6);
                $totalLikes = mysqli_num_rows($result6);
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
                        $query5 = "SELECT * FROM product_images WHERE product_id = '$id'";
                        $result5 = mysqli_query($this->conn, $query5);
                        $rows2 = array();
                        while ($r5 = mysqli_fetch_assoc($result5)) {
                            $img = $r5["image"];
                            $rows2[] = $img;
                        }
                $data = array(
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
                "total_likes"=>$totalLikes
                );
                    $rows[] = $data;
            }
            return $rows;
        }
        return array();
    }

    // likes
    public function Like(){
        $query = "INSERT INTO ".$this->like." (user_id,list_id) VALUES ('$this->user_id','$this->listing_id')";

    $insert = mysqli_query($this->conn, $query);
        if($insert){
            return true;
        }
        return false;
    }
    public function createCommunity(){
        $query2 = "SELECT * FROM chat_community WHERE (user_id = " . $this->user_id." AND chat_with=".$this->second_user.") OR (user_id = " . $this->second_user." AND chat_with=".$this->user_id.")";
    $result2 = mysqli_query($this->conn, $query2);

        if ($result2) {
            if (mysqli_num_rows($result2) == 0) {
                $query = "INSERT INTO chat_community (user_id,chat_with) VALUES ('$this->user_id','$this->second_user')";
                $insert = mysqli_query($this->conn, $query);
                    if($insert){
                        return true;
                    }
            }
        }
        return false;
    }
    public function Follow(){
        $query = "INSERT INTO ".$this->follow." (user_id,following_id) VALUES ('$this->user_id','$this->following_id')";

    $insert = mysqli_query($this->conn, $query);
        if($insert){
            return true;
        }
        return false;
    }
    public function Unfollow(){
            $query = "DELETE FROM ".$this->follow." WHERE user_id =".$this->user_id." AND following_id=".$this->following_id ;
            $upload = mysqli_query($this->conn, $query);
            if($upload){
                return true;
            }

        return false;
    }
    public function DisLike(){
            $query = "DELETE FROM ".$this->like." WHERE user_id =".$this->user_id." AND list_id=".$this->listing_id ;
            $upload = mysqli_query($this->conn, $query);
            if($upload){
                return true;
            }

        return false;
    }
    
    public function CheckLike(){
        $query = "SELECT * FROM ".$this->like." WHERE user_id = " . $this->user_id." AND list_id=".$this->listing_id;
    $result = mysqli_query($this->conn, $query);

    if ($result) {
        if (mysqli_num_rows($result)== 0) {
            # code...
            return true;
        } 
        return false;
    }
    
    }
    public function getCommunityById(){
        $query = "SELECT * FROM chat_community WHERE user_id = " . $this->user_id." OR chat_with=".$this->user_id;
        $result = mysqli_query($this->conn, $query);
    if ($result) {
        $rows = array();
        while ($r = mysqli_fetch_assoc($result)) {
                    $id = $r["id"];
                    $user = $r["user_id"];
                    $user2 = $r["chat_with"];
                        $query2 = "SELECT * FROM logins WHERE id = " . $user;
                        $result2 = mysqli_query($this->conn, $query2);
                        $row3 = mysqli_fetch_assoc($result2);
                        $query4 = "SELECT * FROM logins WHERE id = " . $user2;
                        $result4 = mysqli_query($this->conn, $query4);
                        $row4 = mysqli_fetch_assoc($result4);
                        $rows[] = array(
                            "id"=>$id,
                            "user"=>$row3,
                            "chat_user"=>$row4
                        );
        }
        return $rows;
        }
    return array();
    }
    
    
    public function totalLikes(){
        $query = "SELECT * FROM ".$this->like." WHERE list_id=".$this->listing_id;
    $result = mysqli_query($this->conn, $query);

    if ($result) {
        $rows=mysqli_num_rows($result);
            # code...
            return $rows;
        }else{
            $rows=0;
            return $rows;
        }
    }
    public function totalfollowers(){
        $query = "SELECT * FROM ".$this->follow." WHERE following_id=".$this->user_id;
    $result = mysqli_query($this->conn, $query);

    if ($result) {
        $rows=mysqli_num_rows($result);
            # code...
            return $rows;
        }else{
            $rows=0;
            return $rows;
        }
    }
    public function totalfollowing(){
        $query = "SELECT * FROM ".$this->follow." WHERE user_id=".$this->user_id;
    $result = mysqli_query($this->conn, $query);

    if ($result) {
        $rows=mysqli_num_rows($result);
            # code...
            return $rows;
        }else{
            $rows=0;
            return $rows;
        }
    }
    public function CheckDisLike(){
        $query = "SELECT * FROM ".$this->like." WHERE user_id = " . $this->user_id." AND list_id=".$this->listing_id;
    $result = mysqli_query($this->conn, $query);

    if ($result) {
        if (mysqli_num_rows($result)> 0) {
            # code...
            return true;
        } 
        return false;
    }
    
    }
    public function CheckFollow(){
        $query = "SELECT * FROM ".$this->follow." WHERE user_id = " . $this->user_id." AND following_id=".$this->following_id;
    $result = mysqli_query($this->conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 0) {
            # code...
            return true;
        } 
        return false;
    }
    
    }
    public function getFollowing(){
        $query = "SELECT * FROM ".$this->follow." WHERE user_id = " . $this->user_id." ";
    $result = mysqli_query($this->conn, $query);
    if ($result) {
        $rows = array();
        while ($r = mysqli_fetch_assoc($result)) {
            $user = $r["following_id"];
            $query2 = "SELECT * FROM ".$this->follow." WHERE user_id = " .  $user." AND following_id = $this->user_id";
            $result2 = mysqli_query($this->conn, $query2);
            if (mysqli_num_rows($result2) == 0) {
                # code...
                $status=false;
            }else {
                $status=true;
            }
            $query2 = "SELECT * FROM logins WHERE id =".$user." ";
            $result2 = mysqli_query($this->conn, $query2);
                if ($result2) {
                    $r2 = mysqli_fetch_assoc($result2);
                    $rows[] = array(
                        "user"=>$r2,
                        "status"=>$status
                    );
                }
        }
        return $rows;
    }
    return array();
    }
    public function getFollower(){
        $query = "SELECT * FROM ".$this->follow." WHERE following_id = " . $this->user_id." ";
    $result = mysqli_query($this->conn, $query);
    if ($result) {
        $rows = array();
        while ($r = mysqli_fetch_assoc($result)) {
                $user = $r["user_id"];
                $query2 = "SELECT * FROM ".$this->follow." WHERE user_id = " .$this->user_id." AND following_id =  $user";
            $result2 = mysqli_query($this->conn, $query2);
            if (mysqli_num_rows($result2) == 0) {
                # code...
                $status=false;
            }else {
                $status=true;
            }
            $query2 = "SELECT * FROM logins WHERE id =".$user." ";
            $result2 = mysqli_query($this->conn, $query2);
                if ($result2) {
                    $r2 = mysqli_fetch_assoc($result2);
                    $rows[] = array(
                        "user"=>$r2,
                        "status"=>$status
                    );;
                }
        }
        return $rows;
    }
    return array();
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
    public function checkReview(){
        $query2 = "SELECT * FROM ".$this->reviews." WHERE user_id = '$this->user_id' AND reviewed_user_id='$this->reviewed_user_id'";
            $result2 = mysqli_query($this->conn, $query2);
            if(mysqli_num_rows($result2) > 0){
                return true;
            }
            return false;
    }

    public function reviewUser(){
        $query = "INSERT INTO ".$this->reviews." (user_id,reviewed_user_id,review) VALUES ('$this->user_id','$this->reviewed_user_id','$this->review')";

    $insert = mysqli_query($this->conn, $query);
        if($insert){
            return true;
        }
        return false;
    }
    public function getReview(){
        $query2 = "SELECT * FROM ".$this->reviews." WHERE reviewed_user_id='$this->user_id'";
            $result2 = mysqli_query($this->conn, $query2);
            $rows_count=mysqli_num_rows($result2);
            if($rows_count > 0){
            $count = 0;
                while($row = mysqli_fetch_assoc($result2)){
                $count = $count + $row["review"];
                }
            $avarage = $count / $rows_count;
            return array("status" => true, "review" => $avarage);
            }else {
            return array(
                "status" => true,
                "message" => "User Has no review"
            );
            }
    }
    
    public function users()
    {
        $query = "SELECT * FROM logins WHERE id = '$this->id'";
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
}