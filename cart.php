<?php 
require_once 'includes/header.php';
$sql="select * from orders where session_id='".$_SESSION['session_id']."' and order_status=1 order by order_id asc";
$result_=$con->query($sql);
################  Remove Bundle #######################
if(isset($_GET['remove_bundle'])){
	$orderID=$_GET['remove_bundle'];
	# Get Order_Name First
	$sql="SELECT order_name FROM orders where order_id='".$orderID."' and session_id='".$_SESSION['session_id']."'";
	$result=$con->query($sql);
	if($result->num_rows > 0){
		$row=$result->fetch_assoc();
		$name=escape($row['order_name']);
		
		$where="where order_id='".$orderID."' and session_id='".$_SESSION['session_id']."'";
		if(dbRowDelete('orders',$where)){
			$where="where order_id='".$orderID."'";
			dbRowDelete('orders_detail',$where);
		}
		updateBundleCountCart($_SESSION['session_id'], $name, $orderID);
	}
	header('Location:'.$path.'cart.php');
	exit;
}
########################################################
if(isset($_GET['edit'])){
	$orderID=$_GET['edit'];
	# Get Order_Name First
	$sql="SELECT * FROM orders where order_id='".$orderID."' and session_id='".$_SESSION['session_id']."'";
	$result=$con->query($sql);
	if($result->num_rows > 0){
		########################################
		$row=$result->fetch_assoc();
		$name=escape($row['order_name']);
		$exp=preg_replace('/[^0-9]/','',$name);
		$option=escape($row['order_option']);
		$price=escape($row['order_price']);
		$_SESSION['exp']=array('name'=>$name, 'option'=>$option, 'price'=>$price, 'number'=>trim($exp));
		#########################################
		$data=array(
			'order_status'=>0
		);
		dbRowUpdate('orders', $data, "order_id='".$orderID."' and session_id='".$_SESSION['session_id']."'");
		header('Location:'.$path.'product_listing.php');
		exit;
	}
	else{
		header('Location:'.$path.'cart.php');
		exit;
	}
}
//unset($_SESSION['exp']);
?>
<script>
fbq('track', 'AddToCart');
</script>
<div class="kd-content">
  <section class="kd-pagesection">
    <div class="container">
      <div class="row">
        <center>
          <div class="col-md-12 mobile_col_table">
        	<h2>Cart</h2>
            <div class="col-md-12 mobile_col_table"></div>
            <div class="col-md-10 mob_col_table">
			 <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="text-center">Product Name</th>
                    <th class="text-center">Price</th>
                  </tr>
                </thead>
                <tbody>
                <?php
				$count=0;
				$subTotal=0;
				$order_ids_array=array();
				if($result_->num_rows > 0){
				while($row=$result_->fetch_assoc()){
					$count++;
					$id=$row['order_id'];
					$name_count=$row['order_name_count'];
					$name=encode($row['order_name']).' - '.$name_count;
					$order_ids_array[]=array('order_id'=>$id,'order_name'=>$name);
					
					$spacer_price=$row['order_price'];
					
					$subTotal+=$row['order_total'] + $spacer_price;
					$total=$row['order_total'] + $spacer_price;
				?>
                	<tr>
                    	<td class="text-left">
							<?php echo $name?>  
                            <br />
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#cart_box_<?php echo $id?>">Details</button>
                        	<br />
                            <a onclick="return confirm('Do you want to remove <?php echo $name?>');" href="<?php echo $path.'cart.php?remove_bundle='.$id?>">Remove</a>
                        </td>
                    	<td class="text-center"> <?php echo '$'.number_format($total,2)?> </td>
                  	</tr>
				<?php 
                }
                }
                else{
                	echo '<tr><td colspan="2">No Record Found!</td></tr>';	
                }
                ?>
                 
                 <tr>
                    <td class="text-right tab_but_left"><strong>Subtotal</strong></td>
                    <td class="text-center tab_but_right"><strong>$<?php echo number_format($subTotal,2)?><br>
                    </strong>
                    <p class="fon_smll"><center class="fon_smll">Taxes & Shipping are calculated at Checkout</center></p>

                     </td>
                    
                  </tr>
                </tbody>
              </table>
			  </div>
			  
			  


			
			 <!--<div class="totals col-sm-3 pull-right" style="background:#fafafa;">
              <div class="inner">
                <table class="table shopping-cart-table-total" id="shopping-cart-totals-table" style="margin-bottom:0px;">
                  <colgroup>
                  <col>
                  <col width="1">
                  </colgroup>
                  <tfoot>
                    <tr>
                      <td colspan="1" class="a-left" style=""><strong>Subtotal</strong></td>
                      <td class="a-right" style=""><strong><span class="price">$77.38</span></strong></td>
                    </tr>
					
                  </tfoot>
                </table>
					<tr>
                      <td><p class="fon_smll">Taxes & Shipping Calculated at Checkout</p></td>
                    </tr>
              </div>              
            </div>-->
			
			

			
			
			<br><br>
			
              <div class="col-md-4 pull-right">
              <table class="table">
                
                <tbody>                  
                  <tr>
                    <td class="text-left mob_coun"><a type="button" href="<?php echo $path?>" class="btn btn-info Countinue">CONTINUE SHOPPING</a></td>
                    <td class="text-left mob_check"><a type="button" href="checkout.php" class="btn btn-dark check pull-right">CHECKOUT</a></td>
                  </tr>
                </tbody>
              </table>
			  </div>
              
              
            </div>
          </div>
        </center>
      </div>
    </div>
    <?php 
	if(isset($order_ids_array) && !empty($order_ids_array)){
	foreach($order_ids_array as $_ORDERS){
		$orderID=$_ORDERS['order_id'];
		$orderName=$_ORDERS['order_name'];
		# Order Info Query
		$sql="select o.*,od.* from orders o left join orders_detail od on o.order_id=od.order_id where o.order_id='".$orderID."' order by od.od_id asc";
		$res=$con->query($sql);
	?>
    <div class="modal fade" id="cart_box_<?php echo $orderID?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel"><?php echo $orderName?></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    	<span aria-hidden="true">&times;</span>
                	</button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <!--<thead>
                            <tr>
                                <th>Material</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>-->
                        <tbody>
                        <?php
						$subTotal=0;
                        $spacer_price=0;
						$spacer_name='';
						$spacer_option='';
						if($res->num_rows > 0){
						while($row=$res->fetch_assoc()){
							$od_id=$row['od_id'];
							$pname=encode($row['product_title']);
							$psrc=encode($row['product_image']);
							$vname=encode($row['variant_title']);
							$vprice=encode($row['variant_price']);
							$name_count=$row['order_name_count'];
							$name=encode($row['order_name']).' - '.$name_count;
							$spacer_price=$row['order_price'];
							$spacer_name=encode($row['order_name']);
							$spacer_option=encode($row['order_option']);
							$subTotal+=$vprice;
						?>
                        <tr>
                        	<td class="text-center"><img src="<?php echo $psrc?>" class="img_con" /></td>
                            <td><?php echo $pname?></td>
                            <td><?php echo $vname?></td>
                            <td class="text-center"><?php echo '$'.number_format($vprice,2)?></td>
                            <!--<td><label><button type="button" class="btn btn-success options" data-toggle="modal" data-target="#cart_box_<?php echo $orderID?>">Select</button></td>-->
                        </tr>
                        <?php
						}
						}
						?>
                        <tr><td colspan="2" style="border-right:0;">&nbsp;</td><td style="border-left:0;"><strong>Subtotal</strong></td><td class="text-center">$<?php echo number_format($subTotal,2)?></td></tr>
                        <tr><td colspan="2" style="border-right:0;">&nbsp;</td><td style="border-left:0;"><strong><?php echo 'Blank beads: '.$spacer_option?></strong></td><td class="text-center">$<?php echo number_format($spacer_price,2)?></td></tr>
                        <tr><td colspan="2" style="border-right:0;">&nbsp;</td><td style="border-left:0;"><strong>Total</strong></td><td class="text-center">$<?php echo number_format($subTotal + $spacer_price,2)?></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div>
    <?php 
	}
	}
	?>
    
    
    
  </section>
</div>
<?php require_once 'includes/footer.php'?>