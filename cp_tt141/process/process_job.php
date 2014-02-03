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
			
	$quotes_id  =$_GET['quotes_id'];
	//echo $quotes_id."dsfsd"; exit;
	//$rdir = $ruadmin.'home.php?p=jobmanage';
	
	// $biz_Sql = "select * from tt_quotes where quotes_id   = $quotes_id ";
	//exit;
//	$biz =mysql_query($biz_Sql);
//	if (mysql_num_rows($biz) == 0) {header('location:'.$rdir);exit;}
	
	
	$biz_Sql = "delete from tt_quotes where quotes_id  = $quotes_id ";
	mysql_query($biz_Sql);
	$_SESSION['msg'] = 'Job deleted !';
	/*if( $biz =mysql_query($biz_Sql) ){
		$sql33 = "DELETE FROM business_reviews where locationid = '".$locationid."'";
		mysql_query($sql33);
	
		
		$ruadmins = $_SERVER['HTTP_REFERER'];
		header('location:'.$ruadmins.'home.php?p=jobmanage'); exit;				
	
	} */
	header('location:'.$ruadmin.'home.php?p=jobmanage'); exit;
	//header('location:'.$rdir );
	exit;
//	}
	}


if (isset($_POST['SaveJob'])){ 
//echo "dsfsdf"; exit;

     	unset($_SESSION['biz_reg_err']);
	    unset($_SESSION['biz_reg']);
	
	foreach ($_POST as $k => $v ){
		$$k =  addslashes(trim($v));
		$_SESSION['biz_reg'][$k]=$v;
	}
	$message  = addslashes($message);
  	$flgs = false;
	
	 	/*	$statenames = '';
		if(isset($dtype)){ 
			$dtypeval = implode(" ",$dtype);
			if(in_array('S1',$dtype)){
				$statenames = 'CA NY FL TX';		
			}
			if(in_array('S2',$dtype)){
				$statenames = $statenames.' IL WA PA VA GA NC MA OH';		
			}
			if(in_array('S3',$dtype)){
				$statenames = $statenames.' OR NJ AZ MI CO MD MN TN IN CT WI MO LA';	
			}
			if(in_array('S4',$dtype)){
				$statenames = $statenames.' SC NV AL UT DC KY KS OK IA NM HI RI MS AR NE NH ID ME WV MT AK DE VT SD ND WY';	
			}

		}
		else
		{
			$_SESSION['biz_reg_err']['dtype'] = 'At least One package must select from the given list';
			$flgs = true;
			
		}
		  // echo '<pre>'; print_r($_SESSION['biz_reg']); echo $statenames; exit;
*/	

	///////////////////////email validation///////////
	/*if( ($email!='') and (!filter_var($email, FILTER_VALIDATE_EMAIL)) ){
		
			$_SESSION['biz_reg_err']['email'] = $_ERR['register']['emailg'];
			$flgs = true;

	}*/


	///////////////////////phone name validation////////	
	if($txt_keyword==''){
		$_SESSION['biz_reg_err']['txt_keyword'] = 'Please enter valid Job name';
		$flgs = true;
	
	}
	
	if($txt_location==''){
		$_SESSION['biz_reg_err']['txt_location'] = 'Please enter valid Job City';
		$flgs = true;
	
	}
	
	
	if($postcode==''){
		$_SESSION['biz_reg_err']['postcode'] = 'Please enter valid Job postcode';
		$flgs = true;
	
	}
	
	
	if($message==''){
		$_SESSION['biz_reg_err']['message'] = 'Please enter The Job Message';
		$flgs = true;
	
	}
	
	
	
	if($title==''){
		$_SESSION['biz_reg_err']['title'] = 'Please enter Title';
		$flgs = true;
	
	}
	
	
	if($phone==''){
		$_SESSION['biz_reg_err']['phone'] = 'Please enter Phone Number';
		$flgs = true;
	
	}
	
	
	
	if($txt_location==''){
		$_SESSION['biz_reg_err']['txt_location'] = 'Please enter Zip Code OR Location';
		$flgs = true;
	
	}
	
	
	
	
	///////////////////////phone name validation////////	
	
	
	//$phone = formatPhone($phone);
	
	
	
	//$phone2 = formatPhone($phone2);
	//$tracked_phone = formatMobile($tracked_phone);
   //if($phone=='' && $phone2=='')
	/*if($phone=='')
	{
	
		$_SESSION['biz_reg_err']['phone'] = 'Please enter  Phone Number';
		$flgs = true;
	}


if($mobile=='')
	{
	
		$_SESSION['biz_reg_err']['mobile'] = 'Please enter  Mobile Number';
		$flgs = true;
	}
*/
   
	  
  if($flgs)
  {
	
		header('location:'.$ruadmin.'home.php?p=addjob'); exit;
		
  }else{
  		
		/*$address1 = $txt_location.', '.$postcode;
		$address1 = urlencode(stripslashes($address1));
 $location = file("http://maps.google.com/maps/geo?q=$address1&output=csv&key=ABQIAAAAseZREdN_Nhlhj3sI93ilyxTFXeOqGzGS-9SJmCfgnHR3mTEJHhRuMkQOalyVjsE-xUFm8qTB35bSXQ");
  list ($stat,$acc,$Latitude,$Longitude) = explode(",",$location[0]);*/
  
  
  
  $addressbuss = "";

		if($txt_location != ''){
			$addressbuss .= ", ".$txt_location;
		}

		if($postcode != ''){
			$addressbuss .= ", ".$postcode;
		}
		
		
		$where = stripslashes($addressbuss).", UK";
		$whereurl = urlencode($where);
		$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$whereurl.'&sensor=false');
		$output= json_decode($geocode);
		$Latitude = $output->results[0]->geometry->location->lat;
		$Longitude = $output->results[0]->geometry->location->lng;

  
  
  
  
  $keywords = keywordsclean($keywords);
	/*$SQL_act = "SELECT * FROM tt_job WHERE userid =$b_userId ";
	//exit;
	$rs_row		= $db->get_row($SQL_act, ARRAY_A);
	if($rs_row){
		 $_SESSION['biz_reg_err']['business_add'] = 'This user already created the Job. Please add new user frist.' ;
		 header('location:'.$ruadmin.'home.php?p=addjob'); exit;
	}
     else{ */
	// $expirydate = get_DateFormating($expirydate);
   $insQry ="insert into tt_quotes set 	keyword ='$txt_keyword',
   									location='$txt_location',
									post_code='$postcode',
									miles='$miles',
									title='$title',
									message='$message',
									phone='$phone',
									within='$within',
									contact_method ='$contact_method',
									userId ='$b_userId',
									latitude='$Latitude',
									longitude='$Longitude'"; //exit;
									//exit;
									//dispatchcontact ='$dispatchcontact',
									//phone2 ='$phone2',
									//phone3 ='$phone3',
									//phone4 ='$phone4',
									//fax ='$fax',
									//ownername ='$ownername',
									//btype = '$btype',
									//ltype = '$ltype',
									//dtype = '$dtypeval',
									//claim_flag = '$claim_flag',
									//stype = '$statenames',
									//address ='$address',
									//city ='$city',
									//state ='$state',
									//phone ='$phone',
									//tracked_phone='$mobile',
									//website ='$website',
									//email ='$email',
									//latitude ='$Latitude',
									//longitude ='$Longitude'
									//keywords ='$keywords',
									// $logo
									//status ='$status',
									//expirydate ='$expirydate
									
  		 mysql_query($insQry)or die (mysql_error());
		
		$bizId = mysql_insert_id();		
		if ( isset($_FILES['logo']['tmp_name'])) 
		{ 
		

			@mkdir ('../../media/quotes/' .$bizId.'/' ,0777) ;
			@mkdir ('../../media/quotes/' .$bizId.'/' , 0777);
			@mkdir ('../../media/quotes/' .$bizId.'/thumb/', 0777);
		
			$upload_dir = '../../media/quotes/' .$bizId.'/';
			$thutt_folder = '../../media/quotes/' .$bizId.'/thumb/';
			
			$logo ='';			
			@chmod($upload_dir,0777);	
			@chmod($thutt_folder,0777);	
			$ext= array ('gif','jpg','jpeg','png','bmp','GIF','JPG','JPEG','PNG','BMP');
			//$ext= array ('gif','jpg','jpeg','png','bmp','pdf','doc','docx','xls','xlsx','txt');			
			$companylogo = "logo"; 
		
			$file_type=$_FILES[$companylogo]['type'];   			
			if(!empty($_FILES[$companylogo]['name']))
			{
				$upload = new upload($companylogo, $upload_dir, '777', $ext);
				if ($upload->message =="SUCCESS_FILE_SAVED_SUCCESSFULLY" )
				{
					$logo=$upload->filename;					
					require_once('../../phpThumb/phpthumb.class.php');
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
					$insQry ="update  tt_quotes set 	file_attechmen ='$logo' where quotes_id	= $bizId";	
					mysql_query($insQry)or die (mysql_error());
					
					}else{
					$_SESSION["biz_reg"]["logo"] = "Error: Upload an Image file.";
					}	
			}
		}			
		/*if($b_userId!=1 && $b_userId!=0){
			$updatestatus ="Update tt_user set type ='b' where userId = $b_userId";
	  		mysql_query($updatestatus)or die (mysql_error());
		}*/		
		unset($_SESSION['biz_reg_err']);
		unset($_SESSION['biz_reg']);
		$_SESSION['biz_reg_err']['business_add'] = 'Job added successfully!';
		header('location:'.$ruadmin.'home.php?p=addjob'); exit;
  	}
  
  		//}
  
  			}








