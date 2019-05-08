<?php 
require_once 'includes/header.php';
$sql="select * from orders where session_id='".$_SESSION['session_id']."' and order_status=1 order by order_id asc";
$result_=$con->query($sql);
unset($_SESSION['exp']);
##################### Discount #########################
if(isset($_POST['dCode']) && !empty($_POST['dCode'])){
	$discount_code=encode($_POST['dCode']);
	$data=getDiscount($discount_code);
	$_SESSION['discount']=array('code'=>$data['code'],'cent'=>$data['cent'],'cent_percent'=>$data['cent_percent'], 'target_type'=>$data['target_type'], 'value_type'=>$data['value_type']);
	header('Location:'.$path.'checkout.php');
	exit;
}
//pre($_SESSION['discount']);
###############################################
if(isset($_GET['remove_code'])){
	unset($_SESSION['discount']);
	header('Location:'.$path.'checkout.php');
	exit;
}
###############################################
if(isset($_SESSION['discount'])){
	$code=$_SESSION['discount']['code'];
	$cent=$_SESSION['discount']['cent'];
	$cent_percent=$_SESSION['discount']['cent_percent'];
	$target_type=$_SESSION['discount']['target_type'];
}
else{
	$code='';
	$cent=0;
	$cent_percent='0.00';
	$target_type='';
}
if(strpos($cent_percent, '%') !== false){
    $cent_percent=str_replace('%','',$cent_percent);
	$cent_percent=number_format($cent_percent).'%';
}
#########################################################
#                                                       #
#                                                       #
#                                                       #
################  Insert Order into Database #########################
if(isset($_POST['fname'])){
	
	
	#####################################
	$email=escape($_POST['email']);
	$fname=escape($_POST['fname']);
	$lname=escape($_POST['lname']);
	$address1=escape($_POST['address1']);
	$city=escape($_POST['city']);
	$province=escape($_POST['province']);
	$zip=escape($_POST['zip']);
	$country=escape($_POST['country']);
	$target_type=escape($_POST['target_type']);
	#####################################
	$grand_total=escape($_POST['grand_total']);
	$discount_cent=escape($_POST['discount']);
	if($target_type=='Free Shipping'){
		$discount_cent=$target_type;
	}
	$discount_value=escape($_POST['discount_value']);
	if($discount_value==''){
		$discount_value=0;
	}
	if($target_type=='Free Shipping'){
		$discount_value=0;
	}
	$discount_code=escape($_POST['discount_code']);
	$shipping=escape($_POST['shipping']);
	if($shipping==''){
		$shipping=0;
	}
	$tax=escape($_POST['tax']);
	if($tax==''){
		$tax=0;
	}
	$tax_percent=escape($_POST['tax_percent']);
	if($tax_percent==''){
		$tax_percent=0;
	}
	$date=date('Y-m-d H:i:s');
	#####################################
	if($grand_total < 0){
		require_once 'includes/payment.php';
	}
	else{
		$paymentStatus='succeeded';
		$balanceTransaction='';	
	}
	#####################################
	if($paymentStatus=='succeeded'){
		require_once 'includes/orders.php';
		$data=array(
			'session_id'=>$_SESSION['session_id'],
			'order_number_shopify'=>$order_number_shopify,
			'trans_id'=>$balanceTransaction,
			'oc_cus_email'=>$email,
			'oc_cus_fname'=>$fname,
			'oc_cus_lname'=>$lname,
			'oc_cus_address1'=>$address1,
			'oc_cus_city'=>$city,
			'oc_cus_province'=>$province,
			'oc_cus_zip'=>$zip,
			'oc_cus_country'=>$country,
			'oc_grand_total'=>$grand_total,
			
			'oc_discount_cent'=>$discount_cent,
			'oc_discount_value'=>$discount_value,
			'oc_discount_code'=>$discount_code,
			'oc_shipping_charges'=>$shipping,
			'oc_tax'=>$tax,
			
			'oc_date'=>$date
		);
		dbRowInsert('orders_complete', $data);
  		unset($_SESSION['session_id']);
		unset($_SESSION['discount']);
		header('Location:'.$path.'thank_you.php');
		exit;
	}
	else{
		header('Location:'.$path.'checkout.php?payment=-1');
		exit;
	}
}
########################################################
?>
<script>
fbq('track', 'InitiateCheckout');
</script>
<div class="kd-content">
  <section class="kd-pagesection">
    <div class="container mob_from">
      <div class="row mob_from">
        <center>            
         
        
            <div class="col-md-10 mob_from">
              
              
           <form action="<?php echo $path.'checkout.php'?>" method="post" id="paymentForm">
        		
           <div class="cart wow bounceInUp animated">
            <div class="page-title">
            <h2>Checkout</h2>
            </div>
		  
		  
		   <div class="col-md-6 mob_from pull-left">
              <div class="cart-collaterals row">
                <div class="col-sm-12 mob_from">
                  <div class="shipping mob_from">
                    <div class="shipping-form">
                    	<span class="paymentErrors alert-danger"></span>
                        <ul class="form-list">
                          <li>
                            <label class="required text-left" for="country">Contact information </label>
                            <div class="input-box">
                                <input type="email" name="email" class="form-control" placeholder="Please Enter Your Email" required>
                            </div>
                          </li>
                          
                          <div class="checkbox text-left">
                            <label><input type="checkbox" value="">Keep me up to date on news and exclusive offers</label>
                          </div>
    
                          <br>
                          <div class="col-md-6 mob_from" style="padding-left:0px;">
                          <li>
                           <label class="required text-left" for="country">Shipping address</label>
                            <div class="input-box">
                                <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                            </div>
                          </li>
                          </div>
                          
                          <div class="col-md-6 mob_from" style="padding-left:0px; padding-right:0px;">
                           <li>
                            <label style="visibility:hidden;" class="required text-left" for="country">Contact information </label>
                            <div class="input-box">
                                <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                            </div>
                          </li>
                          </div>
                          
                          
                           <div class="col-md-12 edit_colm mob_from">
                           <li>
                            <div class="input-box">
                                <input type="text" name="address1" class="form-control" placeholder="Address" required>
                            </div>
                          </li>
                          </div>
                          
                          <div class="col-md-12 edit_colm mob_from">
                           <li>
                            <div class="input-box">
                                <input type="text" class="form-control" placeholder="Apartment suite etc (optional)">
                            </div>
                          </li>
                          </div>
                          
                            <div class="col-md-12 edit_colm mob_from">
                           <li>
                            <div class="input-box">
                                <input type="text" name="city" class="form-control" placeholder="City" required>
                            </div>
                          </li>
                          </div>
                          
                          
                           <!--<div class="col-md-6 mob_from" style="padding-left:0px;">
                           <li>
                            <div class="input-box">
                                <input type="email" class="form-control" placeholder="State ">
                            </div>
                          </li>
                          </div>-->
                          
                          <div class="col-md-6 mob_from" style="padding-left:0px;">
                           <li>
                            <div class="input-box">
                                <select class="validate-select form-control" name="province" id="province" onChange="changeState(this.value)" required>
                                   <option value="" data-code="">Province...</option>
                                   <option value="Alberta" data-code="AB">Alberta</option>
                                   <option value="British Columbia" data-code="BC">British Columbia</option>
                                   <option value="Manitoba" data-code="MB">Manitoba</option>
                                   <option value="New Brunswick" data-code="NB">New Brunswick</option>
                                   <option value="Newfoundland" data-code="NL">Newfoundland</option>
                                   <option value="Northwest Territories" data-code="NT">Northwest Territories</option>
                                   <option value="Nova Scotia" data-code="NS">Nova Scotia</option>
                                   <option value="Nunavut" data-code="NU">Nunavut</option>
                                   <option value="Ontario" data-code="ON">Ontario</option>
                                   <option value="Prince Edward Island" data-code="PE">Prince Edward Island</option>
                                   <option value="Quebec" data-code="QC">Quebec</option>
                                   <option value="Saskatchewan" data-code="SK">Saskatchewan</option>
                                   <option value="Yukon" data-code="YT">Yukon</option>
                                </select>
                            </div>
                          </li>
                          </div>
                          
                          
                           <div class="col-md-6 mob_from" style="padding-left:0px; padding-right:0px;">
                           <li>
                            <div class="input-box">
                                <input type="text" name="zip" class="form-control" placeholder="Postal Code" required>
                            </div>
                          </li>
                          </div>
                          
                          <div class="col-md-12 mob_from" style="padding-left:0px; padding-right:0px;">
                          <li>
                            <div class="input-box">
                             <select title="Country" class="validate-select form-control" id="country" name="country">
                                <option value="CA">Canada</option>
                             </select>
                            </div>
                          </li>
                          </div>
                          
                          
                          
                          
                          <br>
                          <div class="col-md-6 mob_from" style="padding-left:0px;">
                          <li>
                           <label class="required text-left" for="country">Payment Detail</label>
                            <div class="input-box">
                                <input type="text" name="cardNumber" size="20" autocomplete="off" id="cardNumber" class="form-control" placeholder="Card Number" required>
                            </div>
                          </li>
                          </div>
                          
                          <div class="col-md-6 mob_from" style="padding-left:0px; padding-right:0px;">
                           <li>
                            <label style="visibility:hidden;" class="required text-left" for="country">Contact information </label>
                            <div class="input-box">
                                <input type="text" name="cardCVC" id="cardCVC" size="3" autocomplete="off" class="form-control" placeholder="CVC" required>
                            </div>
                          </li>
                          </div>
                          
                          <div class="col-md-6 mob_from" style="padding-left:0px;">
                          <li>
                            <div class="input-box">
                                <input type="text" name="cardExpMonth" size="2" id="cardExpMonth" class="form-control" placeholder="Expiration(MM)" required>
                            </div>
                          </li>
                          </div>
                          
                          <div class="col-md-6 mob_from" style="padding-left:0px; padding-right:0px;">
                           <li>
                            <div class="input-box">
                                <input type="text" name="cardExpYear" id="cardExpYear" size="4" class="form-control" placeholder="Expiration(YYYY)" required>
                            </div>
                          </li>
                          </div>
                          
                          
                          
                          
                        </ul>
                      
                    </div>
                  </div>
                </div>
                
                
              </div>
          </div>
		  
		  
		  <div class="col-md-6 pull-right mobil_from_full">
          <div class="table-responsive main_tbl_sec">
           
           
           
           <br>
           <div class="main_right_top">
           
           <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="border_pr_name">Product Name</th>
                  <th scope="col" class="text-right border_pr_name">Price</th>
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
                  <td class="border_lft_rig"><?php echo $name?></td>
                  <td class="text-right"><?php echo '$'.number_format($total,2)?></td>
                  <!--<td class="text-right"><i class="far fa-trash-alt"></i></td>-->
                </tr>
                <?php 
				}
					$discount_value='';
					$grandTotal=$subTotal;
					if($cent!=0 && $target_type!='Free Shipping'){//this line
						$discount_cent=$cent/100;
						$discount_value=number_format($subTotal*$discount_cent,2);
						$grandTotal=$subTotal - $discount_value;
					}
				}
				?>
                
              </tbody>
            </table>
            
            
            
            <input type="hidden" name="tax" id="tax">
            <input type="hidden" name="tax_percent" id="tax_percent">
            <input type="hidden" name="discount" id="discount" value="<?php echo $cent?>">
            <input type="hidden" name="discount_value" id="discount_value" value="<?php echo $discount_value?>">
            <input type="hidden" name="discount_code" id="discount_code" value="<?php echo $code?>">
            <input type="hidden" name="target_type" id="target_type" value="<?php echo $target_type?>"><!-- This Line -->
            <input type="hidden" name="shipping" id="shipping">
            <input type="hidden" name="sub_total" id="sub_total" value="<?php echo $grandTotal?>">
            <input type="hidden" name="grand_total" id="grand_total" value="<?php echo $grandTotal?>">
            
            <div class="col-md-8 edit_col_left">
                  <div class="form-group">
                    <input type="text" placeholder="Discount Code" value="<?php echo $code?>" class="form-control" id="dCode" name="dCode_" spellcheck="false" required>
                  </div>
            </div>
            <?php 
			if(isset($_SESSION['discount'])){
			?>
            <div class="col-md-1 edit_col_right">
            	<a title="Remove Code" href="<?php echo $path?>checkout.php?remove_code=1" style="float:left;margin-top:5px;">X</a>
            </div>
            <?php 
			}
			?>
            <div class="col-md-2 edit_col_right">
                 <button type="button" class="btn btn-default" onclick="submitDiscountForm()">APPLY</button>
            </div>
           
           </div>
           
			<div class="totals col-sm-12" style="background:#fafafa;">
              <div class="inner">
                <table class="table shopping-cart-table-total" id="shopping-cart-totals-table">
                  <colgroup>
                  <col>
                  <col width="1">
                  </colgroup>
                  
                  <tbody>
                    <tr>
                      <td colspan="1" class="a-left" style=""> Subtotal </td>
                      <td class="a-right text-right" style=""><span class="price" id="sub_total_check"><?php echo '$'.number_format($subTotal,2)?></span></td>
                    </tr>
                    <?php
					// This line + Whole Check 
					if($target_type=='Free Shipping'){
						$cent_percent=$target_type;
					}
					?>
					<tr>
                      <td colspan="1" class="a-left" style=""> Discount </td>
                      <td class="a-right text-right" style=""><span class="discount_check"><?php echo $cent_percent?></span></td>
                    </tr>
					<tr>
                      <td colspan="1" class="a-left" style=""> Shipping<br />(1-3 business days)</td>
                      <td class="a-right text-right" style=""><span class="price" id="ship_check">0.00</span></td>
                    </tr>
					<tr>
                      <td colspan="1" class="a-left" style=""> Taxes </td>
                      <td class="a-right text-right" style=""><span class="price" id="tax_check">0.00</span></td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="1" class="a-left" style=""><b>Grand Total</b></td>
                      <td class="a-right text-right" style=""><b><span class="price" id="grand_total_check"><?php echo '$'.number_format($grandTotal,2)?></span></b></td>
                    </tr>
                  </tfoot>
                </table>
                
              </div>
            
            </div>
            
          </div>
          <div class="buttons-set11">
            	<button onclick="submitCheckout()" class="button get-quote pull-center btn-success" title="Purchase" type="submit" id="makePayment"><span>Purchase</span></button>
          </div>
		  </div>	
        </div>
        </form>
              
            </div>
        </center>
      </div>
    </div>
  </section>
</div>
<form action="<?php echo $path.'checkout.php'?>" method="post" id="discountForm">
<input type="hidden" name="dCode" id="dc" value="" />
</form>
<?php require_once 'includes/footer.php'?>
<script type="text/javascript">
function submitCheckout(){
	$('#paymentForm').submit();
}
function submitDiscountForm(){
	//$("form#paymentForm").prop('id','editTags');
	dc=$('#dCode').val();
	$('#dc').val(dc);
	$('#discountForm').submit();
}
</script>