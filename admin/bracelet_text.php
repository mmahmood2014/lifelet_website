<?php 
require_once('header.php');
if(isset($_POST['top'])){
	$top=escape($_POST['top']);
	$exp_16=escape($_POST['exp_16']);
	$exp_8=escape($_POST['exp_8']);
	$exp_4=escape($_POST['exp_4']);
	$data=array(
		'top'=>$top,
		'exp_16'=>$exp_16,
		'exp_8'=>$exp_8,
		'exp_4'=>$exp_4
	);
	dbRowUpdate('bracelet_text', $data, 'id=1');
	$con->close();
	header('Location:'.$path.'admin/bracelet_text.php');
}
####################################################
$sql="select * from bracelet_text where id=1";
$result=$con->query($sql);
$mfa=$result->fetch_assoc();
$top=encode($mfa['top']);
$exp_16=encode($mfa['exp_16']);
$exp_8=encode($mfa['exp_8']);
$exp_4=encode($mfa['exp_4']);
#####################################################
?>
<div class="kd-content">
  <section class="kd-pagesection">
    <div class="container">
      <div class="row">
        <center>
          <div class="col-md-12">
            <div class="kd-rich-editor">
              <center>
                <h2 class="title_text"> Bracelet(Life Experience)</h2>
                <div class="underline_small"></div>
              </center>
            </div>
            <div class="col-md-12"></div>
            <div class="col-md-10 mobile_tab">
			
			<div class="table-responsive">
            	
                
                <form action="" method="post">
            	<table class="table table-bordered">
                    <tr>
                    	<td>Top</td>
                        <td><textarea class="form-control" id="top" name="top"><?php echo $top?></textarea></td>
                    </tr>
                    <tr>
                    	<td>16 Life Experience</td>
                        <td><textarea class="form-control" id="exp_16" name="exp_16"><?php echo $exp_16?></textarea></td>
                    </tr>
                    <tr>
                    	<td>8 Life Experience</td>
                        <td><textarea class="form-control" id="exp_8" name="exp_8"><?php echo $exp_8?></textarea></td>
                    </tr>
                    <tr>
                    	<td>4 Life Experience</td>
                        <td><textarea class="form-control" id="exp_4" name="exp_4"><?php echo $exp_4?></textarea></td>
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