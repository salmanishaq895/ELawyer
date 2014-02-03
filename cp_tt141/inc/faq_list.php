<h3><a href="#">Home</a> &raquo; <a href="#" class="active">FAQ Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>FAQ List Management</h3>
		<div style="float:right;"> <h3><a href="<?php echo $ruadmin; ?>home.php?p=faq_list_add" style="font-size:13px; font-weight:bold; text-decoration:none;"> 
					    Add New FAQ&nbsp;<img src="images/icons/new_faq_class.png" border="0"  style="cursor:pointer;"
							 alt="" title="Add FAQ" /> &nbsp;&nbsp;&nbsp;</a></h3></div>
					  
		<div class="clear"></div>
	</div>
	<div class="content-box-content">                
	<?php if ( isset ($_SESSION['msgText']) ) {?>
	<div class="notification error png_bg">
		<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
		<div>
			<?php echo  $_SESSION['msgText']; unset($_SESSION['msgText']); ?>
		</div>
	</div>	
	<?php } ?>	
	<?php 
	$msg  = $_GET['msg'];
	if (isset($msg)) {?>
	<div class="notification error png_bg">
		<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
		<div>
			<?php echo base64_decode($msg); ?>
		</div>
	</div>	
	<?php } ?>	
<table cellpadding="0" cellspacing="0" border="0" width="100%" id="internaltable">
	
			
					
			<tr>
				<td colspan="4" align="center">
					<table width="100%">
						
					<tr>
						<td width="4%">S#</td>
						<td width="52%">Questione</td>
						<td width="25%">Group Name </td>
						<td width="10%">Status</td>			
						<td width="9%">Action</td>				
					</tr>
					
						
						<?php 
						       	  // pagination 2 of 3 
								  $query = "SELECT count(*) as COUNT from tt_faq  order by faq_id desc";
								  $query_data = $db->get_row($query,ARRAY_A);
								  $numrows = $query_data[COUNT];  
								   $rows_per_page = 50;
								   $lastpage= ceil($numrows/$rows_per_page);
								   $pageno = (int)$pageno;
								 if ($pageno < 1) {
								   $pageno = 1;
								 } elseif ($pageno> $lastpage) {
								   $pageno = $lastpage;
								 } 
								 if($numrows==0)
								  $limit = 'LIMIT ' .($pageno).',' .$rows_per_page;
								  else
								  $limit = 'LIMIT ' .($pageno - 1) * $rows_per_page .',' .$rows_per_page;
								 //..............
							    
							     $min=$pageno;
								 if(isset($min))
								 if(!isset($pageno) or $pageno==1)
								  	$i=0;
								  else
									$i=$min+1;
					  
							   $queryfaq="select * from tt_faq order by faq_id $limit";
							   $rowfaq=$db->get_results($queryfaq,ARRAY_A);
							   $counter=0;
								if(isset($rowfaq))
								foreach($rowfaq as $arrfaq)
								{	
									$counter++;	
									$bgcolor = ($bgcolor == 'class="colortr"')?'class="colortr2"':'class="colortr"';							
									$querymugp="select * from tt_faq_groups where faqg_id=$arrfaq[faq_groupid]";
									$rowmugp=$db->get_row($querymugp,ARRAY_A);
									
						?>
						<tr <?php echo $bgcolor;?>>
							<td>
								<?php echo $counter;?>
							</td>
							<td>
								<?php  echo $arrfaq[faq_question]; 
										
								
								?>
							</td>
							<td>
								<?php  echo $rowmugp[group_title]; 
										
								
								?>
							</td>
							<td>
							<?php $status=$arrfaq[faq_status];
									if($status=="1")
									{
										echo "<a href='process/process_faq.php?p=faq_list&chstatus=0&faqid=$arrfaq[faq_id]'>Active</a>";
									}
										else
									{	
									  echo "<a href='process/process_faq.php?p=faq_list&chstatus=1&faqid=$arrfaq[faq_id]'>Inactive</a>";
									}
							 ?>
							</td>
							<td>
							<img style="cursor:pointer;" src="images/edit.gif" width="18" height="18" border="0" onclick="window.location='home.php?p=faq_list_add&editid=<?php echo $arrfaq[faq_id]?>'" alt="" title="Edit">
								<a href="<?php echo $ruadmin; ?>process/process_faq.php?p=faq_list&deletepage=<?php echo $arrfaq[faq_id]?>" onClick="return confirm('Are you sure your want to delete a record?')">
							<img src="images/dlt.gif" width="18" height="18" border="0" alt="" title="Delete"></a>	</td>
							
							
						</tr>
						<?php 
						
						} ?>
						<tr>
							<td colspan="5" align="center">
								<?php
									//pagination 3 of 3
									if($numrows>$rows_per_page)
									{
									if ($pageno == 1) {
									   echo " FIRST PREV ";
									} else {
									   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=1'>FIRST</a> ";
									   $prevpage = $pageno-1;
									   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$prevpage'>PREV</a> ";
									} 
									//........
									echo " ( Page $pageno of $lastpage ) ";
									
									//....................
									if ($pageno == $lastpage) {
									   echo " NEXT LAST ";

									} else {
									   $nextpage = $pageno+1;
									   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$nextpage'>NEXT</a> ";
									   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$lastpage'>LAST</a> ";
									  
									
									}
									}
								
							 ?> 
							</td>
						</tr>
						
					</table>
				</td>
			</tr>
		</table>
	</div>
</div>	
        