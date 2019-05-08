<?php
require_once('../includes/db.php');
if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
	pre($_SESSION['cart']);
	echo 'Total: '.count($_SESSION['cart']);
}
if(isset($_SESSION['exp']) && !empty($_SESSION['exp'])){
	pre($_SESSION['exp']);
	echo 'Total: '.count($_SESSION['exp']);
}
if(isset($_GET['unset'])){
	unset($_SESSION['cart']);
	unset($_SESSION['exp']);
}
?>