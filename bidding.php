<?php 
 	// this starts the session 
	session_start();
	//If session isnt present show appropriate message and redirect to login page
	if(isset($_SESSION['CustomerfName'])!= TRUE)
	{
		ECHO "<script type=\"text/javascript\">alert(\"Please login again\");window.location = \"login.html\";</script>";
	}
?>
<HTML XMLns="http://www.w3.org/1999/xHTML"> 
<!--
	Student ID : 1784757
	Name: Rashmi Patil
	Functonality : This page is provided to customers to Bid for the listed items

--> 
  <head> 
	<meta http-equiv="refresh" content="10" >
    <title>Bidding Page</title> 
		<link rel="stylesheet" type="text/css" href="Shoponline_Style.css">
		<script type="text/javascript" src="bidding.js" ></script>
		<script type="text/javascript" src="signout.js" ></script>
  </head> 
  <body onload="getItems()">
<div id="container" style="width:100%">
<div id="space" style="width:10%;float:left;"></div>
  <div id="header" style="width:90%;float:right;"><H1>ShopOnline</H1></div>
</div>
	  <ul>
		<li><a href="listing.php">Listing</a></li>
		<li><a href="bidding.php">Bidding</a></li>
		<li><a href="Maintenance.html">Maintenance</a></li>
		<li align="right"><input type="submit" value="Signout" name="Signout" onclick="fnSignout()";/></li>
	</ul>
  <form>
	<div id="container2" style="width:100%">
	<div id="space2" style="width:10%;float:left;"></div>
  	<div id="fieldset" style="width:90%;float:right;">
		<label> Current Auctions </label>
		<p>Hello <?php ECHO $_SESSION['CustomerfName']?>, Current auctions are listed below. To place a bid for an item, use the place bid button </p>
		<span id="result"></span>
		</div>
</div>
</form>
</body> 
</HTML>



