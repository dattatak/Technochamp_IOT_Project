
<?php include("header.php"); ?> 

<?php
	  	
      if(isset($_POST['submit']))
      {
            require "util.php";
            Login();
      }
?>    
	<form name="myform" action="login.php" method="POST" onsubmit="return validateform()">
		<div class="row">
      		<div class="col-xs-12 col-smx-6 col-sm-offset-4 col-md-4 col-sm-offset-4 " style="background-color:#eee;padding:20px" >
      				<div class="page-header">
      					<h1 class="text-center" style="color:blue"> Login Form </h1>
      				</div>
      				  <div class="form-group">
      					
      					<input class="form-control" type="text" placeholder="User Name" name="username">
                    </div>
      				<div class="form-group">
      					
      					<input class="form-control" type="password" placeholder="Password" name="password">
      				</div>
              <div class="checkbox">
                  <label><input type="checkbox" value='Customer' name="isCustomer" id='checkbox'>Login As Customer</label>
              </div>
                              
  					<div class="text-center">
      					<input type="submit" id="button" name="submit" class="btn btn-success btn-lg" value="Login">
      				</div>

      	 		</div>
	 		</div>	
	 	</form>
<?php include("footer.php"); ?>
