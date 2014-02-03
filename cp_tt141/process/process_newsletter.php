<?php 
require_once("../../connect/connect.php");
require_once("../security.php");
require_once ('../inc/functii.php');



if ( isset ($_POST['SaveTextData'])){

	unset($_SESSION['newsletter_err']);
	unset($_SESSION['newsletter']);
	
	foreach ($_POST as $k => $v )
	{
		$$k =  addslashes(trim($v ));
		$_SESSION['newsletter'][$k]=$v;
	
	}
	$flgs = false;
	///////////////////////email validation///////////
		
	if($subject=='')
	{
		$_SESSION['newsletter_err']['subject'] = 'Please enter valid subject';
		$flgs = true;
	}
	if($mailfrom=='')
	{
		$_SESSION['newsletter_err']['mailfrom'] = 'Please enter valid from email address';
		$flgs = true;
	}
	if($message=='')
	{
		$_SESSION['newsletter_err']['message'] = 'Please enter valid message';
		$flgs = true;
	}
	   	  
	  
	  
  if($flgs)
  {
	
	header('location:'.$ruadmin.'home.php?p=newsletter'); exit;
  }else{
  		
  		
		echo $insQry ="insert into tt_news_letters set 	mailfrom ='$mailfrom',	message='".$message."',status = '$status',subject = '$subject', dated =now()";
  		mysql_query($insQry)or die (mysql_error());
		unset($_SESSION['newsletter_err']);
		unset($_SESSION['newsletter']);
		$_SESSION['newsletter_err']['added'] = 'Newsletter Added Successfully!';
		header('location:'.$ruadmin.'home.php?p=newsletter'); exit;
  }
}

if ( isset ($_POST['updateTextData'])){

	unset($_SESSION['newsletter_err']);
	unset($_SESSION['newsletter']);
	
	foreach ($_POST as $k => $v )
	{
		$$k =  addslashes(trim($v ));
		$_SESSION['newsletter'][$k]=$v;
	
	}
	$flgs = false;
	///////////////////////email validation///////////
		if($subject=='')
	{
		$_SESSION['newsletter_err']['subject'] = 'Please enter valid subject';
		$flgs = true;
	}
	if($mailfrom=='')
	{
		$_SESSION['newsletter_err']['mailfrom'] = 'Please enter valid from email address';
		$flgs = true;
	}
	if($message=='')
	{
		$_SESSION['newsletter_err']['message'] = 'Please enter valid message';
		$flgs = true;
	}
	   	  
	  
	  
  if($flgs)
  {
	
	header('location:'.$ruadmin.'home.php?p=newsletter&nid='.$userId); exit;
  }else{
  		
		$insQry ="Update tt_news_letters  set 	mailfrom ='$mailfrom',	message='".$message."',status = '$status',subject = '$subject', dated =now()	where nl_id =$nl_id";
  		mysql_query($insQry)or die (mysql_error());
		unset($_SESSION['newsletter_err']);
		unset($_SESSION['newsletter']);
						
		$_SESSION['newsletter_err']['updated'] = 'Newsletter Updated Successfully!';
		header('location:'.$ruadmin.'home.php?p=newsletter&nid='.$nl_id); exit;
  }
}
/////////////////////////Delet newsletters//////////////////////////////////////////////////////
if ( isset ($_GET['nid']) && $_GET['action']=='d'){

	$nid=$_GET['nid'];
	$sql = "DELETE FROM tt_news_letters where nl_id =$nid";
	if(mysql_query($sql))
	{
		$_SESSION['statuss']='Newsletters  deleted successfully';
		header("location:".$ruadmin."home.php?p=newslettersmanage&page=".$_GET['page']);
		exit;
	}
	exit;
}
/////////////////////////send newsletters//////////////////////////////////////////////////////
if ( isset ($_GET['nid']) && $_GET['action']=='mail'){

	$nid=$_GET['nid'];
	$qry="select * from  tt_news_letters  where nl_id =$nid";
	
	$rs=mysql_query($qry);
	$row =mysql_fetch_array($rs);
	 
	$subject=$row['subject'];
	$message=$row['message'];
	$mailfrom = $row['mailfrom'];
	
	if(trim($mailfrom)==''){
		$mailfrom='info@TradesTool.co.uk';
	}
	
	$sql = "SELECT * FROM  tt_news_letter ";
	$result = @mysql_query($sql);
	$rec = array();
	while( $row = @mysql_fetch_array($result) )
	{
		$email = $row['email'];	
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Additional headers
		$headers .= 'To: <' . $email . '>' . "\r\n";
		$headers .= 'From: TradesTool.co.uk <'.$mailfrom.'>' . "\r\n";

		// Mail it
		mail($email, $subject, $message, $headers);
		unset($headers); 
		//sleep(1);
		//echo $email."<br>".$subject."<br>".$BODY."<br>".$headers;
	}

	
	$_SESSION['statuss']='Newsletters  sent successfully';
	header("location:".$ruadmin."home.php?p=newslettersmanage&page=".$_GET['page']);
	exit;
}
?>