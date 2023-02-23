<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Shipping.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Shipping($connection);
if($_SERVER['REQUEST_METHOD'] === "PUT"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->id) && !empty($data->user_id) && !empty($data->country) && !empty($data->address_1) && !empty($data->address_2) 
    && !empty($data->city) && !empty($data->state) && !empty($data->zipcode) && !empty($data->phone_no)) {
        $user_obj->id=$data->id;
        $user_obj->user_id=$data->user_id;
        $user_obj->country=$data->country;
        $user_obj->address_1=$data->address_1;
        $user_obj->address_2=$data->address_2;
        $user_obj->city=$data->city;
        $user_obj->state=$data->state;
        $user_obj->zipcode=$data->zipcode;
        $user_obj->phone_no=$data->phone_no;
        if ($user_obj->updateShipping()) {
            # code...
        http_response_code(200);
        echo json_encode(array(
            "data"=>$data,
            "status"=>true,
            "message"=>"Update Successful"
    ));
        }else{
            http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "message"=>"Failed to update"
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