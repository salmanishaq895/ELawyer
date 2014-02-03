<?php 
if($page=='member' and $_GET['s'] == 'messages'){
	include("common/messages-top.php");
}
if($page=='profile' || $page=='more_review'){
	$arr = explode('_',$_REQUEST['s']);
	$locationid = $arr[0];
			
	if($_GET['o'] == 'preview' and $_SESSION['TTLOGINDATA']['ISLOGIN'] == 'yes'){
		$where = " WHERE `userId` = ' " . $_SESSION['TTLOGINDATA']['USERID'] . "'";
	}else{
		$where = ' WHERE status = 1 ';
	}
	$business_query= "SELECT * FROM tt_business $where AND locationid = '$locationid' ";
	$rs_business   = $db->get_row($business_query, ARRAY_A);
	if(!$rs_business){
		header('location: '.$ru); exit;
	}
}
if($page == 'map_location' || $page == 'listings'){
	$qrystring = " WHERE status = 1 AND name <> '' ";
	if($_GET['s'] == 'category'){
		$arr = explode('_',$_REQUEST['o']);
		$catId = $arr[0];
		$qrystring .= " AND (`mcatid` = '$catId' or `scatids` like ',%$catId%,')";
	}else{
		$keyword = str_replace("_"," ",$_GET['s']);
		$cityZip =  str_replace("_"," ",$_GET['o']);
		if($keyword!='' && $keyword!= 'all'){
			$qrystring .= " AND name LIKE '%$keyword%' OR ( industry LIKE '%$keyword%' OR subcat LIKE '%$keyword%' OR keywords LIKE '%$keyword%') ";
		}
	}
	if($cityZip!='' && $cityZip != 'all'){
		$qrystring .= " AND ( city =  '$cityZip' OR zip = '$cityZip' )";
		$radius = (int)$_GET['p'];
		if( isset($radius) and $radius > 2){
			$qry_lat = "SELECT * FROM `tt_zipcodes` WHERE `city` = '$cityZip' OR `postcode` = '".$cityZip."' OR `postcode` = '" . str_replace(' ','',$cityZip) . "' LIMIT 1";
			$lat = $rs_loc['latitude'];
			$long = $rs_loc['longitude'];
			if($lat!='' && $long!=''){
				$qrystring .= " AND ( 6371 * acos( cos( radians( {$lat} ) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians( {$long} ) ) 
					+ sin( radians( {$lat} ) ) * sin( radians( latitude ) ) ) ) <= {$radius} ";
			}
		}
	}
	$sqlcount = "SELECT count(locationid) FROM `tt_business` $qrystring ";
	//echo $sqlcount;exit;
	$qrycounts = mysql_query($sqlcount);
	$rowcounts = mysql_fetch_array($qrycounts);
	$total_pages = $rowcounts[0];
	$business_query = "SELECT locationid, name, latitude, longitude, address, city, state, zip, phone, industry, subcat, email, website, logo, btype, description,video_embed,
	 				keywords FROM tt_business $qrystring ORDER BY btype DESC"; //exit;
	///////////////////////////////////////////////////////////////////////////////////////
	include("common/pagingprocess_listing.php");
	///////////////////////////////////////////////////////////////////////////////////////
	$business_query .=  " LIMIT ".$start.",".$limit;
	//echo $business_query; exit;
	$rs_business = $db->get_results($business_query, ARRAY_A);
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
		if($locations=='') $locations = "UK";
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
			$companyname = $rs_business['meta_title'];
			
			$seoTitle = $rs_business['meta_title'];
			$seoDescription = $rs_business['meta_description'];
			$seoKeywords = $rs_business['keywords'];
			
			/*$companylocation = $rs_business['city'].', '.$rs_business['state'].' '.$rs_business['zip'];
			$pageTitle = str_replace('[Company_Name]',$companyname,$pageTitle);
			$seoTitle = str_replace('[Company_Name]',$companyname,$rs_business['meta_title']);
			$seoDescription = str_replace('[Company_Name]',$companyname,$seoDescription);
			$seoKeywords = str_replace('[Company_Name]',$companyname,$seoKeywords);
			
			$pageTitle = str_replace('[Company_Location]',$companylocation,$pageTitle);
			$seoTitle = str_replace('[Company_Location]',$companylocation,$seoTitle);
			$seoKeywords = str_replace('[Company_Location]',$companylocation,$seoKeywords);
			$seoDescription = str_replace('[Company_Location]',$companylocation,$seoDescription);*/
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

