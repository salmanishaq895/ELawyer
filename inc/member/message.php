<div class="map_page_right_bar listing_right_bar">
  <div class="brued_crum_bar brued_crum_bar_c">
    <div class="listing_page_brued_crum"> <span class="brurd_curm_inner">Home > Account Panel > Customer Profile > <span class="change"> Applied Job </span></span></div>
  </div>
	<?php //include('notice.php'); ?>
    <div class="cpanel_right_bar">
      <div class="company_detail_description">
	  	<span class="company_detail_span">Manage Enquiry</span>
		<?php if(isset($_SESSION['key_services_msg'])){?>
			<div style="float:left; width:500px; margin-left:50px; color:#FF0000;"><?php echo $_SESSION['key_services_msg']; ?></div>
		<?php } unset($_SESSION['key_services_msg']); ?>
	  	<?php 
		//$userId = $_SESSION['TTLOGINDATA']['USERID'];
		$sql_profile = "select * from `tt_business` where `userId` = '".$_SESSION['TTLOGINDATA']['USERID']."'";
		$result	= $db->get_row($sql_profile,ARRAY_A);
		$bus_id = $result['locationid'];
		$qryString =" where 1";
		$qryString .="  and `tt_enquiry`.bId = '".$bus_id."'  ";
		$sortyby = '  order by `tt_enquiry`.bId';
		 $sql = "SELECT `tt_enquiry`.enquiry_id ,`tt_enquiry`.userId ,`tt_enquiry`.bId,`tt_enquiry`.title ,`tt_enquiry`.description,`tt_enquiry`.date_added,`tt_business`.name,`tt_business`.locationid,`tt_user`.userId,`tt_user`.firstname,`tt_user`.lastname,`tt_user`.email FROM `tt_enquiry` LEFT JOIN `tt_business` ON (`tt_enquiry`.bId = `tt_business`.locationid)  
			LEFT JOIN `tt_user` ON (`tt_enquiry`.userId=`tt_user`.userId) $qryString $sortyby "; //exit;
			
		//$res_key = mysql_query("SELECT * FROM `tt_business_keyservices` WHERE `userId` = '$userId' "); 
		/*$count = 0;
		$keyId = 0;
		if(isset($_GET['o']))
			$keyId = (int)$_GET['o'];*/
		//if(mysql_num_rows($res_key)>0){
		?>
		<div class="list-row" style="margin-bottom:0;">
		  <div class="title1" style="font-weight:bold;">Title</div>
		  <div class="img1" style="font-weight:bold;">Message</div>
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
			<div class="title1"><?php echo $items['title']; ?></div>
			<div class="desc1"><?php echo $items['description']; ?></div>
			 <div class="img1"><?php echo $items['firstname']." ".$items['lastname'];?></div>
			 
			 <div class="action1">
			  	<a href="<?php echo $ru; ?>process/process_enquiry.php?action=send_message&enquiry_id=<?php echo $items['enquiry_id']; ?>"><img src="<?php echo $ru; ?>images/email2.jpg" /></a>
				<a onclick="return confirm('Are you sure you want to delte this Message?');" href="<?php echo $ru; ?>process/process_enquiry.php?action=delete_message&enquiry_id=<?php echo $items['enquiry_id']; ?>"><img src="<?php echo $ru; ?>images/drop.gif" /></a>
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
