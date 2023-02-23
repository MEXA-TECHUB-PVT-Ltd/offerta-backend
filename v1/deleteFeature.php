<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Promotion.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Promotion($connection);
if($_SERVER['REQUEST_METHOD'] === "DELETE"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->id)){
        $user_obj->id=$data->id;
        if ($user_obj->deleteFeature()) {
            http_response_code(200);
            echo json_encode(array(
            "status"=>true,
            "Message"=>"Feature DELETE",
        ));
        }else {
            http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "Message"=>"failed to delete",
        ));
        }
    
}else{
    http_response_code(200);
    echo json_encode(array(
    "status"=>false,
    "Message"=>"all data needed",
));
    }
}else{
http_response_code(500);
echo json_encode(array(
"status"=>false,
"Message"=>"server error",
));
}
?>