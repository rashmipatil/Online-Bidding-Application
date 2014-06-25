//function to process the auctioned items
function fnProcessAuctionItems()
{
	var xHRObject = false;

if(window.XMLHttpRequest)
	xHRObject = new XMLHttpRequest();
else if(window.ActiveXObject)
	xHRObject = new ActiveXObject("Microsoft.XMLHTTP");


	xHRObject.open("GET", "processAuction.php?id=" + Number(new Date), false);
      	xHRObject.onreadystatechange = function() 
	{
           if (xHRObject.readyState == 4 && xHRObject.status == 200)
              { 
			var htmlResponse = xHRObject.responseText;
			document.getElementById("confirmation").innerHTML = htmlResponse;
		}
      	}
      	xHRObject.send(null);
}

//Function to generate the revenuue using XSLT method
function fnGenerateReport()
{
	var xHRObject = false;

if(window.XMLHttpRequest)
	xHRObject = new XMLHttpRequest();
else if(window.ActiveXObject)
	xHRObject = new ActiveXObject("Microsoft.XMLHTTP");


	xHRObject.open("GET", "generateReport.php?id=" + Number(new Date), false);
      	xHRObject.onreadystatechange = function() 
	{
           if (xHRObject.readyState == 4 && xHRObject.status == 200)
              { 
			var htmlResponse = xHRObject.responseText;
			if(htmlResponse.indexOf("<td>") > 0)
				document.getElementById("report").innerHTML = htmlResponse;
			else
				document.getElementById("report").innerHTML = "No items for generating revenue";
		}
      	}
      	xHRObject.send(null);
}



