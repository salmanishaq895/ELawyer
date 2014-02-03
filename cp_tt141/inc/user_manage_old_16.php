<?php
if ( isset ($_POST['doSearch'] ) ) 
{
	$_SESSION['em_userStatus']=$_POST['userStatus'];
	$_SESSION['em_sType']=$_POST['sType'];
	$_SESSION['em_sText']=trim($_POST['sText']);
	$_SESSION['em_SortBy']=$_POST['SortBy'];
	$_SESSION['em_userType'] = $_POST['userType'];
	header("location:".$ruadmin."home.php?p=user_manage");exit;
}

$qryString =" where 1  ";

if($_SESSION['em_userStatus']=="Active")
{
	$qryString .= " and status = 'Active' ";	
}
elseif($_SESSION['em_userStatus']=="Pending")
{
	$qryString .= " and status = 'Pending' ";	
}
elseif($_SESSION['em_userStatus']=="Deactive")
{
	$qryString .= " and status = 'Deactive' ";	
}


$innerJoin = '';
$qryString .= " and type <> 'a'";

if ( $_SESSION['em_sText'] != '' )
{
	$qryString .= " and ".$_SESSION['em_sType'] ." like '".$_SESSION['em_sText']."%'";
}
	
if ( !isset($_SESSION['em_SortBy']))
{
	$_SESSION['em_SortBy'] = 'userId asc';
}

//-------------------------------------------------------------------------

$t.='
		<table cellpadding="0" cellspacing="0" width="100%">
	
	<tr>
		<td style="border:1px solid #DDDDDD; padding:4px;">
		<form method="post" action="">Status:&nbsp;<select name="userStatus"  onchange="document.getElementById(\'sText\').focus()">			
			<option ';
			if ($_SESSION['em_userStatus'] =='Active' )  $t.=' selected="selected" ';
			$t.=' value="Active">Active</option>	<option ';
			if ($_SESSION['em_userStatus'] =='Deactive' )  $t.=' selected="selected" ';
			$t.=' value="Deactive">Suspended </option><option
			';
			if ($_SESSION['em_userStatus'] =='Pending' )  $t.=' selected="selected" ';
			$t.=' value="Pending">Pending </option><option ';
			if ($_SESSION['em_userStatus'] =='n' )  $t.=' selected="selected" ';
			$t.=' value="n">All </option>
						
			</select>&nbsp;Search:&nbsp;<select name="sType" id="sType"    onchange="document.getElementById(\'sText\').focus()">			
			<option ';
			if ($_SESSION['em_sType'] =='firstname' )  $t.=' selected="selected" ';
			$t.='value="firstname">First Name</option>
	
			<option ';
			if ($_SESSION['em_sType'] =='lastname' )  $t.=' selected="selected" ';
			$t.='value="lastname">Last Name</option>							
		
			<option ';
			if ($_SESSION['em_sType'] =='state' )  $t.=' selected="selected" ';
			$t.='value="state">State</option>							

			<option ';
			if ($_SESSION['em_sType'] =='city' )  $t.=' selected="selected" ';
			$t.='value="city">City</option>							
			
			<option ';
			if ($_SESSION['em_sType'] =='email' )  $t.=' selected="selected" ';
			$t.=' value="email">Email</option>						
			</select>&nbsp;
			<input type="text" id="sText" name="sText" class="text-input" value="'.$_SESSION['em_sText'].'">
			&nbsp;Sort&nbsp;By:&nbsp;<select name="SortBy" onchange="document.getElementById(\'sText\').focus()">
			<option  ';			if ($_SESSION['em_SortBy'] =='userId asc' )  $t.=' selected="selected" ';				$t.=' value="userId asc">User Id Asc</option>
			<option  ';			if ($_SESSION['em_SortBy'] =='userId desc' )  $t.=' selected="selected" ';				$t.=' value="userId desc">User Id Desc</option>
			<option  ';			if ($_SESSION['em_SortBy'] =='firstname asc' )  $t.=' selected="selected" '; 			$t.=' value="firstname asc">Contact Name Asc</option>
			<option  ';			if ($_SESSION['em_SortBy'] =='firstname desc' )  $t.=' selected="selected" ';			$t.=' value="firstname desc">Contact Name Desc</option>
			<option  ';			if ($_SESSION['em_SortBy'] =='email asc' )  $t.=' selected="selected" ';			$t.=' value="email asc">Email Asc</option>
			<option  ';			if ($_SESSION['em_SortBy'] =='email desc' )  $t.=' selected="selected" ';			$t.=' value="email desc">Email Desc</option>
		
			<option  ';			if ($_SESSION['em_SortBy'] =='updated asc' )  $t.=' selected="selected" ';			$t.=' value="updated asc">UpdatedOn Asc</option>
			<option  ';			if ($_SESSION['em_SortBy'] =='updated desc' )  $t.=' selected="selected" ';			$t.=' value="updated desc">UpdatedOn Desc</option>
			<option  ';			if ($_SESSION['em_SortBy'] =='dated asc' )  $t.=' selected="selected" ';			$t.=' value="dated asc">CreatedOn Asc</option>
			<option  ';			if ($_SESSION['em_SortBy'] =='dated desc' )  $t.=' selected="selected" ';			$t.=' value="dated desc">CreatedOn Desc</option>
			<option  ';			if ($_SESSION['em_SortBy'] =='loginlogut asc' )  $t.=' selected="selected" ';			$t.=' value="loginlogut asc">Loginlogut Asc</option>
			<option  ';			if ($_SESSION['em_SortBy'] =='loginlogut desc' )  $t.=' selected="selected" ';			$t.=' value="loginlogut desc">Loginlogut Desc</option>
			
			<option  ';			if ($_SESSION['em_SortBy'] =='city asc' )  $t.=' selected="selected" ';			$t.=' value="city asc">City Asc</option>
			<option  ';			if ($_SESSION['em_SortBy'] =='city desc' )  $t.=' selected="selected" ';			$t.=' value="city desc">City Desc</option>
			
			<option  ';			if ($_SESSION['em_SortBy'] =='state asc' )  $t.=' selected="selected" ';			$t.=' value="state asc">State Asc</option>
			<option  ';			if ($_SESSION['em_SortBy'] =='state desc' )  $t.=' selected="selected" ';			$t.=' value="state desc">State Desc</option>
			<option  ';			if ($_SESSION['em_SortBy'] =='zip asc' )  $t.=' selected="selected" ';			$t.=' value="zip asc">Zipcode Asc</option>
			<option  ';			if ($_SESSION['em_SortBy'] =='zip desc' )  $t.=' selected="selected" ';			$t.=' value="zip desc">Zipcode Desc</option>
						
			<option  ';			if ($_SESSION['em_SortBy'] =='loginlogut asc' )  $t.=' selected="selected" ';			$t.=' value="loginlogut asc">Loginlogut Asc</option>
			<option  ';			if ($_SESSION['em_SortBy'] =='loginlogut desc' )  $t.=' selected="selected" ';			$t.=' value="loginlogut desc">Loginlogut Desc</option>
			</select>

			&nbsp;<input type="submit" class="button" name="doSearch" id="doSearch" value="Filter Listing"   /></form>			
				
		</td>
	</tr>	
	</table>';
	$sortyby = '  order by '.$_SESSION['em_SortBy'];
	$sql = "SELECT * FROM `tt_user`  $qryString $sortyby ";  
	$sqlcount = "SELECT count(*) FROM `tt_user`  $qryString "; 
