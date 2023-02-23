<?php
// debuger
ini_set("display_errors",1);
session_start();
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
    if (!empty($data->email) && !empty($data->newpassword) && !empty($data->cpassword)) {
        $user_obj->email=$data->email;
        $password=$data->newpassword;
        $cpassword=$data->cpassword;
    if ($password == $cpassword) {
        $user_obj->password=password_hash($password, PASSWORD_DEFAULT);
        if($user_obj->resetPassword()){
            http_response_code(200);
            echo json_encode(array(
            "status"=>true,
            "message"=>"Password Reset Successfully"
    ));
            }else{
                http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "massage"=>"failed to change password"
    ));
            }
    
        }else{
            http_response_code(200);
        echo json_encode(array(
        "status"=>false,
        "message"=>"New Password and Confirm Password Should be Same"
));
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