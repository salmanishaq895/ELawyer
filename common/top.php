<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Crime Management System</title>
<script>
	var ru = '<?php echo $ru; ?>';
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="Crime Management System" />
<meta name="keywords" content="Crime Management System" />


<link href="<?php echo $ru ;?>css/style.css" rel="stylesheet" type="text/css" />

<link href="<?php echo $ru ;?>css/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css"  />
<script type="text/javascript" src="<?php echo $ru ;?>js/jquery-1.6.2.min.js"> </script>
<script type="text/javascript" src="<?php echo $ru ;?>js/jquery-ui-1.8.16.custom.min.js"> </script>
<script type="text/javascript" src="<?php echo $ru ;?>js/jquery.easing.1.3.js"> </script>
<script type="text/javascript" src="<?php echo $ru ;?>js/jquery.mousewheel.min.js"> </script>

<!--<script type="text/javascript">var switchTo5x=false;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "bf5e80ed-46ff-462c-8921-f55d5df759af"}); </script>-->

<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "d998c890-ac69-4ccb-b94f-bcb8b7f6b847"}); </script>



<script language="javascript" type="text/javascript" src="<?php echo $ru?>js/jquery.js" ></script>
<script language="javascript" type="text/javascript" src="<?php echo $ru?>js/jqueryui.js" ></script>
<link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<link href="<?php echo $ru;?>facebox/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="<?php echo $ru;?>facebox/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
var map;
</script>


</head>
<body <?php echo $onload; ?>>
<?php //if(in_array( $page,array('') )){?>
<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js#appId=121377744618272&amp;xfbml=1"></script>
<?php //} ?>
<?php 
if(!isset($_COOKIE['TT_show_wrapper'])){ ?>
<div class="header_wrapper">
  <div class="header_wrapper_inner_bar">
    <h4> 100% totally FREE for TRADESPEOPLE, <span>Get a full profile and no monthly cost</span></h4>
    <div class="learn_more_button_bar">
      <img src="<?php echo $ru; ?>images/learn_more_img.png" border="0" /> </div>
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
		<a href="<?php echo $ru; ?>logout.php">Logout</a></span> </div>
        <?php
			}else{
			?>
        <div class="login_button"> <span><a href="<?php echo $ru; ?>signup.php">Sign Up </a></span><span>|</span><span><a href="<?php echo $ru ?>signin.php">Login ></a></span> </div>
        <?php
			}
			?>
        <div class="icon_bar"> <a href="http://www.facebook.com/"><img src="<?php echo $ru; ?>images/facebook_icon.jpg"/></a> <a href="http:///twitter.com/"><img src="<?php echo $ru; ?>images/twitter_icon.jpg"/></a> 
		
	<!--	<a href="<?php echo $ru;?>rss2.php" ><img src="<?php echo $ru; ?>images/rss_icon.jpg"  /></a> 
	<span class='st_email_hcount' displayText='Email'></span>-->
	<a href="mailto:test@test.com" ><img src="<?php echo $ru; ?>images/email_iconb.jpg"/></a>
		
		 </div>
      </div>
    </div>
  </div>
  
<div class="main_body_wrapper">
<div class="main_body_inner_wrapper">
