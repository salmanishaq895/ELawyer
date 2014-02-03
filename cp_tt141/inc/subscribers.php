<?php 
$sql =  "select * from tt_news_letter order by dated desc";
$view_rs = mysql_query($sql) or die (mysql_error());
$total_pages = mysql_num_rows($view_rs);
?>              
<h3><a href="#">Home</a> &raquo; <a href="#">Newsletter Subscribers</a> </h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Newsletter Subscribers</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
	<?php if ( isset ($_SESSION['statuss']) ) {?>
		<div class="notification error png_bg">
			<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
			<div>
				<?php echo  $_SESSION['statuss']; unset($_SESSION['statuss']); ?>
			</div>
		</div>	
	<?php } ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">

  <tr>
  	<td colspan="3" height="20">Total Count: <?php echo $total_pages;?></td>
  </tr>
  <tr>
    <td width="5%"><strong>Id</strong></td>
    <td width="30%"><strong>Email</strong></td>
    <td width="30%"><strong>Dated</strong></td>	
  <tr>	
  
    <?php 
///////////////////////////////////////////////////////////////////////////////////////
 include('common/pagingprocess.php');
 ///////////////////////////////////////////////////////////////////////////////////////
 
 $sql .=  "  LIMIT ".$start.",".$limit;
 $i=$i+$start;
 $result = @mysql_query($sql);
 $rec = array();
 while( $row = @mysql_fetch_array($result) )
 {
	$rec[] = $row;
 }
		if(count($rec)>0)
		{
			foreach($rec as $items)
			{
			

			?>
			
			  <tr>
				<td><?php echo ++$i;?> </td>
				<td><?php echo $items['email'];?> </td>
				<td><?php echo $items['dated'];?> </td>				
		      </tr>	
			  
			  
	        <?php
			}
		}
	?>	
  <tr>
    <td  colspan="4"><?php include("paginglayout.php");?></td>
  <tr>	     
</table>
	</div>
</div>	