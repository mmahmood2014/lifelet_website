<?php 

function dbRowInsert($table_name, $form_data)

{
	global $con;
    // retrieve the keys of the array (column titles)

    $fields = array_keys($form_data);

	$escaped_values = array_map('escape',array_values($form_data));

    // build the query

    $sql = "INSERT INTO ".$table_name."

    (`".implode('`,`', $fields)."`)

    VALUES('".implode("','", $escaped_values)."')";

    // run and return the query result resource
	if($con->query($sql) === TRUE){
		return mysqli_insert_id($con);
	}
	else{
		echo "Error: " . $sql . "<br>" . $con->error;
		return 0;
	}
}

function dbRowDelete($table_name, $where_clause='')

{
	global $con;
    // check for optional where clause

    $whereSQL = '';

    if(!empty($where_clause))

    {

        // check to see if the 'where' keyword exists

        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')

        {

            // not found, add keyword

            $whereSQL = " WHERE ".$where_clause;

        } else

        {

            $whereSQL = " ".trim($where_clause);

        }

    }

    // build the query

    $sql = "DELETE FROM ".$table_name.$whereSQL;



    // run and return the query result resource
    if($con->query($sql) === TRUE){
		return 1;
	}
	else{
		//echo "Error: " . $sql . "<br>" . $conn->error;
		return 0;
	}

}

// again where clause is left optional

function dbRowUpdate($table_name, $form_data, $where_clause='')

{
	global $con;
    // check for optional where clause

    $whereSQL = '';

    if(!empty($where_clause))

    {

        // check to see if the 'where' keyword exists

        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')

        {

            // not found, add key word

            $whereSQL = " WHERE ".$where_clause;

        } else

        {

            $whereSQL = " ".trim($where_clause);

        }

    }

    // start the actual SQL statement

    $sql = "UPDATE ".$table_name." SET ";



    // loop and build the column /

    $sets = array();

    foreach($form_data as $column => $value)

    {

         $sets[] = "`".$column."` = '".$value."'";

    }

    $sql .= implode(', ', $sets);



    // append the where statement

    $sql .= $whereSQL;
	
    // run and return the query result
    
	if($con->query($sql) === TRUE){
		return 1;
	}
	else{
		//echo "Error: " . $sql . "<br>" . $conn->error;
		return 0;
	}
}

# Count String Function

function countString($str,$required_len, $concat=''){

	

	$result=substr($str,0,$required_len);

	if(strlen($str) > $required_len){

		return $result.$concat;

	}

	else{

		return $result;

	}

}





function getLatLong($address){

    if(!empty($address)){

        //Formatted address

        $formattedAddr = str_replace(' ','+',$address);

        //Send request and receive json data by address

        $geocodeFromAddr = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false'); 

        $output = json_decode($geocodeFromAddr);

        //Get latitude and longitute from json data

        $data['latitude']  = $output->results[0]->geometry->location->lat; 

        $data['longitude'] = $output->results[0]->geometry->location->lng;

        //Return latitude and longitude of the given address

        if(!empty($data)){

            return $data;

        }else{

            return false;

        }

    }else{

        return false;   

    }

}

function getCountry($id){

	$sql=mysqli_query("select * from countries where id='".$id."'");

	$mfa=mysqli_fetch_assoc($sql);

	return trim(stripslashes($mfa['name']));	

}

function getCity($id){

	$sql=mysqli_query("select * from cities where id='".$id."'");

	$mfa=mysqli_fetch_assoc($sql);

	return trim(stripslashes($mfa['name']));	

}

function getState($id){

	$sql=mysqli_query("select * from states where id='".$id."'");

	$mfa=mysqli_fetch_assoc($sql);

	return trim(stripslashes($mfa['name']));	

}

function getCategory($id){

	$sql=mysqli_query("select * from category where category_id='".$id."'");

	$mfa=mysqli_fetch_assoc($sql);

	return trim(stripslashes($mfa['category_title']));	

}

function getCategoryDetail($id){

	$sql=mysqli_query("select category_detail from category where category_id='".$id."'");

	$mfa=mysqli_fetch_assoc($sql);

	return trim(stripslashes($mfa['category_detail']));

}

function getCategoryTier($id){

	$array=array();

	$sql=mysqli_query("select * from category where category_id='".$id."'");

	$mfa=mysqli_fetch_assoc($sql);

	$cid=$mfa['category_id'];

	$title=encode($mfa['category_title']);

	$parent=encode($mfa['category_parent']);

	$array[]=$title;

	if($parent!=0){

		$sql=mysqli_query("select * from category where category_id='".$parent."'");

		$mfa=mysqli_fetch_assoc($sql);

		$title_=encode($mfa['category_title']);

		$array[].=$title_;

	}

	return array_reverse($array);

}

function getCategorySlug($id){

	$array=array();

	$sql=mysqli_query("select * from category where category_id='".$id."'");

	$mfa=mysqli_fetch_assoc($sql);

	$cid=$mfa['category_id'];

	$slug_=encode($mfa['category_slug']);

	$parent=encode($mfa['category_parent']);

	

	$sql=mysqli_query("select * from category where category_id='".$parent."'");

	$mfa=mysqli_fetch_assoc($sql);

	$slug=encode($mfa['category_slug']);

	return $slug.'/'.$slug_;

}
function getCategoryParent($id){

	$sql=mysqli_query("select category_parent from category where category_id='".$id."'");

	$mfa=mysqli_fetch_assoc($sql);

	$parent=$mfa['category_parent'];

	

	$sql=mysqli_query("select * from category where category_id='".$parent."'");

	$mfa=mysqli_fetch_assoc($sql);

	return trim(stripslashes($mfa['category_id']));

}

