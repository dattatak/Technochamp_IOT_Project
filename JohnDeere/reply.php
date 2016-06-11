
<?php include("header.php"); ?> 

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

	<div class="row">
      	<div class="col-xs-12 col-smx-6 col-sm-offset-1 col-md-10 col-sm-offset-1 " style="background-color:#eee;padding:20px" >
	    
      		<form action="Reply.php" method="POST">
      			
                        <div class="page-header">
                              <h2 class="text-center" style="color:brown"><?php echo $row['problem']; ?></h2>
                        </div>
      			<div class="form-group">
      					<textarea class="form-control" name="reply" rows="5" placeholder="Reply"></textarea>
                        </div>
                        <input type="hidden" value=<?php echo $row['pid']; ?> name="pid" />	
      			<div class="text-center">
      					<input type="submit" id="button" name="answer" class="btn btn-success btn-lg" value="Give Answer">
      			</div>
      		</form>
	    </div>
	 </div>
      <?php 
                  } 
            }
      ?>
       </div>     	

<?php       
      if(isset($_POST['answer'])){

            require "util.php";
            saveReply();
      }
      
?>

<?php include("footer.php"); ?>
