<?php 
require_once("../../connect/connect.php");
require_once("../security.php");
require_once ('../inc/functii.php');

foreach($_REQUEST as $key=>$val) $$key=$val;

//prnt($_GET);
//prnt($_POST);
		 
if(isset($action) && $action=='del'){

	$sql = "DELETE FROM tt_images where image_id=".$imgid;
	$db->query($sql);
	$_SESSION['statuss']='State Deleted successfully';
	header("location:".$ruadmin."home.php?p=manage_image");
	exit;
}

if( isset ($addimage)){	
  if($title!=''){
	include ("../inc/upload.php");
	unset($_SESSION['image_err']);
	unset($_SESSION['image_update']);
	foreach ($_POST as $k => $v )
	{
		$$k =  addslashes(trim($v ));
		 $_SESSION['image_update'][$k]=$v; 
	}
	if ( isset($_FILES['photo']['tmp_name'])) 
			{ 
				$rewardphoto ='';			
				$upload_dir = $rootpath.'media/carimages/';
				chmod($upload_dir,0777);	

				$ext= array ('gif','png');			
               
				 $file_type=$_FILES['photo']['type']; 		
				if(!empty($_FILES['photo']['name']))
				{ 
					$upload = new upload('photo', $upload_dir, '777', $ext);
					if ($upload->message =="SUCCESS_FILE_SAVED_SUCCESSFULLY" )
					{ 
						$rwdphoto=$upload->filename;	
						$rewardphoto =" photo ='".$rwdphoto."', ";	
						
					$sql= "insert into tt_images set $rewardphoto 	title ='".$title."' " ;

						if($db->query($sql))
						{
							$_SESSION['image_err'] = "Image uploaded successfuly "; 
							header('location:'.$ruadmin.'home.php?p=manage_image');
							exit;
				
						}
		
					}else{
						$_SESSION["image_err"]["photo"] = "Error: Upload an Image file.";
					}	
				}
			}
		}else{
			$_SESSION['image_err']= "Please enter title.";
			header("location:".$ruadmin."home.php?p=manage_image");
			exit;
		}	
	}


?>