var xHRObject = false;

if(window.XMLHttpRequest)
	xHRObject = new XMLHttpRequest();
else if(window.ActiveXObject)
	xHRObject = new ActiveXObject("Microsoft.XMLHTTP");

//Function to validate the bidding price
function fnValidateBid()
{
	var Bid = document.getElementById('txtPBDollar').value+"."+document.getElementById('txtPBCent').value;
	if(isNaN(parseFloat(Bid)))
	{
		alert("Please enter numeric value");
		return false;
	}
	else
	{
		cbValue = document.getElementById('CBPid').value;
		if(parseFloat(Bid) <= parseFloat(cbValue))
		{
			alert("Please place higher bid than current bid");
			return false;
		}
		else
		{
			//var ItemNumber = document.getElementById('INid').value;
			//fnProcessBid(ItemNumber,Bid);
			return true;
		}
			
	}
	
}

//Function to call a php and update the new bid
function fnProcessBid(ItemNumber,Bid)
{
	//Load auction xml
	
	var xmlDoc = loadXMLDoc();
	alert(xmlDoc);
}

function loadXMLDoc()
{
	var xmlFile = "../../data/auction.xml";
	xHRObject.open("GET",xmlFile,false);
	xHRObject.onreadystatechange = function() 
	{
           if (xHRObject.readyState == 4 && xHRObject.status == 200)
              { 
			return xHRObject.responseText;
			//document.getElementById("result").innerHTML = htmlResponse;
			//alert(xmlDoc);
		}
      	}
      	xHRObject.send(null);
}



