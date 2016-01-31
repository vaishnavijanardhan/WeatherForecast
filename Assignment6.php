<html>
    <head>
        <script type="text/javascript">
		
			function Checkform()
			{
				flag=true;
				 errormsg="";
				 street=document.getElementsByName("street")[0].value;
				 city=document.getElementsByName("city")[0].value;
				 state=document.getElementsByName("state")[0].value;
                
      if(street.length>0) 
        {
            document.getElementsByName("street")[0].value = TrimFunc(street);
        }
    if(city.length>0)
        {
            document.getElementsByName("city")[0].value = TrimFunc(city); 
        }
       
     street=document.getElementsByName("street")[0].value;
     city=document.getElementsByName("city")[0].value;  
            
				if(street.length==0)
				{
					errormsg+="Address";
					flag=false;
				}
				if(city.length==0)
				{
					if(errormsg.length==0)
					{
						errormsg+="City";
					}
					else
					{
						errormsg+=", City";
					}
					flag=false;
				}
				if(state.length==0)
				{
					if(errormsg.length==0)
					{
						errormsg+="State";
					}
					else
					{
						errormsg+=", State";
					}
					flag=false;
				}
				
				if(flag==false)
				{
					alert("Please enter value for "+ errormsg );
					return;
				}
			}
			
        function TrimFunc(data)
        {
            
            str=data.trim();
            str=str.replace(/\s+/g," ");
            return str;
        }
        
        
				function Clearform()
			{
				document.getElementById("weather").reset();
                document.getElementById("weatherinfo").innerHTML="";
			}
			    
        function DispWeather(summary,temperature,icon,precipIntensity,precipProbability,windSpeed,dewPoint,humidity,visibility,sunriseTime,sunsetTime,deg)
			{
                
var Temp="",Wind="",Visibility="",Prec=1;
var SunRise=new Date(0);
var SunSet=new Date(0);

var humidi=parseFloat(humidity)*100;
var precip=parseFloat(precipProbability)*100;
				
precip=formatString(precip+"");
humidi=formatString(humidi+"");
SunRise.setUTCSeconds(sunriseTime);
SunSet.setUTCSeconds(sunsetTime);
if(deg=="us")
{   
    Prec=1;
    Temp="F";
	Wind="mph"
	Visibility="mi";
}
else
{
    Prec=25.4;
	Temp="C";
    Wind="mts/s"
	Visibility="Km";
}

var writehtml="<table id ='weatherinfo' style='border:2px solid; padding-left:60px; padding-right:60px;' align='center'>";
writehtml+="<tr><td colspan='2'><h2 style='text-align:center;'>"+summary;
writehtml+="<br/>"+parseInt(temperature)+" <sup>o</sup>"+Temp+"</h2></td></tr>";
writehtml+="<tr> <td colspan='2'><img src='"+FetchIcon(icon)+"' alt='"+summary+"' title='"+summary+"' style=' display: block; margin: 0 auto; width:60%;' /></td></tr>";

writehtml+="<tr><td>Precipitation:</td>";
writehtml+="<td>"+GetPrecip(precipIntensity,Prec)+"</td></tr>";
writehtml+="<tr><td>Chance of Rain:</td>";
writehtml+="<td>"+precip+"%</td></tr>";
writehtml+="<tr><td>Wind Speed:</td>";
writehtml+="<td>"+parseInt(windSpeed)+" "+Wind+"</td></tr>";
writehtml+="<tr><td>Dew Point:</td>";
writehtml+="<td>"+parseInt(dewPoint)+" <sup>o</sup>"+Temp+"</td></tr>";
writehtml+="<tr><td>Humidity:</td>";
writehtml+="<td>"+humidi+"%"+"</td></tr>";
writehtml+="<tr><td>Visibility:</td>";
writehtml+="<td>"+parseInt(visibility)+" "+Visibility+"</td></tr>";
writehtml+="<tr><td>Sunrise:</td>";
writehtml+="<td>"+sunriseTime+"</td></tr>";
writehtml+="<tr><td>Sunset:</td>";
writehtml+="<td>"+sunsetTime+"</td></tr>";
writehtml+="</table>";
document.write(writehtml);
}
        
 function FetchIcon(icon)
{
if(icon=="clear-day")
{
	return "clear.png";
}
else if(icon=="clear-night")
{
	return "clear_night.png";
}
else if(icon=="rain")
{
	return "rain.png";
}
else if(icon=="snow")
{
	return "snow.png";
}
else if(icon=="sleet")
{
	return "sleet.png";
}
else if(icon=="wind")
{
	return "wind.png";
}
else if(icon=="fog")
{
	return "fog.png";
}
else if(icon=="cloudy")
{
	return "cloudy.png";
}
else if(icon=="partly-cloudy-day")
{
	return "cloud_day.png";
}
else if(icon=="partly-cloudy-night")
{
	return "cloud_night.png";
}
return null;
}

        

        
function GetPrecip(precipIntensity,Prec)
{
var precip=precipIntensity;
    precip=precip/Prec;
if(precip>=0 && precip<0.002)
{
	return "None";
}
else if(precip>=0.002 && precip<0.017)
{
	return "Very Light";
}
else if(precip>=0.017 && precip<0.1)
{
	return "Light";
}
else if(precip>=0.1 && precip<0.4)
{
	return "Moderate";
}
else if(precip>=0.4 )
{
	return "Heavy";
}
return null;
}
    
