<div class="main_quote_bar_b" style="margin-top:13px;">
  <div class="brued_crum_bar brued_crum_bar_c">
    <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Home</a> > <a href="<?php echo $ru;?>confirm_quotes" style="text-decoration:none; color:#999999;"> <span class="change">Quotes</span></a></span> </div>
  </div>
 
  
  <div class="profile_page_left">
    <div class="company_detail_description"> <span class="company_detail_span">Please Check Your Email</span>
		<div style="font-size:14px; margin:10px 0 10px 40px;">
        Your Quick Quotes Request is <span style="color:#FF0000;"> not yet live!</span> <br /> 
        To get quotes,you now to need to <span style="color:#FF0000;"> Click on the activation link</span> in the email we have sent to your email<br />
		if you didn't get the email or are have the problems, please <a href="<?php echo $ru;?>help"> click here </a>
      </div>
    </div>
  </div>
 
</div>
<?php 
unset($_SESSION['user_con_err']);
unset($_SESSION['confirm']);
unset($_SESSION['userId']);
?>