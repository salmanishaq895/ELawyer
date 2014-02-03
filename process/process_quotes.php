<?php
include('../connect/connect.php');
require_once('../common/function.php');
include("../upload.php");
include("../securimage/securimage.php");
if(isset($_POST['register_interest'])){
	
	
	unset($_SESSION['register_interest_err']);
	unset($_SESSION['register_interest']);
	foreach ($_POST as $k => $v ){
		$$k =  trim($v);
		$_SESSION['register_interest'][$k]=$v;
	}
	$flg = false;
	if( checkSwear($comments) ){
		$_SESSION['register_interest_err']['comments'] = 'Swearing is not tolerated on comments';
		$flgs = true;
	}
	if( strlen($comments)<30 ){
		$_SESSION['register_interest_err']['comments'] = 'Please provide some comments (at least 30 characters) to show the user you are interested.';
		$flgs = true;
	}
	if(strlen($comments)>400 ){
		$_SESSION['register_interest_err']['comments'] = 'Please provide minimum to 400 charecter';
		$flgs = true;
	}
	
	if( !isset($quote_terms) ){
		$_SESSION['register_interest_err']['quote_terms'] = 'You must agree to the terms and conditions of using the TradesTool quote request system';
		$flgs = true;
	}
	if($flgs){
		header("location:".$ru."job_particulars/" . $jobId . '_' . $jobtitle);exit;
	}else{
	
	$qry_five = "select * from  tt_find_trade where tradUid ='".$_SESSION['TTLOGINDATA']['USERID']."' ";//exit;
	$result_five = mysql_query($qry_five);
	$row_five = mysql_num_rows($result_five);
	//echo $row_five; exit;
	if($row_five<=4){
		
		include("../common/messages.php");
		$pm = new cpm($_SESSION['TTLOGINDATA']['USERID']);
		$res_quote = mysql_query("SELECT * FROM `tt_quotes` WHERE `quotes_id` = '$jobId'");
		$row_quote = mysql_fetch_array($res_quote);
	$sql_find_job  = "insert into tt_find_trade set tradUid='".$_SESSION['TTLOGINDATA']['USERID']."',jobId ='".$jobId."',added ='".time()."' ";  
		mysql_query($sql_find_job);
	
		
		if($pm->sendmessage($row_quote['userId'],$jobId,"Trader responsed on - " . $row_quote['title'],$comments,0)) {
            // Tell the user it was successful
			$_SESSION['response_msg'] = 'Your response submited successfully!';
        } else {
            // Tell user something went wrong it the return was false
			$_SESSION['response_msg'] = 'Error, couldn\'t send your response.';
        }
		//mysql_query("INSERT INTO `tt_find_trade` SET `tradUid` = '" . $_SESSION['TTLOGINDATA']['USERID'] . "', `jobId` = '" . $jobId . "', `added` = '" . time() . "'");
		unset($_SESSION['register_interest_err']);
		unset($_SESSION['register_interest']);
		
		header("location:".$ru."member/applied_job");exit;
		}else{
		$_SESSION['response_msg'] = 'Error, You post Max 5 jobs.';
	header("location:".$ru."job_particulars");exit;
	}
	}
	
	
	
}

if ( isset ($_POST['submit_quote'])){
	
	
	unset($_SESSION['get_quote_err']);
	unset($_SESSION['get_quote']);
	foreach ($_POST as $k => $v ){
		$$k =  addslashes(trim($v));
		$_SESSION['get_quote'][$k]=addslashes($v);
	}
	$flg = false;
	if( $txt_keyword == "e.g builder, plumber, electrician, etc" or $txt_keyword == '' ){
		$_SESSION['get_quote_err']['txt_keyword'] = true;
		$flg = true;
	}else {
		$_SESSION['get_quote']['txt_keyword'] = $txt_keyword;
	}
	
	if($txt_location == '' or $txt_location == 'e.g city or postcode'){
		$_SESSION['get_quote_err']['txt_location'] = true;
		$flg = true;
	}else{
		$_SESSION['get_quote']['txt_location'] = $txt_location;
	}
	
	if($flg){
		header("location:".$ru);exit;
	}else{
		header('location:' . $ru . 'quotes/');exit;
	}
}

