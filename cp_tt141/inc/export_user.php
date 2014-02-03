<?php
require_once "ExcelExport.php";
include_once('../../connect/connect.php');
$xls = new ExcelExport();
$xls->addRow(Array("Person Name","Last Name","Email for Business","Business Name","Created","Status"));
	$query = base64_decode($_REQUEST['query']);
	$rs		= $db->get_results($query, ARRAY_A);
	
	if($rs){
		foreach($rs as $rs_row){
			$xls->addRow(Array($rs_row['firstname'],$rs_row['lastname'],$rs_row['email'],$rs_row['name'],$rs_row['dated'],$rs_row['status'])); 
		}
	}else{
		echo "no result found";
	}	

$filename = 'export_trader-'.date('ymdihs').'.xls';
$xls->download($filename);

?>