if ( isset ($_POST['UpdateJob'])){
 
//print_r($_REQUEST); exit;
	    unset($_SESSION['biz_reg_err']);
	    unset($_SESSION['biz_reg']);
	
		foreach ($_POST as $k => $v ){
			$$k =  addslashes(trim($v ));
			$_SESSION['biz_reg'][$k]=$v;
		}
		//print_r($_SESSION['biz_reg']); exit;
	$flgs = false;
			if ( isset($_FILES['logo']['tmp_name'])) 
		{ 
			
			
			@mkdir ('../../media/quotes/' .$quotes_id .'/',0777) ;
			@mkdir ('../../media/quotes/' .$quotes_id.'/' , 0777);
			@mkdir ('../../media/quotes/' .$quotes_id.'/thumb/', 0777);
			
			$upload_dir = '../../media/quotes/' .$quotes_id.'/';
			$thutt_folder = '../../media/quotes/' .$quotes_id.'/thumb/';
			
			$logo ='';
			@chmod($upload_dir,0777);
			@chmod($thutt_folder,0777);	
			$ext= array ('gif','jpg','jpeg','png','bmp','GIF','JPG','JPEG','PNG','BMP');
			//$ext= array ('gif','jpg','jpeg','png','bmp','pdf','doc','docx','xls','xlsx','txt');	
			
			$companylogo = "logo"; 
		
			$file_type=$_FILES[$companylogo]['type'];   
			
			if(!empty($_FILES[$companylogo]['name']))
			{
				$upload = new upload($companylogo, $upload_dir, '777', $ext);
				if ($upload->message =="SUCCESS_FILE_SAVED_SUCCESSFULLY" )
				{
					$logo=$upload->filename;					
					require_once('../../phpThumb/phpthumb.class.php');
					$phpThumb = new phpThumb();
					$thumbnail_width = 120;
					$phpThumb->setSourceFilename($upload_dir.$logo);
					$output_filename = $thutt_folder.$logo;
					// set parameters (see "URL Parameters" in phpthumb.readme.txt)
					$phpThumb->setParameter('w', $thumbnail_width);
					//echo "<pre>";print_r($phpThumb); exit;
					// generate & output thumbnail
					if ($phpThumb->GenerateThumbnail()) { // this line is VERY important, do not remove it!
						if ($phpThumb->RenderToFile($output_filename)) {
						// do something on success
						//echo 'Successfully rendered to "'.$output_filename.'"'; exit;
						} 
					} 
					
					
					/*this code is used to delete the old file*/
					$sql_old  = "select * from tt_quotes where quotes_id='".$quotes_id."'";
					$result_old  = mysql_query($sql_old);
					$row_old = mysql_fetch_array($result_old);
					$image_old  = $row_old['file_attechmen'];
					//echo $image_old; exit;
					@unlink ($upload_dir.$image_old);
					@unlink ($thutt_folder.$image_old);
					
					
					
					
					//$insQry ="update  business set 	logo ='$logo' where locationid	= $bizId";	
					//mysql_query($insQry)or die (mysql_error());
					
					
						
				}else{
					$_SESSION["biz_reg"]["logo"] = "Error: Upload an Image file.";
				}	
			}
			if ( $logo) $logo ="file_attechmen = '$logo', ";
	}
		
			
			
	$flgs = false;
	///////////////////////email validation///////////
	/*if( ($email=='') and (!filter_var($email, FILTER_VALIDATE_EMAIL)) ){
		
			$_SESSION['biz_reg_err']['email'] = 'Please enter valid email';
			$flgs = true;

	}
*/
  
	
		if($txt_keyword==''){
		$_SESSION['biz_reg_err']['txt_keyword'] = 'Please enter valid Job name';
		$flgs = true;
	
	}
	
	if($txt_location==''){
		$_SESSION['biz_reg_err']['txt_location'] = 'Please enter valid Job City';
		$flgs = true;
	
	}
	
	
	
	if($postcode==''){
		$_SESSION['biz_reg_err']['postcode'] = 'Please enter valid Job Postcode';
		$flgs = true;
	
	}
	
	
	
	if($message==''){
		$_SESSION['biz_reg_err']['message'] = 'Please enter The Job Message';
		$flgs = true;
	
	}
	
	
	
	if($title==''){
		$_SESSION['biz_reg_err']['title'] = 'Please enter Title';
		$flgs = true;
	
	}
	
	
	if($phone==''){
		$_SESSION['biz_reg_err']['phone'] = 'Please enter Phone Number';
		$flgs = true;
	
	}
	
	
	
	if($txt_location==''){
		$_SESSION['biz_reg_err']['txt_location'] = 'Please enter Zip Code OR Location';
		$flgs = true;
	
	}
  if($flgs)
  {
	
		header('location:'.$ruadmin.'home.php?p=editjob&quotes_id='.$bId); exit;
		
  }else{
  	//$expirydate = get_DateFormating($expirydate);
	/*$address1 = $txt_location.', '.$postcode;
		$address1 = urlencode(stripslashes($address1));
 $location = file("http://maps.google.com/maps/geo?q=$address1&output=csv&key=ABQIAAAAseZREdN_Nhlhj3sI93ilyxTFXeOqGzGS-9SJmCfgnHR3mTEJHhRuMkQOalyVjsE-xUFm8qTB35bSXQ");
  list ($stat,$acc,$Latitude,$Longitude) = explode(",",$location[0]);*/
  
  $addressbuss = "";

		if($txt_location != ''){
			$addressbuss .= ", ".$txt_location;
		}

		if($postcode != ''){
			$addressbuss .= ", ".$postcode;
		}
		
		
		$where = stripslashes($addressbuss).", UK";
		$whereurl = urlencode($where);
		$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$whereurl.'&sensor=false');
		$output= json_decode($geocode);
		$Latitude = $output->results[0]->geometry->location->lat;
		$Longitude = $output->results[0]->geometry->location->lng;

  
  
  
  
  
  
	
	
 $insQry2 ="Update tt_quotes set 	keyword ='$txt_keyword',
   									location='$txt_location',
									miles='$miles',
									title='$title',
									message='$message',
									$logo
									phone='$phone',
									post_code='$postcode',
									within='$within',
									contact_method ='$contact_method',
									userId='$b_userId',
									status='$statuse',
									latitude='$Latitude',
									longitude='$Longitude'
									where quotes_id ='$quotes_id'"; 
									//expirydate ='$expirydate'
					
  		mysql_query($insQry2)or die (mysql_error());

		unset($_SESSION['biz_reg_err']);
		unset($_SESSION['biz_reg']);
		$_SESSION['biz_reg_err']['business_add'] = 'Job Updated Successfully!';
		header('location:'.$ruadmin.'home.php?p=editjob&quotes_id='.$quotes_id); exit;
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
 
		
  if($flgs)
  {
		header('location:'.$ruadmin.'home.php?p=business_edit_step2&bId='.$bId); exit;
		
  }else{
  		//billling info check and insertion and update
	   $SQL_check = "SELECT * FROM tt_business_billing_info where bid ='$bId'";
		 $rs_row		= $db->get_row($SQL_check, ARRAY_A);

		if($rs_row){
			 $insQry_billing ="update tt_business_billing_info set address='$address', city='$city',contact ='$contact', 	state ='$state',zip ='$zip', phone ='$phone' where bid ='$bId' ";
			mysql_query($insQry_billing)or die (mysql_error());
		}else{   
			$insQry_billing ="insert into tt_business_billing_info set address='$address', city='$city',contact ='$contact', 	state ='$state',zip ='$zip', phone ='$phone', bid ='$bId' ";
			mysql_query($insQry_billing)or die (mysql_error());
		}
		
		//additional info check and insertion and update
		$SQL_check  = "SELECT * FROM tt_business_additional_info where bid ='$bId'";
		$rs_row		= $db->get_row($SQL_check, ARRAY_A);
		
		if($rs_row){
					$insQry ="update tt_business_additional_info set yearestablished='$yearestablished', iccmc='$iccmc',description ='$description'where bid ='$bId' ";
					mysql_query($insQry)or die (mysql_error());

		}else{   
					$insQry ="insert into tt_business_additional_info set yearestablished='$yearestablished', iccmc='$iccmc',description ='$description', bid ='$bId' ";
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
		header('location:'.$ruadmin.'home.php?p=business_edit_step3&bId='.$bId);
		exit;
		} else{
		header('location:'.$ruadmin.'home.php?p=business_edit_step2&bId='.$bId);
		exit;
	   }
  }
}


