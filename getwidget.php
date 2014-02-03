<?php
	include"connect/connect.php";
	$userId= $_SESSION['LOGINDATA']['USERID'];

	echo $SQL_act = "SELECT locationid,name FROM tt_business where userId = '$userId' "; //exit;
	$rs_row		= $db->get_row($SQL_act, ARRAY_A);		
?>


<div class="user_pan_left">
  <div class="control_panel_right"><h2>Widget Code</h2></div>
  
  
  <div class="user_pan_texarea">
 
    <div class="frm_outer" style="padding:15px 0 0 0;">
		<div class="row">
			<div style="margin-left:20px;">
			<a href="<?php echo $ru.'profile/'.$rs_row['locationid'].'/'.encodeURL($rs_row['name']); ?>" >
			<script language="javascript"> var params="?publisher_id=&add=30";</script> 
			<script src="<?php echo $ru;?>widget/load.js"language="javascript" type="text/javascript"></script>
			</a>
			</div>
			<div class="smal_heading_content_us_top">
				<label for="SubmitBiz-phone">Copy and paste this code to any webpage to display Tradestool Logo:</label>
			</div>
			<div>
				<textarea name="code" cols="75" rows="6" class="contact_textarea" style="margin-left:20px;"><a href="<?php echo $ru.'profile/'.$rs_row['locationid'].'/'.encodeURL($rs_row['name']); ?>" ><script language="javascript"> var params="?publisher_id=&add=30";</script> 
<script src="<?php echo $ru;?>widget/load.js"language="javascript" type="text/javascript"></script></a>
				</textarea> 
			</div>
		</div>   
	</div>
</div>
</div>
