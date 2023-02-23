<?php
class Banner{
    public $id;
    public $description;
    public $app_cost;
    public $web_cost;
    public $cost;
    public $app_size;
    public $web_size;
    public $conn;
    public $created_at;
    public $banner_config;
    public $banner_ad;
    public function __construct($db){
        $this->conn = $db;
        $this->banner_config = "banner_configuration";
        $this->banner_ad = "banner_ad";
        $this->created_at = date("Y-m-d h:i");
    }

    public function create_banner(){
        $query = "INSERT INTO ".$this->banner_config." (description,web_size,app_size,app_cost,web_cost,created_at) VALUES ('$this->description','$this->web_size','$this->app_size','$this->app_cost','$this->web_cost','$this->created_at')";

    $insert = mysqli_query($this->conn, $query);
        if($insert){
            return true;
        }
        return false;
    }
    public function update_banner(){
        $query = "UPDATE banner_configuration SET
        description = '$this->description',
        web_size = '$this->web_size',
        app_size = '$this->app_size',
        app_cost = '$this->app_cost',
        web_cost = '$this->web_cost'
        WHERE id =$this->id";

    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
    public function delete_banner(){
        $delete = "SELECT * FROM ".$this->banner_config." WHERE id =".$this->id." ";
        $deleteresult = mysqli_query($this->conn, $delete);
        if (mysqli_num_rows($deleteresult) == 1) {
        $query = "DELETE FROM banner_configuration WHERE id =" . $this->id;
        $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
    }
        return false;
    }
    public function selectAllBanner(){
        $query = "SELECT * FROM banner_configuration";
        $result = mysqli_query($this->conn, $query);

        if ($result) {
            $r = mysqli_fetch_assoc($result);
            return $r;
        }
    return array();
    }
    public function getSizeBanner(){
        $query = "SELECT web_length,web_width,app_length,app_width,web_cost,app_cost FROM banner_configuration";
        $result = mysqli_query($this->conn, $query);

        if ($result) {
            $r = mysqli_fetch_assoc($result);
            return $r;
        }
    return array();
    }
    public function GetBannerDescripton(){
        $query = "SELECT description FROM banner_configuration";
        $result = mysqli_query($this->conn, $query);

        if ($result) {
            $r = mysqli_fetch_assoc($result);
            return $r;
        }
    return array();
    }
    // Ad Objects
    public $user_id;
    public $title;
    public $web_img;
    public $web_img_link;
    public $search;
    public $app_img;
    public $app_img_link;
    public $start_date;
    public $end_date;
    public function create_ad(){
        $query = "INSERT INTO ".$this->banner_ad." (user_id, web_img_link,web_img,app_img_link,app_img,start_date, end_date,cost,created_at) VALUES ('$this->user_id','$this->web_img_link','$this->web_img','$this->app_img_link','$this->app_img','$this->start_date', '$this->end_date','$this->cost','$this->created_at')";
        $insert = mysqli_query($this->conn, $query);
        if($insert){
            return true;
        }
        return false;
    }
    public function updateBannerAd(){
        $query = "UPDATE ".$this->banner_ad." SET
        user_id='$this->user_id',
        app_img_link = '$this->app_img_link',
        web_img_link = '$this->web_img_link',
        start_date = '$this->start_date',
        end_date = '$this->end_date'
        WHERE id ='$this->id'";

    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }

    public function deleteBannerAd(){
        $delete = "SELECT * FROM ".$this->banner_config." WHERE id =".$this->id." ";
        $deleteresult = mysqli_query($this->conn, $delete);
        if (mysqli_num_rows($deleteresult) == 1) {
        $query = "DELETE FROM ".$this->banner_ad." WHERE id =" . $this->id;
        $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
    }
        return false;
    }

    public function uploadWebImg(){
        $query = "UPDATE banner_ad SET
        web_img = '$this->web_img',
        web_img_link = '$this->web_img_link'
        WHERE id = '$this->id'";

    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
    public function uploadAppImg(){
        $query = "UPDATE banner_ad SET
        app_img = '$this->app_img',
        app_img_link = '$this->app_img_link'
        WHERE id =7";

    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
    public function GetAllBanner(){
        $query = "SELECT * FROM ".$this->banner_ad."";
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
    public function GetAllActiveBanner(){
        $query = "SELECT * FROM ".$this->banner_ad." WHERE status = 'active'";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $rows = array();
            while ($r = mysqli_fetch_assoc($result)) {
                $id = $r["id"];
                $user_id = $r["user_id"];
                $web_img_link = $r["web_img_link"];
                $app_img_link = $r["app_img_link"];
                $start_date = $r["start_date"];
                $end_date = $r["end_date"];
                $status = $r["status"];
                $created_at = $r["created_at"];
                if ($web_img_link == "") {
                    # code...
                    $data = array(
                        "id"=>$id,
                        "user_id"=>$user_id,
                        "app_img_link"=>$app_img_link,
                        "start_date"=>$start_date,
                        "end_date"=>$end_date,
                        "status"=>$status,
                        "created_at"=>$created_at
                    );
                }else{
                    $data = array(
                        "id"=>$id,
                        "user_id"=>$user_id,
                        "web_img_link"=>$web_img_link,
                        "start_date"=>$start_date,
                        "end_date"=>$end_date,
                        "status"=>$status,
                        "created_at"=>$created_at
                    );
                }
                    $rows[] = $data;
                
            }
            return $rows;
        }
    
        return array();
    }
    public function GetAllBannerBYId(){
        $query = "SELECT * FROM ".$this->banner_ad." WHERE id =".$this->id." ";
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
}