<?php 
 // this starts the session 
 session_start(); 
?>
<?php
	if(!(isset($_GET['submit'])))
	{
		$ItemNumber =$_GET['itemNumber'];
		$CurrentBid =$_GET['currentBid'];
	}
	else
	{
		$ItemNumber = $_GET['itemNo'];
		$CurrentBid = $_GET['currBid'];
	}
		
?>
<HTML XMLns="http://www.w3.org/1999/xHTML"> 
<!--
	Student ID : 1784757
	Name: Rashmi Patil
	Functonality : This page is provided to customers(sellers) to enter the new bid of the item to be sold.
			 This page will take new bid and information provided will be saved in the database if valid.
--> 
  <head> 
    <title>Bidding Page</title> 
  </head>		
<script type="text/javascript" src="placeBid.js" ></script> 
<body>
<div id="container" style="width:100%">
<div id="header" style="width:90%;float:right;"><H1>ShopOnline</H1></div>
</div>
	<form>
	<div id="container2" style="width:100%">
	<div id="space2" style="width:10%;float:left;"></div>
  	<div id="fieldset" style="width:90%;float:right;">
		<label> Bid item</label>
		<fieldset style="width:60%">
 		 <legend>Bidding Details</legend>		
		<p><span style="color:red">*</span> Required fields.</p> 
		<table> 
		<tr><td align="right">Item Number:</td><td><input type="text" value=<?=$ItemNumber ?> name="INfield" disabled></td></tr>
		<tr><td align="right">Current Bid:</td><td><input type="text" value=<?=$CurrentBid?> name="CBfield" disabled></td></tr>
		<tr><td align="right">Place Bid:</td><td><input type="text" name="PBDollarfield" size=5 ID="txtPBDollar">.<input type="text" name="PBCentfield" size=2 ID="txtPBCent" value="00"></td></tr>
		<tr><td>
		</td><td><input type="submit" value="Place Bid" name="submit" onclick="return fnValidateBid()"/><input type="submit" value="Reset" onclick="fnReset()"/></td></tr>
		</table>
		<span id="displayError" style="color:red"></span>
		<span id="confirmation" style="color:black"></span>
		</fieldset>  
		<input type="hidden" name="itemNo" id="INid" value=" <?php echo trim($_GET['itemNumber']); ?> "/>
		<input type="hidden" name="currBid" id="CBPid" value=" <?php echo trim($_GET['currentBid']); ?> "/>

</div>
</div>
</form>
</body>
<?php
	if(isset($_GET['submit']))
	{
		$INumber = $_GET['itemNo'];
		$INumber = trim($INumber);
		$Bid = $_GET['PBDollarfield'].".".$_GET['PBCentfield'];
		$Bid = trim($Bid);
		$xmlFile = "../../data/auction.xml";
		$doc = DOMDocument::load($xmlFile);
	 	$items = $doc->getElementsByTagName("item");
		
		$vBidder = $_SESSION["CustomerfName"];		
		
		foreach($items as $item)
		{
			$ItemNumber = $item->getElementsByTagName("Number");
			$ItemNumber = $ItemNumber->item(0)->nodeValue;
			if ($INumber == $ItemNumber)
			{
				$CurrentBidPrice = $item->getElementsByTagName("CurrentBidPrice");
				$CurrentBidPrice->item(0)->nodeValue = $Bid;
		
				$Bidder = $item->getElementsByTagName("Bidder");
				$Bidder->item(0)->nodeValue = $vBidder;				

				$doc->saveXML();
				$doc->save($xmlFile);
				echo "<script type=\"text/javascript\">alert(\"Bid is successful\");window.opener.location.reload(true); window.close();</script>";
			}
		}

		

	}
?>
</HTML>