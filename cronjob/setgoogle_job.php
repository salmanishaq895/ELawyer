<?php
set_time_limit(0);
include("../connect/connect.php");

$qrysql = "SELECT quotes_id, location, post_code ,latitude, longitude from tt_quotes where (latitude = '0' or longitude = '0' or latitude = '' or longitude = '')"; 

$res = mysql_query($qrysql) or die(mysql_error());

$count = 1;
 while ($dinfo = mysql_fetch_array($res)) {

	    $id = $dinfo['quotes_id'];
		
		$location = trim($dinfo['location']);
		
		$post_code = trim($dinfo['post_code']);
		$Lat= trim($dinfo['latitude']);
		$Lon = trim($dinfo['longitude']);

		$addressbuss = '';

	

		if($location != ''){
			$addressbuss .= ", ".$location;
		}
		
		if($post_code != ''){
			$addressbuss .= ", ".$post_code;
		}

		
		$where = stripslashes($addressbuss).", UK";
		$whereurl = urlencode($where);
			

		
		$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$whereurl.'&sensor=false');

		$output= json_decode($geocode);
		
		$latitude = $output->results[0]->geometry->location->lat;
		$longitude = $output->results[0]->geometry->location->lng;

		echo "<hr>$count <strong>>></strong> $id >> ".$where  ." >> $latitude  >>  $longitude";
	   	$sqlins2 = "Update tt_quotes set latitude = '".$latitude."', longitude = '".$longitude."' where quotes_id = $id";
		

		if($latitude == 0 || $longitude == 0 || $latitude == '' || $longitude == ''){
			mysql_query("Update tt_quotes set latitude = '0', longitude = '0' where quotes_id = $id") or die(mysql_error());
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