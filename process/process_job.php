<?php
include('../connect/connect.php');
include('../connect/functii.php');
foreach ($_POST as $k => $v )
{
	$$k =  addslashes(trim($v ));
} 

$userId = $_SESSION['TTLOGINDATA']['USERID'];

if(isset($_POST['SaveJob']))
{
	
	 $insert_review ="Insert into tt_invite_job set 	
		bId ='$bId', userId	= '$userId',job_title='$title', date_added  = NOW()";// exit;
		$db->query($insert_review);
		echo '<div style=" background-color:#E1E1E1; font-size:18px; padding:66px 0px 191px 95px"> Thanks for invite to job! </div>';
		
		$sql_user_email = "select * from tt_user where userId='$userId'";
		//$result_user_email = $db->get_row($sql_user_email,ARRAY_A);
		//$from = $result_user_email['email'];
		$result_user_email = mysql_query($sql_user_email);
		$row_user_email = mysql_fetch_array($result_user_email);
		$from = $row_user_email['email'];
	
		$fname = $row_user_email['firstname'];
	 	$lname= 	$row_user_email['lastname'];
		$phone  = $row_user_email['phone'];
		//echo $fname." ".$lname." ".$phone; exit;
		
		$sql_email ="select * from tt_business where locationid='".$bId."'";
		$result = $db->get_row($sql_email,ARRAY_A);
		 //echo "<pre>"; print_r($result);
		$email = $result['email'];
		//$business_name = $result['name'];
		//echo  $to; exit;
		 //echo $email; 
		// $result_email = mysql_query($sql_email);
		//$row_email = mysql_fetch_array($result_email);
		//$to = $row_email['email'];
		 
		 
		 
		 $sql_message = "select * from tt_quotes where quotes_id='".$title."'";
		 $result_message = $db->get_row($sql_message,ARRAY_A);
		 $description  = stripslashes($result_message['message']);
		 
		 //$result_message = mysql_query($sql_message);
		 //$row_message = mysql_fetch_array($result_message);
		 //$msg = $row_message['message'];
		 
		 
		 
		// +++++++++++++++++++ this code is used for the emial 
		$qry = "select * from  tt_emails where type ='invite_to_job'";

		$rs=mysql_query($qry);
		$row =mysql_fetch_array($rs);
		$adminName=$row['adminname'];
		$toadmin=$row['toadmin'];
		//$touser=$row['touser'];
		$subject=$row['subject'];
		$htmlData=$row['body'];
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$toadmin.'' . "\r\n";
		$headers .= "Content-type: text/html\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "X-Priority: 1\r\n";
		$headers .= "X-MSMail-Priority: High\r\n";
	
		$message = $htmlData;			
		 
		$message = str_replace('{{FirstName}}' ,$fname, $message);
		$message = str_replace('{{LastName}}' ,$lname , $message);
		$message = str_replace('{{Phone}}' ,$phone , $message);
		$message = str_replace('{{Email}}' ,$from , $message);
		$message = str_replace('{{Title}}' ,$title , $message);
		$message = str_replace('{{Description}}' ,$description , $message);
		
		//$message = str_replace('{{Username}}' , $ru. $profile_name , $message);
		//profile/1_Toddler_Sense
		//http://zamsol.net/tradestool/job_particulars/13_Plumbing_dd_d_d_d_d_d_d
		$activationlink = $ru .'job_particulars/'.$result_message['quotes_id'].'_'.encodeURL(stripslashes($result_message['title']));
		$joblink = '<a href="'.$activationlink .'">'.$activationlink .'</a>';
		$message = str_replace('{{JobUrl}}' ,$joblink , $message);
		
	//	$message = str_replace('{{Email}}' ,$email , $message);
	//	$message = str_replace('{{Password}}' ,$confirm_password , $message);

		$message = nl2br($message);

		$mailsent = mail($email,$subject,$message,$headers);
		 
		 
		 
		 
		 // ++++++++++++++ the end of email code
		 
		 
		 
		//sendmail($from,$to,$toname,$title,$msg);
		//header('location:'.$ru.'writereview'); 
		exit;
}



if($_GET['action'] == 'delete_job')
{
//echo "mehran"; exit;
	$qry = mysql_query("DELETE FROM  `tt_messages` WHERE id = '".$_GET['job_invite_id']."'");
	$row = mysql_fetch_array($qry);
	/*if(!empty($row['img'])){
		@unlink('../media/key-services/' . $userId . '/'.$row['img']);
		@unlink('../media/key-services/' . $userId . '/thumb/'.$row['img']);
	}
	mysql_query("DELETE FROM `tt_business_keyservices` WHERE id = '".$_GET['keyid']."'");
	*/$_SESSION['key_services_msg'] = 'Record deleted successfully!';
	header('location:'.$ru.'member/applied_job/');
	exit;
}

//_______________++++++++++++++++ this code is used for the trader send email to customer  the trader applied job...