function GetTime(hours,min)
{
var sign=" AM";
if(hours>12)
{
	hours-=12;
	sign=" PM";
}
else if(hours==0)
{
	hours=12;
	sign=" AM";
}
else if(hours==12)
{
	sign=" PM";
}
if((hours+"").length<2)
{
	hours="0"+hours;
}
if((min+"").length<2)
{
	min="0"+min;
}

return hours+":"+min+sign;
}
    
function formatString(DataString)
{
				
var SplitStr=DataString.split(".");
if(SplitStr.length<2)
{
	return DataString;
}
else
{
	if(SplitStr[1].length>2)
	{
		SplitStr[1]=SplitStr[1].substring(0,2);
	}
	return SplitStr[0]+"."+SplitStr[1];
}
}    
          
    function KeepContent(street,city,state,degree)
        {
     
    document.getElementsByName("street")[0].value=street;
    document.getElementsByName("city")[0].value=city;
     for(var i=0;i<document.getElementsByName("state")[0].length;i++)
    {
        if(document.getElementsByName("state")[0][i].value==state)
        {
            document.getElementsByName("state")[0].selectedIndex=i;
            break;
        }
    }
        if(document.getElementsByName("degree")[0].value==degree)
        {
            document.getElementsByName("degree")[0].checked=true;
        }
            else
            {
                document.getElementsByName("degree")[1].checked=true;
            }
        }
        
            
            
        </script>
        
        
        
    </head>

<body>
	
		<form method="POST" name="weather" id="weather" action="Assignment6.php">
				<h1 style="text-align:center;">Forecast Search</h1>
				<table style="margin:0 auto; border:2px solid; padding-right:90px;">
					<tr>
						<td>Street Address:* </td>
						<td><input type="text" name="street" value="" size="25px"/></td>
					</tr>
					<tr>
						<td>City:* </td>
						<td><input type="text" name="city" value="" size="25px"/></td>
					</tr>
					<tr>
						<td>State:* </td>
						<td>
						<select name="state">
						<option value="" selected="selected">Select your state...</option>
						<option value='AL'>Alabama</option>
						<option value='AK'>Alaska</option>
						<option value='AZ'>Arizona</option>
						<option value='AR'>Arkansas</option>
						<option value='CA'>California</option>
						<option value='CO'>Colorado</option>
						<option value='CT'>Connecticut</option>
						<option value='DE'>Delaware</option>
						<option value='DC'>District Of Columbia</option>
						<option value='FL'>Florida</option>
						<option value='GA'>Georgia</option>
						<option value='HI'>Hawaii</option>
						<option value='ID'>Idaho</option>
						<option value='IL'>Illinois</option>
						<option value='IN'>Indiana</option>
						<option value='IA'>Iowa</option>
						<option value='KS'>Kansas</option>
						<option value='KY'>Kentucky</option>
						<option value='LA'>Louisiana</option>
						<option value='ME'>Maine</option>
						<option value='MD'>Maryland</option>
						<option value='MA'>Massachusetts</option>
						<option value='MI'>Michigan</option>
						<option value='MN'>Minnesota</option>
						<option value='MS'>Mississippi</option>
						<option value='MO'>Missouri</option>
						<option value='MT'>Montana</option>
						<option value='NE'>Nebraska</option>
						<option value='NV'>Nevada</option>
						<option value='NH'>New Hampshire</option>
						<option value='NJ'>New Jersey</option>
						<option value='NM'>New Mexico</option>
						<option value='NY'>New York</option>
						<option value='NC'>North Carolina</option>
						<option value='ND'>North Dakota</option>
						<option value='OH'>Ohio</option>
						<option value='OK'>Oklahoma</option>
						<option value='OR'>Oregon</option>
						<option value='PA'>Pennsylvania</option>
						<option value='RI'>Rhode Island</option>
						<option value='SC'>South Carolina</option>
						<option value='SD'>South Dakota</option>
						<option value='TN'>Tennessee</option>
						<option value='TX'>Texas</option>
						<option value='UT'>Utah</option>
						<option value='VT'>Vermont</option>
						<option value='VA'>Virginia</option>
						<option value='WA'>Washington</option>
						<option value='WV'>West Virginia</option>
						<option value='WI'>Wisconsin</option>
						<option value='WY'>Wyoming</option>
						</select>
						</td>
					</tr>
					<tr>
						<td>Degree:* </td>
						<td><input type="radio" name="degree" value="us" checked="checked"/>Fahrenheit
							<input type="radio" name="degree" value="si"/>Celsius</br></td>
					</tr>
					<tr>
                        <td ></td>
                        <td><input type="submit" value="Search" name="submit" onclick="Checkform();"/>
						<input type="button" value="Clear" name="clear" onclick="Clearform();"/></td>
					</tr>
					<tr/>
					<tr/>
					<tr>
						<td align="left" ><i>* - Mandatory Fields.</i></td>
						<td/>
					</tr>
					<tr>
                        <td></td>
                        <td><a href="http://forecast.io/" target=”_blank”>Powered by Forecast.io</a></td>
					</tr>
				</table>
		</form>
		
		
	</body>