function getCategoryImage($cid){

	/*$sql=mysqli_query("select category_parent from category where category_id='".$cid."'");

	$mfa=mysqli_fetch_assoc($sql);

	$parent=$mfa['category_parent'];

	

	$sql=mysqli_query("select * from category where category_id='".$parent."'");

	$mfa=mysqli_fetch_assoc($sql);

	return trim(stripslashes($mfa['category_image']));*/
	
	$sql=mysqli_query("select * from category where category_id='".$cid."'");
	$mfa=mysqli_fetch_assoc($sql);
	return escape($mfa['category_image']);
}

function getParentCategoryImage($cid){

	$sql=mysqli_query("select category_image from category where category_id='".$cid."'");

	$mfa=mysqli_fetch_assoc($sql);

	return encode($mfa['category_image']);

}

function isOnline($post_id){

	$mfa=mysqli_fetch_assoc(mysqli_query("select user_id from post where post_id='".$post_id."'"));

	$user_id=$mfa['user_id'];

	$q=mysqli_query("select * from online_user where user_id='".$user_id."'");

	if(mysqli_num_rows($q) > 0){

		$mfa=mysqli_fetch_assoc($q);

		$time=$mfa['login_time'];

		$time=date("g:i a", $time);//"F j, Y, g:i a"

		return $time;

	}

	else{

		return 0;	

	}

}

function countOnline($city_id, $category_id){

	$sql="select count(*) as total from post p inner join online_user ou on p.user_id=ou.user_id where p.post_city='".$city_id."'";

	$mfa=mysqli_fetch_assoc(mysqli_query($sql));

	$total=$mfa['total'];

	return $total;

}

function countOnlineAll(){

	$sql="select p.*,ou.* from post p inner join online_user ou on p.user_id=ou.user_id";

	$total=mysqli_num_rows(mysqli_query($sql));

	return $total;

}

function getIP(){

	if (!empty($_SERVER["HTTP_CLIENT_IP"])){

		$ip = $_SERVER["HTTP_CLIENT_IP"];

	}

	elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){

		$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];

	}

	else{

		$ip = $_SERVER["REMOTE_ADDR"];

	}

	return $ip;

}

function youLike($post_id){

	$likes_count=mysqli_num_rows(mysqli_query("select * from likes where post_id='".$post_id."' and ip_address='".getIP()."'"));

	return $likes_count;

}

function countLike($post_id){

	return mysqli_num_rows(mysqli_query("select * from likes where post_id='".$post_id."'"));

}



function removePost($pid){

	$query=mysqli_query("select p.*,pi.* from post p inner join post_image pi on p.post_id=pi.post_id where p.post_id='".$pid."'");

	if(mysqli_num_rows($query) > 0){

	while($mfa=mysqli_fetch_assoc($query)){

		$path=$_SERVER['DOCUMENT_ROOT'].'/admin/images/document/';

		$main_image=$mfa['post_image'];

		$video=$mfa['post_video'];

		$sub_image=$mfa['pi_image'];

		if(file_exists($path.$main_image)){

			unlink($path.$main_image);

		}

		if(file_exists($path.$video)){

			unlink($path.$main_image);

		}

		if(file_exists($path.$sub_image)){

			unlink($path.$main_image);

		}

	}

	mysqli_query("delete from post_more_categories where post_id='".$pid."'");

	mysqli_query("delete from post_image where post_id='".$pid."'");

	mysqli_query("delete from likes where post_id='".$pid."'");

	mysqli_query("delete from favorite where post_id='".$pid."'");

	mysqli_query("delete from post where post_id='".$pid."'");

	}

	

}



function removeBanner($bid){

	$query=mysqli_query("select banner_image from banner where banner_id='".$bid."'");

	if(mysqli_num_rows($query) > 0){

		$mfa=mysqli_fetch_assoc($query);

		$path=$_SERVER['DOCUMENT_ROOT'].'/admin/images/brand/';

		$image=$mfa['banner_image'];

		if(file_exists($path.$image)){

			unlink($path.$image);

		}

		mysqli_query("delete from banner where banner_id='".$bid."'");

	}

}

function countVideo(){

	$sql="select count(*) as total from post where post_video!=''";

	$mfa=mysqli_fetch_assoc(mysqli_query($sql));

	return $mfa['total'];

}

function countLikes($post_id){

	$sql="select count(*) as total from likes where post_id='".$post_id."'";

	$mfa=mysqli_fetch_assoc(mysqli_query($sql));

	return $mfa['total'];

}

