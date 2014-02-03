<?php 
include("../connect/connect.php");

if(isset($_POST['form_name']) and $_POST['form_name']=='find-job'){
	
		
		if(empty($_POST['search_cat']) or $_POST['search_cat'] == '' or $_POST['search_cat'] == 'All Trades'){			
			$category = 'all';
		}
		else{
			$category = trim($_POST['search_cat']);
			$category = str_replace(' ','_', $category);			
		}		
		if($_POST['txt_location'] == '' or $_POST['txt_location'] == 'e.g city or postcode'){
			$city = 'all';
		}		
		else{			
			$city = trim($_POST['txt_location']);
			$city = str_replace(' ','_', $city);
		}
		header('location:' . $ru . 'find-job/'.$category.'/'.$city);exit;
	
}
header('location:' .$ru. 'find-job/all/all/');
exit;
?>