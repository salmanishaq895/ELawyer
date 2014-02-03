
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Google Maps JavaScript API Example: Custom Icon</title>
    <script language="javascript" type="text/javascript" src="<?php echo $ru?>js/jquery.js" ></script>
<script language="javascript" type="text/javascript" src="<?php echo $ru?>js/jqueryui.js" ></script>
<link href="<?php echo $ru ;?>css/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css"  />
<script type="text/javascript" src="<?php echo $ru ;?>js/jquery-1.6.2.min.js"> </script>
<script type="text/javascript" src="<?php echo $ru ;?>js/jquery-ui-1.8.16.custom.min.js"> </script>
<script type="text/javascript" src="<?php echo $ru ;?>js/jquery.easing.1.3.js"> </script>
<script type="text/javascript" src="<?php echo $ru ;?>js/jquery.mousewheel.min.js"> </script>


	<link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

    <script type="text/javascript">
    function initialize() {
      //if (GBrowserIsCompatible()) {
       var map = new google.maps.Map(document.getElementById("map-convas"), {
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			streetViewControl: false
		});
map.addControl(new GSmallMapControl());
map.addControl(new GMapTypeControl());
map.setCenter(new GLatLng(37.4419, -122.1419), 13);

// Create a base icon for all of our markers that specifies the
// shadow, icon dimensions, etc.
var baseIcon = new GIcon(G_DEFAULT_ICON);
baseIcon.shadow = "http://www.google.com/mapfiles/shadow50.png";
baseIcon.iconSize = new GSize(20, 34);
baseIcon.shadowSize = new GSize(37, 34);
baseIcon.iconAnchor = new GPoint(9, 34);
baseIcon.infoWindowAnchor = new GPoint(9, 2);

// Creates a marker whose info window displays the letter corresponding
// to the given index.
function createMarker(point, index) {
  // Create a lettered icon for this point using our icon class
  var letter = String.fromCharCode("A".charCodeAt(0) + index);
  var letteredIcon = new GIcon(baseIcon);
  letteredIcon.image = "http://www.google.com/mapfiles/marker" + letter + ".png";

  // Set up our GMarkerOptions object
  markerOptions = { icon:letteredIcon };
  var marker = new GMarker(point, markerOptions);

  GEvent.addListener(marker, "click", function() {
    marker.openInfoWindowHtml("Marker <b>" + letter + "</b>");
  });
  return marker;
}

// Add 10 markers to the map at random locations
var bounds = map.getBounds();
var southWest = bounds.getSouthWest();
var northEast = bounds.getNorthEast();
var lngSpan = northEast.lng() - southWest.lng();
var latSpan = northEast.lat() - southWest.lat();
for (var i = 0; i < 10; i++) {
  var point = new GLatLng(southWest.lat() + latSpan * Math.random(),
                          southWest.lng() + lngSpan * Math.random());
  map.addOverlay(createMarker(point, i));
}
}
//}
    </script>
  </head>
  <body onload="initialize()">
    <div id="map_canvas" style="width: 500px; height: 300px"></div>
  </body>
</html>
