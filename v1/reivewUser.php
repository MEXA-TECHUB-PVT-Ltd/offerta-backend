<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Like.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Like($connection);
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->user_id) && !empty($data->reviewed_user_id) && !empty($data->review)) {
        $user_obj->user_id=$data->user_id;
        $user_obj->reviewed_user_id=$data->reviewed_user_id;
        $user_obj->review=$data->review;
        if ($user_obj->checkReview()) {
            http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "msg"=>"User Already reviewed"
        ));
        }elseif ($row=$user_obj->reviewUser()) {
            http_response_code(200);
            echo json_encode(array(
            "status"=>true,
            "Message"=>"Review Created"
        ));
        }else {
            http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "msg"=>"failed to create review"
        ));
        }
    
}else{
    http_response_code(200);
    echo json_encode(array(
    "status"=>false,
    "message"=>"all data needed"
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