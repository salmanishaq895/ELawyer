<?php 
require_once("../connect/connect.php");
require_once("../common/security.php");
require_once ('../connect/functii.php');
include ("../upload.php");

unset($_SESSION['biz_reg_err']);
unset($_SESSION['biz_reg']);
$userId = $_SESSION['TTLOGINDATA']['USERID'];
if($_GET['action'] == 'updateImgTitle'){
	$sqlquery	= "SELECT `locationid` FROM `tt_business` WHERE userId = '$userId'";
	$resquery	= mysql_query($sqlquery);
	$rowquery	= mysql_fetch_array($resquery);
	$img_query	= "UPDATE `tt_business_photo` SET `title` = '" . stripslashes($_GET['title']) . "' WHERE `id` = '".$_GET['imgid']."' AND `bId` = '".$rowquery['locationid']."'";
	mysql_query($img_query);
}
if(isset($_GET['delimid']))
{
	$sqlquery	= "SELECT `locationid` FROM `tt_business` WHERE userId = '$userId'";
	$resquery	= mysql_query($sqlquery);
	$rowquery	= mysql_fetch_array($resquery);
	
	$img_query	= "SELECT * FROM `tt_business_photo` WHERE `id` = '".$_GET['delimid']."' AND `bId` = '".$rowquery['locationid']."'";
	$img_res	= mysql_query($img_query);
	$img_row	= mysql_fetch_array($img_res);
	
	$target_path = "../media/bussPics/".$rowquery['locationid'].'/';
	if( file_exists($target_path.$img_row['name']) ) { 
		chmod($target_path.$img_row['name'], 0777);
		@unlink($target_path.$img_row['name']);
		@unlink($target_path."thumbs/".$img_row['name']);
	}
	$sqlquery22	= "DELETE FROM `tt_business_photo` WHERE `id` = '".$_GET['delimid']."'";
	$db->query($sqlquery22);
	$_SESSION['imager_uploade_msg'] = 'Image deleted successfully!';
	updatePhotoCount($rowquery['locationid']);
	header("location:".$ru."member/trader-images");
	exit;
}

if(isset($_POST['addKeySkill'])){
	unset($_SESSION['key_services']);
	unset($_SESSION['key_services_err']);
	unset($_SESSION['key_services_msg']);
	foreach ($_POST as $k => $v ){
		$$k =  addslashes($v);
		$_SESSION['key_services'][$k] = addslashes($v);
	}
  	$flgs = false;
	
	// ____________++++++++++++++++ this validat is used for Title swear word
	$title = wordLimit_keytitle($title);
	if( checkSwear($title) ){
		$_SESSION['key_services_err']['title'] = 'Swearing is not tolerated on title'; //exit;
		$flgs = true;
	}
	// __________++++++++++++++++++++ the end of Title swear word
	if($title==''){
		$_SESSION['key_services_err']['title'] = 'Please enter valid service name';
		$flgs = true;
	}
	$shortdescription = nl2br($shortdescription);
	$shortdescription = wordLimit_keyservices($shortdescription);
	if( checkSwear($shortdescription) ){
		$_SESSION['key_services_err']['shortdescription'] = 'Swearing is not tolerated on Description'; //exit;
		$flgs = true;
	}
	
	// __________++++++++++++++++++++ the end of Description swear word
	if($shortdescription==''){
		$_SESSION['key_services_err']['shortdescription'] = 'Please enter description';
		$flgs = true;
	}
	if(isset($keyId))
		$keyId = (int)$keyId;
	if($flgs){
		header('location:'.$ru.'member/key-services/'.$keyId);
		exit;
	}else{
		$qry = " `tt_business_keyservices` SET `title` = '$title', `shortdescription` = '$shortdescription' ";
		if(isset($keyId) and $keyId>0){
			$qry = "UPDATE $qry WHERE `id` = '$keyId'";
			mysql_query($qry);
			$_SESSION['key_services_msg'] = "Key service updated successfully!";
		}else{
			$qry = "INSERT INTO $qry ,`userId` = '$userId'";
			mysql_query($qry);
			$keyId = mysql_insert_id();
			$_SESSION['key_services_msg'] = "Key service added successfully!";
		}
		$companylogo = "img"; 
		if( isset($_FILES[$companylogo]['tmp_name']) ){
			@mkdir ('../media/key-services/' . $userId . '/' ,0777) ;
			@mkdir ('../media/key-services/' . $userId . '/thumb/' , 0777);
			$upload_dir = '../media/key-services/' . $userId . '/';
			$thutt_folder = '../media/key-services/' . $userId . '/thumb/';
			$logo ='';			
			@chmod($upload_dir,0777);
			@chmod($thutt_folder,0777);
			$ext= array ('gif','jpg','jpeg','png','bmp');			
			$file_type=$_FILES[$companylogo]['type'];   			
			if(!empty($_FILES[$companylogo]['name'])){
				$upload = new upload($companylogo, $upload_dir, '777', $ext);
				if ($upload->message =="SUCCESS_FILE_SAVED_SUCCESSFULLY" ){
					$logo=$upload->filename;					
					require_once('../phpThumb/phpthumb.class.php');
					$phpThumb = new phpThumb();
					$thumbnail_width = 57;
					$phpThumb->setSourceFilename($upload_dir.$logo);
					$output_filename = $thutt_folder.$logo;
					$phpThumb->setParameter('w', $thumbnail_width);
					if ($phpThumb->GenerateThumbnail()) { // this line is VERY important, do not remove it!
						if ($phpThumb->RenderToFile($output_filename)) {}
					}
					$insQry ="UPDATE `tt_business_keyservices` SET `img` ='$logo' WHERE `id` = '$keyId'";	
					mysql_query($insQry)or die (mysql_error());
				}else{
					$_SESSION["key_services_err"]["img"] = "Error: Upload an Image file.";
				}	
			}
		}
		unset($_SESSION['key_services']);
		header('location:'.$ru.'member/key-services/');
		exit;
	}
}


