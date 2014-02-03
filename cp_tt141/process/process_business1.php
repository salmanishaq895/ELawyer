<?php 
require_once("../../connect/connect.php");
require_once("../security.php");
require_once ('../inc/functii.php');
include ("../inc/upload.php");

unset($_SESSION['biz_reg_err']);
unset($_SESSION['biz_reg']);
//print_r($_REQUEST); exit;
if ( isset ($_GET['action'])  and  ($_GET['action']=='d'))
{
			
	$locationid  =$_GET['bId'];
	$rdir = 'home.php?p=business';
	
	$biz_Sql = "select * from tt_business where locationid  = $locationid ";
	$biz =mysql_query($biz_Sql);
	if (mysql_num_rows($biz) == 0) {header('location:'.$rdir);exit;}
	
	
	$biz_Sql = "delete from tt_business where locationid  = $locationid ";
	
	if( $biz =mysql_query($biz_Sql) ){
		$sql33 = "DELETE FROM business_reviews where locationid = '".$locationid."'";
		mysql_query($sql33);
	
		$_SESSION['msg'] = 'Business deleted !';
		$ruadmins = $_SERVER['HTTP_REFERER'];
		header('location:'.$ruadmins.'home.php?p=business'); exit;				
	
	} 
	//header('location:'.$ruadmin.'home.php?p=business'); exit;
	header('location:'.$rdir );exit;}


