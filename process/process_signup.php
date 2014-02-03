<?php 
include("../connect/connect.php");
include("../common/function.php");
include("../securimage/securimage.php");
      
	
/*if ( $_POST['User_claim'])
{
	unset($_SESSION['user_claim_err']);
	unset($_SESSION['user_claim']);
	foreach ($_POST as $k => $v )
	{
		$$k =  addslashes(trim($v ));
		$_SESSION['user_claim'][$k]=$v;
	}
		$QryStr ="select locationid, 	userId, name, 	address, 	city, 	state, 	zip, 	latitude, 	longitude, 	phone, 	tracked_phone, 	radius ,	industry, 	description, 	fax, 	email, 	website, 	status, 	userId, 	dated, 	logo, 	btype
					from business where status 	=1 and locationid =$companyId ";
		$dataRS = mysql_query($QryStr);
		$dataRow = mysql_fetch_array($dataRS);
		$title = 'Title: '. $dataRow['name'] .'<br > Phone: '. $dataRow['phone'] .'<br /> Address: '. $dataRow['address'] .', '. $dataRow['city'] .', '. $dataRow['state'] .', '.  $dataRow['zip'];
		$res_User = mysql_query("select * from tt_user where userId = ". $_SESSION['ARBLOGINDATA']['USERID']);
		$row_User = mysql_fetch_array($res_User);		
		// Add claim Request
		if ($dataRow['userId'] == 1 or $dataRow['userId'] == 0 or empty($dataRow['userId'])) {
		mysql_query("insert into business_claim set  userId = ".$_SESSION['ARBLOGINDATA']['USERID'].",locationid=$companyId ");
		mysql_query("update tt_user set  phone = '".$Phone."' where userId = ". $_SESSION['ARBLOGINDATA']['USERID']);
		$qry="select * from  emails where type ='claimrequest'";
		$rs=mysql_query($qry);
		$row =mysql_fetch_array($rs);
		$adminName=$row['adminname'];
		$toadmin=$row['toadmin'];
		$touser=$row['touser'];
		$subject=$row['subject'];
		$htmlData=$row['body'];

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$adminName.' <'.$touser.'>' . "\r\n";
		$headers .= "Content-type: text/html\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "X-Priority: 1\r\n";
		$headers .= "X-MSMail-Priority: High\r\n";
	
		$message = $htmlData;			
		 
		$message = str_replace('{{FirstName}}' ,$row_User['firstname'] , $message);
		$message = str_replace('{{LastName}}' ,$row_User['lastname'] , $message);
		
		$message = str_replace('{{Username}}' , $ru. $row_User['username'], $message);
		$message = str_replace('{{Email}}' ,	$row_User['email'] , $message);
		$email =$row_User['email'];
		$message = str_replace('{{Title}}' ,	$title , $message);
		$message = nl2br($message);

		$mailsent = mail($email,$subject,$message,$headers);
		$mailsent = mail($toadmin,'new claim request',$message,$headers);
		
		}else{
			header('location:'.$ru);
			exit;
		}
		header('location:'.$ru.'claim_welcome'); 
		exit;
}*/