if(isset($_POST['addSkill'])){
	unset($_SESSION['skill']);
	unset($_SESSION['skill_err']);
	unset($_SESSION['skill_msg']);
	foreach ($_POST as $k => $v ){
		$$k =  addslashes($v);
		$_SESSION['skill'][$k] = addslashes($v);
	}
  	$flgs = false;
	$shortdescription = wordLimitskill($shortdescription);
	$shortdescription = nl2br($shortdescription);
	
	if( checkSwear($shortdescription) ){
		$_SESSION['skill_err']['shortdescription'] = 'Swearing is not tolerated on Description'; //exit;
		$flgs = true;
	}
	// __________++++++++++++++++++++ the end of Description swear word
	
	if($shortdescription==''){
		$_SESSION['skill_err']['shortdescription'] = 'Please enter description';
		$flgs = true;
	}
	if(isset($keyId))
		$keyId = (int)$keyId;
	if($flgs){
		header('location:'.$ru.'member/skills/'.$keyId);
		exit;
	}else{
		$qry = " `tt_business_skills` SET `shortdescription` = '$shortdescription', `skill_level` = '$skill_level' ";
		if(isset($keyId) and $keyId>0){
			$qry = "UPDATE $qry WHERE `id` = '$keyId'";
			mysql_query($qry);
			$_SESSION['skill_msg'] = "Skill updated successfully!";
		}else{
			$qry = "INSERT INTO $qry, `userId` = '$userId'";
			mysql_query($qry);
			$keyId = mysql_insert_id();
			$_SESSION['skill_msg'] = "Skill added successfully!";
		}
		unset($_SESSION['skill']);
		header('location:'.$ru.'member/skills/');
		exit;
	}
}

if(isset($_POST['addQualification'])){
	unset($_SESSION['qualification']);
	unset($_SESSION['qualification_err']);
	unset($_SESSION['qualification_msg']);
	foreach ($_POST as $k => $v ){
		$$k =  addslashes($v);
		$_SESSION['qualification'][$k] = addslashes($v);
	}
  	$flgs = false;
	$title  = wordLimitqualificationtitle($title);
	if( checkSwear($title) ){
		$_SESSION['qualification_err']['title'] = 'Swearing is not tolerated on title'; //exit;
		$flgs = true;
	}
	// __________++++++++++++++++++++ the end of Title swear word
	if($title==''){
		$_SESSION['qualification_err']['title'] = 'Please enter valid title';
		$flgs = true;
	}
	$shortdescription= 	wordLimit_keyservices(	$shortdescription);
	$shortdescription = nl2br($shortdescription);
	
	if( checkSwear($shortdescription) ){
		$_SESSION['qualification_err']['shortdescription'] = 'Swearing is not tolerated on Description'; //exit;
		$flgs = true;
	}
	
	if($shortdescription==''){
		$_SESSION['qualification_err']['shortdescription'] = 'Please enter description';
		$flgs = true;
	}
	if(isset($keyId))
		$keyId = (int)$keyId;
	if($flgs){
		header('location:'.$ru.'member/qualifications/'.$keyId);
		exit;
	}else{
		$qry = " `tt_business_qualification` SET `title` = '$title', `shortdescription` = '$shortdescription' ";
		if(isset($keyId) and $keyId>0){
			$qry = "UPDATE $qry WHERE `id` = '$keyId'";
			mysql_query($qry);
			$_SESSION['qualification_msg'] = "Qualification updated successfully!";
		}else{
			$qry = "INSERT INTO $qry ,`userId` = '$userId'";
			mysql_query($qry);
			$keyId = mysql_insert_id();
			$_SESSION['qualification_msg'] = "Qualification added successfully!";
		}
		$companylogo = "img"; 
		if( isset($_FILES[$companylogo]['tmp_name']) ){
			@mkdir ('../media/qualification/' . $userId . '/' ,0777) ;
			@mkdir ('../media/qualification/' . $userId . '/thumb/' , 0777);
			$upload_dir = '../media/qualification/' . $userId . '/';
			$thutt_folder = '../media/qualification/' . $userId . '/thumb/';
			$logo ='';			
			@chmod($upload_dir,0777);
			@chmod($thutt_folder,0777);
			//$ext= array ('gif','jpg','jpeg','png','bmp');			
			$ext= array ('gif','jpg','jpeg','png','bmp','pdf','doc','docx','xls','xlsx','txt');
			$file_type=$_FILES[$companylogo]['type'];   			
			if(!empty($_FILES[$companylogo]['name'])){
				$upload = new upload($companylogo, $upload_dir, '777', $ext);
				
				
				if ($upload->message =="SUCCESS_FILE_SAVED_SUCCESSFULLY" ){
					$logo=$upload->filename;
					//echo $logo; exit;
					$filename = strtolower($logo) ; 
					$exts = split("[/\\.]", $filename);
					$n = count($exts)-1;
					//echo $n;// exit;
					$exts = $exts[$n];
					//echo $exts; exit;
					if(in_array($exts,array('gif','jpg','jpeg','png','bmp'))){
						require_once('../phpThumb/phpthumb.class.php');
						$phpThumb = new phpThumb();
						$thumbnail_width = 57;
						$phpThumb->setSourceFilename($upload_dir.$logo);
						$output_filename = $thutt_folder.$logo;
						$phpThumb->setParameter('w', $thumbnail_width);
						if ($phpThumb->GenerateThumbnail()) { // this line is VERY important, do not remove it!
							if ($phpThumb->RenderToFile($output_filename)) {}
						}
					}
					 $insQry ="UPDATE `tt_business_qualification` SET `img` ='$logo' WHERE `id` = '$keyId'";
					mysql_query($insQry)or die (mysql_error());
				}else{
					$_SESSION["qualification_err"]["img"] = "Error: Upload an Image file.";
				}
			}
		}
		unset($_SESSION['qualification']);
		header('location:'.$ru.'member/qualifications/');
		exit;
	}
}
if($_GET['action'] == 'dlt_service')
{
	$qry = mysql_query("SELECT * FROM `tt_business_keyservices` WHERE id = '".$_GET['keyid']."'");
	$row = mysql_fetch_array($qry);
	if(!empty($row['img'])){
		@unlink('../media/key-services/' . $userId . '/'.$row['img']);
		@unlink('../media/key-services/' . $userId . '/thumb/'.$row['img']);
	}
	mysql_query("DELETE FROM `tt_business_keyservices` WHERE id = '".$_GET['keyid']."'");
	$_SESSION['key_services_msg'] = 'Record deleted successfully!';
	header('location:'.$ru.'member/key-services/');
	exit;
}

