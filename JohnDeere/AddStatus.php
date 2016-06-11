<?php
	if(isset($_GET['temp']))
	{
		$temp = $_GET['temp'];
		$tid = $_GET['tid'];
		$danger = $_GET['danger'];
		require "util.php";
		addToDB($tid,$temp,$danger);
	}		
?>