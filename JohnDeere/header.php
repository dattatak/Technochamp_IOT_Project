  
<?php include("application.php"); ?> 
    <div class="page-header text-center head">
            <font color="midnightblue">
            <h1 class="hh1"><b>John Deere Tractor Forum</b></h1>
                </font>
    </div>
   
    <nav class="navbar navbar-default navbar-fnt navbar-background" style="margin:10px;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#head">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                   
                
                </button>
                 <a class="navbar-brand" href="index.php">
                        John Deere Tractor Forum
                 </a>
            </div>
                
       
                <ul class="nav navbar-nav nav navbar-right" style="margin-right:10px;">
                    <li>
                        <a href="index.php">
                        <span class="glyphicon glyphicon-home"></span>Home</a>
                    </li>
                    <?php 
                        if(session_id() == ''){
                            session_start();
                        }
                    if(!isset($_SESSION['uname']) ){ ?>
                       
                    <li>
                        <a href="Login.php">Login</a>
                    </li>
                    <li>
                        <a href="register.php">Signup</a>
                    </li>
                    <?php 
                        }
                        else { ?>
                        <li><a href="#"><b>Hello <?php echo $_SESSION['uname']; ?></b></a></li>
                        <li>
                            <a href="logout.php">Logout</a>
                        </li>
                     <?php }
                     ?>
                    
                    <li>
                        <a href="Contactus.html">Contact Us</a>
                    </li>
                </ul>
            </div>
    </nav>
    <?php if(session_id() == ''){
           session_start();
        }
    if(isset($_SESSION['uname'])&&$_SESSION['role']=="dealer"){?> 
    <div class="container">
     <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#"><?php echo $_SESSION['uname']; ?></a>
        </div>
        <ul class="nav navbar-nav">
          
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Customer
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="AddCustomer.php">Register</a></li>
              
              <li><a href="ViewCustomers.php">View</a></li>
            </ul>
          </li>
          <li><a href="problems.php">Problems</a></li>
         
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Tractors
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="AddTractor.php">Add New Tractor</a></li>
              <li><a href="tractors.php">View Tractors</a></li>
            </ul>
          </li>
          <li><a href="StatusToDealer.php">Status</a></li>
        </ul>
      </div>
    </nav>
    </div>
    <?php } else if(isset($_SESSION['uname'])){ ?>
     <div class="container">
     <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#"><?php echo $_SESSION['uname']; ?></a>
        </div>
        <ul class="nav navbar-nav">
          
           <li><a href=<?php $un=$_SESSION['uname']; echo "CustomerProfile.php?uname=$un";?>>Profile</a></li>
            <li><a href="problems.php">Sent Problems</a></li>
            <li><a href=<?php $tid=$_SESSION['tid']; echo "TractorInfo.php?tid=$tid";?>>Tractor Info</a></li>
        </ul>
      </div>
    </nav>
    </div> 
           
    <?php
    }?>
    
