<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/User.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Users($connection);
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->email) && !empty($data->code)) {
    $user_obj->email=$data->email;
    $user_obj->code=$data->code;
    if(!empty($row=$user_obj->searchByEmail2())){
        $code=$row["email_code"];
        if ($code == $user_obj->code) {
            if ($user_obj->emailStatus()) {
                # code...
                http_response_code(200);
                echo json_encode(array(
                "status"=>true,
                "message"=>"Your Email $user_obj->email is verified successful"
            ));
            }else {
                http_response_code(200);
            echo json_encode(array(
                "status"=>false,
                "message"=>"Your code is correct but cannot verified"
            ));
            }
        }else{
            http_response_code(200);
            echo json_encode(array(
                "status"=>false,
                "message"=>"Your code is incorrect"
            ));
        }
    
    }else{
        http_response_code(200);
        echo json_encode(array(
            "status"=>false,
            "message"=>"Wrong Email"
        ));
    }

    }else{
    http_response_code(503);
    echo json_encode(array(
    "status"=>false,
    "message"=>"Server error"
));
    }

}
?>