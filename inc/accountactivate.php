<?php 
include("common/function.php");
if ( isset ($_GET['page']) and ( trim( $_GET['page']) != '') )
{ 

//echo "<pre>".$_GET; exit;	
	//$_GET['s']='Mjk=';
	$userId = base64_decode($_REQUEST['s']);
	//$userId = 23;
	$qryStr = "SELECT * FROM tt_user WHERE userId = '$userId' " ;
	$rs = mysql_query($qryStr);
	if (mysql_num_rows($rs) > 0 ) 
	{ 
		$row =mysql_fetch_array($rs);
		if ($row['status'] == 'Pending')
		{
			mysql_query( "UPDATE tt_user SET status = 'Active' WHERE userId =$userId" );
			$_SESSION['HTLOGINDATA']['ISLOGIN'] = 'yes';
			$_SESSION['HTLOGINDATA']['EMAIL'] = $row['email'];
			$_SESSION['HTLOGINDATA']['NAME'] = $row['firstname'];
			$_SESSION['HTLOGINDATA']['LNAME'] = $row['lastname'];
			$_SESSION['HTLOGINDATA']['USERID'] = $row['userId'];
			$_SESSION['HTLOGINDATA']['TYPE'] = $row['type'];
			$_SESSION['activatemessage'] = 'Congratulations, your account has been verified!';
			//--___________+++++++++++++++++++++  Wel come email sent  
			$sql_sent = "select * from tt_emails where type='welcome'";
			$result_sent = mysql_query($sql_sent);
			$row_sent = mysql_fetch_array($result_sent);
			
			$adminName=$row_sent['adminname'];
			$toadmin=$row_sent['toadmin'];
			$touser=$row_sent['touser'];
			$subject=$row_sent['subject'];
			$htmlData=$row_sent['body'];
			
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: Tradetool.co.uk <'.$toadmin.'>' . "\r\n";	
			/*	
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: '.$adminName.'' . "\r\n";
			$headers .= "Content-type: text/html\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "X-Priority: 1\r\n";
			$headers .= "X-MSMail-Priority: High\r\n";
			*/
			
			$message = $htmlData;						
			$subject   = str_replace('{{name}}',$_SESSION['HTLOGINDATA']['NAME']." ".$_SESSION['HTLOGINDATA']['LNAME'],$subject);
			$message = str_replace('{{Firstname}}' ,$_SESSION['HTLOGINDATA']['NAME'], $message);
			$message = str_replace('{{Lastname}}' ,$_SESSION['HTLOGINDATA']['LNAME'] , $message);
		
			$email = $_SESSION['HTLOGINDATA']['EMAIL'];
         	$message = nl2br($message);
			//User
			//sendmail($adminName, $email, $_SESSION['HTLOGINDATA']['NAME'], $subject, $message); 
			mail($email,$subject,$message,$headers);
			
			//Admin
			//sendmail($adminName, $toadmin, $_SESSION['HTLOGINDATA']['NAME'], 'New user registered', $message); 
			//mail($toadmin,'New user registerd',$message,$headers);
			//$mailsent = mail($email,$subject,$message,$headers);		
			//$mailsent = mail($toadmin,'New user registered',$message,$headers);
		
			
			//--__________++++++++++++++++++++ end of wel come email
			$res_quote = mysql_query("SELECT * FROM `tt_quotes` WHERE `mail_sent` = 'no' AND `userId` = '".$row['userId']."'");
			if(mysql_num_rows($res_quote)>0){
				$row_quote = mysql_fetch_array($res_quote);
				sendQuoteMail($row_quote['quotes_id']);
			}
		}else{
			$_SESSION['activatemessage'] = 'Congratulations, your account has been verified.';
		}
	}	
}
?>	
<div class="main_quote_bar_b main_quote_bar_c">
  <div class="map_page_right_bar terms_condition_bar">
    <div class="brued_crum_bar brued_crum_bar_c">
      <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Home</a> > <a href="<?php echo $ru;?>accountactivate" style="text-decoration:none; color:#999999;"><span class="change">Account Activation</span></a></span> </div>
    </div>
    <div class="profile_page_left">
      <div class="company_detail_description"> <span class="company_detail_span">Account Activation</span>
        <p class="company_detail_description company_detail_description_p_b"> Congratulations,Your account has been verified.<br /> You can now login to your account and add businesses.</p>
      </div>
    </div>
  </div>
</div>