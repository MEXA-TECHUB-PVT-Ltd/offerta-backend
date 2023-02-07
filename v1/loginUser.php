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
if(!empty($data->email) && !empty($data->password)){
$user_obj->email=$data->email;
 $user_obj->password=$data->password;
 
//  $row=$user_obj->searchByEmail();
 if(!empty($row=$user_obj->searchByEmail())){
 $passwordFetch = $row["password"];
if (password_verify($user_obj->password,$passwordFetch)) {
    http_response_code(200);
    echo json_encode(array(
        "data"=>$row,
        "status"=>true,
        "message"=>"Login Successful"
    ));
}else{
        http_response_code(200);
    echo json_encode(array(
        "status"=>false,
        "message"=>"Password Incorrect"
    ));
}
 }else{
    http_response_code(200);
    echo json_encode(array(
        "status"=>false,
        "message"=>"Email not registered"
    ));
 }
}else{
    http_response_code(200);
        echo json_encode(array(
            "status"=>false,
            "message"=>"All Data Needed"
        ));
}
}else{
    http_response_code(503);
echo json_encode(array(
    "status"=>false,
    "message"=>"Server Error"
));
}
?>