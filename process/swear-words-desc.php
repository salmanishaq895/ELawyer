<?php 
require_once("../connect/connect.php");
$str = trim($_REQUEST['str']);
if(empty($str)){
	echo "less";exit;
}
$str_arr = explode(' ',$str);
$str_qry = '';
if(count($str_arr)>0){
	foreach($str_arr as $st){
		$st = trim($st);
		if(!empty($st)){
			if(empty($str_qry)){
				$str_qry = " WHERE `word` LIKE '$st'";
			}else{
				$str_qry .= " OR `word` LIKE '$st'";
			}
		}
	}
}
if(strlen($str_qry)>5){
	$sql = "SELECT * FROM `tt_swear_words` ".$str_qry;
	$result = @mysql_query($sql);
	if(mysql_num_rows($result) > 0 ){
		echo 'swear';exit;
	}
}

if(count($str_arr)<30 or count($str_arr)>400)
	echo "less";exit;
?>