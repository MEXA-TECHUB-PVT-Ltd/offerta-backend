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
    if (!empty($data->id) && !empty($data->name) && !empty($data->category_id)) {
        $user_obj->id=$data->id;
        $user_obj->name=$data->name;
        $user_obj->cat_id=$data->category_id;
        if ($user_obj->updateSubCategories()) {
            http_response_code(200);
            echo json_encode(array(
            "status"=>true,
            "message"=>"successfully updated",
            "data"=>array(
                "id"=>$user_obj->id,
                "sub_category"=> $user_obj->name,
                "category_id"=> $user_obj->cat_id
            )
    ));
        }else{
            http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "message"=>"failed to update"
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
    "message"=>"server error",
));
}
?>