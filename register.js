var xHRObject = false;

if(window.XMLHttpRequest)
	xHRObject = new XMLHttpRequest();
else if(window.ActiveXObject)
	xHRObject = new ActiveXObject("Microsoft.XMLHTTP");

function fnRegister()
{
	var fname = document.getElementById("txtfname").value;
	var sname = document.getElementById("txtsname").value;
	var email = document.getElementById("txtemail").value;

	if(fnValidateEmail(email))
	{
		fnSendDataToPHP(fname,sname,email);
	}
	else
	{
		alert('Please enter valid email address');
	}
}

function fnReset()
{
	document.getElementById("txtfname") = "";
	document.getElementById("txtsname") = "";	
	document.getElementById("txtemail") = "";
}

function fnValidateEmail(email)
{
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}


function fnSendDataToPHP(fname,sname,email)
{

	xHRObject.open("GET", "Registration.php?fname=" + fname +"&sname=" + sname +"&email="+email, false);
	
	xHRObject.onreadystatechange = function() {
	
           if (xHRObject.readyState == 4 && xHRObject.status == 200)
		{	
			alert(xHRObject.responseText);
               	//document.getElementById('result').innerHTML = xHRObject.responseText;
		}
      }
      xHRObject.send(null);
}


