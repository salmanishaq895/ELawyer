<?php
if ( isset ($_POST['doSearch'] ) ) 
{ 
	$_SESSION['em_userStatus']=$_POST['userStatus'];
	$_SESSION['em_sType']=$_POST['sType'];
	$_SESSION['em_sText']=trim($_POST['sText']);
	$_SESSION['em_SortBy']=$_POST['SortBy'];
	header("location:".$ruadmin."home.php?p=report_review");exit;
}
//$reviewId	=	$_GET['reviewId'];
$qryString =" where 1 ";
$innerJoin = '';
/*if ( $_SESSION['em_sText'] != '' )
{
	$qryString .= " and ".$_SESSION['em_sType'] ." like '".$_SESSION['em_sText']."%'";
}*/
	
if ( !isset($_SESSION['em_SortBy']))
{
	$_SESSION['em_SortBy'] = 'userId asc';
}

/*if(isset($_SESSION['em_uType']) && $_SESSION['em_uType'] != 'a')
{
	 $qryString .= " and tt_user.type = '".$_SESSION['em_uType'] ."' ";	
}*/


//-------------------------------------------------------------------------

$t.='
		<table cellpadding="0" cellspacing="0" width="100%">
	
	<tr>
		<td style="border:1px solid #DDDDDD; padding:4px;">
		<form method="post" action="">&nbsp;Sort&nbsp;By:&nbsp;<select name="SortBy" onchange="document.getElementById(\'sText\').focus()">
						<option  ';			
			if ($_SESSION['em_SortBy'] =='review asc' )  $t.=' selected="selected" ';			$t.=' value="review asc">Reason Asc</option>
			<option  ';			if ($_SESSION['em_SortBy'] =='review desc' )  $t.=' selected="selected" ';			$t.=' value="review desc">Reason Desc</option>
		
					</select>
			&nbsp;';
		
		  $t.='<input type="hidden"	value="do_Search" name="do_Search" id="do_Search">
			&nbsp;<input type="submit" class="button" name="doSearch" id="doSearch" value="Filter Listing"/></form>			
				
		</td>
	</tr>	
	</table>';
	$sortyby = '  order by `tt_business_reviews`.'.$_SESSION['em_SortBy'];
	$sql = "SELECT `tt_review_error`.review_error_id,`tt_review_error`.reviewId,`tt_review_error`.description,`tt_review_error`.date_added,`tt_business_reviews`.reviewId,`tt_business_reviews`.review,`tt_business_reviews`.bId,`tt_business`.name,`tt_business`.locationid
			FROM `tt_review_error` LEFT JOIN `tt_business_reviews` ON (`tt_review_error`.reviewId = `tt_business_reviews`.reviewId)  
			LEFT JOIN `tt_business` ON (`tt_business_reviews`.bId=`tt_business`.locationid) $qryString $sortyby ";  
		//exit;
		
		
		
		
		
	
	//$sqldownload = "SELECT firstname,lastname,email FROM `tt_user` $qryString $sortyby ";
	
	$sqlcount = "SELECT count(*) FROM `tt_review_error`  $qryString "; 

/*	unset($_SESSION['em_userStatus']);
	unset($_SESSION['em_sType']);
	unset($_SESSION['em_sText']);
	unset($_SESSION['em_SortBy']);
	unset($_SESSION['em_userType']);
*/		
?>

<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Report Review Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
			<h3>Report Review Management</h3>
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
					<td colspan="10">
					<?php 
						$qrycounts = mysql_query($sqlcount);
						$rowcounts = mysql_fetch_array($qrycounts);
						$total_pages = $rowcounts[0];
						echo "Report Review count: ".$total_pages;
					?>
				  </tr>			
				  <tr>
					<td width="3%"><strong>Id</strong></td>
					<td width="16%"><strong>Business Name</strong></td>
					<td width="25%"><strong>Reason</strong></td>
					<td width="25%"><strong>Reviews</strong></td>
				<!--	<td width="10%"><strong>Rating</strong></td>-->
					<td width="5%"><strong>Date Added</strong></td>
					<!--<td width="7%"><strong>Status</strong></td>	
					<td width="7%"><strong>Type</strong></td>	-->																			
					<td width="9%"><strong>Action</strong></td>
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
					if(count($rec)>0)
					{
						foreach($rec as $items)
						{
						?>
						  <tr>
							<td><?php echo ++$i;?> </td>
							<td><?php  if($items['name']!=''){ ?>
							 <a href="<?php echo $ruadmin; ?>home.php?p=business_edit&bId=<?php echo $items['locationid'];?> ">
							<?php echo $items['name']; ?>
							</a>
							<?php }else{ }?> </td>
							<td><?php echo $items['description'];?> </td>
							<td><?php echo $items['review'];?> </td>	
							<!--<td><?php echo $items['rating'];?> </td>	-->
							<td><?php echo get_DateTimeFormating($items['date_added']);
							//get_DateTimeFormating()?> </td>	
							
							<td valign="middle">
							<a href="<?php echo $ruadmin;?>process/process_review.php?action=S&review_error_id=<?php echo $items["review_error_id"];?>" title="Delete Reason" onclick="return confirm('Are sure you want to delete Reason')"> Delete Report</a>
							<!--<img src="images/edit.gif"  style="cursor:pointer;" title="Edit "   alt="Edit "   onClick=""  />--><a href="<?php echo $ruadmin;?>process/process_review.php?action=R&reviewId=<?php echo $items["reviewId"];?>" title="Delete Reason" onclick="return confirm('Are sure you want to delete Review')"> Delete Review</a>
							<!--<img src="images/dlt.gif"  style="cursor:pointer;" title="Delete " alt="Delete " onClick="if(confirm('Are sure you want to delete')){ window.location='<?php echo $ruadmin; ?>process/process_review.php?action=d&reviewId=<?php echo $items["reviewId"];?>'}"  />&nbsp;&nbsp;							
							--></td>
						  </tr>	
				  
						<?php
						}
					}
					?>	
				  <tr>
					<td  colspan="10"><?php include('common/paginglayout.php');?></td>
				  </tr>	     			
			</table>				
	</div>
</div>	