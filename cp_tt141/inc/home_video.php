<h3><a href="home.php">Home</a> &raquo; <a href="#" class="active">Manage Home Video</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3> Manage Home Video </h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
    <?php if ( isset ($_SESSION['statuss']) ) {?>
		<div class="notification information png_bg">
			<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
			<div>
				<?php echo  $_SESSION['statuss']; unset($_SESSION['statuss']); ?>
			</div>
		</div>	
   <?php } ?>
   
   <?php 
   $sql_video	=	"select * from tt_home_video ";
   $result = mysql_query($sql_video);
   $row = mysql_fetch_array($result);
   
   ?>	

<form action="<?php echo $ruadmin;?>process/process.php?p=addhomevideo" method="post" >
<table  border="0" cellspacing="0" cellpadding="0"  style="border:1px solid #DDDDDD; ">
  <tr>
    <td  colspan="3"><strong>Add New State</strong><?php if(isset($_GET['categ'])){ echo "   &gt;&gt;  ".$_GET['categ']; }?></td>
  </tr>
  <tr>
    <td colspan="3">Home&nbsp;Video:&nbsp;<textarea name="Region" id="Region" class="text-input"><?php echo $row['home_video'];?></textarea>&nbsp;&nbsp;
   </td>
    </tr>
  <tr> <td colspan="3"><input type="submit" name="Submit" value="Update Home video" class="button" /> </td></tr>
</table>
</form>
</div>
</div>
