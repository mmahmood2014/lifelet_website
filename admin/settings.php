<?php 
require_once('header.php');
if(isset($_POST['submit'])){
	$public_key=$_POST['public_key'];
	$secret_key=encode($_POST['secret_key']);
	$data=array(
		'public_key'=>escape($public_key),
		'secret_key'=>escape($secret_key)
	);
	dbRowUpdate('settings', $data, 'id=1');
	$con->close();
	header('Location:'.$path.'admin/settings.php');
}
?>
<div class="kd-content">
  <section class="kd-pagesection">
    <div class="container">
      <div class="row">
        <center>
          <div class="col-md-12">
            <div class="kd-rich-editor">
              <center>
                <h2 class="title_text"> Stripe API Credentials</h2>
                <div class="underline_small"></div>
              </center>
            </div>
            <br>
            
            
            <!--<div class="col-md-10 text-right">
              <a href="<?php echo $path?>life_exp_listing.php">Back</a>
            </div>-->
        
            <div class="col-md-12"></div>
            <div class="col-md-10 mobile_tab">
			
			
			
		
			
			<div class="table-responsive">
            	
                
                <form action="<?php echo $path.'admin/settings.php'?>" method="post">
            	<table class="table table-bordered">
                	
                    <tr>
                    	<td>Public Key</td>
                        <td><input type="text" name="public_key" value="<?php echo $public_key?>" placeholder="pk_test_AfWHtT5RclqKHoMNDXxYkcoP" required="required" class="form-control" spellcheck="false" /></td>
                    </tr>
                    <tr>
                    	<td>Secret Key</td>
                        <td><input type="text" name="secret_key" value="<?php echo $secret_key?>" placeholder="sk_test_ur4uR85ANAYFTqVsdE0UXCD8" required="required" class="form-control" spellcheck="false" /></td>
                    </tr>
                    <tr align="right">
                    	<td colspan="2"><input type="submit" name="submit" value="Update" class="btn btn-primary" /></td>
                    </tr>
                </table>
                </form>
                
                  
			</div>
              
            </div>
          </div>
        </center>
      </div>
    </div>
  </section>
</div>
<?php require_once('footer.php')?>