<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Stripe.php");
require 'config.php';
\Stripe\Stripe::setVerifySslCerts(false);
// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Stripe($connection);
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->user_id) && !empty($data->price) && !empty($data->stripeToken)){
        $user_id = $data->user_id;
        $price = $data->price;
        $stripeToken = $data->stripeToken;
        $currency = $data->currency;
        $charge = \Stripe\Charge::create([
            'amount' => $price,
            'currency' => $currency,
            'description' => 'Example charge',
            'source' => $stripeToken,
        ]);
        if ($charge) {
            http_response_code(200);
            echo json_encode(array(
            "status"=>true,
            "message"=>"Payment Successful",
            "detail"=>$charge
        ));
        }
    }else{
        http_response_code(200);
        echo json_encode(array(
        "status"=>false,
        "message"=>"id is null"
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