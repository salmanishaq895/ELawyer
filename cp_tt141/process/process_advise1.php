<?php
require_once("../../connect/connect.php");
include ("../inc/upload.php");

if (isset ($_POST['SaveTextAdvise']))
{  

	$advise_id = $_POST['advise_id'];
	$advise_title = addslashes(trim($_POST['advise_title']));
	$advise_description = addslashes(trim($_POST['advise_description'])); 
	$advise_short_description = addslashes(trim($_POST['advise_short_description'])); 	

	$qry="update tt_advise set advise_description = '".$advise_description."', advise_short_description = '".$advise_short_description."', advise_title = '".$advise_title."'  where advise_id ='".$advise_id."'";
	@mysql_query($qry);
	
	if ( isset($_FILES['advise_image']['tmp_name'])){ 
		//echo '<pre>'; print_r($_FILES); exit;

			$upload_dir = '../../media/advise_image/'.$advise_id.'/';
			chmod($upload_dir,0777);	
			$ext= array ('gif','png','jpg','bmp');			
		   
			$file_type=$_FILES['advise_image']['type']; 		
			if(!empty($_FILES['advise_image']['name']))
			{ 
				$upload = new upload('advise_image', $upload_dir, '777', $ext);
				if ($upload->message =="SUCCESS_FILE_SAVED_SUCCESSFULLY" )
				{ 
					$imagename=$upload->filename;	
								
					$qry2="update tt_advise set  advise_image = '".$imagename."'   where advise_id ='".$advise_id."'";	
					@mysql_query($qry2);

				}else{
					$_SESSION["image_err"]["advise_image"] = "Error: Upload an Image file.";
				}	
			}
		}	
	

	$_SESSION['msgText'] = 'Saved Successfuly !';
	header('location:'.$ruadmin.'home.php?p=advise_tip&advise_id='.$advise_id);
}



//++++++++++++++++++++++++ this code is used for the advise and tip

if (isset ($_POST['Advise']))
{ 
		unset($_SESSION['biz_reg_err']);
	    unset($_SESSION['biz_reg']);
	
	//echo "<pre>";print_r($_POST); exit;
	
	foreach ($_POST as $k => $v ){
		$$k =  $v;
		$_SESSION['biz_reg'][$k]=$v;
	}
  	$flgs = false;
	
	if($advise_title=='')
	{
	
	$_SESSION['biz_reg_err']['advise_title']= "Please insert the Advise title";
	$flgs  = true;
	
	}
	
$qry_pagename  =  "select * from tt_advise where seo_page = '".$pagename."'";
$result_pagename  =  mysql_query($qry_pagename);
if(mysql_num_rows($result_pagename)>0)
{
$_SESSION['biz_reg_err']['pagename']= "The Seo page already Exit . Please another one";
	$flgs  = true;
	

}


if($pagename=='')
	{
	
	$_SESSION['biz_reg_err']['pagename']= "Please insert the Seo page title";
	$flgs  = true;
	
	}
	
	
	if($advise_short_description=='')
	{
	
	$_SESSION['biz_reg_err']['advise_short_description']= "Please insert the short desctiption";
	$flgs  = true;
	
	}
	
	
	if($advise_description=='')
	{
	
	$_SESSION['biz_reg_err']['advise_description']= "Please insert the desctiption";
	$flgs  = true;
	
	}
	
	
	if($flgs)
	{
	header('location:'.$ruadmin.'home.php?p=new_advise_and_tip'); exit;
	
	}
	
	$qry_advise  = "INSERT INTO tt_advise SET advise_title= ' " .$advise_title. " ' ,advise_short_description = ' " .$advise_short_description. " ' , advise_description = '".$advise_description."',set_for_home = '".$yesno."',seo_page='".$pagename."', date_added = now()";
	
	$result_advise  = mysql_query($qry_advise);
   
   $id  = mysql_insert_id();	


if ( isset($_FILES['advise_image']['tmp_name'])) 
		{ 
		

			mkdir ('../../media/advise_image/' .$id.'/' ,0777) ;
			mkdir ('../../media/advise_image/' .$id.'/logo/' , 0777);
			mkdir ('../../media/advise_image/' .$id.'/logo/thumb/', 0777);
		
			$upload_dir = '../../media/advise_image/' .$id.'/logo/';
			$thutt_folder =$upload_dir .'thumb/';
			
			$logo ='';			
			chmod($upload_dir,0777);	
			chmod($thutt_folder,0777);	
			$ext= array ('gif','jpg','jpeg','png','bmp');			
			$companylogo = "advise_image"; 
		
			$file_type=$_FILES[$companylogo]['type'];   			
			if(!empty($_FILES[$companylogo]['name']))
			{
				$upload = new upload($companylogo, $upload_dir, '777', $ext);
				if ($upload->message =="SUCCESS_FILE_SAVED_SUCCESSFULLY" )
				{
					$logo=$upload->filename;					
					require_once($rootpath.'phpThumb/phpthumb.class.php');
					$phpThumb = new phpThumb();
					$thumbnail_width = 120;
					$phpThumb->setSourceFilename($upload_dir.$logo);
					$output_filename = $thutt_folder.$logo;
					
					// set parameters (see "URL Parameters" in phpthumb.readme.txt)
					$phpThumb->setParameter('w',$thumbnail_width);
					
					// generate & output thumbnail
					if ($phpThumb->GenerateThumbnail()) { // this line is VERY important, do not remove it!
					if ($phpThumb->RenderToFile($output_filename)) {
						// do something on success
						//echo 'Successfully rendered to "'.$output_filename.'"';
					} 
					} 
					$insQry ="update  tt_advise set advise_image ='$logo' where advise_id	= $id";	
					mysql_query($insQry)or die (mysql_error());
					
					}else{
					$_SESSION["biz_reg_err"]["logo"] = "Error: Upload an Image file.";
					}	
			}
		}	
	

	$_SESSION['msgText'] = 'Saved Successfuly !';
	header('location:'.$ruadmin.'home.php?p=advise_and_tip');




}


