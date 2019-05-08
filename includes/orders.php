<?php 
$phone="123456789";
##################################
$billing_address='"billing_address":{
					  "first_name":"'.$fname.'",
					  "last_name":"'.$lname.'",
					  "address1":"'.$address1.'",
					  "phone":"'.$phone.'",
					  "city":"'.$city.'",
					  "province":"'.$province.'",
					  "country":"'.$country.'",
					  "zip":"'.$zip.'"
    				},';
$shipping_address='"shipping_address":{
					  "first_name":"'.$fname.'",
					  "last_name":"'.$lname.'",
					  "address1":"'.$address1.'",
					  "phone":"'.$phone.'",
					  "city":"'.$city.'",
					  "province":"'.$province.'",
					  "country":"'.$country.'",
					  "zip":"'.$zip.'"
    				},';
##################################################
$sql="select * from orders where session_id='".$_SESSION['session_id']."' and order_status=1";
$result=$con->query($sql);
$order_instruction="";
$line_items="";
$email_items_bundle=array();
while($row1=$result->fetch_assoc()){
	$order_id=$row1['order_id'];
	$order_name=encode($row1['order_name']);
	$order_name_count=encode($row1['order_name_count']);
	$order_option=encode($row1['order_option']);
	$order_price=encode($row1['order_price']);
	$order_total=encode($row1['order_total']);
	$special_inst=escape($row1['order_instruction']);
	$order_instruction.=$order_name.' '.$order_name_count.': '.$special_inst.'\n';
	$order_status=encode($row1['order_status']);
	########################################################
	$sql="select * from orders_detail where order_id='".$order_id."' order by od_id asc";
	$result_=$con->query($sql);
  	$count=mysqli_num_rows($result_);
	
	$email_items=array();
  	$product_total=0;
	while($row2=$result_->fetch_assoc()){
		$product_id=encode($row2['product_id']);
		$product_title=encode($row2['product_title']);
		$product_image=encode($row2['product_image']);
		$variant_id=encode($row2['variant_id']);
		$variant_title=encode($row2['variant_title']);
		$variant_price=encode($row2['variant_price']);
		$product_total+=$variant_price;
		$_PRODUCT=$product_title.'('.$order_name.' - '.$order_name_count.')';    
		$line_items.='{
						"title":"'.$_PRODUCT.'", 
						"requires_shipping":true,     
						"variant_id":"'.$variant_id.'"     
					},';
		
		$email_items[]=array('product'=>$_PRODUCT, 'src'=>$product_image, 'variant'=>$variant_title, 'price'=>$variant_price);
	}
	$email_items_bundle[]=array('name'=>$order_name, 'count'=>$order_name_count, 'beed_price'=>$order_price, 'beed_name'=>$order_option, 'special_inst'=>$special_inst, 'product_total'=>$product_total + $order_price, 'line_items'=>$email_items);
}

