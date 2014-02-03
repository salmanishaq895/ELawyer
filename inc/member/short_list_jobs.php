<div class="map_page_right_bar listing_right_bar">
  <div class="brued_crum_bar brued_crum_bar_c">
    <div class="listing_page_brued_crum"> <span class="brurd_curm_inner">Home > Account Panel > Customer Profile > <span class="change"> Short List Job </span></span></div>
  </div>
	<?php //include('notice.php'); ?>
    <div class="cpanel_right_bar">
      <div class="company_detail_description">
	  	<span class="company_detail_span"> Short List Job</span>
		<?php if(isset($_SESSION['key_services_msg'])){?>
			<div style="float:left; width:500px; margin-left:50px; color:#FF0000;"><?php echo $_SESSION['key_services_msg']; ?></div>
		<?php } unset($_SESSION['key_services_msg']); ?>
	  	<?php 
		$userId = $_SESSION['TTLOGINDATA']['USERID'];
		//$sql_profile = "select * from `tt_business` where `userId` = '".$_SESSION['TTLOGINDATA']['USERID']."'";
		//$result	= $db->get_row($sql_profile,ARRAY_A);
		//$bus_id = $result['locationid'];
		$qryString =" where 1";
		$qryString .="  and `tt_shortlist`.userId = '".$userId."'  ";
		 $sortyby = '  order by `tt_shortlist`.shortlist_id';
	 $sql = "SELECT `tt_shortlist`.shortlist_id ,`tt_shortlist`.bId ,`tt_shortlist`.userId,`tt_shortlist`.date_added ,`tt_user`.userId,`tt_user`.firstname,`tt_user`.lastname,`tt_user`.email,`tt_business`.locationid,`tt_business`.name,`tt_business`.address,`tt_business`.phone FROM `tt_shortlist` LEFT JOIN `tt_user` ON (`tt_shortlist`.userId = `tt_user`.userId)
	 LEFT JOIN `tt_business` ON (`tt_shortlist`.bId = `tt_business`.locationid)   $qryString $sortyby "; //exit;
			
		//$res_key = mysql_query("SELECT * FROM `tt_business_keyservices` WHERE `userId` = '$userId' "); 
		/*$count = 0;
		$keyId = 0;
		if(isset($_GET['o']))
			$keyId = (int)$_GET['o'];*/
		//if(mysql_num_rows($res_key)>0){
		?>
		<div class="list-row" style="margin-bottom:0;">
		  <div class="titlej" style="font-weight:bold;">Business Name</div>
		  <!--<div class="title1" style="font-weight:bold;">Title</div>
		  <div class="imgj" style="font-weight:bold;">Message</div>
		  <div class="descss" style="font-weight:bold;">User Name</div>-->
		  <div class="descss" style="font-weight:bold;">Address</div>
		  <div class="descss" style="font-weight:bold;">Date Added</div>
		  <div class="actionss" style="font-weight:bold;">Action</div>
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
			<div class="titlej"><?php echo $items['name']; ?></div>
			<!--<div class="titlej">< ?php echo  substr($items['message'],0,100); ?></div>
			
			 <div class="imgss"><?php echo $items['firstname']." ".$items['lastname'];?></div>-->
			 <div class="descss"><?php echo wordwrap($items['address'],17,"<br />\n",true); ?></div>
			 <div class="descss"><?php echo get_DateTimeFormating($items['date_added']); ?></div>
			 
			 <div class="actionss">
			  	<a href="<?php echo $ru ; ?>profile/<?php echo $items['locationid'].'_'. encodeURL(stripslashes($items['name'])) ; ?>">
				<!--<a href="<?php echo $ru; ?>member/edit_jobs/<?php echo $items['quotes_id']; ?>">--><img src="<?php echo $ru; ?>images/commentreview-.gif" title="Review Business" alt="Review Business"  /></a>
				<a onclick="return confirm('Are you sure you want to delte this Job?');" href="<?php echo $ru; ?>process/process_job.php?action=short_list&shortlist_id=<?php echo $items['shortlist_id']; ?>"><img src="<?php echo $ru; ?>images/drop.gif" /></a>
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