if($_GET['advise_id'])
{

$qry_delet    = "DELETE FROM tt_advise where advise_id = '".$_GET['advise_id']."'";

$result_delet  = mysql_query($qry_delet);
$_SESSION['msg'] =  "Delete Successfully!";
header('location:'.$ruadmin.'home.php?p=advise_and_tip');


}



//+++++++++++++++ this code is used for the edit advise +++++++++++++

if (isset ($_POST['EditAdvise']))
{  


unset($_SESSION['biz_reg_err']);
	    unset($_SESSION['biz_regg']);
	
	//echo "<pre>";print_r($_POST); exit;
	
	foreach ($_POST as $k => $v ){
		$$k =  $v;
		$_SESSION['biz_regg'][$k]=$v;
	}
  	$flgs = false;
	
	if($advise_title=='')
	{
	
	$_SESSION['biz_reg_err']['advise_title']= "Please insert the Advise title";
	$flgs  = true;
	
	}
	
if($pagename=='')
	{
	
	$_SESSION['biz_reg_err']['pagename']= "Please insert the Seo page title";
	$flgs  = true;
	
	}
	
	
	if($advise_short_description=='')
	{
	
	$_SESSION['biz_reg_err']['advise_short_description']= "Please insert the short desctiption";
	$flgs  = true;
	
	}
	
	
	if($advise_description=='')
	{
	
	$_SESSION['biz_reg_err']['advise_description']= "Please insert the desctiption";
	$flgs  = true;
	
	}
	
	
	if($flgs)
	{
	header('location:'.$ruadmin.'home.php?p=edit_advise&advise_id='.$advis_id); exit;
	
	}

	//$advise_id = $_POST['advise_id'];
	//$advise_title = addslashes(trim($_POST['advise_title']));
	//$advise_description = addslashes(trim($_POST['advise_description'])); 
	//$advise_short_description = addslashes(trim($_POST['advise_short_description'])); 	

 $qry="update tt_advise set 	advise_title = '".$advise_title."', advise_description = '".$advise_description."', advise_short_description = '".$advise_short_description."', set_for_home = '".$yesno."',  seo_page = '".$pagename."', date_added =  now()  where advise_id ='".$advise_id."'";
	@mysql_query($qry);
	
	/*if ( isset($_FILES['advise_image']['tmp_name'])){ 
		//echo '<pre>'; print_r($_FILES); exit;

			$upload_dir = '../../media/advise_image/'.$advise_id.'/logo';
			chmod($upload_dir,0777);	
			$ext= array ('gif','png','jpg','bmp');			
		   
			$file_type=$_FILES['advise_image']['type']; 		
			if(!empty($_FILES['advise_image']['name']))
			{ 
				$upload = new upload('advise_image', $upload_dir, '777', $ext);
				if ($upload->message =="SUCCESS_FILE_SAVED_SUCCESSFULLY" )
				{ 
					$imagename=$upload->filename;	
								
					$qry2="update tt_advise set  advise_image = '".$imagename."'   where advise_id ='".$advise_id."'";	
					@mysql_query($qry2);

				}else{
					$_SESSION["image_err"]["advise_image"] = "Error: Upload an Image file.";
				}	
			}
		}	
	
*/



if ( isset($_FILES['advise_image']['tmp_name'])) 
		{ 
		

			mkdir ('../../media/advise_image/' .$advise_id.'/' ,0777) ;
			mkdir ('../../media/advise_image/' .$advise_id.'/logo/' , 0777);
			mkdir ('../../media/advise_image/' .$advise_id.'/logo/thumb/', 0777);
		
			$upload_dir = '../../media/advise_image/' .$advise_id.'/logo/';
			$thutt_folder =$upload_dir .'thumb/';
			
			$logo ='';			
			chmod($upload_dir,0777);	
			chmod($thutt_folder,0777);	
			$ext= array ('gif','jpg','jpeg','png','bmp');			
			$companylogo = "advise_image"; 
		
			$file_type=$_FILES[$companylogo]['type'];   			
			if(!empty($_FILES[$companylogo]['name']))
			{
				$upload = new upload($companylogo, $upload_dir, '777', $ext);
				if ($upload->message =="SUCCESS_FILE_SAVED_SUCCESSFULLY" )
				{
					$logo=$upload->filename;					
					require_once($rootpath.'phpThumb/phpthumb.class.php');
					$phpThumb = new phpThumb();
					$thumbnail_width = 120;
					$phpThumb->setSourceFilename($upload_dir.$logo);
					$output_filename = $thutt_folder.$logo;
					
					// set parameters (see "URL Parameters" in phpthumb.readme.txt)
					$phpThumb->setParameter('w',$thumbnail_width);
					
					// generate & output thumbnail
					if ($phpThumb->GenerateThumbnail()) { // this line is VERY important, do not remove it!
					if ($phpThumb->RenderToFile($output_filename)) {
						// do something on success
						//echo 'Successfully rendered to "'.$output_filename.'"';
					} 
					} 
					$insQry ="update  tt_advise set advise_image ='$logo' where advise_id	= $advise_id";	
					mysql_query($insQry)or die (mysql_error());
					
					}else{
					$_SESSION["biz_reg_err"]["logo"] = "Error: Upload an Image file.";
					}	
			}
		}	






	$_SESSION['msgText'] = 'Saved Successfuly !';
	header('location:'.$ruadmin.'home.php?p=edit_advise&advise_id='.$advise_id);
}



?>
	
