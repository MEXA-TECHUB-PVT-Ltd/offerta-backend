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
if (isset($_GET["time"])){
    $user_obj->time = $_GET["time"];
}
if (isset($_GET["distance"])){
    $user_obj->distance = $_GET["distance"];
}
if (isset($_GET["lat"])){
    $user_obj->distance_lat = $_GET["lat"];
}
 if(isset($_GET["log"])){
    $user_obj->distance_log = $_GET["log"];

 } 
  if(isset($_GET["price"])){
    $user_obj->price = $_GET["price"];

  }
   if(isset($_GET["category_id"])){
    $user_obj->category_id = $_GET["category_id"];

   } 
   if(isset($_GET["timeago"])){
    $user_obj->agoTime = $_GET["timeago"];

   }
    if (isset($_GET["sort"])){
    $user_obj->sort = $_GET["sort"];
    } 
    if ($row=$user_obj->Distance()) {
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
    http_response_code(500);
    echo json_encode(array(
    "status"=>false,
    "message"=>"server error"
    ));
    }