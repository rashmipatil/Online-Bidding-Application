<?php

/*
	Student ID : 1784757
	Name: Rashmi Patil
	Functonality : This page Saves the item details in an xml file.
*/

session_start();
header('Content-Type: text/xml');
?>

<?php
$ItemName = $_POST['ItemName'];
$Category = $_POST['Category'];
$Description = $_POST['Description'];
$StartPrice = $_POST['StartPrice'];
$ReservePrice = $_POST['ReservePrice'];
$BuyItNowPrice = $_POST['BuyItNowPrice'];
$Duration = $_POST['Duration'];
$ItemNumber = 1;
$StartDate = date('Y-m-j');
$StartTime = date('H:i');
$Status = "in-progress";
$ListedBy = "Lister";
$ListedBy = $_SESSION["CustomerfName"];
$Bidder = "";
$CurrentBidPrice = $StartPrice;

$xmlFile = "../../data/auction.xml";
//Check if the file exists
if(file_exists($xmlFile))
{
	$ItemNumber =	fnGetItemNumber($xmlFile);
	fnAppendItem($ItemName,$Category,$Description,$StartPrice,$ReservePrice,$BuyItNowPrice,$Duration,
				$ItemNumber,$StartDate,$StartTime,$Status,$ListedBy,$Bidder,$CurrentBidPrice,$xmlFile);
}
else
{
	CreateXMLDocItems($ItemName,$Category,$Description,$StartPrice,$ReservePrice,$BuyItNowPrice,$Duration,
				$ItemNumber,$StartDate,$StartTime,$Status,$ListedBy,$Bidder,$CurrentBidPrice,$xmlFile);
}

ECHO "Thank you! Your item has been listed in ShopOnline.The item number is ".$ItemNumber.", and the bidding starts now: ".$StartTime." on ".$StartDate;
//generate item number
function fnGetItemNumber($xmlFile)
{
		$count = 1;
		$doc = DOMDocument::load($xmlFile);
 		$items = $doc->getElementsByTagName("item");
		foreach($items as $item)
		{
			$count = $count + 1;
		}
		return $count;
}

//Create an xml doc for new item
function CreateXMLDocItems($ItemName,$Category,$Description,$StartPrice,$ReservePrice,$BuyItNowPrice,$Duration,
					$ItemNumber,$StartDate,$StartTime,$Status,$ListedBy,$Bidder,$CurrentBidPrice,$xmlFile)
{
	$doc = new DomDocument;//('1.0');
	
	$Items = $doc->createElement('Items');
	$Items = $doc->appendChild($Items);

	$item = $doc->createElement('item');
	$item = $Items->appendChild($item);

	fnAppendChild("Number",$doc,$ItemNumber,$item);
	fnAppendChild("Name",$doc,$ItemName,$item);
	fnAppendChild("Category",$doc,$Category,$item);
	fnAppendChild("Description",$doc,$Description,$item);
	fnAppendChild("StartPrice",$doc,$StartPrice,$item);
	fnAppendChild("ReservePrice",$doc,$ReservePrice,$item);
	fnAppendChild("BuyItNowPrice",$doc,$BuyItNowPrice,$item);
	fnAppendChild("Duration",$doc,$Duration,$item);
	fnAppendChild("StartDate",$doc,$StartDate,$item);
	fnAppendChild("StartTime",$doc,$StartTime,$item);
	fnAppendChild("Status",$doc,$Status,$item);
	fnAppendChild("ListedBy",$doc,$ListedBy,$item);
	fnAppendChild("Bidder",$doc,$Bidder,$item);
	fnAppendChild("CurrentBidPrice",$doc,$CurrentBidPrice,$item);
	
	//$strXML = $doc->saveXML();
	$doc->save($xmlFile);

	
}
//Generic function to append new child
function fnAppendChild($tagName,$doc,$value,$ParentNode)
{
	$Element = $doc->createElement($tagName);
	$Element = $ParentNode->appendChild($Element);
	$nodevalue = $doc->createTextNode($value);
	$nodevalue = $Element->appendChild($nodevalue);	
}

function fnAppendItem($ItemName,$Category,$Description,$StartPrice,$ReservePrice,$BuyItNowPrice,$Duration,
				$ItemNumber,$StartDate,$StartTime,$Status,$ListedBy,$Bidder,$CurrentBidPrice,$xmlFile)
{
	$doc = DOMDocument::load($xmlFile);
 	$Items = $doc->getElementsByTagName("Items");
	$item = $doc->createElement('item');
	$item = $Items->item(0)->appendChild($item);
	
	fnAppendChild("Number",$doc,$ItemNumber,$item);
	fnAppendChild("Name",$doc,$ItemName,$item);
	fnAppendChild("Category",$doc,$Category,$item);
	fnAppendChild("Description",$doc,$Description,$item);
	fnAppendChild("StartPrice",$doc,$StartPrice,$item);
	fnAppendChild("ReservePrice",$doc,$ReservePrice,$item);
	fnAppendChild("BuyItNowPrice",$doc,$BuyItNowPrice,$item);
	fnAppendChild("Duration",$doc,$Duration,$item);
	fnAppendChild("StartDate",$doc,$StartDate,$item);
	fnAppendChild("StartTime",$doc,$StartTime,$item);
	fnAppendChild("Status",$doc,$Status,$item);
	fnAppendChild("ListedBy",$doc,$ListedBy,$item);
	fnAppendChild("Bidder",$doc,$Bidder,$item);
	fnAppendChild("CurrentBidPrice",$doc,$CurrentBidPrice,$item);
	
	//$strXML = $doc->saveXML();
	$doc->save($xmlFile);
}
?>