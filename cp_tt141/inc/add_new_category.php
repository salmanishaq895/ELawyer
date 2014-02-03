<?php 
if(isset($_GET['subid'])){ $parentid=$_GET['subid']; } else { $parentid=0; }
?>

<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Category Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Category Management</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
	<?php if ( isset ($_SESSION['msg']) ) {?>
		<div class="notification error png_bg">
			<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
			<div>
				<?php echo  $_SESSION['msg']; unset($_SESSION['msg']); ?>
			</div>
		</div>	
	<?php } ?>	
	<?php if ( isset ($_SESSION['error_add_cat']) ) {?>
		<div class="notification error png_bg">
			<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
			<div>
				<?php foreach ($_SESSION['error_add_cat'] as $ek=>$ev ) echo $ev ."<br />"; ?>
			</div>
		</div>	
		<?php }unset($_SESSION['error_add_cat'] ); ?>	
<form action="<?php echo $ruadmin; ?>process/process_category.php?p=categories" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #DDDDDD;">
 <tr>
    <td><strong>Add new category</strong></td>										
  </tr>
  <tr>
    <td>Category name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="cat_name" id="cat_name" type="text" class="text-input small-input"  value="<?php echo $_SESSION['add_cat']['cat_name']; ?>"/></td>
  </tr>
   <!--<tr>
    <td style="vertical-align:top;">Category Description:&nbsp;<textarea name="cat_desc" id="cat_desc" class="text-input medium-input" style="vertical-align:top;">< ?php echo $_SESSION['add_cat']['cat_desc']; ?></textarea></td>
  </tr>
  <tr>
    <td>Category image:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="img_name" type="file" id="img_name" style="width:250px;" class="text-input" /></td>
  </tr>-->
  
  <tr>
    <td>Set as Featured: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="featured" type="radio" <?php echo ($_SESSION['add_cat']['featured']=='1'?'checked="checked"':''); ?>  value="1"/>YES&nbsp;&nbsp;&nbsp;<input name="featured" type="radio"  <?php echo ($_SESSION['add_cat']['featured']!='Yes'?'checked="checked"':''); ?> value="0"/>NO</td>
  </tr>
  <tr>
    <td style="padding-left:135px"><input type="submit" class="button" name="Submit" value="Add new Category" /></td>
  </tr>

</table>
</form>
</div>
</div>	
<?php unset($_SESSION['add_cat']);?>