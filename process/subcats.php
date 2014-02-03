<?php 
require_once("../connect/connect.php");
$catname = $_REQUEST['catname'];

$sql_sub = "SELECT * FROM tt_category WHERE `cat_name` = '" . addslashes($catname) . "' AND `cat_type` = '1'";
$res_sub = mysql_query($sql_sub);
if(mysql_num_rows($res_sub)>0){
	$row_sub = mysql_fetch_array($res_sub);
	$sql = "SELECT * FROM tt_category WHERE p_catid = '" . $row_sub['catid'] . "' AND `cat_type` = '1' ORDER BY cat_name ASC";
	$result = @mysql_query($sql);
	while($row = mysql_fetch_array( $result ) ){
		echo '<span>'.$row['cat_name'].'</span>';
	}
}
exit;
?>