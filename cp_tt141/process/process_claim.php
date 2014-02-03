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
	//echo '<pre>'; print_r($_REQUEST); exit;		
	$locationid  =$_GET['bId'];
	$rdir = 'home.php?p=business_claim';
	
	
	//------------------ Reject email -----------
function sendmail($from,$to,$toname,$subject,$msg){

		$msg = nl2br($msg);
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'To: ' . $toname . ' <' . $to . '>' . "\r\n";
		$headers .= 'From: TradesTool <'.$from.'>' . "\r\n";

		mail($to, $subject, $msg, $headers);
		unset($headers); 

}
		$SQL_act = "SELECT 
					  tt_business_claim.dated,
					  tt_business_claim.`status`,
					  tt_business_claim.Id,
					  tt_user.firstname,
					  tt_user.lastname,
					  tt_user.email,
					  tt_user.userId,
					  tt_user.phone,
					  tt_user.city,
					  tt_user.state,
					  tt_business.locationid,
					  tt_business.name
					FROM
					  tt_business_claim
					  INNER JOIN tt_business ON (tt_business_claim.bid = tt_business.locationid)
					  INNER JOIN tt_user ON (tt_business_claim.userId = tt_user.userId)
					where tt_business.locationid= $locationid
					ORDER BY
					  tt_business_claim.Id  ";
		
		$rs_row		= $db->get_row($SQL_act, ARRAY_A);
		//echo '<br>'.print_r($rs_row);exit;
		$userId = $rs_row['userId'];
		$locationid = $rs_row['locationid'];
		$SQL_claim_business = "update tt_business_claim set status =2, claim_expiry=Now()  where userId =$userId ";
		$db->query($SQL_claim_business);
		
		$SQL_claim_business_user = "update tt_business set updated = Now(), claim_flag ='plus_icon.png', userId =0, ltype=0 where locationid =$locationid ";		
		$db->query($SQL_claim_business_user);
		
		$start_date	= mktime(date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y"));
		$start_date	= date("Y-m-d H:i:s",$start_date);
		
		$end_date	= mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+7, date("Y"));
		$end_date	= date("Y-m-d H:i:s",$end_date);
		
		//$SQL_claim_log = "update tt_business_claim_log set userId =$userId, bid =$bid, activity =2, claim_status=0, start_date ='0', end_date ='0', flag ='plus' where userId =$userId ";	
		$activity =$ClaimActivityLog[3];	
		$SQL_claim_log = "insert into tt_business_claim_log set userId =$userId, bid =$locationid, activity ='".$activity."', claim_status=1, start_date ='".$start_date."', end_date ='".$end_date."', flag ='plus_icon.png'  ";	
		$db->query($SQL_claim_log);
		
		$email = $rs_row['email']; 
		$firstname = $rs_row['firstname'];
		$lastname = $rs_row['lastname']; 
		$businessname = $rs_row['name'];
       	$qryemail = "SELECT * FROM tt_emails WHERE type  = 'rejectcalim'";
		$rsemailtemp = $db->get_row($qryemail,ARRAY_A);	
		$subject = $rsemailtemp['subject']; 
		$from= $rsemailtemp['touser']; 
		$msg = $rsemailtemp['body'];
		$msg  = str_replace("{{FirstName}}",$firstname,$msg);
		$msg  = str_replace("{{LastName}}",$lastname,$msg);
		$msg  = str_replace("{{BusinessName}}",$businessname,$msg);
		

		sendmail($from,$email,$username,$subject,$msg);
		sendmail($from,'rana@zamsol.com',$username,$subject,$msg);
		$_SESSION['msg'] = 'Email send to user!';
		header('location:'.$ruadmin.'home.php?p=business_claim'); exit;	


	
/*	if( $biz =mysql_query($biz_Sql) ){
		$sql33 = "DELETE FROM business_reviews where locationid = '".$locationid."'";
		mysql_query($sql33);
	
		$_SESSION['msg'] = 'Business deleted !';
		$ruadmins = $_SERVER['HTTP_REFERER'];
		header('location:'.$ruadmins.'home.php?p=business_claim'); exit;				
	
	} */
	//header('location:'.$ruadmin.'home.php?p=business'); exit;
	header('location:'.$rdir );exit;
}

