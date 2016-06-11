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
    $query = "select cusername,cname,tid,TractorName from customer,tractor where tid=tractorID and AddedBy='$user'";
  
    $result = $conn->query($query);
 
    ?> 
    <div class="row">
        <div class="col-xs-12 col-smx-6 col-sm-offset-1 col-md-10 col-sm-offset-1 " style="background-color:#fff;padding:20px" >
            
                  <?php 
                  if($result->num_rows > 0)
                  {
                  ?>        
                  <table class="table" style="font-size:20px">
                        <tr>
                              <th>Customer Username</th>
                              <th>Customer Name</th>
                              <th>Tractor</th>
                              <th></th>
                            
                        </tr>

                     <?php while($row = $result->fetch_assoc()) { 
                        $tid= $row['tid'];
                        $custuser = $row['cusername'];
                      ?>

                          <tr >
                              <td><?php echo $row['cusername']; ?></td>
                              <td><a style="color:blue" href=<?php echo "CustomerProfile.php?uname=$custuser";?>><?php echo $row['cname']; ?></a></td>
                              <td><a style="color:blue" href=<?php echo "TractorInfo.php?tid=$tid";?> ><?php echo $row['TractorName']; ?></a></td>
                              
                          </tr>      
                          
                        <?php } 
                        }
                      ?>
                  </table>          
        </div>

     </div> 
<?php include("footer.php"); ?>
    