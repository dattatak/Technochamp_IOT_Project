<?php include("header.php"); ?> 
<?php include("application.php"); ?> 
<?php

    if(session_id() == ''){
           session_start();
    }
    require "DBConnect.php";
    $result = $conn->query("SELECT * FROM problem");
      
    ?>
    <?php if(session_id() == ''){
           session_start();
        }
    if(!isset($_SESSION['uname'])){
        header("Location: Login.php");
    }
    ?> 
    <div class="row">
        <div class="col-xs-12 col-smx-6 col-sm-offset-1 col-md-10 col-sm-offset-1 " style="background-color:#fff;padding:20px" >
            
            <?php if($_SESSION['role']!='dealer'){?>
            <form action="SendProblem.php" method="POST">

                <div class="text-center">
                        <input type="submit" id="button" name="submit" class="btn btn-success btn-lg" value="Send Problem">
                </div>
            </form>
            <?php }?>
                  <?php 
                        if($result->num_rows > 0)
                        {
                  ?>        
                  <table class="table" style="font-size:20px">
                        <tr>
                              <th>Que ID</th>
                              <th>Asked By</th>
                              <th>Asked</th>
                              <th>Question</th>
                              <th>Show Ans</th>
                        </tr>

                     <?php while($row = $result->fetch_assoc()) { ?>
                              <form action="Solution.php">       
                                    <tr>
                                          <td><?php echo $row['pid']; ?></td>
                                          <td><?php echo $row['askedby']; ?></td>
                                          <td><?php echo $row['asked']; ?></td>
                                          <td><?php echo $row['problem']; ?></td>
                                          <td>
                                          <input type="hidden" value=<?php echo $row['pid']; ?> name="pid" />
                                          <input type="submit" id="button" name="more" class="btn btn-success btn-lg" value="Solution"></td>
                                    </tr>      
                              </form>
                        <?php } 
                        }
                        ?>
                  </table>          
        </div>

     </div> 
<?php include("footer.php"); ?>