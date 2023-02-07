<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Filter.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Filter($connection);
if($_SERVER['REQUEST_METHOD'] === "GET"){
    if (!empty($_GET["from_price"]) && !empty($_GET["to_price"])){
        $from_price = $_GET["from_price"];
        $to_price = $_GET["to_price"];
        $user_obj->from_price=$from_price;
        $user_obj->to_price=$to_price;
        if ($row=$user_obj->priceFilter()) {
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
    "message"=>"all data needed"
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