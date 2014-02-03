<?php
include('../connect/connect.php');
include('../connect/functii.php');
foreach ($_POST as $k => $v )
{
	$$k =  addslashes(trim($v ));
} 
unset($_SESSION['get_quote_err']);
$flg = false;
$str = 'Hello';
if(empty($str)){
$_SESSION['get_quote_err']['msg'] = "Please insert the text in message box";
$flg = true;
	//echo "less";exit;
}
$str_arr = explode(' ',$str);
$str_qry = '';
if(count($str_arr)>0){
	foreach($str_arr as $st){
		$st = trim($st);
		if(!empty($st)){
			if(empty($str_qry)){
				$str_qry = " WHERE `word` LIKE '$st'";
			}else{
				$str_qry .= " OR `word` LIKE '$st'";
			}
		}
	}
}
if(strlen($str_qry)>10){
	$sql = "SELECT * FROM `tt_swear_words` ".$str_qry;
	$result = @mysql_query($sql);
	if(mysql_num_rows($result) > 0 ){
	$_SESSION['get_quote_err']['msg'] = "Swearing is not tolerated on TradesTools";
	$flg = true;
		//echo 'swear';exit;
	}
}
//if(strlen($str)<10)
	//echo "less";exit;
	if($flg)
	{
	header('location:'.$ru.'member/customer_msgs/'.$job_id); exit;
	
	}






$qry = "insert into   `tt_messages` set message  = '".$msg."' ,
											 
									    `title`  = 'Message From Customer' , 
										`from`  = '".$from_id."' , 
										`to`  = '".$to_id."' , 
										`jobId`  = '".$job_id."' , 
										`from_viewed`  = '0' , 
										`to_viewed`  = '0' , 
										`from_deleted`  = '0' , 
										`to_deleted`  = '0' , 
										`created`  = NOW() , 
										`message_frm`  = 'Customer' ";

										



$exe_qry = mysql_query($qry);

//+++++++++++++++++++++ this code is used for send the email

 $sql_admin = "select * from tt_user where userId='".$from_id."'"; //exit;
$result_admin  = mysql_query($sql_admin);
$row_admin = mysql_fetch_array($result_admin);
$name  = $row_admin['firstname']." ".$row_admin['lastname'];
$toadmin  = $row_admin['email'];


 $sql_email = "select * from tt_user where userId= '".$to_id."'";// exit;
$result_email  = mysql_query($sql_email);
$row_email = mysql_fetch_array($result_email);
$fname = $row_email['firstname'];
$lname = $row_email['lastname'];

$email  = $row_email['email'];

$qry_email = "select * from  tt_emails where type ='messages'";

		$rs=mysql_query($qry_email);
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
		 
		$message = str_replace('{{Firstname}}' ,$fname, $message);
		$message = str_replace('{{LastName}}' ,$lname , $message);
		$message = str_replace('{{name}}' ,$name , $message);
		//$message = str_replace('{{Email}}' ,$from , $message);
		//$message = str_replace('{{Title}}' ,$title , $message);
		//$message = str_replace('{{Description}}' ,$description , $message);
		
		//$message = str_replace('{{Username}}' , $ru. $profile_name , $message);
		//$activationlink = $ru .'accountactivate/'. base64_encode($userId)."/";
		//$message = str_replace('{{URL}}' ,$activationlink , $message);
		
	//	$message = str_replace('{{Email}}' ,$email , $message);
	//	$message = str_replace('{{Password}}' ,$confirm_password , $message);

		$message = nl2br($message);

		$mailsent = mail($email,$subject,$message,$headers);


//++++++++++++ the end of email code



$_SESSION['key_services_msg'] = 'Message Sent Successfully!';
header('location:'.$ru.'member');
exit;

?>