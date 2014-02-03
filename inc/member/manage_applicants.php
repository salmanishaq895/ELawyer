<div class="map_page_right_bar listing_right_bar">
  <div class="brued_crum_bar brued_crum_bar_c">
    <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;" >Home</a> </span></span></div>
  </div>
	<?php //include('notice.php'); ?>
    <div class="cpanel_right_bar">
      <div class="company_detail_description">
	  	
		<span class="company_detail_span"> Cases </span>
	  	
		
		<?php if(isset($_SESSION['key_services_msg'])){?>
			<div style="float:left; width:500px; margin-left:50px; color:#FF0000;"><?php echo $_SESSION['key_services_msg']; ?></div>
		<?php } unset($_SESSION['key_services_msg']); ?>
		
		<div class="list-row" style="margin-bottom:0;">
				<div class="titlej" style="font-weight:bold;">Case Name</div>
				<div class="titlej" style="font-weight:bold;">Address</div>
				<div class="imgj" style="font-weight:bold;">Date Applied</div>
				
				<div class="descj" style="font-weight:bold;">&nbsp;<?php echo $items['phone']; ?></div>
				<div class="actionj" style=" width:53px;font-weight:bold;">Take A Case</div>
			</div>
		
		
	  	<?php 
		
		
		
		$sql = "select * from  tt_quotes where status='pending' ";// exit;
			
		$result = mysql_query($sql);
		
		$num_of_results = mysql_num_rows($result);
		
		
		if($num_of_results > 0)
		{
		
		while($items = mysql_fetch_array($result))
		{
		

		?>
		
			<div class="list-row list-row-hover" style="margin-top:0; margin-bottom:0px;">
				<div class="titlej">&nbsp;<?php echo  $items['keyword']; ?></div>
				<div class="titlej">&nbsp;<?php echo   $items['address']; ?></div>
				<div class="imgj">&nbsp;<?php echo date('d M Y' , $items['added']);?></div>
				
				<div class="descj">&nbsp;<?php echo $items['phone']; ?></div>
				<div class="actionj" style="text-align:center; width:53px">
					
					<a style="float:left;" href="<?php echo $ru; ?>customer_msgs.php?id=<?php echo $items['quotes_id'];?>"><img style="margin:0px" src="<?php echo $ru; ?>images/email2.jpg" /></a>
					
					
					
					
				</div>
			</div>
		 <?php 
		}
		}
		else
		{
		
		?>
		
		<div class="list-row list-row-hover" style="margin-top:0; margin-bottom:0px;">
				&nbsp;No Applicants for this job
				
				
			</div>
		
		
		
		<?php 
		}
		?>
			</div>
      </div>
	</div>
  

<?php
unset($_SESSION['key_services_err']); 
unset($_SESSION['key_services']); 
?>
