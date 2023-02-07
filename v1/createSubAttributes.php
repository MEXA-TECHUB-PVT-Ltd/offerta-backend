<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Categories.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Categories($connection);
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->name) && !empty($data->attributes_id) && !empty($data->value)) {
        $user_obj->name=$data->name;
        $user_obj->attributes_id=$data->attributes_id;
        $user_obj->value=$data->value;
        if ($user_obj->createSubAttributes()) {
            $last_id=mysqli_insert_id($connection);
            # code...
        http_response_code(200);
        echo json_encode(array(
            "status"=>true,
            "message"=>"successfully created",
            "data"=>array(
                "id"=>$last_id,
                "sub_attribute_name"=> $user_obj->name,
                "attribute_id"=> $user_obj->attributes_id,
                "value"=> $user_obj->value
            )
    ));
        }else{
            http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "message"=>"failed to create"
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