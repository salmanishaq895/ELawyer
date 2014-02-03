<?php 
require_once("../../connect/connect.php");
require_once("../security.php");
require_once ('../inc/functii.php');
//print_r($_REQUEST); exit;
	if( isset ( $_POST['updatecms'] )){	
		
		unset($_SESSION['cms_home_err']);
		unset($_SESSION['cms_home']);
		
		foreach ($_POST as $k => $v ){
			$$k =  addslashes(trim($v ));
			$_SESSION['cms_home'][$k]=$v;
		}
	
		$sql= "update tt_home_settings set    slogan			='".$slogan."', 
													title1			='".$title1."',
													description1	='".$description1."', 
													label1			='".$label1."', 
													title2			='".$title2."',
													description2	='".$description2."', 
													label2			='".$label2."', 
													title3			='".$title3."',
													description3	='".$description3."', 
													label3			='".$label3."',
													title4			='".$title4."', 
													description4	='".$description4."',
													title5			='".$title5."', 
													description5	='".$description5."'  
													where home_id = 1 ";

			$db->query($sql);
			if($db->query($sql))
			{
				$_SESSION['cms_home_err'] = "Cms home page setting updated successfuly "; 
				header('location:'.$ruadmin.'home.php?p=cmshome');
				exit;
			}

		else		
		{
			$_SESSION['cms_home_err'] = "Please enter both sign up charges"; 
			header('location:'.$ruadmin.'home.php?p=cmshome');
			exit;
		}
	}

?>