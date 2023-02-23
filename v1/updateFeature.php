<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Promotion.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Promotion($connection);
if($_SERVER['REQUEST_METHOD'] === "PUT"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->id) && !empty($data->title)) {
        $user_obj->id=$data->id;
        $user_obj->title=$data->title;
        if ($user_obj->updateFeatures()) {
            # code...
        http_response_code(200);
        echo json_encode(array(
        "status"=>true,
        "Message"=>"Feature Updated",
            "data"=>array(
                "id"=>$user_obj->id,
                "title"=> $user_obj->title
            )
        
    ));
        }else{
            http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "Message"=>"Feature Fail to Create"
        ));
            }
    }else{
        http_response_code(200);
        echo json_encode(array(
        "status"=>false,
        "Message"=>"Feature is requaired"
    ));
        }
}else{
    http_response_code(500);
    echo json_encode(array(
    "status"=>false,
    "Message"=>"Internal Server error"
));
}
?>