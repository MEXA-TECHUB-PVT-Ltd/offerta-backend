<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Banner.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Banner($connection);
if($_SERVER['REQUEST_METHOD'] === "PUT"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->id) && !empty($data->description) && !empty($data->app_cost) && !empty($data->app_size) && !empty($data->web_size) && !empty($data->web_cost)) {
        $user_obj->id=$data->id;
        $user_obj->app_cost=$data->app_cost;
        $user_obj->description= $data->description;
        $user_obj->web_cost=$data->web_cost;
        $user_obj->app_size=$data->app_size;
        $user_obj->web_size=$data->web_size;
        if ($user_obj->update_banner()) {
            http_response_code(200);
            echo json_encode(array(
            "data"=>$data,
            "status"=>true,
            "message"=>"banner Updated Successfully"
        ));
        }else{
            http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "message"=>"banner Updated Successfully"
        ));
            }


    }else{
        http_response_code(200);
        echo json_encode(array(
        "status"=>false,
        "message"=>"banner data is required"
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