<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/User.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Users($connection);
if($_SERVER['REQUEST_METHOD'] === "PUT"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->user_id) && !empty($data->username) && !empty($data->full_name)) {
        {
        
        $user_obj->id=$data->user_id;
        $user_obj->username=$data->username;
        $user_obj->full_name=$data->full_name;
        if ($user_obj->updateProfile()) {
            http_response_code(200);
            echo json_encode(array(
                "data"=>$data,
                "status"=>true,
                "message"=>"profile Updated Successfully"
        ));
        }else{
            http_response_code(200);
            echo json_encode(array(
                "status"=>false,
                "message"=>"failed to update"
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
    "message"=>"server error"
));
}
?>