<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Shipping.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Shipping($connection);
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->user_id) && !empty($data->country) && !empty($data->address_1) && !empty($data->address_2) 
    && !empty($data->city) && !empty($data->state) && !empty($data->zipcode) && !empty($data->phone_no)) {
        $user_obj->user_id=$data->user_id;
        $user_obj->country=$data->country;
        $user_obj->address_1=$data->address_1;
        $user_obj->address_2=$data->address_2;
        $user_obj->city=$data->city;
        $user_obj->state=$data->state;
        $user_obj->zipcode=$data->zipcode;
        $user_obj->phone_no=$data->phone_no;
        if ($user_obj->checkuser_id()) {
        if ($user_obj->createShipping()) {
            $last_id=mysqli_insert_id($connection);
            # code...
        http_response_code(200);
        $data2=array(
            "id"=>"$last_id",
            "user_id"=>$data->user_id,
            "country"=>$data->country,
            "address_1"=>$data->address_1,
            "address_2"=>$data->address_2,
            "city"=>$data->city,
            "state"=>$data->state,
            "zipcode"=>$data->zipcode,
            "phone_no"=>$data->phone_no


        );
        echo json_encode(array(
        "data"=>$data2,
        "status"=>true,
        "message"=>"Shipping created"
    ));
        }else{
            http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "message"=>"Failed to create"
        ));
            }
        }else{
            http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "message"=>"user not exist"
        ));
            }
    }else{
        http_response_code(200);
        echo json_encode(array(
        "status"=>false,
        "message"=>"All data Needed"
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