<?php 
	$userId = '1';
	$User_sql    = "SELECT * FROM tt_user where userId =$userId";
	
	$User_rs = mysql_query($User_sql) or die (mysql_error());
	if ( mysql_num_rows($User_rs) ==0 ){
		
		header('location:'.$ruadmin.'home.php');
		exit;
	}
	
	if ( !isset ($_SESSION['user_update']) or ($_SESSION['user_update']['userId'] != $userId ) )
	{
		$User_row = mysql_fetch_array($User_rs);
		$_SESSION['user_update'] =$User_row;
		$_SESSION['user_update']['cpassword'] =$_SESSION['user_update']['password'];
	}

?>
<h3><a href="home.php">Home</a> &raquo; <a href="#" class="active">Edit My Profile</a></h3>
	<div class="content-box">
		<div class="content-box-header">
		<h3>My Profile settings</h3>
		<div class="clear"></div>
		</div>
	<div class="content-box-content">                    
	<?php if ( isset($_SESSION['user_update_err']) ) { ?>
		<div class="notification error png_bg">
		<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
		<div>
		<?php foreach ($_SESSION['user_update_err'] as $ek=>$ev ) echo $ev ."<br />"; ?>
		</div>
		</div>
	<?php }
	unset ($_SESSION['user_update_err']); ?>
		<div id="main">
			<form  method="post" action="<?php echo $ruadmin;?>process/process_user.php">
				<input type="hidden" name="userId" id="userId" value="1"  />
				<fieldset>
				<p><label>First Name:&nbsp;&nbsp;</label><input name="firstname" id="firstname" type="text" class="text-input small-input"  value="<?php echo $_SESSION['user_update']['firstname']; ?>"/></p>
				<p><label>Last Name:</label><input name="lastname" id="lastname" type="text" class="text-input small-input"  value="<?php echo $_SESSION['user_update']['lastname']; ?>"/></p>
				<p><label>Password:</label><input name="password" id="password" type="password" class="text-input small-input" value="" /></p>
				<p><label>Confirm Password:</label><input name="cpassword" id="cpassword" type="password" class="text-input small-input" value="" /></p>
				<p><label>Email:</label><input name="email" id="email" type="text" class="text-input small-input" value="<?php echo $_SESSION['user_update']['email']; ?>" /></p>
				<!--<p><label>Phone:(000) 000-0000</label><input type="text" name="phone" id="phone" class="text-input small-input" value="<?php echo $_SESSION['user_update']['phone']; ?>" onchange="validatePhone(this)"/></p>
				<p><label>Address:</label><input name="address" id="address" type="text" class="text-input medium-input" value="<?php echo $_SESSION['user_update']['address']; ?>" /></p>
				<p><label>State:</label>
				<select name="state" id="state">
					<?php foreach($StateAbArray as $short){	?>
					<option value="<?php echo $short; ?>" <?php if($_SESSION['user_update']['state'] == $short) echo 'selected="selected"'; ?>><?php echo $short; ?></option>
					<?php }	?>
				</select>								
				</p>
				<p><label>City:</label><input name="city" id="city" type="text" class="text-input small-input" value="<?php echo $_SESSION['user_update']['city']; ?>" /></p>
				<p><label>Zip code:</label><input name="zip" id="zip" type="text" class="text-input small-input" maxlength="5" value="<?php echo $_SESSION['user_update']['zip']; ?>" /></p>
-->				<?php if($_SESSION['cp_tt']['userId']!= $userId ) { ?>
				<p><label>Status:</label>
				<select name="status" id="status">
					<option value="Active" <?php if( $_SESSION['user_update']['status'] == 'Active'){ ?> selected="selected" <?php } ?>>Active</option>
					<option value="Pending" <?php if( $_SESSION['user_update']['status'] == 'Pending'){ ?> selected="selected" <?php } ?>>Pending</option>
					<option value="Inactive" <?php if( $_SESSION['user_update']['status'] == 'Inactive'){ ?> selected="selected" <?php } ?>>Inactive</option>								
				</select>
				</p>                       
				<?php } ?>
				<input type="hidden" value="a"  name="type" id="type" />
				<p style="width:100%">
				<input type="submit" class="button" value="&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;" name="UpdateMember" id="UpdateMember" />
				</p>
				</fieldset>
			</form>
		</div>
	</div>
	</div>	     
        
        