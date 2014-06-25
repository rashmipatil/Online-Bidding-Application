<?php
header('Content-Type:text/xml');
?>

<?php
$xmlFile = "../../data/auction.xml";
if(file_exists($xmlFile))
{
	fnLoadValidItems($xmlFile);
}
else
{
	ECHO "No items are listed for auction";
}

function fnLoadValidItems($xmlFile)
{
	$count = 0;
	$doc = DOMDocument::load($xmlFile);
 	$items = $doc->getElementsByTagName("item");
	foreach($items as $item)
	{
		$Status = $item->getElementsByTagName("Status");
		$Status = $Status->item(0)->nodeValue;
		
		if($Status == "in-progress")
		{
			$Duration = $item->getElementsByTagName("Duration");
			$Duration = $Duration->item(0)->nodeValue;
		
			$StartDate = $item->getElementsByTagName("StartDate");
			$StartDate = $StartDate->item(0)->nodeValue;

			$StartTime = $item->getElementsByTagName("StartTime");
			$StartTime = $StartTime->item(0)->nodeValue;	

			$TimeLeft = fnCalculateTimeLeft($Duration,$StartDate,$StartTime);	
			if($TimeLeft == -1)
			{
				$count = $count + 1;				

				$CurrentBidPrice = $item->getElementsByTagName("CurrentBidPrice");
				$CurrentBidPrice = $CurrentBidPrice->item(0)->nodeValue;

				$ReservePrice = $item->getElementsByTagName("ReservePrice");
				$ReservePrice = $ReservePrice->item(0)->nodeValue;	
				if($CurrentBidPrice >= $ReservePrice)
				{
					$Status = $item->getElementsByTagName("Status");
					$Status->item(0)->nodeValue = "sold";
				}
				else
				{
					$Status = $item->getElementsByTagName("Status");
					$Status->item(0)->nodeValue = "failed";
				}
				$doc->saveXML();
			}
		}
	}
	$doc->save($xmlFile);
	if($count > 0)
		echo $count." Auction items processed successfully";
	else
		echo "No Auctions items processed";

}

function fnCalculateTimeLeft($Duration,$StartDate,$StartTime)
{
		//$StartDate ="YYYY-MM-DD";
		//$StartTime ="HH:MM";
		//$Duration = "Day:Hours:Mins";

		//Concatenate the date and time provided
		$dt = $StartDate." ".$StartTime;
		//Create a date format using
		$Date = new DateTime($dt); 
		//Convert duration into Min
		$arrConverter = explode(":",$Duration);
		$DurationMin = $arrConverter[0]*24*60;
		$DurationMin = $DurationMin + ($arrConverter[1]*60) + ($arrConverter[2]);
		
		$EndDate = $Date->add(new DateInterval('PT' . $DurationMin . 'M'));		
		$now = new DateTime();
		$interval = $EndDate->diff($now);
		
		//ECHO "interval:".$interval->format('%d Day : %H Hours: %i Min');


		if(strtotime(date_format($EndDate,'Y-m-j H:i')) > time())
			return $interval->format('%d Day : %H Hours: %i Min');
		else
			return -1;
}

?>