function getQuestion($sq_id, $option, $type){

	$str='';

	$count=0;

	if($type=='single'){

		foreach($option as $val){

			$count++;

			$check="";

			if(isset($_SESSION['answer']) && !empty($_SESSION['answer'])){

				if(isset($_SESSION['answer'][$sq_id])){

					$ans=$_SESSION['answer'][$sq_id];

					if($count==$ans){

						$check="checked='checked'";	

					}

				}

			}

			$str.="<div class='options'><input type='radio' $check name='answer' value=".$count." /> ".$val."</div>";

		}

	}

	if($type=='multiple'){

		foreach($option as $val){

			$count++;

			$check="";

			if(isset($_SESSION['answer']) && !empty($_SESSION['answer'])){

				if(isset($_SESSION['answer'][$sq_id])){

					$exp=explode(',',$_SESSION['answer'][$sq_id]);

					if(in_array($count, $exp)){

						$check="checked='checked'";	

					}

				}

			}

			$str.="<div class='options'><input type='checkbox' $check name='answer[]' value=".$count." /> ".$val."</div>";

		}

	}

	if($type=='list'){

		$str.="<div class='options'><select name='answer' id='answer'><option value=''>Select...</option>";

		foreach($option as $val){

			$count++;

			$select="";

			if(isset($_SESSION['answer']) && !empty($_SESSION['answer'])){

				if(isset($_SESSION['answer'][$sq_id])){

					$ans=$_SESSION['answer'][$sq_id];

					if($count==$ans){

						$select="selected='selected'";	

					}

				}

			}

			$str.="<option $select value=".$count.">".$val."</option>";

		}

		$str.="</select></div>";

	}

	return $str;

}

function getOption($sq_id){

	

	$query=mysqli_query("select * from survey_question where sq_id='".$sq_id."'");

	$mfa=mysqli_fetch_assoc($query);

	$option=array();

	for($i=1;$i<=4;$i++){

		$option[$i]=trim(stripslashes($mfa['sq_option'.$i]));

	}

	return $option;

}

function getThumbnail($iframe){

	$embedCode=$iframe;

	preg_match('/src="([^"]+)"/', $embedCode, $match);

	$videoURL=$match[1];

	$urlArr=explode("/",$videoURL);

	$urlArrNum=count($urlArr);

	$youtubeVideoId=$urlArr[$urlArrNum - 1];

	$youtubeVideoId=explode('?', $youtubeVideoId);

	$thumbURL='http://img.youtube.com/vi/'.$youtubeVideoId[0].'/0.jpg';

	return $thumbURL;

}

function slug($title){

	$exp=explode(' ',trim($title));

	$slug='';

	foreach($exp as $value){

		if($value!='' && $value!='-'){

			$slug.=strtolower(trim($value)).'-';

		}

	}

	$remove[] = "'";

	$remove[] = '"';

	$remove[] = "&";

	$remove[] = "_";

	$remove[] = "%";

	$remove[] = "$";

	$remove[] = "*";

	$remove[] = "@";

	$remove[] = "!";

	$remove[] = ";";

	$remove[] = ",";

	$remove[] = "=";

	$remove[] = "+";

	$remove[] = "#";

	$remove[] = "<";

	$remove[] = "<";

	$remove[] = ">>";

	$remove[] = "<<";

	$remove[] = "®";

	$remove[] = "~";

	$remove[] = "[";

	$remove[] = "]";

	$remove[] = "{";

	$remove[] = "}";

	$remove[] = "(";

	$remove[] = ")";

	$remove[] = ":";

	$remove[] = "’";

	$remove[] = "|";

	$remove[] = "™";

	$remove[] = "–";

	

	$slug=str_replace($remove, "", $slug);

	$slug=rtrim($slug,'-');

	$slug=str_replace('--','-',$slug);

	$slug=str_replace(' --','-',$slug);

	$slug=str_replace('-- ','-',$slug);

	$slug=str_replace('/','-',$slug);

	return $slug;

}

function getEventRows(){

	return mysqli_num_rows(mysqli_query("select * from event where event_status=1 and event_held >= CURDATE()"));

}

function isProductExist($product_id){

	return mysqli_num_rows(mysqli_query("select * from products where product_id='".$product_id."'"));

}

function getEventOffsetRows($offset){

	return mysqli_num_rows(mysqli_query("select * from event where event_status=1 and event_held >= CURDATE() order by event_held asc LIMIT 3 OFFSET $offset"));

}

function getEventOffsetRows6($offset){

	return mysqli_num_rows(mysqli_query("select * from event where event_status=1 and event_held >= CURDATE() order by event_held asc LIMIT 3 OFFSET $offset"));

}

function getNewsRows(){

	return mysqli_num_rows(mysqli_query("select * from brand where brand_date <= NOW() + INTERVAL 2 MONTH"));

}

function getNewsOffsetRows($offset){

	return mysqli_num_rows(mysqli_query("select * from brand order by brand_id desc LIMIT 3 OFFSET $offset"));

}

function getNews6OffsetRows($offset){

	return mysqli_num_rows(mysqli_query("select * from brand where brand_date <= NOW() + INTERVAL 2 MONTH order by brand_id desc LIMIT 3 OFFSET $offset"));

}

function getVideoRows(){

	return mysqli_num_rows(mysqli_query("select * from video"));

}

function getVideoOffsetRows($offset){

	return mysqli_num_rows(mysqli_query("select * from video order by video_id desc LIMIT 3 OFFSET $offset"));

}

function getURL(){

	return $url="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

}

function encodeString($keyword){

	return urlencode($keyword);

}

function limit_text($text, $limit) {

	if(str_word_count($text, 0) > $limit) {

		$words = str_word_count($text, 2);

		$pos = array_keys($words);

		$text = substr($text, 0, $pos[$limit]) . '...';

	}

	return $text;

}

function numRows($query){

	return mysqli_num_rows($query);

}

function escape($str){
	global $con;
	return trim(mysqli_real_escape_string($con,$str));

}

function encode($str){

	return trim(stripslashes($str));

}

function getOrderPrice($price,$sprice){

	$order_price=$price;

	if($sprice!=''){

		$order_price=$sprice;	

	}

	return $order_price;

}

