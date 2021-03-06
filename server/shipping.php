<?php
require_once('../includes/db.php');
if(isset($_POST['subTotal'])){
	#################################################
	$stateCode=encode($_POST['stateCode']);
	$totalBundle=totalBundle($_SESSION['session_id']);
	$grand_total=encode($_POST['subTotal']);
	$target_type=encode($_POST['target_type']);
	#################################################
	
	# Ship Request
	$url='https://' . $API_KEY . ':' . $SECRET . '@' . $STORE_URL . '/admin/shipping_zones.json';
	$ship_obj=getCurlResponse($url);
	# Ship Info
	$ship_=shipInfo($ship_obj);
	$ship_cost=getShiipingAmount($ship_,$grand_total,$totalBundle);
	# If applied discount code is free shipping
	if($target_type=='Free Shipping'){
		$ship_cost=0;
	}
	##########Tax##############
	
	$url='https://' . $API_KEY . ':' . $SECRET . '@' . $STORE_URL . '/admin/countries.json';
	$tax_obj=getCurlResponse($url);
	# Tax Info
	$tax_array=taxInfo($tax_obj,$stateCode);
	$response=getTax($grand_total,$tax_array);
	$tax_value=$response['tax_value'];
	##########Grand Total#####
	$_GRAND_TOTAL=$grand_total + $ship_cost + $tax_value;
	##########################
	
	$data=array(
	
		'ship_cost'=>$ship_cost,
		'ship_cost_format'=>'$'.number_format($ship_cost,2),
		
		'code'=>$tax_array['code'],
		'tax_percent'=>$tax_array['tax_percentage'],
		'tax_percent_format'=>$tax_array['tax_percentage_format'],
		'tax_value'=>$tax_value,
		'tax_value_format'=>'$'.number_format($tax_value,2),
		'grand_total'=>$_GRAND_TOTAL,
		'grand_total_format'=>'$'.number_format($_GRAND_TOTAL,2),
	);
	$json=json_encode($data,JSON_UNESCAPED_SLASHES);
	echo $json;
}
?>