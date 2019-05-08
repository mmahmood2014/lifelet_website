<?php
$stripeToken=encode($_POST['stripeToken']);
$cardNumber=encode($_POST['cardNumber']);
$cardCVC=encode($_POST['cardCVC']);
$cardExpMonth=encode($_POST['cardExpMonth']);
$cardExpYear=encode($_POST['cardExpYear']);
require_once('stripe-php/init.php');




//set stripe secret key and publishable key
$stripe = array(
"secret_key" => $secret_key,
"publishable_key" => $public_key
);
\Stripe\Stripe::setApiKey($stripe['secret_key']);
//add customer to stripe
$customer = \Stripe\Customer::create(array(
'email' => $email,
'source' => $stripeToken
));
$itemName="LifeLet";
$currency="cad";
// details for which payment performed
$payDetails = \Stripe\Charge::create(array(
'customer' => $customer->id,
'amount' => $grand_total*100,
'currency' => $currency,
'description' => $itemName,
'metadata' => array(
'order_id' => $_SESSION['session_id']
)
));
$paymenyResponse=$payDetails->jsonSerialize();
$balanceTransaction=$paymenyResponse['balance_transaction'];
$paymentStatus=$paymenyResponse['status'];