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
    if (!empty($data->user_id) && !empty($data->listing_id) && !empty($data->type)) {
        if ($data->type == 'urgent'){
            $feature=$user_obj->selectAllFeature();
            $user_obj->features_id = $feature["id"];
            $user_obj->ad_detail_id ="";
        }else{
            $user_obj->ad_detail_id = $data->promotion_type_id;
            $user_obj->features_id = "";
        }
        $user_obj->user_id = $data->user_id;
        $user_obj->listing_id = $data->listing_id;
    if ($user_obj->createPromotion()) {
        $last_id=mysqli_insert_id($connection);
        if (empty($user_obj->ad_detail_id)) {
            $data2=array(
                "id"=>"$last_id",
                "user_id"=>"$data->user_id",
                "listing_id"=>"$data->listing_id",
                "type"=>"$data->type",
                "promotion_type_id"=>"$data->promotion_type_id"
            );
        }else{
            $data2=array(
                "id"=>"$last_id",
                "user_id"=>"$data->user_id",
                "listing_id"=>"$data->listing_id",
                "type"=>"advertisement",
                "promotion_type_id"=>"$data->promotion_type_id"
            );
        }
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