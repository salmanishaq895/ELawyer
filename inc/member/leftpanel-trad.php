<?php 
$sql_profile = "select * from `tt_business` where `userId` = '".$_SESSION['TTLOGINDATA']['USERID']."'";
$result	= $db->get_row($sql_profile,ARRAY_A);
$_SESSION['biz_reg'] = $result;

$looged_user_id = $_SESSION['TTLOGINDATA']['USERID'];

$msg_count_qry = "select * from tt_messages where  `to` = '".$looged_user_id."'  and `to_viewed` = '0' ";
$exe_msg_count = @mysql_query($msg_count_qry);
$unread_count = @mysql_num_rows($exe_msg_count);


?>
<script language="javascript" src="<?php echo $ru; ?>js/jquery.lightbox-0.5.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $ru; ?>css/jquery.lightbox-0.5.css" media="screen" />
<script src='<?php echo $ru; ?>js/multi_files/jquery.form.js' type="text/javascript" language="javascript"></script>
<script src='<?php echo $ru; ?>js/multi_files/jquery.MetaData.js' type="text/javascript" language="javascript"></script>
<script src='<?php echo $ru; ?>js/multi_files/jquery.MultiFile.js' type="text/javascript" language="javascript"></script>
<script src='<?php echo $ru; ?>js/multi_files/jquery.blockUI.js' type="text/javascript" language="javascript"></script>

<div class="map_page_left_bar listing_left_bar">
  <div class="map_page_left_bar_top"></div>
  <div class="map_page_left_bar_mid">
    <div class="listing_wrapper_left"> <span class="cpanel_page_left_bar">Trader Control Panel</span> </div>
    <div class="cpanel_listing_ourter">
      <div class="cpanel_listing_inner <?php echo $statistics; ?>">
	  
	  <div class="cpanel_listing_inner_img"></div>
        <samp><a href="<?php echo $ru;?>member/statistics" >Statistic</a></samp> </div>
      <div class="cpanel_listing_inner <?php echo $profile_sel; ?>">
        
	  
        <div class="cpanel_listing_inner_img"></div>
        <samp><a href="<?php echo $ru;?>member/profile" >Manage Profile</a></samp> </div>
      <div class="cpanel_listing_inner <?php echo $trad_profile_sel; ?>">
        <div class="cpanel_listing_inner_img"></div>
        <samp><a href="<?php echo $ru;?>member/trade-profile" >Manage Trader Profile</a></samp>
			<?php if($trad_profile_sel == 'cpanel_listing_inner_sel'){ ?>
			<div class="cpanel_listing_inner_sub <?php echo $basic;?>">
			  <div class="cpanel_listing_inner_img"></div>
			  <samp><a href="<?php echo $ru;?>member/trade-profile">Basic Information</a></samp>
			</div>
			
			<div class="cpanel_listing_inner_sub <?php echo $imges;?>">
			  <div class="cpanel_listing_inner_img"></div>
			  <samp><a href="<?php echo $ru;?>member/trader-images">Traders Images</a></samp>
			</div>
			
			<div class="cpanel_listing_inner_sub <?php echo $key;?>">
			  <div class="cpanel_listing_inner_img"></div>
			  <samp><a href="<?php echo $ru;?>member/key-services">Key Services</a></samp>
			</div>
			<div class="cpanel_listing_inner_sub <?php echo $skills;?>">
			  <div class="cpanel_listing_inner_img"></div>
			  <samp><a href="<?php echo $ru;?>member/skills">Skills</a></samp>
			</div>
			<div class="cpanel_listing_inner_sub <?php echo $quali;?>">
			  <div class="cpanel_listing_inner_img"></div>
			  <samp><a href="<?php echo $ru;?>member/qualifications">Qualifications</a></samp>
			</div>
			<div class="cpanel_listing_inner_sub <?php echo $insurance;?>">
			  <div class="cpanel_listing_inner_img"></div>
			  <samp><a href="<?php echo $ru;?>member/insurance">Insurnace</a></samp>
			</div>
			<?php 
			}
			?>
		
	  </div>
	  
	  <div class="cpanel_listing_inner">
        <div class="cpanel_listing_inner_img"></div>
        <samp><a href="<?php echo $ru ; ?>profile/<?php echo $_SESSION['biz_reg']['locationid'].'_'. encodeURL( stripslashes($_SESSION['biz_reg']['name']) ) ; ?>/preview" style="text-decoration:none;">Preview Profile </a></samp> </div>
      
<div class="cpanel_listing_inner <?php echo $manage_jobs; ?>">
        <div class="cpanel_listing_inner_img"></div>
        <samp>
		
		<?php if($unread_count > 0)
			{
			?>
		
		<a href="<?php echo $ru; ?>member/applied_job">Applied Jobs&nbsp;&nbsp;-&nbsp;Inbox:&nbsp;<?php echo $unread_count; ?>&nbsp;<img style=" float:right; vertical-align:middle"  title="Applicants" src="<?php echo $ru; ?>images/filled.png" /></a>
		
		<?php 
			}else
			{
			?>
			<a href="<?php echo $ru; ?>member/applied_job">Applied Jobs&nbsp;&nbsp;-&nbsp;Inbox:&nbsp;<?php echo $unread_count; ?>&nbsp;<img style=" float:right; vertical-align:middle"  title="Applicants" src="<?php echo $ru; ?>images/empty.png" /></a>
			<?php 
			}
			?>
		
		</samp>
	  </div>
	  
      <!--<div class="cpanel_listing_inner <?php echo $message; ?>">
        <div class="cpanel_listing_inner_img"></div>
        <samp><a href="<?php echo $ru; ?>member/messages">Messages</a></samp>
	  </div>-->
	  
      <div class="cpanel_listing_inner <?php echo $invite_sel; ?>">
        <div class="cpanel_listing_inner_img"></div>
        <samp><a href="<?php echo $ru; ?>member/invite">Invite friends</a></samp>
	  </div>
	  
      <div class="cpanel_listing_inner <?php echo $changepass_sel; ?>">
        <div class="cpanel_listing_inner_img"></div>
        <samp><a href="<?php echo $ru; ?>member/change_pass">Change password</a></samp> </div>
		
		
		<div class="cpanel_listing_inner <?php echo $gadget_sel; ?>">
        <div class="cpanel_listing_inner_img"></div>
        <samp><a href="<?php echo $ru; ?>gadget">Gadget</a></samp> </div>
		
		
      <div class="cpanel_listing_inner">
        <div class="cpanel_listing_inner_img"></div>
        <samp><a href="<?php echo $ru;?>contact_us">Contact us</a></samp> </div>
      <div class="cpanel_listing_inner">
        <div class="cpanel_listing_inner_img"></div>
        <samp><a href="<?php echo $ru;?>logout">Logout</a></samp> </div>
    </div>
  </div>
  <div class="map_page_left_bar_last"></div>
</div>