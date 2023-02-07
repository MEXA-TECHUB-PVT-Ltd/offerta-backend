<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Offer.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new offer($connection);
if($_SERVER['REQUEST_METHOD'] === "PUT"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->status) && !empty($data->id)) {
    $user_obj->id=$data->id;
    $user_obj->status=$data->status;
    if ($user_obj->updateStatus()) {
        http_response_code(200);
        echo json_encode(array(
            "status"=>true,
            "message"=>"Offer status is ".$user_obj->status." "
    ));
    }else{
        http_response_code(200);
        echo json_encode(array(
            "status"=>false,
            "message"=>"Failed to update Comment"
    ));
        }
}else{
    http_response_code(200);
    echo json_encode(array(
        "status"=>false,
        "message"=>"All data needed"
));
    }
}else{
http_response_code(500);
echo json_encode(array(
"status"=>false,
"message"=>"Server error"
));
}
?>