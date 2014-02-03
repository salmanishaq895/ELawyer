<?php 
if($page=='profile' || $page == 'map_location'){
//echo $s; exit;
	if($page == 'map_location'){
		$locationid = $o;
		//echo $locationid; exit;
		$business_query= "select * from tt_business ";
		//where locationid = $locationid 		
	}else{
		$arr = explode('_',$_REQUEST['s']);
		$locationid = $arr[0];
		//echo $locationid; exit;
		$business_query= "select * from tt_business where status = 1  and locationid = $locationid"; 
	}
	//$rs_business   = $db->get_results($business_query, ARRAY_A);
	$rs_business = mysql_query($business_query);
	if(!$rs_business){
		header('location: '.$ru); exit;
	}

}
	

$qrySEO="select * from `tt_seo` where page like '". $page ."'";
$rsSEO=$db->get_row($qrySEO, ARRAY_A);
	
if($rsSEO){
	$pageTitle =$rsSEO['pagetitle'];
	$seoTitle =$rsSEO['title'];
	$seoKeywords =$rsSEO['keywords'];
	$seoDescription =$rsSEO['description'];
	if($page=='listings'){
		if($s==''){
			$keywrods = "";
		}else{
			$keywrods = str_replace("_"," ",$s);
		}
		if($p=='' || $p=='all'){
			$locations = "";
		}else{
			$locations = str_replace("_"," ",$p);
		}
		if($o=='' || $o=='all'){
			$locations = "";
		}else{
			$locations .= ' '.str_replace("_"," ",$o);
		}
		if($locations=='') $locations = "Australia";
			$pageTitle = str_replace('[search_keyword]',$keywrods,$pageTitle);
			$seoTitle = str_replace('[search_keyword]',$keywrods,$seoTitle);
			$seoKeywords = str_replace('[search_keyword]',$keywrods,$seoKeywords);
			$seoDescription = str_replace('[search_keyword]',$keywrods,$seoDescription);
				
			$pageTitle = str_replace('[Location]',$locations,$pageTitle);
			$seoTitle = str_replace('[Location]',$locations,$seoTitle);
			$seoKeywords = str_replace('[Location]',$locations,$seoKeywords);
			$seoDescription = str_replace('[Location]',$locations,$seoDescription);			
		}
		if($page=='profile'){
			$companyname = $rs_business['name'];
			$companylocation = $rs_business['city'].', '.$rs_business['state'].' '.$rs_business['zip'];
			
			$pageTitle = str_replace('[Company_Name]',$companyname,$pageTitle);
			$seoTitle = str_replace('[Company_Name]',$companyname,$seoTitle);
			$seoKeywords = str_replace('[Company_Name]',$companyname,$seoKeywords);
			$seoDescription = str_replace('[Company_Name]',$companyname,$seoDescription);
			
			$pageTitle = str_replace('[Company_Location]',$companylocation,$pageTitle);
			$seoTitle = str_replace('[Company_Location]',$companylocation,$seoTitle);
			$seoKeywords = str_replace('[Company_Location]',$companylocation,$seoKeywords);
			$seoDescription = str_replace('[Company_Location]',$companylocation,$seoDescription);			
		}
		if($page=='categories' || $page=='companies' ){
			if($s==''){
				$keywrods = "All";
			}else{
				$keywrods = str_replace("_"," ",$s);
			}
								
			$pageTitle = str_replace('[search_keyword]',$keywrods,$pageTitle);
			$seoTitle = str_replace('[search_keyword]',$keywrods,$seoTitle);
			$seoKeywords = str_replace('[search_keyword]',$keywrods,$seoKeywords);
			$seoDescription = str_replace('[search_keyword]',$keywrods,$seoDescription);			
		}
	}
	if($seoTitle=='') $seoTitle = 'Trades Tool directory | Find local trades people';
	if($seoKeywords=='') $seoKeywords = 'Trades Tool, directory, Top, briding, Companies';
	if($seoDescription=='') $seoDescription =  'Find the best England Trades company at tradestool.com. Trades Tool directory lists Top trades Companies  offering the lowest Rates & Quotes';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $seoTitle; ?></title>
