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

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Stripe($connection);
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->user_id) && !empty($data->private_key) && !empty($data->public_key)) {
        $data =json_decode(file_get_contents("php://input"));
       
        
        $user_obj->user_id=$data->user_id;
        $user_obj->private_key=$data->private_key;
        $user_obj->public_key=$data->public_key;
        if ($user_obj->createStripe()) {
            $last_id = mysqli_insert_id($connection);
            http_response_code(200);
            $data2=array(
                "id"=>"$last_id",
                "user_id"=>$data->user_id,
                "private_key"=>$data->private_key,
                "public_key"=>$data->public_key

            );
            echo json_encode(array(

                "data"=>$data2,
                "status"=>true,
                "message"=>"Payment Successfull"
        ));
        }else{
            http_response_code(200);
            echo json_encode(array(
                "status"=>false,
                "message"=>"failed to store data"
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