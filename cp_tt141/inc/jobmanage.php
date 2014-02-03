<?php 
if ( isset ($_POST['doSearch'] ) || isset ($_POST['do_Search'] ) ) 
{
	$_SESSION['bl_bizStatus']=$_POST['userStatus'];
	$_SESSION['bl_sType']=$_POST['sType'];
	$_SESSION['bl_sText']=trim($_POST['sText']);
	$_SESSION['bl_SortBy']=$_POST['SortBy'];
	
	header("location:home.php?p=jobmanage");exit;
}
$qryString = " where 1 ";
if ( isset ($_GET['userId']) && ($_GET['userId']!='')){
	$qryString .= " and tt_quotes.	userId=".$_GET['userId'];
}

if ( !isset($_SESSION['bl_bizStatus']))
{
	$_SESSION['bl_bizStatus'] = 'n'; 
}





/*if($_SESSION['bl_bizStatus']=="n")
{
	$qryString .=  " ";
}
else
{
	$qryString .= " and  tt_job.status = ".$_SESSION['bl_bizStatus']." ";	
}*/








/*if($_SESSION['bl_bizPackage'] == '0')
{
	$qryString .= " and tt_business.btype = '0'";	
}
elseif($_SESSION['bl_bizPackage'] == '1')
{
	$qryString .= " and tt_business.btype = '1'";
}*/


if ( $_SESSION['bl_sText'] != '' )
{
	if($_SESSION['bl_sType']=='username'){
	
	  $qryString .= " and CONCAT(tt_user.firstname, ' ', tt_user.lastname) like '".$_SESSION['bl_sText']."%'";
	//exit;
	}
	else{
	$qryString .= " and ".$_SESSION['bl_sType'] ." like '".$_SESSION['bl_sText']."%'";
	}
}
	
if ( !isset($_SESSION['bl_SortBy']))
{
	$_SESSION['bl_SortBy'] = ' tt_quotes.quotes_id desc';
}

//-------------------------------------------------------------------------

$t.='
	<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td style="border:1px solid #DDDDDD; padding:4px;">
		<form method="post" action="">&nbsp;Search:&nbsp;<select name="sType" id="sType"   onchange="document.getElementById(\'sText\').focus()">			
			<option ';
			if ($_SESSION['bl_sType'] =='keyword' )  $t.=' selected="selected" ';
			$t.='value="keyword">Job Name</option>
			
			<option ';
			if ($_SESSION['bl_sType'] =='username' )  $t.=' selected="selected" ';
			$t.='value="username">User Name</option>
	
			<option ';
			if ($_SESSION['bl_sType'] =='tt_quotes.location' )  $t.=' selected="selected" ';
			$t.='value="tt_quotes.location">Location</option>							

			<input type="text" id="sText"  name="sText" class="text-input" value="'.$_SESSION['bl_sText'].'">
			&nbsp;Sort&nbsp;By:&nbsp;<select name="SortBy" onchange="document.getElementById(\'sText\').focus()">
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_quotes.quotes_id asc' )  $t.=' selected="selected" ';				$t.=' value="tt_quotes.quotes_id asc">Job Id Asc</option>
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_quotes.quotes_id desc' )  $t.=' selected="selected" ';				$t.=' value="tt_quotes.quotes_id desc">Job Id Desc</option>
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_quotes.keyword asc' )  $t.=' selected="selected" '; 			$t.=' value="tt_quotes.keyword asc">Job Name Asc</option>
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_quotes.keyword desc' )  $t.=' selected="selected" ';			$t.=' value="tt_quotes.keyword desc">Job Name Desc</option>
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_quotes.within asc' )  $t.=' selected="selected" ';			$t.=' value="tt_quotes.within asc">With In Asc</option>
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_quotes.within desc' )  $t.=' selected="selected" ';			$t.=' value="tt_quotes.within desc">With In Desc</option>
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_quotes.location asc' )  $t.=' selected="selected" ';			$t.=' value="tt_quotes.location asc">Location Asc</option>						
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_quotes.location desc' )  $t.=' selected="selected" ';			$t.=' value="tt_quotes.location desc">Location Desc</option>									
						
			</select><input type="hidden"	value="do_Search" name="do_Search" id="do_Search">
<input type="submit" class="button" name="doSearch" id="doSearch" value="Filter Listing"   /></form>			
				
		</td>
	</tr>	
	<tr>
		<td>&nbsp;</td>
	</tr></table>';
	$sortyby = '  order by '.$_SESSION['bl_SortBy'];
 	$sql = "SELECT tt_quotes.quotes_id, tt_quotes.keyword,tt_quotes.location,tt_quotes.post_code,tt_quotes.title,tt_quotes.message,tt_quotes.phone,tt_quotes.userId,tt_quotes.status,tt_user.firstname,tt_user.lastname FROM `tt_quotes` LEFT JOIN `tt_user` ON (tt_quotes.userId=tt_user.userId)  $qryString $sortyby "; 
