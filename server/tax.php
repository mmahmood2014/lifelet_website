<?php
require_once('../includes/db.php');
if(isset($_POST['stateCode'])){
	$stateCode=encode($_POST['stateCode']);
	if($stateCode!=''){
		# Tax Request
		$url='https://' . $API_KEY . ':' . $SECRET . '@' . $STORE_URL . '/admin/countries.json';
		$tax_obj=getCurlResponse($url);
		# Tax Info
		$tax_=taxInfo($tax_obj,$stateCode);
		$getOrderTotal=getOrderTotal();
		$grand_total=$getOrderTotal + $tax_['tax'];
		$data=array(
			'code'=>$tax_['code'],
			'tax'=>$tax_['tax'],
			'grand_total'=>$grand_total,
			'grand_total_format'=>'$'.number_format($grand_total,2),
			'tax_format'=>$tax_['tax_format']
		);
		$json=json_encode($data,JSON_UNESCAPED_SLASHES);
		echo $json;
	}
	else{
		$data=array(
			'code'=>'',
			'tax'=>'',
			'tax_format'=>'0.00'
		);
		$json=json_encode($data,JSON_UNESCAPED_SLASHES);
		echo $json;
	}
}
function getOrderTotal(){
	global $con;
	$sql="SELECT sum(order_total) as orderTotal, sum(order_price) as spacerTotal from orders where session_id='".$_SESSION['session_id']."'";
	$result=$con->query($sql);
	$row=$result->fetch_assoc();
	$orderTotal=$row['orderTotal'];
	$spacerTotal=$row['spacerTotal'];
	return $orderTotal + $spacerTotal;
}
?>