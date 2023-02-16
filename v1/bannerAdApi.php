<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Banner.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Banner($connection);

    if (isset($_POST["user_id"]) && isset($_POST["start_date"]) && isset($_POST["end_date"])){
        $user_obj->user_id=$_POST["user_id"];
        $user_obj->start_date=$_POST["start_date"];
        $user_obj->end_date=$_POST["end_date"];
    $config = $user_obj->selectAllBanner();
    $web_cost = $config["web_cost"];
    $app_cost = $config["app_cost"];
    
    $diff = strtotime($user_obj->end_date) - strtotime($user_obj->start_date);
    $interval=abs(round($diff / 86400));
    
if(isset($_FILES['app_img']['name'])){
// app_img_link  Config
$user_obj->app_img_link=$_POST["app_img_link"];
$user_obj->cost = $app_cost * $interval;
$app_image_name  =  $_FILES['app_img']['name']; 
$app_tempPath  =  $_FILES['app_img']['tmp_name'];
$app_fileSize  =  $_FILES['app_img']['size'];
$app_Randam= date("Ymd")."_".rand(10000,99999);
$app_exe=pathinfo($app_image_name,PATHINFO_EXTENSION);
$app_newName=$app_Randam.".".$app_exe;
$upload_path_app = '../asset/banner/app/'; // set upload folder path
$user_obj->app_img='asset/banner/app/'.$app_newName;
move_uploaded_file($app_tempPath, $upload_path_app . $app_newName); // move img from system temporary path to our upload folder path 
$user_obj->web_img_link = "";
}else {
            $user_obj->web_img_link=$_POST["web_img_link"];
            $user_obj->cost = $web_cost * $interval;
            $fileName  =  $_FILES['web_img']['name']; 
            $tempPath  =  $_FILES['web_img']['tmp_name'];
            $fileSize  =  $_FILES['web_img']['size'];
            $rand= date("Ymd")."_".rand(10000,99999);
            $exe=pathinfo($fileName,PATHINFO_EXTENSION);
            $newName=$rand.".".$exe;
            $upload_path = '../asset/banner/web/'; // set upload folder path
            $user_obj->web_img='asset/banner/web/'.$newName;
            if(move_uploaded_file($tempPath, $upload_path . $newName)) // move img from system temporary path to our upload folder path 
            $user_obj->app_img_link = "";
}
        if ($user_obj->create_ad()) {
            $last_id = mysqli_insert_id($connection);
            if ($user_obj->web_img_link == "") {
                # code...
                $data2 = array(
                    "id"=>"$last_id",
                    "user_id"=>$user_obj->user_id,
                    "start_date"=>$user_obj->start_date,
                    "end_date"=>$user_obj->end_date,
                    "app_img"=>$user_obj->app_img,
                    "app_img_link"=>$user_obj->app_img_link,
                    "cost"=> $user_obj->cost
                );
            }else {
                $data2 = array(
                    "id"=>"$last_id",
                    "user_id"=>$user_obj->user_id,
                    "start_date"=>$user_obj->start_date,
                    "end_date"=>$user_obj->end_date,
                    "web_img"=>$user_obj->web_img,
                    "web_img_link"=>$user_obj->web_img_link,
                    "cost"=> $user_obj->cost
                );
                
            }
            
            http_response_code(200);
            echo json_encode(array(
            "banner"=>$data2,
            "status"=>true,
            "message"=>"Banner Ad create successfully"
        ));
        }else {
            http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "message"=>"failed to create Banner Ad"

        ));
        }
}else{
    http_response_code(200);
    echo json_encode(array(
    "status"=>false,
    "message"=>"all data needed"
));
    }

?>