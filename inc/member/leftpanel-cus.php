<?php 
$looged_user_id = $_SESSION['TTLOGINDATA']['USERID'];

$msg_count_qry = "select * from tt_messages where  `to` = '".$looged_user_id."'  and `to_viewed` = '0' ";
$exe_msg_count = @mysql_query($msg_count_qry);
$unread_count = @mysql_num_rows($exe_msg_count);

?>
<div class="map_page_left_bar listing_left_bar">
  <div class="map_page_left_bar_top"></div>
  <div class="map_page_left_bar_mid">
    <div class="listing_wrapper_left"> <span class="cpanel_page_left_bar">Customer Control Panel</span> </div>
    <div class="cpanel_listing_ourter">
      <div class="cpanel_listing_inner <?php echo $profile_sel; ?>">
        <div class="cpanel_listing_inner_img"></div>
        <samp><a href="<?php echo $ru;?>member.php" >Manage Profile</a></samp> </div>
      	
		
		
		<div class="cpanel_listing_inner">
        	<div class="cpanel_listing_inner_img"></div>
        	<samp><a href="<?php echo $ru; ?>cases.php">Manage Cases</a></samp>
		</div>
		
	  <?php /*<div class="cpanel_listing_inner <?php echo $message; ?>">
        <div class="cpanel_listing_inner_img"></div>
        <samp><a href="<?php echo $ru; ?>member/messages">Messages</a></samp> </div> */?>
	
      <div class="cpanel_listing_inner <?php echo $invite_sel; ?>">
        
      <div class="cpanel_listing_inner <?php echo $changepass_sel; ?>">
        <div class="cpanel_listing_inner_img"></div>
        <samp><a href="<?php echo $ru; ?>member/change_pass.php">Change password</a></samp>
	  </div>
	  
      <div class="cpanel_listing_inner">
        
      <div class="cpanel_listing_inner">
        <div class="cpanel_listing_inner_img"></div>
        <samp><a href="<?php echo $ru;?>logout.php">Logout</a></samp>
	  </div>
    </div>
  </div>
  <div class="map_page_left_bar_last"></div>
</div>

