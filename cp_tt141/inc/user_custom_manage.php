<?php
if ( isset ($_POST['doSearch'] ) ) 
{ //echo '<pre>';  print_r($_POST); exit;
	$_SESSION['em_userStatus']=$_POST['userStatus'];
	$_SESSION['em_sType']=$_POST['sType'];
	$_SESSION['em_sText']=trim($_POST['sText']);
	$_SESSION['em_SortBy']=$_POST['SortBy'];
	$_SESSION['em_userType'] = $_POST['userType'];
	//$_SESSION['em_uType'] = $_POST['type'];
	header("location:".$ruadmin."home.php?p=user_custom_manage");exit;
}

$qryString =" where 1  ";


$innerJoin = '';
$qryString .= " and type = 'c'";




if ( $_SESSION['em_sText'] != '' )
{
	$qryString .= " and ".$_SESSION['em_sType'] ." like '".$_SESSION['em_sText']."%'";
}
	
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
		<form method="post" action="">Status:&nbsp;<select name="userStatus"  onchange="document.getElementById(\'sText\').focus()">			
			<option ';
			if ($_SESSION['em_userStatus'] =='1' )  $t.=' selected="selected" ';
			$t.=' value="1">ALL</option>	<option ';
			if ($_SESSION['em_userStatus'] =='0' )  $t.=' selected="selected" ';
			$t.=' value="0">Active </option><option';
			if ($_SESSION['em_userStatus'] =='-1' )  $t.=' selected="selected" ';
			$t.=' value="-1">Pending </option>
						
			</select>&nbsp;Search:&nbsp;<select name="sType" id="sType"    onchange="document.getElementById(\'sText\').focus()">			
			<option ';
			if ($_SESSION['em_sType'] =='firstname' )  $t.=' selected="selected" ';
			$t.='value="firstname">First Name</option>
	
			<option ';
			if ($_SESSION['em_sType'] =='lastname' )  $t.=' selected="selected" ';
			$t.='value="lastname">Last Name</option>							
		
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
		
						<option  ';			if ($_SESSION['em_SortBy'] =='dated asc' )  $t.=' selected="selected" ';			$t.=' value="dated asc">CreatedOn Asc</option>
			<option  ';			if ($_SESSION['em_SortBy'] =='dated desc' )  $t.=' selected="selected" ';			$t.=' value="dated desc">CreatedOn Desc</option>

			
			
	
			</select>
			&nbsp;
			
			<input type="hidden"	value="do_Search" name="do_Search" id="do_Search">
			&nbsp;<input type="submit" class="button" name="doSearch" id="doSearch" value="Filter Listing"   /></form>			
				
		</td>
	</tr>	
	</table>';
	$sortyby = '  order by `tt_user`.'.$_SESSION['em_SortBy'];
	//SELECT a.firstname,a.lastname,a.email,a.loginlogout,a.city,a.state,a.zip,a.dated,a.status,a.type,b.name,b.locationid FROM tt_business as b  INNER JOIN `tt_user` as a ON a.userId=b.userId $qryString $sortyby 
  	$sql = "SELECT `tt_user`.userId,`tt_user`.firstname,`tt_user`.lastname,`tt_user`.email,`tt_user`.type,`tt_user`.status,`tt_user`.dated,`tt_user`.city,`tt_user`.state,`tt_user`.zip,`tt_business`.name,`tt_business`.locationid
		FROM `tt_user` LEFT JOIN `tt_business` ON (`tt_user`.userId = `tt_business`.userId)  $qryString $sortyby ";  
	
	$sqldownload = "SELECT `tt_user`.userId,`tt_user`.firstname,`tt_user`.lastname,`tt_user`.email,`tt_user`.type,`tt_user`.status,`tt_user`.dated,`tt_user`.city,`tt_user`.state,`tt_user`.zip,`tt_business`.name,`tt_business`.locationid
		FROM `tt_user` LEFT JOIN `tt_business` ON (`tt_user`.userId = `tt_business`.userId)  $qryString $sortyby ";
		
	$sqlcount = "SELECT count(*) FROM `tt_user`  $qryString "; 
/*	unset($_SESSION['em_userStatus']);
	unset($_SESSION['em_sType']);
	unset($_SESSION['em_sText']);
	unset($_SESSION['em_SortBy']);
	unset($_SESSION['em_userType']);
*/		
?>

<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Advocate Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
			<h3>Advocate Management</h3>
			<div style="float:right;"> <h3><a href="<?php echo $ruadmin;?>home.php?p=user_add_custom" style=" margin-left:350px; font-size:12px; font-weight:bold;" > Add New Advocate User </a></h3></div>
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
						<form action="inc/export_custom.php" method="post" >
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
					<td width="20%"><strong>Advocate Name</strong></td>
					<!--<td width="20%"><strong>Business Name</strong></td>-->
					<td width="15%"><strong>Email</strong></td>
					<td width="10%"><strong>Location</strong></td>
					<td width="10%"><strong>Created</strong></td>
					<td width="9%"><strong>Status</strong></td>	
					<!--<td width="7%"><strong>Type</strong></td>																				-->
					<td width="6%"><strong>Action</strong></td>
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
							<!--<td>< ?php if($items['name']!=''){ ?>
							 <a href="< ?php echo $ruadmin; ?>home.php?p=business_edit&bId=< ?php echo $items['locationid'];?> ">
							< ?php echo $items['name']; ?>
							</a>
							< ?php }else{ }?> </td>-->
							<td><?php echo $items['email'];?> </td>	
							<td><?php echo $items['city'].' '.$items['state'].' '.$items['zip'];?> </td>	
							<td><?php echo get_DateTimeFormating($items['dated']);?> </td>	
							<td><?php echo $items['status'];?> </td>	
							<!--<td>< ?php if($items['type']=='b'){ echo 'Trader'; }elseif($items['type']=='u') { echo 'Customer';} ?> </td>-->	
							<td valign="middle">
							
							<img src="images/edit.gif"  style="cursor:pointer;" title="Edit "   alt="Edit "   onClick="window.location='home.php?p=user_custom_edit&userId=<?php echo $items["userId"];?>'"  />&nbsp;&nbsp;
							<img src="images/dlt.gif"  style="cursor:pointer;" title="Delete " alt="Delete " onClick="if(confirm('Are sure you want to delete')){ window.location='<?php echo $ruadmin; ?>process/process_user.php?action=cu&userId=<?php echo $items["userId"];?>'}"  />&nbsp;&nbsp;							
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