<?php
require_once('../includes/db.php');
if(isset($_POST['pid']) && isset($_POST['vid'])){
	$pid=encode($_POST['pid']);
	$vid=encode($_POST['vid']);
	$order_id=currentBundleID($_SESSION['session_id']);
	# Product Request
	$url='https://' . $API_KEY . ':' . $SECRET . '@' . $STORE_URL . '/admin/products/' .$pid. '.json';
	$pro_obj=getCurlResponse($url);
	# Product Info
	$product_=productInfo($pro_obj,$vid);
	# ORDERS DETAIL: INSERTION
	deleteProductBeforeInsert($order_id, $product_['p_id']);
	$data=array(
		'order_id'=>$order_id,### comming from db.php
		'product_id'=>escape($product_['p_id']),
		'product_title'=>escape($product_['p_title']),
		'product_image'=>escape($product_['p_src']),
		'variant_id'=>escape($product_['v_id']),
		'variant_title'=>escape($product_['v_title']),
		'variant_price'=>escape($product_['v_price'])
	);
	dbRowInsert('orders_detail', $data);
	$total=updateOrderTotal($order_id);
	
	$json=getResponse($product_,$order_id,$total);
	echo $json;
}
function getResponse($_p,$order_id,$total){
	
	$total_plus_spacer=$total + $_SESSION['exp']['price'];
	
	$row=array(
		'order_id'=>$order_id,
		'p_id'=>$_p['p_id'],
		'p_title'=>$_p['p_title'],
		'p_src'=>$_p['p_src'],
		'v_id'=>$_p['v_id'],
		'v_title'=>$_p['v_title'],
		'v_price'=>$_p['v_price'],
		'total'=>number_format($total,2),
		'total_plus_spacer'=>number_format($total_plus_spacer,2),
		'bundle_name'=>getBundleName($_SESSION['session_id'], $_SESSION['exp']['name']),
		'number'=>$_SESSION['exp']['number']
	);
	$data=json_encode($row,JSON_UNESCAPED_SLASHES);
	return $data;
}
######################### Remove #######################
if(isset($_POST['remove']) && isset($_POST['pid'])){
	$pid=encode($_POST['pid']);
	####################################################
	$order_id=currentBundleID($_SESSION['session_id']);
	deleteProductBeforeInsert($order_id, $pid);
	$total=updateOrderTotal($order_id);
	
	$product_price=getProductPriceByID($order_id, $pid);
	$total_plus_spacer=$_SESSION['exp']['price'] + ($total - $product_price);
	####################################################
	$url='https://' . $API_KEY . ':' . $SECRET . '@' . $STORE_URL . '/admin/products/' .$pid. '.json';
	$pro_obj=getCurlResponse($url);
	####################################################
	$row=array(
		'bundle_name'=>getBundleName($_SESSION['session_id'], $_SESSION['exp']['name']),
		'number'=>$_SESSION['exp']['number'],
		'price_range'=>getPriceRange($pro_obj->product->variants),
		'total'=>number_format($total,2),
		'total_plus_spacer'=>number_format($total_plus_spacer,2),
	);
	$data=json_encode($row,JSON_UNESCAPED_SLASHES);
	echo $data;
}
?>