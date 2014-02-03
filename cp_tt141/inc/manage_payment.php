<?php 
	if( isset ( $_POST['Submit'] ))
	{
	
		$paypal = 	trim($_POST['paypal']);
		$live = 	$_POST['live'];
		if($paypal!='')	{
			$qry_config= "update tt_settings set paypal = '".$paypal."',	live = 	'".$live."'" ;
			mysql_query($qry_config) or die ( mysql_error());
			$_SESSION['statuss'] = "Paypal settings updated successfuly "; 
			header('location:'.$ruadmin.'home.php?p=manage_payment');
			exit;
	   }
	   else
	   {
	   		$_SESSION['statuss'] = "Please enter valid Paypal ID"; 
			header('location:'.$ruadmin.'home.php?p=manage_payment');
			exit;
	   }
	}

	$qry_config="SELECT paypal ,live FROM tt_settings";
	$rs_config = mysql_query($qry_config) or die ( mysql_error());
	$row_config = mysql_fetch_array($rs_config);
	
	$paypal = 	$row_config['paypal'];
	$live = 	$row_config['live'];
?>
<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Package Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>PayPal Payments Settings</h3>
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
<form action="<?php echo $ruadmin; ?>home.php?p=manage_payment" method="post">
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
  	<td> PayPal ID:&nbsp;<input type="text" name="paypal" id="paypal" size="35"  value="<?php echo $paypal ?>" class="text-input" /> </td>
  </tr>
  <tr>
  	<td>
  	  <input type="radio" id="live1" value="1"  name="live"  <?php if( $live == 1 ) echo ' checked="checked" ' ?>  />Payment Mode Live<br />
	  <input type="radio" id="live0" value="0"  name="live"  <?php if( $live == 0 ) echo ' checked="checked" ' ?>/>Payment Mode Test
  	  </td>
  </tr>
 
  <tr>
    <td align="left"  style="padding-left:10px;">      <input type="submit" class="button" name="Submit" value="Update" /></td>
  </tr>
</table>
</form>
	</div>
</div>	