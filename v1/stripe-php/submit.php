<?php
require 'config.php';

\Stripe\Stripe::setVerifySslCerts(false);

$token = $_POST['stripeToken'];
$charge = \Stripe\Charge::create([
    'amount' => 50,
    'currency' => 'usd',
    'description' => 'Example charge',
    'source' => $token,
]);
echo '<pre>';
print_r($charge);
?>