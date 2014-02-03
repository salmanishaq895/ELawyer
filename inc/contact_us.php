<div class="main_quote_bar_b">
<div class="map_page_right_bar" style="width:auto;">
  <div class="brued_crum_bar brued_crum_bar_c">
    <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Home</a> > <a href="<?php echo $ru;?>contact_us" style="text-decoration:none; color:#999999;"><span class="change">Contant us</span></a></span> </div>
  </div>
  <form name="form1" id="form1" method="post" action="<?php echo $ru;?>process/process_contact.php?p=sent" enctype="multipart/form-data">
  <div class="profile_page_left">
    <div class="company_detail_description"> <span class="company_detail_span">Contact us</span>
		<?php if ( isset ($_SESSION['user_con_err']['sent']) ) {?>
      <div class="notification error png_bg">
        <div style="margin-left:172px;"> <?php echo $_SESSION['user_con_err']['sent']; ?> </div>
      </div>
      <?php } ?>
	
      <div class="input_flied">
        <div>Your Name <samp>* </samp></div>
        <input name="username" type="text" value="<?php if($_SESSION['contact']['username']=='') echo 'Your Name' ; else echo  $_SESSION['contact']['username'];?>" onfocus="if(this.value==this.defaultValue){this.value=''}" 
                        onblur="if(this.value==''){this.value=this.defaultValue}" border="0" />
      </div>
	  <?php if ($_SESSION['user_con_err']['username'] ) {?>
            <div class="error" style="margin-left:125px;">
              <?php  echo $_SESSION['user_con_err']['username'];?>
            </div>
            <?php } ?>
      <div class="input_flied">
        <div>Email Address <samp>* </samp></div>
        <input name="email" type="text" value="<?php if($_SESSION['contact']['email']=='') echo 'Email Address' ; else echo  $_SESSION['contact']['email'];?>" onfocus="if(this.value==this.defaultValue){this.value=''}" 
                        onblur="if(this.value==''){this.value=this.defaultValue}" border="0" />
      </div>
	  <?php if ($_SESSION['user_con_err']['email'] ) {?>
            <div class="error" style="margin-left:125px;">
              <?php  echo $_SESSION['user_con_err']['email'];?>
            </div>
            <?php } ?>
      <div class="input_flied">
        <div>Your Subject <samp>* </samp></div>
        <input name="Subject" type="text" value="<?php if($_SESSION['contact']['Subject']=='') echo 'Subject' ; else echo  $_SESSION['contact']['Subject'];?>" onfocus="if(this.value==this.defaultValue){this.value=''}" 
                        onblur="if(this.value==''){this.value=this.defaultValue}" border="0" />
      </div>
	  <?php if ($_SESSION['user_con_err']['Subject'] ) {?>
            <div class="error" style="margin-left:125px;">
              <?php  echo $_SESSION['user_con_err']['Subject'];?>
            </div>
            <?php } ?>
      <div class="input_flied">
        <div>Your Message <samp>* </samp></div>
        <textarea name="Message" cols="" rows="" onfocus="if(this.value==this.defaultValue){this.value=''}" onblur="if(this.value==''){this.value=this.defaultValue}"><?php if($_SESSION['contact']['Message']=='') echo 'Message' ; else echo  $_SESSION['contact']['Message'];?></textarea>
      </div>
      <div class="captacha_bar">
        <p>Please type the text shown below :</p>
        <div class="captacha_img_bar_outer"> <img src="<?php echo $ru;?>common/CaptchaSecurityImages.php?width=191&height=40&character=5" style="border: 1px dotted #808080" /> </div>
        <div class="captacha_input_outer_bar">
          <input name="pincode" type="text" value="" border="0" />
          <p>Case Sensitive</p>
		  <?php if ($_SESSION['user_con_err']['recaptcha_response_field'] ) {?>
			<div class="error" >
			  <?php  echo $_SESSION['user_con_err']['recaptcha_response_field'];?>
			</div>
			<?php } ?>
          <div class="contact_us_send_botton_outer contact_us_send_botton_outer_b">
            <div class="contact_us_gray_botton_inner">
			  <input type="submit" name="contactus_sbt" value="Send Your Messsage" class="inner_gray_botton" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </form>
</div>
<?php //include("common/page-left.php"); ?>
</div>
<?php 
unset($_SESSION['user_con_err']);
unset($_SESSION['contact']);
?>