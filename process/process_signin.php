<?php 
if($_POST['login'])
{
	require_once("../connect/connect.php");
	require_once("../common/function.php");

	$username =  $_POST['loginEmail'];
	$password =  md5($_POST['password']);
	if ( isset($_POST['page'])){
		$page = trim($_POST['page']);		
	}
	if(isset($_POST['retpage']))
		$retpage = $_POST['retpage'];
	else
		$retpage = 'signin';
	
	
	if ( isset ($_POST['pageData'])){
		$page =$page .'/'. trim($_POST['pageData']);
		if(isset($_POST['pageOption']))
		{
			$_SESSION['showDialog'] = 'yes';
			$page =$page .'/'. trim($_POST['pageOption']);
		}
	}
	$res_login = mysql_query("select * from tt_user where email = '".$username."' and password = '".$password."'");
	if(mysql_num_rows($res_login) == 1)
	{
		$row_login = mysql_fetch_array($res_login);
		if($row_login['status'] == 'Active')
		{
			$_SESSION['TTLOGINDATA']['ISLOGIN'] = 'yes';
			$_SESSION['TTLOGINDATA']['EMAIL'] = $row_login['email'];
			$_SESSION['TTLOGINDATA']['NAME'] = $row_login['firstname'];
			$_SESSION['TTLOGINDATA']['LNAME'] = $row_login['lastname'];
			$_SESSION['TTLOGINDATA']['USERID'] = $row_login['userId'];
			$_SESSION['TTLOGINDATA']['TYPE'] = $row_login['type'];
			$_SESSION['TTLOGINDATA']['lati'] = $row_login['latitude'];
			$_SESSION['TTLOGINDATA']['long'] = $row_login['longitude'];
			
			if ( isset ($_POST['keepmelogedin'])){
				setcookie("USERID", $row_login['userId'], time()+(60*60*24*260),'/'); 
			}
			
			if( isset($page) and ($page != 'signin') ){	
				$redirectPage = $ru.$page;
				//header("location:".$ru.$page);exit;
			}elseif(isset($_SESSION['redirectPage']) and ($_SESSION['redirectPage'] != $ru.'signin') and ($_SESSION['redirectPage'] != $ru.'signup') and ($_SESSION['redirectPage'] != $ru.'complete_signup')){
				$redirectPage = $_SESSION['redirectPage'];
				unset($_SESSION['redirectPage']);
				//header("location:".$redirectPage);exit;
			}
			if($_SESSION['TTLOGINDATA']['TYPE']=='c'){
				//___________++++++++++++++ this code is used for the shorlist converter 	
				$ip = $_SERVER['REMOTE_ADDR'];
				$sql_shortlist_temp	= "SELECT * FROM tt_shortlist_temp WHERE ip='$ip'";
				$result_shortlist_temp = mysql_query($sql_shortlist_temp);
				while($row_shortlist_temp = mysql_fetch_array($result_shortlist_temp)){
					$qry_short_count = mysql_query("SELECT * FROM `tt_shortlist` WHERE userId='".$_SESSION['TTLOGINDATA']['USERID']."'");
					if(mysql_num_rows($qry_short_count)<10){
						$sql_shortlist  =  "INSERT INTO tt_shortlist SET bId='".$row_shortlist_temp['bId']."',userId='".$_SESSION['TTLOGINDATA']['USERID']."',date_added='".$row_shortlist_temp['date_added']."'";
						mysql_query($sql_shortlist);
					}
				}
				mysql_query("delete from tt_shortlist_temp where ip='".$ip."'");
				// ___________++++++++++++++++++ the end of shortlist converter
				if($_SESSION['quote_save_data']){
					saveJob($_SESSION['TTLOGINDATA']['USERID'],true);
					header( "location:".$ru.'quote_finish/' );exit;
				}
				if(!isset($redirectPage))
					$redirectPage = $ru."member.php";
				//header("location:".$ru."member/profile");exit;
			}else{
				if(!isset($redirectPage))
					$redirectPage = $ru."member/statistics";
			}
			header("location:".$redirectPage);exit;
		}
		elseif($row_login['status'] == 'Pending'){
			$_SESSION["login"]["error"] = 'Please activate your account before login';
			header("location:".$ru.$retpage.'/'.$page);exit;
		}else{
			$_SESSION["login"]["error"] = 'Your account has been blocked, Please contact admin';
			header("location:".$ru.$retpage."/".$page);exit;
		}
	}
	else
	{
		$_SESSION["login"]["error"] = 'Invalid login information';
		header("location:".$ru.'signin.php');exit;
	}
}

?>