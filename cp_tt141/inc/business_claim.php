<?php 
	 $sql = "SELECT 
					  tt_business_claim.dated,
					  tt_business_claim.`status`,
					  tt_business_claim.Id,
					  tt_business_claim.`claim_expiry`,
					  tt_user.firstname,
					  tt_user.lastname,
					  tt_user.email,
					  tt_user.phone,
					  tt_user.address,
					  tt_user.city,
					  tt_user.state,
					  tt_user.zip,
					  tt_user.ein,
					  tt_business.locationid,
					  tt_business.updated,
					  tt_business.name
					FROM
					  tt_business_claim
					  INNER JOIN tt_business ON (tt_business_claim.bid = tt_business.locationid)
					  INNER JOIN tt_user ON (tt_business_claim.userId = tt_user.userId)
					ORDER BY
					  tt_business.updated desc";  
	
	$sqlcount = "SELECT count(tt_business_claim.Id) FROM
					  tt_business_claim
					  INNER JOIN tt_business ON (tt_business_claim.bid = tt_business.locationid)
					  INNER JOIN tt_user ON (tt_business_claim.userId = tt_user.userId)"; 

?>
<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Business Claim Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
			<h3>Business Claim Management</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">			
		<?php echo $t;  ?>
		<?php if ( isset ($_SESSION['msg']) ) {?>
			<div class="notification error png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					<?php echo  $_SESSION['msg']; unset($_SESSION['msg']); ?>
				</div>
			</div>	
	     <?php } ?>	
			
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				   <tr>
					<td colspan="12">
					<?php 
						$qrycounts = mysql_query($sqlcount);
						$rowcounts = mysql_fetch_array($qrycounts);
						$total_pages = $rowcounts[0];
						echo "Company count: ".$rowcounts[0];
					?>
				  </tr>					  
				  <tr>
					<td width="3%"><strong>Id</strong></td>
					<td width="7%"><strong>Company Name</strong></td>
					<td width="7%"><strong>Person Name</strong></td>
					
					<td width="7%"><strong>Email</strong></td>
					<td width="7%"><strong>EIN #</strong></td>
					<td width="7%"><strong>Days Remaining</strong></td>
					<td width="7%"><strong>Status</strong></td>					
   					<td width="8%"><strong>Action</strong></td>																										
				  </tr>	
				  <?php
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
						// echo '<pre>';print_r($rec);exit;
							if(count($rec)>0){
							foreach($rec as $items)
							{
								//echo '<pre>';print_r($items);exit;
							?>
							   <tr>
								<td><?php echo ++$i;?> </td>
								<td><a href="<?php echo $ru;?>company/<?php echo $items['locationid'];?>/<?php echo stripslashes($items['name']);?>" target="_blank">
								<?php echo stripslashes($items['name']);?> 
								</a></td>
								<td><?php echo stripslashes($items['firstname'].' '.$items['lastname']);?> </td>
								
								<td><?php echo $items['email'];?> </td>
								<td><?php echo $items['ein'];?> </td>
								<td>
								<?php $date =''; 
									$date= $items['claim_expiry'];
									$future = strtotime($date);
									$now = time();
									$timeleft = $future-$now;
									$daysleft = round((($timeleft/24)/60)/60);
									if($daysleft>=1){
										echo $daysleft .'Days';
									}
								?> </td>
								<td><?php if($items['status']==0){echo 'Pending';}elseif($items['status']==1) {echo 'Approved';}elseif($items['status']==2) {echo 'Rejected';}?> </td>
								<td>
								<?php if($items['status']==0){ ?>
									<img src="images/icons/accept.gif"  style="cursor:pointer;" title="Accept " alt="Accept " onClick=" window.location='process/process_claim.php?action=r&bId=<?php echo $items["locationid"];?>'"  />&nbsp;&nbsp;
									<img src="images/icons/cancel.gif"  style="cursor:pointer;" title="Reject " alt="Reject " onClick="if(confirm('Are sure you want to reject')){ window.location='process/process_claim.php?action=d&bId=<?php echo $items["locationid"];?>'}"  />								
								<?php }elseif($items['status']==1){ ?>
									<img src="images/icons/cancel.gif"  style="cursor:pointer;" title="Reject " alt="Reject " onClick="if(confirm('Are sure you want to reject')){ window.location='process/process_claim.php?action=d&bId=<?php echo $items["locationid"];?>'}"  />
								<?php }elseif($items['status']==2){?>
									<img src="images/icons/accept.gif"  style="cursor:pointer;" title="Accept " alt="Accept " onClick=" window.location='process/process_claim.php?action=r&bId=<?php echo $items["locationid"];?>'"  />&nbsp;&nbsp;
								<?php }?>									
								</td>								
                                
							  </tr>	
					  
							<?php
							}
						}
					?>	
				  <tr>
					<td colspan="12"><?php include('common/paginglayout.php');?></td>
				  </tr>	     			
			</table>	
			
	</div>
</div>	
