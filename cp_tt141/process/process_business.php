<?php 
require_once("../../connect/connect.php");
require_once("../security.php");
require_once ('../inc/functii.php');
include ("../inc/upload.php");

unset($_SESSION['biz_reg_err']);
unset($_SESSION['biz_reg']);
unset($_SESSION['biz_regg']);
//print_r($_REQUEST); exit;
if ( isset ($_GET['action'])  and  ($_GET['action']=='d'))
{
			
	$locationid  =$_GET['bId'];
	
	$rdir = 'home.php?p=business';
	
	$biz_Sql = "select * from tt_business where locationid  = $locationid ";
	$biz =mysql_query($biz_Sql);
	if (mysql_num_rows($biz) == 0) {header('location:'.$rdir);exit;}
	
	
	$biz_Sql = "delete from tt_business where locationid  = $locationid ";
	
	if( $biz =mysql_query($biz_Sql) ){
		$sql33 = "DELETE FROM business_reviews where locationid = '".$locationid."'";
		mysql_query($sql33);
	
		$_SESSION['msg'] = 'Business deleted !';
		//$ruadmins = $_SERVER['HTTP_REFERER'];
		header('location:'.$ruadmin.'home.php?p=business'); exit;
		//header('location:'.$ruadmins.'home.php?p=business'); exit;				
	
	} 
	//header('location:'.$ruadmin.'home.php?p=business'); exit;
	header('location:'.$rdir );exit;}


