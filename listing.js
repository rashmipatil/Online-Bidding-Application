//Creating xHRObject for ajax request and response
var xHRObject = false;

if(window.XMLHttpRequest)
	xHRObject = new XMLHttpRequest();
else if(window.ActiveXObject)
	xHRObject = new ActiveXObject("Microsoft.XMLHTTP");

//Function which takes input from from listing.php and calls validate function to validate them
function ValidateInputDetails()
{
	var ItemName = document.getElementById("txtIname").value;
	var Cat = document.getElementById("drpCategory");
	var Category = Cat.options[Cat.selectedIndex].text;

	//If category is others then choose the value from textbox
	if(Category == "Others")
		Category = document.getElementById("txtCategory").value;

	var Description = document.getElementById("txtdesc").value;
	
	//if cent value not provided then append 00
	if(document.getElementById("txtSPCent").value.trim() == "")
		var StartPrice = document.getElementById("txtSPDollar").value.trim() + ".00";
	else
		var StartPrice = document.getElementById("txtSPDollar").value.trim() + "." + document.getElementById("txtSPCent").value;
	
	//if cent value not provided then append 00
	if(document.getElementById("txtRPCent").value.trim() == "")
		var ReservePrice = document.getElementById("txtRPDollar").value.trim() + ".00";
	else
		var ReservePrice = document.getElementById("txtRPDollar").value.trim() + "." + document.getElementById("txtRPCent").value;
	
	//if cent value not provided then append 00
	if(document.getElementById("txtBINPCent").value.trim() == "")
		var BuyItNowPrice = document.getElementById("txtBINPDollar").value.trim() + ".00";
	else
		var BuyItNowPrice = document.getElementById("txtBINPDollar").value.trim() + "." + document.getElementById("txtBINPCent").value;

	var e = document.getElementById("drpDays");
	var Days = e.options[e.selectedIndex].text;
	e = document.getElementById("drpHours");
	var Hours = e.options[e.selectedIndex].text;
	e = document.getElementById("drpMinutes");
	var Minutes = e.options[e.selectedIndex].text;
	
	//Function to validate the input values
	if(fnValidateInputs(ItemName,Category,Description,StartPrice,ReservePrice,BuyItNowPrice,Days,Hours,Minutes))
	{
		//Concatenate the duration to be stored in xml file
		var Duration = Days + ":" + Hours +":"+ Minutes;
		
		//Function to save items in xml file
		SaveItemDetails(ItemName,Category,Description,StartPrice,ReservePrice,BuyItNowPrice,Duration);	
	}
}

//This function calls a php page and saves the items in xml file. Ajax request is in sync mode 
function SaveItemDetails(ItemName,Category,Description,StartPrice,ReservePrice,BuyItNowPrice,Duration)
{
	var bodyofrequest = "ItemName=" + encodeURIComponent(ItemName) + "&Category=" +  encodeURIComponent(Category) + "&Description=" +  encodeURIComponent(Description) + 
				"&StartPrice=" + encodeURIComponent(StartPrice) + "&ReservePrice=" + encodeURIComponent(ReservePrice) +
				"&BuyItNowPrice=" + encodeURIComponent(BuyItNowPrice) + "&Duration=" + encodeURIComponent(Duration); 
	xHRObject.open("POST", "saveItem.php", false); //Sync
	xHRObject.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xHRObject.onreadystatechange = function()
		{
			if(xHRObject.readyState == 4 && xHRObject.status == 200)
			{
				var confirmation = xHRObject.responseText;
				document.getElementById("confirmation").innerHTML = confirmation;
				alert(confirmation);
			}
		};
	xHRObject.send(bodyofrequest); 
}

//This function controlls the visibility of the textbox provided for entering category
function checkField(value)
{
	if(value == "Others")
	{
		document.getElementById("txtbox").style.display="inline";
	}
	else
	{
		document.getElementById("txtbox").style.display="none";
	}
}

//This function validates the inputs provided
function fnValidateInputs(ItemName,Category,Description,StartPrice,ReservePrice,BuyItNowPrice,Days,Hours,Minutes)
{
	//Check if the values are empty
	if((ItemName.trim() == "") || (Category.trim() == "") || (Description.trim() == "") || (StartPrice.trim() == ".") || (ReservePrice.trim() == ".") || 
		(BuyItNowPrice.trim() == ".") || (Days.trim() == "") || (Hours.trim() == "") || (Minutes.trim() == ""))
	{
		document.getElementById("displayError").innerHTML = "Please enter values for all the fields";
		alert("Please enter values");
		return false;
	}
	else
	{
		//Check if the prices are non-numeric
		if(isNaN(parseFloat(StartPrice.trim())) || isNaN(parseFloat(ReservePrice.trim())) || isNaN(parseFloat(ReservePrice.trim())))
		{
			document.getElementById("displayError").innerHTML = "Please enter prices in number";
			alert("Please enter prices in number");
			return false;
		}
		else
		{
			//Check if start price is greater than reserve prive
			if(parseFloat(StartPrice.trim()) > parseFloat(ReservePrice.trim()))
			{
				document.getElementById("displayError").innerHTML = "Reserve price cannot be less than start price";
				alert("Reserve price cannot be less than start price");
				return false;
			}
			else
			{
				//Check if reserve price is greater than buy now price
				if(parseFloat(ReservePrice.trim()) > parseFloat(BuyItNowPrice.trim()))
				{
					document.getElementById("displayError").innerHTML = "Reserve price cannot be greater than Buy it now price";
					alert("Reserve price cannot be greater than Buy it now price");
					return false;
				}
				else
				{
					//Check if duration is 0
					if((Days.trim() == "0") && (Hours.trim() == "0") && (Minutes.trim() == "0"))
					{
						document.getElementById("displayError").innerHTML = "Enter duration greater than current time";
						alert("Enter duration greater than current time");
						return false;

					}
					else
					{
						//return true if all the validations are correct
						return true;
					}
				}
			}
		}
	}
}