if ( $_POST['User_register'])
{
	unset($_SESSION['user_reg_err']);
	unset($_SESSION['user_reg']);
	
	foreach ($_POST as $k => $v )
	{
		$$k =  addslashes(trim($v ));
		$_SESSION['user_reg'][$k]=$v;
	
	}
	$flgs = false;
	///////////////////////email validation///////////
	//if (sizeof($errors) == 0) {
     //include("../connect/connect.php");
	
   // }
	
	/*if($pincode=='' )
	{
		$flag=true;
		$_SESSION['user_reg_err']['pincode']='Please enter Captcha Code';
	}*/
	$type = 'c';
	if($userType == 'c')
		$type = 'c';
	
	//if(filter_var($email, FILTER_VALIDATE_EMAIL)){
	
	if($email=='' or $email=='Email Address')
	{
		$_SESSION['user_reg_err']['email'] = $_ERR['register']['email'];
		$flgs = true;
	}elseif($email!=''){
		//if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			//$_SESSION['user_reg_err']['email'] = $_ERR['register']['emailg'];
		//	$flgs = true;
		if (vpemail($email)){
			$_SESSION['user_reg_err']['email'] = $_ERR['register']['emailg'];
			$flgs = true;
		}else{
			$sqlcount = "select count(*) as ecount from tt_user where email like '$email'";
			$arrcount=mysql_query($sqlcount);
			$rowData =mysql_fetch_array($arrcount);
			if($rowData['ecount'] > 0)
			{
				$_SESSION['user_reg_err']['email'] = $_ERR['register']['emaile'];
				$flgs = true;
			}
		}
	
	}
	
	///////////////////////first name validation////////	
   if($fname=='' or $fname=='First Name')
	{
	
		$_SESSION['user_reg_err']['fname'] = "Please Enter The User Name";
		$flgs = true;
	}
	///////////////////////last name validation////////
	if($lname=='' or $lname=='Last Name')
	{
		$_SESSION['user_reg_err']['lname'] = "Please Enter The Last Name";
		$flgs = true;
	}
	///////////////////////password validation///////////
	if(verifypassword($password))
	{    $_SESSION['user_reg_err']['password'] = $_ERR['register']['passg'];
		$flgs = true;
	}

	/////////////////////// Check if the password matched //////
	
	if($password != $cpassword)
	{
		$_SESSION['user_reg_err']['cpassword'] = $_ERR['register']['passc'];
		$flgs = true;
	}
	 
	if($zip =='' or $zip=='Zip Code')
	{
		$_SESSION['user_reg_err']['zip'] = 'Please Enter Zip Code';
		$flgs = true;
	}
	
	
    
     /* if ($securimage->check($pincode) == false) {
        $_SESSION['user_reg_err']['pincode'] = 'Incorrect security code entered<br />';
		$flgs = true;
	 }*/
	
	/*if( strtolower($pincode) != strtolower($_SESSION['tt_security_code']))
	{
		$_SESSION['user_reg_err']['pincode'] = 'Please provide valid security code';
		$flgs = true;
	}*/
	unset($_SESSION['tt_security_code']);
  if($flgs)
  {
	header('location:'.$ru.'signup.php'); 
	exit;
  }else{
  
  
  //++++++++++++++++++++++ latitude and longitude
  
 // $address1 = $address.' '.$address2.', '.$city.', '.$state.' '.$zip.'';
 
 
  /*$address1 =$zip;
		$address1 = urlencode(stripslashes($address1));
		$location = file("http://maps.google.com/maps/geo?q=$address1&output=csv&key=ABQIAAAAseZREdN_Nhlhj3sI93ilyxTFXeOqGzGS-9SJmCfgnHR3mTEJHhRuMkQOalyVjsE-xUFm8qTB35bSXQ");
		list($stat,$acc,$Latitude,$Longitude) = explode(",",$location[0]);*/


		//echo $stat."</br>".$acc."</br>".$Latitude."</br>".$Longitude;exit;
  
  
  $addressbuss = '';

	

		
		
		if($zip!= ''){
			$addressbuss .= ", ".$zip;
		}

		
		$where = stripslashes($addressbuss).", UK";
		$whereurl = urlencode($where);
			

		
		$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$whereurl.'&sensor=false');

		$output= json_decode($geocode);
		
		$Latitude = $output->results[0]->geometry->location->lat;
		$Longitude = $output->results[0]->geometry->location->lng;
  
  
  
  //+++++++++++++++++++++++++ latitude and longitude
  		$password = md5($password);
		 $insQry = "insert into tt_user set firstname ='$fname', 
				`lastname`='$lname', `email` = '$email',
				`type` = '$type', `password` = '$password',	
				`zip` = '$zip', `status`= 'Active',
				`dated` = now()
				";
				//echo $insQry;exit;
		//echo $insQry;exit;
		mysql_query($insQry)or die (mysql_error());
		$userId = mysql_insert_id();
		
		
		
		
		$_SESSION['user_reg_err']['save'] = 'You have been reigstered successfully';
			unset($_SESSION['user_reg']);
			//header("location:".$ru.'quote_finish/singup/' . base64_encode($userId) );exit;
			header("location:".$ru.'signup.php');
		
		exit;
		//}
  }
}

