<?php 
include_once('connect/connect.php');
$page = 'cases';

include($rootpath . 'common/top.php'); 
include($rootpath . 'common/header.php');

?>
<link type="text/css" href="<?php echo $ru; ?>css/member.css" rel="stylesheet" />
<div class="main_quote_bar_b main_quote_bar_c">
<?php

$userId = $_SESSION['TTLOGINDATA']['USERID'];
include($rootpath . 'inc/member/manage_applicants.php'); 
 ?>

 <?php 
if(in_array($mpage,array('profile.php'))){
	$profile_sel = 'cpanel_listing_inner_sel';
}elseif(in_array($mpage,array('manage-buss.php'))){
	$manage_buss_sel = 'cpanel_listing_inner_sel';
}elseif(in_array($mpage,array('applied_job.php')) or in_array($mpage,array('job_messages.php'))){
	$manage_jobs = 'cpanel_listing_inner_sel';
}elseif(in_array($mpage,array('messages.php')) or in_array($mpage,array('messages.php') )  ){
	$message = 'cpanel_listing_inner_sel';
}elseif(in_array($mpage,array('statistics.php'))){
	$statistics = 'cpanel_listing_inner_sel';
}elseif(in_array($mpage,array('add-buss.php'))){
	$add_buss_sel = 'cpanel_listing_inner_sel';
}elseif(in_array($mpage,array('change_pass.php'))){
	$changepass_sel = 'cpanel_listing_inner_sel';
	
	}elseif(in_array($mpage,array('gadget.php'))){
	$gadget_sel = 'cpanel_listing_inner_sel';
	
}elseif( in_array($mpage,array('invite.php')) ){
	$invite_sel = 'cpanel_listing_inner_sel';
}elseif(in_array($mpage, array('manage_jobs.php'))){
	$managejobs = 'cpanel_listing_inner_sel';
}elseif(in_array($mpage, array('trade-profile.php','key-services.php','skills.php','qualifications.php','insurance.php','trader-images.php'))){
	$trad_profile_sel = 'cpanel_listing_inner_sel';
	if($mpage == 'trader-images.php')
		$imges = 'cpanel_listing_inner_sub_sel';
	elseif($mpage == 'key-services.php')
		$key = 'cpanel_listing_inner_sub_sel';
	elseif($mpage == 'skills.php')
		$skills = 'cpanel_listing_inner_sub_sel';
	elseif($mpage == 'qualifications.php')
		$quali = 'cpanel_listing_inner_sub_sel';
	elseif($mpage == 'insurance.php')
		$insurance = 'cpanel_listing_inner_sub_sel';
	else
		$basic = 'cpanel_listing_inner_sub_sel';
}

if($_SESSION['TTLOGINDATA']['TYPE'] == 'c' )
	include('inc/member/leftpanel-cus.php');


?>
</div>
</div>
<?php 

include($rootpath . 'common/footer.php');
?>