if($_GET['action'] == 'dlt_skill')
{
	mysql_query("DELETE FROM `tt_business_skills` WHERE id = '".$_GET['keyid']."'");
	$_SESSION['skill_msg'] = 'Record deleted successfully!';
	header('location:'.$ru.'member/skills/');
	exit;
}
if($_GET['action'] == 'dlt_qualification')
{
	$qry = mysql_query("SELECT * FROM `tt_business_qualification` WHERE id = '".$_GET['keyid']."'");
	$row = mysql_fetch_array($qry);
	if(!empty($row['img'])){
		@unlink('../media/qualification/' . $userId . '/'.$row['img']);
		@unlink('../media/qualification/' . $userId . '/thumb/'.$row['img']);
	}
	mysql_query("DELETE FROM `tt_business_qualification` WHERE id = '".$_GET['keyid']."'");
	$_SESSION['qualification_msg'] = 'Record deleted successfully!';
	header('location:'.$ru.'member/qualifications/');
	exit;
}
if($_GET['action'] == 'dlt_insurance')
{
	$qry = mysql_query("SELECT * FROM `tt_business_insurance` WHERE id = '".$_GET['keyid']."'");
	$row = mysql_fetch_array($qry);
	if(!empty($row['img'])){
		@unlink('../media/insurance/' . $userId . '/'.$row['img']);
		@unlink('../media/insurance/' . $userId . '/thumb/'.$row['img']);
	}
	mysql_query("DELETE FROM `tt_business_insurance` WHERE id = '".$_GET['keyid']."'");
	$_SESSION['insurance_msg'] = 'Record deleted successfully!';
	header('location:'.$ru.'member/insurance/');
	exit;
}

if(isset($_POST['addInsurance'])){
	unset($_SESSION['insurance']);
	unset($_SESSION['insurance_err']);
	unset($_SESSION['insurance_msg']);
	foreach ($_POST as $k => $v ){
		$$k =  addslashes($v);
		$_SESSION['insurance'][$k] = addslashes($v);
	}
  	$flgs = false;
	$title = wordLimit_keytitle($title);
	if( checkSwear($title) ){
		$_SESSION['insurance_err']['title'] = 'Swearing is not tolerated on title'; //exit;
		$flgs = true;
	}
	// __________++++++++++++++++++++ the end of Title swear word
	
	
	if($title==''){
		$_SESSION['insurance_err']['title'] = 'Please enter valid title';
		$flgs = true;
	}
	$shortdescription = wordLimit_keyservices($shortdescription);
	$shortdescription = nl2br($shortdescription);
	// ____________++++++++++++++++ this validat is used for Description swear word
	if( checkSwear($shortdescription) ){
		$_SESSION['insurance_err']['shortdescription'] = 'Swearing is not tolerated on Description'; //exit;
		$flgs = true;
	}
	// __________++++++++++++++++++++ the end of Description swear word
	
	if($shortdescription==''){
		$_SESSION['insurance_err']['shortdescription'] = 'Please enter description';
		$flgs = true;
	}
	if(isset($keyId))
		$keyId = (int)$keyId;
	if($flgs){
		header('location:'.$ru.'member/insurance/'.$keyId);
		exit;
	}else{
		$qry = " `tt_business_insurance` SET `title` = '$title', `shortdescription` = '$shortdescription' ";
		if(isset($keyId) and $keyId>0){
			$qry = "UPDATE $qry WHERE `id` = '$keyId'";
			mysql_query($qry);
			$_SESSION['insurance_msg'] = "Insurance updated successfully!";
		}else{
			$qry = "INSERT INTO $qry ,`userId` = '$userId'";
			mysql_query($qry);
			$keyId = mysql_insert_id();
			$_SESSION['insurance_msg'] = "Insurance added successfully!";
		}
		$companylogo = "img"; 
		if( isset($_FILES[$companylogo]['tmp_name']) ){
			@mkdir ('../media/insurance/' . $userId . '/' ,0777) ;
			@mkdir ('../media/insurance/' . $userId . '/thumb/' , 0777);
			$upload_dir = '../media/insurance/' . $userId . '/';
			$thutt_folder = '../media/insurance/' . $userId . '/thumb/';
			$logo ='';			
			@chmod($upload_dir,0777);
			@chmod($thutt_folder,0777);
			//$ext= array ('gif','jpg','jpeg','png','bmp');			
			$ext= array ('gif','jpg','jpeg','png','bmp','pdf','doc','docx','xls','xlsx','txt');
			$file_type=$_FILES[$companylogo]['type'];   			
			if(!empty($_FILES[$companylogo]['name'])){
			//echo "merhan"; exit;
				$upload = new upload($companylogo, $upload_dir, '777', $ext);
				if ($upload->message =="SUCCESS_FILE_SAVED_SUCCESSFULLY" ){
					$logo=$upload->filename;	
					
					$filename = strtolower($logo) ; 
					$exts = split("[/\\.]", $filename);
					$n = count($exts)-1;
					$exts = $exts[$n];
					
					if(in_array($exts,array('gif','jpg','jpeg','png','bmp'))){				
					//echo "merhan"; exit;
					require_once('../phpThumb/phpthumb.class.php');
					
					$phpThumb = new phpThumb();
					
					$thumbnail_width = 57;
					$phpThumb->setSourceFilename($upload_dir.$logo);
					$output_filename = $thutt_folder.$logo;
					$phpThumb->setParameter('w', $thumbnail_width);
					if ($phpThumb->GenerateThumbnail()) { // this line is VERY important, do not remove it!
						if ($phpThumb->RenderToFile($output_filename)) {}
					}
					
					}
					  $insQry ="UPDATE `tt_business_insurance` SET `img` ='$logo' WHERE `id` = '$keyId'"; 
					mysql_query($insQry)or die (mysql_error());
				}else{
					$_SESSION["insurance_err"]["img"] = "Error: Upload an Image file.";
				}	
			}
		}
		unset($_SESSION['insurance']);
		header('location:'.$ru.'member/insurance/');
		exit;
	}
}

