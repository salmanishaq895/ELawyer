<?php 
require_once("../../connect/connect.php");
require_once("../security.php");
require_once ('../inc/functii.php');
	//unset($_SESSION['emailsent']);
if(isset($_POST['slect_all']) and count($_POST['slect_all'])> 0 )
{
	$actul_subject = $_POST['txtSubject'];
	$actul_message = $_POST['txtData'];
	$mailfrom = $_POST['mailfrom'];
	
	if(trim($mailfrom)==''){
		$mailfrom='info@TradesTool.co.uk';
	}
	foreach($_POST['slect_all'] as $emailName)
	{
		$arr = explode('{:',$emailName);
		$fName = $arr[0];
		$lName = $arr[1];
		
		$subject = $actul_subject;
		$subject = str_replace('{{FirstName}}',$fName,$subject);
		$subject = str_replace('{{LastName}}',$lName,$subject);
		
		$message = $actul_message;
		$message = str_replace('{{FirstName}}',$fName,$message);
		$message = str_replace('{{LastName}}',$lName,$message);
		
		//User Keyword Mehran, khan
		$message = str_replace('{{Postal Code}}',$arr[2],$message);
		$message = str_replace('{{City}}',$arr[3],$message);
		$message = str_replace('{{State}}',$arr[4],$message);
		$message = str_replace('{{Country}}',$arr[5],$message);
		$email = $arr[6];
		//echo $email; exit;
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Additional headers
		$headers .= 'To: ' . $contactName . ' <' . $email . '>' . "\r\n";
		$headers .= 'From: TradesTool.co.uk <'.$mailfrom.'>' . "\r\n";
		
		//echo "<br> == ".$email." == ".$subject." == ".$message." = ".$headers;
		//exit;
		
		// Mail it
		$headers = addslashes($headers);
		$message = addslashes($message);
		$subject = addslashes($subject);
		$SQL_ins_email = "insert into tt_email_log set email 	= '$email',
													   subject 	= '$subject',
													   message 	= '$message',
													   headers 	= '$headers',
													   dated   	= now() ";
		
		$db->query($SQL_ins_email);	
		mail($email, $subject, $message, $headers);
		unset($headers); 
		//sleep(1);
		//echo $email."<br>".$subject."<br>".$BODY."<br>".$headers;
	}

	if($_POST['SaveTextData_customer']=='Send Email Trader'){ 
		header('location:'.$ruadmin.'home.php?p=emails_bulk_trader&s=1'); exit;
	}
	if($_POST['SaveTextData_advertiser']=='Send Email Customer'){ 
		header('location:'.$ruadmin.'home.php?p=emails_bulk_advertiser&s=1'); exit;
	}
}
	
?>