//exit; 
	$sqlcount = "SELECT count(quotes_id) FROM `tt_quotes` LEFT JOIN `tt_user` ON (tt_quotes.userId=tt_user.userId) $qryString $sortyby"; 
//exit;
/*	unset($_SESSION['bl_bizStatus']);
	unset($_SESSION['bl_sType']);
	unset($_SESSION['bl_sText']);
	unset($_SESSION['bl_SortBy']);
	unset($_SESSION['bl_bizPackage']);	*/
?>
<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Job Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
			<h3>Job Management</h3>
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
			
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
				   <tr>
					<td colspan="8">
					<?php 
						$qrycounts = mysql_query($sqlcount);
						$rowcounts = mysql_fetch_array($qrycounts);
						$total_pages = $rowcounts[0];
						echo "Trader count: ".$rowcounts[0];
					?>
				  </tr>					  
				  <tr>
					<td width="5%"><strong>Id</strong></td>
					<td width="15%"><strong>Job Name</strong></td>
					<td width="15%"><strong>Job Description</strong></td>
					<td width="15%"><strong>Customer Name</strong></td>
					<td width="9%"><strong>Phone</strong></td>
					
					<!--<td width="12%"><strong>Phone</strong></td>-->	
					<td width="10%"><strong>City</strong></td>													
					<td width="8%"><strong>Post Code</strong></td>	
					<td width="10%"><strong>Status</strong></td>																		
					<td width="7%"><strong>Action</strong></td>
				  </tr>
				  <?php 
						 ///////////////////////////////////////////////////////////////////////////////////////
						 include("../common/pagingprocess.php");
						 ///////////////////////////////////////////////////////////////////////////////////////
						  $sql .=  " LIMIT ".$start.",".$limit;
						 $i=$i+$start;
						 $result = @mysql_query($sql);
						 $rec = array();
						 while( $row = @mysql_fetch_array($result) )
						 {
							$rec[] = $row;
						 }
							if(count($rec)>0){
							foreach($rec as $items)
							{
								
							?>
							  <tr>
								<td><?php echo ++$i;?> </td>
								<td><a href="home.php?p=editjob&bId=<?php echo $items['jobid'];?> " title="<?php echo stripslashes($items['name']);?>"><?php echo substr(stripslashes($items['keyword']),0,20);?></a> </td>
								<td> <?php echo $items['message'];?></td>
								<td><?php
								//$query_user  =  "select * from tt_user where userId='".$items['userid']."'";
								//$result_user  = mysql_query($query_user);
								//$row_user  = mysql_fetch_array($result_user);
								//echo $row_user['firstname']." ".$row_user['lastname'];
								echo $items['firstname']." ".$items['lastname'];
								 //echo $items['customerName'];?> </td>
								<!--<td><?php echo $items['category'];?> </td>
								<td><?php echo $items['email'];?> </td>-->
								<td><?php echo $items['phone'];?> </td>
								
								<td><?php  echo $items['location'];?> </td>	
								<td><?php  echo $items['post_code'];?> </td>	
								<td><?php  echo $items['status'];?> </td>	

								<!--<?php// if($items['userId']!='1' && $items['userId']!='0'){?>
								<td><a href="home.php?p=editprofile&userId=<?php// echo $items['userId'];?> "><?php //echo $items['firstname'].' '.$items['lastname'];?></a></td>
								<?php // } else {?>
								<td>Admin</td>
								<?php //}?>								
								<td><?php //if($items['btype'] =='0') { echo 'Standard'; } elseif($items['btype'] =='1') { echo 'Premium'; } ?> </td>	
								<td><?php //echo date ('Y-m-d',strtotime( $items['dated']) );?> </td>	
								<td><?php if($items['status'] =='1') { echo 'Active'; } elseif($items['status'] =='0') { echo 'Pending';} elseif($items['status'] =='-1') { echo 'Expired';}?></td>
								<td><?php  echo get_DateFormating($items['expirydate']);?> </td>	-->
								<td>
						<img src="images/edit.gif"  style="cursor:pointer;" title="Edit "   alt="Edit "   onClick="window.location='home.php?p=editjob&quotes_id=<?php echo $items["quotes_id"];?>'"  />&nbsp;&nbsp;
						<img src="images/dlt.gif"  style="cursor:pointer;" title="Delete " alt="Delete " onClick="if(confirm('Are sure you want to delete')){ window.location='<?php echo $ruadmin ;?>process/process_job.php?action=d&quotes_id=<?php echo $items["quotes_id"];?>'}"  />								</td>
							  </tr>	
					  
							<?php
							}
						}
					?>	
				  <tr>
					<td colspan="8"><?php include("../common/paginglayout.php");?></td>
				  </tr>	     			
	  </table>	
			
	</div>
</div>	
<?php
unset($_SESSION['bl_bizStatus']);
unset($_SESSION['bl_sType']);
unset($_SESSION['bl_sText']);
unset($_SESSION['bl_SortBy']);
	
?>