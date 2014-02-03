<?php 
include ("../../connect/connect.php");
include ("../inc/functii.php");
$domain = $_REQUEST['str'];
if (!preg_match('/^[a-z0-9-]+$/', $domain) || strlen ($domain) < 3 || strlen ($domain) >30 )
{
	echo "#invalid";exit;
}elseif(VerifyDB_Domain($domain)){
	echo "#already";exit;
}
if( checkSwear($domain) )
{
	echo '#swear';exit;
}
echo "#success";exit;
?>