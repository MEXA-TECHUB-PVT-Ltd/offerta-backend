<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");
include_once("../classes/Like.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Like($connection);
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->user_id) && !empty($data->following_id)) {
    $user_obj->user_id=$data->user_id;
    $user_obj->following_id=$data->following_id;
    if ($user_obj->CheckFollow()) {
        # code...
    if ($user_obj->Follow()) {
                $user_obj->id = $user_obj->user_id;
                $row3 = $user_obj->searchById();
                $user_obj->id = $user_obj->following_id;
                $row4 = $user_obj->searchById();
        $last_id=mysqli_insert_id($connection);
        http_response_code(200);
        echo json_encode(array(
            "status"=>true,
            "message"=>"You have Successfully following",
            "user"=>$row3,
            "following_user"=>$row4,
    ));
    }else{
        http_response_code(200);
        echo json_encode(array(
            "status"=>false,
            "message"=>"Failed to follow user"
    ));
        }
    }else{
        $user_obj->id = $user_obj->user_id;
        $row3 = $user_obj->searchById();
        $user_obj->id = $user_obj->following_id;
        $row4 = $user_obj->searchById();
        http_response_code(200);
        echo json_encode(array(
            "status"=>false,
            "message"=>"Already Following",
            "user"=>$row3,
            "following_user"=>$row4,
    ));
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