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
    if (!empty($data->user_id) && !empty($data->chat_with)) {
        $user_obj->user_id=$data->user_id;
        $user_obj->second_user=$data->chat_with;
        if($user_obj->checkuser_id()){
        if($user_obj->checksecond_user()){
            if ($user_obj->createCommunity()) {
                http_response_code(200);
                echo json_encode(array(
                    "data"=>$data,
                    "status"=>true,
                    "message"=>"Chat Community Created"
            ));
            }else{
                http_response_code(200);
                echo json_encode(array(
                    "status"=>false,
                    "message"=>"Chat Community Already Exist"
            ));
                }

        }else{
            http_response_code(503);
            echo json_encode(array(
                "status"=>false,
                "message"=>"Chat user invalid"
        ));
        }
        }else{
            http_response_code(503);
            echo json_encode(array(
                "status"=>false,
                "message"=>"User id invalid"
        ));
        }
        }else{
            http_response_code(503);
            echo json_encode(array(
                "status"=>false,
                "message"=>"User and Chat With user will not empty"
        ));
        }
        }else{
            http_response_code(503);
            echo json_encode(array(
                "status"=>false,
                "message"=>"Server Error"
        ));
        }