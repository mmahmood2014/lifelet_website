<?php 
include 'includes/db.php';
$data=getDiscount('freeshipdecember');
pre($data);
//$url='https://' . $API_KEY . ':' . $SECRET . '@' . $STORE_URL . '/admin/discounts.json';
$url='https://' . $API_KEY . ':' . $SECRET . '@' . $STORE_URL . '/admin/price_rules/368015081541/discount_codes.json';
//$url='https://' . $API_KEY . ':' . $SECRET . '@' . $STORE_URL . '/admin/price_rules/368015081541/discount_codes/368015081541' . '.json';
$all_products=getCurlResponse($url);
echo 'kaleeeeeem';
pre($all_products);
?>