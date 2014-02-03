<?php 
if ( isset ($_POST['doSearch'] ) || isset ($_POST['do_Search'] ) ) 
{
	$_SESSION['bl_bizStatus']=$_POST['userStatus'];
	$_SESSION['bl_sType']=$_POST['sType'];
	$_SESSION['bl_sText']=trim($_POST['sText']);
	$_SESSION['bl_SortBy']=$_POST['SortBy'];
	
	header("location:home.php?p=business");exit;
}
$qryString = " where 1 ";
if ( isset ($_GET['userId']) && ($_GET['userId']!='')){
	$qryString .= " and tt_business.userId=".$_GET['userId'];
}

if ( !isset($_SESSION['bl_bizStatus']))
{
	$_SESSION['bl_bizStatus'] = 'n'; 
}

if($_SESSION['bl_bizStatus']=="n")
{
	$qryString .=  " ";
}
else
{
	$qryString .= " and  tt_business.status = ".$_SESSION['bl_bizStatus']." ";	
}

if($_SESSION['bl_bizPackage'] == '0')
{
	$qryString .= " and tt_business.btype = '0'";	
}
elseif($_SESSION['bl_bizPackage'] == '1')
{
	$qryString .= " and tt_business.btype = '1'";
}


if ( $_SESSION['bl_sText'] != '' )
{
	$qryString .= " and ".$_SESSION['bl_sType'] ." like '".$_SESSION['bl_sText']."%'";
}
	
if ( !isset($_SESSION['bl_SortBy']))
{
	$_SESSION['bl_SortBy'] = ' tt_business.locationid desc';
}

//-------------------------------------------------------------------------

$t.='
	<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td style="border:1px solid #DDDDDD; padding:4px;">
		<form method="post" action="">Status:&nbsp;<select name="userStatus"  onchange="document.getElementById(\'sText\').focus()">			
			<option ';
			if ($_SESSION['bl_bizStatus'] =='1' )  $t.=' selected="selected" ';
			$t.=' value="1">Active</option>	<option ';
			if ($_SESSION['bl_bizStatus'] =='0' )  $t.=' selected="selected" ';
			$t.=' value="0">Pending </option><option';
			if ($_SESSION['bl_bizStatus'] =='-1' )  $t.=' selected="selected" ';
			$t.=' value="-1">Expired</option><option';
			if ($_SESSION['bl_bizStatus'] =='n' )  $t.=' selected="selected" ';
			$t.=' value="n">All </option>
						
			</select>&nbsp;Search:&nbsp;<select name="sType" id="sType"   onchange="document.getElementById(\'sText\').focus()">			
			<option ';
			if ($_SESSION['bl_sType'] =='name' )  $t.=' selected="selected" ';
			$t.='value="name">Trader Name</option>
	
			<option ';
			if ($_SESSION['bl_sType'] =='industry' )  $t.=' selected="selected" ';
			$t.='value="industry">Trader Category</option>	

			<option ';
			if ($_SESSION['bl_sType'] =='tt_business.state' )  $t.=' selected="selected" ';
			$t.='value="tt_business.">State</option>

			<option ';
			if ($_SESSION['bl_sType'] =='tt_business.city' )  $t.=' selected="selected" ';
			$t.='value="tt_business.city">City</option>	
			
			<option ';
			if ($_SESSION['bl_sType'] =='tt_business.zip' )  $t.=' selected="selected" ';
			$t.='value="tt_business.zip">Zipcode</option>							

			<option ';
			if ($_SESSION['bl_sType'] =='tt_business.email' )  $t.=' selected="selected" ';
			$t.=' value="tt_business.email">Email</option>
			</select>
			<input type="text" id="sText"  name="sText" class="text-input" value="'.$_SESSION['bl_sText'].'">
			&nbsp;Sort&nbsp;By:&nbsp;<select name="SortBy" onchange="document.getElementById(\'sText\').focus()">
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.locationid asc' )  $t.=' selected="selected" ';				$t.=' value="tt_business.locationid asc">Trader Id Asc</option>
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.locationid desc' )  $t.=' selected="selected" ';				$t.=' value="tt_business.locationid desc">Trader Id Desc</option>
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.name asc' )  $t.=' selected="selected" '; 			$t.=' value="tt_business.name asc">Trader Name Asc</option>
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.name desc' )  $t.=' selected="selected" ';			$t.=' value="tt_business.name desc">Trader Name Desc</option>
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.industry asc' )  $t.=' selected="selected" ';			$t.=' value="tt_business.industry asc">Category Asc</option>
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.industry desc' )  $t.=' selected="selected" ';			$t.=' value="tt_business.industry desc">Category Desc</option>
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.zip asc' )  $t.=' selected="selected" ';			$t.=' value="tt_business.zip asc">Zipcode Asc</option>						
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.zip desc' )  $t.=' selected="selected" ';			$t.=' value="tt_business.zip desc">Zipcode Desc</option>									
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.city asc' )  $t.=' selected="selected" ';			$t.=' value="tt_business.city asc">City Asc</option>						
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.city desc' )  $t.=' selected="selected" ';			$t.=' value="tt_business.city desc">City Desc</option>									
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.state asc' )  $t.=' selected="selected" ';			$t.=' value="tt_business.state asc">State Asc</option>						
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.state desc' )  $t.=' selected="selected" ';			$t.=' value="tt_business.state desc">State Desc</option>									
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.address asc' )  $t.=' selected="selected" ';			$t.=' value="tt_business.address asc">Address Asc</option>						
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.address desc' )  $t.=' selected="selected" ';			$t.=' value="tt_business.address desc">Address Desc</option>									
															
			</select>&nbsp;
						
			</select><input type="hidden"	value="do_Search" name="do_Search" id="do_Search">
