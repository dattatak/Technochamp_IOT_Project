<?php include("header.php"); ?> 
<?php include("application.php"); ?> 
<?php     
      
    if(isset($_POST['submit']))
    {
        include "util.php";
        AddCustomer();
    }
?>    
	<form name="myform" action="AddCustomer.php" method="POST" >
		<div class="row">
      		<div class="col-xs-12 col-smx-6 col-sm-offset-3 col-md-6 col-sm-offset-3 " style="background-color:#eee;padding:20px" >
      				<div class="page-header">
      					<h1 class="text-center" style="color:blue"> Register Customer</h1>
      				</div>

               <div class="form-group">
                
                <input class="form-control" type="text" placeholder="Customer Name" name="name">
              </div> 
      				
      				<div class="form-group">
      					
      					<input class="form-control" type="text" placeholder="Mobile number" name="mobile">
      				</div>
      				<div class="form-group">
      					
      					<input class="form-control" type="email" placeholder="Email ID" name="email">
      				</div>
      				
              <div class="form-group">
                <input class="form-control" type="text" placeholder="Purchased Tractor Name" name="TractorName">
              </div>
              <div class="form-group">
                
                <input class="form-control" type="text" placeholder="Price paid" name="Price">
              </div>
              
              <div class="form-group">
      					
      					<input class="form-control " type="text" placeholder="User Name" name="username">
                    </div>
      				<div class="form-group">
      					
      					<input class="form-control " type="password" placeholder="Password" name="password">
      			   </div>
      				<div class="text-center">
      					<input type="submit" id="button" name="submit" class="btn btn-success btn-lg" value="Sign Up">
      				</div>

      	 		</div>
	 		</div>	
	 	</form>
<?php include("footer.php"); ?>

