<div class="map_page_right_bar listing_right_bar">
  <div class="brued_crum_bar brued_crum_bar_c">
    <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;" >Home</a> ><a href="<?php echo $ru;?>member/profile" style="text-decoration:none; color:#999999;" > Account Panel </a>> <a href="<?php echo $ru;?>member/profile" style="text-decoration:none; color:#999999;" >Customer Profile</a>  >  <a href="<?php echo $ru;?>member/manage_jobs" style="text-decoration:none; color:#999999;" > <span class="change"> Manage Job </span> </a></span></div>
  </div>
	<?php //include('notice.php'); ?>
    <div class="cpanel_right_bar">
      <div class="company_detail_description">
	  	
		<span class="company_detail_span">Active Jobs</span>
		
		<?php if(isset($_SESSION['key_services_msg'])){?>
			<div style="float:left; width:500px; margin-left:50px; color:#FF0000; font-size:17px;"><?php echo $_SESSION['key_services_msg']; ?></div>
			
			
		<?php } unset($_SESSION['key_services_msg']); ?>
	  	
		
		<div class="list-row" style="margin-bottom:0;">
		  <div class="title1" style="font-weight:bold;">Job Title</div>
		  
		  <div class="img1" style="font-weight:bold;">Location </div>
		  <div class="img1" style="font-weight:bold;">Status </div>
		  <div class="img1" style="font-weight:bold;">Posting Date  </div>
		  
		  
		  <div class="action1" style="font-weight:bold;">Action </div>
		</div>
		
		
	  	<?php 
		$userId = $_SESSION['TTLOGINDATA']['USERID'];
		//$qryString =" where tt_quotes.status = 'Active'";
		$qryString =" where 1";
		$qryString .="  and `tt_quotes`.userId = '".$userId."'  ";
		$sortyby = '  order by `tt_quotes`.quotes_id';
	 	$sql = "SELECT `tt_quotes`.quotes_id ,`tt_quotes`.posted_date,`tt_quotes`.keyword ,`tt_quotes`.message,`tt_quotes`.location ,`tt_quotes`.miles,`tt_quotes`.title,`tt_quotes`.status,`tt_quotes`.phone,`tt_quotes`.contact_method,`tt_quotes`.userId,`tt_user`.userId,`tt_user`.firstname,`tt_user`.lastname,`tt_user`.email FROM `tt_quotes` LEFT JOIN `tt_user` ON (`tt_quotes`.userId = `tt_user`.userId)   $qryString $sortyby ";// exit;
			
		$result = @mysql_query($sql);
		while($items = @mysql_fetch_array($result)){
		
		$msg_count_qry = "select * from tt_messages where  `to` = '".$userId."' and jobId = '".$items['quotes_id']."' and `to_viewed` = '0' ";
		$exe_msg_count = @mysql_query($msg_count_qry);
		$unread_count = @mysql_num_rows($exe_msg_count);
		
		
		$bgcolor = ($bgcolor == '#F8F8F8')?'#FFFFFF':'#F8F8F8';
		?>
			
			
			<div class="list-row list-row-hover" style="margin-top:0; margin-bottom:0px; background-color:<?php echo $bgcolor; ?>;">
				<div class="title1"><?php echo substr(stripslashes($items['keyword']),0,20); ?></div>
				<div class="imgj" style="text-align:left;"><?php echo stripslashes($items['location']);?></div>
				<div class="imgj" style="text-align:left;"><?php echo stripslashes($items['status']);?></div>
				<div class="imgj"><?php echo date('m-d-Y', strtotime($items['posted_date'])); ?></div>
				
				<div class="actionj">
					
					
					
					
					
					<?php if($unread_count > 0)
			{
			?>
			
			<img style=" margin:3px;"  title="Applicants" src="<?php echo $ru; ?>images/filled.png" />
			
			<?php 
			}else
			{
			?>
			<img style=" margin:3px;"  title="Applicants" src="<?php echo $ru; ?>images/empty.png" />
			<?php 
			}
			?>
					
					
					
					<a style="float:left;" href="<?php echo $ru; ?>member/manage_applicants/<?php echo $items['quotes_id']; ?>"><img style="margin:0px"  title="Applicants" src="<?php echo $ru; ?>images/users-icon.png" /></a>
					<a style="float:left; margin-left:7px;" href="<?php echo $ru; ?>member/edit_jobs/<?php echo $items['quotes_id']; ?>"><img style="margin:0px"  src="<?php echo $ru; ?>images/edit.gif" /></a>
					<a style="float:left; margin-left:7px;" onclick="return confirm('Are you sure you want to delte this Job?');" href="<?php echo $ru; ?>process/process_job.php?action=dele&jobid=<?php echo $items['quotes_id']; ?>"><img style="margin:0px"  src="<?php echo $ru; ?>images/drop.gif" /></a>
				</div>
			</div>
		 <?php 
		}
		?>
			</div>
      </div>
	</div>
  
</div>
<?php
unset($_SESSION['key_services_err']); 
unset($_SESSION['key_services']); 
?>
