<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Categories.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Categories($connection);
if($_SERVER['REQUEST_METHOD'] === "PUT"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->id) && !empty($data->name) && !empty($data->subcategory_id) && !empty($data->value)) {
        $user_obj->id=$data->id;
        $user_obj->name=$data->name;
        $user_obj->subcategory_id=$data->subcategory_id;
        $user_obj->value=$data->value;
        if ($user_obj->updateAttributes()) {
            $last_id=mysqli_insert_id($connection);

            http_response_code(200);
            echo json_encode(array(
            "status"=>true,
            "message"=>"successfully update",
            "data"=>array(
                "id"=>$user_obj->id,
                "name"=> $user_obj->name,
                "subcategory_id"=> $user_obj->subcategory_id,
                "value"=> $user_obj->value
            )
        ));
        }else{
            http_response_code(200);
            echo json_encode(array(
            "status"=>false
        ));
            }
    }else{
        http_response_code(200);
        echo json_encode(array(
        "status"=>false
    ));
        }
}else{
    http_response_code(500);
    echo json_encode(array(
    "status"=>false
));
}
?>