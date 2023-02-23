<?php

ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../config/database.php");

// object
$db= new Database();
$connection=$db->connect();
    if(!empty($_FILES["image"]["name"])){
        // img
        $fileName  =  $_FILES['image']['name']; 
        $tempPath  =  $_FILES['image']['tmp_name'];
        $fileSize  =  $_FILES['image']['size'];
    
        // img naming
        $rand= date("Ymd")."_".rand(10000,99999);
        $exe=pathinfo($fileName,PATHINFO_EXTENSION);
        $newName=$rand.".".$exe;
        $upload_path = '../asset/listing/'; // set upload folder path
        $photo='asset/listing/'.$newName;
        move_uploaded_file($tempPath, $upload_path . $newName); // move img from system temporary path to our upload folder path 
        $query = "INSERT INTO product_images (image) VALUES ('$photo')";
        $insert = mysqli_query($connection, $query);
        if($insert){
            http_response_code(200);
            echo json_encode(array(
            "status"=>true,
            "message"=>"image uploaded",
            "id"=>mysqli_insert_id($connection),
            "image"=>" $photo"
    ));
        }
    }else{
        http_response_code(200);
        echo json_encode(array(
            "status"=>false,
            "message"=>"File Not selected"
    ));
    exit();
    }
    ?>
