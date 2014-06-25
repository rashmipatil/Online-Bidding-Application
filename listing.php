<?php 
 // this starts the session 
	session_start(); 
	if(isset($_SESSION['CustomerfName'])!= TRUE)
	{
		ECHO "<script type=\"text/javascript\">alert(\"Please login again\");window.location = \"login.html\";</script>";
	}

?>
<HTML XMLns="http://www.w3.org/1999/xHTML"> 
<!--
	Student ID : 1784757
	Name: Rashmi Patil
	Functonality : This page is provided to customers(sellers) to enter the details of the item to be sold.
			 This page will take the item details like Item name, category, Description, bidding start price,
			 reserve price, buy it now price and duration. The information provided will be saved in the database if valid.
--> 
  <head> 
    <title>Listing Page</title> 
		<link rel="stylesheet" type="text/css" href="Shoponline_Style.css">
		<script type="text/javascript" src="listing.js" ></script>
		<script type="text/javascript" src="loadListing.js" ></script>
		<script type="text/javascript" src="signout.js" ></script>
  </head> 
  <body onload="fnLoadListing()">
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
		<label> Registration </label>
		<p>To create listing, enter listing details below </p>
		<fieldset style="width:60%">
 		 <legend>Registration Details</legend>		
		<p><span style="color:red">*</span> Required fields.</p> 
		<table> 
		<tr><td align="right">Item Name: <span style="color:red"> * </span></td><td><input type="text" name="namefield" size=30 ID="txtIname"></td></tr>
		<tr><td align="right">Category: <span style="color:red"> * </span></td><td><select id="drpCategory" onchange="checkField(this.value)"></select> <span id="txtbox" style="display:none;"><input type="text" name="categoryfield" size=30 ID="txtCategory"></span></td></tr>
		<tr><td align="right">Description: <span style="color:red"> * </span></td><td><input type="text" name="descfield" size=80 ID="txtdesc" multiline=true></td></tr>
		<tr><td align="right">Start Price: <span style="color:red"> * </span></td><td><input type="text" name="SPDollarfield" size=5 ID="txtSPDollar" value="0">.<input type="text" name="SPCentfield" size=2 ID="txtSPCent" value="00"></td></tr>
		<tr><td align="right">Reserve Price: <span style="color:red"> * </span></td><td><input type="text" name="RPDollarfield" size=5 ID="txtRPDollar">.<input type="text" name="RPCentfield" size=2 ID="txtRPCent"></td></tr>
		<tr><td align="right">Buy It Now Price: <span style="color:red"> * </span></td><td><input type="text" name="BINPDollarfield" size=5 ID="txtBINPDollar">.<input type="text" name="BINPCentfield" size=2 ID="txtBINPCent"></td></tr>
		<tr><td align="right">Duration: <span style="color:red"> * </span></td><td><select id="drpDays"></select>Days:<select id="drpHours"></select>Hours:<select id="drpMinutes"></select>Minutes</td></tr>
		<tr><td>
		</td><td><input type="submit" value="Listing" onclick="return ValidateInputDetails();"/><input type="submit" value="Reset" onclick="fnReset()"/></td></tr>
		</table>
		<span id="displayError" style="color:red"></span>
		<span id="confirmation" style="color:black"></span>
		</fieldset>  
</div>
</div>
</form>
<?php 
?>

</body>
</HTML>