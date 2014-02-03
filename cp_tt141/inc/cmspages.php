<?php
$type = $_GET['type'];
$type = ($type)?$type:"carrier_or_broker";
$where = "type='".$type."'";
$qry="select * from tt_cms  where ".$where;
$rs=mysql_query($qry);
$row =mysql_fetch_array($rs);
$htmlData=$row['body'];
$htmlData = $htmlData;	
?>
<script language="javascript" type="text/javascript">
function mailcontent()
{
	var type = document.getElementById('type').value;
	window.location = "<?php echo $ruadmin; ?>home.php?p=cmspages&type="+type;
}
</script>
<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Content Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Pages Content Management</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
	<?php if ( isset ($_SESSION['msgText']) ) {?>
		<div class="notification error png_bg">
			<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
			<div>
				<?php echo  $_SESSION['msgText']; unset($_SESSION['msgText']); ?>
			</div>
		</div>	
	<?php } ?>	
	<?php // echo $ruadmin; exit;?>	
<form   method="post" action="<?php echo $ruadmin; ?>process/savetext.php">
<input type="hidden" name="savepage" value="<?php echo $type; ?>" />
<table border="0" width="100%" cellpadding="0" cellspacing="0">
   <tr>
		<td width="123"  > Select page:&nbsp;
		<select class="normal" name="type" id="type" onchange="mailcontent();">	
			<option <?php if($type == "contactus"){ ?> selected="selected" <?php } ?> value="contactus">Contact us</option>					
			<option <?php if($type == "aboutus"){ ?> selected="selected" <?php } ?> value="aboutus">About us</option>			
			<option <?php if($type == "terms_conditions"){ ?> selected="selected" <?php } ?> value="terms_conditions">Term & Conditions</option>			
			<option <?php if($type == "privacypolicy"){ ?> selected="selected" <?php } ?> value="privacypolicy">Privacy</option>
			<option <?php if($type == "singup"){ ?> selected="selected" <?php } ?> value="singup">Sign up</option>
			<option <?php if($type == "help"){ ?> selected="selected" <?php } ?> value="help">Help</option>
			<option <?php if($type == "learn_more"){ ?> selected="selected" <?php } ?> value="learn_more">Learn More</option>
			<option <?php if($type == "more_info"){ ?> selected="selected" <?php } ?> value="more_info">More Info</option>
			<option <?php if($type == "how_it_work"){ ?> selected="selected" <?php } ?> value="how_it_work">How It Work</option>
			<option <?php if($type == "how_it_work_for_trader"){ ?> selected="selected" <?php } ?> value="how_it_work_for_trader">How It Work for Trader</option>
			<option <?php if($type == "how_it_work_for_user"){ ?> selected="selected" <?php } ?> value="how_it_work_for_user">How It Work  for User</option>
			<option <?php if($type == "advise_and_tip"){ ?> selected="selected" <?php } ?> value="advise_and_tip">Advertise with us</option>
			<option <?php if($type == "advise_and_tip_for_trader"){ ?> selected="selected" <?php } ?> value="advise_and_tip_for_trader">Advise And Tip for Trader</option>
			<option <?php if($type == "advise_and_tip_for_user"){ ?> selected="selected" <?php } ?> value="advise_and_tip_for_user">Advise And Tip for User</option>
			<option <?php if($type == "why_trade_tool"){ ?> selected="selected" <?php } ?> value="why_trade_tool">Why Trade Tool</option>
			<option <?php if($type == "write_review"){ ?> selected="selected" <?php } ?> value="write_review">Write A Review</option>
			
		</select>		
		</td>
	</tr>
<!--	<tr>
		<td> Page Title:&nbsp;&nbsp;&nbsp;
		<input name="page_title" id="page_title" type="text" class="text-input small-input"  value="<?php echo $row['page_title']; ?>"/>
        </td>
	</tr>-->
<?php if ( isset ($_SESSION['msgText'] ) ) {?> <tr><td class="msg" align="center"><?php echo  $_SESSION['msgText']; unset($_SESSION['msgText']); ?></td></tr><?php } ?>
	<tr>
		<td>
		<?php 
		include("FCKeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor('txtData');
		$oFCKeditor->BasePath = "FCKeditor/";
		//$oFCKeditor->Config['SkinPath'] = $ru.$fckpath.'editor/skins/silver/';
		$oFCKeditor->Width		= '100%' ;
		$oFCKeditor->Height		= '500' ;
		$oFCKeditor->Value = stripcslashes($htmlData);
		$oFCKeditor->Create();
		?>
		</td>
	</tr>
	<tr>
	  <td><input type="submit" class="button" name="SaveTextData" value="Save"></td>
	</tr>
</table>
</form>
	</div>
</div>	        