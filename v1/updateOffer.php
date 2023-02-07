<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Offer.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new offer($connection);
if($_SERVER['REQUEST_METHOD'] === "PUT"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->id) && !empty($data->user_id) && !empty($data->sale_by) && !empty($data->listing_id) && !empty($data->price)) {
        {
        
        $user_obj->id=$data->id;
        $user_obj->user_id=$data->user_id;
        $user_obj->sale_by=$data->sale_by;
        $user_obj->listing_id=$data->listing_id;
        $user_obj->price=$data->price;
        if ($user_obj->updateOffer()) {
            http_response_code(200);
            echo json_encode(array(
                "data"=>$data,
                "status"=>true,
                "message"=>"offer Updated Successfully"
        ));
        }else{
            http_response_code(200);
            echo json_encode(array(
                "status"=>false,
                "message"=>"failed to update"
        ));
            }
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
    "message"=>"server error"
));
}
?>