if (isset($_POST['SaveTrader'])){ 
//echo "dsfsdf"; exit;

     	unset($_SESSION['biz_reg_err']);
	    unset($_SESSION['biz_regg']);
		unset($_SESSION['error']);
	
	foreach ($_POST as $k => $v ){
		$$k =  addslashes(trim($v));
		$_SESSION['biz_regg'][$k] = addslashes(trim($v));
	}
  	$flgs = false;
	
	 	

	///////////////////////email validation///////////
	if( ($email!='') and (!filter_var($email, FILTER_VALIDATE_EMAIL)) ){
		
			$_SESSION['biz_reg_err']['email'] = $_ERR['register']['emailg'];
			$flgs = true;

	}


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
	}
	
	
	if(!empty($sub_domain)){
$rsVU =mysql_query("select count(*) as uc from tt_business where sub_domain like '$sub_domain' AND `userId` <> '".$userId."' "); 
	$rowUV = mysql_fetch_array($rsVU);
	if ( $rowUV['uc']> 0 ){// return true; else return false;
		$_SESSION['error']['sub_domain'] = 'Not available';
		$flgs = true;
		}
	}
	
	
	
	if( checkSwear($sub_domain) ){
		$_SESSION['error']['sub_domain'] = 'Swearing is not tolerated on domain name';
		$flgs = true;
	}

   
   
   
    
  if($flgs)
  {
	
		header('location:'.$ruadmin.'home.php?p=addbusiness'); exit;
		
  }else{
  		
		
		
		 
  $addressbuss = $address;

		if($city != ''){
			$addressbuss .= ", ".$city;
		}
		if($state != ''){
			$addressbuss .= ", ".$state;
		}
		if($zip != ''){
			$addressbuss .= ", ".$zip;
		}

		
		$where = stripslashes($addressbuss).", UK";;
		$whereurl = urlencode($where);
			
			$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$whereurl.'&sensor=false');

		$output= json_decode($geocode);
		
		$latitude = $output->results[0]->geometry->location->lat;
		$longitude = $output->results[0]->geometry->location->lng;
			
  
  
  
  $keywords = keywordsclean($keywords);
	/*$SQL_act = "SELECT * FROM tt_business WHERE userId =$b_userId ";
	//exit;
	$rs_row		= $db->get_row($SQL_act, ARRAY_A);
	if($rs_row){
		 $_SESSION['biz_reg_err']['business_add'] = 'This user already created the company. Please add new user frist.' ;
		 header('location:'.$ruadmin.'home.php?p=addbusiness&a='.$btype); exit;
	}
     else{*/ 
	 // +++++++++++++ this code is used for the category and sub category 
	 
	 $sql_mcat = "SELECT * from tt_category where `catid` = '$industry' AND `cat_type` = '1'";
	$result_mcat = @mysql_query($sql_mcat);
	$row_mcat = mysql_fetch_array($result_mcat);
	$industryy = addslashes($row_mcat['cat_name']);
	$sub_cat = '';
	$scatids2 .= '';
	if(count($scatids)>0){
	//echo "mehrta "; //exit;
		foreach($_POST['scatids'] as $scatid)
		{
		
		 	$sql_scat = "SELECT * FROM `tt_category` WHERE `catid` = '$scatid' AND `p_catid` = '$industry' AND `cat_type` = '1'"; 
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
	
	 	 
	 // ++++++++++++ the end category and sub category code
	 $daysArr = array('sun'=>'sunday','mon'=>'monday','tue'=>'tuesday','wed'=>'wednesday','thu'=>'thursday','fri'=>'friday','sat'=>'saturday');
	 $timeing_str = '';
		foreach($daysArr as $short=>$long){
			$timeing_str .= $short."_oc = '".$_POST[$short.'_oc']."',
							".$short."_f = '".$_POST[$short.'_frm_hr'].':'.$_POST[$short.'_frm_min']." ".$_POST[$short.'_frm_ampm']."', 
							".$short."_t = '".$_POST[$short.'_to_hr'].':'.$_POST[$short.'_to_min']." ".$_POST[$short.'_to_ampm']."', ";
		}
	 
	//echo "<pre>"; print_r($timeing_str); exit;
	 
  $insQry ="insert into tt_business set 	name ='$name',
									description='$description',
									industry='$industryy',
									subcat='$sub_cat',
									address ='$address',
									city ='$city',
									state ='$state',
									zip ='$zip',
									phone ='$phone',
									tracked_phone='$mobile',
									meta_title= '$meta_title',
									meta_description='$meta_description',
									keywords ='$keywords',
									email ='$email',
									 $logo
									status ='$status',
									userId ='$b_userId',
									 $timeing_str
									dated =now(),
									mcatid = '$industry',
									scatids = '$scatids2',
									latitude ='$latitude',
									longitude ='$longitude',
									video_embed='$video_embed',
									sub_domain='$sub_domain'";
									//exit;
									//dispatchcontact ='$dispatchcontact',
									//phone2 ='$phone2',
									//phone3 ='$phone3',
									//phone4 ='$phone4',
									//fax ='$fax',
									//website ='$website',
									//ownername ='$ownername',
									//btype = '$btype',
									//ltype = '$ltype',
									//dtype = '$dtypeval',
									//claim_flag = '$claim_flag',
									//stype = '$statenames',
									//keywords ='$keywords',
  		 mysql_query($insQry)or die (mysql_error());
		
		$bizId = mysql_insert_id();		
		if ( isset($_FILES['logo']['tmp_name'])) 
		{ 
		

			@mkdir (ABSPATH.'media/buisness_images/' .$bizId.'/' ,0777) ;
			@mkdir (ABSPATH.'media/buisness_images/' .$bizId.'/logo/' , 0777);
			@mkdir (ABSPATH.'media/buisness_images/' .$bizId.'/logo/thumb/', 0777);
		
			$upload_dir = ABSPATH.'media/buisness_images/' .$bizId.'/logo/';
			$thutt_folder = ABSPATH.'media/buisness_images/' .$bizId.'/logo/thumb/';
			
			$logo ='';			
			@chmod($upload_dir,0777);	
			@chmod($thutt_folder,0777);	
			$ext= array ('gif','jpg','jpeg','png','bmp');			
			$companylogo = "logo"; 
		
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
					$insQry ="update  tt_business set 	logo ='$logo' where locationid	= $bizId";	
					mysql_query($insQry)or die (mysql_error());
					
					}else{
					$_SESSION["biz_regg"]["logo"] = "Error: Upload an Image file.";
					}	
			}
		}			
		/*if($b_userId!=1 && $b_userId!=0){
			$updatestatus ="Update tt_user set type ='b' where userId = $b_userId";
	  		mysql_query($updatestatus)or die (mysql_error());
		}*/		
		unset($_SESSION['biz_reg_err']);
		unset($_SESSION['biz_regg']);
		$_SESSION['biz_reg_err']['business_add'] = 'Company added successfully!';
		header('location:'.$ruadmin.'home.php?p=addbusiness&a='.$btype); exit;
 	 	//}
  	}
 }