if($_GET['action']=='send_job')
{

	$jobId  = $_GET['id'];
	
	$sql_message = "select * from tt_quotes where quotes_id='".$jobId."'";
		 $result_message = $db->get_row($sql_message,ARRAY_A);
		 //$description  = $result_message['message'];
		//$email = $result_message['email'];
		$userIdd  = $result_message['userId'];
	$sql_user_email = "select * from tt_user where userId='$userIdd'";
		//$result_user_email = $db->get_row($sql_user_email,ARRAY_A);
		//$from = $result_user_email['email'];
		$result_user_email = mysql_query($sql_user_email);
		$row_user_email = mysql_fetch_array($result_user_email);
		$email = $row_user_email['email'];
	
		$fname = $row_user_email['firstname'];
	 	$lname= 	$row_user_email['lastname'];
		
		
 	$sql_trader  = "select * from tt_business where userId = '".$userId."'";
	$result = $db->get_row($sql_email,ARRAY_A);
		 //echo "<pre>"; print_r($result);
		//$email = $result['email'];
		$name = $result['name'];
		$address = $result['address'];
		$city   = $result['city'];
		$state   = $result['state'];
		$zip   = $result['zip'];
		$phone   = $result['phone'];
		$tracked_phone   = $result['tracked_phone'];
		$description  = $result['description'];
		
		$qry = "select * from  tt_emails where type ='invite_to_job'";
		$rs=mysql_query($qry);
		$row =mysql_fetch_array($rs);
		$adminName=$row['adminname'];
		$toadmin=$row['toadmin'];
		//$touser=$row['touser'];
		$subject=$row['subject'];
		$htmlData=$row['body'];
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$toadmin.'' . "\r\n";
		$headers .= "Content-type: text/html\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "X-Priority: 1\r\n";
		$headers .= "X-MSMail-Priority: High\r\n";
	
		$message = $htmlData;			
		 
		$message = str_replace('{{FirstName}}' ,$fname, $message);
		$message = str_replace('{{LastName}}' ,$lname , $message);
		$message = str_replace('{{Phone}}' ,$phone , $message);
		$message = str_replace('{{Email}}' ,$from , $message);
		$message = str_replace('{{Title}}' ,$title , $message);
		$message = str_replace('{{Description}}' ,$description , $message);
		
		//$message = str_replace('{{Username}}' , $ru. $profile_name , $message);
		//$activationlink = $ru .'accountactivate/'. base64_encode($userId)."/";
		//$message = str_replace('{{URL}}' ,$activationlink , $message);
		
	//	$message = str_replace('{{Email}}' ,$email , $message);
	//	$message = str_replace('{{Password}}' ,$confirm_password , $message);

		$message = nl2br($message);

		$mailsent = mail($email,$subject,$message,$headers);

	$_SESSION['key_services_msg'] = 'Message Send to customer!';
	header('location:'.$ru.'member/applied_job/');
	exit;


}





//__________________  ++++++++++++ Delete the short list

if($_GET['action'] == 'short_list')
{
//echo "mehran"; exit;
	$qry = mysql_query("DELETE FROM  `tt_shortlist` WHERE shortlist_id = '".$_GET['shortlist_id']."'");
	$row = mysql_fetch_array($qry);
	/*if(!empty($row['img'])){
		@unlink('../media/key-services/' . $userId . '/'.$row['img']);
		@unlink('../media/key-services/' . $userId . '/thumb/'.$row['img']);
	}
	mysql_query("DELETE FROM `tt_business_keyservices` WHERE id = '".$_GET['keyid']."'");
	*/$_SESSION['key_services_msg'] = 'Record deleted successfully!';
	header('location:'.$ru.'member/short_list_jobs/');
	exit;
}

// _________________ ++++++++++++ End of short list code

if(isset($_POST['SaveReport']))
{
	if(strlen($review)<=5)
	{
		$_SESSION['review_error']['review'] = 'Please enter Report before submit';
		$flgs = true;
	}
	if( strtolower($pincode) != strtolower($_SESSION['tt_security_code']))
	{
		$_SESSION['review_error']['pincode'] = 'Please provide valid security code';
		$flgs = true;
	}
	unset($_SESSION['tt_security_code']);
	
	if($flgs){
	//echo "<pre>"; print_r($rId); exit;
		header("location:".$ru."inc/report_review.php?rId=".$rId);exit;
	
	}
	$insert_review ="Insert into tt_review_error set 
		reviewId ='$rId', description = '$review',
		 date_added  = now()";
		$db->query($insert_review);
		echo '<div style=" background-color:#E1E1E1; font-size:18px; padding:66px 0px 191px 95px"> Thanks for your Report! </div>';
		//header('location:'.$ru.'writereview'); 
		exit;
}


//____________________________________________ this code is used for the manage job


if($_GET['action'] == 'dele')
{
//echo "mehran"; exit;
	$qry = mysql_query("DELETE FROM  `tt_quotes` WHERE quotes_id = '".$_GET['jobid']."'");
	$row = mysql_fetch_array($qry);
	/*if(!empty($row['img'])){
		@unlink('../media/key-services/' . $userId . '/'.$row['img']);
		@unlink('../media/key-services/' . $userId . '/thumb/'.$row['img']);
	}
	mysql_query("DELETE FROM `tt_business_keyservices` WHERE id = '".$_GET['keyid']."'");
	*/$_SESSION['key_services_msg'] = 'Record deleted successfully!';
	header('location:'.$ru.'member/manage_jobs/');
	exit;
}



?>