if (isset($_POST['SaveBusiness'])){

     	unset($_SESSION['biz_reg_err']);
	    unset($_SESSION['biz_reg']);
	
	foreach ($_POST as $k => $v ){
		$$k =  addslashes(trim($v ));
		$_SESSION['biz_reg'][$k]=$v;
	}

	$flgs = false;

/*			$logo ='';
			$path_to_folder= '../businesslogo/'; 
			chmod($path_to_folder,0777);	
			$ext= array ('gif','jpg','jpeg','png','bmp','GIF','JPG','JPEG','PNG','BMP');
			
			$companylogo = "logo"; 
		
			$file_type=$_FILES[$companylogo]['type'];   
			
			if(!empty($_FILES[$companylogo]['name']))
			{
				$upload = new upload($companylogo, $path_to_folder, '777', $ext);
				if ($upload->message =="SUCCESS_FILE_SAVED_SUCCESSFULLY" )
				{
					// $filepath=$path_to_folder.$_FILES[$companylogo]['name'];					@unlink($filepath);
					$logo=$upload->filename;
						
				}else{
					$_SESSION["biz_reg"]["logo"] = "Error: Upload an Image file.";
				}	
			}
			if ( $logo) $logo ="logo = '$logo', ";*/
	
	$flgs = false;
	///////////////////////email validation///////////
	if( ($email!='') and (vpemail($email )) ){
		
			$_SESSION['biz_reg_err']['email'] = $_ERR['register']['emailg'];
			$flgs = true;

	}


	///////////////////////phone name validation////////	
	if($name==''){
		$_SESSION['biz_reg_err']['name'] = 'Please enter valid Company name';
		$flgs = true;
	
	}
	///////////////////////phone name validation////////	
	$phone = formatPhone($phone);
	$phone2 = formatPhone($phone2);
	$tracked_phone = formatMobile($tracked_phone);
   if($phone=='' && $phone2=='')
	{
	
		$_SESSION['biz_reg_err']['phone'] = 'Please enter at least one Phone r';
		$flgs = true;
	}

   
	  
  if($flgs)
  {
	
		header('location:'.$ruadmin.'home.php?p=business_add'); exit;
		
  }else{
  		
		$address1 = $address.', '.$city.', '.$state.' '.$postcode;
		$address1 = urlencode(stripslashes($address1));
$location = file("http://maps.google.com/maps/geo?q=$address1&output=csv&key=ABQIAAAAseZREdN_Nhlhj3sI93ilyxTFXeOqGzGS-9SJmCfgnHR3mTEJHhRuMkQOalyVjsE-xUFm8qTB35bSXQ");
list ($stat,$acc,$Latitude,$Longitude) = explode(",",$location[0]);
$keywords = keywordsclean($keywords);
echo $insQry ="insert into tt_business set 	name ='$name',
									dispatchcontact ='$dispatchcontact',
									address ='$address',
									city ='$city',
									state ='$state',
									zip ='$zip',
									phone ='$phone',
									phone2 ='$phone2',
									phone3 ='$phone3',
									phone4 ='$phone4',
									fax ='$fax',
									ownername ='$ownername',
									managername ='$managername',
									website ='$website',
									email ='$email',
									 $logo
									status ='$status',
									btype = '$btype',
									ltype = '$ltype',
									userId ='$b_userId',
									dated =now(),
									latitude ='$Latitude',
									longitude ='$Longitude'";
  		exit; mysql_query($insQry)or die (mysql_error());
		$bizId = mysql_insert_id();		
		if ( isset($_FILES['logo']['tmp_name'])) 
		{ 
		

			mkdir ('../media/' .$bizId.'/' ,0777) ;
			mkdir ('../media/' .$bizId.'/logo/' , 0777);
			mkdir ('../media/' .$bizId.'/logo/thumb/', 0777);
		
			$upload_dir = '../media/' .$bizId.'/logo/';
			$thutt_folder = '../media/' .$bizId.'/logo/thumb/';
			
			$logo ='';			
			chmod($upload_dir,0777);	
			chmod($thutt_folder,0777);	
			$ext= array ('gif','jpg','jpeg','png','bmp');			
			$companylogo = "logo"; 
		
			$file_type=$_FILES[$companylogo]['type'];   			
			if(!empty($_FILES[$companylogo]['name']))
			{
				$upload = new upload($companylogo, $upload_dir, '777', $ext);
				if ($upload->message =="SUCCESS_FILE_SAVED_SUCCESSFULLY" )
				{
					$logo=$upload->filename;					
					require_once('../phpThumb/phpthumb.class.php');
					$phpThumb = new phpThumb();
					$thumbnail_width = 120;
					$phpThumb->setSourceFilename($upload_dir.$logo);
					$output_filename = $thutt_folder.$logo;
					
					// set parameters (see "URL Parameters" in phpthumb.readme.txt)
					$phpThumb->setParameter('w', $thumbnail_width);
					
					// generate & output thumbnail
					if ($phpThumb->GenerateThumbnail()) { // this line is VERY important, do not remove it!
					if ($phpThumb->RenderToFile($output_filename)) {
						// do something on success
						//echo 'Successfully rendered to "'.$output_filename.'"';
					} 
					} 
					$insQry ="update  tt_business set 	logo ='$logo' where locationid	= $bizId";	
					mysql_query($insQry)or die (mysql_error());
					
					}else{
					$_SESSION["biz_reg"]["logo"] = "Error: Upload an Image file.";
					}	
			}
		}			
		if($b_userId!=1 && $b_userId!=0){
			$updatestatus ="Update tt_user set type ='b' where userId = $b_userId";
	  		mysql_query($updatestatus)or die (mysql_error());
		}		
		unset($_SESSION['biz_reg_err']);
		unset($_SESSION['biz_reg']);
		$_SESSION['biz_reg_err']['business_add'] = 'Company added successfully!';
		header('location:'.$ruadmin.'home.php?p=business_add&a='.$btype); exit;
  }}

