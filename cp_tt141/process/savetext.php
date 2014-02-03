<?php
require_once("../../connect/connect.php");

if (isset ($_POST['SaveTextData']))
{   //print_r($_POST); exit;
    $txtSavePage = $_POST['savepage'];
	$page_title = $_POST['page_title'];
	$page_title =ucwords($page_title);

	$txtData = addslashes($_POST['txtData']); 	
	//$txtData = nl2br($txtData);
	
	$rsCMS=mysql_query("select * from tt_cms where type ='".$txtSavePage."'");
	if ( mysql_num_rows($rsCMS)>0	)
	{		
		$qry="update tt_cms set body = '".$txtData."', page_title = '".$page_title."'  where type ='".$txtSavePage."'";
	}else if($txtSavePage != ""){
		$qry="insert into tt_cms set body = '".$txtData."'  , type ='".$txtSavePage."', page_title = '".$page_title."'";
	}
	@mysql_query($qry);
	$_SESSION['msgText'] = 'Saved Successfuly !';
	header('location:'.$ruadmin.'home.php?p=cmspages&type='.$_POST['savepage']);
}
if (isset ($_POST['SaveTextData2']))
{   //print_r($_POST); exit;
   
	$txtSavePage = $_POST['savepage'];
	$page_title = $_POST['page_title'];
	$page_title =ucwords($page_title);

	$txtData = addslashes($_POST['txtData']); 	
	
	$rsCMS=mysql_query("select * from tt_cms where type ='".$txtSavePage."'");
	if ( mysql_num_rows($rsCMS)>0	)
	{		
		$qry="update tt_cms set body = '".$txtData."', page_title = '".$page_title."'  where type ='".$txtSavePage."'";
	}else if($txtSavePage != ""){
		$qry="insert into tt_cms set body = '".$txtData."'  , type ='".$txtSavePage."', page_title = '".$page_title."'";
	}
	@mysql_query($qry);
	$_SESSION['msgText'] = 'Saved Successfuly !';
	header('location:'.$ruadmin.'home.php?p=cmspages_help_n_tips&type='.$_POST['savepage']);
}
if (isset ($_POST['SaveTextDataReferences']))
{  //echo '<pre>'; print_r($_POST);  echo '<pre>'; print_r($_FILES); exit;
     include ("../inc/upload.php");
	$txtSavePage = $_POST['savepage'];
	$page_title = $_POST['page_title'];
	$page_title =ucwords($page_title);

	$txtData = addslashes($_POST['txtData']); 
	$txtData2 = addslashes($_POST['txtData2']); 	
	
	$rsCMS=mysql_query("select * from tt_cms_reference where type ='".$txtSavePage."'");
	if ( mysql_num_rows($rsCMS)>0	)
	{	$qry="update tt_cms_reference set body = '".$txtData."', body2 = '".$txtData2."', page_title = '".$page_title."'  where type ='".$txtSavePage."'";
	   	if ( isset($_FILES['photo']['tmp_name'])) 
			{ //echo '<pre>'; print_r($_FILES); exit;
				$rewardphoto2 ='';			
				 $upload_dir = $rootpath.'media/referenceimages/';
				
				chmod($upload_dir,0777);	

				$ext= array ('gif','png');			
               
				$file_type=$_FILES['photo']['type']; 		
				if(!empty($_FILES['photo']['name']))
				{ 
					$upload = new upload('photo', $upload_dir, '777', $ext);
					if ($upload->message =="SUCCESS_FILE_SAVED_SUCCESSFULLY" )
					{ 
						$rwdphoto2=$upload->filename;	
						$rewardphoto2 =" photo ='".$rwdphoto2."', ";	
					
					$qry="update tt_cms_reference set body = '".$txtData."', body2 = '".$txtData2."', $rewardphoto2  page_title = '".$page_title."'  where type ='".$txtSavePage."'";	
				

					}else{
						$_SESSION["image_err"]["photo"] = "Error: Upload an Image file.";
					}	
				}
			}	
		
	}else if($txtSavePage != ""){
		
	$qry="insert into tt_cms_reference set body = '".$txtData."',body2 = '".$txtData2."',  type ='".$txtSavePage."', page_title = '".$page_title."'";
	   	if ( isset($_FILES['photo']['tmp_name'])) 
			{ 
				$rewardphoto ='';			
				 $upload_dir = $rootpath.'media/referenceimages/';
				
				chmod($upload_dir,0777);	

				$ext= array ('gif','png');			
               
				 $file_type=$_FILES['photo']['type']; 		
				if(!empty($_FILES['photo']['name']))
				{ 
					$upload = new upload('photo', $upload_dir, '777', $ext);
					if ($upload->message =="SUCCESS_FILE_SAVED_SUCCESSFULLY" )
					{ 
						$rwdphoto=$upload->filename;	
						$rewardphoto =" photo ='".$rwdphoto."', ";	
					
				    $qry="insert into tt_cms_reference set body = '".$txtData."',body2 = '".$txtData2."', $rewardphoto  type ='".$txtSavePage."', page_title = '".$page_title."'";

					}else{
						$_SESSION["image_err"]["photo"] = "Error: Upload an Image file.";
					}	
				}
			}
		
	}
	@mysql_query($qry);
	$_SESSION['msgText'] = 'Saved Successfuly !';
	

	header('location:'.$ruadmin.'home.php?p=cmsreferences&type='.$_POST['savepage']);
}
////////////////  Add an articl /////////////////////////////////////

if (isset ($_POST['savetipspage']))
{
    $txtSavePage = $_POST['savetipspage']; 
	$txtData = addslashes($_POST['txtData']); 	
	
	$rsCMS=mysql_query("select * from tt_cms where type ='".$txtSavePage."'");
	if ( mysql_num_rows($rsCMS)>0	)
	{		
		$qry="update tt_cms set body = '".$txtData."'  where type ='".$txtSavePage."'";
	}else if($txtSavePage != ""){
		$qry="insert into tt_cms set body = '".$txtData."'  , type ='".$txtSavePage."'";
	}
	@mysql_query($qry);
	$_SESSION['msgText'] = 'Saved Successfuly !';
	header('location:'.$ruadmin.'home.php?p=cmstippages&type='.$_POST['savetipspage']);
}
?>