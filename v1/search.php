<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Listing.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Listing($connection);
if($_SERVER['REQUEST_METHOD'] === "GET"){
    if (!empty($_GET["search"])){
        $search = $_GET["search"];
        $user_obj->search=$search;
        if ($row=$user_obj->searchList()) {
            http_response_code(200);
            echo json_encode($row);
        }else{
            http_response_code(404);
            echo json_encode(array(
                "status"=>false,
                "message"=>"No Result"
        ));
            }
        
    }else{
        http_response_code(200);
        echo json_encode(array(
            "status"=>false,
            "message"=>"Search Unavaliable"
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