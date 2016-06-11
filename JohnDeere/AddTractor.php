
<?php include("header.php"); ?> 
<?php include("application.php"); ?> 
<?php
      if(isset($_POST['submit']))
      {
           require "util.php";
          addTractorInfo();
      }
?>    
<form name="myform" action="AddTractor.php" method="POST"  enctype="multipart/form-data">
    <div class="row">
          <div class="col-xs-12 col-smx-6 col-sm-offset-3 col-md-6 col-sm-offset-3 " style="background-color:#eee;padding:20px" >
              <div class="page-header">
                <h1 class="text-center" style="color:blue"> Fill Tractor Details</h1>
              </div>
              <div class="form-group">
                
                <input class="form-control" type="text" placeholder="Tractor Name" name="TractorName">
              </div>
              <div class="form-group">
                
                <input class="form-control" type="text" placeholder="Price" name="Price">
              </div>
              <div class="form-group">
                <textarea class="form-control" name="descr" rows="5" placeholder="Description"></textarea>
              </div>
           
            <input name="image" id="image" accept="image/JPEG" type="file" />
      
            <div class="text-center">
                <input type="submit" id="button" name="submit" class="btn btn-success btn-lg" value="Save">
              </div>

            </div>
      </div>  
    </form>
<?php include("footer.php"); ?>
