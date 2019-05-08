<?php
session_start();
ob_start();
header("Access-Control-Allow-Origin: *");
//unset($_SESSION['session_id']);
$str=$_SERVER['REQUEST_URI'];
if(!isset($_SESSION['session_id'])){
	$_SESSION['session_id']=uniqid().'_'.rand(1000,9999999999).'_'.date('d').'_'.date('m').'_'.date('Y');
}
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
##########################################
$ip=$_SERVER['REMOTE_ADDR'];

$path='/live/';
$path_='/live/';
/*$str=$_SERVER['REQUEST_URI'];
if(strpos($str, 'hmac') !== false){
	$path='/';
}*/
##########################################
$user='lifelet3_usersto';
$password='WF2018wf!';
if($ip=='::1'){
	$user='root';
	$password='';
	$path='/live/';
}
$con=mysqli_connect("localhost",$user,$password,"lifelet3_userstories");
if(mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
################################################
$API_KEY='6fd2db884fe0906b09cdf2a74532e0ea';

//$SECRET='dacbb344ce1134c46fb2e74de862818a';  //old tocken
//$STORE_URL='dev-lifelet.myshopify.com';     //old url

$SECRET='f675201c63dc8316e1818fef208c8946';   //new tocken
$STORE_URL='lifelet.myshopify.com';     //new url

$TOKEN='your-secret-here';
$PRODUCT_ID='product-id-here';
################################################
$page=basename($_SERVER['PHP_SELF']);
date_default_timezone_set("Canada/Yukon");
################################################ 
require_once('functions.php');
$array_exclude_pages=array('product_listing.php', 'ajax.php');
if(!in_array($page,$array_exclude_pages)){
	//require_once('delete_orders.php');
	//unset($_SESSION['exp']);
	##########NEW CODEE##########################
	/*$sql="SELECT order_id FROM orders where order_status=0 and session_id='".$_SESSION['session_id']."'";
	$result=$con->query($sql);
	if($result->num_rows > 0){
		while($row=$result->fetch_assoc()){
			$id__=$row['order_id'];
			$where__="where order_id='".$id__."'";
			
			$sql__="SELECT * FROM orders_detail where order_id='".$id__."'";
			$result__=$con->query($sql__);
			if($result__->num_rows==0){
				dbRowDelete('orders',$where__);
			}
		}
	}*/
}
$sql="select * from settings where id=1";
$result=$con->query($sql);
$settings=$result->fetch_assoc();
$public_key=encode($settings['public_key']);
$secret_key=encode($settings['secret_key']);