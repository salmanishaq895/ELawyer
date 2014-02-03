<?php 
$trader_id = $_SESSION['TTLOGINDATA']['USERID'];
?>
<div class="map_page_right_bar listing_right_bar">
  <div class="brued_crum_bar brued_crum_bar_c">
    <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"  style="text-decoration:none; color:#999999;" ><a href="<?php echo $ru;?>">Home</a>  <a href="<?php echo $ru;?>member/statistics" style="text-decoration:none; color:#999999;"> Account Panel</a> > <a href="<?php echo $ru;?>member/statistics" style="text-decoration:none; color:#999999;"> Customer Profile </a> > <span class="change"> Applied Job </span></span></div>
  </div>
	<?php //include('notice.php'); ?>
    <div class="cpanel_right_bar">
      <div class="company_detail_description">
	  	<span class="company_detail_span">Manage Applied Job</span>
		<?php if(isset($_SESSION['key_services_msg'])){?>
			<div style="float:left; width:500px; margin-left:50px; color:#FF0000; font-size:17px;"><?php echo $_SESSION['key_services_msg']; ?></div>
		<?php } unset($_SESSION['key_services_msg']); ?>
		
		<?php if(isset($_SESSION['response_msg'])){?>
			<div style="float:left; width:500px; margin-left:50px; color:#FF0000;"><?php echo $_SESSION['response_msg']; ?></div>
		<?php } unset($_SESSION['response_msg']); ?>
		
		
	  	<?php 
		//$userId = $_SESSION['TTLOGINDATA']['USERID'];
		//$sql_profile = "select * from `tt_quotes` where `userId` = '".$_SESSION['TTLOGINDATA']['USERID']."'";
		//$result	= $db->get_row($sql_profile,ARRAY_A);
		//$bus_id = $result['quotes_id'];
	     $sql_find_trade  = "select * from tt_find_trade where tradUid = '".$_SESSION['TTLOGINDATA']['USERID']."' order by added desc"; 
		 $result = mysql_query($sql_find_trade);
		
		//$qryString =" where 1";
	///	$qryString .="  and `tt_messages`.jobId = '".$bus_id."'  ";
	//	$sortyby = '  order by `tt_messages`.jobId';
		
	//	$sql= "select t.*, q.keyword, q.quotes_id, u.userId, u.firstname,u.lastname,u.email from tt_messages as t,tt_quotes as q, tt_user as u where t.jobId=q.quotes_id and u.userId=t.from "; //exit;
		
		 //$sql = "SELECT `m`.id ,`t.*`.title ,`tt_messages`.message,`tt_messages`.from ,`tt_messages`.to,`tt_messages`.jobId,`tt_messages`.created,`tt_quotes`.keyword,`tt_quotes`.quotes_id,`tt_user`.userId,`tt_user`.firstname,`tt_user`.lastname,`tt_user`.email FROM `tt_messages` LEFT JOIN `tt_quotes` ON (`tt_messages`.jobId = `tt_quotes`.quotes_id)  
			//LEFT JOIN `tt_user` ON (`tt_messages`.from=`tt_user`.userId) $qryString $sortyby "; //exit;
			//echo $sql; exit;
		//$res_key = mysql_query("SELECT * FROM `tt_business_keyservices` WHERE `userId` = '$userId' "); 
		/*$count = 0;
		$keyId = 0;
		if(isset($_GET['o']))
			$keyId = (int)$_GET['o'];*/
		//if(mysql_num_rows($res_key)>0){
		?>
		<div class="list-row" style="margin-bottom:0;">
		  <div class="title1"  style="width:166px;font-weight:bold;">Job Title</div>
		   <div class="img1" style="width:94px;font-weight:bold;">Location </div>
		    <div class="desc1" style="width:115px;font-weight:bold;">Customer Name</div>
		    <div class="img1" style="width:44px;font-weight:bold;">Status </div>
		 
		  <div class="img1" style="width:100px;font-weight:bold;">Date Applied </div>
		 
		  
		  <div class="action1" style=" width:30px;font-weight:bold;">Action</div>
		</div>
		<?php
		///////////////////////////////////////////////////////////////////////////////////////
					// include('common/pagingprocess.php');
					 ///////////////////////////////////////////////////////////////////////////////////////
					 /*$sql .=  " LIMIT ".$start.",".$limit;
					 echo $limit; exit;
					 $i=$i+$start;*/
					 //$result = @mysql_query($sql);
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
						
						
					$msg_count_qry = "select * from tt_messages where  `to` = '".$trader_id."' and jobId = '".$items['jobId']."' and `to_viewed` = '0' ";
						$exe_msg_count = @mysql_query($msg_count_qry);
						$unread_count = @mysql_num_rows($exe_msg_count);
						
						
						$bgcolor = ($bgcolor == '#F8F8F8')?'#FFFFFF':'#F8F8F8';
						
						//echo $items['job_title']; exit;
			//while($row_key = mysql_fetch_array($res_key)){
			?>
			<div class="list-row list-row-hover" style="margin-top:0; margin-bottom:0px; background-color:<?php echo $bgcolor; ?>;">
			<div class="title1" style="width:166px;"><?php 
			 $sql_title = "select * from tt_quotes where quotes_id = '".$items['jobId']."'";//exit;
			$result_title = mysql_query($sql_title);
			$row_title = mysql_fetch_array($result_title);
			
			echo stripslashes($row_title['keyword']); ?></div>
			<div style="width:94px;" class="desc1" ><?php echo $row_title['location']; ?></div>
			<div class="img1"><?php 
			  $sql_customer  = "select * from tt_user where userId = '".$row_title['userId']."'"; //exit;
			 $result_customer = mysql_query($sql_customer);
			 $row_customer = mysql_fetch_array($result_customer);
			// echo "<pre>".print_r($row_customer); exit;
			 echo  $row_customer['firstname']." ". $row_customer['lastname'];?></div>
			
			<div style="width:44px;" class="desc1" ><?php echo $row_title['status']; ?></div>
			 
			<div style="width:80px;" class="desc1"><?php echo date("y-m-d",$items['added']); ?></div>
			 
			 
			 <div class="action1">
			 
			 
			 <a style="float:left;"  href="<?php echo $ru; ?>job_particulars/<?php echo $items['jobId']; ?>"><img style="margin:0px"  title="View Job Details" src="<?php echo $ru; ?>images/detail.png" /></a>
			  	<a style="float:left; margin-left:11px;" href="<?php echo $ru; ?>member/job_messages/<?php echo $items['jobId']; ?>"><img style="margin:0px" src="<?php echo $ru; ?>images/email2.jpg" /></a> (<?php echo $unread_count; ?>)
				<!--<a onclick="return confirm('Are you sure you want to delte this Job?');" href="<?php echo $ru; ?>process/process_job.php?action=delete_job&job_invite_id=<?php echo $items['id']; ?>"><img src="<?php echo $ru; ?>images/drop.gif" /></a>-->
			  </div>
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
