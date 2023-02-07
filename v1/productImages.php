<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");
// Make sure the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the file array from the form
    $files = $_FILES['images'];
    $id = $_POST["product_id"];
// file include
include_once("../config/database.php");
include_once("../classes/Listing.php");

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Listing($connection);
    $response = array();
    // Loop through each file in the array
    for ($i = 0; $i < count($files['name']); $i++) {
        // Get the temporary file path
        $tmpFilePath = $files['tmp_name'][$i];

        // Make sure the file is not empty
        if (!empty($tmpFilePath)) {
            // Get the file extension
            $ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);

            // Generate a new file name
            $newFileName = date("Ymd")."_".rand(10000,99999) . '.' . $ext;

            // Set the new file path
            $newFilePath = '../asset/listing/' . $newFileName;
            $url = 'asset/listing/' . $newFileName;

            // Move the file to the uploads folder
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                // Prepare the insert statement
                $stmt = $connection->prepare("INSERT INTO product_images (image, product_id) VALUES (?, ?)");
                $stmt->bind_param("si", $url,$id);
                // Execute the statement
                $stmt->execute();
                // Close the statement
                $stmt->close();
                $response[]= $url;
            } else {
                // An error occurred while uploading the file
                http_response_code(200);
                echo json_encode(array(
                "status"=>false,
                "message"=>"unable to move file"
            ));
            }
        }
    }
    // Return a response indicating that the upload was successful
    http_response_code(200);
                echo json_encode(array(
                "status"=>true,
                "message"=>"images uploaded",
                "images"=>$response
            ));
} else {
    // Return a response indicating that the upload failed
    http_response_code(500);
    echo json_encode(array(
    "status"=>false,
    "message"=>"server error",
));
}
