<script type="text/javascript" src="datepicker/jquery.js"></script>
<script type="text/javascript" src="datepicker/date.js"></script>
<script type="text/javascript" src="datepicker/jquery_002.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="datepicker/datePicker.css" />   
<script type="text/javascript" charset="utf-8">
Date.firstDayOfWeek = 0;
Date.format = 'yyyy-mm-dd';
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

	$_SESSION['status']=$_POST['status'];
	$_SESSION['bl_sType']=$_POST['sType'];
	$_SESSION['bl_sText']=trim($_POST['sText']);
	$_SESSION['fromdate']=trim($_POST['fromdate']);
	$_SESSION['todate']=trim($_POST['todate']);
	$_SESSION['bl_SortBy']=$_POST['SortBy'];
	header("location:home.php?p=merchant_payment");exit;
}
if($_SESSION['fromdate']==''){
	$_SESSION['fromdate'] = date("Y-m").'-01';
}

if($_SESSION['todate']==''){
	$_SESSION['todate'] = date("Y-m-d");
}

$qrywhere = " where 1 ";
if ( isset($_SESSION['status']) && $_SESSION['status']!='')

{
	$qrywhere .=  " and vc_merchantmanagement.status like '".$_SESSION['status']."' ";
}
if ( $_SESSION['bl_sText'] != '' )
{
	$qrywhere .= " and ".$_SESSION['bl_sType'] ." like '".$_SESSION['bl_sText']."%'";
}
if ( !isset($_SESSION['bl_SortBy']))
{
	$_SESSION['bl_SortBy'] = 'vc_merchantmanagement.m_id';
}
if ( isset($_SESSION['fromdate']))
{
	$qrywhere .=  " and paymenthistory.payment_date >= '".$_SESSION['fromdate']."' ";
}

if ( isset($_SESSION['todate']))
{
	$qrywhere .=  " and paymenthistory.payment_date  <= '".$_SESSION['todate']."' ";
}

?>
 <h3><a href="#">Home</a> &raquo; <a href="#" class="active">Payment History</a></h3>
