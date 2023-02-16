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
require '../Labraries/vendor/autoload.php';

// object
$db= new Database();
$connection=$db->connect();

$user_obj = new Users($connection);
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $data =json_decode(file_get_contents("php://input"));
    if (!empty($data->email)) {
    $user_obj->email=$data->email;
    $user_obj->code = random_int(1000, 9999);

    if(!empty($row=$user_obj->searchByEmail())){
        $username=$row["full_name"];

        $body = " Hi,$username, Your Code is:$user_obj->code";
        $subject = "Reset Password";

        //SMTP Settings
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "ofertasv123@gmail.com"; //enter you email address
        $mail->Password = 'eaomaxyylcgxgbau'; //enter you email password
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom("ofertasv123@gmail.com");
        $mail->addAddress($user_obj->email); //enter you email address
        $mail->Subject = ("$user_obj->email ($subject)");
        $mail->Body = $body;
        $mail->send();

        // Storing Code
        if ($user_obj->code()) {
            # code...
            http_response_code(200);
            echo json_encode(array(
                "status"=>True,
                "email"=>$user_obj->email,
                "message"=>"Email Sent to $user_obj->email, Please Check Your Email",
                "code"=>$user_obj->code
            ));

        }
    }else{
        http_response_code(200);
        echo json_encode(array(
            "status"=>false,
            "message"=>"Email is not registered"
        ));
    }

    }else{
    http_response_code(503);
    echo json_encode(array(
    "status"=>false,
    "message"=>"All Data Needed"
));
    }

}else{
    http_response_code(503);
    echo json_encode(array(
    "status"=>false,
    "message"=>"Server error"
));
    }
?>