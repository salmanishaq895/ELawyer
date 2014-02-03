<?php
include('../connect/connect.php');
include('../connect/functii.php');
foreach ($_POST as $k => $v )
{
	$$k =  addslashes(trim($v ));
} 

$qry = "insert into   `tt_messages` set message  = '".$msg."' ,
											 
									    `title`  = 'Message From Trader' , 
										`from`  = '".$from_id."' , 
										`to`  = '".$to_id."' , 
										`jobId`  = '".$job_id."' , 
										`from_viewed`  = '0' , 
										`to_viewed`  = '0' , 
										`from_deleted`  = '0' , 
										`to_deleted`  = '0' , 
										`created`  = NOW() , 
										`message_frm`  = 'Trader' ";

										


$exe_qry = mysql_query($qry);

$_SESSION['key_services_msg'] = 'Message Sent Successfully!';
header('location:'.$ru.'member/applied_job/');
exit;

?>