<?php
$type = $_GET['type'];
$type = ($type)?$type:"advertiser_help";
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
	window.location = "<?php echo $ruadmin; ?>home.php?p=cmspages_help_n_tips&type="+type;
}
</script>
<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Help and Tips Content Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Help and Tips Content Management</h3>
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
		<option <?php if($type == "advertiser_help"){ ?> selected="selected" <?php } ?> value="advertiser_help">How the Advertiser process works and Rates types</option>
			<option <?php if($type == "message_unreg_user"){ ?> selected="selected" <?php } ?> value="message_unreg_user">Message for un authorized user for using Custom Directory</option>
			<option <?php if($type == "upgrade_buss"){ ?> selected="selected" <?php } ?> value="upgrade_buss">How do I choose the right Package?</option>
			<option <?php if($type == "add_reference"){ ?> selected="selected" <?php } ?> value="add_reference">How do I extract credentials from reference sites?</option>
            <option <?php if($type == "business_details"){ ?> selected="selected" <?php } ?> value="business_details">Need help to update basic info?</option>
			<option <?php if($type == "business_contact_info"){ ?> selected="selected" <?php } ?> value="business_contact_info">Need help to update contact info?</option>
			<option <?php if($type == "business_billing"){ ?> selected="selected" <?php } ?> value="business_billing">Need help to update billing info?</option>
			<option <?php if($type == "business_additional_info"){ ?> selected="selected" <?php } ?> value="business_additional_info">Need help to update additional info?</option>
			<option <?php if($type == "business_hour"){ ?> selected="selected" <?php } ?> value="business_hour">Need help to update compnay business hours?</option>
			<option <?php if($type == "business_broker_info"){ ?> selected="selected" <?php } ?> value="business_broker_info">Need help to update broker bond info?</option>
			<option <?php if($type == "business_cargo"){ ?> selected="selected" <?php } ?> value="business_cargo">Need help to update cargo insurance info?</option>
			<option <?php if($type == "business_equipment"){ ?> selected="selected" <?php } ?> value="business_equipment">Need help to update equipment & route info?</option>
			<option <?php if($type == "how_does_the_quote_manager_work"){ ?> selected="selected" <?php } ?> value="how_does_the_quote_manager_work">How quote manager works? </option>
			<option <?php if($type == "bookmarks"){ ?> selected="selected" <?php } ?> value="bookmarks">Tips for my favorite company management </option>
			<option <?php if($type == "comparision"){ ?> selected="selected" <?php } ?> value="comparision">Tips for company price comparison</option>
			<option <?php if($type == "user_add_company"){ ?> selected="selected" <?php } ?> value="user_add_company">Need help to add non listing company?</option>					
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
		$oFCKeditor->Value = $htmlData;
		$oFCKeditor->Create();
		?>
		</td>
	</tr>
	<tr>
	  <td><input type="submit" class="button" name="SaveTextData2" value="Save"></td>
	</tr>
</table>
</form>
	</div>
</div>	        