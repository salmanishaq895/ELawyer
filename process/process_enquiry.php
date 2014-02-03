<?php
include('../connect/connect.php');
include('../connect/functii.php');
foreach ($_POST as $k => $v )
{
	$$k =  addslashes(trim($v ));
} 

$userId = $_SESSION['TTLOGINDATA']['USERID'];
$flgs = false;
if(isset($_POST['SaveEnquiry']))
{



// ____________++++++++++++++++ this validat is used for Description swear word
	$str_title = explode(' ',$title);
				$title_qry = '';
			if(count($str_title)>0){
				foreach($str_title as $st_title){
					//$st_description = trim($st_description);
					if(!empty($st_title)){
					//echo "dfsd"; exit;
						if(empty($title_qry)){
							$title_qry = " WHERE `word` LIKE '$st_title'";
						}else{
							$title_qry .= " OR `word` LIKE '$st_title'";
							//echo $description_qry; exit;
						}
					}
				}
			}
			//if(strlen($str_qry)>5){
				$sql_title = "SELECT * FROM `tt_swear_words` ".$title_qry; // exit;
				$result_title = @mysql_query($sql_title);
				if(mysql_num_rows($result_title) > 0 ){
					//echo 'swear';exit;
					 $_SESSION['review_error']['title'] = 'Swearing is not tolerated on title'; //exit;
					$flgs = true;
				}
//}
	
	
	// __________++++++++++++++++++++ the end of Description swear word
	

	
	if($title=='')
	{
		$_SESSION['review_error']['title'] = 'Please enter Title before submit';
		$flgs = true;
	}
	
	
	
	
// ____________++++++++++++++++ this validat is used for Description swear word
	$str_review = explode(' ',$review);
				$review_qry = '';
			if(count($str_review)>0){
				foreach($str_review as $st_review){
					//$st_description = trim($st_description);
					if(!empty($st_review)){
					//echo "dfsd"; exit;
						if(empty($review_qry)){
							$review_qry = " WHERE `word` LIKE '$st_review'";
						}else{
							$review_qry .= " OR `word` LIKE '$st_review'";
							//echo $description_qry; exit;
						}
					}
				}
			}
			//if(strlen($str_qry)>5){
				$sql_review = "SELECT * FROM `tt_swear_words` ".$review_qry; // exit;
				$result_review = @mysql_query($sql_review);
				if(mysql_num_rows($result_review) > 0 ){
					//echo 'swear';exit;
					 $_SESSION['review_error']['review'] = 'Swearing is not tolerated on review'; //exit;
					$flgs = true;
				}
//}
	
	
	// __________++++++++++++++++++++ the end of Description swear word
	
	
	
	if(strlen($review)<=5)
	{
		$_SESSION['review_error']['review'] = 'Please enter Description before submit';
		$flgs = true;
	}
	if( strtolower($pincode) != strtolower($_SESSION['tt_security_code']))
	{
		$_SESSION['review_error']['pincode'] = 'Please provide valid security code';
		$flgs = true;
	}
	unset($_SESSION['tt_security_code']);
	
	if($flgs){
		header("location:".$ru."inc/enquiry1.php?bId=".$bId);exit;
	}
	 $insert_review ="Insert into  tt_enquiry set 	
		bId ='$bId', userId	= '$userId',title='$title', description = '$review', date_added  = NOW()";// exit;
		$db->query($insert_review);
		echo '<div style=" background-color:#E1E1E1; font-size:18px; padding:66px 0px 191px 95px"> Thanks for your Enquiry! </div>';
		$sql_user_email = "select * from tt_user where userId='$userId'";
		$result_user_email = mysql_query($sql_user_email);
		$row_user_email = mysql_fetch_array($result_user_email);
		//echo "<pre>";
		//print_r($row_user_email);
		//exit;
		
		$from = $row_user_email['email'];
		$fname = $row_user_email['firstname'];
	// echo $fname; exit;
	 	$lname= 	$row_user_email['lastname'];
		$phone  = $row_user_email['phone'];
	
	
		$sql_email ="select * from tt_business where locationid='".$bId."'";
		$result = $db->get_row($sql_email,ARRAY_A);
		 //echo "<pre>"; print_r($result);
		$email = $result['email'];
		
		 $sql_message = "select * from tt_enquiry where userId='".$userId."'";
		 $result_message = $db->get_row($sql_message,ARRAY_A);
		 $title =  stripslashes($result_message['title']);
		 $description  = stripslashes($result_message['description']);
		 
		 //$result_message = mysql_query($sql_message);
		 //$row_message = mysql_fetch_array($result_message);
		 //$msg = $row_message['message'];
		 
		 
		 
		 // +++++++++++++++++++ this code is used for the emial 
		 		$qry = "select * from  tt_emails where type ='send_enquiry'";

		$rs=mysql_query($qry);
		$row =mysql_fetch_array($rs);
		$adminName=$row['adminname'];
		$toadmin=$row['toadmin'];
		//$touser=$row['touser'];
		$subject=$row['subject'];
		$htmlData=$row['body'];
		
		
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From:  <'.$from.'>' . "\r\n";	
		
		/*$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$toadmin.'' . "\r\n";
		$headers .= "Content-type: text/html\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "X-Priority: 1\r\n";
		$headers .= "X-MSMail-Priority: High\r\n";
		*/
		$message = $htmlData;			
		$message = str_replace('{{Firstname}}',$fname , $message);
		$message = str_replace('{{LastName}}',$lname , $message);
		$message = str_replace('{{Phone}}',$phone , $message);
		$message = str_replace('{{Email}}',$from , $message);
		$message = str_replace('{{Title}}',$title , $message);
		$message = str_replace('{{Description}}' ,$description , $message);
		//$message = str_replace('{{Username}}' , $ru. $profile_name , $message);
		//profile/1_Toddler_Sense
		//http://zamsol.net/tradestool/job_particulars/13_Plumbing_dd_d_d_d_d_d_d
		//$activationlink = $ru .'job_particulars/'.$result_message['quotes_id'].'_'.encodeURL(stripslashes($result_message['title']));
		//$joblink = '<a href="'.$activationlink .'">'.$activationlink .'</a>';
		//$message = str_replace('{{JobUrl}}' ,$joblink , $message);
	//	$message = str_replace('{{Email}}' ,$email , $message);
	//	$message = str_replace('{{Password}}' ,$confirm_password , $message);
		$message = nl2br($message);

		$mailsent = mail($email,$subject,$message,$headers);
		 // ++++++++++++++ the end of email code
		exit;

}



if($_GET['action'] == 'delete_message')
{
//echo "mehran"; exit;
	$qry = mysql_query("DELETE FROM  `tt_enquiry` WHERE enquiry_id = '".$_GET['enquiry_id']."'");
	//$row = mysql_fetch_array($qry);
	/*if(!empty($row['img'])){
		@unlink('../media/key-services/' . $userId . '/'.$row['img']);
		@unlink('../media/key-services/' . $userId . '/thumb/'.$row['img']);
	}
	mysql_query("DELETE FROM `tt_business_keyservices` WHERE id = '".$_GET['keyid']."'");
	*/$_SESSION['key_services_msg'] = 'Record deleted successfully!';
	header('location:'.$ru.'member/message/');
	exit;
}



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
?>