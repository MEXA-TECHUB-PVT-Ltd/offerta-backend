<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Content-type:application/json; charst= UTF-8");


// file include
include_once("../config/database.php");
include_once("../classes/User.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Users($connection);
if($_SERVER['REQUEST_METHOD'] === "PUT"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->password) && !empty($data->newpassword) && !empty($data->confirmpassword) && !empty($data->id) ) {
        $user_obj->id=$data->id;
        $password=$data->password;
        $newPassword=$data->newpassword;
        $conformPassword=$data->confirmpassword;
    if ($newPassword == $conformPassword) {
        $user_obj->password=password_hash($conformPassword, PASSWORD_DEFAULT);
        if(!empty($row=$user_obj->searchById())){
            $fetchPassword= $row["password"];
            if (password_verify($password,$fetchPassword)) {
                if($user_obj->updatePassword()){
                    http_response_code(200);
                    echo json_encode(array(
                    "status"=>true,
                    "message"=>"password updated"
            ));
                    }else{
                        http_response_code(200);
                    echo json_encode(array(
                    "status"=>false,
                    "message"=>"Failed to change password"
            ));
                    }
                
                }else{
                    http_response_code(200);
                echo json_encode(array(
                "status"=>false,
                "message"=>"Password Incorrect"
        ));
                }

            }else{
                http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "message"=>"No user Found"
    ));
            }
    
        }else{
            http_response_code(200);
        echo json_encode(array(
        "status"=>false,
        "message"=>"new Password and confirm password are not same"
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