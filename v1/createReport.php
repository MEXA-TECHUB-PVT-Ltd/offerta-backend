<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Reports.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Reports($connection);
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->reportedBy_user_id) && !empty($data->reported_user_id)) {
        $user_obj->reportedBy_user_id=$data->reportedBy_user_id;
        $user_obj->reported_user_id=$data->reported_user_id;
        if ($user_obj->createReport()) {
            # code...
        http_response_code(200);
        echo json_encode(array(
        "status"=>true,
        "message"=>"User reported successfully"
    ));
        }else{
            http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "message"=>"User reported Failed"

        ));
            }
    }else{
        http_response_code(200);
        echo json_encode(array(
        "status"=>false,
        "message"=>"All data needed"

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