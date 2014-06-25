<?php
/*
	Student ID : 1784757
	Name: Rashmi Patil
	Functonality : This page reads the categories and returns the categories as strings delimited by ^
*/


	$Categories = "^";
	$xmlFile = "../../data/auction.xml";
	$doc = DOMDocument::load($xmlFile);
 	$items = $doc->getElementsByTagName("item");
	foreach($items as $item)
	{
		$Category = $item->getElementsByTagName("Category");
		$Category = $Category->item(0)->nodeValue;
		$Cat = "^".$Category."^";
		$pos = strrpos($Categories, $Cat);
		if($pos === false)
			$Categories = $Categories . $Category. "^";
	}
	ECHO $Categories;
?>