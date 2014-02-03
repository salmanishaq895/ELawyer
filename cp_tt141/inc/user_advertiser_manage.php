<?php

if ( isset ($_POST['doSearch'] ) ) 
{ //echo '<pre>';  print_r($_POST); exit;
	$_SESSION['advertiser_em_userStatus']=$_POST['userStatus'];
	$_SESSION['advertiser_em_sType']=$_POST['sType'];
	$_SESSION['advertiser_em_sText']=trim($_POST['sText']);
	$_SESSION['advertiser_em_SortBy']=$_POST['SortBy'];
	$_SESSION['advertiser_em_userType'] = $_POST['userType'];
	$_SESSION['advertiser_em_uType'] = $_POST['type'];
	header("location:".$ruadmin."home.php?p=user_advertiser_manage");exit;
}

$qryString =" where 1  ";


$innerJoin = '';
$qryString .= " and type <> 'a' and type = 'p' ";




if ( $_SESSION['advertiser_em_sText'] != '' )
{
	$qryString .= " and ".$_SESSION['advertiser_em_sType'] ." like '".$_SESSION['advertiser_em_sText']."%'";
}
	
if ( !isset($_SESSION['advertiser_em_SortBy']))
{
	$_SESSION['advertiser_em_SortBy'] = 'userId asc';
}

if(isset($_SESSION['advertiser_em_uType']) && $_SESSION['advertiser_em_uType'] != 'a')
{
	 $qryString .= " and tt_user.type = '".$_SESSION['advertiser_em_uType'] ."' ";	
}


//-------------------------------------------------------------------------

$t.='
		<table cellpadding="0" cellspacing="0" width="100%">
	
	<tr>
		<td style="border:1px solid #DDDDDD; padding:4px;">
		<form method="post" action="">Status:&nbsp;<select name="userStatus"  onchange="document.getElementById(\'sText\').focus()">			
			<option ';
			if ($_SESSION['advertiser_em_userStatus'] =='1' )  $t.=' selected="selected" ';
			$t.=' value="1">ALL</option>	<option ';
			if ($_SESSION['advertiser_em_userStatus'] =='0' )  $t.=' selected="selected" ';
			$t.=' value="0">Active </option><option';
			if ($_SESSION['advertiser_em_userStatus'] =='-1' )  $t.=' selected="selected" ';
			$t.=' value="-1">Pending </option>
						
			</select>&nbsp;Search:&nbsp;<select name="sType" id="sType"    onchange="document.getElementById(\'sText\').focus()">			
			<option ';
			if ($_SESSION['advertiser_em_sType'] =='firstname' )  $t.=' selected="selected" ';
			$t.='value="firstname">First Name</option>
	
			<option ';
			if ($_SESSION['advertiser_em_sType'] =='lastname' )  $t.=' selected="selected" ';
			$t.='value="lastname">Last Name</option>													
			
			<option ';
			if ($_SESSION['advertiser_em_sType'] =='email' )  $t.=' selected="selected" ';
			$t.=' value="email">Email</option>						
			</select>&nbsp;
			<input type="text" id="sText" name="sText" class="text-input" value="'.$_SESSION['advertiser_em_sText'].'">
			&nbsp;Sort&nbsp;By:&nbsp;<select name="SortBy" onchange="document.getElementById(\'sText\').focus()">
			<option  ';	if ($_SESSION['advertiser_em_SortBy'] =='userId asc' )  $t.=' selected="selected" ';	$t.=' value="userId asc">User Id Asc</option>
			<option  ';	if ($_SESSION['advertiser_em_SortBy'] =='userId desc' )  $t.=' selected="selected" ';	$t.=' value="userId desc">User Id Desc</option>
			<option  ';	if ($_SESSION['advertiser_em_SortBy'] =='firstname asc' )  $t.=' selected="selected" ';$t.=' value="firstname asc">Contact Name Asc</option>
			<option  ';	if ($_SESSION['advertiser_em_SortBy'] =='firstname desc' )  $t.=' selected="selected" ';$t.=' value="firstname desc">Contact Name Desc</option>
			<option  ';	if ($_SESSION['advertiser_em_SortBy'] =='email asc' )  $t.=' selected="selected" ';	$t.=' value="email asc">Email Asc</option>
			<option  ';	if ($_SESSION['advertiser_em_SortBy'] =='email desc' )  $t.=' selected="selected" ';$t.=' value="email desc">Email Desc</option>
			</select>
								
			</select><input type="hidden"	value="do_Search" name="do_Search" id="do_Search">
			&nbsp;<input type="submit" class="button" name="doSearch" id="doSearch" value="Filter Listing"   /></form>			
				
		</td>
	</tr>	
	</table>';
	$sortyby = '  order by `tt_user`.'.$_SESSION['advertiser_em_SortBy'];

	$sql = "SELECT * FROM `tt_user`  $qryString $sortyby ";  
	$sqldownload = "SELECT firstname,lastname,email FROM `tt_user` $qryString $sortyby ";
	$sqlcount = "SELECT count(*) FROM `tt_user`  $qryString "; 
	
?>

<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Advertiser User Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
			<h3>Advertiser User Management</h3>
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
					<td colspan="10" style="text-align:center">
						<form action="inc/export_user.php" method="post" >
							<input type="hidden" name="query" id="query" value="<?php echo base64_encode($sqldownload);?>"    />
							<input type="submit" value="Click Here to download export file" class="button" name="export" id="export" />
						</form>
					</td>
				  </tr>
				  <tr>
					<td colspan="10">
					<?php 
						$qrycounts = mysql_query($sqlcount);
						$rowcounts = mysql_fetch_array($qrycounts);
						$total_pages = $rowcounts[0];
						echo "User count: ".$total_pages;
					?>
				  </tr>			
				  <tr>
					<td width="3%"><strong>Id</strong></td>
					<td width="15%"><strong>User Name</strong></td>
					<td width="15%"><strong>Email</strong></td>
					<td width="10%"><strong>Created</strong></td>
					<td width="7%"><strong>Status</strong></td>																					
					<td width="15%"><strong>Action</strong></td>
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
							<td><?php echo $items['firstname'].' '. $items['lastname'];?> </td>							
							<td><?php echo $items['email'];?> </td>	
							<td><?php echo get_DateTimeFormating($items['dated']);?> </td>	
							<td><?php echo $items['status'];?> </td>	
							<td valign="middle">
							<?php if($items['status']=='Pending'){;?>
							<img src="images/mail_send.png"  style="cursor:pointer;" title="email "   alt="email "   
							onClick="window.location='<?php echo $ruadmin; ?>process/process_user.php?action=e&userId=<?php echo $items["userId"];?>&email=<?php echo $items["email"];?>'"  />&nbsp;&nbsp;
							<?php } ?>
							<img src="images/edit.gif"  style="cursor:pointer;" title="Edit "   alt="Edit "  
							 onClick="window.location='home.php?p=user_advertiser_edit&userId=<?php echo $items["userId"];?>'"  />&nbsp;&nbsp;
							<img src="images/dlt.gif"  style="cursor:pointer;" title="Delete " alt="Delete "
							 onClick="if(confirm('Are sure you want to delete')){ window.location='<?php echo $ruadmin; ?>process/process_advertiser.php?action=d&userId=<?php echo $items["userId"];?>'}"  />&nbsp;&nbsp;							
							</td>
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