if (isset($_POST['UpdateTrader'])){
	$res_biz = mysql_query("SELECT `locationid` FROM `tt_business` WHERE `userId` = '$userId'");
	if(mysql_num_rows($res_biz) == 0){
		mysql_query("INSERT INTO `tt_business` SET `userId` = '$userId'");
		$locationid = mysql_insert_id();
	}else{
		$row_biz = mysql_fetch_array($res_biz);
		$locationid = $row_biz['locationid'];
	}
	unset($_SESSION['biz_reg_err']);
	unset($_SESSION['error']);
	unset($_SESSION['biz_pro_reg']);
	foreach ($_POST as $k => $v ){
		$$k =  addslashes(trim($v));
		$_SESSION['biz_pro_reg'][$k] = $v;
	}	
	//print_r($_SESSION['biz_reg']); exit;
	
  	$flgs = false;
	$flgs_error = false;
	///////////////////////email validation///////////
	if( ($email!='') and (!filter_var($email, FILTER_VALIDATE_EMAIL)) ){
		$_SESSION['biz_reg_err']['email'] = $_ERR['register']['emailg'];
		$flgs = true;
	}
	///////////////////////phone name validation////////	
	// ____________++++++++++++++++ this validat is used for Description swear word
	if($name!=''){
		if( checkSwear($name) ){
			 $_SESSION['error']['name'] = 'Swearing is not tolerated on name'; //exit;
			$flgs_error = true;
		}
	}elseif($name==''){
		$_SESSION['biz_reg_err']['name'] = 'Please enter valid Company name';
		$flgs = true;
	}
	
	
	
	
	$description = nl2br($description);
	$description_ex  = count(explode(" ",$description));
	if($description_ex<50)
	{
		$_SESSION['biz_reg_err']['description'] = 'Please enter At least 50 words In Description';
		$flgs = true;
	}
	
	
	$description = wordLimit($description);
	// ____________++++++++++++++++ this validat is used for Description swear word
	if($description!=''){
		if( checkSwear($description) ){
			$_SESSION['error']['description'] = 'Swearing is not tolerated on Description'; //exit;
			$flgs_error = true;
		}
	}elseif($description==''){
		$_SESSION['biz_reg_err']['description'] = 'Please enter Description';
		$flgs = true;
	}
	// ____________++++++++++++++++ this validat is used for video swear word
	if($video_embad!=''){
		if( checkSwear($video_embad) ){
			$_SESSION['error']['video_embed'] = 'Swearing is not tolerated on Video';
			$flgs_error = true;
		}
	}
	
	// ____________++++++++++++++++ this validat is used for Address 1 swear word
	if($address!=''){
		if( checkSwear($address) ){
			$_SESSION['error']['address'] = 'Swearing is not tolerated on Address 1';
			$flgs_error = true;
		}
	}elseif($address==''){
		$_SESSION['biz_reg_err']['address'] = 'Please enter Address';
		$flgs_error = true;
	}
	
	// ____________++++++++++++++++ this validat is used for Address 2 swear word
	if($address2!='')
	{
		if( checkSwear($address2) ){
			$_SESSION['error']['address2'] = 'Swearing is not tolerated on Address 2';
			$flgs_error = true;
		}
	}

	
	
	// ____________++++++++++++++++ this validat is used for City swear word
	if($city!=''){
		if( checkSwear($city) ){
			$_SESSION['error']['city'] = 'Swearing is not tolerated on City';
			$flgs_error = true;
		}
	}elseif($city==''){
		$_SESSION['biz_reg_err']['city'] = 'Please enter City';
		$flgs = true;
	}
	
	// ____________++++++++++++++++ this validat is used for Zip swear word
	if($zip!=''){
		if( checkSwear($zip) ){
			$_SESSION['error']['zip'] = 'Swearing is not tolerated on Post Code';
			$flgs_error = true;
		}
	}elseif($zip==''){
		$_SESSION['biz_reg_err']['zip'] = 'Please enter Zip Code';
		$flgs = true;
	}	
	
	// ____________++++++++++++++++ this validat is used for Zip swear word
	if($keywords!=''){
		if( checkSwear($meta_title) ){
			$_SESSION['error']['keywords'] = 'Swearing is not tolerated on keywords';
			$flgs_error = true;
		}
	}elseif(empty($keywords)){
		$_SESSION['biz_reg_err']['keywords'] = 'Please enter keywords';
		$flgs = true;
	}	
	
	// ____________++++++++++++++++ this validat is used for Meta Title swear word
	if($meta_title != ''){
		if( checkSwear($meta_title) ){
			$_SESSION['error']['meta_title'] = 'Swearing is not tolerated on Meta Title';
			$flgs_error = true;
		}
	}elseif(empty($meta_title)){
		$_SESSION['biz_reg_err']['meta_title'] = 'Please enter Meta Title';
		$flgs = true;
	}	
	
	$meta_description = nl2br($meta_description);
	$meta_description = wordLimit($meta_description);
	// ____________++++++++++++++++ this validat is used for Meta Description swear word
	if($meta_description!=''){
		if(checkSwear($meta_description)){
			$_SESSION['error']['meta_description'] = 'Swearing is not tolerated on Meta Description';
			$flgs_error = true;
		}
	}elseif(empty($meta_description)){
		$_SESSION['biz_reg_err']['meta_description'] = 'Please enter Meta Description';
		$flgs = true;
	}
	// _____________+++++++++++++++++++++ this code is used for the sub domain

	if (!preg_match('/^[a-z0-9-]+$/', $sub_domain) || strlen ($sub_domain) < 3 || strlen ($sub_domain) >30 )
	{
		$_SESSION['error']['sub_domain'] = 'Sub-domain can only contain 3-30 alphanumerics and dash(-)';
		$flgs = true;
	}elseif (VerifyDB_Domain($sub_domain)){
		$_SESSION['error']['sub_domain'] = 'Not available';
		$flgs = true;
	}
	/*elseif(verifyDomain($sub_domain))
	{
		$_SESSION['error']['sub_domain'] = 'Sub-domain can only contain 3-30 alphanumerics and dash(-)';
		$flgs = true;
	*/
	if( checkSwear($sub_domain) ){
		$_SESSION['error']['sub_domain'] = 'Swearing is not tolerated on domain name';
		$flgs = true;
	}

	///////////////////////phone name validation////////	
	$sql_mcat = "SELECT * from tt_category where `catid` = '$mcatid' AND `cat_type` = '1'";
	$result_mcat = @mysql_query($sql_mcat);
	$row_mcat = mysql_fetch_array($result_mcat);
	$industry = addslashes($row_mcat['cat_name']);
	$sub_cat = '';
	$scatids2 .= '';
	if(count($scatids)>0){
		foreach($scatids as $scatid)
		{
			$sql_scat = "SELECT * FROM `tt_category` WHERE `catid` = '$scatid' AND `p_catid` = '$mcatid' AND `cat_type` = '1'";
			$result_scat = @mysql_query($sql_scat);
			$row_scat = mysql_fetch_array($result_scat);
			$sub_cat .= ','. addslashes($row_scat['cat_name']);
			$scatids2 .= ','.$scatid;
		}
	}
	if(!empty($sub_cat)){
		$sub_cat .= ',';
		$scatids2 .= ',';
	}
	
	if($phone=='')
	{
		$_SESSION['biz_reg_err']['phone'] = 'Please enter  Phone Number';
		$flgs = true;
	}
	
	
	if($flgs_error){
		header('location:'.$ru.'member/trade-profile'); exit;
	}
	
	if($flgs)
	{
		header('location:'.$ru.'member/trade-profile'); exit;
	}else{
	
		//$address1 = $address.' '.$address2.', '.$city.', '.$state.' '.$zip.' UK';
		//echo "mehrtak "; exit;
		
		$addressbuss = " ";
		if($address != ''){
			$addressbuss .= ", ".$address;
		}
		if($address2 != ''){
			$addressbuss .= ", ".$address2;
		}

		if($city != ''){
			$addressbuss .= ", ".$city;
		}
		if($state != ''){
			$addressbuss .= ", ".$state;
		}
		if($zip != ''){
			$addressbuss .= ", ".$zip;
		}
		
		$where = stripslashes($addressbuss).", UK";
		$whereurl = urlencode($where);
		$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$whereurl.'&sensor=false');
		$output= json_decode($geocode);
		$Latitude = $output->results[0]->geometry->location->lat;
		$Longitude = $output->results[0]->geometry->location->lng;
		
		
		
		//echo $Latitude."</br>".$Longitude;exit;
		$keywords = keywordsclean($keywords);
		$daysArr = array('sun'=>'sunday','mon'=>'monday','tue'=>'tuesday','wed'=>'wednesday','thu'=>'thursday','fri'=>'friday','sat'=>'saturday');
		$timeing_str = '';
		foreach($daysArr as $short=>$long){
			$timeing_str .= $short."_oc = '".$_POST[$short.'_oc']."',
							".$short."_f = '".$_POST[$short.'_frm_hr'].':'.$_POST[$short.'_frm_min']." ".$_POST[$short.'_frm_ampm']."', 
							".$short."_t = '".$_POST[$short.'_to_hr'].':'.$_POST[$short.'_to_min']." ".$_POST[$short.'_to_ampm']."', ";
		}
		$latLong = '';
		if(!empty($Latitude) and !empty($Longitude))
			$latLong .= " `latitude` = '$Latitude', `longitude` = '$Longitude', ";
		//$description = cleaner($description);
		
		//echo $description; exit;
		$keywords = keywor_filter($keywords);
		$insQry = "UPDATE `tt_business` set `name` ='$name',
				`description` ='$description', `video_embed` = '$video_embed', `industry` = '$industry', `subcat` = '$sub_cat', 
				`address` ='$address', `address2` ='$address2', `city` = '$city', `state` = '$state', `zip` ='$zip', `phone` ='$phone',
				`tracked_phone` = '$tracked_phone',`meta_title`='$meta_title',`meta_description`='$meta_description', `keywords` ='$keywords', `email` = '$email', $logo $timeing_str `dated` = now(), 
				$latLong `mcatid` = '$mcatid', `scatids` = '$scatids2',`sub_domain`='$sub_domain' 
				WHERE `userId` = '$userId'"; 
				//skill_summery = '$skill_summery', 
		//echo $insQry;exit;
		mysql_query($insQry) or die (mysql_error());
		if ( isset($_FILES['logo']['tmp_name'])){
			@mkdir ('../media/buisness_images/' .$locationid.'/' ,0777) ;
			@mkdir ('../media/buisness_images/' .$locationid.'/logo/' , 0777);
			@mkdir ('../media/buisness_images/' .$locationid.'/logo/thumb/', 0777);
			$upload_dir = '../media/buisness_images/' .$locationid.'/logo/';
			$thutt_folder = '../media/buisness_images/' .$locationid.'/logo/thumb/';
			$logo ='';			
			@chmod($upload_dir,0777);
			@chmod($thutt_folder,0777);
			$ext= array ('gif','jpg','jpeg','png','bmp');			
			$companylogo = "logo"; 
		
			$file_type=$_FILES[$companylogo]['type'];   			
			if(!empty($_FILES[$companylogo]['name'])){
				$upload = new upload($companylogo, $upload_dir, '777', $ext);
				if ($upload->message =="SUCCESS_FILE_SAVED_SUCCESSFULLY" ){
					$logo=$upload->filename;
					require_once('../phpThumb/phpthumb.class.php');
					$phpThumb = new phpThumb();
					$thumbnail_width = 120;
					$phpThumb->setSourceFilename($upload_dir.$logo);
					$output_filename = $thutt_folder.$logo;
					$phpThumb->setParameter('w', $thumbnail_width);
					if ($phpThumb->GenerateThumbnail()) { // this line is VERY important, do not remove it!
						if ($phpThumb->RenderToFile($output_filename)) {}
					}
					$insQry ="UPDATE tt_business SET logo ='$logo' WHERE `userId` = '$userId'";	
					mysql_query($insQry)or die (mysql_error());
				}else{
					$_SESSION["biz_reg"]["logo"] = "Error: Upload an Image file.";
				}	
			}
		}
		
		$keywords_arr = explode(',',$keywords);
		if(count($keywords_arr) > 0)
		{
			foreach($keywords_arr as $keyw){
				$res_cat = mysql_query("SELECT COUNT(`catid`) as tot from `tt_category` WHERE `cat_name` = '" . addslashes($keyw) . "'");
				$row_cat = mysql_fetch_array($res_cat);
				if($row_cat[0]==0){
					mysql_query("insert into `tt_category` SET `cat_name` = '" . addslashes($keyw) . "', `p_catid` = 0, `cat_type` = 0");
				}
			}
		}
		updateCatBusCount();
		$_SESSION['biz_reg_err']['business_add'] = 'Updated successfully!';
		unset($_SESSION['biz_pro_reg']);
		header('location:'.$ru.'member/trade-profile'); exit;
	}
}

