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

if($p=='swear')
{
	$cat_name=trim(addslashes($_POST['cat_name']));
	$featured=trim(addslashes($_POST['featured']));
	if($cat_name=='')
	{
	  $flag=true;
	  $_SESSION['error_add_cat']['cat_name']='Please enter  Swear';
	}
	if($flag)
	{
	  header("location:".$ruadmin."home.php?p=add_swear");
	  exit;
	}
	//$res_cont = mysql_query("SELECT `catid` FROM tt_category WHERE cat_name='".$cat_name."' AND `p_catid` = 0");
	//$row_cont = mysql_fetch_array($res_cont);
	//if( mysql_num_rows($res_cont) == 0)
		$sql = "INSERT INTO tt_swear_words set word='".$cat_name."'";
	//else
	//	$sql = "UPDATE tt_category SET featured='".$featured."', `cat_type` = '1' WHERE `catid` = '".$row_cont['catid']."'";
	mysql_query($sql);
	
	$_SESSION['error_add_cat']['save']='Word added successfully';
	
	header("location:".$ruadmin."home.php?p=swear");
	exit;
	
}

if($p=='editswear')
{
	$id=$_GET['id'];
	$title=trim(addslashes($_POST['title']));
	//$featured=trim(addslashes($_POST['featured']));
	if($title=='')
	{
	  $flag=true;
	  $_SESSION['error_add_cat']['word']='please enter  Word';
	}
	if($flag)
	{
	  header("location:".$ruadmin."home.php?p=swear");
	  exit;
	}
	$sql = "UPDATE tt_swear_words SET word='".$title."' WHERE id =$id ";
	mysql_query($sql);
	$_SESSION['error_add_cat']['update']=$title.' - updated successfully';
	header("location:".$ruadmin."home.php?p=swear");
	exit;
	
}


if($p=='delswear')
{


	$id=$_GET['id'];
	$sql = "DELETE FROM tt_swear_words where id=".$id;
	

	if(mysql_query($sql))
	{
		$_SESSION['error_add_cat']['delete']='Swear Word Deleted successfully';
		header("location:".$ruadmin."home.php?p=swear&page=".$_GET['page']);
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