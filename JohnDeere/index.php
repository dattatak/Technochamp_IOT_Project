<?php include("header.php"); ?> 
<?php include("application.php"); ?>
	<?php if(!empty($_GET['message']))
	{
		$message=$_GET['message'];
		echo "<h1 align='center'>$message</h1>";
	} ?> 
	<div class="container">
	  <br>
	  <div id="myCarousel" class="carousel slide myslide" data-ride="carousel">
	    <!-- Indicators -->
	    <ol class="carousel-indicators">
	      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	      <li data-target="#myCarousel" data-slide-to="1"></li>
	     <li data-target="#myCarousel" data-slide-to="2"></li>
		 <li data-target="#myCarousel" data-slide-to="3"></li>
		 <li data-target="#myCarousel" data-slide-to="4"></li>
		 <li data-target="#myCarousel" data-slide-to="5"></li>
		 <li data-target="#myCarousel" data-slide-to="6"></li>
	    </ol>

	    <div class="row">

      	<div class="col-xs-12 col-smx-6 col-sm-offset-1 col-md-10 col-sm-offset-1 " style="background-color:#eee;margin-bottom:70px" >
	    <!-- Wrapper for slides -->
	    <div class="carousel-inner" role="listbox">
	    	<div class="item active">
	        <img src="images/1.jpg" alt="WCE">
	      </div>
	      <div class="item ">
	        <img src="images/2.jpg" alt="CSE">
	      </div>

	      <div class="item">
	        <img src="images/3.jpg" alt="ELN">
	      </div>

	      <div class="item">
	        <img src="images/4.jpg" alt="Mech">
	      </div>

	      <div class="item">
	        <img src="images/5.jpg" alt="Civil">
	      </div>
	      <div class="item">
	        <img src="images/6.jpg" alt="Civil">
	      </div>
	   	</div>

	    <!-- Left and right controls -->
	    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
	      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	      <span class="sr-only">Previous</span>
	    </a>
	    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
	      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	      <span class="sr-only">Next</span>
	    </a>
	  </div>
	</div>
	</div>
	</div>
	
	<?php include("footer.php"); ?> 