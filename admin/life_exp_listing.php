<?php 
require_once('header.php');
if(isset($_GET['remove'])){
	dbRowDelete('life_exp', 'where le_id='.intval($_GET['remove']));
	$con->close();
	header('Location:'.$path.'admin/life_exp_listing.php');
}
$sql="select * from life_exp order by le_id desc";
$result=$con->query($sql);
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
              <a href="<?php echo $path?>admin/life_exp.php">Add New</a>
            </div>
        
            <div class="col-md-12"></div>
            <div class="col-md-10 mobile_tab">
			
			
			
		
			
			<div class="table-responsive">
            	
                
                <form action="" method="post">
            	<table class="table table-bordered">
                	<tr>
                    	<th>#</th>
                        <th>Category</th>
                        <th>Variant</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
					<?php
					$count=0;
                    if($result->num_rows > 0){
					while($row=$result->fetch_assoc()){
                    $count++;
					$id=$row['le_id'];
					$category=$row['le_category'];
					$variant=encode($row['le_option']);
					$price='$'.number_format(encode($row['le_price']),2);
					?>
                	<tr>
                    	<td><?php echo $count?></td>
                        <td><?php echo $category?> Life Experience</td>
                        <td><?php echo $variant?></td>
                        <td><?php echo $price?></td>
                        <td>
                        	<a href="<?php echo $path?>admin/life_exp_edit.php?edit=<?php echo $id?>">Edit</a> | 
                        	<a href="<?php echo $path?>admin/life_exp_listing.php?remove=<?php echo $id?>">Delete</a>
                        </td>
                    </tr>
                    <?php 
					}
					}
					else{
						echo '<tr><td colspan="5">No Record Found!</td></tr>';	
					}
					?>
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