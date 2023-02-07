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
    if (!empty($data->id) &&!empty($data->user_id) && !empty($data->feature_price) && !empty($data->features_id) && !empty($data->advertisement_detail_id)) {
        $user_obj->id=$data->id;
        $user_obj->user_id=$data->user_id;
        $user_obj->feature_price=$data->feature_price;
        $user_obj->features_id=$data->features_id;
        $user_obj->ad_detail_id=$data->advertisement_detail_id;
    if ($user_obj->UpdatePromotion()) {
        http_response_code(200);
        echo json_encode(array(
        "data"=>$data,
        "status"=>true,
        "Message"=>"Promotion Updated"
        
    ));
        }else{
            http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "Message"=>"Promotion Fail to Update"
        ));
            }
    }else{
        http_response_code(200);
        echo json_encode(array(
        "status"=>false,
        "Message"=>"Promotion Data is requaired"
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