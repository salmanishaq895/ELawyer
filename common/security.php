<?php 
if(!isset($_SESSION['TTLOGINDATA']['ISLOGIN']) and $_SESSION['TTLOGINDATA']['ISLOGIN'] != 'yes')
{
	header("location:".$ru);exit;
}
?>