</html>

<?php

FetchValue();
function FetchValue()
{
    
    if(!empty($_POST["submit"]))
    {
        $street=$_POST["street"];
        $city=$_POST["city"];
        $state=$_POST["state"];
        $degree=$_POST["degree"];
    
 
 echo "<script type='text/javascript'>
 KeepContent('".$street."','".$city."','".$state."','".$degree."');
 </script>";
        
if(!empty($street)&&!empty($city)&&!empty($state)&&!empty($degree))
{  
$GoogleGeoCode = simplexml_load_file("https://maps.google.com/maps/api/geocode/xml?address=".$street.",".$city.",".$state."&key=AIzaSyDXJc-HfeU4ZVttzpruI8Q04ZZtzqv4-is");
$xmlcont = ParseXml($GoogleGeoCode);
$Url = "https://api.forecast.io/forecast/e0233df5fb8a3299a02c55c843c4d5dd/".$xmlcont[0].",".$xmlcont[1]."?units=".$degree."&exclude=flag";  
CallJson($Url,$degree);
}
}

}


function CallJson($Url,$degree)
	{
        $Contents=file_get_contents($Url);
		$Contentobj=json_decode($Contents, true);
        date_default_timezone_set($Contentobj["timezone"]);
		if(   isset($Contentobj["currently"]["summary"])
       && isset($Contentobj["currently"]["temperature"])
       && isset($Contentobj["currently"]["icon"])
       && isset($Contentobj["currently"]["precipIntensity"])
       && isset($Contentobj["currently"]["precipProbability"])
       && isset($Contentobj["currently"]["windSpeed"])
       && isset($Contentobj["currently"]["dewPoint"])
       && isset($Contentobj["currently"]["humidity"])
       && isset($Contentobj["currently"]["visibility"])
       && isset($Contentobj["daily"]["data"][0]["sunriseTime"])
       && isset($Contentobj["daily"]["data"][0]["sunsetTime"])  )
        {
		$summary=$Contentobj["currently"]["summary"];
		$temperature=$Contentobj["currently"]["temperature"];
		$icon=$Contentobj["currently"]["icon"];
		$precipIntensity=$Contentobj["currently"]["precipIntensity"];
		$precipProbability=$Contentobj["currently"]["precipProbability"]; 
		$windSpeed=$Contentobj["currently"]["windSpeed"];
		$dewPoint=$Contentobj["currently"]["dewPoint"];
		$humidity=$Contentobj["currently"]["humidity"];
		$visibility=$Contentobj["currently"]["visibility"];
		$sunriseTime=$Contentobj["daily"]["data"][0]["sunriseTime"];
		$sunsetTime=$Contentobj["daily"]["data"][0]["sunsetTime"];
		
		echo "<script type='text/javascript'>
		DispWeather('".$summary."','"
		.$temperature."','"
		.$icon."','"
		.$precipIntensity."','"
		.$precipProbability."','"
		.$windSpeed."','"
		.$dewPoint."','"
		.$humidity."','"
		.$visibility."','"
		.date('h:i a', $sunriseTime)."','"
		.date('h:i a', $sunsetTime)."','"
		.$degree."');
		</script>";
        }
    else
    {
        die("<script type='text/javascript'> alert ('Cannot identify location.');</script>");
    }
	}


function ParseXml($GoogleGeoCode)
	{
     if($GoogleGeoCode->xpath("/GeocodeResponse/status")[0]=="OK")
    {
		$Latitude=Array();
        $Longitude=Array();
		$Latitude=$GoogleGeoCode->result[0]->geometry->location->lat;
		$Longitude=$GoogleGeoCode->result[0]->geometry->location->lng;
		$xmlcont[0]=$Latitude[0];
		$xmlcont[1]=$Longitude[0];
		return $xmlcont;
	} 
    else
    {
        die("<script type='text/javascript'> alert ('Cannot identify location.');</script>");
    }
}
?>