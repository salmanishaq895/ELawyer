<?php
$nlid='';
if(isset($_GET['nid']) && $_GET['nid']!=''){
	$nlid = $_GET['nid'];
	$qry="select * from  tt_news_letters where nl_id = '$nlid'";
	
	$rs=mysql_query($qry);
	$row =mysql_fetch_array($rs);

	$_SESSION['newsletter'] =$row;
}
else
{
	unset($_SESSION['newsletter']);
}
?>
<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Create Newsletter</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3> Create Newsletter </h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
	<?php if ( isset ($_SESSION['newsletter_err']) ) {?>
	<div class="notification error png_bg">
		<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
		<div>
			<?php foreach ($_SESSION['newsletter_err'] as $ek=>$ev ) echo $ev ."<br />"; ?>
		</div>
	</div>	
	<?php } unset ($_SESSION['newsletter_err']); ?>	

<form   method="post" action="process/process_newsletter.php">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>Newsletters From:</td>
		<td><input type="text" name="mailfrom" value="<?php echo $_SESSION['newsletter']['mailfrom']; ?>" size="93" class="text-input"></td>
	</tr>	
	<tr>
		<td>Newsletters&nbsp;Subject:</td>
		<td><input type="text" name="subject" value="<?php echo $_SESSION['newsletter']['subject']; ?>" size="93" class="text-input"></td>
	</tr>
	<tr>
		<td>Newsletters Status:</td>
		<td>
			<input type="hidden" name="nl_id" value="<?php echo $_SESSION['newsletter']['nl_id']; ?>">
			<select name="status" id="status">
				<option  value="active" <?php if($_SESSION['newsletter']['status'] == 'active'){ ?> Selected = "Selected" <?php } ?>>Active</option>
				<option  value="deactive" <?php if($_SESSION['newsletter']['status'] == 'deactive'){ ?> Selected = "Selected" <?php } ?>>Deactive</option>
			</select>
		
		</td>
	</tr>
	<tr>
		<td colspan="2"   valign="top">Newsletters&nbsp;Body:</td>
	</tr>
	<tr>
		<td colspan="2">
		<?php		
		
			include("FCKeditor/fckeditor.php");		
			$oFCKeditor = new FCKeditor('message') ;
			$oFCKeditor->BasePath = 'FCKeditor/';
			$oFCKeditor->Value = nl2br($_SESSION['newsletter']['message']);
			$oFCKeditor->Create() ;
	?></td>
	</tr>

	<tr>
		<td class="2"><input type="submit" class="button" name="<?php if($nlid!=''){ echo 'updateTextData';} else { echo 'SaveTextData';}?>" value="Submit Newsletter"></td>
	</tr>
	</table>
</form>
	</div>
</div>	