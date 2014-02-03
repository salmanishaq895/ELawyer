<?php 
ob_start();
require_once("../connect/connect.php");
include ('security.php');
if ( isset ($_GET['p']) )
{
	$content =  $_GET['p'].".php";
	if (!file_exists('inc/'.$content))	
	{
		$content =  'dashboard.php';
		$_GET['p'] ='';
	}
}
else
{
	$content =  'dashboard.php';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Admin Panel</title>
<link rel="shortcut icon" href="<?php echo $ru ?>favicon.ico"/>
<link rel="icon" href="<?php echo $ru ?>favicon.ico" />
<!--                       CSS                       -->
<!-- Reset Stylesheet -->
<link rel="stylesheet" href="resources/css/reset.css" type="text/css" media="screen" />

<!-- Main Stylesheet -->
<link rel="stylesheet" href="resources/css/style.css" type="text/css" media="screen" />

<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
<link rel="stylesheet" href="resources/css/invalid.css" type="text/css" media="screen" />	


<!-- Internet Explorer Fixes Stylesheet -->
<!--[if lte IE 7]>
	<link rel="stylesheet" href="resources/css/ie.css" type="text/css" media="screen" />
<![endif]-->
<!-- Javascripts -->

<!-- jQuery -->
<script type="text/javascript" src="resources/scripts/jquery-1.3.2.min.js"></script>

<!-- jQuery Configuration -->
<script type="text/javascript" src="resources/scripts/simpla.jquery.configuration.js"></script>

<!-- Facebox jQuery Plugin -->
<script type="text/javascript" src="resources/scripts/facebox.js"></script>

<!-- jQuery WYSIWYG Plugin -->
<script type="text/javascript" src="resources/scripts/jquery.wysiwyg.js"></script>

<script type="text/javascript" src="<?php  echo ru; ?>js/functions.js"></script>


<!-- Internet Explorer .png-fix -->

<!--[if IE 6]>
	<script type="text/javascript" src="resources/scripts/DD_belatedPNG_0.0.7a.js"></script>
	<script type="text/javascript">
		DD_belatedPNG.fix('.png_bg, img, li');
	</script>
<![endif]-->

<script type="text/javascript" src="../js/ajax.js"></script>
<?php 
if ( in_array( $_GET['p'], array( 'user_advertiser_manage','user_advertiser_edit','user_export', 'manage_package_banner' ,'user_advertiser_add','banner_log_manage','banner_manage_image','banner_manage_text','banner_manage_image2','banner_payment_log') ) ){
	$advertiser_class = ' current ';
}
if ( in_array( $_GET['p'], array( 'user_trade_manage','user_custom_manage','user_edit','user_trade_edit','user_custom_edit','user_export', 'businessowners' ,'user_add_trade','user_add_custom') ) ){
	$user_class = ' current ';
}

if ( in_array( $_GET['p'], array( 'business','business_edit', 'review_edit', 'review', 'datafeed','viewbusiness','business_add','addbusiness','editbusiness' ,'business_edit_step2' ,'business_edit_step3','business_reference','business_claim','payment_log','report_review') ) ){
	$Business_class = ' current ';
}


if ( in_array( $_GET['p'], array( 'jobmanage','addjob','editjob' ) ) ){
	$jobmanage_class = ' current ';
}



if ( in_array( $_GET['p'], array( 'cmspages','articles','seo','faq_group_list','faq_list','faq_list_add' , 'cmstippages' , 'cmshome',  'cmscalculator', 'faq_group_add', 'cmspages_help_n_tips', 'cmsreferences','swear','add_swear','home_video') ) ){
	$cmspages_class = ' current ';
}

if ( in_array( $_GET['p'], array('advise_and_tip','new_advise_and_tip','edit_advise','artical','new_advise_and_tip_artical','edit_artical','advise_tip') ) ){
	$advise_and_tip_class = ' current ';
}

if ( in_array( $_GET['p'], array( 'categories' , 'add_new_category' , 'subcategory') ) ){
	$managecategories_class = ' current ';
}

if ( in_array( $_GET['p'], array( 'managecities','managestate','managecity') ) ){
	$location_class = ' current ';
}

if ( in_array( $_GET['p'], array( 'emails_bulk_customer','templateslist','newslettersmanage','emails_alert' ,'emails_bulk_trader','newsletter','emails_bulk_advertiser' ) ) ){
	$emailsalert_class = ' current ';
}

if ( in_array( $_GET['p'], array( 'manage_payment','analytics' ,'manage_package','manage_payment','cmstippages','manage_image') ) ){
	$settings_class = ' current ';
}

if ( in_array( $_GET['p'], array( 'user_edit') ) ){
	$editprofile_class = ' current ';
}
if ( in_array( $_GET['p'], array( 'ads_management') ) ){
	$ads_class = ' current ';
}


$$_GET['p'] = ' class="current" ';	

if ( in_array( $_GET['p'], array( 'profilesettings'  ) ) ){
		    $profilesettings_class = ' current ';
}
if (!isset($_GET['p'])){
    $homeclass = ' current ';
}
?>
</head>
<body>
<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
		
		<div id="sidebar">
		<div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
			
			<h1 id="sidebar-title"><a href="#">Admin Panel</a></h1>
		  
			<!-- Logo (221px wide) -->
			<a href="home.php"><img id="logo" src="images/circle-thumbnail.png" alt="Admin Panel LocalBusinessLocators"  width="200" height="50" /></a>
		  
			<!-- Sidebar Profile links -->
			<div id="profile-links">
            
				Hello,<a href="<?php echo $ruadmin; ?>home.php?p=user_edit&userId=<?php echo $_SESSION['cp_tt']['userId'] ?>" title="Edit your profile"><?php echo $_SESSION['cp_tt']['firstname']; ?></a>,Logged in as Admin
                
				<br />
				<a href="<?php echo $ru; ?>" title="View the Site">View the Site</a> | <a href="logout.php" title="Sign Out">Sign Out</a>			</div>        
			
			<ul id="main-nav">  <!-- Accordion Menu -->
				<li>
					<a href="<?php  echo $ru ?>cp_tt141/home.php" class="nav-top-item <?php  echo $homeclass ?> ">Dashboard</a>
				</li>
				<li> 
					<a href="<?php echo $ruadmin; ?>home.php?p=user_manage"   class="nav-top-item  <?php  echo $user_class ?>">
                        Advocate Management</a>
					<ul>
						
						<li><a href="<?php echo $ruadmin; ?>home.php?p=user_custom_manage" <?php echo $user_custom_manage ?>>Advocate Management</a></li>						
					</ul>
				</li>
				
				
				
              
		
                <li>
					<a href="<?php echo $ruadmin; ?>home.php?p=profilesettings" title="Edit your profile" class="nav-top-item <?php  echo $profilesettings_class ?>">My Profile</a>    
					<ul>
			        	<li><a href="<?php echo $ruadmin; ?>home.php?p=profilesettings"  <?php  echo $profilesettings ?>>Edit my profile</a></li>					
					</ul>					   
				</li>
                 
			</ul> <!-- End #main-nav -->
		</div>
		</div> 
		<!-- End #sidebar -->
        <div id="main-content-top">
           <ul class="shortcut-buttons-set">
                    
                    <li><a class="shortcut-button new-article" href="home.php"><span class="png_bg">
                        Stats
                    </span></a></li>
                    
                    
                    <li><a class="shortcut-button upload-image" href="<?php echo $ruadmin; ?>home.php?p=profilesettings"><span class="png_bg">
                        Advocate
                    </span></a></li>
                    
                    
          </ul>
        </div>
                
		<div id="main-content"> <!-- Main Content Section with everything -->
            <noscript> <!-- Show a notification if the user has disabled javascript -->
				<div class="notification error png_bg">
					<div>
						Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.					</div>
				</div>
			</noscript>
			
			<!-- Page Head -->
			<!-- End .shortcut-buttons-set -->
			
			<div class="clear"></div> <!-- End .clear -->

        	<?php  include('inc/'.$content); ?>
		    <!-- // #wrapper -->
   
			<div id="footer">
				<small>
						&#169; Copyright <?php echo date('Y');?> adocate.com  | Powered by <a href="http://www.uvt.com">UVT</a> | <a href="#">Top</a>
				</small>
			</div><!-- End #footer -->
			
		</div> <!-- End #main-content -->

</div>
</body>
</html><?php ob_end_flush(); ?>