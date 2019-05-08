<?php 
require_once('header.php');
$session_id='';
if(isset($_GET['sid'])){
	$session_id=encode($_GET['sid']);
}
$sql="select * from orders where session_id='".$session_id."' order by order_id asc";
$result_=$con->query($sql);
############################################################
$sql="select * from orders_complete where session_id='".$session_id."'";
$result=$con->query($sql);
$_oc=$result->fetch_assoc();
############################################################
$order_number_shopify=encode($_oc['order_number_shopify']);
$trans_id=encode($_oc['trans_id']);
$email=encode($_oc['oc_cus_email']);
$fname=encode($_oc['oc_cus_fname']);
$lname=encode($_oc['oc_cus_lname']);
$_name=$fname.' '.$lname;
$address1=encode($_oc['oc_cus_address1']);
$discount_cent=encode($_oc['oc_discount_cent']);
$discount_code=encode($_oc['oc_discount_code']);
$shipping_charges=encode($_oc['oc_shipping_charges']);
$tax=encode($_oc['oc_tax']);
$grand_total=$_oc['oc_grand_total'];
############################################################
$city=encode($_oc['oc_cus_city']);
$province=encode($_oc['oc_cus_province']);
$zip=encode($_oc['oc_cus_zip']);
$country=encode($_oc['oc_cus_country']);
############################################################
?>
<style type="text/css">
.tab_but_right{
	width:85%;
}
</style>
<div class="kd-content">
  <section class="kd-pagesection">
    <div class="container">
      <div class="row">
        <center>
          <div class="col-md-12">
            <div class="kd-rich-editor">
              <center>
                <h2 class="title_text"> View Order</h2>
                <div class="underline_small"></div>
              </center>
            </div>
            <br>
            
            <div class="col-md-5 text-left">
              <a href="javascript:void(0)" data-toggle="modal" data-target="#customer_detail">Order Detail</a>
            </div>
            
            <div class="col-md-5 text-right">
              <a href="<?php echo $path?>admin/index.php">Orders Listing</a>
            </div>
        
            <div class="col-md-12"></div>
            <div class="col-md-10 mobile_tab">
			<div class="table-responsive">
            
            
            	<table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="">Product Name</th>
                    <th class="">Price</th>
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
					$order_inst=encode($row['order_instruction']);
					$order_ids_array[]=array('order_id'=>$id,'order_name'=>$name,'order_instruction'=>$order_inst);
					$spacer_price=$row['order_price'];
					$subTotal+=$row['order_total'] + $spacer_price;
					$total=$row['order_total'] + $spacer_price;
				?>
                	<tr>
                    	<td class="text-left">
							<?php echo $name?>  
                            <br />
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#cart_box_<?php echo $id?>">Detail</button>
                        </td>
                    	<td class="text-left"> <?php echo '$'.number_format($total,2)?> </td>
                  	</tr>
				<?php 
                }
                }
                else{
                	echo '<tr><td colspan="2">No Record Found!</td></tr>';	
                }
                ?>
                    <tr>
                        <td class="text-right tab_but_right"><strong>Sub-Total</strong></td>  
                        <td class="text-left tab_but_left">
                            $<?php echo number_format($subTotal,2)?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right tab_but_right"><strong>Discount<strong></td>
                        <td class="text-left tab_but_left">
                            <?php 
							if($discount_cent!='Free Shipping'){
							echo number_format($discount_cent,2).'%';
							}
							else{
								echo $discount_cent;		
							}
							?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right tab_but_right"><strong>Shipping Charges</strong></td>
                        <td class="text-left tab_but_left">
                            $<?php echo number_format($shipping_charges,2)?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right tab_but_right"><strong>Tax</strong></td>
                        <td class="text-left tab_but_left">
                            $<?php echo number_format($tax,2)?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right tab_but_right"><strong>Grand-Total</strong></td>
                        <td class="text-left tab_but_left">
                            $<?php echo number_format($grand_total,2)?>
                        </td>
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
		$order_inst=encode($_ORDERS['order_instruction']);
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
                        	<td><img src="<?php echo $psrc?>" height="60" /></td>
                            <td><?php echo $pname?></td>
                            <td><?php echo $vname?></td>
                            <td><?php echo '$'.number_format($vprice,2)?></td>
                            <!--<td><label><button type="button" class="btn btn-success options" data-toggle="modal" data-target="#cart_box_<?php echo $orderID?>">Select</button></td>-->
                        </tr>
                        <?php
						}
						}
						?>
                        <tr><td colspan="4"><strong>Special Instructions</strong></td>
                        <tr><td colspan="4"><textarea class="form-control" spellcheck="false"><?php echo $order_inst?></textarea></td></tr>
                        <tr><td colspan="2">&nbsp;</td><td><strong>Subtotal</strong></td><td class="text-center">$<?php echo number_format($subTotal,2)?></td></tr>
                        <tr><td colspan="2">&nbsp;</td><td><strong><?php echo 'Blank beads: '.$spacer_option?></strong></td><td class="text-center">$<?php echo number_format($spacer_price,2)?></td></tr>
                        <tr><td colspan="2">&nbsp;</td><td><strong>Total</strong></td><td class="text-center">$<?php echo number_format($subTotal + $spacer_price,2)?></td></tr>
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
    
    <div class="modal fade" id="customer_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Order Detail</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    	<span aria-hidden="true">&times;</span>
                	</button>
                </div>
                <div class="modal-body">
                    
                    <table class="table table-bordered">
                        <thead>
                        	<th>Order Number(app)</th>
                            <th>Order Number(shopify)</th>
                            <?php 
							if($discount_code!=''){
							?>
                            <th>Discount Code</th>
                            <?php
                            }
							?>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $session_id?></td>
                                <td><?php echo $order_number_shopify?></td>
                                <?php 
								if($discount_code!=''){
								?>
                                <td><?php echo $discount_code?></td>
                            	<?php 
								}
								?>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                        	 <th>Transaction ID</th>
                             <th>Payment Method</th>
                             <th>Payment Status</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $trans_id?></td>
                                <td>Stripe</td>
                                <td>Paid</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                        	<th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $_name?></td>
                                <td><?php echo $email?></td>
                                <td><?php echo $address1?></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <table class="table table-bordered">
                        <thead>
                        	<th>City</th>
                            <th>State</th>
                            <th>Zip</th>
                            <th>Country</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $city?></td>
                                <td><?php echo $province?></td>
                                <td><?php echo $zip?></td>
                                <td><?php echo $country?></td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
	</div>
    
  </section>
</div>
<?php require_once('footer.php')?>