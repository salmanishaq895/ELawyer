<?php 
require_once("../../connect/connect.php");
require_once("../security.php");
require_once ('../inc/functii.php');
//print_r($_REQUEST); exit;
	if( isset ( $_POST['updatecms'] )){	
		
		unset($_SESSION['cms_cal_err']);
		unset($_SESSION['cms_cal']);
		
		foreach ($_POST as $k => $v ){
			$$k =  addslashes(trim($v ));
			$_SESSION['cms_cal'][$k]=$v;
		}
	
		$sql= "update tt_calculator_settings set  description1	='".$description1."' 
													where id = 1 ";

			$db->query($sql);
			if($db->query($sql))
			{
				$_SESSION['cms_cal_err'] = "Cms calculator page setting updated successfuly "; 
				header('location:'.$ruadmin.'home.php?p=cmscalculator');
				exit;
			}
	}

?>