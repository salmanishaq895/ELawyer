<?php 
require_once("../../connect/connect.php");
$mcatId = $_REQUEST['industry'];
 $sql = "SELECT * from tt_category where p_catid = '$mcatId' AND `cat_type` = '1' order by cat_name asc ";
$result = @mysql_query($sql);
$arr = array();
while($row = mysql_fetch_array( $result ) ){
	$arr[] = array('optionValue'=>$row['catid'],'optionDisplay'=>$row['cat_name']);
}
echo json_encode($arr);exit;
?>