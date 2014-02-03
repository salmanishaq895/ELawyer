<?php

if ( isset ($_POST['doSearch'] ) ) 
{ //echo '<pre>';  print_r($_POST); exit;
	$_SESSION['banner_type']=$_POST['banner_type'];
	$_SESSION['banner_log_em_sType']=$_POST['sType'];
	$_SESSION['banner_log_em_sText']=trim($_POST['sText']);
	$_SESSION['banner_log_em_SortBy']=$_POST['SortBy'];
	$_SESSION['banner_log_em_userType'] = $_POST['userType'];
	$_SESSION['banner_log_em_uType'] = $_POST['type'];
	header("location:".$ruadmin."home.php?p=banner_log_manage");exit;
}

$qryString =" where 1  ";


$innerJoin = '';
//$qryString .= " and type <> 'a' ";




if ( $_SESSION['banner_log_em_sText'] != '' )
{
	$qryString .= " and ".$_SESSION['banner_log_em_sType'] ." like '".$_SESSION['banner_log_em_sText']."%'";
}
	
if ( !isset($_SESSION['banner_log_em_SortBy']))
{
	$_SESSION['banner_log_em_SortBy'] = '`tt_banner_log`.id desc';
}


if(isset($_SESSION['banner_type']) && $_SESSION['banner_type'] != '')
{
	 $qryString .= " and tt_banner_log.banner_type = '".$_SESSION['banner_type'] ."' ";	
}


//-------------------------------------------------------------------------

$t.='
		<table cellpadding="0" cellspacing="0" width="100%">
	
	<tr>
		<td style="border:1px solid #DDDDDD; padding:4px;">
		<form method="post" action="">Banner Type:&nbsp;<select name="banner_type"  onchange="document.getElementById(\'sText\').focus()">			
			<option ';
			if ($_SESSION['banner_type'] =='' )  $t.=' selected="selected" ';
			$t.=' value="">ALL</option>	<option ';
			if ($_SESSION['banner_type'] =='image' )  $t.=' selected="selected" ';
			$t.=' value="image">Header Banner </option><option';
			if ($_SESSION['banner_type'] =='image2' )  $t.=' selected="selected" ';
			$t.=' value="image2">Footer Banner </option><option';
			if ($_SESSION['banner_type'] =='text' )  $t.=' selected="selected" ';
			$t.=' value="text">Text Banner </option>						
			</select>&nbsp;Sort&nbsp;By:&nbsp;<select name="SortBy" onchange="document.getElementById(\'sText\').focus()">
			<option  ';	if ($_SESSION['banner_log_em_SortBy'] =='tt_banner_log.id asc' )  $t.=' selected="selected" ';	$t.=' value="tt_banner_log.id asc">Log id Asc</option>
			<option  ';	if ($_SESSION['banner_log_em_SortBy'] =='tt_banner_log.id desc' )  $t.=' selected="selected" ';	$t.=' value="tt_banner_log.id desc">Log Id Desc</option>
			<option  ';	if ($_SESSION['banner_log_em_SortBy'] =='tt_banner_log.banner_type asc' )  $t.=' selected="selected" ';$t.=' value="tt_banner_log.banner_type asc">Banner Type Asc</option>
			<option  ';	if ($_SESSION['banner_log_em_SortBy'] =='tt_banner_log.banner_type desc' )  $t.=' selected="selected" ';$t.=' value="tt_banner_log.banner_type desc">Banner Type Desc</option>
			<option  ';	if ($_SESSION['banner_log_em_SortBy'] =='tt_banner_log.dated asc' )  $t.=' selected="selected" ';	$t.=' value="tt_banner_log.dated asc">Dated Asc</option>
			<option  ';	if ($_SESSION['banner_log_em_SortBy'] =='tt_banner_log.dated desc' )  $t.=' selected="selected" ';$t.=' value="tt_banner_log.dated desc">Dated Desc</option>
			</select>
								
			</select><input type="hidden"	value="do_Search" name="do_Search" id="do_Search">
			&nbsp;<input type="submit" class="button" name="doSearch" id="doSearch" value="Filter Listing"   /></form>			
				
		</td>
	</tr>	
	</table>';
	$sortyby = '  order by '.$_SESSION['banner_log_em_SortBy'];

	$sql = "SELECT tt_banner_log.userIp
				 , tt_banner_log.dated
				 , tt_banner_log.id
				 , tt_banner.banner_type
				 , tt_banner.site_url
				 , tt_banner_log.banner_id
			FROM
			  tt_banner
			INNER JOIN tt_banner_log
			ON tt_banner.banner_id = tt_banner_log.banner_id  $qryString $sortyby ";  
	$sqlcount = "SELECT count(tt_banner.banner_id) FROM
							  tt_banner
							INNER JOIN tt_banner_log
							ON tt_banner.banner_id = tt_banner_log.banner_id  $qryString "; 
	
?>

<h3><a href="#">Home</a> &raquo; <a href="#" class="active">View Banner Click Log</a></h3>
<div class="content-box">
	<div class="content-box-header">
			<h3>View Banner Click Log</h3>
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
					<td width="7%"><strong>Banner URL</strong></td>																										
					<td width="7%"><strong>Banner Type</strong></td>
					<td width="7%"><strong>Click IP</strong></td>
					<td width="10%"><strong>Click Date</strong></td>	
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
								if($items['banner_type']=='image')
									$banner_type = 'Header';
								elseif($items['banner_type']=='image2')
									$banner_type = 'Footer';
								elseif($items['banner_type']=='text')
									$banner_type = 'Text';

								
						?>
						  <tr>
							<td><?php echo ++$i;?> </td>						
							<td><?php echo str_replace("http://","",$items['site_url']);?> </td>									
							<td><?php echo $banner_type;?> </td>
							<td><?php echo $items['userIp'];?> </td>
							<td><?php echo $items['dated'];?> </td>
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