<?php
$type = $_GET['type'];
$type = ($type)?$type:"reference1";
$where = "type='".$type."'";
$qry="select * from tt_cms_reference  where ".$where;
$rs=mysql_query($qry);
$row =mysql_fetch_array($rs);
$htmlData=stripslashes($row['body']);
$htmlData = $htmlData;
$htmlData2=stripslashes($row['body2']);
$htmlData2 = $htmlData2;


?>
<script language="javascript" type="text/javascript">
function mailcontent()
{
	var type = document.getElementById('type').value;
	window.location = "<?php echo $ruadmin; ?>home.php?p=cmsreferences&type="+type;
}
</script>
<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Reference Site Content Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Reference Site Content Management</h3>
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
<form   method="post" action="<?php echo $ruadmin; ?>process/savetext.php" enctype="multipart/form-data">
<input type="hidden" name="savepage" value="<?php echo $type; ?>" />
<table border="0" width="100%" cellpadding="0" cellspacing="0">
   <tr>
		<td width="123" colspan="2" > Select page:&nbsp;
		<select class="normal" name="type" id="type" onchange="mailcontent();">	
			<option <?php if($type == "reference1"){ ?> selected="selected" <?php } ?> value="reference1">Reference Site 1 </option>
			<option <?php if($type == "reference2"){ ?> selected="selected" <?php } ?> value="reference2">Reference Site 2 </option>
		    <option <?php if($type == "reference3"){ ?> selected="selected" <?php } ?> value="reference3">Reference Site 3 </option>
			<option <?php if($type == "reference4"){ ?> selected="selected" <?php } ?> value="reference4">Reference Site 4 </option>
			<option <?php if($type == "reference5"){ ?> selected="selected" <?php } ?> value="reference5">Reference Site 5 </option>
			<option <?php if($type == "reference6"){ ?> selected="selected" <?php } ?> value="reference6">Reference Site 6 </option>
		</select>		
		</td>
	</tr>
	   	<tr colspan="2">
		<td>Title:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="page_title" value="<?php echo $row['page_title']; ?>"  class="text-input " style="width:265px;"></td>
	</tr>	
	<tr>
		<td>Logo:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="file" name="photo" class="text-input" >
		</td><td> <img src="<?php echo $ru;?>media/referenceimages/<?php echo $row['photo']; ?>" border="0"  style="margin-left:70px;" /></td>
	</tr>
	</tr>
	<tr>
		<td colspan="2">Features:</td>
	</tr>
<?php if ( isset ($_SESSION['msgText'] ) ) {?> <tr><td class="msg" align="center"><?php echo  $_SESSION['msgText']; unset($_SESSION['msgText']); ?></td></tr><?php } ?>
	<tr>
		<td colspan="2">
		<?php 
		include("FCKeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor('txtData');
		$oFCKeditor->BasePath = "FCKeditor/";
		//$oFCKeditor->Config['SkinPath'] = $ru.$fckpath.'editor/skins/silver/';
		$oFCKeditor->Width		= '100%' ;
		$oFCKeditor->Height		= '300' ;
		$oFCKeditor->Value = $htmlData;
		$oFCKeditor->Create();
		?>
		</td>
	</tr>
	<tr>
		<td colspan="2">Score:</td>
	</tr>
<?php if ( isset ($_SESSION['msgText'] ) ) {?> <tr><td class="msg" align="center"><?php echo  $_SESSION['msgText']; unset($_SESSION['msgText']); ?></td></tr><?php } ?>
	<tr>
		<td colspan="2">
		<?php 
		include("FCKeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor('txtData2');
		$oFCKeditor->BasePath = "FCKeditor/";
		//$oFCKeditor->Config['SkinPath'] = $ru.$fckpath.'editor/skins/silver/';
		$oFCKeditor->Width		= '100%' ;
		$oFCKeditor->Height		= '300' ;
		$oFCKeditor->Value = $htmlData2;
		$oFCKeditor->Create();
		?>
		</td>
	</tr>
	<tr>
	  <td><input type="submit" class="button" name="SaveTextDataReferences" value="Save"></td>
	</tr>
</table>
</form>
	</div>
</div>	        