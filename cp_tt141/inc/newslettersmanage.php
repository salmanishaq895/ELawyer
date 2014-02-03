<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Manage Newsletters </a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Manage Newsletters</h3>
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
    <td  colspan="4">
	<div style="float:left">
	<?php 
		$status = '';
		$qrywhere = '';
		if( isset ($_GET['status'] ) &&  trim( $_GET['status']) != '') {
			$status = $_GET['status'];
			$qrywhere = " where status='".$status."' ";
		}
		$sqlcount = "SELECT count(nl_id) FROM tt_news_letters $qrywhere ";
		$qrycounts = mysql_query($sqlcount);
		$rowcounts = mysql_fetch_array($qrycounts);
		$total_pages = $rowcounts[0];
		echo "Count: ".$total_pages;
	?>
    </div>
    </td>
	<td colspan="2" align="right">
	Sort by Status:&nbsp;
	<select name="status" id="status"  onChange="{window.location='home.php?p=newslettersmanage&status=' + this.value}" >
		<option  value="active" <?php if($status == 'active'){ ?> Selected = "Selected" <?php } ?>>Active</option>
		<option  value="deactive" <?php if($status == 'deactive'){ ?> Selected = "Selected" <?php } ?>>Deactive</option>
		<option  value="" <?php if($status == ''){ ?> Selected = "Selected" <?php } ?>>All</option>		
	</select>
	</td>
  </tr>
  <tr>
    <td width="3%"><strong>Id</strong></td>
    <td width="50%"><strong>Subject</strong></td>
    <td width="15%"><strong>From</strong></td>		
    <td width="10%"><strong>Dated</strong></td>
    <td width="10%"><strong>Status</strong></td>	
    <td width="12%"><strong>Action</strong></td>
  </tr>	
  
    <?php 
		$sql = "SELECT * FROM  tt_news_letters  $qrywhere ORDER BY dated desc ";
		 ///////////////////////////////////////////////////////////////////////////////////////
		 include('common/pagingprocess.php');
		 ///////////////////////////////////////////////////////////////////////////////////////
		 $sql .=  " LIMIT ".$start.",".$limit;
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
				<td><?php echo $items['subject'];?> </td>								
				<td><?php echo $items['mailfrom'];?> </td>								
				<td><?php echo date ('Y-m-d',strtotime( $items['dated']) );?> </td>
				<td><?php echo $items['status'];?></td>								
				<td valign="middle">
					<img src="images/mail_send.png"  style="cursor:pointer;" title="send newsletter" alt="send newsletter " onClick="if(confirm('Are sure you sure you want to send this newsletter to all subscribers?')){ window.location='process/process_newsletter.php?action=mail&nid=<?php echo $items["nl_id"];?>'}"  />&nbsp;&nbsp;													
					<img src="images/edit.gif"  style="cursor:pointer;" title="Edit "   alt="Edit "   onClick="window.location='home.php?p=newsletter&nid=<?php echo $items["nl_id"];?>'"  />&nbsp;&nbsp;
					<img src="images/dlt.gif"  style="cursor:pointer;" title="Delete " alt="Delete " onClick="if(confirm('Are sure you want to delete')){ window.location='process/process_newsletter.php?action=d&nid=<?php echo $items["nl_id"];?>'}"  />								
				</td>
		      </tr>	
		  
	        <?php
			}
		}
	?>	
  <tr>
    <td  colspan="6"><?php include('common/paginglayout.php');?></td>
  </tr>	     
</table>
	</div>
</div>	