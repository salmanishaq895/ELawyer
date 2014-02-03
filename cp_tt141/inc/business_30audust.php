<?php 
if ( isset ($_POST['doSearch'] ) || isset ($_POST['do_Search'] ) ) 
{
	$_SESSION['bl_bizStatus']=$_POST['userStatus'];
	$_SESSION['bl_sType']=$_POST['sType'];
	$_SESSION['bl_sText']=trim($_POST['sText']);
	$_SESSION['bl_SortBy']=$_POST['SortBy'];
	$_SESSION['ltype'] = $_POST['ltype'];
	header("location:".$ruadmin."home.php?p=business");exit;
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

if(isset($_SESSION['ltype']) && $_SESSION['ltype'] != 'a')
{
	$qryString .= " and tt_business.ltype = ".$_SESSION['ltype'] ." ";	
}



if ( $_SESSION['bl_sText'] != '' )
{
	$qryString .= " and ".$_SESSION['bl_sType'] ." like '".$_SESSION['bl_sText']."%'";
}
	
if ( !isset($_SESSION['bl_SortBy']))
{
	$_SESSION['bl_SortBy'] = ' tt_business.locationid ';
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
			$t.='value="name">Company Name</option>

			<option ';
			if ($_SESSION['bl_sType'] =='tt_business.state' )  $t.=' selected="selected" ';
			$t.='value="tt_business.state">State</option>

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
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.locationid asc' )  $t.=' selected="selected" ';				$t.=' value="tt_business.locationid asc">Company Id Asc</option>
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.locationid desc' )  $t.=' selected="selected" ';				$t.=' value="tt_business.locationid desc">Company Id Desc</option>
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.name asc' )  $t.=' selected="selected" '; 			$t.=' value="tt_business.name asc">Company Name Asc</option>
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.name desc' )  $t.=' selected="selected" ';			$t.=' value="tt_business.name desc">Company Name Desc</option>
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.btype asc' )  $t.=' selected="selected" ';			$t.=' value="tt_business.btype asc">Company Type Asc</option>
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.btype desc' )  $t.=' selected="selected" ';			$t.=' value="tt_business.btype desc">CompanyType Desc</option>
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.zip asc' )  $t.=' selected="selected" ';			$t.=' value="tt_business.zip asc">Zipcode Asc</option>						
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.zip desc' )  $t.=' selected="selected" ';			$t.=' value="tt_business.zip desc">Zipcode Desc</option>									
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.city asc' )  $t.=' selected="selected" ';			$t.=' value="tt_business.city asc">City Asc</option>						
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.city desc' )  $t.=' selected="selected" ';			$t.=' value="tt_business.city desc">City Desc</option>									
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.state asc' )  $t.=' selected="selected" ';			$t.=' value="tt_business.state asc">State Asc</option>						
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.state desc' )  $t.=' selected="selected" ';			$t.=' value="tt_business.state desc">State Desc</option>									
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.address asc' )  $t.=' selected="selected" ';			$t.=' value="tt_business.address asc">Address Asc</option>						
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.address desc' )  $t.=' selected="selected" ';			$t.=' value="tt_business.address desc">Address Desc</option>									
															
			</select>&nbsp;
			
Listing Type:&nbsp;<select name="ltype" id="ltype"  onchange="document.getElementById(\'sText\').focus()">			
			<option ';
			if ($_SESSION['ltype'] =='a' )  $t.=' selected="selected" ';
			$t.=' value="a">All</option>	<option ';
			if ($_SESSION['ltype'] =='2' )  $t.=' selected="selected" ';
			$t.=' value="2">Allied Listing</option><option';
			if ($_SESSION['ltype'] =='1' )  $t.=' selected="selected" ';
			$t.=' value="1">Standard Listing</option><option';
			if ($_SESSION['ltype'] =='0' )  $t.=' selected="selected" ';
			$t.=' value="0">Basic Listing</option>
						
			</select><input type="hidden"	value="do_Search" name="do_Search" id="do_Search">
<center><input type="submit" class="button" name="doSearch" id="doSearch" value="Filter Listing"   /></center> </form>			
				
		</td>
	</tr>	
</table>';
	$sortyby = '  order by '.$_SESSION['bl_SortBy'];
	$sql = "SELECT locationid,name,btype,ltype, city,state,zip,phone,email,website,dated,keywords,status FROM `tt_business` $qryString $sortyby ";  
	
   $sqldownload = "SELECT `tt_business`.ownername as firstname, `tt_business`.managername as lastname , `tt_business`.email as email, `tt_business`.name as bname, `tt_business`.locationid FROM
      		`tt_business`  LEFT JOIN `tt_user` ON (`tt_business`.userId = `tt_user`.userId) $qryString and `tt_business`.email <> '' $sortyby ";
	
    $sqlcount = "SELECT count(locationid) FROM `tt_business` $qryString"; 
	unset($_SESSION['bl_bizStatus']);
	unset($_SESSION['ltype']);
	unset($_SESSION['bl_sText']);
	unset($_SESSION['bl_SortBy']);
	unset($_SESSION['bl_bizPackage']);	
?>
<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Company Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
			<h3>Company Management</h3>
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
				<tr >
					<td colspan="12" style="text-align:center">
					   <form action="inc/export_business.php" method="post" >
                                <input type="hidden" name="query" id="query" value="<?php echo base64_encode($sqldownload);?>"    />
                                <input type="submit" value="Click Here to download export file" class="button" name="export" id="export" />
                            </form>
					</td>
				  </tr>
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
					<td width="25"><strong>Company Name</strong></td>
					<td width="10"><strong>Status</strong></td>
					<td width="10"><strong>Type</strong></td>
					<td width="7%"><strong>Listing</strong></td>					
					<td width="10%"><strong>Phone</strong></td>	
					<td width="20%"><strong>Address</strong></td>									                    
					<td width="10%"><strong>Created On</strong></td>		
   					<td width="11%"><strong>Action</strong></td>																										
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
							if(count($rec)>0){
							foreach($rec as $items)
							{
								//echo '<pre>';print_r($items);exit;
							?>
							   <tr>
								<td><?php echo ++$i;?> </td>
								<td><?php echo stripslashes($items['name']);?> </td>
								<td><?php if($items['status']==1) echo 'Active'; else echo 'Pending';?> </td>
								<td><?php echo $items['btype'];?> </td>
								<td><?php if($items['ltype']==1){ echo 'SL';} elseif($items['ltype']==2){ echo 'AL';}elseif($items['ltype']==0){ echo 'BL';}?> </td>
								<td><?php echo $items['phone'];?> </td>
								<td><?php echo $items['city'].', '.$items['state'].', '.$items['zip'];?> </td>	                          
								<!--<td><?php echo date ('Y-m-d',strtotime( $items['dated']) );?> </td>-->
								<td><?php echo get_DateTimeFormating($items['dated']);?> </td>		
								<td style="text-align:right">
                                   		<?php // if($items['ltype'] ==1 || $items['ltype']==2 ){?>
									<img src="images/details.gif"  style="cursor:pointer;" title="Company Reference"   alt="Company Reference "   onClick="window.location='home.php?p=business_reference&bId=<?php echo $items["locationid"];?>'"  />
									<?php // } ?> 
									<img src="images/edit.gif"  style="cursor:pointer;" title="Edit "   alt="Edit "   onClick="window.location='home.php?p=business_edit&bId=<?php echo $items["locationid"];?>'"  />&nbsp;&nbsp;
									<img src="images/dlt.gif"  style="cursor:pointer;" title="Delete " alt="Delete " onClick="if(confirm('Are sure you want to delete')){ window.location='process/process_business.php?action=d&bId=<?php echo $items["locationid"];?>'}"  />								
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
