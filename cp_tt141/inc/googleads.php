<?php
if( isset ( $_POST['Submit'] ))
{
	$x728x90 =  stripslashes($_POST['x728x90'] );
	file_put_contents('../googleads728x90.php',$x728x90);

	$x160x600 =  stripslashes($_POST['x160x600'] );
	file_put_contents('../googleadsx160x600.php',$x160x600);

	$x468x60 =  stripslashes($_POST['x468x60'] );
	file_put_contents('../googleads1468x60.php',$x468x60);

	$_SESSION['statuss'] = "Manage google ads  - Updated Successfuly "; 
	header('location:'.$ruadmin.'home.php?p=googleads');
	exit;
}	
?>
<h3><a href="<?php echo $ruadmin; ?>home.php?p=business">Business</a> &raquo; <a href="#" class="active">Manage Googls Ads</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Manage Googls Ads</h3>
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
		<form method="post" action="<?php echo $ruadmin; ?>home.php?p=googleads">
			<table border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td><strong>Image ads above footer(728x90)</strong> </td>
			  </tr>
			  <tr>
				<td><textarea rows="8" cols="80" name="x728x90" id="x728x90"><?php if(file_exists('../googleads728x90.php')) echo file_get_contents('../googleads728x90.php');  ?></textarea></td>
			  </tr>

			  <tr>
				<td><strong>Image ads banner at right side(160x600)</strong> </td>
			  </tr>
			  <tr>
				<td><textarea rows="8" cols="80" name="x160x600" id="x160x600"><?php if(file_exists('../googleadsx160x600.php')) echo file_get_contents('../googleadsx160x600.php');  ?></textarea></td>
			  </tr>

			  <tr>
				<td><strong>Text ads at top and bottom at profile page(468x60)</strong> </td>
			  </tr>
			  <tr>
				<td><textarea rows="8" cols="80" name="x468x60" id="x468x60"><?php if(file_exists('../googleads1468x60.php')) echo file_get_contents('../googleads1468x60.php');  ?></textarea></td>
			  </tr>

			  <tr>
				<td><input name="Submit" id="Submit" value="Update" type="submit" class="button" /></td>
			  </tr>
		  	</table>
		</form>
	</div>
</div>												  