<input type="submit" class="button" name="doSearch" id="doSearch" value="Filter Listing"   /></form>			
				
		</td>
	</tr>	
	<tr>
		<td>&nbsp;</td>
	</tr></table>';
	$sortyby = '  order by '.$_SESSION['bl_SortBy'];
	$sql = "SELECT tt_business.locationid, tt_business.name,tt_business.industry,tt_business.address,tt_business.state,tt_business.city,tt_business.zip,tt_business.email,tt_business.phone,tt_business.btype,tt_business.dated,tt_business.status FROM `tt_business`  $qryString $sortyby ";  
	$sqlcount = "SELECT count(locationid) FROM `tt_business` $qryString"; 
/*	unset($_SESSION['bl_bizStatus']);
	unset($_SESSION['bl_sType']);
	unset($_SESSION['bl_sText']);
	unset($_SESSION['bl_SortBy']);
	unset($_SESSION['bl_bizPackage']);	*/
?>
<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Trader Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
			<h3>Trader Management</h3>
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
					<td width="15%"><strong>Trader Name</strong></td>
					<td width="15%"><strong>Category</strong></td>
					<td width="15%"><strong>Email</strong></td>
					<td width="12%"><strong>Phone</strong></td>
					<td width="18%"><strong>Location</strong></td>														
					<td width="6%"><strong>Status</strong></td>																				
					<td width="11%"><strong>Action</strong></td>
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
								<td><a href="home.php?p=viewbusiness&bId=<?php echo $items['locationid'];?> " title="<?php echo stripslashes($items['name']);?>"><?php echo substr(stripslashes($items['name']),0,20);?></a> </td>
								<td><?php echo $items['industry'];?> </td>
								<td><?php echo $items['email'];?> </td>
								<td><?php echo $items['phone'];?> </td>
								
								<td><?php if($items['city']!='') echo $items['city']." , "; echo $items['state']."  ".$items['zip'];?> </td>	

								<!--<?php// if($items['userId']!='1' && $items['userId']!='0'){?>
								<td><a href="home.php?p=editprofile&userId=<?php// echo $items['userId'];?> "><?php //echo $items['firstname'].' '.$items['lastname'];?></a></td>
								<?php // } else {?>
								<td>Admin</td>
								<?php //}?>								
								<td><?php //if($items['btype'] =='0') { echo 'Standard'; } elseif($items['btype'] =='1') { echo 'Premium'; } ?> </td>	
								<td><?php //echo date ('Y-m-d',strtotime( $items['dated']) );?> </td>	
								--><td><?php if($items['status'] =='1') { echo 'Active'; } elseif($items['status'] =='0') { echo 'Pending';} elseif($items['status'] =='-1') { echo 'Expired';}?></td>	
								<td>
								<img src="images/commentreview-.gif"  style="cursor:pointer;" title="Reviews" alt="Reviews" onClick="window.location='home.php?p=review&reviewId=<?php echo $items["locationid"];?>'"  />&nbsp;&nbsp;
								<img src="images/edit.gif" style="cursor:pointer;" title="Edit" alt="Edit" onClick="window.location='home.php?p=editbusiness&bId=<?php echo $items["locationid"];?>'"  />&nbsp;&nbsp;
								<img src="images/dlt.gif" style="cursor:pointer;" title="Delete" alt="Delete" onClick="if(confirm('Are sure you want to delete')){ window.location='<?php ;$ruadmin ;?>process/process_business.php?action=d&bId=<?php echo $items["locationid"];?>'}"  />								</td>
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