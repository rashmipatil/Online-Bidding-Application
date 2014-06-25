<?php
/*
	Student ID : 1784757
	Name: Rashmi Patil
	Functonality : This page loads xml and validates if the email address and passwords are valid
*/ 
//session_set_cookie_params(3600);
if((isset($_SESSION["CustomerID"]) == TRUE) || (isset($_SESSION["CustomerfName"]) == TRUE))
{
	session_unset($_SESSION["CustomerID"]);
	session_unset($_SESSION["CustomerfName"]);
	session_destroy($_SESSION["CustomerID"]);
	session_destroy($_SESSION["CustomerfName"]);

}
//session_destroy();
//session_register("CustomerID");
//session_register("CustomerfName");
session_start();
?>

<?php
$email = $_POST['email'];
$password = $_POST['pwd'];

$xmlFile = "../../data/customer.xml";
if(file_exists($xmlFile))
{
	$retStatus = fnValidateLoginDetails($xmlFile,$email,$password);
	if($retStatus == 1)
	{
		echo "Valid password";		
	}
	else if($retStatus == 2)
	{
		echo "Invalid password";
	}
	else
	{
		echo "You are not registered. Please register to Shoponline!";
	}
}
else
{
	echo "Please register, to login into Shoponline!";	
}

function fnValidateLoginDetails($xmlFile,$email,$password)
{
	$status = 3;
	$doc = DOMDocument::load($xmlFile);
 	$customers = $doc->getElementsByTagName("customer");
	foreach($customers as $customer)
	{
		$emailid = $customer->getElementsByTagName("emailid");
		$emailid = $emailid->item(0)->nodeValue;
		if($emailid == $email)
		{
			$pwd = $customer->getElementsByTagName("password");
			$pwd = $pwd->item(0)->nodeValue;
			if($pwd == $password)
			{
				$fname = $customer->getElementsByTagName("firstname");
				$fname = $fname->item(0)->nodeValue;

				$customerid = $customer->getElementsByTagName("customerid");
				$customerid = $customerid->item(0)->nodeValue;
			
				$_SESSION["CustomerID"] = $customerid;
				$_SESSION["CustomerfName"] = $fname;

				$status = 1;//Valid login details
				break;
			}
			else
			{
				$status = 2;//Wrong password
			}
		}
	}
	return $status;
}

?>