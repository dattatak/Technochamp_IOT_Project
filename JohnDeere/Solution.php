<?php
	if(isset($_GET['pid'])){
		if(session_id() == ''){
           session_start();
        }
		$pid=$_GET['pid'];
		require "DBConnect.php";
		
		$result = $conn->query("SELECT * FROM problem where pid=$pid");
	    if($result->num_rows > 0)
	     {
	     	$row = $result->fetch_assoc();
?>
<?php include("header.php"); ?> 
<?php include("application.php"); ?> 

	<div class="row">
      	<div class="col-xs-12 col-smx-6 col-sm-offset-1 col-md-10 col-sm-offset-1 " style="background-color:#eee;padding:20px" >
	    	<form action="reply.php">
      			<div class="text-center">
      					<input type="hidden" value=<?php echo $_GET['pid']; ?> name="pid" />
      					<input type="submit" id="button" name="reply" class="btn btn-success btn-lg" value="Reply">
      			</div>
      		</form>
      		<ul class="subjects" style="list-style-type:none;align:center">
		    	<li><label style="width:100%;margin-left:20px;">
		    		<div >
		    			Problem : <?php echo $row['problem']; ?>
		    		</div>

		    	</label>
		    		<h4 align="right">Asked By : <b><?php echo $row['askedby']; ?> </b>
		    			Asked On : <?php echo $row['asked']; ?></br></h4>
		    		<ul>
		   			<?php 
		    			$result1 = $conn->query("SELECT * FROM solution where pid=$pid");
						if($result1->num_rows > 0)
						{
						    while($row1 = $result1->fetch_assoc()){

		    			?>
		    			<li><div class="ans">
		   					Replier : <?php echo $row1['solvedby']; ?><br>
		   					Date and Time : <?php echo $row1['solved_at']; ?><br>
		    				Reply : <p style="color:blue"><?php echo $row1['solution']; ?></p>
		    			</div></li>
		    			<?php }  
		    				}
		    			?>
		    		</ul>
		    	</li>

	    	</ul>
	    </div>
	    <?php } 
			}
	    ?>
	 </div>	
<?php include("footer.php"); ?>