if ( isset ($_POST['UpdateBusiness2'])){
// echo '<pre>'; print_r($_REQUEST); exit;
	    unset($_SESSION['biz_reg_err2']);
	    unset($_SESSION['biz_reg2']);
	
		foreach ($_POST as $k => $v ){
			$$k =  addslashes(trim($v ));
			$_SESSION['biz_reg2'][$k]=$v;
		}
	$flgs = false;
 
		
  if($flgs)
  {
		header('location:'.$ru.'home.php?p=business_edit_step2&bId='.$bId); exit;
		
  }else{
  		//billling info check and insertion and update
	   $SQL_check = "SELECT * FROM tt_business_billing_info where bid ='$bId'";
		 $rs_row		= $db->get_row($SQL_check, ARRAY_A);

		if($rs_row){
			 $insQry_billing ="update tt_business_billing_info set address='$address', city='$city',contact ='$contact', 	state ='$state',zip ='$zip', phone ='$phone' where bid ='$bId' ";
			mysql_query($insQry_billing)or die (mysql_error());
		}else{   
			$insQry_billing ="insert into tt_business_billing_info set address='$address', city='$city',contact ='$contact', 	state ='$state',zip ='$zip', phone ='$phone', bid ='$bId' ";
			mysql_query($insQry_billing)or die (mysql_error());
		}
		
		//additional info check and insertion and update
		$SQL_check  = "SELECT * FROM tt_business_additional_info where bid ='$bId'";
		$rs_row		= $db->get_row($SQL_check, ARRAY_A);
		
		if($rs_row){
					$insQry ="update tt_business_additional_info set yearestablished='$yearestablished', iccmc='$iccmc',description ='$description'where bid ='$bId' ";
					mysql_query($insQry)or die (mysql_error());

		}else{   
					$insQry ="insert into tt_business_additional_info set yearestablished='$yearestablished', iccmc='$iccmc',description ='$description', bid ='$bId' ";
					mysql_query($insQry)or die (mysql_error());
		}	  

		if($userId!=1 && $userId!=0){
			$updatestatus ="Update tt_user set type ='b' where userId = $userId";
	  		mysql_query($updatestatus)or die (mysql_error());
		}
		unset($_SESSION['biz_reg_err2']);
		unset($_SESSION['biz_reg2']);
		//$_SESSION['biz_reg_err2']['business_add'] = 'Company Updated Successfully!';
		if ( isset($_POST['UpdateBusiness2'])){
		header('location:'.$ru.'home.php?p=business_edit_step3&bId='.$bId);
		exit;
		} else{
		header('location:'.$ru.'home.php?p=business_edit_step2&bId='.$bId);
		exit;
	   }
  }
}


