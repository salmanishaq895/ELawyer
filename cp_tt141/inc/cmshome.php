<?php  

	$SQL_cmshome = "SELECT * FROM tt_home_settings WHERE home_id  = 1";
	$cmshome		= $db->get_row($SQL_cmshome, ARRAY_A);	
?>
<h3><a href="<?php echo $ruadmin; ?>home.php?p=user_manage">Home Content Management</a> &raquo; <a href="#" class="active">Add New User</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Home Page Content Management</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
  <?php if ( isset ($_SESSION['cms_home_err']) ) {?>
		<div class="notification error png_bg">
			<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
			<div>
				<?php echo $_SESSION['cms_home_err'] ; ?>
			</div>
		</div>	
  <?php } unset ($_SESSION['cms_home_err']); ?>
	<div id="main">
		<form  method="post" action="<?php echo $ruadmin; ?>process/process_cmshome.php">
			<fieldset>
				<p><h3><font color="#A90000">Home Slogan:</font></h3></p>
				<p><label>Home Slogan:</label><input name="slogan" id="slogan" type="text" class="text-input medium-input"  value="<?php echo $cmshome['slogan']; ?>"/></p>
				
				<p><h3><font color="#A90000">Inner Left Panel:</font></h3></p>
				<p><label>Title:</label><input name="title1" id="title1" type="text" class="text-input medium-input"  value="<?php echo $cmshome['title1'];  ?>"/></p>
				<p><label>Description:</label><textarea name="description1" id="description1" rows="4" cols="72" type="text"><?php echo $cmshome['description1'];  ?></textarea></p>
				<p><label>Button:</label><input name="label1" id="label1" type="text" class="text-input small-input"  value="<?php echo $cmshome['label1'];  ?>"/></p>
				
				<p><h3><font color="#A90000">Inner Center Panel:</font></h3></p>
				<p><label>Title:</label><input name="title2" id="title2" type="text" class="text-input medium-input"  value="<?php echo $cmshome['title2'];  ?>"/></p>
				<p><label>Description:</label><textarea name="description2" id="description2" rows="4" cols="72" type="text"><?php echo $cmshome['description2'];  ?></textarea></p>
				<p><label>Button:</label><input name="label2" id="label2" type="text" class="text-input small-input"  value="<?php echo $cmshome['label2']; ?>"/></p>
				
				<p><h3><font color="#A90000">Inner Right Panel:</font></h3></p>
				<p><label>Title:</label><input name="title3" id="title3" type="text" class="text-input medium-input"  value="<?php echo $cmshome['title3'];  ?>"/></p>
				<p><label>Description:</label><textarea name="description3" id="description3" rows="4" cols="72" type="text"><?php echo $cmshome['description3'];  ?></textarea></p>
				<p><label>Button:</label><input name="label3" id="label3" type="text" class="text-input small-input"  value="<?php echo $cmshome['label3'];  ?>"/></p>
				
				<p><h3><font color="#A90000">Recently Registered Companies:</font></h3></p>
				<p><label>Title:</label><input name="title4" id="title4" type="text" class="text-input medium-input"  value="<?php echo $cmshome['title4'];  ?>"/></p>
				<p><label>Description:</label><textarea name="description4" id="description4" rows="4" cols="72" type="text"><?php echo $cmshome['description4'];  ?></textarea></p>
				
				<p><h3><font color="#A90000">Recently Updated Companies:</font></h3></p>
				<p><label>Title:</label><input name="title5" id="title5" type="text" class="text-input medium-input"  value="<?php echo $cmshome['title5'];  ?>"/></p>
				<p><label>Description:</label><textarea name="description5" id="description5" rows="4" cols="72" type="text"><?php echo $cmshome['description5'];  ?></textarea></p>
				<p style="width:100%"  >
                <input type="submit" class="button" value="&nbsp;&nbsp;&nbsp;Update&nbsp;&nbsp;&nbsp;" name="updatecms" id="submit" />
                </p>
			</fieldset>
		</form>
		</div>
	</div>
</div>