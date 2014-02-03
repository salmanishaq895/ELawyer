<h3><a href="<?php echo $ruadmin; ?>home.php?p=user_manage">Users</a> &raquo; <a href="#" class="active">Add New Trade User</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Add New Trade User</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
  <?php if ( isset ($_SESSION['user_reg_err']) ) {?>
		<div class="notification error png_bg">
			<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
			<div>
				<?php foreach ($_SESSION['user_reg_err'] as $ek=>$ev ) echo $ev ."<br />"; ?>
			</div>
		</div>	
  <?php } unset ($_SESSION['user_reg_err']); ?>
	<div id="main">
		<form  method="post" action="<?php echo $ruadmin; ?>process/process_user.php">
			<fieldset>
				<p><label>First Name:</label><input name="firstname" id="firstname" type="text" class="text-input small-input"  value="<?php echo $_SESSION['user_reg']['firstname']; ?>"/></p>
				<p><label>Last Name:</label><input name="lastname" id="lastname" type="text" class="text-input small-input"  value="<?php echo $_SESSION['user_reg']['lastname']; ?>"/></p>
				<p><label>Password:</label><input name="password" id="password" type="password" class="text-input small-input" value="" /></p>
				<p><label>Confirm Password:</label><input name="cpassword" id="cpassword" type="password" class="text-input small-input" value="" /></p>
				<p><label>Email:</label><input name="email" id="email" type="text" class="text-input small-input" value="<?php echo $_SESSION['user_reg']['email']; ?>" /></p>
				<!--<p><label>Phone: (000) 000-0000</label><input type="text" name="phone" id="phone" class="text-input small-input" value="<?php echo $_SESSION['user_reg']['phone']; ?>" onchange="validatePhone(this)" /></p>-->
				<!--<p><label>Address:</label><input name="address" id="address" type="text" class="text-input medium-input" value="<?php echo $_SESSION['user_reg']['address']; ?>" /></p>
				<p><label>State:</label>
				<select name="state" id="state">
					<?php foreach($StateAbArray as $short){	?>
					<option value="<?php echo $short; ?>" <?php if($_SESSION['user_reg']['state'] == $short) echo 'selected="selected"'; ?>><?php echo $short; ?></option>
					<?php }	?>
				</select>				
				</p>
				<p><label>City:</label><input name="city" id="city" type="text" class="text-input small-input" value="<?php echo $_SESSION['user_reg']['city']; ?>" /></p>
				<p><label>Zip Code:</label><input name="zip" id="zip" type="text" class="text-input small-input" value="<?php echo $_SESSION['user_reg']['zip']; ?>" /></p>
-->				
				<!--<p  style="width:290px;"><label>Type:</label>
				<select name="type" id="type">
					<option value="u" <?php if( $_SESSION['user_reg']['type'] == 'u'){ ?> selected="selected" <?php } ?>>Customer</option>
					<option value="b" <?php if( $_SESSION['user_reg']['type'] == 'b'){ ?> selected="selected" <?php } ?>>Trader</option>
				</select>
				-->	
				
				<input type="hidden" name="type" value="t" id="type"  />
					<p  style="width:290px;"><label>Status:</label>
				<select name="status" id="status">
					<option value="Active" <?php if( $_SESSION['user_reg']['status'] == 'Active'){ ?> selected="selected" <?php } ?>>Active</option>
					<option value="Pending" <?php if( $_SESSION['user_reg']['status'] == 'Pending'){ ?> selected="selected" <?php } ?>>Pending</option>
					<option value="Inactive" <?php if( $_SESSION['user_reg']['status'] == 'Inactive'){ ?> selected="selected" <?php } ?>>Inactive</option>					
				</select>
				<!--</p>-->
				</p>
				<p style="width:100%"  >
				<input type="submit" class="button" value="&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;" name="AddTrade" id="submit" />
				</p>
			</fieldset>
		</form>
		</div>
	</div>
</div>