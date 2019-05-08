<?php 
if(isset($_GET['hmac'])){

	echo "<h1>My Shopify Admin</h1>";	
}
echo "<h1>My Shopify Apps</h1>";


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://lifelet.myshopify.com/admin/oauth/access_token");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "client_id=6fd2db884fe0906b09cdf2a74532e0ea&client_secret=5a1a55c44b12a78b9b144dce9cace444&code=c2d3434d0108865331132ffe436d4dc4");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close ($ch);
print_r($server_output);
exit();
echo $server_output;
echo "abc";
exit();


/*https://lifelet.myshopify.com/admin/oauth/request_grant?client_id=6fd2db884fe0906b09cdf2a74532e0ea&redirect_uri=https://lifelet.ca/&scope=read_products,write_products,read_customers,write_customers,read_orders,write_orders,read_inventory,write_inventory,read_locations,read_fulfillments,write_fulfillments,read_shipping,write_shipping,read_checkouts,write_checkouts,unauthenticated_write_checkouts,unauthenticated_write_customers,read_price_rules,write_price_rules&state=lefelet



https://lifelet.ca/?code=c2d3434d0108865331132ffe436d4dc4&hmac=d54f427dd589e260258779ba6dc78399344a8596b95812666c292918534ab1cd&shop=lifelet.myshopify.com&timestamp=1543577963



Warning: Unterminated comment starting line 23 in /home/lifelet3/public_html/app_valid.php on line 23
My Shopify Apps
{"access_token":"f675201c63dc8316e1818fef208c8946","scope":"write_products,write_customers,write_orders,write_inventory,read_locations,write_fulfillments,write_shipping,write_checkouts,unauthenticated_write_checkouts,unauthenticated_write_customers,write_price_rules"}