<div class="content-box">
	<div class="content-box-header">
        <h3>Payment History</h3>
		
        <div class="clear"></div>
	</div>
	<div class="content-box-content">
	 <form method="post" action="">
            <table cellpadding="0" cellspacing="0" width="100%"  style="border:1px solid #DDDDDD; padding:4px;">
                <tr>
					
					<td>
					Search:&nbsp;
				<select name="sType" id="sType"   onchange="document.getElementById(\'sText\').focus()">
				<option value="forename"<?php if ($_SESSION['bl_sType'] =='forename' ) { echo 'selected="selected" ';}
	?>>First Name</option>
	<option value="surname"<?php if ($_SESSION['bl_sType'] =='surname' ) { echo 'selected="selected" ';}
	?>>Last Name</option>	
				<option value="bname"<?php if ($_SESSION['bl_sType'] =='bname' ) { echo 'selected="selected" ';}
	?>>Business Name</option>
				<option value="name"<?php if ($_SESSION['bl_sType'] =='name' ) { echo 'selected="selected" ';}
	?>>Offer</option>
				<option value="payment_date"<?php if ($_SESSION['bl_sType'] =='payment_date' ) { echo 'selected="selected" ';}
	?>>Payment Date</option>
			    </select>
					</td>
					<td>
					<input type="text" id="sText"  name="sText" class="text-input" value="<?php $_SESSION['bl_sText']?>">
					</td>
					 <td>
                        From Date:&nbsp;<input type="text" id="fromdate" name="fromdate" class="text-input medium-input" value="<?php echo $_SESSION['fromdate'] ?>">
                     </td>    
                      <td>
                        To Date:&nbsp;<input type="text" id="todate" name="todate" class="text-input medium-input"  value="<?php echo $_SESSION['todate'] ?>">
                     </td>    
					<td>
					<select name="SortBy" onchange="document.getElementById(\'sText\').focus()">
					<option value="vc_merchantmanagement.m_id asc" <?php if ($_SESSION['bl_SortBy'] =='vc_merchantmanagement.m_id asc'){ echo 'selected="selected" ';}?>>Merchant Id Asc</option>
					<option value="vc_merchantmanagement.m_id desc" <?php if ($_SESSION['bl_SortBy'] =='vc_merchantmanagement.m_id desc'){ echo 'selected="selected" ';}?>>Merchant Id Desc</option>
					<option value="vc_merchantmanagement.forename asc" <?php if ($_SESSION['bl_SortBy'] =='vc_merchantmanagement.forename asc'){ echo 'selected="selected" ';}?>>First Name Asc</option>
					<option value="vc_merchantmanagement.forename desc" <?php if ($_SESSION['bl_SortBy'] =='vc_merchantmanagement.forename desc'){ echo 'selected="selected" ';}?>>First Name Desc</option>
					<option value="vc_merchantmanagement.surname asc" <?php if ($_SESSION['bl_SortBy'] =='vc_merchantmanagement.surname asc'){ echo 'selected="selected" ';}?>>Last Name Asc</option>
					<option value="vc_merchantmanagement.surname desc" <?php if ($_SESSION['bl_SortBy'] =='vc_merchantmanagement.surname desc'){ echo 'selected="selected" ';}?>>Last Name Desc</option>
					<option value="vc_merchantmanagement.bname asc" <?php if ($_SESSION['bl_SortBy'] =='vc_merchantmanagement.bname asc'){ echo 'selected="selected" ';}?>>Business Name Asc</option>
					<option value="vc_merchantmanagement.bname desc" <?php if ($_SESSION['bl_SortBy'] =='vc_merchantmanagement.bname desc'){ echo 'selected="selected" ';}?>>Business Name Desc</option>
					<option value="paymenthistory.payment_date asc" <?php if ($_SESSION['bl_SortBy'] =='paymenthistory.payment_date asc'){ echo 'selected="selected" ';}?>>Payment Date Asc</option>
					<option value="paymenthistory.payment_date desc" <?php if ($_SESSION['bl_SortBy'] =='paymenthistory.payment_date desc'){ echo 'selected="selected" ';}?>>Payment Date Desc</option>
					<option value="paymenthistory.locationid asc" <?php if ($_SESSION['bl_SortBy'] =='paymenthistory.locationid asc'){ echo 'selected="selected" ';}?>>Offer Asc</option>
					<option value="paymenthistory.locationid desc" <?php if ($_SESSION['bl_SortBy'] =='paymenthistory.locationid desc'){ echo 'selected="selected" ';}?>>Offer Desc</option>
					</td>
			 		<td>
                        <input type="submit" class="button" name="doSearch" id="doSearch" value="Filter Listing"   />
                 	</td> 
			   </tr>	
            </table>
     </form>			
	<?php if ( isset ($_SESSION['merchant_msg_err']) ) {?>
	<div style="color:#FF0000; margin-top:10px; text-align:center;">
	<?php  echo $_SESSION['merchant_msg_err'];  ?>
	</div>
	<?php } unset($_SESSION['merchant_msg_err']); ?> 
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
	<td colspan="8">
	<?php 
	$sortyby = '  order by '.$_SESSION['bl_SortBy'];
	$qry_merchant= "select  vc_merchantmanagement.m_id,vc_merchantmanagement.title,vc_merchantmanagement.forename,vc_merchantmanagement.surname,vc_merchantmanagement.bname,paymenthistory.userId,paymenthistory.pid,paymenthistory.locationid,payment_status,payment_date,payment_fee,transaction_id,name from paymenthistory LEFT JOIN vc_merchantmanagement on paymenthistory.userId=vc_merchantmanagement.m_id LEFT JOIN vc_business on paymenthistory.locationid=vc_business.locationid $qrywhere $sortyby";
	$qry_merchant_count= "select count(vc_merchantmanagement.m_id) as mcount, vc_merchantmanagement.m_id,vc_merchantmanagement.title,vc_merchantmanagement.forename,vc_merchantmanagement.surname,vc_merchantmanagement.bname,paymenthistory.userId,paymenthistory.pid,paymenthistory.locationid,payment_status,payment_date,payment_fee,transaction_id,name from paymenthistory LEFT JOIN vc_merchantmanagement on paymenthistory.userId=vc_merchantmanagement.m_id LEFT JOIN vc_business on paymenthistory.locationid=vc_business.locationid $qrywhere $sortyby";
	/*$qry_merchant_count= "select count(vc_merchantmanagement.m_id) as mcount from vc_merchantmanagement $qrywhere ";*/		
	$rs_count  = $db->get_row($qry_merchant_count, ARRAY_A);
	unset($_SESSION['status']);
	unset($_SESSION['bl_sType']);
	unset($_SESSION['bl_sText']);
	unset($_SESSION['bl_SortBy']);
	$total_pages =  $rs_count['mcount'];
	echo "Total Payments: ".$total_pages;
	?>
	</tr>			
	<tr>
			<td width="6%"><strong>M.Id</strong></td>
			<td width="13%"><strong>Merchant</strong></td>
			<td width="18%"><strong>Offer</strong></td>
			<td width="19%"><strong>Payment</strong></td>
			<td width="13%"><strong>TansactionID</strong></td>
			<td width="19%"><strong>Date</strong></td>
			<td width="11%"><strong>Amount</strong></td>
			<td width="14%"><strong>Action</strong></td>
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
			<td><?php echo $items['forename'].' '.$items['surname'];?> </td>
			<td><?php echo $items['name'];?> </td>
			<td><?php echo $items['payment_status'];?> </td>
			<td><?php echo $items['transaction_id'];?> </td>
			<td><?php echo $items['payment_date'];?> </td>
			<td>&pound; &nbsp;<?php echo $items['payment_fee'];?> </td>	
			<td valign="middle">
			&nbsp;&nbsp;
			<img src="images/dlt.gif"  style="cursor:pointer;" title="Delete " alt="Delete " onClick="if(confirm('Are sure you want to delete')){ window.location='process/process_business.php?action=d&bId=<?php echo $items["locationid"];?>'}"  />	&nbsp;&nbsp;
			</td>
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