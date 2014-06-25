
<?php
/*
	Student ID : 1784757
	Name: Rashmi Patil
	Functonality : This page fetches the items from the xml file and formats them into an HTML table and send the response to bidding.js page to be displayed in bidding.php
*/ 
header('Content-Type:text/xml');
?>

<?php
//Set the file path
$xmlFile = "../../data/auction.xml";
//Check if the file exists
if(file_exists($xmlFile))
{
	//call function to load the valid items
	fnLoadValidItems($xmlFile);

	//$doc = DOMDocument::load($xmlFile);
	//ECHO $doc->saveXML();
}
else
{
	ECHO "No items are listed for auction";
}

function fnLoadValidItems($xmlFile)
{
	//Create table template
	$HTML = "<TABLE border=\"1\"><th>Item Number</th><th>Item Name</th><th>Category</th><th>Description</th><th>Buy It Now</th><th>Current Bid</th><th>Time left</th><th>Bid Now</th><th>Buy</th>";
	$doc = DOMDocument::load($xmlFile);
 	$items = $doc->getElementsByTagName("item");
	foreach($items as $item)
	{
		$HTML = $HTML . "<TR><TD>";
		$ItemNumber = $item->getElementsByTagName("Number");
		$ItemNumber = $ItemNumber->item(0)->nodeValue;
		
		$ItemName = $item->getElementsByTagName("Name");
		$ItemName = $ItemName->item(0)->nodeValue;

		$Category = $item->getElementsByTagName("Category");
		$Category = $Category->item(0)->nodeValue;

		$Description = $item->getElementsByTagName("Description");
		$Description = $Description->item(0)->nodeValue;
		
		//Change description if length is more than 30 characters
		if(strlen($Description) > 30)
		{
			$Description = substr($Description,0,29); 
			$Description = $Description ."...";
		}

		$BuyItNowPrice = $item->getElementsByTagName("BuyItNowPrice");
		$BuyItNowPrice = $BuyItNowPrice->item(0)->nodeValue;

		$CurrentBidPrice = $item->getElementsByTagName("CurrentBidPrice");
		$CurrentBidPrice = $CurrentBidPrice->item(0)->nodeValue;
		
		$Duration = $item->getElementsByTagName("Duration");
		$Duration = $Duration->item(0)->nodeValue;
		
		$StartDate = $item->getElementsByTagName("StartDate");
		$StartDate = $StartDate->item(0)->nodeValue;

		$StartTime = $item->getElementsByTagName("StartTime");
		$StartTime = $StartTime->item(0)->nodeValue;
		
		$Status = $item->getElementsByTagName("Status");
		$Status = $Status->item(0)->nodeValue;
		
		//Call function to get the time left
		$TimeLeft = fnCalculateTimeLeft($Duration,$StartDate,$StartTime);

		//if time left is less than zero or if the item is sold do not add buttons
		if($TimeLeft == -1 || $Status == "sold")
		{
			if($TimeLeft == -1 && $Status != "sold")
				$Status = "Expired";
			$HTML = $HTML . $ItemNumber . "</td><td>" . $ItemName ."</td><td>" . $Category ."</td><td>" . $Description ."</td><td>" . $BuyItNowPrice .
				"</td><td>" . $CurrentBidPrice ."</td><td>0</td><td>&nbsp</td><td>$Status</td></tr>";
		}
		else
		{
			//Adding buttons and event handlers for those buttons which would be displayed in bidding.php page
			$HTML = $HTML . $ItemNumber . "</td><td>" . $ItemName ."</td><td>" . $Category ."</td><td>" . $Description ."</td><td>" . $BuyItNowPrice .
				"</td><td>" . $CurrentBidPrice ."</td><td>" . $TimeLeft  ."</td>
				<td><input type=\"submit\" value=\"Place Bid\" id=\".$ItemNumber.\" onclick=\"return fnPlaceBid(".$ItemNumber.",".$CurrentBidPrice.")\"></td>
				<td><input type=\"submit\" value=\"Buy Now\" id=\".$ItemNumber.\" onclick=\"fnBuyNow(".$ItemNumber.")\"></td></tr>";
		}	

	}	
	
	$HTML = $HTML . "</table>";
	//returning the HTML table created to front end
	echo $HTML;
}

//Function to calculate the time left based on duration provided while listing, startdate and start time of bidding
//Returns -1 if expired else duration in Days:Hours:Minutes format
function fnCalculateTimeLeft($Duration,$StartDate,$StartTime)
{
		//Concatenate the date and time provided
		$dt = $StartDate." ".$StartTime;
		
		//Create a date format using
		$Date = new DateTime($dt); 
		
		//Convert duration into Min
		$arrConverter = explode(":",$Duration);
		$DurationMin = $arrConverter[0]*24*60;
		$DurationMin = $DurationMin + ($arrConverter[1]*60) + ($arrConverter[2]);
		
		//Add duration to the startdatetime of bidding
		$EndDate = $Date->add(new DateInterval('PT' . $DurationMin . 'M'));		
		
		//Get current datetime
		$now = new DateTime();

		//subtract current time from end date calculated above
		$interval = $EndDate->diff($now);
		

		//if end date is greater than current time return in desired format else return -1 
		if(strtotime(date_format($EndDate,'Y-m-j H:i')) > time())
			return $interval->format('%d Day : %H Hours: %i Min');
		else
			return -1;
}

?>