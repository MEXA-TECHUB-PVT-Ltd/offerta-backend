<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Exchange.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Exchange($connection);
if($_SERVER['REQUEST_METHOD'] === "GET"){
    if (!empty($_GET["id"])){
        $list_id = $_GET["id"];
        $user_obj->id=$list_id;
        if ($row=$user_obj->readNotification()) {
            http_response_code(200);
            echo json_encode(array(
            "status"=>true,
            "msg"=>"Notification Readed"
        ));
        }else {
            http_response_code(200);
            echo json_encode(array(
            "status"=>true,
            "msg"=>"failed to read"
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
"message"=>"server error"
));
}
?>