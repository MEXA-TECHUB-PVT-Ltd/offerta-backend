<?php
   use PHPMailer\PHPMailer\PHPMailer;
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/User.php");





// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Users($connection);
if($_SERVER['REQUEST_METHOD'] === "POST"){

$data =json_decode(file_get_contents("php://input"));
if(empty($data->email)){
    http_response_code(200);
    echo json_encode(array(
        "status"=>false,
        "message"=>"email is empty"
    ));
}elseif (!filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(200);
    echo json_encode(array(
        "status"=>false,
        "message"=>"Email is not valid"
    ));
}
elseif(empty($data->password)){
    http_response_code(200);
    echo json_encode(array(
        "status"=>false,
        "message"=>"Password is empty"
    ));
} 
elseif(empty($data->conformPassword)){
    http_response_code(200);
    echo json_encode(array(
        "status"=>false,
        "message"=>"Confirm password is empty"
    ));
}elseif ($data->password != $data->conformPassword) {
    # code...
    http_response_code(200);
    echo json_encode(array(
        "status"=>false,
        "message"=>"Password are not same"
    ));
} 
elseif (!empty($data)) {
$user_obj->email=$data->email;
$user_obj->password=password_hash($data->password, PASSWORD_DEFAULT);
if(empty($row=$user_obj->searchByEmail())){
    if($user_obj->create_user()){
        $row2=$user_obj->searchByEmail();
        $id=$row2["id"];
        $email=$row2["email"];
        $data2=array(
            "id"=>$id,
            "email"=>$email,
            "password"=>$data->password
        );
            http_response_code(200);
            echo json_encode(array(
                "data"=>$data2,
                "status"=>true,
                "message"=>"User Register successful"
            ));
    }else{
        http_response_code(200);
        echo json_encode(array(
            "status"=>false,
            "message"=>"Failed Registeration "
        ));
    }
}else{
    http_response_code(200);
    echo json_encode(array(
        "status"=>false,
        "message"=>"User Already Registered"
    ));
}

}else{
    http_response_code(200);
    echo json_encode(array(
        "status"=>false,
        "message"=>"Please input correct value"
    ));
}

}else{
http_response_code(503);
echo json_encode(array(
    "status"=>false,
    "message"=>"internal server error"
));
}
?>