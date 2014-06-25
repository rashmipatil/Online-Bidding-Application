var xHRObject = false;

if(window.XMLHttpRequest)
	xHRObject = new XMLHttpRequest();
else if(window.ActiveXObject)
	xHRObject = new ActiveXObject("Microsoft.XMLHTTP");

function fnSignout()
{
	xHRObject.open("GET", "signout.php?id=" + Number(new Date), false);
	xHRObject.onreadystatechange = function() 
	{
           if (xHRObject.readyState == 4 && xHRObject.status == 200)
              { 
			var htmlResponse = xHRObject.responseText;
			if(htmlResponse == 1)
			{
				alert("You are successfully logged off");
				window.location = "login.html";
			}
		}
      	}
      	xHRObject.send(null);
}


