<?php
ob_start();
session_start();

if(isset($_POST['exp'])){
	//session_destroy($_POST['exp']);
	//session_destroy($_POST['session_id']);
	
	if(!isset($_SESSION['session_id'])){
		$_SESSION['session_id']=uniqid().'_'.rand(1000,9999999999).'_'.date('d').'_'.date('m').'_'.date('Y');
	}
	##########################
	$name='';
	$cart_name='';
	$exp=$_POST['exp'];
	$option=$_POST['form_variant'];
	$price=$_POST['form_price'];
	##########################
	if($exp=='16'){
		$name='16 Life Experiences';
	}
	if($exp=='8'){
		$name='8 Life Experiences';
	}
	if($exp=='4'){
		$name='4 Life Experiences';
	}
	$_SESSION['exp']=array('name'=>$name, 'option'=>$option, 'price'=>$price, 'number'=>$exp);
	header('Location:https://lifelet.ca/product_listing.php');exit;
}