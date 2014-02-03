<?php  
if (isset ($_GET['s']) and $_GET['s'] != 'y')
{
	$_SESSION['redirect']['page'] = trim($_GET['s'] );
	$_SESSION['redirect']['pagedata'] =	trim($_GET['o']);
}
if( isset($_SERVER['HTTP_REFERER']) and ($_SERVER['HTTP_REFERER'] != $ru.'signin') and ($_SERVER['HTTP_REFERER'] != $ru.'accountactivated') and (strpos($_SERVER['HTTP_REFERER'],$ru) !== false) and ($_GET['s'] == 'y') ){
	$_SESSION['redirectPage'] = $_SERVER['HTTP_REFERER'];
}
?>
<div class="main_quote_bar_b">
	<div class="map_page_right_bar" style="width:auto;">
	  <div class="brued_crum_bar brued_crum_bar_c">
		<div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Home</a> >  <a href="<?php echo $ru;?>signin" style="text-decoration:none; color:#999999;"> <span class="change">Sign In</span> </a></span>
		</div>
	  </div>
	  <div class="profile_page_left">
		<?php if ( isset ($_SESSION['user_con_err']['sent']) ) {?>
		<div class="notification error png_bg">
		  <div style="margin-left:172px;"> <?php echo $_SESSION['user_con_err']['sent']; ?> </div>
		</div>
		<?php } 
		if($_SESSION['quote_save_data']){
		?>
		<div class="notification error png_bg">
		  <div style="margin:24px 0 0 140px;">You need to customer signin/signup to complet job post process</div>
		</div>
		<?php 
		}
		?>
		<form method="post" action="<?php echo $ru; ?>process/process_signin.php">
		  <?php if (isset ($_GET['s']) and $_GET['s'] != 'y'){ ?>
		  <input type="hidden" name="page" value="<?php echo trim($_GET['s']) ?>"  />
		  <?php } ?>
		  <?php if (isset ($_GET['o'] )){ ?>
		  <input type="hidden" name="pageData" value="<?php echo trim($_GET['o']) ?>"  />
		  <?php } ?>
		  <?php if (isset ($_GET['p'] )){ ?>
		  <input type="hidden" name="pageOption" value="<?php echo trim($_GET['p']) ?>"  />
		  <?php } ?>
		  	<div class="company_detail_description"> <span class="company_detail_span">Sign In</span>
			<?php if(isset($_SESSION["login"]["error"])){?>
			<div class="message" style="margin-top:10px; margin-left:125px;"> <?php echo $_SESSION["login"]["error"]; unset($_SESSION["login"]); ?> </div>
			<?php 
				}
				?>
			<div align="left" style="margin-top: 20px; font-family:Arial, Helvetica, sans-serif; padding-left:120px; float:left;"> Please provide your email below to reset your password. or <a href="<?php echo $ru; ?>signup.php" style="color:#7B0099;">Signup</a> </div>
			<div class="input_flied">
			  <div>Email <samp>* </samp></div>
			  <input name="loginEmail" type="text" value="" border="0" />
			</div>
			<div class="input_flied">
			  <div>Password <samp>* </samp></div>
			  <input name="password" type="password" value="" border="0" />
			</div>
			
			<div class="captacha_bar">
				<div class="contact_us_send_botton_outer contact_us_send_botton_outer_b">
				  <div class="contact_us_gray_botton_inner">
					<input type="submit" id="signUpButton" value="Login" class="inner_gray_botton"/>
				 </div>
			  </div>
			</div>
			<input type="hidden" name="login" value="yes" />
			<?php if(isset($_GET['s']) and $_GET['s'] != 'y'){?>
			<input type="hidden" name="bussId" id="bussId" value="<?php echo $_GET['s']; ?>" />
			<?php }?>
			<input type="hidden" name="retpage" value="signin" />
			<div style="width:300px; float:left; margin:20px 0 20px 120px;" > <a href="<?php echo $ru."retrive_password"; ?>" class="txt" style="color:#7B0099; font-family:Arial, Helvetica, sans-serif;" >Forgot your password?</a> </div>
		  </div>
		</form>
	  </div>
	</div>
<?php //include("common/page-left.php"); ?>
</div>
<?php 
unset($_SESSION['user_con_err']);
unset($_SESSION['contact']);
?>
