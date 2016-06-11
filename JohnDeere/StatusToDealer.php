<?php include("header.php"); ?> 
<?php include("application.php"); ?> 
<?php

    if(session_id() == ''){
           session_start();
    }
      
    ?>
    <?php if(session_id() == ''){
           session_start();
        }
    if(!isset($_SESSION['uname'])){
        header("Location: Login.php");
    }
    require "DBConnect.php";
    require "util.php";
    $user=$_SESSION['uname'];
    $query = "select cusername,tractorID,TractorName,engine_temp,engine_temp_updated from customer,tractor where tid=tractorID and cAddedBy='$user'";
  
    $result = $conn->query($query);
 
    ?> 
    <div class="row">
        <div class="col-xs-12 col-smx-6 col-sm-offset-1 col-md-10 col-sm-offset-1 " style="background-color:#fff;padding:20px" >
            
                  <?php 
                  if($result->num_rows > 0)
                  {
                  ?>        
                  <table class="table" style="font-size:20px;color:black">
                        <tr>
                              <th>Customer</th>
                              <th>Tractor Name</th>
                              <th>Status</th>
                              <th>Status At</th>
                            
                        </tr>

                     <?php while($row = $result->fetch_assoc()) { 
                          $tid=$row['tractorID'];
                          $custuser=$row['cusername'];
                          $temp=$row['engine_temp'];
                      ?>
                        
                          <tr style=<?php if($temp>=100){ echo "background-color:#d9534f";}else{echo "background-color:#5cb85c";}?>>
                              <td><a style="color:black" href=<?php echo "CustomerProfile.php?uname=$custuser";?>><?php echo $custuser; ?></a></td>
                              <td><a style="color:black" href=<?php echo "TractorInfo.php?tid=$tid";?> ><?php echo $row['TractorName']; ?></a></td>
                              <td><?php echo getEngineStatus($temp); ?></td>
                              <td><?php echo $row['engine_temp_updated']; ?></td>
                              
                          </tr>      
                       
                        <?php } 
                        }
                      ?>
                  </table>          
        </div>

     </div> 
<?php include("footer.php"); ?>
    