<?php 
if ( isset($_GET['userId']) and $_GET['userId'] != '')
{ 
	
	$userId = $_GET['userId'];
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
	
}
?>
<?php 
	if($_SESSION['ap_ameri']['userId'] != $userId ) $addnew = ' class="active" ';else $myprofile = ' class="active" ';					
?>
<?php 
if($_SESSION['ap_ameri']['userId'] != $userId ) 
{ ?> 
	<h3><a href="<?php echo $ruadmin; ?>home.php?p=user_manage">Users</a> &raquo; <a href="#" class="active">Edit User Profile</a></h3> 
<?php }else{?>
	<h3><a href="<?php echo $ruadmin; ?>home.php?p=user_manage">MyInfo</a> &raquo; <a href="#" class="active">Edit User Profile</a></h3>
<?php } ?>
<div class="content-box">
	<div class="content-box-header">
	<?php if($_SESSION['ap_ameri']['userId'] != $userId ) { ?> 
		<h3>Edit Advertiser User</h3> 
	<?php }else{?>
		<h3>Edit Advertiser User</h3>
	<?php } ?>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">                    

			<?php if ( isset ($_SESSION['user_update_err']) ) {?>
					<div class="notification error png_bg">
						<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
						<div>
							<?php foreach ($_SESSION['user_update_err'] as $ek=>$ev ) echo $ev ."<br />"; ?>
						</div>
					</div>	
			<?php } unset ($_SESSION['user_update_err']);  ?>					
				
                <div id="main">
                
                	<form  method="post" action="process/process_advertiser.php">
                    <input type="hidden" name="userId" id="userId" value="<?php echo $userId ?>"  /> 
                    	<fieldset>
							<p><label>First Name:&nbsp;&nbsp;</label><input name="firstname" id="firstname" type="text" class="text-input small-input"  
							value="<?php echo $_SESSION['user_update']['firstname']; ?>"/></p>
							<p><label>Last Name:</label><input name="lastname" id="lastname" type="text" class="text-input small-input"  
							value="<?php echo $_SESSION['user_update']['lastname']; ?>"/></p>
							<p><label>Password:</label><input name="password" id="password" type="password" class="text-input small-input" value="" /></p>
							<p><label>Confirm Password:</label><input name="cpassword" id="cpassword" type="password" class="text-input small-input" value="" /></p>
							<p><label>Email:</label><input name="email" id="email" type="text" class="text-input small-input" 
							value="<?php echo $_SESSION['user_update']['email']; ?>" /></p>
							
                     	   <?php if($_SESSION['ap_ameri']['userId']!= $userId ) { ?>
							<input type="hidden" name="type" id="type" value="p"  /> 
						    <p  style="width:290px;"><label>Status:</label>
                            <select name="status" id="status">
                               	<option value="Active" <?php if( $_SESSION['user_update']['status'] == 'Active'){ ?> selected="selected" <?php } ?>>Active</option>
                            	<option value="Pending" <?php if( $_SESSION['user_update']['status'] == 'Pending'){ ?> selected="selected" <?php } ?>>Pending</option>
                            	<option value="Inactive" <?php if( $_SESSION['user_update']['status'] == 'Inactive'){ ?> selected="selected" <?php } ?>>Inactive</option>								
                            </select>
                            </p>                  
                        	<?php } ?>
							<p style="width:100%">
                            <input type="submit" class="button" value="&nbsp;&nbsp;&nbsp;Update&nbsp;&nbsp;&nbsp;" name="UpdateMember2" id="UpdateMember2" />
                            </p>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>	     