if( isset($_POST['submit_quote_2']) ){
  	
	
	unset($_SESSION['get_quote_err']);
	//unset($_SESSION['get_quote']);
	unset($_SESSION['quote_save_data']);
	unset($_SESSION['msg']);
	
	foreach ($_POST as $k => $v ){
		$$k =  addslashes(trim($v));
		$_SESSION['get_quote'][$k]=$v; 
	}
	$flg = false;
	

	if(checkSwear($txt_keyword))
	{
	$_SESSION['get_quote_err']['txt_keyword'] = 'Swearing is not tolerated on TradesTools';
					$flg = true;
	}
	
	
	if($txt_location=='')
	{
	$_SESSION['get_quote_err']['txt_location'] = 'Please Insert the Jop Location';
					$flg = true;
	}
	
	
	
	if(checkSwear($txt_location))
	{
	$_SESSION['get_quote_err']['txt_location'] = 'Swearing is not tolerated on TradesTools';
					$flg = true;
	}
	
	
	
	
	if(checkSwear($postcode))
	{
	$_SESSION['get_quote_err']['postcode'] = 'Swearing is not tolerated on TradesTools';
					$flg = true;
	}
	
	
	
	
	if(checkSwear($title))
	{
	$_SESSION['get_quote_err']['title'] = 'Swearing is not tolerated on TradesTools';
					$flg = true;
	}
		
	//  _____________________________ the end of swear title word code
	if( strlen($_POST['title'])<10 ){
		$_SESSION['get_quote_err']['title'] = 'Must be at least 10 characters long';
		$flg = true;
	}
	if( $txt_keyword == "e.g builder, plumber, electrician, etc" or $txt_keyword == '' ){
		$_SESSION['get_quote_err']['txt_keyword'] = 'Please provide your name?';
		$flg = true;
	}
	if(!$txt_location){
			$_SESSION['get_quote_err']['txt_location'] = $_ERR['register']['email'];
			$flgs = true;
		}
	
	if( strlen($_POST['phone'])<5 ){
		$_SESSION['get_quote_err']['phone'] = 'Please enter phone number to proceed';
		$flg = true;
	}
	
	
	
	if($_POST['within']=='SPECIFIC' and $_POST['ondate']=='' ){
		$_SESSION['get_quote_err']['ondate'] = 'Please enter date';
		$flg = true;
	}
	
	
	
			
			if(checkSwear($message))
				{
				$_SESSION['get_quote_err']['message'] = 'Swearing is not tolerated on TradesTools';
								$flg = true;
				}
			
			
		
				//echo "less";exit;
	
	//  ____________________________ the end of description swear word code
	if($_POST['message']==''){
		$_SESSION['get_quote_err']['message'] = 'Must be at least 30 words long and less than 400 words';
		$flg = true;
	}
	if($_FILES['attachment']['name']==''){
		$_SESSION['get_quote_err']['attachment'] = 'Please upload FIR';
		$flg = true;
	}
	
	/*	$securimage = new Securimage();		
      if ($securimage->check($pincode) != true) {
        $_SESSION['get_quote_err']['pincode'] = 'Incorrect security code entered<br />';
		$flg = true;
	 }*/
	
	/*$sql_quotes  = "insert into tt_quotes set keyword='$txt_keyword',zip='$zip',Message='$Message',title='$title',within='$within'";
	mysql_query($sql_quotes) or die(mysql_error());
	$userId = mysql_insert_id();
	$_SESSION['userId']= $userId;*/	
	//echo $flg;exit;
	
	if($flg){
		
		header('location:'.$ru.'quotes.php'); exit;
	}else{
		
		
		$ins_user ="insert into tt_quotes set 	keyword 	='$txt_keyword',	
													email	='$txt_location',
													address 	= '$title',	
													phone		='$phone', 
													message		='$message', 
													contact_method		='$contact_method'";
			
			
			//echo $ins_user;exit;
			$db->query($ins_user);
			$bizId = mysql_insert_id();	
			if ( isset($_FILES['attachment']['tmp_name'])) 
				{ echo $_FILES['attachment']['tmp_name'];
		

			@mkdir ($rootpath.'media/quotes/' .$bizId.'/' ,0777) ;
			
			@mkdir (ABSPATH.'media/quotes/' .$bizId.'/photo/' , 0777);
			@mkdir (ABSPATH.'media/quotes/' .$bizId.'/photo/thumb/', 0777);
		//echo $userId;exit;
			$upload_dir = ABSPATH.'media/quotes/' .$bizId.'/photo/';
			
			
			$logo ='';			
			@chmod($upload_dir,0777);	
			@chmod($thutt_folder,0777);	
			$ext= array ('gif','jpg','jpeg','png','bmp','pdf','doc','docx','xls','xlsx','txt');		
			$companylogo = "attachment"; 
		
			$file_type=$_FILES[$companylogo]['type'];   			
			if(!empty($_FILES[$companylogo]['name']))
			{
				$upload = new upload($companylogo, $upload_dir, '777', $ext);
				if ($upload->message =="SUCCESS_FILE_SAVED_SUCCESSFULLY" )
				{
					$logo=$upload->filename;					
					require_once(ABSPATH.'phpThumb/phpthumb.class.php');
					$phpThumb = new phpThumb();
					$thumbnail_width = 120;
					$phpThumb->setSourceFilename($upload_dir.$logo);
					$output_filename = $thutt_folder.$logo;
					
					// set parameters (see "URL Parameters" in phpthumb.readme.txt)
					$phpThumb->setParameter('w', $thumbnail_width);
					
					// generate & output thumbnail
					if ($phpThumb->GenerateThumbnail()) { // this line is VERY important, do not remove it!
					if ($phpThumb->RenderToFile($output_filename)) {
						// do something on success
						//echo 'Successfully rendered to "'.$output_filename.'"';
					} 
					} 
					$insQry ="update  tt_quotes set 	file_attechmen ='$logo' where quotes_id	= $bizId";	
					//echo $insQry;exit;
					mysql_query($insQry)or die (mysql_error());
					
					}else{
					$_SESSION["biz_regg"]["logo"] = "Error: Upload an Image file.";
					}	
			}
		}	
			unset($_SESSION['get_quote_err']);
			unset($_SESSION['get_quote']);
			$_SESSION['msg'] = 'Case Added Successfully!';
		header('location:'.$ru.'quotes.php'); exit;
		
		
	}
}		



	

?>