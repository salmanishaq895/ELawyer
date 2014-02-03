<?php
require_once "ExcelExport.php";
include_once('../../connect/connect.php');
$xls = new ExcelExport();
$xls->addRow(Array("Business Name","Person Name","Last Name","Email for Business"));
	$query = base64_decode($_REQUEST['query']);
	$rs		= $db->get_results($query, ARRAY_A);
	
	if($rs){
		foreach($rs as $rs_row){
			$xls->addRow(Array($rs_row['bname'],$rs_row['firstname'],$rs_row['lastname'],$rs_row['email'])); 
		}
	}else{
		echo "no result found";
	}	

$filename = 'export_business-'.date('ymdihs').'.xls';
$xls->download($filename);

?>