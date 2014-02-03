<?php
set_time_limit(0);
include("../connect/connect.php");

$qrysql = "SELECT locationid, address, address2, city, state,	zip ,latitude, longitude from tt_business where (latitude = '0' or longitude = '0' or latitude = '' or longitude = '')"; 

$res = mysql_query($qrysql) or die(mysql_error());

$count = 1;
 while ($dinfo = mysql_fetch_array($res)) {

	    $id = $dinfo['locationid'];
		
		$street_address = trim($dinfo['address']);
		$street_address2 = trim($dinfo['address2']);
		$city = trim($dinfo['city']);
		$state = trim($dinfo['state']);
		$zip = trim($dinfo['zip']);
		$Lat= trim($dinfo['latitude']);
		$Lon = trim($dinfo['longitude']);

		$addressbuss = $street_address;

		if($street_address2 != ''){
			$addressbuss .= ", ".$street_address2;
		}

		if($city != ''){
			$addressbuss .= ", ".$city;
		}
		if($state != ''){
			$addressbuss .= ", ".$state;
		}
		if($zip != ''){
			$addressbuss .= ", ".$zip;
		}
		if($country != ''){
			$addressbuss .= ", ".$country;
		}
		
		$where = stripslashes($addressbuss);
		$whereurl = urlencode($where);
		$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$whereurl.'&sensor=false');
		$output= json_decode($geocode);
		$latitude = $output->results[0]->geometry->location->lat;
		$longitude = $output->results[0]->geometry->location->lng;


		echo "<hr>$count <strong>>></strong> $id >> ".$where  ." >> $latitude  >>  $longitude";
	   	$sqlins2 = "Update tt_business set latitude = '".$latitude."', longitude = '".$longitude."' where locationid = $id";
		

		if($latitude == 0 || $longitude == 0 || $latitude == '' || $longitude == ''){
			mysql_query("Update tt_business set latitude = '0', longitude = '0' where locationid = $id") or die(mysql_error());
			echo "<br><font color='#FF0000'><b>$id <strong>>></strong> ". $sqlins2 ."</b></font>";
		}
		else
		{
			mysql_query($sqlins2) or die(mysql_error());
			echo "<br>$id <strong>>></strong> $sqlins2";
		}
		$count++;
	
}
?>