<?php
/*
	Student ID : 1784757
	Name: Rashmi Patil
	Functonality : This page registers the users. The user details are saved in the xml file

*/

$fname = $_GET['fname'];
$sname = $_GET['sname'];
$email = $_GET['email'];

$pwd = $sname;
$customerid = "1";
$xmlFile = "../../data/customer.xml";
	
//Check if the file exist
if(file_exists($xmlFile))
{
	if(fnEmailExists($xmlFile,$email))
	{
		ECHO "Email already registered!";
		Exit();
	}
	else
	{
		$customerid =	fnGetCustomerId($xmlFile);
		fnAppendCustomer($fname,$sname,$email,$customerid,$xmlFile);
		ECHO "Registration successful, Please use login page to login into ShopOnline";
		fnSendEmail($fname,$sname,$email,$customerid,$pwd);

	}
}
else
{
		fnCreateCustomerDoc($fname,$sname,$email,$customerid,$xmlFile);
		ECHO "Registration successful, Please use login page to login into ShopOnline";
		fnSendEmail($fname,$sname,$email,$customerid,$pwd);

}
//Create a new customer id
function fnGetCustomerId($xmlFile)
{
	if(file_exists($xmlFile))
	{
		$count = 1;
		$doc = DOMDocument::load($xmlFile);
 		$customers = $doc->getElementsByTagName("customer");
		foreach($customers as $customer)
		{
			$count = $count + 1;
		}
		return $count;
	}
	else
	{
		return 1;
	}
}
function fnSendEmail($fname,$sname,$email,$customerid,$pwd)
{
			$email_to = $email;
			$subject = "Welcome to ShopOnline!";
			$message = "Dear ". $fname . ", welcome to use ShopOnline! Your customer id is " . $customerid . " and the password is " . $pwd ;
			$header = "From registration@Shoponline.com.au";
			
			//Send welcome mail to the email address provided
			if(mail($email_to,$subject,$message,$header,"-r 1784757@student.swin.edu.au"))
			{
				//return true if email is sent
				//return true;
			}
			else
			{
				echo "Registration failed, email could not be sent!";
				exit();
			}
			
}

function fnEmailExists($xmlFile,$email)
{
	$exists = false;
	$doc = DOMDocument::load($xmlFile);
 	$customers = $doc->getElementsByTagName("customer");
	$emailfound = 0;
	foreach($customers as $customer)
	{
		$emailid = $customer->getElementsByTagName("emailid");
		$emailid = $emailid->item(0)->nodeValue;
		if($emailid == $email)
		{
			$exists = true;
		}
	}
	return $exists;
}

function fnAppendCustomer($fname,$sname,$email,$customerid,$xmlFile)
{
	$doc = DOMDocument::load($xmlFile);
 	$Customers = $doc->getElementsByTagName("Customers");
	$customer = $doc->createElement('customer');
	$customer = $Customers->item(0)->appendChild($customer);
	
	fnAppendChild("customerid",$doc,$customerid,$customer);
	fnAppendChild("firstname",$doc,$fname,$customer);
	fnAppendChild("surname",$doc,$sname,$customer);
	fnAppendChild("emailid",$doc,$email,$customer);
	fnAppendChild("password",$doc,$sname,$customer);

	$strXML = $doc->saveXML();
	$doc->save($xmlFile);

		
}

//Generic function to append a new child
function fnAppendChild($tagName,$doc,$value,$ParentNode)
{
	$Element = $doc->createElement($tagName);
	$Element = $ParentNode->appendChild($Element);
	$nodevalue = $doc->createTextNode($value);
	$nodevalue = $Element->appendChild($nodevalue);	
}

function fnCreateCustomerDoc($fname,$sname,$email,$customerid,$xmlFile)
{
	
	$doc = new DomDocument;//('1.0');

	$Customers = $doc->createElement('Customers');
	$Customers = $doc->appendChild($Customers);

	$customer = $doc->createElement('customer');
	$customer = $Customers->appendChild($customer);

	fnAppendChild("customerid",$doc,$customerid,$customer);
	fnAppendChild("firstname",$doc,$fname,$customer);
	fnAppendChild("surname",$doc,$sname,$customer);
	fnAppendChild("emailid",$doc,$email,$customer);
	fnAppendChild("password",$doc,$sname,$customer);

	$strXML = $doc->saveXML();
	$doc->save($xmlFile);
	//echo $strXML;
}

?>