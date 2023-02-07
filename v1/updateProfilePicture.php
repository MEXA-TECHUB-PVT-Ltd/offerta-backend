<?php
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

if (isset($_POST["id"])) {
$user_obj->id=$_POST["id"];
if(!empty($_FILES["profile"]["name"])){
    // img
    $fileName  =  $_FILES['profile']['name']; 
    $tempPath  =  $_FILES['profile']['tmp_name'];
    $fileSize  =  $_FILES['profile']['size'];
   

    // img naming
    $rand= date("Ymd")."_".rand(10000,99999);
    $exe=pathinfo($fileName,PATHINFO_EXTENSION);
    $newName=$rand.".".$exe;
    $upload_path = '../asset/profile/'; // set upload folder path
    $user_obj->photo='asset/profile/'.$newName;
    move_uploaded_file($tempPath, $upload_path . $newName); // move img from system temporary path to our upload folder path 
    if ($user_obj->updateProfilePicture()) {
          # code...
            http_response_code(200);
            echo json_encode(array(
              "id"=>$user_obj->id,
              "photoURL"=>$user_obj->photo,
              "status"=>true,
              "message"=>"Profile Updated Successfully"
      ));
      exit();
    }

}else{
    http_response_code(200);
    echo json_encode(array(
        "status"=>false,
        "message"=>"File Not selected"
));
exit();
}
}else{
    http_response_code(200);
    echo json_encode(array(
        "status"=>false,
        "message"=>"All Data needed"
    ));
    exit();
}




?>