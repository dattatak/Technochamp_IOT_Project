<?php include("header.php"); ?> 
<?php include("application.php"); ?> 
<script>
setTimeout(function(){
   window.location.reload(1);
}, 6000);
</script>		
  <div class="row">
      		
        <div class="col-xs-12 col-smx-6 col-sm-offset-3 col-md-6 col-sm-offset-3 " style="background-color:#eee;padding:20px" >

        <?php
            require "DBConnect.php";
            require "util.php";
            $tid = $_GET['tid'];            
            $sql="select * from tractor where tractorID=$tid";

            if( $result = $conn->query($sql)){
                if($result->num_rows > 0){
                  $row = $result->fetch_assoc();
        ?> 
           <div class="panel panel-default text-center">
              <div class="panel-heading"> 
      				<div class="page-header">

      					<h1 class="text-center" style="color:blue"><?php echo $row['TractorName']; ?></h1>
      				</div>
      				</div>
              <div class="panel-body">	
                <h4 class="text-left"><label><span class="blue">Added By : </span><?php echo $row['AddedBy'];?></label> </h4> 
                <h4 class="text-left"><label><span class="blue">Added At : </span><?php echo $row['AddedOn'];?></label> </h4> 
                <h4 class="text-left"><label><span class="blue">Price : </span><?php echo $row['price'];?></label> </h4>
                <span class="fa-stack fa-5x">
                  <?php
                     $image=$row['image'];
                     $id = $row['tractorID']; 
                    $msg = '<a href="search.php?id='.$id.'"><img src="data:image/jpeg;base64,'.base64_encode($row['image']). ' " />   </a>';
                    echo $msg;
                  ?>
                </span>


                <div class="box">
                   <h4 class="text-left"><label><span class="blue">Engine Status : </span><?php echo getEngineStatus($row['engine_temp']);?></label> </h4> 
                   <h4 class="text-left"><label><span class="blue">Engine Temperatue : </span><?php echo $row['engine_temp']." degree";?></label> </h4> 

                 </div>

                 <?php $danger = $row['isdanger'];
                  if($danger == 'yes'){
                 ?>
                 <div class="box">
                      <h3 class="text-left" style="color:red"><label><span style="font-weight:bold">Warning : </span>Tractor is in DANGER. MAY FALL OR GET DAMAGED</label> </h3> 

                      <img src="images/tractorflip.jpg" />
                  </div> 
                 <?php }?>
                <h4 class="text-left"><p><label><span class="blue">Description : </span><?php echo $row['description'];?></label></p> </h4>          


              <?php } }?> 
              </div>
              </div> 
      	 		</div>
	 		</div>	
	
<?php include("footer.php"); ?>



