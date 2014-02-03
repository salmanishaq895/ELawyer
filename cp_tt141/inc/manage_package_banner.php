<?php 
	if( isset ( $_POST['Submit'] )){
	
		$amount_text_banner	 = 	trim($_POST['amount_text_banner']);
		$amount_image_banner = 	trim($_POST['amount_image_banner']);
		$amount_image2_banner = trim($_POST['amount_image2_banner']);
		$title				 = 	addslashes(trim($_POST['title']));
				
		if($amount_text_banner!='' && $amount_image_banner!=''){	
		echo $qry_config="update tt_banner_setting set 	amount_text_banner = ".$amount_text_banner.",
												   	amount_image_banner = ".$amount_image_banner." ,
													amount_image2_banner = ".$amount_image2_banner." ,
													title = '".$title."' where id =1 ";
		$qry_config; 
			mysql_query($qry_config) or die ( mysql_error());
			$_SESSION['statuss'] = "Packages updated successfuly "; 
			header('location:home.php?p=manage_package_banner');exit;
		}else{
			$_SESSION['statuss'] = "Please enter valid packages amount "; 
			header('location:home.php?p=manage_package_banner');
			exit;
		}
	}

	$qry_config="SELECT * FROM tt_banner_setting";
	$rs_config = mysql_query($qry_config) or die ( mysql_error());
	$row_config = mysql_fetch_array($rs_config);

	$amount_text_banner 	= 	$row_config['amount_text_banner'];
	$amount_image_banner	= 	$row_config['amount_image_banner'];
	$amount_image2_banner	= 	stripslashes($row_config['amount_image2_banner']);
	$title				 	= 	$row_config['title'];
		
?>
<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Manage Banner Settings</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Manage Banner Settings</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
	<?php if ( isset ($_SESSION['statuss']) ) {?>
		<div class="notification error png_bg">
			<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
			<div>
				<?php echo  $_SESSION['statuss']; unset($_SESSION['statuss']); ?>
			</div>
		</div>	
	<?php } ?>	
	<form action="home.php?p=manage_package_banner" method="post">
		<table width="100%" cellpadding="0" cellspacing="0"> 
			<tr>
				<td> 
				Text based ads banner rate per month:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>$ </strong><input type="text" name="amount_text_banner" id="amount_text_banner" size="4" 
				value="<?php echo $amount_text_banner ?>" class="text-input" />  	  
			</td>
			</tr>
			<tr>
				<td> 
				Top Image based ads banner rate per month:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>$ </strong><input type="text" name="amount_image_banner" id="amount_image_banner" size="4"  
				value="<?php echo $amount_image_banner ?>" class="text-input" />  	  
			</td>
			</tr>
			<tr>
				<td> 
				Bottom Image based ads banner rate per month:&nbsp;&nbsp;
				<strong>$ </strong><input type="text" name="amount_image2_banner" id="amount_image2_banner" size="4"  
				value="<?php echo $amount_image2_banner; ?>" class="text-input" />  	  
			</td>
			</tr>
			<tr>
				<td> 
				Ads Banner Manager Title :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="title" id="title"  value="<?php echo $title; ?>" class="text-input small-input" />  	  
				</td>
			</tr>
			<tr>
				<td align="left"  style="padding-left:120px;"><input type="submit" class="button" name="Submit" value="Update Packages" /></td>
			</tr>
		</table>
	</form>
	</div>
</div>	