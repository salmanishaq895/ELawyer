<script type="text/javascript">
	function submitform(){
	document.getElementById("form1").submit();}
</script>
<div class="main_quote_bar_b">
	<div class="map_page_right_bar" style="width:auto;">
	  <div class="brued_crum_bar brued_crum_bar_c">
		<div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Home</a> > <a href="<?php echo $ru;?>signup" style="text-decoration:none; color:#999999;"> <span class="change">Sign Up</span></a></span> </div>
	  </div>
	  <div class="profile_page_left">
      <?php if ( isset ($_SESSION['user_reg_err']['save']) ) {?>
      <div class="notification error png_bg">
        <div style="margin-left:172px;"> <?php echo $_SESSION['user_reg_err']['save']; ?> </div>
      </div>
      <?php } ?>
      <form name="form1" id="form1" method="post" action="<?php echo $ru;?>process/process_signup.php" enctype="multipart/form-data">
        <input type="hidden" name="User_register" value="1">
		<div class="company_detail_description">
			<span class="company_detail_span">Sign Up</span>
			
			<div class="input_flied">
			  <div>First Name <samp>* </samp></div>
              <input name="fname" id="fname" type="text" value="<?php if($_SESSION['user_reg']['fname']=='') echo 'First Name' ; else echo  $_SESSION['user_reg']['fname'];?>" onblur="if(this.value==''){ this.value = 'First Name'; this.style.color='#333333';}" onfocus="if(this.value=='First Name') {this.value = ''; this.style.color='';}" style="color:#333333;" border="0" />
            </div>
            <?php if ($_SESSION['user_reg_err']['fname'] ) {?>
            <div class="error" style="margin-left:125px;">
              <?php  echo $_SESSION['user_reg_err']['fname'];?>
            </div>
            <?php } ?>
			<div class="input_flied">
			  <div>Last Name <samp>* </samp></div>
              <input name="lname" id="lname" type="text" value="<?php if($_SESSION['user_reg']['lname']=='') echo 'Last Name' ; else echo  $_SESSION['user_reg']['lname'];?>" onblur="if(this.value==''){this.value = 'Last Name';this.style.color='#333333';}" onfocus="if(this.value=='Last Name'){ this.value = ''; this.style.color='';}" style="color:#333333;" border="0" />
            </div>
            <?php if ($_SESSION['user_reg_err']['lname'] ) {?>
            <div class="error" style="margin-left:125px;">
              <?php  echo $_SESSION['user_reg_err']['lname'];?>
            </div>
            <?php } ?>
			<div class="input_flied">
			  <div>Email Address <samp>* </samp></div>
              <input name="email" type="text" value="<?php if($_SESSION['user_reg']['email']=='') echo 'Email Address';else echo $_SESSION['user_reg']['email'] ?>" onblur="if(this.value==''){ this.value = 'Email Address'; this.style.color='#333333';}" onfocus="if(this.value=='Email Address'){ this.value = ''; this.style.color='';}" style="color:#333333;" />
            </div>
            <?php if ($_SESSION['user_reg_err']['email'] ) {?>
            <div class="error" style="margin-left:125px;">
              <?php  echo $_SESSION['user_reg_err']['email'];?>
            </div>
            <?php } ?>
			<div class="input_flied">
			  <div>Zip <samp>* </samp></div>
              <input id="signup-zip" type="text" size="7" name="zip"  value="<?php if($_SESSION['user_reg']['zip']=='')  echo 'Zip Code'; else echo $_SESSION['user_reg']['zip'] ?>" onblur="if(this.value==''){ this.value = 'Zip Code';this.style.color='#333333';}" onfocus="if(this.value=='Zip Code'){ this.value = ''; this.style.color='';}" style="color:#333333;" />
            </div>
            <?php if ($_SESSION['user_reg_err']['zip'] ) {?>
            <div class="error" style="margin-left:125px;">
              <?php  echo $_SESSION['user_reg_err']['zip'];?>
            </div>
            <?php } ?>
				
			<div class="input_flied">
			  <div>Password <samp>* </samp></div>
              <input name="password" type="password"  />
            </div>
            <?php if ($_SESSION['user_reg_err']['password'] ) {?>
            <div class="error" style="margin-left:125px;">
              <?php  echo $_SESSION['user_reg_err']['password'];?>
            </div>
            <?php } ?>
			<div class="input_flied">
			  <div>Retype Password <samp>* </samp></div>
              <input name="cpassword" type="password"  />
            </div>
            <?php if ($_SESSION['user_reg_err']['cpassword'] ) {?>
            <div class="error" style="margin-left:125px;">
              <?php  echo $_SESSION['user_reg_err']['cpassword'];?>
            </div>
            <?php } ?>
			<div class="captacha_bar" style="margin:0 0 0 22%;">
                
			
			 
			 <?php /*?>
			 
			<!--<a id="captcha_refresh" href="javascript:;">--><a style="color:#555555;" href="javascript:;" onclick="document.getElementById('imagess').src = '/securimage/securimage_show.php?' + Math.random(); return false"> <img src="<?php echo $ru;?>images/--icon.png" /></a>
				<script>
				//$('a#captcha_refresh').click(function() { $('#test_class').load('<?php echo $ru;?>common/CaptchaSecurityImages.php?width=191&height=40&character=5'); });
				
				$('a#captcha_refresh').click(function() {
					$.ajax({
					  url: '<?php echo $ru; ?>process/capcha_reload.php',
					  
					  
					  success: function(data) {
					  
					//  alert(data);
					  
					 //$('.test_class').html(data);
					// $('div.test_class').append(data);
					 
					// $("#imagess").attr("src", '');
					 $("#imagess").attr("src", data);
					 
					 	
						
						//$('.captacha_img_bar_outer').html(data);
						//alert('Load was performed.');
					  }
					});
				});
				
				
				</script>
				
				<?php*/ ?>
              <div class="captacha_input_outer_bar">
               
				<div class="contact_us_send_botton_outer contact_us_send_botton_outer_b">
					<div class="contact_us_gray_botton_inner">
                  		<input type="submit" name="signupSubs" value="Sign Up" class="inner_gray_botton" />
                	</div>
              	</div>
            </div>
          </div>
		  </div>
      </form>
    </div>
  </div>
  <?php //include("common/page-left.php"); ?>
</div>
<?php 
unset($_SESSION['user_reg_err']);
unset($_SESSION['user_reg']);
?>
