<?php 
include_once("../connect/connect.php");
$bId	=	$_GET['bId'];
  $sql_review		=	"select * from tt_business where locationid='$bId'";
//exit;
$rs_business	=	$db->get_row($sql_review,ARRAY_A);
//echo "<pre>".print_r($rs_business); exit;


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="<?php echo $ru; ?>js/downloadxml.js"></script>
	<script>
	function initialize(){
	var myLatlng = new google.maps.LatLng(<?php echo $rs_business['latitude'];?>,<?php echo $rs_business['longitude'];?>);
//var myLatlng = new google.maps.LatLng(-25.363882,131.044922);
var myOptions = {
  zoom: 13,
  center: myLatlng,
  mapTypeId: google.maps.MapTypeId.ROADMAP
}

var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

var contentString = '<table cellpadding="0" cellspacing="0" border="0" ><tr><td colspan="3"><?php echo $rs_business['name'];?></td></tr><tr><td colspan="3"><img src="<?php echo $ru."media/".$rs_business['locationid']."/logo/thumb/".$rs_business['logo'];?>" title="<?php $_SESSION['edit_cust']['cust_title'];?>" alt="" width="150" hight="10" border="0" /></td></tr><tr><td> HereTime Rating</td><td>staring</td><td>parcantage</td></tr><tr><td>Map Rating</td><td>staring</td><td>parcantage</td></tr><tr><td>Address</td><td class="2"><?php echo $rs_business['address'];?></td></tr><tr><td >Phone No:</td><td colspan="2"><?php echo $rs_business['phone'];?></td></tr></table>';

var infowindow = new google.maps.InfoWindow({
    content: contentString
});

var marker = new google.maps.Marker({
    position: myLatlng,
    map: map,
    title:"<?php echo $rs_business['name'];?>",
	icon:'<?php echo $ru;?>images/marker/moscout-icon.png',
	draggable:true
});

google.maps.event.addListener(marker, 'click', function() {
  infowindow.open(map,marker);
});
}
	</script>

</head>

<body onload="initialize()">
<div id="map_canvas" style=" width:600px; height:400px;"> </div>

</body>
</html>
