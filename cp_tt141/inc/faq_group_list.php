<h3><a href="#">Home</a> &raquo; <a href="#" class="active">FAQ Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>FAQ Group Management</h3>
		<div style="float:right;"> <h3>Add New Group	  <img src="images/icons/new_faq_class.png" border="0" style="cursor:pointer;"	onClick="window.location='home.php?p=faq_group_add'" alt="" title="Add Groups" /></h3></div>
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
         <table cellpadding="0" cellspacing="0" border="0" width="100%">
		
		 </table>
		<form name="faqgroup" action="" method="post">
			<table width="100%">
                  <tr>
                    <td width="8%"><strong>Sr.#</strong></td>
                    <td width="31%"><strong>Group Name</strong></td>
                    <td width="30%"><strong>Sorting Order</strong></td>
                    <td width="19%"><strong>Status</strong></td>
                    <td width="12%"><strong>Action</strong></td>
                  </tr>
               
                  <?php 
						       	  // pagination 2 of 3 
								  $query = "SELECT count(*) as COUNT from tt_faq_groups  order by sortorder";
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
					  
							   $queryfaqgroup="select * from tt_faq_groups order by sortorder $limit";
							   $rowfaqgroup=$db->get_results($queryfaqgroup,ARRAY_A);
							   $counter=0;
								if(isset($rowfaqgroup))
								foreach($rowfaqgroup as $arrfaqgroup)
								{									
									$counter++;	
					
						?>
                 <tr>
                    <td><?php echo $counter;?> </td>
                    <td><?php  echo $arrfaqgroup[group_title]; 
										
								
								?>
                    </td>
                    <td><input type="text" name="srtorder<?php echo $arrfaqgroup[faqg_id];?>" class="text-input" value="<?php echo $arrfaqgroup[sortorder];?>"  />
                    </td>
                    <td><?php $status=$arrfaqgroup[group_status];
							if($status=="1")
							{
								echo "<a href='process/process_faq.php?faq_group_list&st=0&faqgroupid=$arrfaqgroup[faqg_id]'>Active</a>";
							}
								else
							{	
								echo "<a href='process/process_faq.php?faq_group_list&st=1&faqgroupid=$arrfaqgroup[faqg_id]'>Inactive</a>";
							}
							 ?>
                    </td>
                    <td><img src="images/edit.gif" width="18" height="18" border="0"  style="cursor:pointer;"
							onClick="window.location='home.php?p=faq_group_add&editidgroup=<?php echo  base64_encode($arrfaqgroup[faqg_id]);?>'" alt="" title="Edit Groups" /> 
							&nbsp;<img style="cursor:pointer;" src="images/dlt.gif" width="16" height="16" border="0"  onclick="window.location='<?php echo $ruadmin; ?>process/process_faq.php?p=faq_list&delid=<?php echo $arrfaqgroup[faqg_id]; ?>'" alt="Delete" title="Delete" />
							</td>
                  </tr>
                  <?php 
						
						} ?>
                  <tr>
                    <td colspan="5" align="right">
					<!--<input type="submit" class="button" name="changesortingorder" value="Update" />-->
					
					<input type="hidden" name="limit" id="limit" value="<?php $limit;?>" />
                    </td>
                  </tr>
                  <tr>
                    <td colspan="5" align="center">
					<?php
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
        </form>
      </div>
  </div>	     