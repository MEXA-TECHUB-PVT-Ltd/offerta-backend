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
    if (!empty($data->user_id) && !empty($data->listing_id)) {
    $user_obj->user_id=$data->user_id;
    $user_obj->listing_id=$data->listing_id;
    if ($user_obj->CheckDisLike()) {
        # code...
    if ($user_obj->DisLike()) {
        http_response_code(200);
        echo json_encode(array(
            "status"=>true,
            "message"=>"List has been Dis liked",
            "data"=>array(
                "user_id"=>$user_obj->user_id,
                "listing_id"=>$user_obj->listing_id
            )
    ));
    }else{
        http_response_code(200);
        echo json_encode(array(
            "status"=>false,
            "message"=>"Failed to DisLike"
    ));
        }
    }else{
        http_response_code(200);
        echo json_encode(array(
            "status"=>false,
            "message"=>"Already like"
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