//print_r($_REQUEST); exit;
if ( isset ($_GET['action'])  and  ($_GET['action']=='r'))
{
			
	$locationid  =$_GET['bId'];
	$rdir = 'home.php?p=business_claim';
	
	
	//------------------ Accept email -----------
function sendmail($from,$to,$toname,$subject,$msg){

		$msg = nl2br($msg);
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'To: ' . $toname . ' <' . $to . '>' . "\r\n";
		$headers .= 'From: TradesTool <'.$from.'>' . "\r\n";

		mail($to, $subject, $msg, $headers);
		unset($headers); 

}
		$SQL_act = "SELECT 
					  tt_business_claim.dated,
					  tt_business_claim.`status`,
					  tt_business_claim.Id,
					  tt_user.userId,
					  tt_user.firstname,
					  tt_user.lastname,
					  tt_user.email,
					  tt_user.phone,
					  tt_user.city,
					  tt_user.state,
					  tt_business.locationid,
					  tt_business.name
					FROM
					  tt_business_claim
					  INNER JOIN tt_business ON (tt_business_claim.bid = tt_business.locationid)
					  INNER JOIN tt_user ON (tt_business_claim.userId = tt_user.userId)
					where tt_business.locationid= $locationid
					ORDER BY
					  tt_business_claim.Id  ";
		
		$rs_row		= $db->get_row($SQL_act, ARRAY_A);
		//echo '<pre>'; print_r($rs_row); exit;
		$locationid = $rs_row['locationid']; 
		$userId = $rs_row['userId'];
		$claim_accept	= mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+6, date("Y"));
		$claim_accept	= date("Y-m-d H:i:s",$claim_accept);
		$SQL_claim_business = "update tt_business_claim set status =1,claim_accept ='$claim_accept', claim_expiry=Now()  where userId =$userId ";		
		$db->query($SQL_claim_business);
		
		$SQL_claim_business_user = "update tt_business set updated = Now(), claim_flag ='pr_icon.png', userId =$userId where locationid =$locationid ";		
		$db->query($SQL_claim_business_user);
		
		$start_date	= mktime(date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y"));
		$start_date	= date("Y-m-d H:i:s",$start_date);
		
		$end_date	= mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+7, date("Y"));
		$end_date	= date("Y-m-d H:i:s",$end_date);
		
		//$SQL_claim_log = "update tt_business_claim_log set userId =$userId, bid =$locationid, activity =3, claim_status=1, start_date ='".$start_date."', end_date ='".$end_date."', flag ='PR' where userId =$userId ";	

		$activity =$ClaimActivityLog[4];	
		$SQL_claim_log = "insert into tt_business_claim_log set userId =$userId, bid =$locationid, activity ='".$activity."', claim_status=1, start_date ='".$start_date."', end_date ='".$end_date."', flag ='cp_icon.png'  ";	
		
		$db->query($SQL_claim_log);
		
		//echo '<br>'.print_r($rs_row);exit;
		$email = $rs_row['email']; 
		$firstname = $rs_row['firstname'];
		$lastname = $rs_row['lastname'];
		$businessname = $rs_row['name']; 
		$url =$ru.'company/'.$locationid.'/'.$businessname;
		$url = '<a href="'.$url.'">'.$url.'</a>';
       	$qryemail = "SELECT * FROM tt_emails WHERE type  = 'acceptcalim'";
		$rsemailtemp = $db->get_row($qryemail,ARRAY_A);	
		$subject = $rsemailtemp['subject'];
		$subject  = str_replace("{{BusinessName}}",$businessname,$subject); 
		$from= $rsemailtemp['touser']; 
		$msg = $rsemailtemp['body'];
		$msg  = str_replace("{{FirstName}}",$firstname,$msg);
		$msg  = str_replace("{{LastName}}",$lastname,$msg);
		$msg  = str_replace("{{BusinessName}}",$businessname,$msg);
		$msg  = str_replace("{{BusinessProfileURL}}",$url,$msg);

		sendmail($from,$email,$username,$subject,$msg);
		sendmail($from,'rana@zamsol.com',$username,$subject,$msg);
		$_SESSION['msg'] = 'Email send to user!';
		header('location:'.$ruadmin.'home.php?p=business_claim'); exit;	


	
/*	if( $biz =mysql_query($biz_Sql) ){
		$sql33 = "DELETE FROM business_reviews where locationid = '".$locationid."'";
		mysql_query($sql33);
	
		$_SESSION['msg'] = 'Business deleted !';
		$ruadmins = $_SERVER['HTTP_REFERER'];
		header('location:'.$ruadmins.'home.php?p=business_claim'); exit;				
	
	} */
	//header('location:'.$ruadmin.'home.php?p=business'); exit;
	header('location:'.$rdir );exit;
}

?>