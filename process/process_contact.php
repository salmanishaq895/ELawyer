<?php
include('../connect/connect.php');
include('../common/function.php');
if ( $_GET['p']=="sent"){
  	unset($_SESSION['user_con_err']);
	unset($_SESSION['user_con']);
	foreach ($_POST as $k => $v ){
		$$k =  trim($v);
		 $_SESSION['contact'][$k]=$v; 
	}
	$flgs = false; 
//----------------------username validation--------------------------//	
	if($username=='' or $username == 'Your Name')
	{
		$_SESSION['user_con_err']['username'] = $_ERR['register']['username'];
		$flgs = true;
	}
//----------------------email validation--------------------------//
	if($email=='' or $email == 'Email Address'){
		$_SESSION['user_con_err']['email'] = $_ERR['register']['email'];
		$flgs = true;
	}
//-------------------------phone validation----------------------------//	
	if($Subject=='' or $Subject=='Subject'){
		$_SESSION['user_con_err']['Subject'] = "Please Enter Subject";
		$flgs = true;
	}
///-------------------------message validation----------------------------//	
	if($Message=='' or $Message=='Message'){
		$_SESSION['user_con_err']['Message'] = $_ERR['register']['message'];
		$flgs = true;
	}
//-------------------------captcha validation----------------------------//		
	if (empty($_POST['pincode']))
	{
		$_SESSION['user_con_err']['recaptcha_response_field']='Please enter Security Code to continue.';
		$flgs = true;
	}elseif (strtolower($_POST['pincode']) != strtolower($_SESSION['tt_security_code']))
	{
		$_SESSION['user_con_err']['recaptcha_response_field']='Entered Security Code is Invalid.';
		$flgs = true;
	}
	unset($_SESSION['tt_security_code']);
//---------Flgs comes-----------------//	
  if($flgs){ 
	header('location:'.$ru.'contact_us'); exit;
  }
	else{/// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From:'.$email. "\r\n";
		
		$msg  = "Name: ".$username;
		$msg .= '<br/>Email: '.$email;
		//$msg .= '<br/>Phone: '.$phone;
		$message = stripslashes($Message);
		$msg .= '<br/>Message:<br/>'.nl2br($message);
		
		$subject = "TradesTools - Contact Message from visitor";

		
		mail('zahid@zamsol.com', $subject, $msg, $headers);
		unset($_SESSION['user_con_err']);
		unset($_SESSION['user_con']);
		$_SESSION['user_con_err']['sent'] = 'We have recieved your query. We will back to you soon!';			
		header('location:'.$ru.'contact_us'); exit;

      }
}



?>