if ( isset ($_POST['UpdateTrader'])){
 
//print_r($_REQUEST); exit;
	    unset($_SESSION['biz_reg_err']);
	    unset($_SESSION['biz_reg']);
		unset($_SESSION['biz_reggg']);
		unset($_SESSION['error']);
		
	
		foreach ($_POST as $k => $v ){
			$$k =  addslashes(trim($v ));
			$_SESSION['biz_reggg'][$k]=$v;
		}
		//print_r($_SESSION['biz_reg']); exit;
	$flgs = false;
			if ( isset($_FILES['logo']['tmp_name'])) 
		{ 
			
			
			@mkdir (ABSPATH.'media/buisness_images/' .$bId.'/' ,0777) ;
			@mkdir (ABSPATH.'media/buisness_images/' .$bId.'/logo/' , 0777);
			@mkdir (ABSPATH.'media/buisness_images/' .$bId.'/logo/thumb/', 0777);
			$upload_dir = ABSPATH.'media/buisness_images/' .$bId.'/logo/';
			$thutt_folder = ABSPATH.'media/buisness_images/' .$bId.'/logo/thumb/';
			$logo ='';			
			@chmod($upload_dir,0777);
			@chmod($thutt_folder,0777);
			$ext= array ('gif','jpg','jpeg','png','bmp');			
			$companylogo = "logo"; 
		
			$file_type=$_FILES[$companylogo]['type'];   			
			if(!empty($_FILES[$companylogo]['name'])){
				$upload = new upload($companylogo, $upload_dir, '777', $ext);
				//echo $upload; exit;
				if ($upload->message =="SUCCESS_FILE_SAVED_SUCCESSFULLY" ){
					$logo=$upload->filename;
					//echo $logo; exit;
					require_once(ABSPATH.'phpThumb/phpthumb.class.php');
					$phpThumb = new phpThumb();
					$thumbnail_width = 120;
					$phpThumb->setSourceFilename($upload_dir.$logo);
					$output_filename = $thutt_folder.$logo;
					//echo $output_filename; exit;
					$phpThumb->setParameter('w', $thumbnail_width);
					//echo "mehran".$phpThumb; exit;
					if ($phpThumb->GenerateThumbnail()) { // this line is VERY important, do not remove it!
						if ($phpThumb->RenderToFile($output_filename)) {}
					}
					//$insQry ="UPDATE tt_business SET logo ='$logo' WHERE `userId` = '$userId'";	
					//mysql_query($insQry)or die (mysql_error());
				}else{
					$_SESSION["biz_reg"]["logo"] = "Error: Upload an Image file.";
				}	
			}

			if ( $logo) $logo ="logo = '$logo', ";
	}
		
			
			
	$flgs = false;
	///////////////////////email validation///////////
	if( ($email=='') and (!filter_var($email, FILTER_VALIDATE_EMAIL)) ){
		
			$_SESSION['biz_reg_err']['email'] = 'Please enter valid email';
			$flgs = true;

	}

  
	
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
	/*if($address2!='')
	{
		if( checkSwear($address2) ){
			$_SESSION['error']['address2'] = 'Swearing is not tolerated on Address 2';
			$flgs_error = true;
		}
	}*/

	
	
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
	}
	
	
		if(!empty($sub_domain)){
$rsVU =mysql_query("select count(*) as uc from tt_business where sub_domain like '$sub_domain' AND `userId` <> '".$userId."' "); 
	$rowUV = mysql_fetch_array($rsVU);
	if ( $rowUV['uc']> 0 ){// return true; else return false;
		$_SESSION['error']['sub_domain'] = 'Not available';
		$flgs = true;
		}
	}

	
	
	/*elseif (VerifyDB_Domain($sub_domain)){
		$_SESSION['error']['sub_domain'] = 'Not available';
		$flgs = true;
	}*/
	/*elseif(verifyDomain($sub_domain))
	{
		$_SESSION['error']['sub_domain'] = 'Sub-domain can only contain 3-30 alphanumerics and dash(-)';
		$flgs = true;
	}*/
	
	/**/
	if( checkSwear($sub_domain) ){
		$_SESSION['error']['sub_domain'] = 'Swearing is not tolerated on domain name';
		$flgs = true;
	}

	
