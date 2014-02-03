<?php 
require_once("../../connect/connect.php");
require_once("../security.php");
require_once ('../inc/functii.php');
//echo '<pre>'; print_r($_REQUEST); exit;
$adminUserId = $_SESSION['cp_tt']['userId'];
if ( isset ($_GET['action'])  and  ($_GET['action']=='d'))
{
			
			$userId =$_GET['userId'];
		
			$user_Sql = "select * from tt_user where userId = $userId ";
			$user_rs =mysql_query($user_Sql);
			if (mysql_num_rows($user_rs) == 0) {header('location:'.$ruadmin.'home.php');exit;}

			$SQL_claim_business = "delete from tt_business_claim where userId =$userId ";
			$db->query($SQL_claim_business);
			
			$SQL_claim_business_log = "delete from tt_business_claim_log where userId =$userId ";
			$db->query($SQL_claim_business_log);
			
			$SQL_claim_business_user = "update tt_business set userId =0 where userId =$userId ";		
			$db->query($SQL_claim_business_user);
		
			$rowData =mysql_fetch_array($user_rs);
			$user_Sql = "delete from tt_user where userId = $userId ";
			if( $user_rs =mysql_query($user_Sql) ){
				
				$rdir = $ruadmin.'home.php?p=user_manage';
				$_SESSION['msg'] = 'User deleted !';
				header('location:'.$rdir );exit;
				
			} 
}
//------------------------------------Activation email -----------------------
if ( isset ($_GET['action'])  and  ($_GET['action']=='e')){
			
		$userId =$_GET['userId'];
	    	unset($_SESSION['msg']);
		
		 $SQL_act = "SELECT * from tt_user where userId = $userId";
		$rs_row  = $db->get_row($SQL_act, ARRAY_A);	
		$userId = base64_encode($userId);
		 $email = $rs_row['email'];
		 $firstname = $rs_row['firstname'];
		
		function sendmail($from,$to,$toname,$subject,$msg){
				$msg = nl2br($msg);
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'To: ' . $toname . ' <' . $to . '>' . "\r\n";
				$headers .= 'From: TradesTool <'.$from.'>' . "\r\n";
		
				mail($to, $subject, $msg, $headers);
				unset($headers); 
		}
		$activationlink = $ru.'accountactivate/'.$userId;
		$activationlink = '<a href="'.$activationlink.'">'.$activationlink.'</a>';
		//------------------ signup memeber -----------
       	$qryemail = "SELECT * FROM tt_emails WHERE type  = 'signup'";
		$rsemailtemp = $db->get_row($qryemail,ARRAY_A);	
		$subject = $rsemailtemp['subject']; 
		$from= $rsemailtemp['touser']; 
		$msg = $rsemailtemp['body'];
		$msg  = str_replace("{{Firstname}}",$firstname,$msg);
		$msg  = str_replace("{{URL}}",$activationlink,$msg);

		sendmail($from,$email,$username,$subject,$msg);
		//sendmail($from,'softeye@gmail.com',$username,$subject,$msg);
		sendmail($from,'azeem@zamsol.com',$username,$subject,$msg);
		
		$rdir = $ruadmin.'home.php?p=user_manage';
		$_SESSION['msg'] = 'Email send to user!';
		header('location:'.$rdir );exit;
	
}
//------------------------------------Add User Process Start Here---------------------------------------//
if ( isset ($_POST['AddMember'])){
	
	unset($_SESSION['user_reg_err']);
	unset($_SESSION['user_reg']);
	
	foreach ($_POST as $k => $v ){
		$$k =  addslashes(trim($v ));
		$_SESSION['user_reg'][$k]=$v;
	}
	$flgs = false;
//---------------------------Email validation-----------------------//
		if(!$email){
			$_SESSION['user_reg_err']['email'] = $_ERR['register']['email'];
			$flgs = true;
		}elseif($email!=''){
				if (vpemail($email )){
					$_SESSION['user_reg_err']['email'] = $_ERR['register']['emailg'];
					$flgs = true;
				}else{
					$sqlcount = "select count(*) as ecount from tt_user where email like '$email' and type ='".$type."' ";
					$arrcount=mysql_query($sqlcount);
					$rowData =mysql_fetch_array($arrcount);
					if($rowData['ecount']> 0){
						$_SESSION['user_reg_err']['email'] = $_ERR['register']['emaile'];
						$flgs = true;
				}
			}
		}
//---------------------username name validation----------------//	
		/*
		if(verify_username($username))
		{
			$_SESSION['user_reg_err']['username'] = $_ERR['register']['username'];
			$flgs = true;
		}
		elseif (VerifyDBUsername($username)){
			$_SESSION['user_reg_err']['username'] =$_ERR['register']['userVerify'];
			$flgs = true;
		}
		echo "<pre>";
		print_r($_SESSION['user_reg_err']);exit;
		*/
//-----------------first name validation--------------------//	
	   if(verifyName($firstname))
		{
			$_SESSION['user_reg_err']['firstname'] = $_ERR['register']['firstname'];
			$flgs = true;
		}
//----------------------last name validation-----------------//
		if(verifyName($lastname))
		{
			$_SESSION['user_reg_err']['firstname'] = $_ERR['register']['lastname'];
			$flgs = true;
		}
//--------------------password validation---------------------//
		if(verifypassword($password))
		{
			$_SESSION['user_reg_err']['password'] = $_ERR['register']['passg'];
			$flgs = true;
		}
	
//----------------- Check if the password matched---------------//
		
		if($password != $cpassword)
		{
			$_SESSION['user_reg_err']['cpassword'] = $_ERR['register']['passc'];
			$flgs = true;
		}
		 
		   
	  if($flgs)
	  {

		header('location:'.$ruadmin.'home.php?p=user_add'); 
		exit;
	  }else{
			$password = md5($password);
			$phone = formatPhone($phone);
			$ins_user ="insert into tt_user set 	firstname 	='$firstname',	
													lastname	='$lastname',
													address 	= '$address',	
													email		='$email', 
													state		='$state', 
													city		='$city',
													zip			='$zip',
													username 	='$username',
													password 	='$password',
													phone 		='$phone',
													status		='$status', 	
													createdby 	='$adminUserId',
													type		='$type' , 
													dated 		=now()";
			$db->query($ins_user);
			unset($_SESSION['user_reg_err']);
			unset($_SESSION['user_reg']);
			$_SESSION['user_reg_err']['useradded'] = 'User Added Successfully!';
			header('location:'.$ruadmin.'home.php?p=user_add'); exit;
	  }
}
//------------------------------------Add  User Process End   Here---------------------------------------//

