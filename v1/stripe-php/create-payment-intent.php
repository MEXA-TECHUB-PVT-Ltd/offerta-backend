
<?php
session_start();
header('Content-Type: application/json');
$EncodeData=file_get_contents('php://input');
$DecodeData=json_decode($EncodeData,true);
$currency=$DecodeData['currency'];
$amount=$DecodeData['amount'];
require 'stripe-php/init.php';
$stripe = new \Stripe\StripeClient(
  'sk_test_NhWICe45pSwoaM4fALQq7cTn003gigdQHz'
);
$x=$stripe->paymentIntents->create([
  'amount' => $amount,
  'currency' => $currency,
  'payment_method_types' => ['card'],
]);
$client_secret=$x->client_secret;

echo json_encode($client_secret);

?>