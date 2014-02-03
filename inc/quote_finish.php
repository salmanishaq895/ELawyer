<div class="main_quote_bar_b" style="margin-top:13px;">
  <div class="brued_crum_bar brued_crum_bar_c">
    <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Home</a> ><span class="change">Get Quotes</span></span> </div>
  </div>
  <?php
  if($_GET['s'] == 'singup'){
  ?>
  <div class="profile_page_left">
    <div class="company_detail_description"> <span class="company_detail_span">
	<div style="border-bottom:1px solid #999999; width:875px;"> 
	Please check your email</div></span>
	  <div style="font-size:14px; margin:50px 0 10px 40px; line-height:38px;">
        Your Quick Quotes Request is <span style="color:#FF0000;"> not yet live!</span> <br /> 
        To get quotes,you now to need to <span style="color:#FF0000;"> Click on the activation link</span> in the email we have sent to your email<br />
		if you didn't get the email or are have the problems, please <a href="<?php echo $ru;?>help">click here </a>
      </div>
    </div>
  </div>
<?php  }else{ ?>
<div class="profile_page_left">
    <div class="company_detail_description"> <span class="company_detail_span">
	<div style="border-bottom:1px solid #999999; width:875px;">
	Thanks!
	</div>
	</span>
		
	  <div style="font-size:14px; margin:50px 0 10px 40px; line-height:38px;">
        your job is posted successfully <br /> 
      You will get the quote of our top rated and nearest trade people shortly.
      </div>
    </div>
  </div>
<?php } ?>
</div>
<?php 
unset($_SESSION['user_con_err']);
unset($_SESSION['contact']);
?>