<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");
// file include
include_once("../config/database.php");
include_once("../classes/Categories.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Categories($connection);
if($_SERVER['REQUEST_METHOD'] === "POST"){
    if (isset($_POST["name"]) && !empty($_FILES["image"]["name"])) {
        $user_obj->name=$_POST["name"];

    $fileName  =  $_FILES['image']['name']; 
    $tempPath  =  $_FILES['image']['tmp_name'];
    $fileSize  =  $_FILES['image']['size'];
            // img naming
    $rand= date("Ymd")."_".rand(10000,99999);
    $exe=pathinfo($fileName,PATHINFO_EXTENSION);
    $newName=$rand.".".$exe;
    $upload_path = '../asset/category/'; // set upload folder path
    $user_obj->image='asset/category/'.$newName;
    $user_obj->imageurl='{{BaseUrl}}}/asset/category/'.$newName;
    if ($user_obj->createCategories()) {
        $last_id=mysqli_insert_id($connection);
        move_uploaded_file($tempPath, $upload_path . $newName); // move img from system temporary path to our upload folder path 
        http_response_code(200);
        echo json_encode(array(
        "status"=>true,
        "message"=>"successfully created",
        "data"=>array(
            "id"=>$last_id,
            "category"=> $user_obj->name,
            "image"=>$user_obj->image,
            "imageUrl"=>$user_obj->imageurl,
        )
    ));
        }else{
            http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "message"=>"query not run"
        ));
            }
    }else{
        http_response_code(200);
        echo json_encode(array(
        "status"=>false,
        "message"=>"empty"
    ));
        }
}else{
    http_response_code(500);
    echo json_encode(array(
    "status"=>false,
    "message"=>"server error"
));
}
?>