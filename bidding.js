//Creating xHR object for Ajax request

var xHRObject = false;
//For browsers other than IE
if(window.XMLHttpRequest)
	xHRObject = new XMLHttpRequest();
else if(window.ActiveXObject)
	xHRObject = new ActiveXObject("Microsoft.XMLHTTP");////For browsers IE

//Function called on pageload to get the items which are in auction
function getItems()
{
	xHRObject.open("GET", "fetchItems.php?id=" + Number(new Date), true);
      	xHRObject.onreadystatechange = function() 
	{
           if (xHRObject.readyState == 4 && xHRObject.status == 200)
              { 
			var htmlResponse = xHRObject.responseText;
			document.getElementById("result").innerHTML = htmlResponse;
			//alert(xmlDoc);
		}
      	}
      	xHRObject.send(null);
}

//Function called on place bid button clicked, opens a new window and pass item number and Current bid as query strings
function fnPlaceBid(itemNumber,currentBid)
{
	window.open('placeBid.php?itemNumber='+itemNumber+'&currentBid='+currentBid,'name','width=600,height=400');
	return false;
}

//Function calls a php page to update the status of an item for Buy Now button
function fnBuyNow(itemNumber)
{
	if(confirm('Are you sure to purchase the item now?'))
	{
		var xmlFile = "../../data/auction.xml";
		if (xHRObject.overrideMimeType) 
		{         
			  xHRObject.overrideMimeType("text/xml");
		}
		if(xHRObject) 
		{
	
			var bodyofrequest = "itemNumber=" + encodeURIComponent(itemNumber);
			xHRObject.open("POST", "updateItem.php", false); //Sync
			xHRObject.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xHRObject.onreadystatechange = function()
			{
				if (xHRObject.readyState == 4 && xHRObject.status == 200)
    				{
	        			var serverText = xHRObject.responseText;
					alert(serverText);
    				}
			}
			xHRObject.send(bodyofrequest);  
		}
	} 
}