/*   if($userId!='')
	{
		$SQL_act = "SELECT userId FROM tt_business WHERE userId =$userId ";
		$rs_row		= $db->get_row($SQL_act, ARRAY_A);	
		if($rs_row){
		$_SESSION['biz_reg_err']['userId'] = 'Trader already has a business connected to his/her name.';
		$flgs = true;
		}
	}
*/		
if($flgs_error)
  {
	
		header('location:'.$ruadmin.'home.php?p=editbusiness&bId='.$bId); exit;
		}

  if($flgs)
  {
	
		header('location:'.$ruadmin.'home.php?p=editbusiness&bId='.$bId); exit;
		
  }else{
  		
		/*$address1 = $address.', '.$city.', '.$state.' '.$postcode;
		$address1 = urlencode(stripslashes($address1));
$location = file("http://maps.google.com/maps/geo?q=$address1&output=csv&key=ABQIAAAAseZREdN_Nhlhj3sI93ilyxTFXeOqGzGS-9SJmCfgnHR3mTEJHhRuMkQOalyVjsE-xUFm8qTB35bSXQ");
list ($stat,$acc,$Latitude,$Longitude) = explode(",",$location[0]);*/



$addressbuss = "";

		if($address != ''){
			$addressbuss .= ", ".$address;
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








$keywords = keywordsclean($keywords);


//+++++++++++++++++++++++++ this code is used for category and time 

 $sql_mcat = "SELECT * from tt_category where `catid` = '$industry' AND `cat_type` = '1'";
	$result_mcat = @mysql_query($sql_mcat);
	$row_mcat = mysql_fetch_array($result_mcat);
	$industryy = addslashes($row_mcat['cat_name']);
	$sub_cat = '';
	$scatids2 .= '';
	if(count($scatids)>0){
	//echo "mehrta "; //exit;
		foreach($_POST['scatids'] as $scatid)
		{
		
		 	$sql_scat = "SELECT * FROM `tt_category` WHERE `catid` = '$scatid' AND `p_catid` = '$industry' AND `cat_type` = '1'"; 
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
	
	 	 
	 // ++++++++++++ the end category and sub category code
	 $daysArr = array('sun'=>'sunday','mon'=>'monday','tue'=>'tuesday','wed'=>'wednesday','thu'=>'thursday','fri'=>'friday','sat'=>'saturday');
	 $timeing_str = '';
		foreach($daysArr as $short=>$long){
			$timeing_str .= $short."_oc = '".$_POST[$short.'_oc']."',
							".$short."_f = '".$_POST[$short.'_frm_hr'].':'.$_POST[$short.'_frm_min']." ".$_POST[$short.'_frm_ampm']."', 
							".$short."_t = '".$_POST[$short.'_to_hr'].':'.$_POST[$short.'_to_min']." ".$_POST[$short.'_to_ampm']."', ";
		}






//+++++++++++++++++++++++++ the end of category and time code
 $insQry2 ="Update tt_business set 	name ='$name',
									description ='$description',
									industry='$industryy',
									subcat='$sub_cat',
									address ='$address',
									city ='$city',
									state ='$state',
									zip ='$zip',
									phone ='$phone',
									tracked_phone='$mobile',
									meta_title= '$meta_title',
									meta_description='$meta_description',
									keywords ='$keywords',
									email ='$email',
									 $logo
									status ='$status',
									userId ='$userId',
									 $timeing_str
									dated =now(),
									mcatid = '$industry',
									scatids = '$scatids2',
									latitude ='$Latitude',
									longitude ='$Longitude',
									sub_domain='$sub_domain',
									video_embed='$video_embed'
					where locationid =$bId";
					//phone ='$phone2',
					//btype = '$btype',
					//ltype = '$ltype',
  		mysql_query($insQry2)or die (mysql_error());

		/*if($userId!=1 && $userId!=0){
			$updatestatus ="Update tt_user set type ='b' where userId = $userId";
	  		mysql_query($updatestatus)or die (mysql_error());
		}*/
		unset($_SESSION['biz_reg_err']);
		unset($_SESSION['biz_reggg']);
		$_SESSION['biz_reg_err']['business_add'] = 'Company Updated Successfully!';
		header('location:'.$ruadmin.'home.php?p=editbusiness&bId='.$bId); exit;
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
		header('location:'.$ruadmin.'home.php?p=business_edit_step2&bId='.$bId); exit;
		
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
		header('location:'.$ruadmin.'home.php?p=business_edit_step3&bId='.$bId);
		exit;
		} else{
		header('location:'.$ruadmin.'home.php?p=business_edit_step2&bId='.$bId);
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
		header('location:'.$ruadmin.'home.php?p=business_edit_step2&bId='.$bId); exit;
		
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

		header('location:'.$ruadmin.'home.php?p=business');

  }
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