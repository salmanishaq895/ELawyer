<?php 
$sql_profile	=	"select * from tt_user where userId='".$_SESSION['TTLOGINDATA']['USERID']."'";
$result	=	$db->get_row($sql_profile,ARRAY_A);
?>
<div class="map_page_right_bar listing_right_bar">
  <div class="brued_crum_bar brued_crum_bar_c">
    <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Home</a> > <?php if($_SESSION['TTLOGINDATA']['TYPE']=='t') {?><a href="<?php echo $ru;?>member/statistics" style=" text-decoration:none; color:#999999;">Account Panel></a> <?php }else{?> <a href="<?php echo $ru;?>member/profile" style=" text-decoration:none; color:#999999;">Account Panel></a><?php }?>  <a href="<?php echo $ru;?>member/change_pass" style="text-decoration:none; color:#999999;"> <span class="change">Change password</span> </a></span></div>
  </div>
  <form name="form1" id="form1" method="post" action="<?php echo $ru;?>process/process_signup.php" enctype="multipart/form-data" >
    <input type="hidden" name="userId" value="<?php echo $result['userId'];?>" />
    <div class="cpanel_right_bar">
    <div class="company_detail_description"> <span class="company_detail_span">Change password</span>
      <div class="cpanel_right_inner_bar_a">
        <?php if ( isset ($_SESSION['update_passsword']) ) {?>
        	<div class="notification error png_bg" style="margin:15px 0 15px 90px;"><?php echo $_SESSION['update_passsword'];?></div>
        <?php } unset ($_SESSION['update_passsword']); ?>
		
		<div class="input_flied">
          <div>Current Password <samp>* </samp></div>
          <input name="currentpassword" type="password"  border="0" class="text-password"/>
        </div>
		<?php if ($_SESSION['user_reg_err']['currentpassword']) {?>
		<div class="error" style="margin-left:145px;">
		  <?php  echo $_SESSION['user_reg_err']['currentpassword'];?>
		</div>
		<?php } ?>
        <div class="input_flied">
          <div>New Password <samp>* </samp></div>
          <input name="newpassword" type="password"  border="0" class="text-password"/>
        </div>
		<?php if ($_SESSION['user_reg_err']['newpassword']) {?>
		<div class="error" style="margin-left:145px;">
		  <?php  echo $_SESSION['user_reg_err']['newpassword'];?>
		</div>
		<?php } ?>
        <div class="input_flied">
          <div>Confirm Password <samp>* </samp></div>
          <input name="confirmpassword" type="password" class="text-password" border="0" />
        </div>
		<?php if ($_SESSION['user_reg_err']['confirmpassword']) {?>
		<div class="error" style="margin-left:145px;">
		  <?php  echo $_SESSION['user_reg_err']['confirmpassword'];?>
		</div>
		<?php } ?>
        <div class="profile_botton_outer">
          <div class="contact_us_gray_botton_inner cpanel_right_botton_button">
            <input type="submit" name="update_passsword" id="update" value="Submit" class="inner_gray_botton" />
          </div>
        </div>
      </div>
    </div>
	</div>
</form>
</div>
<?php 
unset($_SESSION['user_reg_err']);
?>