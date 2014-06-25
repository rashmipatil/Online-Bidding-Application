<?php
/*
	Student ID : 1784757
	Name: Rashmi Patil
	Functonality : This page Updates the status of the item when buy now button in the bidding page is clicked.

*/
	session_start();
	$vCustId = $_SESSION["CustomerID"];
	$itemNumber = $_POST['itemNumber'];
	$xmlFile = "../../data/auction.xml";
		$doc = DOMDocument::load($xmlFile);
	 	$items = $doc->getElementsByTagName("item");
		
		foreach($items as $item)
		{
			$ItemNumber = $item->getElementsByTagName("Number");
			$ItemNumber = $ItemNumber->item(0)->nodeValue;
			if ($itemNumber == $ItemNumber)
			{
				$BINPrice = $item->getElementsByTagName("BuyItNowPrice");
				$BINPrice = $BINPrice->item(0)->nodeValue;

				$CurrentBidPrice = $item->getElementsByTagName("CurrentBidPrice");
				$CurrentBidPrice->item(0)->nodeValue = $BINPrice;
				
				$Status = $item->getElementsByTagName("Status");
				$Status->item(0)->nodeValue = "sold";	
				
				$Bidder = $item->getElementsByTagName("Bidder");
				$Bidder->item(0)->nodeValue = $vCustId;				
								
				$doc->saveXML();
				$doc->save($xmlFile);
				echo "Thank you for purchasing this item";
			}
		}
?>