if ( isset ($_POST['UpdateBusiness3'])){
// echo '<pre>'; print_r($_REQUEST); exit;
	    unset($_SESSION['biz_reg_err3']);
	    unset($_SESSION['biz_reg3']);
	
		foreach ($_POST as $k => $v ){
			$$k =  addslashes(trim($v ));
			$_SESSION['biz_reg3'][$k]=$v;
		}
	
	//echo $bId; exit;
	//echo '<pre>';print_r($_SESSION['biz_reg3']);exit;
	$flgs = false;
 
		
  if($flgs)
  {
		header('location:'.$ru.'home.php?p=business_edit_step2&bId='.$bId); exit;
		
  }else{
	   $SQL_check   = "SELECT btype FROM tt_business where locationid ='$bId'";
	   $rs_row_check= $db->get_row($SQL_check, ARRAY_A);
	   if ($rs_row_check['btype'] == 'Broker'){
			//broker info check and insertion and update
		   $SQL_check   = "SELECT * FROM tt_business_broker where bid ='$bId'";
		   $rs_row		= $db->get_row($SQL_check, ARRAY_A);

			if($rs_row){
					$insQry_billing ="update tt_business_broker set bondagent ='$bondagent', bondphone='$bondphone' where bid ='$bId' ";
					mysql_query($insQry_billing)or die (mysql_error());
			}else{   
					$insQry_billing ="insert into tt_business_broker set bondagent='$bondagent', bondphone='$bondphone', bid ='$bId' ";
					mysql_query($insQry_billing)or die (mysql_error());
					}
		}elseif ($rs_row_check['btype'] == 'Carrier'){
				//cargo unsurance info check and insertion and update
				$SQL_check  = "SELECT * FROM tt_business_cargo_info where bid ='$bId'";
				$rs_row		= $db->get_row($SQL_check, ARRAY_A);	
				if($rs_row){
					$insQry ="update tt_business_cargo_info set company='$company', agent='$agent',inslimit='$inslimit', deductible='$deductible',phone ='$phone' where bid ='$bId' ";
					mysql_query($insQry)or die (mysql_error());
		
				 }else{   
					$insQry ="insert into tt_business_cargo_info set company='$company', agent='$agent',inslimit='$inslimit', deductible='$deductible',phone ='$phone',bid ='$bId' ";
					mysql_query($insQry)or die (mysql_error());
					  }
				//cargo unsurance info check and insertion and update	  
				$SQL_check  = "SELECT * FROM tt_business_equipment_info where bid ='$bId'";
				$rs_row		= $db->get_row($SQL_check, ARRAY_A);
				
				if($rs_row){
							$insQry ="update tt_business_equipment_info set trucks='$trucks', route='$route',description='$description' where bid ='$bId' ";
							mysql_query($insQry)or die (mysql_error());
		
				}else{   
							$insQry ="insert into tt_business_equipment_info set trucks='$trucks', route='$route',description='$description', bid ='$bId' ";
							mysql_query($insQry)or die (mysql_error());
				}
			  
		}elseif ($rs_row_check['btype'] == 'Broker / Carrier'){
				
				//broker info check and insertion and update
			   $SQL_check   = "SELECT * FROM tt_business_broker where bid ='$bId'";
			   $rs_row		= $db->get_row($SQL_check, ARRAY_A);
	
				if($rs_row){
						$insQry_billing ="update tt_business_broker set bondagent ='$bondagent', bondphone='$bondphone' where bid ='$bId' ";
						mysql_query($insQry_billing)or die (mysql_error());
				}else{   
						$insQry_billing ="insert into tt_business_broker set bondagent='$bondagent', bondphone='$bondphone', bid ='$bId' ";
						mysql_query($insQry_billing)or die (mysql_error());
				   }
				//cargo unsurance info check and insertion and update
				$SQL_check  = "SELECT * FROM tt_business_cargo_info where bid ='$bId'";
				$rs_row		= $db->get_row($SQL_check, ARRAY_A);	
				if($rs_row){
					$insQry ="update tt_business_cargo_info set company='$company', agent='$agent',inslimit='$inslimit', deductible='$deductible',phone ='$phone' where bid ='$bId' ";
					mysql_query($insQry)or die (mysql_error());
		
				 }else{   
					$insQry ="insert into tt_business_cargo_info set company='$company', agent='$agent',inslimit='$inslimit', deductible='$deductible',phone ='$phone',bid ='$bId' ";
					mysql_query($insQry)or die (mysql_error());
					  }
				//cargo unsurance info check and insertion and update	  
				$SQL_check  = "SELECT * FROM tt_business_equipment_info where bid ='$bId'";
				$rs_row		= $db->get_row($SQL_check, ARRAY_A);
				
				if($rs_row){
							$insQry ="update tt_business_equipment_info set trucks='$trucks', route='$route',description='$description' where bid ='$bId' ";
							mysql_query($insQry)or die (mysql_error());
		
				}else{   
							$insQry ="insert into tt_business_equipment_info set trucks='$trucks', route='$route',description='$description', bid ='$bId' ";
							mysql_query($insQry)or die (mysql_error());
				}
			  
		}
		if($userId!=1 && $userId!=0){
			$updatestatus ="Update tt_user set type ='b' where userId = $userId";
	  		mysql_query($updatestatus)or die (mysql_error());
		}
		unset($_SESSION['biz_reg_err2']);
		unset($_SESSION['biz_reg2']);
		//$_SESSION['biz_reg_err2']['business_add'] = 'Company Updated Successfully!';
		header('location:'.$ru.'home.php?p=business');
  }
}


