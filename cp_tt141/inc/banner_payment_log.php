<script type="text/javascript" src="<?php echo $ru; ?>datepicker/jquery.js"></script>
<script type="text/javascript" src="<?php echo $ru; ?>datepicker/date.js"></script>
<script type="text/javascript" src="<?php echo $ru; ?>datepicker/jquery_002.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $ru; ?>datepicker/datePicker.css" />   
<script type="text/javascript" charset="utf-8">
Date.format = 'yyyy-mm-dd';
Date.startDate = '1996-01-01';
$(function()
{
	$('#fromdate').datePicker({clickInput:true})
	$('#todate').datePicker({clickInput:true})
});
function setdatevalue(pack){
	document.getElementById('fromdate').value= '<?php echo date("Y-m-d")?>';
	document.getElementById('todate').value= pack.value;
}
</script>
<?php 
if ( isset ($_POST['doSearch'] ) ) 
{

	$_SESSION['bl_pay_status']=$_POST['status'];
	$_SESSION['bl_pay_sType']=$_POST['sType'];
	$_SESSION['bl_pay_sText']=trim($_POST['sText']);
	$_SESSION['bl_pay_fromdate']=trim($_POST['fromdate']);
	$_SESSION['bl_pay_todate']=trim($_POST['todate']);
	$_SESSION['bl_pay_SortBy']=$_POST['SortBy'];
	header("location:home.php?p=banner_payment_log");exit;
}
if($_SESSION['bl_pay_fromdate']==''){
	$_SESSION['bl_pay_fromdate'] = date("Y-m").'-01';
}

if($_SESSION['bl_pay_todate']==''){
	$_SESSION['bl_pay_todate'] = date("Y-m-d");
}

$qrywhere = " where 1 ";
if ( isset($_SESSION['bl_pay_status']) && $_SESSION['bl_pay_status']!='')

{
	$qrywhere .=  " and tt_payment_advertiser.payment_status like '".$_SESSION['bl_pay_status']."' ";
}

if ( !isset($_SESSION['bl_pay_SortBy']))
{
	$_SESSION['bl_pay_SortBy'] = 'tt_payment_advertiser.userId';
}


?>
<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Advertiser Payment History</a></h3>
<div class="content-box">
	<div class="content-box-header">
        <h3>Advertiser Payment History</h3>		
        <div class="clear"></div>
	</div>
	<div class="content-box-content">
	<?php if ( isset ($_SESSION['msg']) ) {?>
			<div class="notification error png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					<?php echo  $_SESSION['msg']; unset($_SESSION['msg']); ?>
				</div>
			</div>	
	     <?php } ?>	
	 <form method="post" action="">
		<table cellpadding="0" cellspacing="0" width="100%"  style="border:1px solid #DDDDDD; padding:4px;">
			<tr>
				<td>
				Search:&nbsp;
					<select name="sType" id="sType"   onchange="document.getElementById(\'sText\').focus()">
						<option value="firstname"<?php if ($_SESSION['bl_pay_sType'] =='firstname' ) { echo 'selected="selected" ';}?>>First Name</option>
						<option value="lastname"<?php if ($_SESSION['bl_pay_sType'] =='lastname' ) { echo 'selected="selected" ';}?>>Last Name</option>	
						<option value="transaction_id"<?php if ($_SESSION['bl_pay_sType'] =='transaction_id' ) { echo 'selected="selected" ';}?>>Transcation ID</option>
						<option value="payment_status"<?php if ($_SESSION['bl_pay_sType'] =='payment_status' ) { echo 'selected="selected" ';}?>>Payment Status</option>
						<option value="payment_date"<?php if ($_SESSION['bl_pay_sType'] =='payment_date' ) { echo 'selected="selected" ';}?>>Payment Date</option>
					</select>
				</td>
				<td>
					<input type="text" id="sText"  name="sText" class="text-input" value="<?php $_SESSION['bl_pay_sText']?>">
				</td>
				<td>
					From Date:&nbsp;<input type="text" id="fromdate" name="fromdate" class="text-input medium-input" value="<?php echo $_SESSION['bl_pay_fromdate'] ?>">
				</td>    
				<td>
					To Date:&nbsp;<input type="text" id="todate" name="todate" class="text-input medium-input"  value="<?php echo $_SESSION['bl_pay_todate'] ?>">
				</td>    
				<td>
					<select name="SortBy" onchange="document.getElementById(\'sText\').focus()">
						<option value="tt_user.firstname asc" <?php if ($_SESSION['bl_pay_SortBy'] =='tt_user.firstname asc'){ echo 'selected="selected" ';}?>>First Name Asc</option>
						<option value="tt_user.firstname desc" <?php if ($_SESSION['bl_pay_SortBy'] =='tt_user.firstname desc'){ echo 'selected="selected" ';}?>>First Name Desc</option>
						<option value="tt_user.lastname asc" <?php if ($_SESSION['bl_pay_SortBy'] =='tt_user.lastname asc'){ echo 'selected="selected" ';}?>>Last Name Asc</option>
						<option value="tt_user.lastname desc" <?php if ($_SESSION['bl_pay_SortBy'] =='tt_user.lastname desc'){ echo 'selected="selected" ';}?>>Last Name Desc</option>
						<option value="tt_payment_advertiser.payment_date asc" <?php if ($_SESSION['bl_pay_SortBy'] =='tt_payment_advertiser.payment_date asc'){ echo 'selected="selected" ';}?>>Payment Date Asc</option>
						<option value="tt_payment_advertiser.payment_date desc" <?php if ($_SESSION['bl_pay_SortBy'] =='tt_payment_advertiser.payment_date desc'){ echo 'selected="selected" ';}?>>Payment Date Desc</option>
					</select>
				</td>
				<td>
					<input type="submit" class="button" name="doSearch" id="doSearch" value="Filter Listing"   />
				</td> 
			</tr>	
		</table>
     </form>			
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
	<td colspan="8">
	<?php 
	//$sortyby = '  order by '.$_SESSION['bl_pay_SortBy'];
