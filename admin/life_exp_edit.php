<?php 
require_once('header.php');
if(!isset($_GET['edit'])){
	header('Location:'.$path.'admin/life_exp_listing.php');exit;
}
$id=$_GET['edit'];
if(isset($_POST['submit'])){
	$id=$_POST['id'];
	$category=escape($_POST['category']);
	$variant=escape($_POST['variant']);
	$price=escape($_POST['price']);
	$date=@date('Y-m-d H:i:s');
	$data=array(
		'le_category'=>escape($category),
		'le_option'=>escape($variant),
		'le_price'=>escape($price),
		'le_date'=>$date
	);
  	$where = 'le_id ='. $id;
  	dbRowUpdate('life_exp', $data, $where);
	$con->close();
	header('Location:'.$path.'admin/life_exp_listing.php');
}
# ___________________________________________________ #
$sql="SELECT * FROM life_exp WHERE le_id =".$id;
$result=$con->query($sql);
$row=$result->fetch_assoc();
$category=encode($row['le_category']);
$option=encode($row['le_option']);
$price=encode($row['le_price']);
# ___________________________________________________ #
?>
<div class="kd-content">
  <section class="kd-pagesection">
    <div class="container">
      <div class="row">
        <center>
          <div class="col-md-12">
            <div class="kd-rich-editor">
              <center>
                <h2 class="title_text"> Life Experience</h2>
                <div class="underline_small"></div>
              </center>
            </div>
            <br>
            
            
            <div class="col-md-10 text-right">
              <a href="<?php echo $path?>admin/life_exp_listing.php">Back</a>
            </div>
        
            <div class="col-md-12"></div>
            <div class="col-md-10 mobile_tab">
			
			
			
		
			
			<div class="table-responsive">
            	
                
                <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $id?>" />
            	<table class="table table-bordered">
                	
                    <tr>
                    	<td>Category</td>
                        <td>
                        	<select name="category" required="required" class="form-control">
                            	<option value="">Select...</option>
                            	<option value="4" <?php echo ($category == '4')?'selected':''?>>4 Life Experience</option>
                                <option value="8" <?php echo ($category == '8')?'selected':''?> >8 Life Experience</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                    	<td>Variant(Option)</td>
                        <td><input type="text" name="variant" required="required" class="form-control" spellcheck="false" value="<?php echo $option?>" /></td>
                    </tr>
                    <tr>
                    	<td>Price($)</td>
                        <td><input type="text" name="price" required="required" class="form-control" spellcheck="false" value="<?php echo $price?>" /></td>
                    </tr>
                    <tr align="right">
                    	<td colspan="2"><input type="submit" name="submit" value="Update Life Experience" class="btn btn-primary" /></td>
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

<div class="modal fade" id="exampleModalone" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <tr>
                <td>Nitrile Rubber</td>
                <td> $70.00 </td>
                <td> <label><button type="button" class="btn btn-success options" data-toggle="modal" data-target="#exampleModalone">Select</button></td>
              </tr>
              <tr>
                <td>Chloroprene Rubber</td>
                <td> $70.00 </td>
                <td> <label><button type="button" class="btn btn-success options" data-toggle="modal" data-target="#exampleModalone">Select</button></td>
              </tr>
              <tr>
                <td>Isoprene Rubber</td>
                 <td> $70.00 </td>
                 <td> <label><button type="button" class="btn btn-success options" data-toggle="modal" data-target="#exampleModalone">Select</button></td>
              </tr>
            </tbody>
        </table>
      </div>
     
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <th>Firstname</th>
                <th>Email</th>
                <th>Radio</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Nitrile Rubber</td>
                <td> $70.00 </td>
                <td> <label><button type="button" class="btn btn-success options" data-toggle="modal" data-target="#exampleModalone">Select</button></td>
              </tr>
              <tr>
                <td>Chloroprene Rubber</td>
                 <td> $70.00 </td>
                <td> <label><button type="button" class="btn btn-success options" data-toggle="modal" data-target="#exampleModalone">Select</button></td>
              </tr>
              <tr>
                <td>Isoprene Rubber</td>
                 <td> $70.00 </td>
                 <td> <label><button type="button" class="btn btn-success options" data-toggle="modal" data-target="#exampleModalone">Select</button></td>
              </tr>
            </tbody>
        </table>
      </div>
     
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalthree" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <th>Firstname</th>
                <th>Email</th>
                <th>Radio</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Nitrile Rubber</td>
                 <td> $70.00 </td>
                <td> <label><button type="button" class="btn btn-success options" data-toggle="modal" data-target="#exampleModalone">Select</button></td>
              </tr>
              <tr>
                <td>Chloroprene Rubber</td>
                 <td> $70.00 </td>
                <td> <label><button type="button" class="btn btn-success options" data-toggle="modal" data-target="#exampleModalone">Select</button></td>
              </tr>
              <tr>
                <td>Isoprene Rubber</td>
                 <td> $70.00 </td>
                 <td> <label><button type="button" class="btn btn-success options" data-toggle="modal" data-target="#exampleModalone">Select</button></td>
              </tr>
            </tbody>
        </table>
      </div>
  
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <h3 class="modal-title" id="exampleModalLongTitle" style="visibility:hidden;">One Title</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12 blogShort">
        <center>
        	 <h2 class="modal-title" id="exampleModalLongTitle">One Title</h2>
        </center>
        <center>
        	 <h4 class="modal-title" id="exampleModalLongTitle"> Lorem Ipsum is simply dummy text</h4>
        </center>
        <br>
                     <img src="http://joern-duwe.de/aquaristik/images/skalare00.jpg" alt="post img" class="pull-left img-responsive postImg img-thumbnail margin10 edit_img">
                     <article><p>
                         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                         ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only 
                         five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release
                         of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of
                         Lorem Ipsum.
                         </p>
                          
                     </article>
                
                 </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalLongtype" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle" style="visibility:hidden;">One Title</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12 blogShort">
        <center>
        	 <h2 class="modal-title" id="exampleModalLongTitle">To Title</h2>
        </center>
        <center>
        	 <h4 class="modal-title" id="exampleModalLongTitle"> Lorem Ipsum is simply dummy text</h4>
        </center>
        <br>
                     <img src="http://joern-duwe.de/aquaristik/images/skalare00.jpg" alt="post img" class="pull-left img-responsive postImg img-thumbnail margin10 edit_img">
                     <article><p>
                         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                         ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only 
                         five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release
                         of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of
                         Lorem Ipsum.
                         </p>
                          
                     </article>
                
                 </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalLongthird" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <h3 class="modal-title" id="exampleModalLongTitle" style="visibility:hidden;">One Title</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12 blogShort">
        <center>
        	 <h2 class="modal-title" id="exampleModalLongTitle">Three Title</h2>
        </center>
        <center>
        	 <h4 class="modal-title" id="exampleModalLongTitle"> Lorem Ipsum is simply dummy text</h4>
        </center>
        <br>
                     <img src="http://joern-duwe.de/aquaristik/images/skalare00.jpg" alt="post img" class="pull-left img-responsive postImg img-thumbnail margin10 edit_img">
                     <article><p>
                         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                         ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only 
                         five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release
                         of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of
                         Lorem Ipsum.
                         </p>
                          
                     </article>
                
                 </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?php require_once('footer.php')?>