<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Promotion.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Promotion($connection);
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->offer_time) && !empty($data->no_of_days_for_running_ad) && !empty($data->price)) {
        $user_obj->offer_time=$data->offer_time;
        $user_obj->no_of_days_for_running_ad=$data->no_of_days_for_running_ad;
        $user_obj->price=$data->price;
        if ($user_obj->createAdvertisementDetail()) {
            $last_id=mysqli_insert_id($connection);

            http_response_code(200);
            echo json_encode(array(
            "status"=>true,
            "message"=>"successfully created",
            "data"=>array(
                "id"=>$last_id,
                "offer_time"=> $user_obj->offer_time,
                "no_of_days_for_running_ad"=> $user_obj->no_of_days_for_running_ad,
                "price"=> $user_obj->price

            )
        ));
        }else{
            http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "message"=>"failed to create",
        ));
            }
    }else{
        http_response_code(200);
        echo json_encode(array(
        "status"=>false,
        "message"=>"all data needed",
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