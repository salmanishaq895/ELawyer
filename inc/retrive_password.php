<?php  
if ($_SESSION['HTLOGINDATA']['ISLOGIN'] ) 
{
	header("location:".$ru."member");exit;
}
if($_POST['getpassword'])
{
	$email =  addslashes($_POST['loginEmail']);
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$res_password = mysql_query("select * from tt_user where email = '".$email."' ");
		if(mysql_num_rows($res_password) > 0)
		{
			$row_user = mysql_fetch_array($res_password);
			if ( $row_user['status'] == 'Pending' or  $row_user['status'] == 'Active' )
			{
				$possible = '23456789bcdfghjkmnpqrstvwxyz'; 
				$characters =7;
				$code = '';
				$i = 0;
				while ($i < $characters) { 
					$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
					$i++;
				}
				
				$password  = md5($code);
				$userId =$row_user['userId'];
				
				$QryStr ="update tt_user set password = '$password' where `userId` = $userId ";
				mysql_query($QryStr)or die (mysql_error());
			
				if($row_user['status'] == 'Pending' )
				{
					 $qry="select * from  tt_emails where type ='signup'";
					$_SESSION["passwordrest"]["msg"] = 'Activtion link sent on provided email';
				}else{
					$qry="select * from  tt_emails where type ='forgotpassword'";
					$_SESSION["passwordrest"]["msg"] = 'Account settings are sent at your email. Please check your email and follow the instruction.';
				}
				$rs	 = mysql_query($qry);
				$row = mysql_fetch_array($rs);
				$adminName=$row['adminname'];
				$toadmin=$row['toadmin'];
				$touser=$row['touser'];
				$subject=$row['subject'];
				$htmlData=$row['body'];
				
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: '.$adminName.' <'.$touser.'>' . "\r\n";
				$headers .= "Content-type: text/html\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "X-Priority: 1\r\n";
				$headers .= "X-MSMail-Priority: High\r\n";
			
				$message = $htmlData;			
				 
				$message = str_replace('{{Firstname}}' ,$row_user['firstname'] , $message);
				$message = str_replace('{{LastName}}' , $row_user['lastname']  , $message);
				
				$message = str_replace('{{Email}}' , $row_user['email'] , $message);
				$activationlink = $ru .'accountactivate.php?q='. base64_encode($userId);
				$message = str_replace('{{ActivationLink}}' ,$activationlink , $message);
				
				$message = str_replace('{{Email}}' , $email , $message);
				$message = str_replace('{{Password}}' ,$code , $message);
		
				$message = nl2br($message);
				$mailsent = mail($email,$subject,$message,$headers);
			}
		}else{
			$_SESSION["passwordrest"]["msg"] = 'No record found for provided email!';
		}
	}else{
		$_SESSION["passwordrest"]["msg"] = 'Please enter a valid email address!';
	}
	header("location:".$ru."retrive_password");exit;
}
?>
<div class="main_quote_bar_b">
	<div class="map_page_right_bar" style="width:auto;">
	  <div class="brued_crum_bar brued_crum_bar_c">
		<div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Home</a> >  <a href="<?php echo $ru;?>retrive_password" style="text-decoration:none; color:#999999;"> <span class="change">Retrieve Password</span> </a></span> </div>
	  </div>
	  <div class="profile_page_left">
      <form method="post" action="">
        <div class="company_detail_description"> <span class="company_detail_span">Retrieve Password</span>
            <div align="left" style="margin-top: 20px; font-family:Arial, Helvetica, sans-serif; padding-left:120px; float:left;"> Please provide your email below to reset your password. or <a href="<?php echo $ru; ?>signup" style="color:#7B0099;">Signup</a> </div>
            <?php 
			if(isset($_SESSION["passwordrest"]["msg"]))
			{
			?>
            <div class="message" style="padding-left:165px; font-weight:bold; color:#FF0000; margin-top:10px;"> <?php echo $_SESSION["passwordrest"]["msg"]; unset($_SESSION["passwordrest"]); ?> </div>
            <?php 
			}
			?>
			<div class="input_flied">
			  <div>Email <samp>* </samp></div>
              <input type="text" class="txt_box" name="loginEmail" id="loginEmail"  size="40" value=""/>
            </div>
            <input type="hidden" name="getpassword" value="yes" />
            <div class="captacha_bar">
				<div class="contact_us_send_botton_outer contact_us_send_botton_outer_b">
				  <div class="contact_us_gray_botton_inner">
              		<input type="submit" name="signUpButton" id="signUpButton" value="Submit &raquo;" class="inner_gray_botton"/>
				</div>
            	</div>
			</div>
			<div style="width:300px; float:left; margin:20px 0 20px 120px;" > <a href="<?php echo $ru."signin"; ?>" class="txt" style="color:#7B0099; font-family:Arial, Helvetica, sans-serif;" >Back To Login</a> </div>
          </div>
      </form>
	  </div>
    </div>
   <?php //include("common/page-left.php"); ?>
</div>
<?php 
unset($_SESSION['user_con_err']);
unset($_SESSION['contact']);
?>
