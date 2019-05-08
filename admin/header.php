<?php 
require_once '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>website</title>
<link href="<?php echo $path?>css/bootstrap.css" rel="stylesheet">
<link href="<?php echo $path?>style1.css" rel="stylesheet">
<link href="<?php echo $path?>css/custom.css" rel="stylesheet">

<?php 
if($page=='checkout.php'){
?>
	<link href="<?php echo $path?>css/checkout.css" rel="stylesheet">
<?php
}
?>

<link href="<?php echo $path?>css/responsive.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=4dfy5wt86ulny6gww0822f8hebtb1683ndm96nqcnlvgffob"></script>
<script>
tinymce.init({
	selector: '#top'
});
tinymce.init({
	selector: '#exp_16'
});
tinymce.init({
	selector: '#exp_8'
});
tinymce.init({
	selector: '#exp_4'
});
tinymce.init({
	selector: '#warning_review'
});
tinymce.init({
	selector: '#above_special_inst'
});
tinymce.init({
	selector: '#warning_exactly'
});
tinymce.init({
	selector: '#warning_more_items'
});
</script>
</head>
<body>
<header id="mainheader">
  <div class="kd-headbar">
<?php
if($page=='product_listing.php'){
	
	$sql="SELECT o.*, od.* from orders o inner join orders_detail od on o.order_id=od.order_id where o.session_id='".$_SESSION['session_id']."' and o.order_status='0' order by od.od_id asc";
	$result=$con->query($sql);
	$_name=encode($_SESSION['exp']['name']);
	$_number=encode($_SESSION['exp']['number']);
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
                <td class="text-left" style="border:1px solid #ddd;"></td>  
                <td class="text-left" style="border:1px solid #ddd;"></td>  
                <td class="text-right" style="background:#efefef; width:30%;"><strong>Subtotal &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span id="subTotal"><?php echo '$'.number_format($_subTotal,2)?></span> </strong></td>
            </tr>
        </table>
        <h4>Special Instructions</h4>
        <div class="main_table____">
            <textarea class="form-control" rows="3" id="comment" name="comment" spellcheck="false"></textarea>
        </div>
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
    <div><button class="openbtn" onclick="openNav()"><img src="images/Black_Left_Arrow.png"></button></div>
</div>
<!-- End -->
<?php 
}
?>
  
  
  
  
    <div class="container">
      <div class="row">
        <div class="col-md-3"><a href="<?php echo $path?>admin" class="logo"><img src="<?php echo $path?>images/logo.png" class="img-responsive" alt=""></a></div>
        <div class="col-md-9">
          <div class="kd-rightside">
            <nav class="navbar navbar-default navigation">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
              </div>
              <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <ul class="nav navbar-nav">
                  <li><a href="<?php echo $path?>admin/index.php">Orders</a></li>
                  <li><a href="<?php echo $path?>admin/life_exp_listing.php">Life Experiences Material</a></li>
                  <li><a href="#">Pages</a>
                    <ul class="sub-dropdown">
                      <li><a href="<?php echo $path?>admin/bracelet_text.php">Bracelet</a></li>
                      <li><a href="<?php echo $path?>admin/bracelet_bundle_text.php">Bundle</a></li>
                    </ul>
                  </li>
                  <li><a href="<?php echo $path?>admin/settings.php">Settings</a>
                    <!--<ul class="sub-dropdown">
                      <li><a href="#">Bracelets</a></li>
                      <li><a href="#">Gift Card</a></li>
                    </ul>-->
                  </li>
                  
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>