if ( isset ($_POST['UpdateTraderImages'])){
	$res_biz = mysql_query("SELECT `locationid` FROM `tt_business` WHERE `userId` = '$userId'");
	if(mysql_num_rows($res_biz)==0){
		mysql_query("INSERT INTO `tt_business` SET `userId` = '$userId'");
		$locationid = mysql_insert_id();
	}else{
		$row_biz = mysql_fetch_array($res_biz);
		$locationid = $row_biz['locationid'];
	}
	
	$ext= array ('gif','jpg','jpeg','png','bmp');
	if(count($_FILES['bussPic']['name'])>0 and !empty($_FILES['bussPic']['name'][0]) ){
		$imgStrUploade = array();
		$i=0;
		$target_path = "../media/bussPics/".$locationid."/";
		@mkdir($target_path,0777);
		@chmod($target_path,0777);
		
		@mkdir($target_path.'original/',0777);
		@chmod($target_path.'original/',0777);
		
		@mkdir($target_path.'thumbs/',0777);
		@chmod($target_path.'thumbs/',0777);
		foreach($_FILES['bussPic']['name'] as $counter=>$val){
			$_FILES['bussPic2']['name'] = $_FILES['bussPic']['name'][$counter];
			$_FILES['bussPic2']['type'] = $_FILES['bussPic']['type'][$counter];
			$_FILES['bussPic2']['tmp_name'] = $_FILES['bussPic']['tmp_name'][$counter];
			$_FILES['bussPic2']['error'] = $_FILES['bussPic']['error'][$counter];
			$_FILES['bussPic2']['size'] = $_FILES['bussPic']['size'][$counter];
			$width = 0;
			$height = 0;
			require_once('../phpThumb/phpthumb.class.php');
			list($width, $height) = getimagesize($_FILES['bussPic2']['tmp_name']);
			if($width>600 ){
				$upload = new upload('bussPic2', $target_path.'original/', '777', $ext);
				if ($upload->message =="SUCCESS_FILE_SAVED_SUCCESSFULLY" ){	
					$imgStrUploade[] = $upload->filename;
					$phpThumb = new phpThumb();
					$phpThumb->setSourceFilename($target_path.$upload->filename);
					$output_filename = $target_path."thumbs/".$upload->filename;
					$phpThumb->setParameter('h', 100);
					
					if ($phpThumb->GenerateThumbnail()) { // this line is VERY important, do not remove it!
						if ($phpThumb->RenderToFile($output_filename)) {}
					}
					$phpThumb = new phpThumb();
					$phpThumb->setSourceFilename($target_path.'original/'.$upload->filename);
					$output_filename = $target_path.$upload->filename;
					$phpThumb->setParameter('w', 600);
					
					if ($phpThumb->GenerateThumbnail()) { // this line is VERY important, do not remove it!
						if ($phpThumb->RenderToFile($output_filename)) {}
					}
					
					$phpThumb2 = new phpThumb();
					$phpThumb2->setSourceFilename($target_path.'original/'.$upload->filename);
					$output_filename = $target_path."thumbs/".$upload->filename;
					$phpThumb2->setParameter('h', 100);
					
					if ($phpThumb2->GenerateThumbnail()) { // this line is VERY important, do not remove it!
						if ($phpThumb2->RenderToFile($output_filename)) {}
					}
				}
			}else{
				$upload = new upload('bussPic2', $target_path, '777', $ext);
				if ($upload->message =="SUCCESS_FILE_SAVED_SUCCESSFULLY" ){
					$_SESSION['imager_uploade_msg'] = 'Images uploaded successfully!';
					$imgStrUploade[] = $upload->filename;
					$phpThumb = new phpThumb();
					$phpThumb->setSourceFilename($target_path.$upload->filename);
					$output_filename = $target_path."thumbs/".$upload->filename;
					$phpThumb->setParameter('w', 100);
					//echo "Mehran".$phpThumb; exit;
					if ($phpThumb->GenerateThumbnail()) { // this line is VERY important, do not remove it!
						if ($phpThumb->RenderToFile($output_filename)) {}
					}
				}
			}
			$i++;
		}
	
		if(count($imgStrUploade)>0){
			foreach($imgStrUploade as $img)
				mysql_query("INSERT INTO `tt_business_photo` SET `name` = '$img', `bId` = '$locationid'");
		}
	}
	updatePhotoCount($locationid);
	
		$SQL_act = "select count(id) as rowcount from tt_business_photo where bId= '".$locationid."'";		
		$rs_row		= $db->get_row($SQL_act, ARRAY_A);			
		$varr = $rs_row['rowcount'];
		$update = "update tt_business set photoCount = '".$varr."' where locationid='".$locationid."'";
		$db->query($update);
	
	
	
	header("location:".$ru."member/trader-images");exit;
}


function keywordsclean($kwname){
	$kwname = str_replace(", &",",",$kwname);
	$kwname = str_replace(",&",",",$kwname);
	$kwname = str_replace(" , ",",",$kwname);
	$kwname = str_replace(", ",",",$kwname);
	$kwname = str_replace(" ,",",",$kwname);	
	$kwname =str_replace("?","",$kwname);
	$kwname =str_replace(":","",$kwname);	
	$kwname =str_replace(";","",$kwname);		
	$kwname =str_replace("'","",$kwname);
	$kwname =str_replace("/"," ",$kwname);
	$kwname =str_replace("  "," ",$kwname);	
	return $kwname;
}
?>