<?php
class Promotion{
    public $id;
    public $title;
    public $conn;
    public $feature;
    public $promotion;
    public $user_id;
    public $listing_id;
    public $feature_price;
    public $no_of_days_for_running_ad;
    public $offer_time;
    public $price;
    public $type;
    public $created_at;
    public $features_id;
    public $ad_detail_id;
    public $advertisement_detail;
    public $blogs_table;
    public function __construct($db){
        $this->conn = $db;
        $this->feature = "features";
        $this->blogs_table = "blogs";
        $this->promotion = "promotions";
        $this->advertisement_detail = "advertisement_detail";
        $this->created_at = date("Y-m-d h:i");
    }
    // Feature CRUD
    public function createFeatures(){
        $query = "INSERT INTO ".$this->feature." (title,created_at) VALUES ('$this->title','$this->created_at')";
        $insert = mysqli_query($this->conn, $query);
            if($insert){
                return true;
            }
            return false;
        }
    public function updateFeatures(){
        $query = "UPDATE ".$this->feature." SET
        title = '$this->title'
        WHERE id = '$this->id'";

    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
        }
    public function deleteFeature(){
        $query = "DELETE FROM ".$this->feature." WHERE id =" . $this->id;
        $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
        }
        public function getFeatureById(){
            $query = "SELECT * FROM ".$this->feature." WHERE id = '$this->id'";
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
        public function getAdDetailById(){
            $query = "SELECT * FROM ".$this->advertisement_detail." WHERE id = '$this->id'";
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
        // Promotion CRUD
    public function createPromotion(){
        $query = "INSERT INTO ".$this->promotion." (user_id,listing_id,features_id,advertisement_detail_id,created_at) VALUES 
        ('$this->user_id','$this->listing_id','$this->features_id','$this->ad_detail_id','$this->created_at')";
        $insert = mysqli_query($this->conn, $query);
            if($insert){
                return true;
            }
            return false;
        }
    public function updatePromotion(){
            $query = "UPDATE ".$this->promotion." SET
            user_id = '$this->user_id',
            features_id = '$this->features_id',
            listing_id = '$this->listing_id',
            advertisement_detail_id = '$this->ad_detail_id'
            WHERE id = '$this->id'";
    
        $upload = mysqli_query($this->conn, $query);
            if($upload){
                return true;
            }
            return false;
        }
    public function deletePromotion(){
        $delete = "SELECT * FROM ".$this->promotion." WHERE id =".$this->id." ";
        $deleteresult = mysqli_query($this->conn, $delete);
        if (mysqli_num_rows($deleteresult) == 1) {
        $query = "DELETE FROM ".$this->promotion." WHERE id =" . $this->id;
        $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }}
        return false;
        }

        public function selectAllpromotion(){
            $query = "SELECT * FROM ".$this->promotion." ";
        
            $result = mysqli_query($this->conn, $query);
    
            if ($result) {
                $rows = array();
                while ($r = mysqli_fetch_assoc($result)) {
                    $id=$r["id"];
                    $user=$r["user_id"];
                    $listing_id=$r["listing_id"];
                    $ad_id=$r["advertisement_detail_id"];
                    $feature_id=$r["features_id"];
                    $user_data=$this->users($user);
                    $listing_data=$this->listing($listing_id);
                    if ($feature_id != 0) {
                        $query2 = "SELECT * FROM features WHERE id = $feature_id";
                        $result2 = mysqli_query($this->conn, $query2);
                        $r2 = mysqli_fetch_assoc($result2);
                        $title=$r2["title"];
                        $price=$r2["price"];
                        $tag=$r2["tag"];
                        $color=$r2["color"];
                        $promotion=array(
                            "type"=>'urgent',
                            "title"=>$title,
                            "price"=>$price,
                            "tag"=>$tag,
                            "color"=>$color
                        );
                    }else{
                        $query2 = "SELECT * FROM advertisement_detail WHERE id = $ad_id";
                        $result2 = mysqli_query($this->conn, $query2);
                        $r2 = mysqli_fetch_assoc($result2);
                        $offer_time=$r2["offer_time"];
                        $features=$r2["feature"];
                        $price=$r2["price"];
                        $tag=$r2["tag"];
                        $color=$r2["color"];
                        $promotion=array(
                            "type"=>'advertisement',
                            "features"=>$features,
                            "offer_time"=>$offer_time,
                            "price"=>$price,
                            "tag"=>$tag,
                            "color"=>$color
                        );
                    }
                    $rows[]=array(
                        "id"=>$id,
                        "user"=>$user_data,
                        "listing"=>$listing_data,
                        "promotion"=>$promotion

                    );
                }
                return $rows;
            }
    
        return array();
        }
        public function selectAllpromotionbyuserexpaire(){
            $query = "SELECT * FROM ".$this->promotion." WHERE user_id = $this->user_id";
            $result = mysqli_query($this->conn, $query);
            if ($result) {
                $rows = array();
                while ($r = mysqli_fetch_assoc($result)) {
                    $id=$r["id"];
                    $user=$r["user_id"];
                    $listing_id=$r["listing_id"];
                    $ad_id=$r["advertisement_detail_id"];
                    $feature_id=$r["features_id"];
                    $created_at=$r["created_at"];
                    $user_data=$this->users($user);
                    $listing_data=$this->listing($listing_id);
                    if ($feature_id != 0) {
                        $query2 = "SELECT * FROM features WHERE id = $feature_id";
                        $result2 = mysqli_query($this->conn, $query2);
                        $r2 = mysqli_fetch_assoc($result2);
                        $title=$r2["title"];
                        $price=$r2["price"];
                        $offer_time=$r2["offer_time"];
                        $tag=$r2["tag"];
                        $color=$r2["color"];
                        $integer_part = filter_var($offer_time, FILTER_SANITIZE_NUMBER_INT);
                        $valid_offer= intval($integer_part);
                        $current = date('Y-m-d');  // current date and time
                        $post_time = new DateTime($created_at);  // create DateTime object from the database string
                        $interval = new DateInterval('P' . $valid_offer . 'D');  // $day days interval
                        $post_time->add($interval);  // add $day days to the database date and time
                        $expire_date = $post_time->format('Y-m-d');  // format the result as a string
                        $postTiming = date("Y-m-d", strtotime($created_at));
                        // postTiming  expire_date  current
                        if ($postTiming < $expire_date && $expire_date < $current) {
                        $promotion=array(
                            "type"=>'urgent',
                            "title"=>$title,
                            "price"=>$price,
                            "offer_time"=>$offer_time,
                            "tag"=>$tag,
                            "color"=>$color
                        );
                    }else{
                        $promotion=array();
                    }
                    }else{
                        $query3 = "SELECT * FROM advertisement_detail WHERE id = $ad_id";
                        $result3 = mysqli_query($this->conn, $query3);
                        $r3 = mysqli_fetch_assoc($result3);
                        $offer_time=$r3["offer_time"];
                        $features=$r3["feature"];
                        $price=$r3["price"];
                        $tag=$r3["tag"];
                        $color=$r3["color"];
                        $integer_part = filter_var($offer_time, FILTER_SANITIZE_NUMBER_INT);
                        $valid_offer= intval($integer_part);
                        $current = date('Y-m-d');  // current date and time
                        $post_time = new DateTime($created_at);  // create DateTime object from the database string
                        $interval = new DateInterval('P' . $valid_offer . 'D');  // $day days interval
                        $post_time->add($interval);  // add $day days to the database date and time
                        $expire_date = $post_time->format('Y-m-d');  // format the result as a string
                        $postTiming = date("Y-m-d", strtotime($created_at));
                        // postTiming  expire_date  current
                        if ($postTiming < $expire_date && $expire_date < $current) {
                        $promotion=array(
                            "type"=>'advertisement',
                            "features"=>$features,
                            "price"=>$price,
                            "offer_time"=>$offer_time,
                            "tag"=>$tag,
                            "color"=>$color
                        );
                    }else{
                        $promotion=array();
                    }
                    }
                    $rows[]=array(
                        "id"=>$id,
                        "user"=>$user_data,
                        "listing"=>$listing_data,
                        "promotion"=>$promotion

                    );
                }
                return $rows;
            }
    
        return array();
        }
      
        public function selectAllpromotionbyuserFeatureUrgent(){
            $query = "SELECT * FROM ".$this->promotion." WHERE user_id = $this->user_id";
            $result = mysqli_query($this->conn, $query);
            if ($result) {
                $rows = array();
                while ($r = mysqli_fetch_assoc($result)) {
                    $id=$r["id"];
                    $user=$r["user_id"];
                    $listing_id=$r["listing_id"];
                    $ad_id=$r["advertisement_detail_id"];
                    $feature_id=$r["features_id"];
                    $user_data=$this->users($user);
                    $listing_data=$this->listing($listing_id);
                    if ($feature_id != 0 && $this->type == 'urgent') {
                        $query2 = "SELECT * FROM features WHERE $feature_id";
                        $result2 = mysqli_query($this->conn, $query2);
                        $r2 = mysqli_fetch_assoc($result2);
                        $title=$r2["title"];
                        $price=$r2["price"];
                        $tag=$r2["tag"];
                        $color=$r2["color"];
                        $promotion=array(
                            "type"=>'urgent',
                            "title"=>$title,
                            "price"=>$price,
                            "tag"=>$tag,
                            "color"=>$color
                        );
                        $rows[]=array(
                            "id"=>$id,
                            "user"=>$user_data,
                            "listing"=>$listing_data,
                            "promotion"=>$promotion
    
                        );
                    }
                    
                }
                return $rows;
            }
    
        return array();
        }
        public function selectAllpromotionbyuserFeatureAdv(){
            $query = "SELECT * FROM ".$this->promotion." WHERE user_id = $this->user_id";
            $result = mysqli_query($this->conn, $query);
            if ($result) {
                $rows = array();
                while ($r = mysqli_fetch_assoc($result)) {
                    $id=$r["id"];
                    $user=$r["user_id"];
                    $listing_id=$r["listing_id"];
                    $ad_id=$r["advertisement_detail_id"];
                    $feature_id=$r["features_id"];
                    $user_data=$this->users($user);
                    $listing_data=$this->listing($listing_id);
                    if ($feature_id == 0 && $this->type == 'advertisement') {
                            $query2 = "SELECT * FROM advertisement_detail WHERE $ad_id";
                            $result2 = mysqli_query($this->conn, $query2);
                            $r2 = mysqli_fetch_assoc($result2);
                            $offer_time=$r2["offer_time"];
                            $features=$r2["feature"];
                            $price=$r2["price"];
                            $tag=$r2["tag"];
                            $color=$r2["color"];
                            $promotion=array(
                                "type"=>'advertisement',
                                "features"=>$features,
                                "offer_time"=>$offer_time,
                                "price"=>$price,
                                "tag"=>$tag,
                                "color"=>$color
                            );
                            $rows[]=array(
                                "id"=>$id,
                                "user"=>$user_data,
                                "listing"=>$listing_data,
                                "promotion"=>$promotion
        
                            );
                        }
                }
                return $rows;
            }
    
        return array();
        }
        public function getPromotionById(){
            $query = "SELECT * FROM ".$this->promotion." WHERE id=".$this->user_id;
                $result = mysqli_query($this->conn, $query);
                if ($result) {
                    $rows = array();
                    if(!empty($r = mysqli_fetch_assoc($result))){
                        $id=$r["id"];
                        $user=$r["user_id"];
                        $listing_id=$r["listing_id"];
                        $ad_id=$r["advertisement_detail_id"];
                        $feature_id=$r["features_id"];
                        $user_data=$this->users($user);
                        $listing_data=$this->listing($listing_id);
                        if ($feature_id != 0) {
                            $query2 = "SELECT * FROM features WHERE $feature_id";
                            $result2 = mysqli_query($this->conn, $query2);
                            $r2 = mysqli_fetch_assoc($result2);
                            $title=$r2["title"];
                            $price=$r2["price"];
                            $tag=$r2["tag"];
                            $color=$r2["color"];
                            $promotion=array(
                                "type"=>'urgent',
                                "title"=>$title,
                                "price"=>$price,
                                "tag"=>$tag,
                                "color"=>$color
                            );
                        }else{
                            $query2 = "SELECT * FROM advertisement_detail WHERE $ad_id";
                            $result2 = mysqli_query($this->conn, $query2);
                            $r2 = mysqli_fetch_assoc($result2);
                            $offer_time=$r2["offer_time"];
                            $features=$r2["feature"];
                            $price=$r2["price"];
                            $tag=$r2["tag"];
                            $color=$r2["color"];
                            $promotion=array(
                                "type"=>'advertisement',
                                "features"=>$features,
                                "offer_time"=>$offer_time,
                                "price"=>$price,
                                "tag"=>$tag,
                                "color"=>$color
                            );
                        }
                        $rows[]=array(
                            "id"=>$id,
                            "user"=>$user_data,
                            "listing"=>$listing_data,
                            "promotion"=>$promotion,
                        );
                    }
                    return $rows;
                }
        
            return array();
        }
        public function selectAllAdDetail(){
            $query = "SELECT * FROM ".$this->advertisement_detail." ";
        
            $result = mysqli_query($this->conn, $query);
    
            if ($result) {
                // $r = mysqli_fetch_assoc($result);
                $rows = array();
                while ($r = mysqli_fetch_assoc($result)) {
                        $rows[] = $r;
                    
                }
                return $rows;
            }
    
        return array();
        }
        public function selectAllFeature(){
            $query = "SELECT * FROM ".$this->feature." ";
            $result = mysqli_query($this->conn, $query);
            if ($result) {
                $r = mysqli_fetch_assoc($result);
                return $r;
            }
        return array();
        }
         // advertisement_detail CRUD
         public function createAdvertisementDetail(){
            $query = "INSERT INTO ".$this->advertisement_detail." (offer_time,no_of_days_for_running_ad,price,created_at) VALUES
             ('$this->offer_time','$this->no_of_days_for_running_ad','$this->price','$this->created_at')";
            $insert = mysqli_query($this->conn, $query);
                if($insert){
                    return true;
                }
                return false;
            }
            public function updateAdvartisement(){
                $query = "UPDATE ".$this->advertisement_detail." SET
                offer_time = '$this->offer_time',
                no_of_days_for_running_ad = '$this->no_of_days_for_running_ad',
                price = '$this->price'
                WHERE id = '$this->id'";
        
            $upload = mysqli_query($this->conn, $query);
                if($upload){
                    return true;
                }
                return false;
            }

            public function check_user_id(){
    
                $query2 = "SELECT * FROM logins WHERE id = '$this->user_id'";
                    $result2 = mysqli_query($this->conn, $query2);
                    if(mysqli_num_rows($result2) > 0){
                        return true;
                    }
                    return false;
            }
            public function check_features_id(){
    
                $query2 = "SELECT * FROM features WHERE id = '$this->features_id'";
                    $result2 = mysqli_query($this->conn, $query2);
                    if(mysqli_num_rows($result2) > 0){
                        return true;
                    }
                    return false;
            }
            public function advertisement_detail_id(){
    
                $query2 = "SELECT * FROM advertisement_detail WHERE id = '$this->ad_detail_id'";
                    $result2 = mysqli_query($this->conn, $query2);
                    if(mysqli_num_rows($result2) > 0){
                        return true;
                    }
                    return false;
            }
            // blogs
            public function getAllBlogs(){
                $query = "SELECT * FROM ".$this->blogs_table." ";
                $result = mysqli_query($this->conn, $query);
                if ($result) {
                    $rows = array();
                    while ($r = mysqli_fetch_assoc($result)) {
                        $id=$r["id"];
                        $category_id=$r["category_id"];
                        $reference=$r["reference"];
                        $cover_img=$r["cover_img"];
                        $cover_video=$r["cover_video"];
                        $description=$r["description"];
                        $title=$r["title"];
                        $sub_id=$r["sub_id"];
                        $query2 = "SELECT * FROM categories WHERE id = '$category_id' ";
                        $result2 = mysqli_query($this->conn, $query2);
                        $r2 = mysqli_fetch_assoc($result2);
                        $category_name=$r2["name"];
                        $query3 = "SELECT * FROM sub_categories WHERE id = '$sub_id' ";
                        $result3 = mysqli_query($this->conn, $query3);
                        $r3 = mysqli_fetch_assoc($result3);
                        $sub_name=$r3["name"];
    
                            $rows[] = array(
                                "id"=>$id,
                                "title"=>$title,
                                "description"=>$description,
                                "reference"=>$reference,
                                "cover_img"=>$cover_img,
                                "cover_video"=>$cover_video,
                                "category"=>array(
                                    "category_id"=>$category_id,
                                    "category_name"=>$category_name,
                                ),
                                "sub_category"=>array(
                                    "sub_category_id"=>$sub_id,
                                    "sub_category_name"=>$sub_name,
                                ),
                            );
                    }
                    return $rows;
                }
        
            return array();
            }
            public function getBlogsById(){
                $query = "SELECT * FROM ".$this->blogs_table." WHERE id = '$this->id'";
                $result = mysqli_query($this->conn, $query);
                if ($result) {
                    $rows = array();
                    $r = mysqli_fetch_assoc($result);
                        $id=$r["id"];
                        $category_id=$r["category_id"];
                        $reference=$r["reference"];
                        $cover_img=$r["cover_img"];
                        $cover_video=$r["cover_video"];
                        $description=$r["description"];
                        $title=$r["title"];
                        $sub_id=$r["sub_id"];
                        $query2 = "SELECT * FROM categories WHERE id = '$category_id' ";
                        $result2 = mysqli_query($this->conn, $query2);
                        $r2 = mysqli_fetch_assoc($result2);
                        $category_name=$r2["name"];
                        $query3 = "SELECT * FROM sub_categories WHERE id = '$sub_id' ";
                        $result3 = mysqli_query($this->conn, $query3);
                        $r3 = mysqli_fetch_assoc($result3);
                        $sub_name=$r3["name"];
                            $rows[] = array(
                                "id"=>$id,
                                "title"=>$title,
                                "description"=>$description,
                                "reference"=>$reference,
                                "cover_img"=>$cover_img,
                                "cover_video"=>$cover_video,
                                "category"=>array(
                                    "category_id"=>$category_id,
                                    "category_name"=>$category_name,
                                ),
                                "sub_category"=>array(
                                    "sub_category_id"=>$sub_id,
                                    "sub_category_name"=>$sub_name,
                                ),
                            );
                    return $rows;
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