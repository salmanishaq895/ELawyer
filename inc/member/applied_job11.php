<div class="map_page_right_bar listing_right_bar">
  <div class="brued_crum_bar brued_crum_bar_c">
    <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"<a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;" >Home</a> > <a href="<?php echo $ru;?>member/statistics" style="text-decoration:none; color:#999999;"> Account Panel</a> > <a href="<?php echo $ru;?>member/statistics" style="text-decoration:none; color:#999999;"> Customer Profile </a> > <span class="change"> Applied Job </span></span></div>
  </div>
	<?php //include('notice.php'); ?>
    <div class="cpanel_right_bar">
      <div class="company_detail_description">
	  	<span class="company_detail_span">Manage Applied Job</span>
		<?php if(isset($_SESSION['key_services_msg'])){?>
			<div style="float:left; width:500px; margin-left:50px; color:#FF0000;"><?php echo $_SESSION['key_services_msg']; ?></div>
		<?php } unset($_SESSION['key_services_msg']); ?>
	  	<?php 
		//$userId = $_SESSION['TTLOGINDATA']['USERID'];
		$sql_profile = "select * from `tt_business` where `userId` = '".$_SESSION['TTLOGINDATA']['USERID']."'";
		$result	= $db->get_row($sql_profile,ARRAY_A);
		$bus_id = $result['locationid'];
		$qryString =" where 1";
		$qryString .="  and `tt_invite_job`.bId = '".$bus_id."'  ";
		$sortyby = '  order by `tt_invite_job`.bId';
		 $sql = "SELECT `tt_invite_job`.job_invite_id ,`tt_invite_job`.userId ,`tt_invite_job`.bId,`tt_invite_job`.job_title ,`tt_invite_job`.job_description,`tt_invite_job`.date_added,`tt_business`.name,`tt_business`.locationid,`tt_user`.userId,`tt_user`.firstname,`tt_user`.lastname,`tt_user`.email FROM `tt_invite_job` LEFT JOIN `tt_business` ON (`tt_invite_job`.bId = `tt_business`.locationid)  
			LEFT JOIN `tt_user` ON (`tt_invite_job`.userId=`tt_user`.userId) $qryString $sortyby "; //exit;
			
		//$res_key = mysql_query("SELECT * FROM `tt_business_keyservices` WHERE `userId` = '$userId' "); 
		/*$count = 0;
		$keyId = 0;
		if(isset($_GET['o']))
			$keyId = (int)$_GET['o'];*/
		//if(mysql_num_rows($res_key)>0){
		?>
		<div class="list-row" style="margin-bottom:0;">
		  <div class="title1" style="font-weight:bold;">Title</div>
		  <div class="img1" style="font-weight:bold;">Description</div>
		  <div class="desc1" style="font-weight:bold;">User Name</div>
		  <div class="action1" style="font-weight:bold;">Action</div>
		</div>
		<?php
		///////////////////////////////////////////////////////////////////////////////////////
					// include('common/pagingprocess.php');
					 ///////////////////////////////////////////////////////////////////////////////////////
					 /*$sql .=  " LIMIT ".$start.",".$limit;
					 echo $limit; exit;
					 $i=$i+$start;*/
					 $result = @mysql_query($sql);
					//echo "<pre>".print_r($result); exit;
					 $rec = array();
					 while( $row = @mysql_fetch_array($result) )
					 {
						//echo "<pre>".print_r($row); exit;
						$rec[] = $row;
						
					 }
					if(count($rec)>0)
					{
						foreach($rec as $items)
						{
						//echo $items['job_title']; exit;
			//while($row_key = mysql_fetch_array($res_key)){
			?>
			<div class="list-row list-row-hover" style="margin-top:0; margin-bottom:0px;">
			<div class="title1"><?php echo $items['job_title']; ?></div>
			<div class="desc1"><?php echo $items['job_description']; ?></div>
			 <div class="img1"><?php echo $items['firstname']." ".$items['lastname'];?></div>
			 
			 <div class="action1">
			  	<a href="<?php echo $ru; ?>process/process_job.php?action=send_job&job_invite_id=<?php echo $items['job_invite_id']; ?>"><img src="<?php echo $ru; ?>images/email2.jpg" /></a>
				<a onclick="return confirm('Are you sure you want to delte this Job?');" href="<?php echo $ru; ?>process/process_job.php?action=delete_job&job_invite_id=<?php echo $items['job_invite_id']; ?>"><img src="<?php echo $ru; ?>images/drop.gif" /></a>
			  </div>
		 <?php 
		  //$count++;
		}
		?>
			</div>
			<?php
		}
//}
		?>
      </div>
	</div>
  
</div>
<?php
unset($_SESSION['key_services_err']); 
unset($_SESSION['key_services']); 
?>
