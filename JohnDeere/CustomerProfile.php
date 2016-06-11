
<?php include("header.php"); ?> 
<?php include("application.php"); ?> 
<?php
      require "DBConnect.php";
      if(session_id() == ''){
                  session_start();
      }
   
        $cusername = $_GET['uname'];
        $sql = "select cusername,cname,mobile,TractorName,cemail,PricePaid,cAddedBy,cAddedOn,tid from customer,tractor where tid=tractorID and cusername = '$cusername'";
        if( $result = $conn->query($sql)){
        if($result->num_rows > 0){
          $row = $result->fetch_assoc();

          $tid= $row['tid'];
 ?> 
    <div class="row">
          <div class="col-xs-12 col-smx-6 col-sm-offset-3 col-md-6 col-sm-offset-3 " style="background-color:#eee;padding:20px" >
            <div class="panel panel-default text-center">
              <div class="panel-heading"> 
                <div class="page-header">
                  <h1 class="text-center" style="color:blue">Profile of <?php echo $row['cusername']; ?> </h1>
                </div>
              </div>
              <div class="panel-body">    
              <h4 class="text-left blue" style="font-size:25px"><label>Name : <?php echo $row['cname'];?></label> </h4> 
              <h4 class="text-left"><label>Mobile : <?php echo $row['mobile'];?></label> </h4> 
              <h4 class="text-left"><label>Email : <?php echo $row['cemail'];?></label> </h4> 
              <h4 class="text-left"><label ><a style="color:green" href=<?php echo "TractorInfo.php?tid=$tid";?> >Tractor : <?php echo $row['TractorName'];?></a></label></h4> 
              <h4 class="text-left"><label>Price Paid : <?php echo $row['PricePaid'];?></label> </h4> 
              <h4 class="text-left"><label>Added By Dealer: <?php echo $row['cAddedBy'];?></label> </h4> 
              <h4 class="text-left"><label>Added On : <?php echo $row['cAddedOn'];?></label> </h4> 
               </div>
              </div>
            </div>
          </div>  
 
 <?php  }
    }
?>
<?php include("footer.php"); ?>
