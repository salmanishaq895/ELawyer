<?php 
require_once("../connect/connect.php");
$mcatName = $_REQUEST['mcatName'];

$sql_m_cat = "SELECT * FROM `tt_category` WHERE `cat_name` = '" . addslashes($mcatName) . "' AND `cat_type` = '1' ORDER BY cat_name ASC ";
$res_m_cat = @mysql_query($sql_m_cat);
$result_m_cat = mysql_fetch_array($res_m_cat);

$sql = "SELECT * from tt_category where p_catid = '".$result_m_cat['catid']."' AND `cat_type` = '1' order by cat_name asc ";
$result = @mysql_query($sql);
$arr = array();
while($row = mysql_fetch_array( $result ) ){
	$arr[] = array('optionValue'=>$row['catid'],'optionDisplay'=>$row['cat_name']);
}
echo json_encode($arr);exit;
?>