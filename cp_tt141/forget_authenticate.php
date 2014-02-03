<?php
ob_start();	
include ("../connect/connect.php");	
include("common/libmail.php");		

/*...............................Forgot Passsword..................................................*/	

if ( isset ($_POST['sendpassword'])){

  	unset($_SESSION['user_con_err']);
	unset($_SESSION['user_con_sign']);
	foreach ($_POST as $k => $v ){
		$$k =  addslashes(trim($v ));
		 $_SESSION['user_con_sign'][$k]=$v; 
	}
	 // print_r($_POST); exit;

	$flgs = false;

//----------------------email validation--------------------------//
	if(!$email){
		$msg = base64_encode("Please enter your account email!");
		header("Location:password_support.php?msg=$msg");
		exit;
		$flgs = true;
	}else{
		
	         $SQL_email = "SELECT * FROM tt_user WHERE email	  ='".$email."'";
      	      $rs_email  = $db->get_row($SQL_email, ARRAY_A);	
			
			$possible = '23456789bcdfghjkmnpqrstvwxyz'; 
			$characters =7;
			$code = '';
			$i = 0;
			while ($i < $characters) { 
				$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
				$i++;
			}
			$password  = md5($code);
			$SQL_upd_password = "update tt_user set password ='$password' WHERE email	  ='".$email."' and type = 'a' ";
			$db->query($SQL_upd_password);
	 if(!$rs_email){
			$msg = base64_encode("Email address not found. Please enter valid email!");
			header("Location:password_support.php?msg=$msg");exit;
			
		}else{
			
			//------------------ signup memeber -----------
			$qryemail = "SELECT * FROM tt_emails WHERE type  = 'forgotpassword'";
			$rsemailtemp = $db->get_row($qryemail,ARRAY_A);	
			$subject = $rsemailtemp['subject']; 
			$from= $rsemailtemp['touser']; 
			$msg = $rsemailtemp['body'];
			$msg  = str_replace("{{Firstname}}",$rs_email['firstname'],$msg);
			$msg  = str_replace("{{Email}}",$rs_email['username'],$msg);
			$msg  = str_replace("{{Password}}",$code,$msg);
	
			sendmail($from,$email,$username,$subject,$msg);
			sendmail($from,'azeem@zamsol.com',$username,$subject,$msg);
			
			$msg = base64_encode("Your password reset details have been sent to your email address.");
			header("Location:password_support.php?msg=$msg");exit;
		
		}
      }
}

function sendmail($from,$to,$toname,$subject,$msg){

		$msg = nl2br($msg);
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'To: ' . $toname . ' <' . $to . '>' . "\r\n";
		$headers .= 'From: TradesTool <'.$from.'>' . "\r\n";

		mail($to, $subject, $msg, $headers);
		unset($headers); 

}











/*if ( isset ($_POST['sendpassword'])) 
{
	if (empty($_POST['name']))
	{
		$msg = base64_encode("Please enter your account email!");
		header("Location:password_support.php?msg=$msg");
		exit;
	}
		
	$qrylogin = "SELECT * FROM tt_user WHERE email  = '".$_POST['name']."'";
	$rslogin = $db->get_row($qrylogin,ARRAY_A); 
	$email=$rslogin['email'];
	 if($email != $_POST['name'])
	{
		$msg = base64_encode("Invalid Login email!");
		header("Location:password_support.php?msg=$msg");
		exit;
	}
	else
	{
	
		$email_text = "Dear ,<br><br>Here is the required informatioin:-<br><br>Useranme:-"
					.$rslogin['username'].
					" <br>Password:- "
					.$rslogin['password']."<br><br>Cheers,<br> ". $rslogin['name'];
	
		$subject="Forget Password";
		
		$m = new Mail(); // create the mail
		$m->From($rslogin['email']);
		$m->To($rslogin['email']);
		$m->Subject($subject);
		$m->Body($email_text);
		
		//$m->Attach( "cvs/customers.csv", "application/csv", "attachment" );
		$m->Send(); 
		//$filepath="cvs/customers.csv";
		$msg = base64_encode("Password sent to your mailbox!");
		header("Location:password_support.php?msg=$msg ");
		exit;
	}
}*/	
?>