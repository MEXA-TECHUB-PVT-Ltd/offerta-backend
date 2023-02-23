<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Offer.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new offer($connection);
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->user_id) && !empty($data->sale_by) && !empty($data->listing_id) && !empty($data->price)) {
        {
        $user_obj->user_id=$data->user_id;
        $user_obj->sale_by=$data->sale_by;
        $user_obj->listing_id=$data->listing_id;
        $user_obj->price=$data->price;
        if ($user_obj->checkuser_id()) {
        if ($user_obj->checksale_by()) {
        if ($user_obj->checklisting()) {
        if ($user_obj->createOffer()) {
            $last_id=mysqli_insert_id($connection);
            http_response_code(200);
            $data2=array(
                "id"=>"$last_id",
                "user_id"=>$data->user_id,
                "listing_id"=>$data->listing_id,
                "sale_by"=>$data->sale_by,
                "price"=>$data->price,
            );
            echo json_encode(array(
                "data"=>$data2,
                "status"=>true,
                "message"=>"Offer Created Successfully"
        ));
        }else{
            http_response_code(200);
            echo json_encode(array(
                "status"=>false,
                "message"=>"Failed to create offer"
        ));
            }
        }else{
            http_response_code(200);
            echo json_encode(array(
                "status"=>false,
                "message"=>"listing id not exist"
        ));
            }
        }else{
            http_response_code(200);
            echo json_encode(array(
                "status"=>false,
                "message"=>"seller not exist"
        ));
            }
        }else{
            http_response_code(200);
            echo json_encode(array(
                "status"=>false,
                "message"=>"user_id is not exist"
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
    "message"=>"Server error"
));
}
?>