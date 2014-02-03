<?php 	
	ob_start();	
	include ("../connect/connect.php");
	$upsql = "update tt_user set loginlogout=now() where  userId =".$_SESSION['cp_tt']['userId']." ";
	mysql_query($upsql)or die (mysql_error());
	session_destroy();
	$msg=base64_encode('you have logged out successfully !');
	header('location:'.$ruadmin.'index.php?msg='.$msg);
?>