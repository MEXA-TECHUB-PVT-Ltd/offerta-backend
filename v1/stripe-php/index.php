<?php
require 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>Stripe Payment Gateway Integration in PHP</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-4 col-md-offset-4">
<h2>Stripe Payment Gateway Integration in PHP</h2>
<hr>
<form action="submit.php" method="post" id="payment-form">
    <script
    src="https://checkout.stripe.com/v3/checkout.js" class="stripe-button" 
    data-key="<?php echo $PublishableKey; ?>"
    data-amount="50"
    data-name="Demo Pay"
    data-description="Widget"
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    data-currency="usd"
    >
    </script>
</form>
