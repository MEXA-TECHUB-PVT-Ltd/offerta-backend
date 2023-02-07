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

    if (isset($_POST["user_id"]) && isset($_POST["title"]) && isset($_POST["description"]) 
     && isset($_POST["start_date"]) && isset($_POST["end_date"])){
        $user_obj->user_id=$_POST["user_id"];
        $user_obj->title=$_POST["title"];
        $user_obj->description=$_POST["description"];
        $user_obj->start_date=$_POST["start_date"];
        $user_obj->end_date=$_POST["end_date"];
        
        // web_img_link  Config
        $fileName  =  $_FILES['web_img_link']['name']; 
        $tempPath  =  $_FILES['web_img_link']['tmp_name'];
        $fileSize  =  $_FILES['web_img_link']['size'];
        $rand= date("Ymd")."_".rand(10000,99999);
        $exe=pathinfo($fileName,PATHINFO_EXTENSION);
        $newName=$rand.".".$exe;
        $upload_path = '../asset/banner/web/'; // set upload folder path
        $user_obj->web_img_link='asset/banner/web/'.$newName;
        if(move_uploaded_file($tempPath, $upload_path . $newName)) // move img from system temporary path to our upload folder path 
{
        // app_img_link  Config
        $app_image_name  =  $_FILES['app_img_link']['name']; 
        $app_tempPath  =  $_FILES['app_img_link']['tmp_name'];
        $app_fileSize  =  $_FILES['app_img_link']['size'];
        $app_Randam= date("Ymd")."_".rand(10000,99999);
        $app_exe=pathinfo($app_image_name,PATHINFO_EXTENSION);
        $app_newName=$rand.".".$app_exe;
        $upload_path_app = '../asset/banner/app/'; // set upload folder path
        $user_obj->app_img_link='asset/banner/app/'.$app_newName;
        move_uploaded_file($app_tempPath, $upload_path_app . $app_newName); // move img from system temporary path to our upload folder path 
        if ($user_obj->create_ad()) {
            $last_id = mysqli_insert_id($connection);
            $data2 = array(
                "id"=>"$last_id",
                "user_id"=>$user_obj->user_id,
                "title"=>$user_obj->title,
                "description"=>$user_obj->description,
                "start_date"=>$user_obj->start_date,
                "end_date"=>$user_obj->end_date,
                "web_img_link"=>$user_obj->web_img_link,
                "app_img_link"=>$user_obj->app_img_link
            );
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
}
}else{
    http_response_code(200);
    echo json_encode(array(
    "status"=>false,
    "message"=>"all data needed"
));
    }

?>