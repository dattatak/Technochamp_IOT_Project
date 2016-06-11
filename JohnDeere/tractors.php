<?php include("header.php"); ?>
<?php include("application.php"); ?>
<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Tractors Added</h2>
            </div>

<?php
    require "DBConnect.php";
                
    $sql="select * from tractor";
    if( $result = $conn->query($sql)){
        if($result->num_rows > 0){
?> 
            <?php
            while($row = $result->fetch_assoc()){
            ?>
	
            <div class="col-md-3 col-sm-6">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <span class="fa-stack fa-5x">
                          <?php
                             $id=$row['tractorID'];
                             $name=$row['image_file_name'];
                             $image=$row['image'];

                             $msg = '<a href="search.php?id='.$id.'"><img src="data:image/jpeg;base64,'.base64_encode($row['image']). ' " />   </a>';
                             echo $msg;
                          ?>
                        </span>
                    </div>
                    <div class="panel-body">
                        <h4><?php echo $row["tractorID"]." ".$row["TractorName"];?></h4>
                        <p><?php echo $row["description"];?></p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            <?php 
                    }
                }
            }
            ?>
        </div>
	</div>	
<?php include("footer.php"); ?> 