if ( $_POST['Update_profile'])
{
	unset($_SESSION['user_reg_err']);
	unset($_SESSION['user_reg']);
	foreach ($_POST as $k => $v )
	{
		$$k =  addslashes(trim($v ));
		$_SESSION['user_reg'][$k]=$v;
	}
	$flgs = false;
	///////////////////////first name validation////////	
   if(verifyName($firstname))
	{
		$_SESSION['user_reg_err']['firstname'] = $_ERR['register']['firstname'];
		$flgs = true;
	}
	///////////////////////last name validation////////
	if(verifyName($lastname))
	{
		$_SESSION['user_reg_err']['lastname'] = $_ERR['register']['lastname'];
		$flgs = true;
	}
	///////////////////////state city validation///////////
	
	if($zip =='')
	{
		$_SESSION['user_reg_err']['zip'] = 'please provide zip code';
		$flgs = true;
	}
	
	
	///////////////////////email validation///////////
	$selectQry = "select * from tt_user where userId = '$userId' ";
	$selectRes = mysql_query($selectQry);
	$selectRow = mysql_fetch_array($selectRes);
	$updateProfile = false;
	if(strlen($email)<5)
	{
		$_SESSION['user_reg_err']['email'] = $_ERR['register']['email'];
		$flgs = true;
	}
	elseif(trim($email)!= $selectRow['email'])
	{
		$updateProfile = true;
		if( vpemail($email) )
		{
			$_SESSION['user_reg_err']['email'] = $_ERR['register']['emailg'];
			$flgs = true;
			$updateProfile = false;
		}
		else
		{
			$sqlcount = "select count(*) as ecount from tt_user where email like '$email' and userId <> $userId";
			$arrcount=mysql_query($sqlcount);
			$rowData =mysql_fetch_array($arrcount);
			if($rowData['ecount'] > 0)
			{
				$_SESSION['user_reg_err']['email'] = $_ERR['register']['emaile'];
				$flgs = true;
				$updateProfile = false;
			}			
		}
		
	}
	/*
	if ( isset($_FILES['logo']['tmp_name'])) 
	{
		include('../upload.php');
		@mkdir ('../media/user/' .$userId .'/',0777) ;
		@mkdir ('../media/user/' .$userId .'/thumb/',0777) ;
		$upload_dir = '../media/user/' .$userId.'/';
		$thumb_folder = '../media/user/' .$userId.'/thumb/';
		
		$logo ='';			
		chmod($upload_dir,0777);	
		//$ext= array ('gif','jpg','jpeg','png','bmp');			
		$ext= array ('gif','jpg','jpeg','png','bmp','pdf','doc','docx','xls','xlsx','txt');
		$photo = "logo"; 

		$file_type=$_FILES[$photo]['type'];   			
		if(!empty($_FILES[$photo]['name']))
		{
			$upload = new upload($photo, $upload_dir, '777', $ext);
			if ($upload->message =="SUCCESS_FILE_SAVED_SUCCESSFULLY" )
			{
				$photoname=$upload->filename;					
				require_once('../phpThumb/phpthumb.class.php');
				$phpThumb = new phpThumb();
				$thumbnail_width = 120;
				$phpThumb->setSourceFilename($upload_dir.$photoname);
				$output_filename = $thumb_folder.$photoname;
				$phpThumb->setParameter('w', $thumbnail_width);
				
				if ($phpThumb->GenerateThumbnail())
				{ // this line is VERY important, do not remove it!
					if ($phpThumb->RenderToFile($output_filename)) {
					// do something on success
					//echo 'Successfully rendered to "'.$output_filename.'"';
					} else {
					// do something with debug/error messages
					//echo 'Failed:<pre>'.implode("\n\n", $phpThumb->debugmessages).'</pre>';
					}
				} else {
					// do something with debug/error messages
					//echo 'Failed:<pre>'.$phpThumb->fatalerror."\n\n".implode("\n\n", $phpThumb->debugmessages).'</pre>';
				}
				$photoname = ", photo ='$photoname' ";
			}else{
				$_SESSION["msg"]["photo"] =$upload->message;
			}	
		}
	}*/
	
	if($flgs){
	  header('location:'.$ru.'member/profile'); exit;
	}else{
	
	//++++++++++++++++++++++ latitude and longitude
	
	/*$address1 =$zip;
		$address1 = urlencode(stripslashes($address1));
		$location = file("http://maps.google.com/maps/geo?q=$address1&output=csv&key=ABQIAAAAseZREdN_Nhlhj3sI93ilyxTFXeOqGzGS-9SJmCfgnHR3mTEJHhRuMkQOalyVjsE-xUFm8qTB35bSXQ");
		list($stat,$acc,$Latitude,$Longitude) = explode(",",$location[0]);*/




 $addressbuss = '';

	

		
		
		if($zip!= ''){
			$addressbuss .= ", ".$zip;
		}

		
		$where = stripslashes($addressbuss).", UK";
		$whereurl = urlencode($where);
			

		
		$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$whereurl.'&sensor=false');

		$output= json_decode($geocode);
		
		$Latitude = $output->results[0]->geometry->location->lat;
		$Longitude = $output->results[0]->geometry->location->lng;


	
	
	//++++++++++++++++++++++ latitude and longitude
	  $insQry ="UPDATE tt_user SET firstname ='$firstname', lastname = '$lastname',
	  	zip ='$zip' ,latitude='$Latitude', longitude='$Longitude'
		WHERE userId = $userId ";
  		mysql_query($insQry) or die (mysql_error());
		//$photoname
		if($updateProfile)
		{
			$insQry ="UPDATE tt_user SET email ='$email', status = 'Active' WHERE userId = $userId ";
			mysql_query($insQry);
			$qry = "SELECT * FROM tt_emails WHERE type ='changeemail'";
			$rs=mysql_query($qry);
			$row =mysql_fetch_array($rs);
			$adminName=$row['adminname'];
			$toadmin=$row['toadmin'];
			$touser=$row['touser'];
			$subject=$row['subject'];
			$htmlData=$row['body'];
			
	
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: '.$adminName.' <'.$touser.'>' . "\r\n";
			$headers .= "Content-type: text/html\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "X-Priority: 1\r\n";
			$headers .= "X-MSMail-Priority: High\r\n";
		
			$message = $htmlData;			
			 
			$message = str_replace('{{FirstName}}' ,$firstname , $message);
			$message = str_replace('{{LastName}}' ,$lastname , $message);
			
			//$message = str_replace('{{Username}}' , $ru. $profile_name , $message);
			$activationlink = $ru .'accountactivate.php?q='. base64_encode($userId);
			$message = str_replace('{{ActivationLink}}' ,$activationlink , $message);
			
			//$message = str_replace('{{Email}}' ,$email , $message);
			//$message = str_replace('{{Password}}' ,$confirm_password , $message);
	
			$message = nl2br($message);
	
			$mailsent = mail($email,$subject,$message,$headers);
			$chngEmail = '<br /><span style="color:#FF0000; font-size:12px; font-family:Arial, Helvetica, sans-serif;">
			Your email address changed successfully. 
			We have sent a verification email at your new email. 
			Please verify your email address. </span>';
			//$mailsent = mail($toadmin,'new user registered',$message,$headers);			
			
		}
		unset($_SESSION['user_reg_err']);
		unset($_SESSION['user_reg']);
		$_SESSION['update_profile'] = 'Your profile updated successfully'.$chngEmail;
		header('location:'.$ru.'member/profile'); 
		exit;
  }
	

}


