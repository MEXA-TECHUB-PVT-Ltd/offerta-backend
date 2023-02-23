<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Listing.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Listing($connection);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    if (
        !empty($data->user_id) && !empty($data->title) && !empty($data->description) && !empty($data->price) && !empty($data->category_id)
        && !empty($data->subcategory_id) && !empty($data->location) && !empty($data->location_lat) && !empty($data->location_log) && !empty($data->product_condition) && !empty($data->shipping_cost)
    ) {

        $user_obj->user_id = $data->user_id;
        $user_obj->title = $data->title;
        $user_obj->description = $data->description;
        $user_obj->price = $data->price;
        $user_obj->category_id = $data->category_id;
        $user_obj->subcategory_id = $data->subcategory_id;
        $user_obj->product_condition = $data->product_condition;

        if (!empty($data->youtube_link)) {
            $user_obj->youtube_link = $data->youtube_link;
        }
        $user_obj->fixed_price = $data->fixed_price;
        $user_obj->location = $data->location;
        $user_obj->location_lat = $data->location_lat;
        $user_obj->location_log = $data->location_log;
        $user_obj->exchange = $data->exchange;
        $user_obj->giveaway = $data->giveaway;
        $user_obj->shipping_cost = $data->shipping_cost;
        if ($user_obj->createListing()) {
            # code...
            $last_id = mysqli_insert_id($connection);
            http_response_code(200);
            echo json_encode(
                array(
                    "id" => "$last_id",
                    "user_id" => $user_obj->user_id,
                    "title" => $user_obj->title,
                    "description" => $user_obj->description,
                    "price" => $user_obj->price,
                    "category_id" => $user_obj->category_id,
                    "subcategory_id" => $user_obj->subcategory_id,
                    "product_condition" => $user_obj->product_condition,
                    "youtube_link" => $user_obj->youtube_link,
                    "fixed_price" => $user_obj->fixed_price,
                    "location" => $user_obj->location,
                    "location_lat" => $user_obj->location_lat,
                    "location_log" => $user_obj->location_log,
                    "exchange" => $user_obj->exchange,
                    "shipping_cost" => $user_obj->shipping_cost,
                    "status" => true,
                    "message" => "List Created Successfully"
                )
            );
        } else {
            http_response_code(200);
            echo json_encode(
                array(
                    "status" => false,
                    "message" => "Failed to created"
                )
            );
        }
    } else {
        http_response_code(200);
        echo json_encode(
            array(
                "status" => false,
                "message" => "all data needed"
            )
        );
    }
} else {
    // Return a response indicating that the upload failed
    http_response_code(500);
    echo json_encode(array(
    "status"=>false,
    "message"=>"server error",
));
}
?>