<script>
	var ru = '<?php echo $ru; ?>';
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="<?php echo $seoDescription?>" />
<meta name="keywords" content="<?php echo $seoKeywords;  ?>" />
<meta name="google-site-verification" content="mIP1L8KPKalx5PevbmSzmXy-KvLCZNujABEK15_X8so" />
<link href="<?php echo $ru ;?>css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="<?php echo $ru?>js/jquery.js" ></script>
<script language="javascript" type="text/javascript" src="<?php echo $ru?>js/jqueryui.js" ></script>


	<link href="<?php echo $ru;?>facebox/facebox.css" media="screen" rel="stylesheet" type="text/css" />
	<script src="<?php echo $ru;?>facebox/facebox.js" type="text/javascript"></script>
<link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" />

	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>


<script type="text/javascript">
    //<![CDATA[
    // this variable will collect the html which will eventually be placed in the side_bar 
    //var side_bar_html = ""; 

	var gmarkers = [];
	var gicons = [];
	var map = null;
	
	var infowindow = new google.maps.InfoWindow(
	{ 
		size: new google.maps.Size(150,50)
	});
	gicons["red"] = new google.maps.MarkerImage("<?php echo $ru;?>images/marker_open.png",
	// This marker is 20 pixels wide by 34 pixels tall.
	new google.maps.Size(20, 34),
	// The origin for this image is 0,0.
	new google.maps.Point(0,0),
	// The anchor for this image is at 9,34.
	new google.maps.Point(9, 34));
	// Marker sizes are expressed as a Size of X,Y
	// where the origin of the image (0,0) is located
	// in the top left of the image.
	
	// Origins, anchor positions and coordinates of the marker
	// increase in the X direction to the right and in
	// the Y direction down.

	var iconImage = new google.maps.MarkerImage('<?php echo $ru;?>images/marker_open.png',
    // This marker is 20 pixels wide by 34 pixels tall.
	new google.maps.Size(20, 34),
	// The origin for this image is 0,0.
	new google.maps.Point(0,0),
	// The anchor for this image is at 9,34.
	new google.maps.Point(9, 34));
	var iconShadow = new google.maps.MarkerImage('http://www.google.com/mapfiles/shadow50.png',
	// The shadow image is larger in the horizontal dimension
	// while the position and offset are the same as for the main image.
	new google.maps.Size(37, 34),
	new google.maps.Point(0,0),
	new google.maps.Point(9, 34));
	// Shapes define the clickable region of the icon.
	// The type defines an HTML &lt;area&gt; element 'poly' which
	// traces out a polygon as a series of X,Y points. The final
	// coordinate closes the poly by connecting to the first
	// coordinate.
  var iconShape = {
      coord: [9,0,6,1,4,2,2,4,0,8,0,12,1,14,2,16,5,19,7,23,8,26,9,30,9,34,11,34,11,30,12,26,13,24,14,21,16,18,18,16,20,12,20,8,18,4,16,2,15,1,13,0],
      type: 'poly'
  };

function getMarkerImage(iconColor) {
   if ((typeof(iconColor)=="undefined") || (iconColor==null)) { 
      iconColor = "red"; 
   }
   if (!gicons[iconColor]) {
      gicons[iconColor] = new google.maps.MarkerImage("<?php echo $ru;?>images/marker_"+ iconColor +".png",
      // This marker is 20 pixels wide by 34 pixels tall.
      new google.maps.Size(24, 36),
      // The origin for this image is 0,0.
      new google.maps.Point(0,0),
      // The anchor for this image is at 6,20.
      new google.maps.Point(9, 34));
   } 
   return gicons[iconColor];

}

function category2color(category) {
   var color = "red";
   switch(category) {
     case "close": color = "close";
                break;
     case "open":    color = "open";
                break;
     case "featured":    color = "featured";
                break;
     default:   color = "red";
                break;
   }
   return color;
}

gicons["close"] = getMarkerImage(category2color("close"));
gicons["open"] = getMarkerImage(category2color("open"));
gicons["featured"] = getMarkerImage(category2color("featured"));

