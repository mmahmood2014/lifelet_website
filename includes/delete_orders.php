<?php
$sql="SELECT order_id FROM orders where order_status=0 and session_id='".$_SESSION['session_id']."'";
$result=$con->query($sql);
if($result->num_rows > 0){
	while($row=$result->fetch_assoc()){
		$id_=$row['order_id'];
		$where_="where order_id='".$id_."'";
		dbRowDelete('orders',$where_);
		dbRowDelete('orders_detail',$where_);
	}
}
?>