<?php 
require_once('header.php');
if(isset($_GET['remove'])){
	dbRowDelete('life_exp', 'where le_id='.intval($_GET['remove']));
	$con->close();
	header('Location:'.$path.'life_exp_listing.php');
}
$sql="select * from orders_complete order by oc_id desc";
$result=$con->query($sql);
/*while($row1=$result->fetch_assoc()){
	$order_id=$row1['order_id'];
	$order_name=encode($row1['order_name']);
	$order_name_count=encode($row1['order_name_count']);
	$order_option=encode($row1['order_option']);
	$order_price=encode($row1['order_price']);
	$order_total=encode($row1['order_total']);
	$order_instruction=encode($row1['order_instruction']);
	$order_status=encode($row1['order_status']);
	########################################################
	$sql="select * from orders_detail where order_id='".$order_id."' order by od_id asc";
	$result_=$con->query($sql);
  	$count=mysqli_num_rows($result_);
  	while($row2=$result_->fetch_assoc()){
		$product_id=encode($row2['product_id']);
		$product_title=encode($row2['product_title']);
		$variant_id=encode($row2['variant_id']);
		$_PRODUCT=$product_title.'('.$order_name.' - '.$order_name_count.')';    
		$line_items.='{
						"title":"'.$_PRODUCT.'", 
						"requires_shipping":true,     
						"variant_id":"'.$variant_id.'"     
					},';
	}
}*/
if(isset($_GET['sid']) && isset($_GET['oc_id'])){
	$sid=$_GET['sid'];
	$oc_id=$_GET['oc_id'];
	dbRowDelete('orders_complete', 'where oc_id='.$oc_id);
	$sql="delete o.*, od.* from orders o inner join orders_detail od on o.order_id=od.order_id where o.session_id='".$sid."'";
	$con->query($sql);
	header('Location:'.$path.'admin/index.php');
	exit;
}
?>
<div class="kd-content">
  <section class="kd-pagesection">
    <div class="container">
      <div class="row">
        <center>
          <div class="col-md-12">
            <div class="kd-rich-editor">
              <center>
                <h2 class="title_text"> Orders Listing</h2>
                <div class="underline_small"></div>
              </center>
            </div>
            <br>
            
            
            <!--<div class="col-md-10 text-right">
              <a href="<?php echo $path?>life_exp.php">Add New</a>
            </div>-->
        
            <div class="col-md-12"></div>
            <div class="col-md-10 mobile_tab">
			
			
			
		
			
			<div class="table-responsive">
            	
                
                <form action="" method="post">
            	<table class="table table-bordered">
                	<tr>
                    	<th>#</th>
                        <th style="display:none">Order Number</th>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                        <th>Order Total</th>
                        <th>Date/Time</th>
                        <th>Action</th>
                    </tr>
					<?php
					$count=0;
                    if($result->num_rows > 0){
					while($row=$result->fetch_assoc()){
                    $count++;
					$id=$row['oc_id'];
					$session_id=encode($row['session_id']);
					$order_number_shopify=encode($row['order_number_shopify']);
					$trans_id=encode($row['trans_id']);
					$oc_cus_email=encode($row['oc_cus_email']);
					$oc_cus_fname=encode($row['oc_cus_fname']);
					$oc_cus_lname=encode($row['oc_cus_lname']);
					$name=$oc_cus_fname.' '.$oc_cus_lname;
					$oc_grand_total='$'.number_format(encode($row['oc_grand_total']),2);
					$oc_date=strtotime($row['oc_date']);
					$oc_date=date('d/m/Y H:i:s', $oc_date);
					?>
                	<tr>
                    	<td><?php echo $count?></td>
                        <td style="display:none"><?php echo $session_id?></td>
                        <td><?php echo $name?></td>
                        <td><?php echo $oc_cus_email?></td>
                        <td><?php echo $oc_grand_total?></td>
                        <td><?php echo $oc_date?></td>
                        <td>
                        	<!--<a href="<?php echo $path?>admin/index.php?remove=<?php echo $id?>">Delete</a>&nbsp;-->
                            <a href="<?php echo $path?>admin/view_order.php?sid=<?php echo $session_id?>">View</a>
                            &nbsp;| &nbsp;
                            <a onclick="return confirm('Do you want to delete this order?');" href="<?php echo $path?>admin/index.php?sid=<?php echo $session_id?>&oc_id=<?php echo $id?>">Delete</a>
                        </td>
                    </tr>
                    <?php 
					}
					}
					else{
						echo '<tr><td colspan="7">No Record Found!</td></tr>';	
					}
					?>
                </table>
                </form>
			</div>              
            </div>
          </div>
        </center>
      </div>
    </div>
  </section>
</div>
<?php require_once('footer.php')?>