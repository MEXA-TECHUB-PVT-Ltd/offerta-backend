<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/View.php");

// object
$db= new Database();
$connection=$db->connect();
$user_obj = new View($connection);
if($_SERVER['REQUEST_METHOD'] === "PUT"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->user_id) && !empty($data->listing_id) && !empty($data->city) && !empty($data->country)) {
        $user_obj->user_id=$data->user_id;
        $user_obj->list_id=$data->listing_id;
        $user_obj->city=$data->city;
        $user_obj->country=$data->country;
        if ($user_obj->createView()) {
            $user_obj->id=$user_obj->list_id;
            $view=$user_obj->UpdateViewOnList();
            http_response_code(200);
            echo json_encode(array(
            "status"=>true,
            "message"=>"visited city successfully Update",
            "data"=>array(
                "user_id"=> $user_obj->user_id,
                "listing_id"=> $user_obj->list_id,
                "city"=> $user_obj->city,
                "country"=> $user_obj->country
            )
        ));
        }else{
            http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "Message"=>"view Fail to Create"
        ));
            }
    }else{
        http_response_code(200);
        echo json_encode(array(
        "status"=>false,
        "Message"=>"id is required"
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