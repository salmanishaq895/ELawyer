<?php
if (  $_SESSION['cp_tt']['type'] != 'a' )
{	
	session_destroy();
	$msg=base64_encode('your session have been expired, Please login!');
	header('location:'.$ruadmin.'index.php?msg='.$msg);
}
?>