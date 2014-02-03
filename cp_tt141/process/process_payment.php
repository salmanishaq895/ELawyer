<?php 
require_once("../../connect/connect.php");
require_once("../security.php");
require_once ('../inc/functii.php');
include ("../inc/upload.php");

//print_r($_REQUEST); exit;
	if ( isset ($_GET['action'])  &&  ($_GET['action']=='delpay'))
	{
		$pid =$_GET['pid'];
		$merchant_Sql = "select * from tt_payment_history where pid = $pid";
		$merchant_rs =mysql_query($merchant_Sql);
		if (mysql_num_rows($merchant_rs) == 0) {header("location:".$ruadmin."home.php?p=payment_log");exit;}
		$rowData =mysql_fetch_array($merchant_rs);
		$merchant_Sql = "delete from tt_payment_history where pid = $pid";
		if( $merchant_rs =mysql_query($merchant_Sql) ){
			$_SESSION['msg'] = 'Payment deleted !';
			header("location:".$ruadmin."home.php?p=payment_log");exit;
					
		} 
	}
?>