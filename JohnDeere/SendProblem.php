<?php
	if(isset($_POST['send']))
  {
      require "util.php";
      sendproblem();         
  }
?>
<?php include("header.php"); ?> 

	<div class="row">
      	<div class="col-xs-12 col-smx-6 col-sm-offset-1 col-md-10 col-sm-offset-1 " style="background-color:#eee;padding:20px" >
	    
      		<form action="SendProblem.php" method="POST">
      			<div class="page-header">
      					<h1 class="text-center" style="color:blue"> Send Problem </h1>
      			</div>
      			<div class="form-group">
      					<textarea class="form-control" name="problem" rows="5" placeholder="question"></textarea>
                 </div>	
      			<div class="text-center">
      					<input type="submit" id="button" name="send" class="btn btn-success btn-lg" value="Post Question">
      			</div>
      		</form>
	    </div>
	 </div>	
<?php include("footer.php"); ?>