<link href="<?php echo $ru ;?>css/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css"  />
<script type="text/javascript" src="<?php echo $ru ;?>js/jquery-1.6.2.min.js"> </script>
<script type="text/javascript" src="<?php echo $ru ;?>js/jquery-ui-1.8.16.custom.min.js"> </script>
<script type="text/javascript" src="<?php echo $ru ;?>js/jquery.easing.1.3.js"> </script>
<script type="text/javascript" src="<?php echo $ru ;?>js/jquery.mousewheel.min.js"> </script>
<script type="text/javascript" src="<?php echo $ru ;?>js/js.js"> </script>

<script language="javascript" type="text/javascript" src="<?php echo $ru?>js/jquery.js" ></script>
<script language="javascript" type="text/javascript" src="<?php echo $ru?>js/jqueryui.js" ></script>
<link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<link href="<?php echo $ru;?>facebox/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="<?php echo $ru;?>facebox/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
var map;
</script>
<?php /*<script type="text/javascript">
		 function load_company_info(paramval,paramval2){
			//alert(test);
			jQuery.facebox('<iframe FRAMEBORDER="0" height="400px" width="1024px"  src="<?php echo $ru ?>reference_website/'+paramval+'/'+paramval2+'" ></iframe>');
			}
			
		  var DataPoints = [];
		  var gmarkers = [];
		  var gInfowindow = [];
			
		  var geocoder;
		  var map;
		  var address;
			
		  function initialize() {
		  alert("mehran");
			  
			address =  "<?php echo(addslashes(stripslashes($rs_business['address']))).', '.$rs_business['city'].', '. $rs_business['state'].', '.$rs_business['zip'];?>";
			var bName =  "<?php echo addslashes(stripslashes($rs_business['name']));?>";
			
			
				var latlng = new google.maps.LatLng('<?php echo $rs_business['latitude'] ?>', '<?php echo $rs_business['longitude']?>');
				var myOptions = {
				  zoom: 15,
				  center: latlng,
				  mapTypeId: google.maps.MapTypeId.ROADMAP,
				  // streetViewControl: true // enable this for street view
				}
				map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
				
				var infowindow = new google.maps.InfoWindow({
					content: '<b>'+bName +'</b><br>'+address
				});
				var marker = new google.maps.Marker({
					position: latlng,
					map: map
				});
			//	marker.setIcon( ru + 'images/smallspot.gif');
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.close();
				  infowindow.open(map,marker);
				});
			 
			
		  }
		
		  
	</script> */?>
<?php 
if($page == 'map_location'){

?>

<script language="JavaScript" type="text/javascript">


var arrMapData = [
<?php 
foreach($rs_business as $rr)
{
$i=0;
?>
['<div><a href="<?php echo $ru."profile/".$rr['locationid']."_".encodeURL(stripslashes($rr['name']));?>"><?php echo $rs_business['name']?></a><br /><?php echo $rr['address']?><br /><?php echo $rr['phone']?><br /><?php echo $rs_business['name']?><br /><br /><div style="margin-top:5px;margin-bottom:5px;"><img src="/fx/star_45.gif" border="0" width="73" height="13" alt="Rating of 4.8" /><font size="-2"> 107 reviews</font></div><a class="u" href="<?php echo $ru."help"?>">More Info</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="u" href="javascript:DisplayFloatForm(\'writereview\',\'67735\');">Write Review</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="u" href="javascript:DisplayFloatForm(\'enquiry\',\'67735\');">Email</a></div>',<?php echo $rr['latitude'];?>,<?php echo $rr['longitude'];?>, <?php echo $rs_business['locationid'];?>], 
<?php }?>
];
</script>


<?php

//echo "dfsd".$rs_business['latitude']; exit;
$onload = "onload='LoadCatMap(true)'";

}

