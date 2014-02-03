
<?php 
echo $_SESSION['redirectPage']; 

?>
<div class="main_quote_bar_b" style="margin-top:13px;">
  <div class="brued_crum_bar brued_crum_bar_c">
    <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Home</a> > <span class="change">Quotes</span></span> </div>
  </div>
  <form name="form1" id="form1" method="post" action="<?php echo $ru;?>process/process_quotes.php?p=second" enctype="multipart/form-data">
  
  
  <input type="hidden" name="userId" value="<?php echo $_GET['s'];?>"  />
  
  <div class="profile_page_left">
    <div class="company_detail_description"> <span class="company_detail_span">Your Contact Detail</span>
		<?php if ( isset ($_SESSION['user_con_err']['sent']) ) {?>
      <div class="notification error png_bg">
        <div style="margin-left:172px;"> <?php echo $_SESSION['user_con_err']['sent']; ?> </div>
      </div>
      <?php } ?>
	
  
	<div class="input_flied">
        <div>Your Full Name</div>
        <input name="name" type="text" value="<?php if($_SESSION['contact']['name']=='') echo 'Your Full Name' ; else echo  $_SESSION['contact']['name'];?>"  />
      </div>
	  
	  
	  
	  <div class="input_flied">
        <div>Email Address</div>
        <input name="email" type="text" value="<?php if($_SESSION['contact']['email']=='') echo 'Email Address' ; else echo  $_SESSION['contact']['email'];?>"  />
      </div>
	  
	  
	  
	  <div class="input_flied">
        <div>Choose Password</div>
        <input name="password" type="password" />
      </div>
	  
	  
	  
	  
	  <div class="input_flied">
        <div>Confirm Password</div>
        <input name="cpassword" type="password" />
      </div>
	  
	  
	
	  
	  <div class="input_flied">
        <div>Prefer Contact Method:</div>
        <input type="radio" checked="checked" name="contact_method" id="contact_method_email" value="Email" /><label for="contact_method_email">Email</label>
		<input type="radio" name="contact_method" id="contact_method_tel" value="Telephone" /><label for="contact_method_tel">Telephone</label>
		<input type="radio" name="contact_method" id="contact_method_either" value="Either" /><label for="contact_method_either">Either</label>
      </div>
	  
	   <div class="input_flied">
        <div>Your Phone Number:</div>
        <input name="phone" type="text" />
      </div>
	  
        
        
          <div class="contact_us_send_botton_outer contact_us_send_botton_outer_b">
            <div class="contact_us_gray_botton_inner" style="margin:0 0 0 332px;">
			  <input type="submit" name="contactus_sbt" value="Next" class="inner_gray_botton" />
            </div>
          </div>
        
      
    </div>
  </div>
  </form>
</div>
<?php 
unset($_SESSION['user_con_err']);
unset($_SESSION['contact']);
?>