/*	$qry_merchant= "select  a.pid,a.transaction_id,a.payment_amount,a.payment_date,a.dateexpiry,a.payment_status,u.firstname,u.lastname from tt_payment_advertiser as a LEFT JOIN tt_user as u on a.userId=u.userId $qrywhere $sortyby "; //$qrywhere $sortyby
	$qry_merchant_count= "select  count(a.pid) as mcount,a.transaction_id,a.payment_amount,a.payment_date,a.dateexpiry,a.payment_status,u.firstname,u.lastname from tt_payment_advertiser as a LEFT JOIN tt_user as u on a.userId=u.userId $qrywhere $sortyby  "; //$qrywhere $sortyby 	*/
	
  $qry_merchant= "SELECT 
				  `tt_user`.firstname,
				  `tt_user`.lastname,
				  `tt_user`.email,
				  `tt_payment_advertiser`.transaction_id,
				  `tt_payment_advertiser`.payment_amount,
				  `tt_payment_advertiser`.payment_date,
				  `tt_payment_advertiser`.payment_status,
				  `tt_payment_advertiser`.locationid,
				  `tt_payment_advertiser`.userId,
				  `tt_payment_advertiser`.pid,
				  `tt_banner`.banner_id
				FROM
				  `tt_payment_advertiser`
				  INNER JOIN `tt_user` ON (`tt_payment_advertiser`.userId = `tt_user`.userId)
				  INNER JOIN `tt_banner` ON (`tt_payment_advertiser`.locationid = `tt_banner`.banner_id) $qrywhere "; //$qrywhere $sortyby
	
	 $qry_merchant_count= "SELECT  count(tt_payment_advertiser.pid) as mcount,
					  `tt_user`.firstname,
					  `tt_user`.lastname,
					  `tt_payment_advertiser`.transaction_id,
					  `tt_payment_advertiser`.payment_amount,
					  `tt_payment_advertiser`.payment_date,
					  `tt_payment_advertiser`.locationid,
					  `tt_payment_advertiser`.payment_status,
					  `tt_payment_advertiser`.userId,
					  `tt_payment_advertiser`.pid,
					  `tt_banner`.banner_id
					FROM
					  `tt_payment_advertiser`
					  INNER JOIN `tt_user` ON (`tt_payment_advertiser`.userId = `tt_user`.userId)
					  INNER JOIN `tt_banner` ON (`tt_payment_advertiser`.locationid = `tt_banner`.banner_id) $qrywhere $sortyby  "; //$qrywhere $sortyby 	

	$rs_count  = $db->get_row($qry_merchant_count, ARRAY_A);
	unset($_SESSION['bl_pay_status']);
	unset($_SESSION['bl_pay_sType']);
	unset($_SESSION['bl_pay_sText']);
	unset($_SESSION['bl_pay_SortBy']);
	$total_pages =  $rs_count['mcount'];
	echo "Total Payments: ".$total_pages;
	?>
	</tr>			
	<tr>
			<td width="6%"><strong>Id</strong></td>
			<td width="20%"><strong>Advertiser Name</strong></td>
			<td width="20%"><strong>Advertiser Email</strong></td>
			<td width="13%"><strong>Profile ID</strong></td>
			<td width="19%"><strong>Date</strong></td>
			<td width="11%"><strong>Amount</strong></td>
			<!--<td width="14%"><strong>Action</strong></td>-->
	</tr>	
	<?php 
	///////////////////////////////////////////////////////////////////////////////////////
	include("common/pagingprocess.php");
	///////////////////////////////////////////////////////////////////////////////////////
	$qry_merchant .=  " LIMIT ".$start.",".$limit;
	$i=$i+$start;
	$result2 = @mysql_query($qry_merchant);
	$rec = array();
	while( $items= @mysql_fetch_array($result2) )
	{
	?>
	<tr>
			<td><?php echo ++$i;?> </td>
			<!--<td><?php echo $items['firstname'].' '.$items['lastname'];?> </td>-->
			<td>
				<!-- <a href="<?php echo $ruadmin; ?>home.php?p=user_edit&userId=<?php echo $items['userId'];?> ">-->
				<?php echo $items['firstname'].' '.$items['lastname']; ?>
				<!--</a>-->
			 </td>
			 <td><?php echo $items['email'];?> </td>
			<td><?php echo $items['transaction_id'];?> </td>
			<td><?php echo $items['payment_date'];?> </td>
			<td>$<?php echo $items['payment_amount'];?> </td>
		<!--	<td valign="middle">
			&nbsp;&nbsp;
			<img src="images/dlt.gif"  style="cursor:pointer;" title="Delete " alt="Delete " onClick="if(confirm('Are sure you want to delete')){ window.location='process/process_payment.php?action=delpay&pid=<?php echo $items["pid"];?>'}"  />	&nbsp;&nbsp;
			</td>-->
	</tr>	
	<?php
	}
	?>	
	<tr>
		<td colspan="8"><?php include("common/paginglayout.php");?></td>
	</tr>	     			
	</table>				
	</div>
	</div>	