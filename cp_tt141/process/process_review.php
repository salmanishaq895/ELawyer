<?php 
require_once("../../connect/connect.php");
require_once("../security.php");
require_once ('../inc/functii.php');
//echo '<pre>'; print_r($_REQUEST); exit;
$adminUserId = $_SESSION['cp_cmd']['userId'];
if ( isset ($_GET['action'])  and  ($_GET['action']=='d'))
{
	$reviewId =$_GET['reviewId'];
	$SQL_claim_business_log = "delete from tt_business_reviews where reviewId =$reviewId ";
	$db->query($SQL_claim_business_log);
	$rdir = $ruadmin.'home.php?p=review';
	$_SESSION['msg'] = 'Review deleted !';
	header('location:'.$rdir );exit;
}


// ------------------------------------------- REASON REVIEW DELETE -----------------
if ( isset ($_GET['action'])  and  ($_GET['action']=='S'))
{
	//echo "mehran"; exit;
	$review_error_id =$_GET['review_error_id'];
	$SQL_Reason_Delete = "delete from tt_review_error where review_error_id =$review_error_id ";
	$db->query($SQL_Reason_Delete);
	$rdir = $ruadmin.'home.php?p=report_review';
	$_SESSION['msg'] = 'Review deleted !';
	header('location:'.$rdir );exit;
}

// ------------------------------------------- REVIEW DELETE -----------------
if ( isset ($_GET['action'])  and  ($_GET['action']=='R'))
{
	//echo "mehran"; exit;
$reviewId =$_GET['reviewId'];
	$SQL_Review_Delete = "delete from tt_business_reviews where reviewId =$reviewId ";
	$db->query($SQL_Review_Delete);
	
	$SQL_Reason_Review = "delete from tt_review_error where reviewId =$reviewId";
	$db->query($SQL_Reason_Review);
	
	$rdir = $ruadmin.'home.php?p=report_review';
	$_SESSION['msg'] = 'Review deleted !';
	header('location:'.$rdir );exit;
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
				$headers .= 'From: Car Movers Directory <'.$from.'>' . "\r\n";
		
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
													 	
													createdby 	='$adminUserId',
													
													dated 		=now()";
													
													//type		='$type' , 
													//status		='$status',
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
		$_SESSION['Review_update'][$k]=$v;
	}

	if($_SESSION['cp_cmd']['userId'] == $userId ) $status ='Active';
	$phone = formatPhone($phone);
	$upd_user ="Update tt_business_reviews set 	
	bId  		='$businessId',
	userId		='$userId',
	review  	= '$review', 	
	rating 		='$rating',
	expirtise='$ratinge',
	cost='$rating2',
	schedule='$rating3',
	response='$rating4',
	professional='$rating5', 
	date_added  = ".time()."
	where reviewId =$reviewId ";
	$db->query($upd_user);
	unset($_SESSION['review_update_err']);
	unset($_SESSION['review_update']);
	$_SESSION['review_update_err']['useradded'] = 'Review Updated Successfully!';
	header('location:'.$ruadmin.'home.php?p=review_edit&reviewId='.$reviewId); exit;
}


// ----------------------------------- Add review  ----------------//

if( isset($_POST['SaveReview']))
{
unset($_SESSION['Review_save']);
unset($_SESSION['review_error']);


foreach ($_POST as $k => $v )
	{
		$$k =  addslashes(trim($v ));
		$_SESSION['Review_save'][$k]=$v;
	}
$flgs = false;

if(strlen($review)<=5)
	{
		$_SESSION['review_update_err']['review'] = 'Please enter review before submit';
		$flgs = true;
	}

if($flgs)
{

header('location:'.$ruadmin.'home.php?p=add_review'); 
		exit;

}


$insert_review ="Insert into  tt_business_reviews set 	
		bId ='$reviewId', userId	= '$userId', review = '$review',
		rating ='$rating',expirtise='$ratinge',cost='$rating2',schedule='$rating3',response='$rating4',professional='$rating5', date_added  = ".time()."";
		$db->query($insert_review);
		
$_SESSION['msg'] = 'Review Added Successfully!';
header('location:'.$ruadmin.'home.php?p=review&reviewId='.$reviewId); 
		exit;



}









?>