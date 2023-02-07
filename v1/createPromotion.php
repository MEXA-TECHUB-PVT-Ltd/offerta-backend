<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Promotion.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Promotion($connection);
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->user_id) && !empty($data->listing_id) && !empty($data->feature_price) && !empty($data->features_id) && !empty($data->advertisement_detail_id)) {
        $user_obj->user_id=$data->user_id;
        $user_obj->listing_id=$data->listing_id;
        $user_obj->feature_price=$data->feature_price;
        $user_obj->features_id=$data->features_id;
        $user_obj->ad_detail_id=$data->advertisement_detail_id;

    if ($user_obj->check_user_id()) {
    if ($user_obj->check_features_id()) {
    if ($user_obj->advertisement_detail_id()) {
    if ($user_obj->createPromotion()) {
        $last_id=mysqli_insert_id($connection);
        $data2=array(
            "id"=>"$last_id",
            "user_id"=>"$data->user_id",
            "listing_id"=>"$data->listing_id",
            "feature_price"=>"$data->feature_price",
            "features_id"=>"$data->features_id",
            "advertisement_detail_id"=>"$data->advertisement_detail_id"
        );
        http_response_code(200);
        echo json_encode(array(
        "data"=>$data2,
        "status"=>true,
        "Message"=>"Promotion Created"
    ));
        }else{
            http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "Message"=>"Promotion Failed to Create"
        ));
            }
        }else{
            http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "Message"=>"advertisement detail not exist"
        ));
            }
        }else{
            http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "Message"=>"feature not exist"
        ));
            }
        }else{
            http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "Message"=>"user not exist"
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