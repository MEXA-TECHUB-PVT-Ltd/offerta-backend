<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/SaleOrder.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new SaleOrder($connection);
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->sale_by) && !empty($data->order_by) && !empty($data->listing_id) && !empty($data->shipping_id) ){
        $user_obj->sale_by=$data->sale_by;
        $user_obj->order_by=$data->order_by;
        $user_obj->listing_id=$data->listing_id;
        $user_obj->shipping_id=$data->shipping_id;

        if ($user_obj->createOrder()) {
            $last_id=mysqli_insert_id($connection);
            $data2=array(
                "id"=>"$last_id",
                "sale_by"=>$data->sale_by,
                "order_by"=>$data->order_by,
                "listing_id"=>$data->listing_id,
                "shipping_id"=>$data->shipping_id,
                "status"=>"pending"
            );
            http_response_code(200);
            echo json_encode(array(
            "data"=>$data2,
            "status"=>true,
            "message"=>"Order Created Successfully"
        ));
        }else {
            http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "message"=>"failed to created"
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
"message"=>"server error"
));
}
?>