if ( isset ($_POST['UpdateBusiness3'])){
// echo '<pre>'; print_r($_REQUEST); exit;
	    unset($_SESSION['biz_reg_err3']);
	    unset($_SESSION['biz_reg3']);
	
		foreach ($_POST as $k => $v ){
			$$k =  addslashes(trim($v ));
			$_SESSION['biz_reg3'][$k]=$v;
		}
	
	//echo $bId; exit;
	//echo '<pre>';print_r($_SESSION['biz_reg3']);exit;
	$flgs = false;
 
		
  if($flgs)
  {
		header('location:'.$ruadmin.'home.php?p=business_edit_step2&bId='.$bId); exit;
		
  }else{
 	   
	   $SQL_check   = "SELECT btype FROM tt_business where locationid ='$bId'";
	   $rs_row_check= $db->get_row($SQL_check, ARRAY_A);
	   if ($rs_row_check['btype'] == 'Broker'){
			//broker info check and insertion and update
		   $SQL_check   = "SELECT * FROM tt_business_broker where bid ='$bId'";
		   $rs_row		= $db->get_row($SQL_check, ARRAY_A);

			if($rs_row){
					$insQry_billing ="update tt_business_broker set bondagent ='$bondagent', bondphone='$bondphone' where bid ='$bId' ";
					mysql_query($insQry_billing)or die (mysql_error());
			}else{   
					$insQry_billing ="insert into tt_business_broker set bondagent='$bondagent', bondphone='$bondphone', bid ='$bId' ";
					mysql_query($insQry_billing)or die (mysql_error());
					}
		}elseif ($rs_row_check['btype'] == 'Carrier'){
				//cargo unsurance info check and insertion and update
				$SQL_check  = "SELECT * FROM tt_business_cargo_info where bid ='$bId'";
				$rs_row		= $db->get_row($SQL_check, ARRAY_A);	
				if($rs_row){
					$insQry ="update tt_business_cargo_info set company='$company', agent='$agent',inslimit='$inslimit', deductible='$deductible',phone ='$phone' where bid ='$bId' ";
					mysql_query($insQry)or die (mysql_error());
		
				 }else{   
					$insQry ="insert into tt_business_cargo_info set company='$company', agent='$agent',inslimit='$inslimit', deductible='$deductible',phone ='$phone',bid ='$bId' ";
					mysql_query($insQry)or die (mysql_error());
					  }
				//cargo unsurance info check and insertion and update	  
				$SQL_check  = "SELECT * FROM tt_business_equipment_info where bid ='$bId'";
				$rs_row		= $db->get_row($SQL_check, ARRAY_A);
				
				if($rs_row){
							$insQry ="update tt_business_equipment_info set trucks='$trucks', route='$route',description='$description' where bid ='$bId' ";
							mysql_query($insQry)or die (mysql_error());
		
				}else{   
							$insQry ="insert into tt_business_equipment_info set trucks='$trucks', route='$route',description='$description', bid ='$bId' ";
							mysql_query($insQry)or die (mysql_error());
				}
			  
		}elseif ($rs_row_check['btype'] == 'Broker / Carrier'){
				
				//broker info check and insertion and update
			   $SQL_check   = "SELECT * FROM tt_business_broker where bid ='$bId'";
			   $rs_row		= $db->get_row($SQL_check, ARRAY_A);
	
				if($rs_row){
						$insQry_billing ="update tt_business_broker set bondagent ='$bondagent', bondphone='$bondphone' where bid ='$bId' ";
						mysql_query($insQry_billing)or die (mysql_error());
				}else{   
						$insQry_billing ="insert into tt_business_broker set bondagent='$bondagent', bondphone='$bondphone', bid ='$bId' ";
						mysql_query($insQry_billing)or die (mysql_error());
				   }
				//cargo unsurance info check and insertion and update
				$SQL_check  = "SELECT * FROM tt_business_cargo_info where bid ='$bId'";
				$rs_row		= $db->get_row($SQL_check, ARRAY_A);	
				if($rs_row){
					$insQry ="update tt_business_cargo_info set company='$company', agent='$agent',inslimit='$inslimit', deductible='$deductible',phone ='$phone' where bid ='$bId' ";
					mysql_query($insQry)or die (mysql_error());
		
				 }else{   
					$insQry ="insert into tt_business_cargo_info set company='$company', agent='$agent',inslimit='$inslimit', deductible='$deductible',phone ='$phone',bid ='$bId' ";
					mysql_query($insQry)or die (mysql_error());
					  }
				//cargo unsurance info check and insertion and update	  
				$SQL_check  = "SELECT * FROM tt_business_equipment_info where bid ='$bId'";
				$rs_row		= $db->get_row($SQL_check, ARRAY_A);
				
				if($rs_row){
							$insQry ="update tt_business_equipment_info set trucks='$trucks', route='$route',description='$description' where bid ='$bId' ";
							mysql_query($insQry)or die (mysql_error());
		
				}else{   
							$insQry ="insert into tt_business_equipment_info set trucks='$trucks', route='$route',description='$description', bid ='$bId' ";
							mysql_query($insQry)or die (mysql_error());
				}
			  
		}
		if($userId!=1 && $userId!=0){
			$updatestatus ="Update tt_user set type ='b' where userId = $userId";
	  		mysql_query($updatestatus)or die (mysql_error());
		}
		unset($_SESSION['biz_reg_err2']);
		unset($_SESSION['biz_reg2']);
		//$_SESSION['biz_reg_err2']['business_add'] = 'Company Updated Successfully!';

		header('location:'.$ruadmin.'home.php?p=business');

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