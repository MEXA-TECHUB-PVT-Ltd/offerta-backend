<?php
session_start();
include('../../include/connection.php');
header('Content-Type: application/json');

$EncodeData=file_get_contents('php://input');
$DecodeData=json_decode($EncodeData,true);

$author_id=$DecodeData['author_id'];
$key='';
$price='';
	$sql="SELECT * FROM authors WHERE id='$author_id'";
	$run=mysqli_query($conn,$sql);

	    while($row=mysqli_fetch_assoc($run)) {
	 $key=$row['stripe_secret_key'];
	 $price=$row['ratePerNews'];
		}

require 'stripe-php/init.php';
$stripe = new \Stripe\StripeClient($key);
$x=$stripe->paymentIntents->create([
  'amount' => $price,
  'currency' => 'usd',
  'payment_method_types' => ['card'],
]);
$client_secret=$x->client_secret;
$response[]=array(
	 "client_secret"=>$client_secret,
	 "price"=>$price,
	 "key"=>$key,
	    "error"=>false,
	    );  
echo json_encode($client_secret);

?>
