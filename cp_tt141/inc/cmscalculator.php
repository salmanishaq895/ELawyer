<?php  

	$SQL_cmscal = "SELECT * FROM tt_calculator_settings WHERE id  = 1";
	$cmscal		= $db->get_row($SQL_cmscal, ARRAY_A);	
?>
<h3><a href="<?php echo $ruadmin; ?>home.php?p=user_manage">Rate Calculator Content Management</a> &raquo; <a href="#" class="active">Add New User</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Rate Calculator  Content Management</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
  <?php if ( isset ($_SESSION['cms_cal_err']) ) {?>
		<div class="notification error png_bg">
			<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
			<div>
				<?php echo $_SESSION['cms_cal_err'] ; ?>
			</div>
		</div>	
  <?php } unset ($_SESSION['cms_cal_err']); ?>
	<div id="main">
		<form  method="post" action="<?php echo $ruadmin; ?>process/process_cmscalculator.php">
			<fieldset>
				<p><label>Rate Calculator Description Text:</label><textarea name="description1" id="description1" rows="4" cols="72" type="text"><?php echo $cmscal['description1'];  ?></textarea></p>
				<p style="width:100%"  ><input type="submit" class="button" value="&nbsp;&nbsp;&nbsp;Update&nbsp;&nbsp;&nbsp;" name="updatecms" id="submit" />                </p>
			</fieldset>
		</form>
		</div>
	</div>
</div>