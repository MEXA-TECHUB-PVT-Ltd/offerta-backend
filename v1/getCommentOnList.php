<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Like.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Like($connection);
if($_SERVER['REQUEST_METHOD'] === "GET"){
    if (!empty($_GET["listing_id"])){
        $listing_id = $_GET["listing_id"];
        $user_obj->listing_id=$listing_id;
        if ($row=$user_obj->getAllOnListId()) {
            http_response_code(200);
            echo json_encode($row);
        }else {
            http_response_code(200);
            echo json_encode(array(
            "status"=>true,
            "msg"=>"No Result"
        ));
        }
    
}else{
    http_response_code(200);
    echo json_encode(array(
    "status"=>false,
    "message"=>"id is null"
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