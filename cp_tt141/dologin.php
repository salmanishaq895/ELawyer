<?php
	ob_start();	
	include ("../connect/connect.php");			
	
	
	
	if ( isset ($_POST['login'])) 
	{
		if (empty($_POST['name']) || empty($_POST['password']))
		{
			$msg=base64_encode('Please enter User and Password to continue.');
			header("location:".$ruadmin."index.php?msg=$msg");exit;
		}
		/*if (empty($_POST['pincode']))
		{
			$msg=base64_encode('Please enter Security Code to continue.');
			header("location:".$ruadmin."index.php?msg=$msg");exit;
		}/*elseif (strtolower($_POST['pincode']) != strtolower($_SESSION['security_code']))
		{
			 echo $_SESSION['security_code'];
			
			$msg=base64_encode('Entered Security Code is Invalid.');
			
			header("location:".$ruadmin."index.php?msg=$msg");exit;
		}*/
		$name =  addslashes(trim($_POST['name']));
		$password =  addslashes(trim($_POST['password']));
		//echo $name;exit;
		$qry="SELECT userId,firstname,lastname,email,username,phone,type ,status,	dated  FROM tt_user where ( email  =  '".$name."' or  username = '".$name."') and password='".md5($password)."' ";
		//echo $qry;exit;
		$rs = @mysql_query($qry);
		if ( @mysql_num_rows($rs)> 0 ) 
		{
			
			
			$rowAdmin = mysql_fetch_array($rs);
			if( $rowAdmin['status'] != 'Active' ){
				//echo "Active";exit;
				$msg=base64_encode('Account disabled !');
				header("location:".$ruadmin."index.php?msg=$msg");exit;
			}
			
			$_SESSION['cp_tt'] = $rowAdmin;
			//exit;
			$upsql = "update tt_user set loginlogout=now() where  userId =".$_SESSION['cp_tt']['userId']." ";
			mysql_query($upsql)or die (mysql_error());
			$_SESSION['adminLogincoupon']='True';
			
			header("location:".$ruadmin."home.php");exit;

		}else{
		
			$msg=base64_encode('Invalid user name or password !');
			header("location:".$ruadmin."index.php?msg=$msg");exit;
		}
	}else{
		header("location:".$ruadmin."index.php");exit;
	}
?>