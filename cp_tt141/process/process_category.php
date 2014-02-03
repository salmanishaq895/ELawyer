<?php
require_once("../../connect/connect.php");
require_once("../security.php");
require_once ('../inc/functii.php');
include ("../inc/upload.php");
foreach($_POST  as $key => $value)
{
   $$key = $value;
}
foreach($_GET as $key => $value)
{
   $$key = $value;
}

unset($_SESSION['sesErr']);
unset($_SESSION['regUser']);
$p = $_GET['p'];

/////////////////////////process City /////////////////////////////////////////////////////

if($p=='categories')
{
	$cat_name=trim(addslashes($_POST['cat_name']));
	$featured=trim(addslashes($_POST['featured']));
	if($cat_name=='')
	{
	  $flag=true;
	  $_SESSION['error_add_cat']['cat_name']='Please enter  Category Name';
	}
	if($flag)
	{
	  header("location:".$ruadmin."home.php?p=add_new_category");
	  exit;
	}
	$res_cont = mysql_query("SELECT `catid` FROM tt_category WHERE cat_name='".$cat_name."' AND `p_catid` = 0");
	$row_cont = mysql_fetch_array($res_cont);
	if( mysql_num_rows($res_cont) == 0)
		$sql = "INSERT INTO tt_category set cat_name='".$cat_name."',featured='".$featured."', `cat_type` = '1'";
	else
		$sql = "UPDATE tt_category SET featured='".$featured."', `cat_type` = '1' WHERE `catid` = '".$row_cont['catid']."'";
	mysql_query($sql);
	
	$_SESSION['error_add_cat']['save']='Category added successfully';
	
	header("location:".$ruadmin."home.php?p=categories");
	exit;
	
}

if($p=='editcategory')
{
	$cid=$_GET['cid'];
	$title=trim(addslashes($_POST['title']));
	$featured=trim(addslashes($_POST['featured']));
	if($title=='')
	{
	  $flag=true;
	  $_SESSION['error_add_cat']['cat_name']='please enter  Category';
	}
	if($flag)
	{
	  header("location:".$ruadmin."home.php?p=categories");
	  exit;
	}
	$sql = "UPDATE tt_category SET cat_name='".$title."', featured='".$featured."' WHERE catid =$cid ";
	mysql_query($sql);
	$_SESSION['error_add_cat']['update']=$title.' - updated successfully';
	header("location:".$ruadmin."home.php?p=categories");
	exit;
	
}


if($p=='delcat')
{


	$cid=$_GET['cid'];
	$sql = "DELETE FROM tt_category where catid=".$cid;
	

	if(mysql_query($sql))
	{
		$_SESSION['error_add_cat']['delete']='Category Deleted successfully';
		header("location:".$ruadmin."home.php?p=categories&page=".$_GET['page'].'&cid='.$_GET['RegionID']);
		exit;
	}
	exit;
}



if($p=='addsubcat')
{

   $title=addslashes($_POST['txttitle']);
   $cat=addslashes($_POST['cat']);
   $qrysrc = "SELECT COUNT(`catid`) FROM tt_category WHERE `cat_name`='".$title."' and p_catid = ".$cat." ";
   $qryKcounts = mysql_query($qrysrc);
   $rowKcounts = mysql_fetch_array($qryKcounts);
   $flag=false;
	if($rowKcounts[0]> 0){
	  $flag=true;
	  $_SESSION['titleerror']='Sub Category already exits.';
	  header("location:".$ruadmin."home.php?p=subcategory");
	  exit;

	}
   $flag=false;
   if(!$title)
   {
	  $flag=true;
	  $_SESSION['titleerror']='Please Enter Category';
	  header("location:".$ruadmin."home.php?p=subcategory");
	  exit;
   }

   if(!$flg)
	{
		$sql = "INSERT INTO tt_category set cat_name='".$title."' , p_catid = '".$cat."', `cat_type` = '1' ";
		mysql_query($sql);
		$catId = mysql_insert_id();
		
		$_SESSION['statuss']='Sub Category added successfully';
		header("location:".$ruadmin."home.php?p=subcategory");
		exit;
	}
}

if($p=='editsubcategory')
{
	$cat=addslashes($_POST['cat']);
 $sql = "UPDATE tt_category SET cat_name='".$_POST['title']."' , p_catid = ".$cat." where catid='".$_GET['cid']."' ";
	//exit;
	mysql_query($sql);
	
	$sqlbus = "UPDATE tt_business SET category='".$_POST['title']."' where category='".$_POST['ctitle']."' ";
	mysql_query($sqlbus);	
	
	$_SESSION['statuss']='Sub Category Updated successfully';
	header("location:".$ruadmin."home.php?p=subcategory&page=".$_GET['page']);
	exit;
}


if($p=='delsubcat')
{
	$cid=$_GET['cid'];
	$sql = "DELETE FROM tt_category where catid='".$cid."'";
	if(mysql_query($sql))
	{
		$_SESSION['statuss']='Sub Category  Deleted successfully';
		header("location:".$ruadmin."home.php?p=subcategory&page=".$_GET['page']);
		exit;
	}
	exit;
}



?>