/*	unset($_SESSION['em_userStatus']);
	unset($_SESSION['em_sType']);
	unset($_SESSION['em_sText']);
	unset($_SESSION['em_SortBy']);
	unset($_SESSION['em_userType']);
*/		
?>

<h3><a href="#">Home</a> &raquo; <a href="#" class="active">User Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
			<h3>User Management</h3>
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
						echo "User count: ".$total_pages;
					?>
				  </tr>			
				  <tr>
					<td width="3%"><strong>Id</strong></td>
					<td width="15%"><strong>User Name</strong></td>
					<td width="15%"><strong>Email</strong></td>
					<td width="10%"><strong>Location</strong></td>
					<td width="10%"><strong>Login/logout</strong></td>
					<td width="10%"><strong>Created</strong></td>
					<td width="10%"><strong>Updated</strong></td>
					<td width="7%"><strong>Status</strong></td>	
					<td width="7%"><strong>Type</strong></td>																				
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
							<td><?php echo $items['city'].' '.$items['state'].' '.$items['zip'];?> </td>	
							<td><?php echo $items['loginlogout'];?> </td>
							<td><?php echo $items['dated'];?> </td>
							<td><?php echo $items['updated'];?> </td>	
							<td><?php echo $items['status'];?> </td>	
							<td><?php if($items['type']=='b'){ echo 'Trader'; }else { echo 'Customer';} ?> </td>	
							<td valign="middle">
							<img src="images/edit.gif"  style="cursor:pointer;" title="Edit "   alt="Edit "   onClick="window.location='home.php?p=user_edit&userId=<?php echo $items["userId"];?>'"  />&nbsp;&nbsp;
							<img src="images/dlt.gif"  style="cursor:pointer;" title="Delete " alt="Delete " onClick="if(confirm('Are sure you want to delete')){ window.location='<?php echo $ruadmin; ?>process/process_user.php?action=d&userId=<?php echo $items["userId"];?>'}"  />&nbsp;&nbsp;							
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