if ( $_POST['update_passsword'])
{
	unset($_SESSION['user_reg_err']);
	unset($_SESSION['user_reg']);
	foreach ($_POST as $k => $v )
	{
		$$k =  addslashes(trim($v ));
		$_SESSION['user_reg'][$k]=$v;
	}
	$flgs = false;
	///////////////////////email validation///////////
	if(!$currentpassword)
	{
		$_SESSION['user_reg_err']['currentpassword'] = 'Please provide current password';
		$flgs = true;
	}elseif($currentpassword!=''){
		$tmpCurrentpassword = md5($currentpassword);
		$sqlcount = "SELECT COUNT(*) as ecount FROM tt_user WHERE password = '$tmpCurrentpassword' and  userId = $userId ";
		$arrcount=mysql_query($sqlcount);
		$rowData =mysql_fetch_array($arrcount);
		if($rowData['ecount'] == 0)
		{
			$_SESSION['user_reg_err']['currentpassword'] = 'Current password incorrect';
			$flgs = true;
		}
	}
	
	///////////////////////password validation///////////
	if(verifypassword($newpassword))
	{    $_SESSION['user_reg_err']['newpassword'] = $_ERR['register']['passg'];
		$flgs = true;
	}

	/////////////////////// Check if the password matched //////
	
	if($newpassword != $confirmpassword)
	{
		$_SESSION['user_reg_err']['confirmpassword'] = $_ERR['register']['passc'];
		$flgs = true;
	}
	 
	if($flgs){
		header('location:'.$ru.'member/change_pass'); exit;
	}else{
		$password  = md5($newpassword);
		$insQry ="UPDATE tt_user SET password ='$password' WHERE userId = $userId ";
		mysql_query($insQry)or die (mysql_error());
		unset($_SESSION['user_reg_err']);
		unset($_SESSION['user_reg']);
		$_SESSION['update_passsword'] = 'Your password updated successfully';		
		header('location:'.$ru.'member/change_pass'); 
		exit;
	  }
	

}


