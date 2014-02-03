<?php
$type = $_GET['type'];
$type = ($type)?$type:"homepage";
$where = "type='".$type."'";
$qry="select * from cmstable  where ".$where;
$rs=mysql_query($qry);
$row =mysql_fetch_array($rs);
$htmlData=$row['body'];
$htmlData = $htmlData;	
?>
<script language="javascript" type="text/javascript">
function mailcontent()
{
	var type = document.getElementById('type').value;
	window.location = "<?php echo $ruadmin; ?>home.php?p=cmstippages&type="+type;
}
</script>
<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Help Tips Conetnet Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Help Tips Conetnet Management</h3>
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
<form   method="post" action="savetext.php">
<input type="hidden" name="savetipspage" value="<?php echo $type; ?>" />
<table border="0" width="100%" cellpadding="0" cellspacing="0">
     <tr>
		<td width="123"  > Select :</td>
		<td width="976">
		<select class="normal" name="type" id="type" onchange="mailcontent();">
			
			<option <?php if($type == "biz_description"){ ?> selected="selected" <?php } ?> value="biz_description">Click here to see some winning examples</option>
            <option <?php if($type == "biz_keyword"){ ?> selected="selected" <?php } ?> value="biz_keyword">How do I choose the right keywords?</option>
            <option <?php if($type == "biz_map"){ ?> selected="selected" <?php } ?> value="biz_map">How to point business location at map?</option>
			<option <?php if($type == "biz_hour"){ ?> selected="selected" <?php } ?> value="biz_hour">How to setup business hours?</option>			
			<option <?php if($type == "biz_photo"){ ?> selected="selected" <?php } ?> value="biz_photo">Upload your business photo</option>			
			
	  </select>		
	  </td>
	</tr>
	
	<tr>
	  
		
		<td colspan="3">	
		
		
<table width="100%">
<?php if ( isset ($_SESSION['msgText'] ) ) {?> <tr><td class="msg" align="center"><?php echo  $_SESSION['msgText']; unset($_SESSION['msgText']); ?></td></tr><?php } ?></table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
	<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td colspan="3">
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
		<td width="28%"></td>
		
		<td width="36%"></td>
	  <td width="36%" align="right" style="padding-right:25px;padding-bottom:5px;padding-top:5px"><input type="submit" class="button" name="SaveTextData" value="Save"></td>
	</tr>
</table>
</td>
</tr>
</table>
</form>
	</div>
</div>	
        