function getVIP() {

    $ipaddress = '';

    if (isset($_SERVER['HTTP_CLIENT_IP']))

        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];

    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))

        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];

    else if(isset($_SERVER['HTTP_X_FORWARDED']))

        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];

    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))

        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];

    else if(isset($_SERVER['HTTP_FORWARDED']))

        $ipaddress = $_SERVER['HTTP_FORWARDED'];

    else if(isset($_SERVER['REMOTE_ADDR']))

        $ipaddress = $_SERVER['REMOTE_ADDR'];

    else

        $ipaddress = 'UNKNOWN';

    return $ipaddress;

}

function getPriceFormat($price, $sprice){

	$final='';

	if($sprice!=''){

		$final='Rs.'.number_format($sprice);

		if($price!=''){

			$final.='  '.'<span style="text-decoration:line-through;color:#990100">Rs.'.number_format($price).'</span>';

		}

	}

	else{

		$final='Rs.'.number_format($price);

	}

	return $final;

}

function getPrice($price, $sprice){

	$final='';

	if($price!='' && $sprice!=''){

		$final=$sprice;

	}

	else{

		$final=$price;

	}

	return $final;

}

function getProductBy($column,$id){

	$mfa=mysqli_fetch_assoc(mysqli_query("select $column from product where product_id='".$id."'"));
	$data=encode($mfa[$column]);
	return $data;
}
function lastSeen($image_id){
    if(!isset($_SESSION['lastSeen'])){
        $_SESSION['lastSeen']=array($image_id);
    }
	else{

		$tmpSession=$_SESSION['lastSeen'];

		$tmpSession[]=$image_id;  

		$tmpSession=array_unique($tmpSession);

		if(count($tmpSession) > 5){

			$tmpSession=array_slice($tmpSession,1);

		}

		$_SESSION['lastSeen'] = $tmpSession;

	}

	return true;

}

function isActive($is_page,$page){

	if($is_page==$page){

		$class="class='active'";

		return $class;

	}

}

function isActiveCategory($is_id){

	$id=getCategoryParent($_GET['cid']);

	if($id==$is_id){

		return "active";

	}

}

function isSale($price, $sprice){

	if($price!='' && $sprice!=''){

		return 1;	

	}

	else{

		return 0;	

	}

}

function getHost(){

	return $_SERVER['HTTP_HOST'];

}

function getCategoryTree(){

	global $path;

	$tree='';

	$host=getHost();

	$url=getURL();

	$exp=explode('/', $url);

	if($host=='localhost'){

		$c1=$exp[4];

		$c2=$exp[5];

		

		$mfa=mysqli_fetch_assoc(mysqli_query("select * from category where category_slug='".$c1."'"));

		$title_1=encode($mfa['category_title']);

		

		$mfa=mysqli_fetch_assoc(mysqli_query("select * from category where category_slug='".$c2."'"));

		$cid_2=encode($mfa['category_id']);

		$title_2=encode($mfa['category_title']);

		# echo '<pre>'.print_r($exp,true).'</pre>';

		$url=$path.$c1.'/'.$c2.'/'.$cid_2;

		$tree="<li>".$title_1."</li><li><a href=".$url.">".$title_2."</a></li>";

		return $tree;

	}

	else{

		$c1=$exp[3];

		$c2=$exp[4];

		

		$mfa=mysqli_fetch_assoc(mysqli_query("select * from category where category_slug='".$c1."'"));

		$title_1=encode($mfa['category_title']);

		

		$mfa=mysqli_fetch_assoc(mysqli_query("select * from category where category_slug='".$c2."'"));

		$cid_2=encode($mfa['category_id']);

		$title_2=encode($mfa['category_title']);

		# echo '<pre>'.print_r($exp,true).'</pre>';

		$url=$path.$c1.'/'.$c2.'/'.$cid_2;

		$tree="<li>".$title_1."</li><li><a href=".$url.">".$title_2."</a></li>";

		return $tree;

	}

}

function getCategoryID(){

	$host=getHost();

	$url=getURL();

	$exp=explode('/', $url);

	if($host=='localhost'){

		$c2=$exp[5];

		$mfa=mysqli_fetch_assoc(mysqli_query("select * from category where category_slug='".$c2."'"));

		$cid_2=encode($mfa['category_id']);

		return $cid_2;

	}

	else{

		$c2=$exp[4];

		$mfa=mysqli_fetch_assoc(mysqli_query("select * from category where category_slug='".$c2."'"));

		$cid_2=encode($mfa['category_id']);

		return $cid_2;

	}

}

function getParentCategoryID($slug){

		$mfa=mysqli_fetch_assoc(mysqli_query("select * from category where category_slug='".$slug."'"));

		return $mfa['category_id'];

}

function getSubCats($cid){

		$query=mysqli_query("select * from category where category_parent='".$cid."'");

		$ids='';

		while($mfa=mysqli_fetch_assoc($query)){

			$ids.=$mfa['category_id'].',';

		}

		return rtrim($ids,',');

}

function getStatus($status_code){

		$mfa=mysqli_fetch_assoc(mysqli_query("select * from order_status where os_code='".$status_code."'"));

		$status=encode($mfa['os_title']);

		return $status;

}

# add to cart function

