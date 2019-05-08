<?php 
require_once('includes/header.php');
# Get 4 & 8 Life_Exp
$sql="select * from life_exp where le_category='8' order by le_id desc";
$result_8=$con->query($sql);
$sql="select * from life_exp where le_category='4' order by le_id desc";
$result_4=$con->query($sql);
if(isset($_POST['exp'])){
	##########################
	$name='';
	$cart_name='';
	$exp=$_POST['exp'];
	$option=$_POST['form_variant'];
	$price=$_POST['form_price'];
	##########################
	if($exp=='16'){
		$name='16 Life Experiences';
	}
	if($exp=='8'){
		$name='8 Life Experiences';
	}
	if($exp=='4'){
		$name='4 Life Experiences';
	}
	$_SESSION['exp']=array('name'=>$name, 'option'=>$option, 'price'=>$price, 'number'=>$exp);
	//header('Location:https://lifelet.ca/product_listing.php');exit;
	header('Location:'.$path.'product_listing.php');exit;
}
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if($actual_link=='https://www.lifelet.ca/' || $actual_link=='http://www.lifelet.ca/' || $actual_link=='http://lifelet.ca/'){
header('Location:https://lifelet.co/');exit;
}
#######Get Text#############
$sql="select * from bracelet_text where id=1";
$result=$con->query($sql);
$mfa=$result->fetch_assoc();
$top=encode($mfa['top']);
$exp_16=encode($mfa['exp_16']);
$exp_8=encode($mfa['exp_8']);
$exp_4=encode($mfa['exp_4']);
?>
<div class="kd-content">
  <section class="kd-pagesection">
    <div class="container">
      <div class="row">
        <center>
          <div class="col-md-12">
            <div class="kd-rich-editor">
              <center>
                <h2 class="title_text">Bracelet </h2>
                <div class="underline_small"></div>
              </center>
              <div class="col-md-10 text-left">
                <?php echo $top?>
              </div>
            </div>
            
            
            <form action="" method="post" name="form_life_exp" id="form_life_exp">
            <div class="col-md-10 mobile">
              <div class="main_sec text-left">
                <div class="col-md-10">
                  <input type="radio" checked name="exp" id="exp_16" value="16" class="life_exp">
                  <strong>16 Life Experiences</strong><br>
                  <p class="sec_right" id="exp_16_text"><?php echo $exp_16?></p>
                </div>
               
              </div>
              <div class="main_sec_to text-left">
             
                <div class="col-md-10 mob">
                  <input type="radio" name="exp" id="exp_8" value="8" class="life_exp">
                  <strong>8 Life Experiences</strong><br>
                  <p class="sec_right" id="exp_8_text"><?php echo $exp_8?></p>
                </div>
                <div class="col-md-2 mob_right mob">
                  <button type="button" class="btn btn-default pull-right btn_options btn-sm btn-md" data-toggle="modal" data-target="#opt_8" id="btn_opt_8">OPTION</button>
                </div>
              </div>
              <div class="main_sec_three text-left">
                <div class="col-md-10">
                  <input type="radio" name="exp" id="exp_4" value="4" class="life_exp">
                  <strong>4 Life Experiences</strong><br>
                  <p class="sec_right" id="exp_4_text"><?php echo $exp_4?></p>
                </div>
                <div class="col-md-2 mob_right">
                  <button type="button" class="btn btn-default pull-right btn_options btn-sm btn-md" data-toggle="modal" data-target="#opt_4" id="btn_opt_4">OPTION</button>
                </div>
              </div>
              <br>
			  <a href="second.html">
              	<button type="submit" class="btn btn-success pull-center" onclick="return continueForm()">Continue</button>
              </a>
              <p class="error_option" id="error_option">You must select the material for the blank beads on your bracelet</p>
            </div>
            <input type="hidden" name="form_variant" id="form_variant" value="">
			<input type="hidden" name="form_price" id="form_price" value="">
            </form>
          </div>
        </center>
      </div>
    </div>
  </section>  
</div>


<div class="modal fade" id="opt_8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">Choose Material</h3>
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
			$count=0;
			if($result_8->num_rows > 0){
			while($row=$result_8->fetch_assoc()){
			$count++;
			$id=$row['le_id'];
			$category=$row['le_category'];
			$variant=encode($row['le_option']);
			$price=encode($row['le_price']);//'$'.number_format(
			?>
                <tr>
                    <td><?php echo $variant?></td>
                    <td> <?php echo '$'.number_format($price)?> </td>
                    <td> <label><button type="button" class="btn btn-success options" data-toggle="modal" data-target="#opt_8" onClick="
                    lifeExp(8,<?php echo $id?>,'<?php echo $variant?>','<?php echo $price?>')">Select</button></label></td>
                </tr>
            <?php 
			}
			}
			?>
            </tbody>
        </table>
      </div>
     
    </div>
  </div>
</div>


<div class="modal fade" id="opt_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">Choose Material</h3>
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
			$count=0;
			if($result_4->num_rows > 0){
			while($row=$result_4->fetch_assoc()){
			$count++;
			$id=$row['le_id'];
			$category=$row['le_category'];
			$variant=encode($row['le_option']);
			$price=encode($row['le_price']);//'$'.number_format(
			?>
                <tr>
                    <td><?php echo $variant?></td>
                    <td> <?php echo '$'.number_format($price)?> </td>
                    <td> <label><button type="button" class="btn btn-success options" data-toggle="modal" data-target="#opt_4" onClick="
                    lifeExp(4,<?php echo $id?>,'<?php echo $variant?>','<?php echo $price?>')">Select</button></label></td>
                </tr>
            <?php 
			}
			}
			?>
            </tbody>
        </table>
      </div>
     
    </div>
  </div>
</div>

<?php require_once('includes/footer.php')?>
<script type="text/javascript">
$('.life_exp').click(function(){
	id=$(this).attr('id');
	id=returnDigit(id);
	$('.btn_options').hide();
	$('#btn_opt_'+id).show();
	clearSelection();
});
function lifeExp(life_exp, id, variant, price){
	uncheckLifeExp();
	checkLifeExp(life_exp);
	
	$('#form_variant').val(variant);
	$('#form_price').val(price);
}
function uncheckLifeExp(){
	$('.life_exp').prop('checked', false);
	return true;

}
function checkLifeExp(life_exp){
	$('#exp_' + life_exp).prop('checked', true);
	return true;
}
function clearSelection(){
	$('#form_variant').val('');
	$('#form_price').val('');
}
function returnDigit(str){
	var num=parseInt(str.match(/\d+/),10);
	return num;
}
function continueForm(){
	var life_exp=$('input[name=exp]:checked').attr('id');
	id=returnDigit(life_exp);
	form_variant=$('#form_variant').val();
	form_price=$('#form_price').val();
	if(id!=16){
		if(form_variant=='' || form_price==''){
			$('#error_option').show();
			setTimeout(function(){ 
				$("#error_option").hide();
			},3000);
			return false;
		}
		else{
			return true;	
		}
	}
	
}
</script>