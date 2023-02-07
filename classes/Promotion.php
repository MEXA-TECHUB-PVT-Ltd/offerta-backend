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
    public $created_at;
    public $features_id;
    public $ad_detail_id;
    public $advertisement_detail;
    public function __construct($db){
        $this->conn = $db;
        $this->feature = "features";
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
        $query = "INSERT INTO ".$this->promotion." (user_id,listing_id,feature_price,features_id,advertisement_detail_id,created_at) VALUES ('$this->user_id','$this->listing_id','$this->feature_price','$this->features_id','$this->ad_detail_id','$this->created_at')";
        $insert = mysqli_query($this->conn, $query);
            if($insert){
                return true;
            }
            return false;
        }
    public function updatePromotion(){
            $query = "UPDATE ".$this->promotion." SET
            user_id = '$this->user_id',
            feature_price = '$this->feature_price',
            features_id = '$this->features_id',
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
                        $rows[] = $r;
                    
                }
                return $rows;
            }
    
        return array();
        }
        public function selectAllpromotionbyuserFeature(){
            $query = "SELECT * FROM ".$this->promotion." WHERE user_id = $this->user_id AND features_id = $this->feature";
        
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
        public function getPromotionById(){
            $query = "SELECT * FROM ".$this->promotion." WHERE user_id=".$this->user_id;
        
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
                // $r = mysqli_fetch_assoc($result);
                $rows = array();
                while ($r = mysqli_fetch_assoc($result)) {
                        $rows[] = $r;
                    
                }
                return $rows;
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
}