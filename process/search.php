<?php 
include("../connect/connect.php");
if(isset($_POST['detailed_search'])){
	if($_POST['searchby'] == 'category' and isset($_POST['search_cat'])){
		if(!empty($_POST['search_sub_cat'])){
			$qry = "SELECT * FROM `tt_category` WHERE `cat_name` = '". trim($_POST['search_sub_cat']) . "' AND `cat_type` = '1'";
		}else{
			$qry = "SELECT * FROM `tt_category` WHERE `cat_name` = '" . trim($_POST['search_cat']) . "' AND `cat_type` = '1'";
		}
		$res = mysql_query($qry);
		$row = mysql_fetch_array($res);
		if($_POST['txt_location'] == '' or $_POST['txt_location'] == 'e.g city or postcode')
			$city = 'all';
		else
			$city = $_POST['txt_location'];
		
		$miles = '';
		if(!empty($_POST['search_miles']))
			$miles = trim(str_replace('Miles', '', $_POST['search_miles'])).'/';
		header('location:' . $ru . 'listings/category/'.$row['catid'].'/'.encodeURL($city).'/'.$miles);exit;
	}else{
		$keyword = trim( $_POST['txt_keyword']);
if( $keyword == "e.g builder, plumber, electrician, etc" || $keyword=='e.g plumber, builder, electrician' || $keyword=='' ) $keyword = 'all';
		$city = trim( $_POST['txt_location']);
		if( $city == '' or $city == 'e.g city or postcode' ) $city = 'all';
		
		$miles = '';
		if(!empty($_POST['search_miles']))
			$miles = trim(str_replace('Miles', '', $_POST['search_miles'])).'/';
		
		header('location:' .$ru. 'listings/'.encodeURL($keyword) .'/'.encodeURL($city).'/'.$miles);
		exit;
	}
}elseif ( isset ($_POST['txt_keyword']) || isset ($_POST['txt_location'])){
	$keyword = trim( $_POST['txt_keyword']);
	if($keyword=="e.g builder, plumber, electrician, etc" || $keyword=='') $keyword = 'all';

	$city = trim( $_POST['txt_location']);
	if( $city == '' or $city == 'e.g city or postcode' ) $city = 'all';
		
	header('location:' .$ru. 'listings/'.encodeURL($keyword) .'/'.encodeURL($city).'/');
	exit;
}
header('location:' .$ru. 'listings/all/all/');
exit;
?>