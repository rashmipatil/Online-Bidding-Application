<?php
/*
	Student ID : 1784757
	Name: Rashmi Patil
	Functonality : This page loads xml and xsl files and returns the results in HTML format specied in xsl file
*/

$xmlDoc = new DomDocument;
$xmlDoc->load("../../data/auction.xml");
$xslDoc = new DomDocument;
$xslDoc->load("generateReport.xsl");
$proc = new XSLTProcessor;
$proc->importStyleSheet($xslDoc);
echo $proc->transformToXML($xmlDoc);
?>