function addtocart($_p){
	#######################
	$p_id=$_p['p_id'];
	$p_title=$_p['p_title'];
	$p_src=$_p['p_src'];
	$v_id=$_p['v_id'];
	$v_title=$_p['v_title'];
	$v_price=$_p['v_price'];
	########################
	
	if($p_id < 1) return;
	if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
		remove_product($p_id);
		$max=count($_SESSION['cart']);
		$_SESSION['cart'][$max]['p_id']=$p_id;
		$_SESSION['cart'][$max]['p_title']=$p_title;
		$_SESSION['cart'][$max]['p_src']=$p_src;
		$_SESSION['cart'][$max]['v_id']=$v_id;
		$_SESSION['cart'][$max]['v_title']=$v_title;
		$_SESSION['cart'][$max]['v_price']=$v_price;
	}
	else{
		$_SESSION['cart']=array();
		$_SESSION['cart'][0]['p_id']=$p_id;
		$_SESSION['cart'][0]['p_title']=$p_title;
		$_SESSION['cart'][0]['p_src']=$p_src;
		$_SESSION['cart'][0]['v_id']=$v_id;
		$_SESSION['cart'][0]['v_title']=$v_title;
		$_SESSION['cart'][0]['v_price']=$v_price;
	}
}
# product_exists function

function product_exists($pid){
	$flag=0;
	$pid=intval($pid);
	$max=count($_SESSION['cart']);
	for($i=0;$i<$max;$i++){
		if($pid==$_SESSION['cart'][$i]['p_id']){
			//$_SESSION['cart'][$i]['qty']=$_SESSION['cart'][$i]['qty']+1;
			$flag=1;
			break;
		}
	}
	return $flag;
}

# get total cart amount function

