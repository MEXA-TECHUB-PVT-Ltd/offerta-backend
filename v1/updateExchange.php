<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Exchange.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Exchange($connection);
if($_SERVER['REQUEST_METHOD'] === "PUT"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->id) && !empty($data->user_id) && !empty($data->second_user) && !empty($data->item) && !empty($data->item2) && !empty($data->status)) {
        {
        
        $user_obj->id=$data->id;
        $user_obj->user_id=$data->user_id;
        $user_obj->second_user=$data->second_user;
        $user_obj->item=$data->item;
        $user_obj->item2=$data->item2;
        $user_obj->status=$data->status;
        if($user_obj->checkexchange()){
        if ($user_obj->updateExchange()) {
            http_response_code(200);
            echo json_encode(array(
                "data"=>$data,
                "status"=>true,
                "message"=>"Exchange request Updated"
        ));
        }else{
            http_response_code(200);
            echo json_encode(array(
                "status"=>false,
                "message"=>"Exchange request Failed"
        ));
            }
        }else{
            http_response_code(200);
            echo json_encode(array(
                "status"=>false,
                "message"=>"Item is not allowed to be exhange"
        ));
        }
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
    "message"=>"server error"
));
}
?>