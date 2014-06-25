//Create xHRObject for ajax request and response
var xHRObject1 = false;

if(window.XMLHttpRequest)
	xHRObject1 = new XMLHttpRequest();
else if(window.ActiveXObject)
	xHRObject1 = new ActiveXObject("Microsoft.XMLHTTP");

//Function to load the categories in listing page
function fnLoadListing()
{
	xHRObject1.open("GET", "LoadItems.php?id=" + Number(new Date), false);
	xHRObject1.onreadystatechange = function()
	{
		
		if (xHRObject1.readyState == 4 && xHRObject1.status == 200)
       	{
        		Categories = xHRObject1.responseText;
			//Split the string 
			var arrCategories = Categories.split("^");
			var x=document.getElementById("drpCategory");
			var option=document.createElement("option");	
			option.text="Others";
	  		// for IE earlier than version 8
  			//x.add(option,x.options[null]);
			var length = arrCategories.length;
			if(length <= 1)
				document.getElementById("txtbox").style.display="inline";
    			var Category = "";
			for (var i = 1; i < length-1; i++) 
			{
  				Category = arrCategories[i];
				x.options[x.length] = new Option(Category, Category);  
			}
			x.options[x.length] = new Option('Others', 'Others');
			LoadDuration();
		}      

	}
	xHRObject1.send(null);
}

function LoadDuration()
{
	LoadDays();
	LoadHours();
	LoadMinutes();
}

function LoadDays()
{
	var x=document.getElementById("drpDays");
	var option=document.createElement("option");
	for(var i=0 ; i<32 ;i++)
	{
		
		option.text=i;
		try
  		{
  			// for IE earlier than version 8
  			//x.add(option,x.options[null]);
			x.options[x.length] = new Option(i, i);
  		}
		catch (e)
  		{
  			//x.add(option,null);
			x.options[x.length] = new Option(i, i);
  		}
	}
}

function LoadHours()
{
	var x=document.getElementById("drpHours");
	var option=document.createElement("option");
	for(var i=0 ; i<24 ;i++)
	{
		
		option.text=i;
		try
  		{
  			// for IE earlier than version 8
  			//x.add(option,x.options[null]);
			x.options[x.length] = new Option(i, i);
  		}
		catch (e)
  		{
  			//x.add(option,null);
			x.options[x.length] = new Option(i, i);
  		}
	}
}

function LoadMinutes()
{
	var x=document.getElementById("drpMinutes");
	var option=document.createElement("option");
	for(var i=0 ; i<60 ;i++)
	{
			option.text=i;
			try
  			{
  				// for IE earlier than version 8
  				//x.add(option,x.options[null]);
				x.options[x.length] = new Option(i, i);
  			}
			catch (e)
  			{
  				//x.add(option,null);
				x.options[x.length] = new Option(i, i);
  			}
	}
}