// A function to create the marker and set up the event window
function createMarker(latlng,name,html,category,bounds) {
    var contentString = html;
    var marker = new google.maps.Marker({
        position: latlng,
        icon: gicons[category],
        shadow: iconShadow,
        map: map,
        title: name,
        zIndex: Math.round(latlng.lat()*-100000)<<5
    });
	bounds.extend(latlng);
    map.fitBounds(bounds);
    // === Store the category and name info as a marker properties ===
    marker.mycategory = category;                                 
    marker.myname = name;
    gmarkers.push(marker);

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(contentString); 
        infowindow.open(map,marker);
    });
}

// == shows all markers of a particular category, and ensures the checkbox is checked ==
function myclick(i) {
	google.maps.event.trigger(gmarkers[i],"click");
}


function initialize() {
	var myOptions = {
		zoom: 5,
		center: new google.maps.LatLng(40.7834345,-73.9662495),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	google.maps.event.addListener(map, 'click', function() {
		infowindow.close();
	});
// Read the data
downloadUrl("<?php echo $ru;?>commom/map_marker.php", function(doc) {
	var xml = xmlParse(doc);
	var markers = xml.documentElement.getElementsByTagName("marker");
	var bounds = new google.maps.LatLngBounds();
	for (var i = 0; i < markers.length; i++) {
		// obtain the attribues of each marker
		var lat = parseFloat(markers[i].getAttribute("lat"));
		var lng = parseFloat(markers[i].getAttribute("lng"));
		var point = new google.maps.LatLng(lat,lng);
		var address = markers[i].getAttribute("address");
		var name = markers[i].getAttribute("name");
		
		var phoneNumber  = markers[i].getAttribute("phoneNumber");
		
		
		// **************************************** this code is used for the 00 time show
		/*if(openingTiming==0)
		{
		document.write(openingTiming); return false;
		openingTiming = document.write(00);
		}*/
		
		//  ***************************************** the 00 time end
		var html='<ul class="markerhtml">';
		html += '<li class="title"><a href="<?php echo $ru; ?>profile/' + markers[i].getAttribute("name") + '">'+name+'</a></li>';
		html += '<li>Address: '+address+'</li>';
		html += '<li>Phone Number: '+phoneNumber+'</li>';
		// create the marker
		var marker = createMarker(point,name,html);
	}

	
  });
}

    // This Javascript is based on code provided by the
    // Community Church Javascript Team
    // http://www.bisphamchurch.org.uk/   
    // http://econym.org.uk/gmap/
    // from the v2 tutorial page at:
    // http://econym.org.uk/gmap/example_categories.htm
    //]]>
    </script>


</head>
<body onload="<?php echo $initialize; ?>">
<div class="header_wrapper">
  <div class="header_wrapper_inner_bar">
    <h4> 100% totally FREE for TRADESPEOPLE, <span>Get a full profile and no monthly cost</span></h4>
    <div class="learn_more_button_bar">
      <div class="learn_more_button"> <span><a href="<?php echo $ru; ?>help">Learn More</a></span> <img src="<?php echo $ru; ?>images/learn_more_img.png" border="0" /> </div>
      <img src="<?php echo $ru; ?>images/learn_more_outer_img.png"  /> </div>
  </div>
  <div class="facelinks_outer_bar">
    <div class="facelinks_inner_bar">
      <div class="login_button_outer_bar">
        <?php 
			if($_SESSION['TTLOGINDATA']['ISLOGIN']){
			?>
        <div class="login_button"> <span><?php echo "Welcome ".$_SESSION['TTLOGINDATA']['NAME'].' '.$_SESSION['TTLOGINDATA']['LNAME']; ?> | <a href="<?php echo $ru; ?>member">My Account</a> | <a href="<?php echo $ru; ?>logout">Logout</a></span> </div>
        <?php
			}else{
			?>
        <div class="login_button"> <span><a href="<?php echo $ru ?>signin">Login ></a></span> </div>
        <?php
			}
			?>
        <div class="icon_bar"> <a href="#"><img src="<?php echo $ru; ?>images/facebook_icon.jpg"/></a> <a href="#"><img src="<?php echo $ru; ?>images/twitter_icon.jpg"/></a> <a href="#" ><img src="<?php echo $ru; ?>images/rss_icon.jpg"  /></a> <a href="#" ><img src="<?php echo $ru; ?>images/email_icon.jpg"/></a> </div>
      </div>
    </div>
  </div>
</div>
<div class="main_body_wrapper">
<div class="main_body_inner_wrapper">