if($page=='listings')
{
?>


<script type="text/javascript"> 
	var markers;
	var gmarkers = [];
	function initialize() {
		// Create the map 
		// No need to specify zoom and center as we fit the map further down.
		var map = new google.maps.Map(document.getElementById("map_canvas"), {
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			streetViewControl: false
		});
	
		// Create the shared infowindow with two DIV placeholders
		// One for a text string, the other for the StreetView panorama.
		var content = document.createElement("DIV");
		var title = document.createElement("DIV");
		content.appendChild(title);
		var streetview = document.createElement("DIV");
		streetview.style.width = "150px";
		streetview.style.height = "50px";
		content.appendChild(streetview);
		var infowindow = new google.maps.InfoWindow({
			content: content
		});
		// Define the list of markers.
		// This could be generated server-side with a script creating the array.
		 markers = [
		 <?php
		// echo "<pre>";print_r($rs_business); exit;
		 if(count($rs_business)>0){
			$i=0;
		 foreach($rs_business as $res){
			if($res['latitude']!='' and $res['latitude'] != '0'){
			$image = $ru.'images/marker/moscout-icon.png';
			//$image = $ru.'images/marker/pointer0.png';
		  //echo $image; exit;
		?> 
		 { lat: <?php echo $res['latitude'];?>, lng:<?php echo $res['longitude'];?>, name: "<?php echo $res['name'];?>", html: '<table cellpadding="0" cellspacing="0" border="0" ><tr><td colspan="3"><a href="<?php echo $ru;?>profile/<?php echo $res['locationid']."_".encodeURL(stripslashes($res['name']));?>" style="color:#3f3f3f; " ><?php echo $res['name'];?></a></td></tr><tr><td colspan="3"><img src="<?php echo $ru."media/".$res['locationid']."/logo/thumb/".$res['logo'];?>" title="<?php $_SESSION['edit_cust']['cust_title'];?>" alt="" width="150" hight="10" border="0" /></td></tr><tr><td> HereTime Rating</td><td>staring</td><td>parcantage</td></tr><tr><td>Map Rating</td><td>staring</td><td>parcantage</td></tr><tr><td>Address</td><td class="2"><?php echo $res['address'];?></td></tr><tr><td >Phone No:</td><td colspan="2"><?php echo $res['phone'];?></td></tr></table>', icon: '<?php echo $image; ?>' },<?php //if($i == 0) echo ',';?>
		 <?php 
			$i++;
			}
		 }
		 }
		 ?>
		];
	
	 
	
		for (index in markers) addMarker(markers[index]);
		function addMarker(data) {
			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(data.lat, data.lng),
				map: map,
				icon: data.icon,
				title: data.name
			});
			google.maps.event.addListener(marker, "click", function() {
				openInfoWindow(marker,data.html);
			});
			gmarkers.push(marker);
		}
		
		
		 
/*
function myclick(i) {
		 google.maps.event.addListener(marker, "click", function() {
				infowindow.open(map, marker);
				});
				//openInfoWindow(marker,data.html);
       //GEvent.trigger(gmarkers[i],"click");
		//openInfoWindow(marker,data.html);
      }
	*/			
				
				
				
				
      // == rebuilds the sidebar to match the markers currently displayed ==
      //function makeSidebar() {
        /*var html = "";
		//alert(html);
        for (var i=0; i<gmarkers.length; i++) {
          //alert(gmarkers);
		  //if (!gmarkers[i].isHidden()) {
            html += '<img src="<?php echo $ru;?>images/marker/pointer' +i + '.png"/><br>';
			//alert(html);
         // }
		  var dd= document.getElementById("side_bar'+i+'").innerHTML = html;
        alert(dd);
		}
      
     // }
		
		google.maps.event.addListener(dd, "click", function() {
				openInfoWindow(marker,data.html);
			});*/
		
		
		
		var bounds = new google.maps.LatLngBounds();
		for (index in markers) {
			var data = markers[index];
			bounds.extend(new google.maps.LatLng(data.lat, data.lng));
		}
		map.fitBounds(bounds);
	
		function openInfoWindow(marker,html) {
			title.innerHTML = html;
			infowindow.open(map, marker);
		}
	}
</script>


