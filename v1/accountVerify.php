<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/User.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Users($connection);
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($_POST["user_id"])) {
    $user_obj->id=$_POST["user_id"];
    // img
    $fileName  =  $_FILES['cnic']['name']; 
    $tempPath  =  $_FILES['cnic']['tmp_name'];
    $fileSize  =  $_FILES['cnic']['size'];

    // img naming
    $rand= date("Ymd")."_".rand(10000,99999);
    $exe=pathinfo($fileName,PATHINFO_EXTENSION);
    $newName=$rand.".".$exe;
    $upload_path = '../asset/live_image/'; // set upload folder path
    $user_obj->cnic='asset/live_image/'.$newName;

    // img
    $fileName2  =  $_FILES['live_image']['name']; 
    $tempPath2  =  $_FILES['live_image']['tmp_name'];
    $fileSize2  =  $_FILES['live_image']['size'];

    // img naming
    $rand2= date("Ymd")."_".rand(10000,99999);
    $exe2=pathinfo($fileName,PATHINFO_EXTENSION);
    $newName2=$rand.".".$exe2;
    $upload_path2 = '../asset/cnic/'; // set upload folder path
    $user_obj->live_image='asset/cnic/'.$newName2;

    $data2 = $user_obj->searchById();
    if (!empty($data2)) {
    if($user_obj->subscription()){
    // move img from system temporary path to our upload folder path 
        move_uploaded_file($tempPath, $upload_path . $newName); // move img from system temporary path to our upload folder path 
        move_uploaded_file($tempPath2, $upload_path2 . $newName2);
            http_response_code(200);
            echo json_encode(array(
                "status"=>true,
                "message"=>"Account Verified",
                "user"=>$data2
            ));
    }else{
        http_response_code(200);
        echo json_encode(array(
            "status"=>false,
            "message"=>"failed to verify account"
        ));
    }
    }else{
        http_response_code(200);
        echo json_encode(array(
            "status"=>false,
            "message"=>"User is not registered"
        ));
    }
    }else{
        http_response_code(200);
        echo json_encode(array(
            "status"=>false,
            "message"=>"User Is required to verify account"
        ));
    }
    }else{
    http_response_code(503);
    echo json_encode(array(
    "status"=>false,
    "message"=>"Server error"
));
    }

?>