if ( isset ($_POST['UpdateBusiness'])){
//print_r($_REQUEST); exit;
	    unset($_SESSION['biz_reg_err']);
	    unset($_SESSION['biz_reg']);
	
		foreach ($_POST as $k => $v ){
			$$k =  addslashes(trim($v ));
			$_SESSION['biz_reg'][$k]=$v;
		}
	$flgs = false;
			if ( isset($_FILES['logo']['tmp_name'])) 
		{ 
			
			
			@mkdir ('../media/' .$bId .'/',0777) ;
			@mkdir ('../media/' .$bId.'/logo/' , 0777);
			@mkdir ('../media/' .$bId.'/logo/thumb/', 0777);
			
			$upload_dir = '../media/' .$bId.'/logo/';
			$thutt_folder = '../media/' .$bId.'/logo/thumb/';
			
			$logo ='';
			chmod($upload_dir,0777);
			chmod($thutt_folder,0777);	
			$ext= array ('gif','jpg','jpeg','png','bmp','GIF','JPG','JPEG','PNG','BMP');
			
			$companylogo = "logo"; 
		
			$file_type=$_FILES[$companylogo]['type'];   
			
			if(!empty($_FILES[$companylogo]['name']))
			{
				$upload = new upload($companylogo, $upload_dir, '777', $ext);
				if ($upload->message =="SUCCESS_FILE_SAVED_SUCCESSFULLY" )
				{
					$logo=$upload->filename;					
					require_once('../phpThumb/phpthumb.class.php');
					$phpThumb = new phpThumb();
					$thumbnail_width = 120;
					$phpThumb->setSourceFilename($upload_dir.$logo);
					$output_filename = $thutt_folder.$logo;
					// set parameters (see "URL Parameters" in phpthumb.readme.txt)
					$phpThumb->setParameter('w', $thumbnail_width);
					// generate & output thumbnail
					if ($phpThumb->GenerateThumbnail()) { // this line is VERY important, do not remove it!
						if ($phpThumb->RenderToFile($output_filename)) {
						// do something on success
						//echo 'Successfully rendered to "'.$output_filename.'"';
						} 
					} 
					@unlink ($upload_dir.$oldlogofile);
					@unlink ($thutt_folder.$oldlogofile);
					//$insQry ="update  business set 	logo ='$logo' where locationid	= $bizId";	
					//mysql_query($insQry)or die (mysql_error());
					
					
						
				}else{
					$_SESSION["biz_reg"]["logo"] = "Error: Upload an Image file.";
				}	
			}
			if ( $logo) $logo ="logo = '$logo', ";
	}
		
			
			
	$flgs = false;
	///////////////////////email validation///////////
	if( ($email!='') and (vpemail($email )) ){
		
			$_SESSION['biz_reg_err']['email'] = $_ERR['register']['emailg'];
			$flgs = true;

	}

  
	
	if($name==''){
		$_SESSION['biz_reg_err']['name'] = 'Please enter valid Company name';
		$flgs = true;
	
	}
	///////////////////////phone name validation////////	
	$phone = formatPhone($phone);
	$fax = formatPhone($fax);
	$tracked_phone = formatMobile($tracked_phone);
   if($phone=='' && $phone2=='')
	{
	
		$_SESSION['biz_reg_err']['phone'] = 'Please enter validat least one phone';
		$flgs = true;
	}
   
		
  if($flgs)
  {
	
		header('location:'.$ruadmin.'home.php?p=business_edit&bId='.$bId); exit;
		
  }else{
  		
		$address1 = $address.', '.$city.', '.$state.' '.$postcode;
		$address1 = urlencode(stripslashes($address1));
$location = file("http://maps.google.com/maps/geo?q=$address1&output=csv&key=ABQIAAAAseZREdN_Nhlhj3sI93ilyxTFXeOqGzGS-9SJmCfgnHR3mTEJHhRuMkQOalyVjsE-xUFm8qTB35bSXQ");
list ($stat,$acc,$Latitude,$Longitude) = explode(",",$location[0]);
$keywords = keywordsclean($keywords);
 $insQry2 ="Update tt_business set 	name ='$name',
									description ='$description',
									address ='$address',
									city ='$city',
									state ='$state',
									zip ='$zip',
									phone ='$phone',
									phone ='$phone2',
									
									website ='$website',
									email ='$email',
									 $logo
									status ='$status',
									btype = '$btype',
									ltype = '$ltype',
									userId ='$userId',
									dated =now(),
									latitude ='$Latitude',
									longitude ='$Longitude'
					where locationid =$bId";
  		mysql_query($insQry2)or die (mysql_error());

		if($userId!=1 && $userId!=0){
			$updatestatus ="Update tt_user set type ='b' where userId = $userId";
	  		mysql_query($updatestatus)or die (mysql_error());
		}
		unset($_SESSION['biz_reg_err']);
		unset($_SESSION['biz_reg']);
		$_SESSION['biz_reg_err']['business_add'] = 'Company Updated Successfully!';
		header('location:'.$ruadmin.'home.php?p=business_edit_step2&bId='.$bId); exit;
  }
}