<?php 
$onload = 'onload="initialize()"';

}
if($page=='profile' or $page=='more_review')
{
?>
<script>
<?php /*
function LoadMap(g_lat, g_lon, zoom, bShowControls) {
    var centreLatLng = new google.maps.LatLng(g_lat, g_lon);

    // Decide which navigation control to display
    var navigationControlOptions = { style: google.maps.NavigationControlStyle.SMALL };
    if (bShowControls == false) {
        navigationControlOptions.style = '';
    }

    // Add control options
    var arrMapTypes = new Array();
    arrMapTypes.push(google.maps.MapTypeId.ROADMAP);
    arrMapTypes.push(google.maps.MapTypeId.SATELLITE);
    arrMapTypes.push(google.maps.MapTypeId.HYBRID);

    var mapTypeControlOptions = { mapTypeIds: arrMapTypes };

    // Set the main options for the map
    var myOptions = {
        zoom: zoom,
        center: centreLatLng,
        scrollwheel: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControlOptions: mapTypeControlOptions,
        navigationControlOptions: navigationControlOptions
    };
    if (bShowControls == false) {
        myOptions.disableDefaultUI = true;
        myOptions.draggable = false;
        myOptions.disableDoubleClickZoom = true;
    }
	var objGMap = new google.maps.Map(getObj("map-convas"), myOptions);
	// Poistion a standard marker and add to the main map object
	var marker = new google.maps.Marker({
        position: centreLatLng,
        map: objGMap
    });
}
function getObj(n, d) {
    var p, i, x;
    if (!d) {
        d = document;
    }
    if ((p = n.indexOf("?")) > 0 && parent.frames.length) {
        d = parent.frames[n.substring(p + 1)].document;
        n = n.substring(0, p);
    }
    if (!(x = d[n]) && d.all) {
        x = d.all[n];
    }
    for (i = 0; !x && i < d.forms.length; i++) {
        x = d.forms[i][n];
    }
    for (i = 0; !x && d.layers && i < d.layers.length; i++) {
        x = getObj(n, d.layers[i].document);
    }
    if (!x && d.getElementById) {
        x = d.getElementById(n);
    }
    return x;
}
*/?>
function initialize(){
	<?php if($rs_business['latitude'] != '' and $rs_business['latitude'] != '0' and $rs_business['longitude'] != '' and $rs_business['longitude'] != '0'){ ?>
	var myLatlng = new google.maps.LatLng(<?php echo $rs_business['latitude'];?>,<?php echo $rs_business['longitude'];?>);
	<?php }else{ ?>
	var myLatlng = new google.maps.LatLng(-25.363882,131.044922);
	<?php 
	}
	?>
	var myOptions = {
		zoom: 13,
		center: myLatlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		streetViewControl: true
	}
	var map = new google.maps.Map(document.getElementById("map-convas"), myOptions);
	var contentString = '<table cellpadding="0" cellspacing="0" border="0" ><tr><td colspan="2"><?php echo $rs_business['name'];?></td></tr><tr><td>Address</td><td ><?php echo $rs_business['address'];?></td></tr><tr><td >Phone No:</td><td ><?php echo $rs_business['phone'];?></td></tr></table>';
	var infowindow = new google.maps.InfoWindow({
		content: contentString
	});

	var marker = new google.maps.Marker({
		position: myLatlng,
		map: map,
		title:"<?php echo $rs_business['name'];?>",
		//draggable: true,
		icon:'<?php echo $ru;?>images/marker/moscout-icon.png'
	});
	google.maps.event.addListener(marker, 'click', function() {
	  infowindow.open(map,marker);
	});
}
</script>
<?php
	/*if($rs_business['latitude'] != '' and $rs_business['latitude'] != '0' and $rs_business['longitude'] != '' and $rs_business['longitude'] != '0')
		$onload = 'onload="LoadMap('.$rs_business['latitude'].','.$rs_business['longitude'].',13,true);"';
	else
		$onload = 'onload="LoadMap(-25.363882,131.044922,13,true);"';*/
	$onload = 'onload="initialize();"';
}
 ?>

</head>
<body <?php echo $onload; ?>>
<?php if(in_array( $page,array('') )){?>
<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js#appId=121377744618272&amp;xfbml=1"></script>
<?php } ?>
<?php 
if(!isset($_COOKIE['TT_show_wrapper'])){ ?>
<div class="header_wrapper">
  <div class="header_wrapper_inner_bar">
    <h4> 100% totally FREE for TRADESPEOPLE, <span>Get a full profile and no monthly cost</span></h4>
    <div class="learn_more_button_bar">
      <div class="learn_more_button"> <span><a href="<?php echo $ru; ?>help">Learn More</a></span> <img src="<?php echo $ru; ?>images/learn_more_img.png" border="0" /> </div>
      <img src="<?php echo $ru; ?>images/learn_more_outer_img.png" style="cursor:pointer;" onclick="setCookie('TT_show_wrapper','yes',365);$('.header_wrapper').slideUp('slow');" /> </div>
  </div>
</div>
<script>
function setCookie(c_name,value,exdays)
{
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString())+"; path=/";
	document.cookie=c_name + "=" + c_value;
}
</script>
<?php } ?>
<div class="facelinks_outer_bar">
    <div class="facelinks_inner_bar">
      <div class="login_button_outer_bar">
        <?php 
			if($_SESSION['TTLOGINDATA']['ISLOGIN']){
			?>
        <div class="login_button"> <span><?php echo "Welcome ".$_SESSION['TTLOGINDATA']['NAME'].' '.$_SESSION['TTLOGINDATA']['LNAME']; ?> | 
		<?php /*<a href="<?php echo $ru; ?>member">My Account</a> | */?>
		<a href="<?php echo $ru; ?>logout">Logout</a></span> </div>
        <?php
			}else{
			?>
        <div class="login_button"> <span><a href="<?php echo $ru; ?>signup">Sign Up </a></span><span>|</span><span><a href="<?php echo $ru ?>signin">Login ></a></span> </div>
        <?php
			}
			?>
        <div class="icon_bar"> <a href="#"><img src="<?php echo $ru; ?>images/facebook_icon.jpg"/></a> <a href="#"><img src="<?php echo $ru; ?>images/twitter_icon.jpg"/></a> <a href="#" ><img src="<?php echo $ru; ?>images/rss_icon.jpg"  /></a> <a href="#" ><img src="<?php echo $ru; ?>images/email_icon.jpg"/></a> </div>
      </div>
    </div>
  </div>
  
<div class="main_body_wrapper">
<div class="main_body_inner_wrapper">