//------------------------------------Edit User Process Start Here---------------------------------------//
if ( isset ($_POST['UpdateMember'])){
	
	unset($_SESSION['user_update_err']);
	unset($_SESSION['user_update']);
	
	foreach ($_POST as $k => $v )
	{
		$$k =  addslashes(trim($v ));
		$_SESSION['user_update'][$k]=$v;
	
	}
		$flgs = false;
//---------------------------Email validation-----------------------//
		if(!$email)
		{
			$_SESSION['user_update_err']['email'] = $_ERR['register']['email'];
			$flgs = true;
		
		}elseif($email!=''){
			
			if (vpemail($email )){
			
				$_SESSION['user_update_err']['email'] = $_ERR['register']['emailg'];
				$flgs = true;
			
			}else{
	
				$sqlcount = "select count(*) as ecount from tt_user where email like '$email' and userId != $userId ";
				$arrcount=mysql_query($sqlcount);
				$rowData =mysql_fetch_array($arrcount);
				if($rowData['ecount']> 0)
				{
					$_SESSION['user_update_err']['email'] = $_ERR['register']['emaile'];
					$flgs = true;
	
				}
			}
	
		}
//---------------------------username name validation--------------------------//	
		if(verify_username($username))
		{
			//$_SESSION['user_update_err']['username'] = 'Username '.$_ERR['register']['username'];
			//$flgs = true;	
		}else{
			$rsVU =mysql_query("select count(*) as uc from tt_user where username like '$username' and userId != $userId ");
			$rowUV = mysql_fetch_array($rsVU);
		
			if ( $rowUV['uc']> 0 ) {
				$_SESSION['user_update_err']['username'] =$_ERR['register']['userVerify'];
				$flgs = true;
			}
		}
//-----------------first name validation--------------------//
	   if(verifyName($firstname))
		{
		
			$_SESSION['user_update_err']['firstname'] = $_ERR['register']['firstname'];
			$flgs = true;
		}
//----------------------last name validation-----------------//
		if(verifyName($lastname))
		{
			$_SESSION['user_update_err']['firstname'] = $_ERR['register']['lastname'];
			$flgs = true;
		}
//--------------------password validation---------------------//
		
		if($password != '' & $cpassword!=''){
			if(verifypassword($password))
			{    $_SESSION['user_update_err']['password'] = $_ERR['register']['passg'];
				$flgs = true;
			}
		
//----------------- Check if the password matched---------------//
			
			if($password != $cpassword)
			{
				$_SESSION['user_update_err']['cpassword'] = $_ERR['register']['passc'];
				$flgs = true;
			}
			$passwrd = " password ='".md5($password)."',";
		}	   
		  
	  if($flgs){
		header('location:'.$ruadmin.'home.php?p=profilesettings&userId='.$userId); exit;
	  }else{
			if($_SESSION['cp_tt']['userId'] == $userId ) $status ='Active';
				$phone = formatPhone($phone);
				 $upd_user ="Update tt_user set 	firstname 	='$firstname',
												lastname	='$lastname',
												address 	= '$address', 	
												email		='$email',
												state		='$state', 
												city		='$city', 
												zip			='$zip', 	
												".$passwrd."
												phone 		='$phone',
												status		='$status',
												type		='$type',
												updated 	=now()
										where   userId 		=$userId";
				
				$db->query($upd_user);
				unset($_SESSION['user_update_err']);
				unset($_SESSION['user_update']);
			if($_SESSION['cp_tt']['userId'] == $userId ){ 
				
				$_SESSION['cp_tt']['firstname']	=$firstname;
				$_SESSION['cp_tt']['lastname']		=$lastname;
				$_SESSION['cp_tt']['email']		=$email;
				$_SESSION['cp_tt']['username']		=$username;
				$_SESSION['cp_tt']['password']		=$password;
				$_SESSION['cp_tt']['phone']		=$phone;
				$_SESSION['cp_tt']['dated']		=$dated;
				$_SESSION['cp_tt']['type']			=$type;	
			}				
			$_SESSION['user_update_err']['useradded'] = 'User Updated Successfully!';
			header('location:'.$ruadmin.'home.php?p=profilesettings&userId='.$userId); exit;
	  }
}


?>