<?php
require 'stripe-php/init.php';
$PublishableKey="pk_test_GvYOyjmRofbuOT9ktYnFMzpk009IrqBrUp";
$SecretKey="sk_test_NhWICe45pSwoaM4fALQq7cTn003gigdQHz ";

\Stripe\Stripe::setApiKey($SecretKey);

?>