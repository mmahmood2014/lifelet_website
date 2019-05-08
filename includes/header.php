<?php 
require_once 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="//cdn.shopify.com/s/files/1/0046/9473/6965/files/Favicon_-_png_32x32.png?v=1540098722" type="image/png" />
<title>LIFElet</title>
<link href="<?php echo $path_?>css/bootstrap.css" rel="stylesheet">
<link href="<?php echo $path_?>style1.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=News+Cycle" rel="stylesheet">
<link href="<?php echo $path_?>css/custom.css" rel="stylesheet">

<?php 
if($page=='checkout.php'){
?>
	<link href="<?php echo $path_?>css/checkout.css" rel="stylesheet">
<?php
}
?>

<link href="<?php echo $path_?>css/responsive.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '190376955233831');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=190376955233831&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
</head>
<body>
<header id="mainheader">
  <div class="kd-headbar">
<?php
if($page!='index.php'){
	/* db.php code goes here bcoz session is not set on live site in db.php file */
	$sql="SELECT order_id FROM orders where order_status=0 and session_id='".$_SESSION['session_id']."'";
	$result=$con->query($sql);
	if($result->num_rows > 0){
		while($row=$result->fetch_assoc()){
			$id__=$row['order_id'];
			$where__="where order_id='".$id__."'";
			
			$sql__="SELECT * FROM orders_detail where order_id='".$id__."'";
			$result__=$con->query($sql__);
			if($result__->num_rows==0){
				dbRowDelete('orders',$where__);
			}
		}
	}
}
if($page=='product_listing.php'){
	#######Get Text###################################################
	$sql="select * from bracelet_bundle_text where id=1";
	$result=$con->query($sql);
	$mfa=$result->fetch_assoc();
	$warning_exactly=encode($mfa['warning_exactly']);
	$warning_exactly=str_replace('{nth}',$_SESSION['exp']['number'],$warning_exactly);
	$warning_review=encode($mfa['warning_review']);
	$above_special_inst=encode($mfa['above_special_inst']);
	$warning_more_items='';
	$warning_more_items=encode($mfa['warning_more_items']);
	###################################################################
	$sql="SELECT o.*, od.* from orders o inner join orders_detail od on o.order_id=od.order_id where o.session_id='".$_SESSION['session_id']."' and o.order_status=0 order by od.od_id asc";
	$result=$con->query($sql);
	###################################################################
	$_name=encode($_SESSION['exp']['name']);
	$_option=encode($_SESSION['exp']['option']);
	$_spacer_price=encode($_SESSION['exp']['price']);
	$_number=encode($_SESSION['exp']['number']);
	###################################################################
	$manyItem=manyItem($_SESSION['session_id']);
	if($manyItem!=0){
		if($_name!=encode($manyItem['order_name'])){
			$warning_more_items=encode($mfa['warning_more_items']);	
		}
		//$manyItemDiff=manyItemDiff($_SESSION['session_id'],$_name,$_option);
		updateBundleItem($manyItem['order_id'],$_SESSION['session_id'],$_name,$_option,$_spacer_price);
	}
	####################################################################
	$_count_life_exp=$result->num_rows;
	$_bname=getBundleName($_SESSION['session_id'], $_name);
	if(encode($_bname)=='-'){
		$_bname=$_name;
	}
	$_bname_all='('.$_count_life_exp.'/'.$_number.') - '.$_bname;
	if($_count_life_exp < 1){
		$_bname_all='(0/'.$_number.') - '.$_bname;
	}
?>
<!-- Hide/Show Popup Window -->
<div id="mySidepanel" class="sidepanel">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <form action="" method="post" id="form_popup" name="form_popup">
    	<div class="col-md-12">
        <h4><span id="bundle_name"><?php echo $_bname_all?></span></h4>
        <table class="table table-bordered" id="tbl_popup">
            <tbody>
            	<?php
				$_orderID='';
				$_subTotal=0;
				while($row=$result->fetch_assoc()){
					$_orderID=$row['order_id'];
					$_id=$row['product_id'];
					$_src=encode($row['product_image']);
					$_title=encode($row['product_title']);
					$_price=encode($row['variant_price']);
					$_subTotal=encode($row['order_total']);
				?>
                <tr id="tr_<?php echo $_id?>">
                	<td class="text-center"><img src="<?php echo $_src?>" class="img_con"></td>
                    <td class="text-left"><?php echo $_title?></td>
                    <td class="text-center"><?php echo '$'.number_format($_price,2)?></td>
                    <td class="text-right">
                    	<a class="remove_item_a" href="javascript:void(0)" onclick="removeBuckItem('<?php echo $_id?>')" title="Remove Item">
                        	<i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                <?php
				}
				?>
            </tbody>
            
            <tr>
                <td class="text-left" style="border:1px solid #ddd;border-right:0;"></td>  
                <td class="text-left" style="border:1px solid #ddd;border-left:0;"><strong>Subtotal</strong></td>  
                <td class="text-center" style="background:#efefef; width:30%;"><strong><span id="subTotal"><?php echo '$'.number_format($_subTotal,2)?></span> </strong></td>
            </tr>
            <?php 
			if($_option!=''){
			?>
            <tr>
                <td class="text-left" style="border:1px solid #ddd;border-right:0;"></td>  
                <td class="text-left" style="border:1px solid #ddd;border-left:0;"><strong><?php echo 'Blank beads: '.$_option?></strong></td>  
                <td class="text-center" style="background:#efefef;width:30%;"><strong><span id="spacer_price"><?php echo '$'.number_format($_spacer_price,2)?></span> </strong></td>
            </tr>
            <?php 
			}
			?>
            <tr>
                <td class="text-left" style="border:1px solid #ddd;border-right:0;"></td>  
                <td class="text-left" style="border:1px solid #ddd;border-left:0;"><strong>Bracelet Total</strong></td>  
                <td class="text-center" style="background:#efefef; width:30%;"><strong><span id="total_plus_spacer"><?php echo '$'.number_format($_subTotal + $_spacer_price,2)?></span> </strong></td>
            </tr>
        </table>
        <?php
        if($above_special_inst!=''){
			echo "<p>".$above_special_inst."</p>";
		}
		?>
        <h4>Special Instructions</h4>
        <div class="main_table____">
            <textarea class="form-control" rows="4" id="comment" name="comment" spellcheck="false"></textarea>
        </div>
        <center id="warning_bundle_msg">
            <div class="alert alert-warning fade in alert-dismissible"><?php echo $warning_review?></div>
        </center>
        <br>
        <center><button type="submit" onClick="return addToCart()" class="btn btn-success">ADD TO CART</button></center>
        <br>
        <input type="hidden" name="count_life_exp" id="count_life_exp" value="<?php echo $_count_life_exp?>">
        <input type="hidden" name="total_life_exp" id="total_life_exp" value="<?php echo $_number?>">
        <input type="hidden" name="order_id" id="order_id" value="<?php echo $_orderID?>">
    </div>
    </form>
</div>
<div class="facebook">
    <div><button class="openbtn" onclick="openNav()"><img src="<?php echo $path_?>images/Black_Left_Arrow.png"></button></div>
</div>
<!-- End -->
<?php 
}
?>
  
  
  
  
    <div class="container">
      <div class="row">
        <div class="col-md-3"><a href="<?php echo $path?>" class="logo"><img src="<?php echo $path_?>images/logo.png" class="img-responsive" alt=""></a></div>
        <div class="col-md-9">
          <div class="kd-rightside">
            <nav class="navbar navbar-default navigation">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
              </div>
              <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <ul class="nav navbar-nav">
                  <li><a href="https://lifelet.co/pages/what-is-it">What is it?</a></li>
                  <li><a href="https://lifelet.co/collections">Life Experiences</a></li>
                  <li><a href="https://lifelet.co/pages/life-experience-stories">Life Stories</a></li>
                  <li><a href="#">Shop &nbsp; <i class="fas fa-caret-down"></i></a>
                    <ul class="sub-dropdown">
                      <li><a href="https://lifelet.co/apps/lifeletcheckout">Bracelets</a></li>
                      <li><a href="#">Gift Card</a></li>
                    </ul>
                  </li>
                  <div class="kd-search"> <i class="fas fa-user space"></i> <a href="#" class="kd-searchbtn" data-toggle="modal" data-target="#searchmodalbox"><i class="fa fa-search"></i></a> 
				    <a href="<?php echo $path.'cart.php'?>">
                  <i class="fas fa-shopping-cart space"></i>
                  </a>
				  
                    <div class="modal fade kd-loginbox" id="searchmodalbox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-body"> <a href="#" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
                            <div class="kd-login-title">
                              <h4>Search Your KeyWord</h4>
                            </div>
                            <form>
                              <p><i class="fa fa-search"></i>
                                <input type="text" placeholder="Enter Your Keyword">
                              </p>
                              <p>
                                <center>
                                  <input type="submit" value="Search" class="thbg-color">
                                </center>
                              </p>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </ul>
              </div>
            </nav>
          </div>
          
        <div class="kd-search mob_cart" style="display:none;">
            <a href="<?php echo $path.'cart.php'?>">
                <i class="fas fa-shopping-cart space"></i>
            </a>
        </div>
          
        </div>
      </div>
    </div>
  </div>
</header>