if ( $_POST['signupSubs'])
{	
	foreach ($_POST as $k => $v )
	{
		$$k =  addslashes(trim($v ));
	}
	$flgs = false;
	///////////////////////email validation///////////
	$errorText = '';
	if(!$email)
	{
		$errorText .= "<li>".$_ERR['register']['email']."</li>";
		$flgs = true;
	}elseif($email!=''){
		if (vpemail($email )){
			$errorText .= "<li>".$_ERR['register']['emailg']."</li>";
			$flgs = true;
		}else{
			$sqlcount = "select count(*) as ecount from tt_user where email like '$email'";
			$arrcount=mysql_query($sqlcount);
			$rowData =mysql_fetch_array($arrcount);
			if($rowData['ecount'] > 0)
			{
				$errorText .= "<li>".$_ERR['register']['emaile']."</li>";
				$flgs = true;

			}
		}

	}
	
	///////////////////////first name validation////////	
   if(verifyName($firstname))
	{
		$errorText .= "<li>".$_ERR['register']['firstname']."</li>";
		$flgs = true;
	}
	///////////////////////last name validation////////
	if(verifyName($lastname))
	{
		$errorText .= "<li>".$_ERR['register']['lastname']."</li>";
		$flgs = true;
	}
	///////////////////////password validation///////////
	if(verifypassword($password))
	{    
		$errorText .= "<li>".$_ERR['register']['passg']."</li>";
		$flgs = true;
	}
	/////////////////////// Check if the password matched //////
	if($password != $confirm_password)
	{
		$errorText .= "<li>".$_ERR['register']['passc']."</li>";
		$flgs = true;
	}
	 
	if(isset($_POST['user_type']))
	{
		$type = $_POST['user_type'];
	}
	else
	{
		$type = 'member';
	}
	 
	 
  if($flgs)
  {
	  echo "<h2>Please provide the following information to proceed.</h2><ul>".$errorText."</ul>";
  }else{
  		$password = md5($password);
		$insQry = "insert into tt_user set firstname ='$firstname', lastname='$lastname', email='$email',
				password ='$password', country = '".$LOCAL['country']."', state ='".$LOCAL['state']."',
				city ='".$LOCAL['city']."', zip = '".$LOCAL['zipcode']."', status='Active',
				type='$type', dated = now()";
  		mysql_query($insQry)or die (mysql_error());
		$userId = mysql_insert_id();
		if($type == 'affiliate')
			$qry = "select * from  tt_emails where type ='affsignup'";
		else
			$qry = "select * from  tt_emails where type ='signup'";
		
		
		$rs=mysql_query($qry);
		$row =mysql_fetch_array($rs);
		$adminName=$row['adminname'];
		$toadmin=$row['toadmin'];
		$touser=$row['touser'];
		$subject=$row['subject'];
		$htmlData=$row['body'];
		

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$adminName.' <'.$touser.'>' . "\r\n";
		$headers .= "Content-type: text/html\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "X-Priority: 1\r\n";
		$headers .= "X-MSMail-Priority: High\r\n";
	
		$message = $htmlData;			
		 
		$message = str_replace('{{FirstName}}' ,$firstname , $message);
		$message = str_replace('{{LastName}}' ,$lastname , $message);
		
		$message = str_replace('{{Username}}' , $ru. $profile_name , $message);
		$activationlink = $ru .'accountactivate.php?q='. base64_encode($userId);
		$message = str_replace('{{ActivationLink}}' ,$activationlink , $message);
		
		$message = str_replace('{{Email}}' ,$email , $message);
		$message = str_replace('{{Password}}' ,$confirm_password , $message);

		$message = nl2br($message);

		$mailsent = mail($email,$subject,$message,$headers);
		
		$mailsent = mail($toadmin,'new user registered',$message,$headers);
		
		$_SESSION['ARBLOGINDATA']['ISLOGIN'] = 'yes';
		$_SESSION['ARBLOGINDATA']['EMAIL'] = $email;
		$_SESSION['ARBLOGINDATA']['NAME'] = $firstname;
		$_SESSION['ARBLOGINDATA']['USERID'] = $userId;
		$_SESSION['ARBLOGINDATA']['TYPE'] = $type;

		echo 'reigstered Successfully';
		exit;
  }
}

?>