if ( isset ($_POST['UpdateBusiness2'])){
// echo '<pre>'; print_r($_REQUEST); exit;
	    unset($_SESSION['biz_reg_err2']);
	    unset($_SESSION['biz_reg2']);
	
		foreach ($_POST as $k => $v ){
			$$k =  addslashes(trim($v ));
			$_SESSION['biz_reg2'][$k]=$v;
		}
	$flgs = false;
	//echo $bId; exit;
	//echo '<pre>';print_r($_SESSION['biz_reg2']);exit;
	///////////////////////email validation///////////
	if( ($email!='') and (vpemail($email )) ){
		
			$_SESSION['biz_reg_err2']['email'] = $_ERR['register']['emailg'];
			$flgs = true;

	}
 
		
  if($flgs)
  {
		header('location:'.$ruadmin.'home.php?p=business_edit_step2&bId='.$bId); exit;
		
  }else{
  		//billling info check and insertion and update
	   $SQL_check = "SELECT * FROM tt_business_billing_info where bid ='$bId'";
		 $rs_row		= $db->get_row($SQL_check, ARRAY_A);

		if($rs_row){
			 $insQry_billing ="update tt_business_billing_info set 
									address='$address', 
									city='$city',
									contact ='$contact', 	
									state ='$state',
									zip ='$zip', phone ='$phone'
									where bid ='$Id' ";
			mysql_query($insQry_billing)or die (mysql_error());
		}else{   
			$insQry_billing ="insert into tt_business_billing_info set 
									address='$address', 
									city='$city',
									contact ='$contact', 	
									state ='$state',
									zip ='$zip', phone ='$phone',
									bid ='$bId' ";
			mysql_query($insQry_billing)or die (mysql_error());
		}
		
		//additional info check and insertion and update
		$SQL_check  = "SELECT * FROM tt_business_additional_info where bid ='$bId'";
		$rs_row		= $db->get_row($SQL_check, ARRAY_A);
		
		if($rs_row){
					$insQry ="update tt_business_additional_info set 
					yearestablished='$yearestablished', 
					iccmc='$iccmc',
					description ='$description'
					where bid ='$bId' ";
					mysql_query($insQry)or die (mysql_error());

		}else{   
					$insQry ="insert into tt_business_additional_info set 
					yearestablished='$yearestablished', 
					iccmc='$iccmc',
					description ='$description',
					bid ='$bId' ";
					mysql_query($insQry)or die (mysql_error());
		}	  

		if($userId!=1 && $userId!=0){
			$updatestatus ="Update tt_user set type ='b' where userId = $userId";
	  		mysql_query($updatestatus)or die (mysql_error());
		}
		unset($_SESSION['biz_reg_err2']);
		unset($_SESSION['biz_reg2']);
		//$_SESSION['biz_reg_err2']['business_add'] = 'Company Updated Successfully!';
		if ( isset($_POST['UpdateBusiness2'])){
		$SQL_check  = "SELECT btype FROM tt_business where locationid ='$bId'";
		$rs_row		= $db->get_row($SQL_check, ARRAY_A);
		if($rs_row['btype'] == 'Broker'){
			header('location:'.$ruadmin.'home.php?p=business_edit_step3_broker&bId='.$bId);exit;
			} elseif($rs_row['btype'] == 'Carrier'){
				header('location:'.$ruadmin.'home.php?p=business_edit_step3_carrier&bId='.$bId);exit;
				} elseif($rs_row['btype'] == 'Broker / Carrier'){
					header('location:'.$ruadmin.'home.php?p=business_edit_step3_broker_n_carrier&bId='.$bId);exit;
				  } elseif($rs_row['btype'] == ''){
					echo 'Please select company type in step 1';
					header('location:'.$ruadmin.'home.php?p=business_edit_step3&bId='.$bId);exit;
				  } 
		} else{
		header('location:'.$ruadmin.'home.php?p=business_edit_step2&bId='.$bId);
		exit;
	   }
  }
}

function keywordsclean($kwname){
	$kwname = str_replace(", &",",",$kwname);
	$kwname = str_replace(",&",",",$kwname);
	$kwname = str_replace(" , ",",",$kwname);
	$kwname = str_replace(", ",",",$kwname);
	$kwname = str_replace(" ,",",",$kwname);	
	$kwname =str_replace("?","",$kwname);
	$kwname =str_replace(":","",$kwname);	
	$kwname =str_replace(";","",$kwname);		
	$kwname =str_replace("'","",$kwname);
	$kwname =str_replace("/"," ",$kwname);
	$kwname =str_replace("  "," ",$kwname);	
	return $kwname;
}
?>