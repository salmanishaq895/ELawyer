<?php 
require_once("../connect/connect.php");
$bId = $_REQUEST['bId'];
$user_IP = $_SERVER['REMOTE_ADDR'];
$str = '';
$time = time();
mysql_query("INSERT INTO `tt_business_tel_view` set fromip = '$user_IP', bussId = '".$bId."', `view_date` = NOW(), `view_time` = '" . $time . "'");
$time2 = $time - 160;
$qry_limit = mysql_query("SELECT * FROM `tt_business_tel_view` WHERE fromip = '$user_IP' AND `view_time` >= $time2 and `view_time` <= $time ");
if(mysql_num_rows($qry_limit)>=10){
	$res_block2 = mysql_query("SELECT * FROM `tt_block_ips` WHERE fromip = '$user_IP'");
	if(mysql_num_rows($res_block2)>0)
		mysql_query("UPDATE `tt_block_ips` SET `add_time` = ".$time." WHERE fromip = '$user_IP'");
	else
		mysql_query("INSERT INTO `tt_block_ips` SET fromip = '$user_IP', `add_time` = ".$time."");
}
$time2 = $time - 86400;
//echo "SELECT * FROM `tt_block_ips` WHERE fromip = '$user_IP' AND `add_time` >= $time2";exit;
$res_block = mysql_query("SELECT * FROM `tt_block_ips` WHERE fromip = '$user_IP' AND `add_time` >= $time2");
if(mysql_num_rows($res_block)>0){
	$str .= '<span style="line-height:15px;">To protect businesses from \'Cold Callers\' you cannot view any further telephone information for a while.</span>';
}else{
	$sql = "SELECT `phone`, `mobile`,`tracked_phone` FROM `tt_business` WHERE `locationid` = '" . $bId . "'";
	$result = @mysql_query($sql);
	$row = mysql_fetch_array($result);
	$str = '';
	if(!empty($row['phone']))
		$str .= '<span>Tel : ' . $row['phone'].'</span>';
	if(!empty($row['tracked_phone']))
		$str .= '<span>Mobile: ' . $row['tracked_phone'].'</span>';
	$str .= '<span style="color:#CC0000;line-height:15px;">WARNING : Using the above information for marketing purposes of any description is strictly prohibited.</span>';
}
echo $str;
exit;
?>