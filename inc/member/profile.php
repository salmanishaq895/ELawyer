<?php 

$sql_profile	=	"select * from tt_user where userId='".$_SESSION['TTLOGINDATA']['USERID']."'";

$result	=	$db->get_row($sql_profile,ARRAY_A);



?>
<div class="map_page_right_bar listing_right_bar">
  <div class="brued_crum_bar brued_crum_bar_c">
    <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Home</a> > <?php if($_SESSION['TTLOGINDATA']['TYPE']=='c') {?><a href="<?php echo $ru;?>member/statistics" style=" text-decoration:none; color:#999999;">Account Panel></a> <?php }else{?> <a href="<?php echo $ru;?>member/profile" style=" text-decoration:none; color:#999999;">Account Panel></a><?php }?> <a href="<?php echo $ru;?>member/profile" style="text-decoration:none; color:#999999;"> <span class="change"> Profile</span> </a></span></div>
  </div>
  <form name="form1" id="form1" method="post" action="<?php echo $ru;?>process/process_signup.php" enctype="multipart/form-data" >
    <input type="hidden" name="userId" value="<?php echo $result['userId'];?>" />
    <div class="cpanel_right_bar">
    <div class="company_detail_description"> <span class="company_detail_span">Manage Profile</span>
      <div class="cpanel_right_inner_bar_a">
        <?php if( isset($_SESSION['user_update_err']) ) {?>
        <div class="notification error png_bg" style="margin:15px 0; background-color:#E4E4E4"> <a href="javascript:;" onclick="$('.notification').hide();" class="close"><img src="<?php echo $ru;?>images/cross_grey_small.png" title="Close this notification" alt="close" /></a>
          <div>
            <?php echo $_SESSION['update_profile']; //foreach ($_SESSION['user_update_err'] as $ek=>$ev ) echo $ev ."<br />"; ?>
          </div>
        </div>
        <?php } /* unset ($_SESSION['user_update_err']); */ ?>
        <div class="input_flied">
          <div>Your Name <samp>* </samp></div>
          <input name="firstname" type="text" value="<?php echo $result['firstname'];?>" class="text-input" border="0" />
        </div>
		<?php if ($_SESSION['user_reg_err']['firstname'] ) {?>
		<div class="error" style="margin-left:125px;">
		  <?php  echo $_SESSION['user_reg_err']['firstname'];?>
		</div>
		<?php } ?>
		
        <div class="input_flied">
          <div>Last Name <samp>* </samp></div>
          <input name="lastname" type="text" value="<?php echo $result['lastname'];?>" class="text-input"  border="0" />
        </div>
		<?php if ($_SESSION['user_reg_err']['lastname'] ) {?>
            <div class="error" style="margin-left:125px;">
              <?php  echo $_SESSION['user_reg_err']['lastname'];?>
            </div>
        <?php } ?>
		
        <div class="input_flied">
          <div>Email <samp>* </samp></div>
          <input name="email" type="text" value="<?php echo $result['email'];?>"  class="text-input" border="0" />
        </div>
		<?php if ($_SESSION['user_reg_err']['email'] ) {?>
            <div class="error" style="margin-left:125px;">
              <?php  echo $_SESSION['user_reg_err']['email'];?>
            </div>
          <?php } ?>
		
		<div class="input_flied">
          <div>Zip/Postal code <samp>* </samp></div>
          <input name="zip" type="text" value="<?php echo $result['zip'];?>"  class="text-input" border="0" />
        </div>
		<?php if ($_SESSION['user_reg_err']['zip'] ) {?>
            <div class="error" style="margin-left:125px;">
              <?php  echo $_SESSION['user_reg_err']['zip'];?>
            </div>
            <?php } ?>
       
        
        <div class="profile_botton_outer">
          <div class="contact_us_gray_botton_inner cpanel_right_botton_button">
            <input type="submit" name="Update_profile" id="Update_profile" value="Update Profile" class="inner_gray_botton" />
          </div>
        </div>
      </div>
    </div>
	</div>
  </form>
</div>