$line_items=rtrim($line_items,',');
#___________________________________________#
$free_ship_discount='';
if($discount_code!=''){
	$cent=$_SESSION['discount']['cent'];
	$value_type=$_SESSION['discount']['value_type'];
	$free_ship_discount='"discount_codes":
	[
		{
			"code": "'.$discount_code.'",
			"amount": "'.$cent.'",
			"type": "'.$value_type.'"
  		}
	],';
}
else{
	$free_ship_discount='';
}
#___________________________________________#
$orderJSON='{
  "order":{
    "note":"'.$order_instruction.'",
    "send_receipt": false,
    "send_fulfillment_receipt": false,
    "total_discounts":'.$discount_value.',    
    "taxes_included": false, 
    "total_tax": '.$tax.',
    "line_items": [
      '.$line_items.'
    ],
    '.$billing_address.'
    '.$shipping_address.'
    "email": "'.$email.'",
    "tax_lines": [
      {
        "price": '.$tax.',
        "rate": '.($tax_percent/100).',
        "title": "State Tax"
      }
    ],
	
	'.$free_ship_discount.'
	
	"shipping_lines": [
	  {
		"code": "INT.TP",
		"price": '.$shipping.',
		"price_set": {
		  "shop_money": {
			"amount": '.$shipping.',
			"currency_code": "USD"
		  },
		  "presentment_money": {
			"amount": "3.17",
			"currency_code": "USD"
		  }
		},
		"discounted_price": "4.00",
		"discounted_price_set": "4.00",
		"source": "canada_post",
		"title": "Standard Shipping",
		"tax_lines": [],
		"carrier_identifier": "third_party_carrier_identifier",
		"requested_fulfillment_service_id": "third_party_fulfillment_service_id"
	  }
	]
  	}
}';
//echo $orderJSON;exit;
$apiUrl='https://' . $API_KEY . ':' . $SECRET . '@' . $STORE_URL . '/admin/orders' . '.json';
$curl=curl_init();
curl_setopt($curl, CURLOPT_URL, $apiUrl);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_VERBOSE, 0);
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_POSTFIELDS, $orderJSON);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$response=curl_exec ($curl);
$order_number_shopify='';
if(curl_error($curl)){
    echo curl_error($curl);
}
else{
    $resp=json_decode($response);
    $order_number_shopify=$resp->order->order_number;
	#######Email Stuff After Order###################
	$a='';
	$_count=0;
	$subTotal_E=0;
	foreach($email_items_bundle as $val){
	$subTotal_E+=$val['product_total'];
	foreach($val['line_items'] as $_items){
	$_count++;
	if($_count==1){
		$beed_name=$val['beed_name'];
		$beed_price=$val['beed_price'];
		$beed='';
		if($beed_name!='' && $beed_price!=''){
			$beed='('.$beed_name.': + $'.number_format($beed_price,2).')';
		}
		$a.='<tr class="order-list__item" style="width: 100%">
		<td class="order-list__item__cell" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; padding-bottom: 15px">
		  <table style="border-spacing: 0; border-collapse: collapse">
			 <tbody>
				<tr>
				   <td style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif">
					  <img src="https://cdn.shopify.com/s/files/1/0046/9473/6965/files/LIFElet_Logo_RGB_Colour_300x.png?v=1540230453" alt="LifeLet" align="left" width="150" class="order-list__product-image" style="margin-right: 15px; border-radius: 8px; border: 1px solid #e5e5e5">
				   </td>
				   <td class="order-list__product-description-cell" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; width: 100%">
					  <span class="order-list__item-title" style="font-size: 16px; font-weight: 600; line-height: 1.4; color: #555">'.$val['name'].'-'.$val['count'].'</span><br>
				   </td>
				   <td class="order-list__price-cell" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; white-space: nowrap">
					  <p class="order-list__item-price" style="color: #555; line-height: 150%; font-size: 16px; font-weight: 600; margin: 0 0 0 15px" align="right">
						 $'.number_format($val['product_total'],2).'
					  </p>
				   </td>
				</tr>
			 </tbody>
		  </table>
		</td>
		</tr>';
		
		if($special_inst!=''){
			$a.='<tr class="order-list__item" style="width: 100%;border-bottom: 1px solid #e5e5e5;">
			<td class="order-list__item__cell" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif;">
			  <table style="border-spacing: 0; border-collapse: collapse;margin-top:10px;">
				 <tbody>
					<tr>
					   <td colspan="3" class="order-list__product-description-cell" style="font-size: 16px; font-weight: 600; line-height: 1.4; color: #555">Special Instructions</td>
					</tr>
				 </tbody>
			  </table>
			</td>
			</tr>';
			
			$a.='<tr class="order-list__item" style="width: 100%">
			<td class="order-list__item__cell" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; padding-bottom: 15px">
			  <table style="border-spacing: 0; border-collapse: collapse">
				 <tbody>
					<tr>
					   <td colspan="3" class="order-list__product-description-cell" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; width: 100%">'.$val['special_inst'].'</td>
					</tr>
				 </tbody>
			  </table>
			</td>
			</tr>';
		}
	}
	$border="";
	if($_count==1){
		$border=";width: 100%;border-top-width: 1px;border-top-color: #e5e5e5;border-top-style: solid;";	
	}
	$a.='<tr class="order-list__item" style="width: 100%'.$border.'">
	   <td class="order-list__item__cell" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; padding-bottom: 15px">
		  <table style="border-spacing: 0; border-collapse: collapse">
			 <tbody>
				<tr>
				   <td style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif">
					  <img src="'.$_items['src'].'" align="left" width="60" height="60" class="order-list__product-image" style="margin-right: 15px; border-radius: 8px; border: 1px solid #e5e5e5">
				   </td>
				   <td class="order-list__product-description-cell" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; width: 100%">
					  <span class="order-list__item-title" style="font-size: 16px; font-weight: 600; line-height: 1.4; color: #555">'.$_items['product'].'</span><br><span class="order-list__item-variant" style="font-size: 14px; color: #999">'.$_items['variant'].'</span><br>
				   </td>
				   <td class="order-list__price-cell" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; white-space: nowrap">
					  <p class="order-list__item-price" style="color: #555; line-height: 150%; font-size: 16px; font-weight: 600; margin: 0 0 0 15px" align="right">
						 $'.$_items['price'].'
					  </p>
				   </td>
				</tr>
			 </tbody>
		  </table>
	   </td>
	</tr>';
	}
	$_count=0;
	}
	include ('includes/email.php');
}
