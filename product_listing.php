<?php 
require_once 'includes/header.php';
require_once 'pagination/pagination.php';
if(!isset($_SESSION['exp'])){
	header('Location:'.$path);exit;
}
###############################
if(isset($_POST['order_id'])){
	$order_id=$_POST['order_id'];
	$comment=escape($_POST['comment']);
	$data=array('order_status'=>1,'order_instruction'=>$comment);
	$where="where order_id='".$order_id."' and session_id='".$_SESSION['session_id']."'";
	dbRowUpdate('orders', $data, $where);
	header('Location:'.$path.'cart.php');
	exit;
}
###############################

$count_bundle_name=countBundleName($_SESSION['session_id'], $_SESSION['exp']['name']);
if($count_bundle_name==0){
	$data=array(
		'session_id'=>escape($_SESSION['session_id']),
		'order_name'=>escape($_SESSION['exp']['name']),
		'order_name_count'=>1,
		'order_option'=>escape($_SESSION['exp']['option']),
		'order_price'=>escape($_SESSION['exp']['price']),
		'order_date'=>date('Y-m-d H:i:s')
	);
	dbRowInsert('orders', $data);
}
updateBundleCount($_SESSION['session_id'], $_SESSION['exp']['name']);
$bundle_name=getBundleName($_SESSION['session_id'], $_SESSION['exp']['name']);

##################################


##################################
$collect_id=0;
$keyword='';
$url='https://' . $API_KEY . ':' . $SECRET . '@' . $STORE_URL . '/admin/products' . '.json?limit=250&page=1';
################################

