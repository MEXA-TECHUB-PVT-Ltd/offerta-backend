<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Listing.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Listing($connection);
if($_SERVER['REQUEST_METHOD'] === "DELETE"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->id)){
        $user_obj->id=$data->id;
        if ($user_obj->deleteList()) {
            http_response_code(200);
            echo json_encode(array(
            "status"=>true,
            "message"=>"List deleted Successfully"
        ));
        }else {
            http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "message"=>"failed to delete list"
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