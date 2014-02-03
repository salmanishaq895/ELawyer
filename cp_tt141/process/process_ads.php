<?php 
require_once("../../connect/connect.php");
require_once("../security.php");
require_once ('../inc/functii.php');
include ("upload.php");
unset($_SESSION['ads_reg_err']);
unset($_SESSION['ads_reg']);
 $adminUserId = $_SESSION['cp_tt']['userId'];

if ( isset ($_GET['action'])  and  ($_GET['action']=='d'))
{
			
	$adsid  =$_GET['adsid'];
	$rdir = 'home.php?p=ads';
	
	$biz_Sql = "select * from ads where adsid  = $adsid ";
	$biz =mysql_query($biz_Sql);
	if (mysql_num_rows($biz) == 0) {header('location:'.$rdir);exit;}
	
	
	$biz_Sql = "delete from ads where adsid  = $adsid ";
	
	if( $biz =mysql_query($biz_Sql) ){
		$_SESSION['msg'] = 'Ads deleted !';				
	
	} 
	header('location:'.$rdir );exit;}

foreach ($_POST as $k => $v )
{
	$$k =  addslashes(trim($v ));
	$_SESSION['ads_reg'][$k]=$v;

}


if ( isset ($SaveBusiness)){

	
			$banner ='';
			$path_to_folder= '../banners/'; 
			chmod($path_to_folder,0777);	
			$ext= array ('gif','jpg','jpeg','png','bmp','GIF','JPG','JPEG','PNG','BMP');
			
			$companyadsbanner = "banner"; 
		
			$file_type=$_FILES[$companyadsbanner]['type'];   
			
			if(!empty($_FILES[$companyadsbanner]['name']))
			{
				$upload = new upload($companyadsbanner, $path_to_folder, '777', $ext);
				if ($upload->message =="SUCCESS_FILE_SAVED_SUCCESSFULLY" )
				{
					// $filepath=$path_to_folder.$_FILES[$companyadsbanner]['name'];					@unlink($filepath);
					$banner=$upload->filename;
						
				}else{
					$_SESSION["ads_reg"]["banner"] = "Error: Upload a banner file.";
				}	
			}
			if ( $banner) $banner ="banner = '$banner', ";
	
			
			
	$flgs = false;
	///////////////////////email validation///////////
	if( trim($title=='') ){
			$_SESSION['ads_reg_err']['title'] =  "Please enter valid ads title";
			$flgs = true;
	}
	if( trim($title=='') ){
			$_SESSION['ads_reg_err']['advertiser'] =   "Please enter valid advertiser";
			$flgs = true;
	}
	if( trim($url=='') ){
			$_SESSION['ads_reg_err']['url'] =   "Please enter valid url";
			$flgs = true;
	}
	if( trim($startdate=='') ){
			$_SESSION['ads_reg_err']['startdate'] =   "Please enter valid start date";
			$flgs = true;
	}
	if( trim($enddate=='') ){
			$_SESSION['ads_reg_err']['enddate'] =  "Please enter valid end date";
			$flgs = true;
	}
	if( trim($balance=='') ){
			$_SESSION['ads_reg_err']['balance'] =  "Please enter valid balance";
			$flgs = true;
	}
	if( trim($ppc=='') ){
			$_SESSION['ads_reg_err']['ppc'] =  "Please enter valid ppc";
			$flgs = true;
	}
	
	  
  if($flgs)
  {
	
		header('location:'.$ruadmin.'home.php?p=adsadd'); exit;
		
  }else{
  		
	$url = str_replace('http://','',$url);
	$url = 'http://'.$url;
 $insQry ="insert into ads set 	title ='$title',
									advertiser ='$advertiser',
									size ='$size',
									url ='$url',
									startdate ='$startdate',
									enddate ='$enddate',
									billingtype ='$billingtype',
									balance ='$balance',
									totalbalance ='$balance',
									 $banner
									status ='$status',
									createdby ='$adminUserId',
									ppc ='$ppc',
									dated =now()";
  		mysql_query($insQry)or die (mysql_error());
		unset($_SESSION['ads_reg_err']);
		unset($_SESSION['ads_reg']);
		$_SESSION['ads_reg_err']['addads'] = 'Ads Added Successfully!';
		header('location:'.$ruadmin.'home.php?p=ads'); exit;
  }
  }

if ( isset ($UpdateBusiness)){

	
			$adsbanner ='';
			$path_to_folder= '../banners/'; 
			chmod($path_to_folder,0777);	
			$ext= array ('gif','jpg','jpeg','png','bmp','GIF','JPG','JPEG','PNG','BMP');
			
			$companyadsbanner = "adsbanner"; 
		
			$file_type=$_FILES[$companyadsbanner]['type'];   
			
			if(!empty($_FILES[$companyadsbanner]['name']))
			{
				$upload = new upload($companyadsbanner, $path_to_folder, '777', $ext);
				if ($upload->message =="SUCCESS_FILE_SAVED_SUCCESSFULLY" )
				{
					// $filepath=$path_to_folder.$_FILES[$companyadsbanner]['name'];					@unlink($filepath);
					$adsbanner=$upload->filename;
						
				}else{
					$_SESSION["ads_update_err"]["banner"] = "Error: Upload an Image file.";
				}	
			}
			if ( $adsbanner) $adsbanner ="adsbanner = '$adsbanner', ";
	
			
			
	$flgs = false;
	///////////////////////email validation///////////
	if( trim($title=='') ){
			$_SESSION['ads_update_err']['title'] =  "Please enter valid ads title";
			$flgs = true;
	}
	if( trim($title=='') ){
			$_SESSION['ads_update_err']['advertiser'] =   "Please enter valid advertiser";
			$flgs = true;
	}
	if( trim($url=='') ){
			$_SESSION['ads_update_err']['url'] =   "Please enter valid url";
			$flgs = true;
	}
	if( trim($startdate=='') ){
			$_SESSION['ads_update_err']['startdate'] =   "Please enter valid start date";
			$flgs = true;
	}
	if( trim($enddate=='') ){
			$_SESSION['ads_update_err']['enddate'] =  "Please enter valid end date";
			$flgs = true;
	}
	if( trim($balance=='') ){
			$_SESSION['ads_update_err']['balance'] =  "Please enter valid balance";
			$flgs = true;
	}
	if( trim($ppc=='') ){
			$_SESSION['ads_update_err']['ppc'] =  "Please enter valid ppc";
			$flgs = true;
	}
	
	
  if($flgs)
  {
	
		header('location:'.$ruadmin.'home.php?p=adsedit&adsid='.$adsid); exit;
		
  }else{
	$url = str_replace('http://','',$url);
	$url = 'http://'.$url;  		
 $insQry ="Update ads set 	title ='$title',
									advertiser ='$advertiser',
									size ='$size',
									url ='$url',
									startdate ='$startdate',
									enddate ='$enddate',
									billingtype ='$billingtype',
									balance ='$balance',
									totalbalance ='$balance',
									 $adsbanner
									status ='$status',
									createdby ='$adminUserId',
									ppc ='$ppc'
					where adsid =$adsid";
  		mysql_query($insQry)or die (mysql_error());
		unset($_SESSION['ads_update_err']);
		unset($_SESSION['ads_update']);
		$_SESSION['ads_update_err']['addads'] = 'Ads Updated Successfully!';
		header('location:'.$ruadmin.'home.php?p=adsedit&adsid='.$adsid); exit;
  }
}
?>