# Filter:Collections
if(isset($_GET['collect_id']) && !isset($_GET['keyword'])){
	$collect_id=$_GET['collect_id'];
	$url='https://' . $API_KEY . ':' . $SECRET . '@' . $STORE_URL . '/admin/products' . '.json?collection_id='.$collect_id.'&limit=250&page=1';
}
# Filter:Keyword
if(isset($_GET['keyword']) && !isset($_GET['collect_id'])){
	$keyword=urlencode($_GET['keyword']);
	$url='https://' . $API_KEY . ':' . $SECRET . '@' . $STORE_URL . '/admin/products' . '.json?title='.$keyword.'&limit=250&page=1';
	if(encode($_GET['keyword'])==''){
		header('Location:product_listing.php');
		exit;
	}
}
# Filter: Both Cellection & Keyword
if(isset($_GET['keyword']) && isset($_GET['collect_id'])){
	$keyword=urlencode($_GET['keyword']);
	$collect_id=$_GET['collect_id'];
	$url='https://' . $API_KEY . ':' . $SECRET . '@' . $STORE_URL . '/admin/products' . '.json?collection_id='.$collect_id.'&title='.$keyword.'&limit=250&page=1';
}
//echo $url;
$all_products=getCurlResponse($url);
# Get All Collections
$collections=getCustomCollections();
?>
<div class="kd-content">
  <section class="kd-pagesection">
    <div class="container">
      <div class="row">
        <center>
          <div class="col-md-12">
            <div class="kd-rich-editor">
              <center>
                <h2 class="title_text"> <?php echo $_SESSION['exp']['name']?></h2>
                 </center>
                <div class="col-md-6">
                <!--<div class="underline_small"><a href="<?php echo $path?>product_listing.php">Reset</a></div>-->
              	
				<?php 
				if($_count_life_exp < $_SESSION['exp']['number']){
				?>
                <div id="popup_msg" class="alert alert-warning fade in alert-dismissible">
                	<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                	<?php echo $warning_exactly?>
            	</div>
                
                <?php 
				}
				else{
				?>
                <div id="popup_msg" class="alert alert-success fade in alert-dismissible">
                	<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                	<strong>Success!</strong> You have added <?php echo $_SESSION['exp']['number']?> items. Now you can proceed!
            	</div>
                <?php 
				}
				?>
                <div id="warning_exactly_hidden" style="display:none"><?php echo $warning_exactly?></div>
                <div id="warning_more_items" style="display:none"><?php echo $warning_more_items?></div>
                
                
                </div>
             
              
            
              
            </div>
            <br>
            <div class="col-md-3 mobile_frm-cont">
            
                <select name="collects" id="collects" class="form-control selcls">
                    <option value="">Select...</option>
                    <?php
                    foreach($collections->custom_collections as $result){
                    $sel="";
                    if($collect_id==$result->id){
                    $sel="selected='selected'";
                    }
                    ?>
                    	<option <?php echo $sel?> value="<?php echo $result->id?>"><?php echo encode($result->title)?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            
            <div class="col-md-7 text-right mobile_seacrh">
              <form name="" id="" method="get">
              	<input value="<?php echo urldecode(encode($keyword))?>" type="text" name="keyword" id="keyword" placeholder="Search..." spellcheck="false" class="fa fa-search mob_sea">
              </form>
            </div>
        
            <div class="col-md-12"></div>
            <div class="col-md-10 mobile_tab">
					
			<?php 
			$pagination=new pagination($all_products->products, (isset($_GET['page']) ? $_GET['page'] : 1), 12);
			$pagination->setShowFirstAndLast(false);
			$pagination->setMainSeperator(' ');
			$productPages=$pagination->getResults();
			?>
            <div class="table-responsive">
                <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="text-center mob_hid dask">Image</th>
                    <th class="text-center mob_hid dask Category" style="width:42%;">Category</th>
                    <th class="text-center dask">Life Experience</th>
                    <th class="text-center mob_hid dask Category" style="display:none;">Price Range</th>
                    <th class="text-center dask">Material</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    $count=0;
                    foreach($productPages as $result){
                    $count++;
                    $id=$result->id;
                    $title=encode($result->title);
                    $product_type=encode($result->product_type);
					$tags=encode($result->tags);
                    $body_html=encode($result->body_html);
                    $src=$result->image->src;
                    ##########################
                    $vid=getVariantID($id);
                    //$price=getVariantPrice($result->variants, $vid);
					$selected_options_btn_class='';
					$price_range=productPrice($_SESSION['session_id'], $id, 0);
					if($price_range==''){
						$price_range=getPriceRange($result->variants);
					}
					else{
						$price_range='$'.$price_range;
						$selected_options_btn_class='selected_options_btn';
					}
					//$category=getCollection($id);
                    ?>
                    <tr>
                        <td class="text-center mob_hid"><img src="<?php echo $src?>" class="img_con"></td>
                        <td class="text-left mob_hid"><?php echo $tags?></td>
                        <td class="text-left"><a href="#" class="adoption" data-toggle="modal" data-target="#desc_box_<?php echo $id?>"><?php echo $title?></a></td>
                        <td class="text-left mob_hid" style="display:none;"> <span id="price_<?php echo $id?>"><?php echo $price_range?></span> </td>
                        <td class="text-left">
                        	<button type="button" class="btn btn-success options btn_options_mob <?php echo $selected_options_btn_class?>" id="selected_options_btn_<?php echo $id?>" data-toggle="modal" data-target="#price_box_<?php echo $id?>">Options</button>
                        </td>
                    </tr>
                    <?php
					}
					?>
                
                </tbody>
                </table>
              </div>
              <!--<div class="pagination"> <a href="#">&laquo;</a> <a href="#">1</a> <a href="#" class="active">2</a> <a href="#">3</a> <a href="#">4</a> <a href="#">&raquo;</a> </div>-->
				<?php 
                echo $pageNumbers='<div class="numbers">'.$pagination->getLinks($_GET).'</div><br>';
                ?>
            </div>
          </div>
        </center>
      </div>
    </div>
  </section>
</div>

<?php
$count=0;
foreach($productPages as $result){
	$count++;
	# Get Variant Name
	$variant='';
	foreach($result->options as $opt){
		$variant.=$opt->name.', ';
	}
	$variant=rtrim($variant, ', ');
	##################################3
	$id=$result->id;
	$title=encode($result->title);
	$src=$result->image->src;
?>
<div class="modal fade" id="price_box_<?php echo $id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Choose Material</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Material</th>
                    <th>Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            	<?php 
				$flag=0;
				foreach($result->variants as $var){
				$flag++;
				$id_=encode($var->id);
				$title_=encode($var->title);
				$price_=encode($var->price);
				$isVariant=isVariant($id_);
				$check="";
				if($isVariant){
					$check="checked='checked'";
				}
				###################################################################
				$selectedVariant=selectedVariantOption($_SESSION['session_id'], $id, $id_);
				$selected_options_btn_class='';
				if($selectedVariant!=''){
					$selected_options_btn_class='selected_options_btn';
				}
				####################################################################
				?>
                <tr>
                    <td><?php echo $title_?></td>
                    <td>
                    	$<?php echo number_format($price_,2)?>
                    	<input type="hidden" id="var_price_<?php echo $id_?>" value="<?php echo $price_?>" />
                    </td>
                    <td> <label><button type="button" class="btn btn-success options <?php echo $selected_options_btn_class?>" id="choose_material_<?php echo $id?>_<?php echo $id_?>" data-toggle="modal" onClick="addPrice(<?php echo $id?>,<?php echo $id_?>)" data-target="#price_box_<?php echo $id?>">Select</button></td>
                </tr>
                <?php
				}
				?>
            </tbody>
        </table>
        </div>
     
    </div>
  </div>
</div>
<?php 
}
?>


<?php
$count=0;
foreach($productPages as $result){
$count++;
##########################
$id=$result->id;
$title=encode($result->title);
$tags=encode($result->tags);
$body_html=encode($result->body_html);
##########################
$_imgs=array();
foreach($result->images as $imgs){
	$_imgs[]=$imgs=$imgs->src;
}
?>
<div class="modal fade" id="desc_box_<?php echo $id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <h3 class="modal-title" id="exampleModalLongTitle" style="visibility:hidden;"><?php echo $title?></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      
      
      
      <div class="modal-body">
      
      	
      
        <div class="col-md-12 blogShort">
            <center>
                <h2 class="modal-title" id="exampleModalLongTitle"><?php echo $title?></h2>
            </center>
            <center>
                <h4 class="modal-title" id="exampleModalLongTitle"> <?php echo $tags?></h4>
            </center>
            <br>
            <div class="col-md-12 blogShort" style="padding-left:0">
                <div id="myCarousel_<?php echo $id?>" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <?php
					  $count_images=0;
					  foreach($_imgs as $_IMAGE){
					  	$active='';
						if($count_images==0){
							$active='active';
						}
					  ?> 
                      <li data-target="#myCarousel_<?php echo $id?>" data-slide-to="<?php echo $count_images?>" class="<?php echo $active?>"></li>
                      <?php
					  $count_images++;
                      }
                      ?>
                    </ol>
                    <div class="carousel-inner">
                      <?php
					  $_count_images=0;
					  foreach($_imgs as $_src){
					  	$active_='';
						if($_count_images==0){
							$active_='active';
						}
					  ?>
                      <div class="item <?php echo $active_?>">
                        <img src="<?php echo $_src?>" alt="<?php echo $title?>" style="width:100%;">
                      </div>
                      <?php
					  $_count_images++;
					  }
					  ?>
                    </div>
                    <a class="left carousel-control" href="#myCarousel_<?php echo $id?>" data-slide="prev">
                      <i class="fas fa-arrow-left edit-arrow"></i>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel_<?php echo $id?>" data-slide="next">
                      <i class="fas fa-arrow-right edit-arrow"></i>
                      <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="col-md-12 blogShort" style="padding-left:0;padding-right:0;padding-top:10px;">
        			<article><p class="slider_text_sort"><?php echo $body_html?></p></article>
        		</div>
        	</div>
            <!--<img src="<?php echo $src?>" alt="<?php echo $title?>" class="pull-left img-responsive postImg img-thumbnail margin10 edit_img">-->
        
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
}
?>


<script type="text/javascript">
function openNav(){
    document.getElementById("mySidepanel").style.width="50%";
	document.getElementById("mySidepanel").classList.add('openpanel');
}
function closeNav(){
    document.getElementById("mySidepanel").style.width="0";
	document.getElementById("mySidepanel").classList.remove('openpanel');
}
</script>
<?php require_once('includes/footer.php')?>
<script type="text/javascript">
$(document).ready(function() {
    
	$(".prev_page").after("<p>");
	$(".next_page").before("</p>");
	html=$(".numbers").html();
	
	var res=html.split("<p></p>");
	var prev_next='';
	var links='';
	for(i=0;i<res.length;i++){
		if(i==0 || i==2){
			var space='';
			if(i==0){
				space='&nbsp;&nbsp;&nbsp;';	
			}
			prev_next+=res[i] + space;
		}
		if(i==1){
			links=res[i];
		}
	}
	final_html=links + '<p>' + prev_next + '</p>';
	$(".numbers").html(final_html);
});
</script>
<!--<script type="text/javascript" language="javascript">
window.onbeforeunload = function() {
   var Ans = confirm("Are you sure you want change page!");
   if(Ans==true)
	   return true;
   else
	   return false;
};
</script>-->