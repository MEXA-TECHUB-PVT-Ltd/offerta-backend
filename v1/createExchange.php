<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Exchange.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Exchange($connection);
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->user_id) && !empty($data->second_user) && !empty($data->item) && !empty($data->item2)) {
        {
        $user_obj->user_id=$data->user_id;
        $user_obj->second_user=$data->second_user;
        $user_obj->item=$data->item;
        $user_obj->item2=$data->item2;
        if($user_obj->checkuser_id()){
        if($user_obj->checksecond_user()){
        if($user_obj->checkitem()){
        if($user_obj->checkitem()){
            if ($user_obj->createExchange()) {
                http_response_code(200);
                echo json_encode(array(
                    "data"=>$data,
                    "status"=>true,
                    "message"=>"Exchange Created Successfully"
            ));
            }else{
                http_response_code(200);
                echo json_encode(array(
                    "status"=>false,
                    "message"=>"failed to created exchange"
            ));
                }
  
        }else{
            http_response_code(200);
            echo json_encode(array(
                "status"=>false,
                "message"=>"Item is not exist"
        ));
        }
        }else{
            http_response_code(200);
            echo json_encode(array(
                "status"=>false,
                "message"=>"Item2 is not exist"
        ));
        }
        }else{
            http_response_code(200);
            echo json_encode(array(
                "status"=>false,
                "message"=>"second user not exist"
        ));
        }
        }else{
            http_response_code(200);
            echo json_encode(array(
                "status"=>false,
                "message"=>"user_id not exist"
        ));
        }

     
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