<?php 	
require_once("../../connect/connect.php");
require_once("../security.php");
require_once ('../inc/functii.php');
	
if($_GET["type"]=='text'){
		$ltype=$_GET["q"];
		$title =$_GET["name"];
		$banner_id =$_GET["id"];
		$sql_update ="update tt_banner set status =$ltype WHERE banner_id = $banner_id ";
		$rs_row		= $db->get_row($sql_update, ARRAY_A);
		echo '"'.$title.'"'.' banner status updated successfully!'; 	
}
if($_GET["type"]=='image'){
		$ltype=$_GET["q"];
		$title =$_GET["name"];
		$banner_id =$_GET["id"];
		$sql_update ="update tt_banner set status =$ltype WHERE banner_id = $banner_id ";
		$rs_row		= $db->get_row($sql_update, ARRAY_A);
		echo '"'.$title.'"'.' banner status updated successfully!'; 	
}
?>