function get_order_total(){

	

	$max=count($_SESSION['cart']);

	$sum=0;

	for($i=0;$i<$max;$i++){

		$pid=$_SESSION['cart'][$i]['pid'];

		$q=$_SESSION['cart'][$i]['qty'];

		$mfa=mysqli_fetch_assoc(mysqli_query("select product_price, product_sprice from product where product_id='".$pid."'"));

		$price=encode($mfa['product_price']);

		$sprice=encode($mfa['product_sprice']);

		$sum+=getPrice($price,$sprice)*$q;

	}

	return $sum;

}
# remove cart product function
function remove_product($pid){
	$max=count($_SESSION['cart']);
	for($i=0;$i<$max;$i++){
		$pid_=$_SESSION['cart'][$i]['p_id'];
		if($pid==$pid_){
			unset($_SESSION['cart'][$i]);
			$_SESSION['cart']=array_values($_SESSION['cart']);
		}
	}
}
function updateCart($pid, $qty){

	$pid=intval($pid);

	$qty=intval($qty);

	$max=count($_SESSION['cart']);

	for($i=0;$i<$max;$i++){

		if($pid==$_SESSION['cart'][$i]['pid']){

			$_SESSION['cart'][$i]['qty']=$qty;

			break;

		}

	}

}
function stringReverse($string, $n){
	//explode the string by space
	$str_arr = explode(' ', $string);
 
	//get the n value
	$num = 1;
	$input_num = $n;
 
	$i = 0;
	$new_str = '';
	foreach($str_arr as $str){	
		$new_str = $new_str.' '.$str;
		//$new_arr will keep the separated
		$new_arr[$i] = $new_str;
 
		//if the $input_num is less than $num. reset $num to 1 (else cond.)
		if($input_num > $num){
			$num++;
		}else{
			$i++;
			$num = 1;
			$new_str='';
		}
	}
	//krsort to reverse the order of $new_arr
	krsort($new_arr);
	//now just implode the $new_arr again to form a sentence
	$final_str = implode(' ', $new_arr);
	return $final_str;
}
function getProductByIndex($products, $pid, $index){
	foreach($products->products as $result){
		$product_id=$result->id;
		# Get Image
		if($index=='image' && $product_id == $pid){
			return $result->image->src;			
		}
		# Get Type
		if($index=='product_type'){
			return $result->product_type;
		}
	}
	return 1;
}
function getCustomCollections(){
	global $API_KEY, $SECRET, $STORE_URL;
	$url='https://' . $API_KEY . ':' . $SECRET . '@' . $STORE_URL . '/admin/custom_collections' . '.json';
	return getCurlResponse($url);
}
function getCurlResponse($url){
	$curl=curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_VERBOSE, 0);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	$response=curl_exec($curl);
	curl_close($curl);
	$result=json_decode($response);
	return $result;	
}
function pre($array){
	echo '<pre>'.print_r($array,true).'</pre>';
}
function getVariantPrice($var_obj,$vid){
	foreach($var_obj as $var){
		$id_=$var->id;
		$title_=encode($var->title);
		$price_=$var->price;
		if($vid==$id_){
			return '$'.$price_;
		}
	}
	return '...';
}
function getVariantID($pid){
	if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
		foreach($_SESSION['cart'] as $cart){
			if($pid==$cart['p_id']){
				return $cart['v_id'];	
			}
		}
	}
}
function isVariant($vid){
	if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
		foreach($_SESSION['cart'] as $cart){
			if($vid==$cart['v_id']){
				return 1;	
			}
		}
	}
	return 0;
}
function productInfo($_p,$_vid){
	$data=array();
	########### Product #########
	$data['p_id']=$_p->product->id;
	$data['p_title']=encode($_p->product->title);
	$data['p_src']=$_p->product->image->src;
	########### Variant #########
	foreach($_p->product->variants as $var){
		if($_vid==$var->id){
			$data['v_id']=$var->id;
			$data['v_title']=encode($var->title);
			$data['v_price']=encode($var->price);
		}
	}
	return $data;
}
function taxInfo($_t,$code){
	$data=array();
	########### Tax #########
	foreach($_t->countries[0]->provinces as $tax){
		if($tax->code==$code){
			$data['tax']=$tax->tax;
			$data['tax_percentage']=$tax->tax_percentage;
			$data['tax_percentage_format']=number_format($tax->tax_percentage,2).'%';
			$data['code']=$tax->code;
		}
	}
	return $data;
}
function getTax($total,$tax_array){
	$array=array();
	/*$tax_value=$total*$tax_array['tax'];
	$grandTotal=$total + $tax_value;
	$array=array('grand_total'=>$grandTotal,'tax_value'=>$tax_value);*/
	$tax_value=$total*$tax_array['tax'];
	$array=array('tax_value'=>$tax_value);
	return $array;
}
/*function shipInfo($_s){
	$data=array();
	########### Tax #########
	foreach($_s->shipping_zones[0]->price_based_shipping_rates as $ship){
		$data['amount']=$ship->max_order_subtotal;
		$data['amount_format']='$'.number_format($ship->max_order_subtotal,2);
		$data['discount']=$ship->price;
		$data['discount_format']='$'.number_format($ship->price,2);
	}
	return $data;
}*/
function shipInfo($_s){
	$data=array();
	########### Shipping #########
	foreach($_s->shipping_zones[0]->price_based_shipping_rates as $ship){
		$array=array();
		$array['name']=$ship->name;
		$array['min']=$ship->min_order_subtotal;
		$array['max']=$ship->max_order_subtotal;
		$array['price']=$ship->price;
		$array['price_format']='$'.number_format($ship->price,2);
		$data[]=$array;
	}
	return $data;
}
function getShiipingAmount($array,$total, $totalBundle){
	$ship_charge=0;
	foreach($array as $data){
		$name=$data['name'];
		$min=$data['min'];
		$max=$data['max'];
		$price=$data['price'];
		if($totalBundle==1 && $name=='1 bracelet'){
			$ship_charge=$price;
		}
		if($totalBundle==2 && $name=='2 bracelets'){
			$ship_charge=$price;
		}
		if($totalBundle==3 && $name=='3 bracelets'){
			$ship_charge=$price;
		}
		if($totalBundle==4 && $name=='4 bracelets'){
			$ship_charge=$price;
		}
		if($totalBundle==5 && $name=='5 bracelets'){
			$ship_charge=$price;
		}
		if($totalBundle>=6 && $name=='6 or more bracelets'){
			$ship_charge=$price;
		}
	}
	return $ship_charge;
}
function updateCartStatus(){
	if(isset($_SESSION['exp']) && !empty($_SESSION['exp'])){
		$max=count($_SESSION['exp']);
		for($i=0;$i<$max;$i++){
			$_SESSION['exp'][$i]['status']=0;
		}
	}
	return 1;
}
function addCount($name){
	if(isset($_SESSION['exp']) && !empty($_SESSION['exp'])){
		$max=count($_SESSION['exp']);
		$count=0;
		for($i=0;$i<$max;$i++){
			$_name=$_SESSION['exp'][$i]['name'];
			$_cart_name=$_SESSION['exp'][$i]['cart_name'];
			$_status=$_SESSION['exp'][$i]['status'];
			if($name==$_name){
				$count++;
				$_SESSION['exp'][$i]['count']=$count;
				if($_status==1){
					$_SESSION['exp'][$i]['cart_name']=$_cart_name.'_'.$count;
				}
			}
		}
	}
	return 1;
}
function addCount_(){
	if(isset($_SESSION['exp']) && !empty($_SESSION['exp'])){
		$max=count($_SESSION['exp']);
		foreach($_SESSION['exp'] as $data){
			$count=0;
			for($i=0;$i<$max;$i++){
				$name=$_SESSION['exp'][$i]['name'];
				$option=$_SESSION['exp'][$i]['option'];
				$cart_name=getCartName($name,$option);
				if($data['name']==$name){
					$count++;
					$_SESSION['exp'][$i]['count']=$count;
					$_SESSION['exp'][$i]['cart_name']=$cart_name.'_'.$count;
				}
			}
		}
	}
	return 1;
}
function activeExp(){
	$active=array();
	if(isset($_SESSION['exp']) && !empty($_SESSION['exp'])){
		$max=count($_SESSION['exp']);
		for($i=0;$i<$max;$i++){
			$_status=$_SESSION['exp'][$i]['status'];
			if($_status==1){
				$id=$_SESSION['exp'][$i]['id'];
				$name=$_SESSION['exp'][$i]['name'];
				$option=$_SESSION['exp'][$i]['option'];
				$price=$_SESSION['exp'][$i]['price'];
				$cart_name=$_SESSION['exp'][$i]['cart_name'];
				$status=$_SESSION['exp'][$i]['status'];
				$count=$_SESSION['exp'][$i]['count'];
				$active=array('id'=>$id, 'name'=>$name, 'option'=>$option, 'price'=>$price, 'cart_name'=>$cart_name, 'status'=>$status, 'count'=>$count);
				break;
			}
		}
	}
	return $active;
}
function removeExp($cart_name){
	if(isset($_SESSION['exp']) && !empty($_SESSION['exp'])){
		$max=count($_SESSION['exp']);
		for($i=0;$i<$max;$i++){
			$_cart_name=$_SESSION['exp'][$i]['cart_name'];
			//echo $cart_name.' kaleem '.$_cart_name;exit;
			if($cart_name==$_cart_name){
				unset($_SESSION['exp'][$i]);
				$_SESSION['exp']=array_values($_SESSION['exp']);
				updateCartStatus();
				addCount_();
			}
		}
	}
	return 1;
}
function getCartName($name,$option){
	$cart_name='';
	if($name=='life_exp_16'){
		$cart_name='16 Life Experience'.'('.$option.')';
	}
	if($name=='life_exp_8'){
		$cart_name='8 Life Experience'.'('.$option.')';
	}
	if($name=='life_exp_4'){
		$cart_name='4 Life Experience'.'('.$option.')';
	}
	return $cart_name;
}
function getCollection($id){
	global $API_KEY, $SECRET, $STORE_URL;
	$url='https://' . $API_KEY . ':' . $SECRET . '@' . $STORE_URL . '/admin/smart_collections.json?product_id='.$id;
	//$url='https://' . $API_KEY . ':' . $SECRET . '@' . $STORE_URL . '/admin/collects.json?product_id='.$id;
	$result=getCurlResponse($url);
	$title='';
	foreach($result->smart_collections as $data){
		$title.=encode($data->title).', ';
	}
	$title=rtrim($title, ', ');
	return $title;
}
function countBundleName($session_id, $order_name){
	global $con;
	$sql="select count(*) as total from orders where session_id='".$session_id."' and order_name='".$order_name."' and order_status=0";
	$result=$con->query($sql);
	$row=$result->fetch_assoc();
	return $row['total'];
}
function manyItem($session_id){
	global $con;
	$sql="select * from orders where session_id='".$session_id."' and order_status=0";
	$result=$con->query($sql);
	$num_rows=$result->num_rows;
	if($num_rows > 0){
		$row=$result->fetch_assoc();
		return $row;
	}
	else{
		return 0;
	}
}
function manyItemDiff($session_id,$exp_name,$exp_option){
	global $con;
	$sql="select * from orders where session_id='".$session_id."' and order_name='".$exp_name."' and order_option='".$exp_option."' and order_status=0";
	$result=$con->query($sql);
	return $result->num_rows;
}
function getNumber($str){
	return preg_replace("/[^0-9]/", '', $str);
}
function updateBundleItem($order_id,$session_id,$exp_name,$exp_option,$exp_price){
	global $con;
	//updateBundleCount($_SESSION['session_id'], $_SESSION['exp']['name']);
	$data=array('order_name'=>$exp_name, 'order_option'=>$exp_option, 'order_price'=>$exp_price);
	$where="where order_id='".$order_id."' and session_id='".$session_id."'";
	dbRowUpdate('orders', $data, $where);
	######Update Order Name/Count#################
	updateOrderTotal($order_id);
	updateBundleCountCart($session_id,$exp_name);
}
function getBundleName($session_id, $order_name){
	global $con;
	$sql="select order_name, order_name_count from orders where session_id='".$session_id."' and order_name='".$order_name."' and order_status=0";
	$result=$con->query($sql);
	$row=$result->fetch_assoc();
	return $row['order_name'].' - '.$row['order_name_count'];
}
function updateBundleCount($session_id, $order_name){
	global $con;
	
	$sql="select count(*) as total from orders where session_id='".$session_id."' and order_name='".$order_name."' and order_status=1";
	$result=$con->query($sql);
	$row=$result->fetch_assoc();
	$count=$row['total'] + 1;
	
	#### Update Order_Name_Count
	$order_id=currentBundleID($session_id);
	$data=array('order_name_count'=>$count);
	$where="where order_id='".$order_id."'";
	dbRowUpdate('orders', $data, $where);
}
function currentBundleID($session_id){
	global $con;
	$sql="select order_id from orders where session_id='".$session_id."' and order_status=0";
	$result=$con->query($sql);
	$row=$result->fetch_assoc();
	return $row['order_id'];
}
function updateBundleCountCart($session_id, $order_name){
	global $con;
	
	$sql="select * from orders where session_id='".$session_id."' and order_name='".$order_name."' order by order_id asc";
	$result=$con->query($sql);
	$count=0;
	while($row=$result->fetch_assoc()){
		$count++;
		$order_id=$row['order_id'];
		#### Update Order_Name_Count
		$data=array('order_name_count'=>$count);
		$where="where order_id='".$order_id."'";
		dbRowUpdate('orders', $data, $where);
	}
	return 1;
}
function deleteProductBeforeInsert($order_id, $pid){
	$where_="where order_id='".$order_id."' and product_id='".$pid."'";
	dbRowDelete('orders_detail',$where_);
}
function updateOrderTotal($order_id){
	global $con;
	
	$sql="SELECT sum(variant_price) as orderTotal FROM orders_detail where order_id='".$order_id."'";
	$result=$con->query($sql);
	$row=$result->fetch_assoc();
	$total=$row['orderTotal'];
	
	#### Update Order_Total
	$data=array('order_total'=>$total);
	$where="where order_id='".$order_id."'";
	dbRowUpdate('orders', $data, $where);
	return $total;
}
function getPriceRange($var_obj){
	$array=array();
	foreach($var_obj as $var){	
		$array[]=$var->price;
	}
	$min=min($array);
	$max=max($array);
	$price_range='$'.$min.' - '.'$'.$max;
	return $price_range;
}
function productPrice($session_id, $pid, $order_status){
	global $con;
	$sql="SELECT o.order_id, od.variant_price from orders o inner join orders_detail od on o.order_id=od.order_id where o.session_id='".$session_id."' and o.order_status='".$order_status."' and od.product_id='".$pid."'";
	$result=$con->query($sql);
	$row=$result->fetch_assoc();
	$price=$row['variant_price'];
	return $price;
}
function getProductPriceByID($order_id, $pid){
	
	global $con;
	$sql="SELECT o.order_id, od.variant_price from orders o inner join orders_detail od on o.order_id=od.order_id where o.order_id='".$order_id."' and od.product_id='".$pid."'";
	$result=$con->query($sql);
	$row=$result->fetch_assoc();
	$price=$row['variant_price'];
	return $price;
}
function selectedVariantOption($session_id, $pid, $vid){
	global $con;
	$sql="SELECT o.order_id, od.variant_id from orders o inner join orders_detail od on o.order_id=od.order_id where o.session_id='".$session_id."' and od.product_id='".$pid."' and od.variant_id='".$vid."' and o.order_status=0";
	$result=$con->query($sql);
	$row=$result->fetch_assoc();
	$variant_id=$row['variant_id'];
	return $variant_id;
}
function getDiscount($discount_code){
	global $API_KEY, $SECRET, $STORE_URL;
	$url='https://' . $API_KEY . ':' . $SECRET . '@' . $STORE_URL . '/admin/price_rules' . '.json';
	$result=getCurlResponse($url);
	//return $result;exit;
	$data=array('code'=>'','cent'=>0, 'cent_percent'=>'0.00', 'target_type'=>'', 'value_type'=>'');
	if(isValidDiscount($result,$discount_code)){
		foreach($result->price_rules as $_d){
			if($_d->title==$discount_code){
				$target_type=$_d->target_type;
				$value_type=$_d->value_type;
				$type='';
				if($target_type=='shipping_line'){
					$type='Free Shipping';
				}
				
				$cent=str_replace('-','',$_d->value);
				$data=array('code'=>$discount_code,'cent'=>$cent, 'cent_percent'=>number_format($cent).'%', 'target_type'=>$type, 'value_type'=>$value_type);
			}
		}
	}
	return $data;
}
function isValidDiscount($result,$discount_code){
	$flag=0;
	foreach($result->price_rules as $_d){
		if($_d->title==$discount_code){
			
			$target_type=$_d->target_type;
			$value_type=$_d->value_type;
			$starts_at=$_d->starts_at;
			$ends_at=$_d->ends_at;
			$once_per_customer=$_d->once_per_customer;
			$usage_limit=$_d->usage_limit;
			
			if($starts_at!='' && $ends_at!=''){
				$starts_at=strtotime($starts_at);
				$ends_at=strtotime($ends_at);
				$today=strtotime(date('Y-m-d H:i:s'));
				if($today >= $starts_at && $today <= $ends_at){
					//echo ' aaaaa ';
					$flag=1;
				}
			}
			if($starts_at!='' && $ends_at==''){
				$starts_at=strtotime($starts_at);
				$today=strtotime(date('Y-m-d H:i:s'));
				if($today >= $starts_at){
					//echo ' bbbbb ';
					$flag=1;
				}
			}
			#_________________________#
			$flag=discountUsageLimit($_d->id,$once_per_customer,$usage_limit);
			#_________________________#
		}
	}
	return $flag;
}
function discountUsageLimit($price_rule_id,$once_per_customer,$usage_limit){
	$flag=0;
	global $API_KEY, $SECRET, $STORE_URL;
	$url='https://' . $API_KEY . ':' . $SECRET . '@' . $STORE_URL . '/admin/price_rules/'. $price_rule_id . '/discount_codes.json';
	$_result=getCurlResponse($url);
	if($usage_limit!='' && $once_per_customer==''){
		foreach($_result->discount_codes as $_d){
			if($_d->usage_count <  $usage_limit){
				$flag=1;	
			}
		}
	}
	if($usage_limit=='' && $once_per_customer!=''){
		foreach($_result->discount_codes as $_d){
			$discountUsedByCustomer=discountUsedByCustomer($_d->code);
			if($discountUsedByCustomer < 1){
				$flag=1;	
			}
		}
	}
	if($usage_limit!='' && $once_per_customer!=''){
		foreach($_result->discount_codes as $_d){
			//echo $_d->usage_count .' } '.  $usage_limit.' ';
			if($_d->usage_count <  $usage_limit){
				$discountUsedByCustomer=discountUsedByCustomer($_d->code);
				if($discountUsedByCustomer < 1){
					$flag=1;
				}
			}
		}
	}
	return $flag;
}
function discountUsedByCustomer($discount_code){
	global $con;
	$and_email="";
	if(isset($_SESSION['email']) && $_SESSION['email']!=''){
		$and_email="and oc_cus_email='".escape($_SESSION['email'])."'";
	}
	$sql="select count(*) as total from orders_complete where oc_discount_code='".$discount_code."' $and_email"; 
	$result=$con->query($sql);
	$settings=$result->fetch_assoc();
	$total=encode($settings['total']);
	return $total;
}
function totalBundle($session_id){
	global $con;
	$sql="select count(*) as totalBundle from orders where session_id='".$session_id."'";
	$result=$con->query($sql);
	$settings=$result->fetch_assoc();
	$totalBundle=encode($settings['totalBundle']);
	return $totalBundle;
}
?>