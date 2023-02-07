<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Promotion.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Promotion($connection);
if($_SERVER['REQUEST_METHOD'] === "GET"){
    if (!empty($_GET["id"])){
        $id = $_GET["id"];
        $user_obj->id=$id;
        if ($row=$user_obj->getFeatureById()) {
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