var xHRObject = false;

if(window.XMLHttpRequest)
	xHRObject = new XMLHttpRequest();
else if(window.ActiveXObject)
	xHRObject = new ActiveXObject("Microsoft.XMLHTTP");

function fnValidateLogin()
{
	var pwd = document.getElementById("txtpwd").value;
	var email = document.getElementById("txtemail").value;
	if(fnValidateEmail(email) == true)
	{
		fnSendDataToPHP(email,pwd);
	}
	else
	{
		alert('Please enter valid email address');
		return false;
	}
}

//Function to validate the email address 
function fnValidateEmail(email)
{
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  	  return re.test(email);
}

//Function to send the credentials to login.php and validate
function fnSendDataToPHP(email,pwd)
{
	var bodyofrequest = "email=" + encodeURIComponent(email) +"&pwd=" +  encodeURIComponent(pwd); 
	//xHRObject.open("POST", "login.php", true); //Async
	xHRObject.open("POST", "login.php", false); //Sync
	xHRObject.onreadystatechange = function()
	{		
		if (xHRObject.readyState == 4 && xHRObject.status == 200)
    		{
        		var serverText = xHRObject.responseText;
			if(serverText == "\nValid password")
			{
				window.location.href = "listing.php";
				//return false;
			}
			else
			{
				alert(serverText);
				return false;
			}
		}
	}
	//xHRObject.open("GET", "login.php?email="+ email +"&pwd=" +  pwd, false); //Sync
	xHRObject.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xHRObject.send(bodyofrequest); 
	//xHRObject.send(null); 
}

//Function to reset the data on login page
function fnReset()
{
	document.getElementById("txtpwd") = "";
	document.getElementById("txtemail") = "";
}


