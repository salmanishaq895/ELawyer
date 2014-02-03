<?php 
include("../connect/connect.php");
include("../common/function.php");
//echo "dsfsdf"; exit;

if ($_GET['ajax']=='yes')
{
	$user_IP = $_SERVER['REMOTE_ADDR'];
	//echo $user_IP; exit;
	//echo $_GET['userId']; exit;
	$sql_email	=	"select * from tt_shortlist_temp where ip='".$user_IP."' AND bId = '".$_GET['bId']."'";
	//exit;
	$rs_row	= mysql_query($sql_email);
	if(mysql_num_rows($rs_row) == 0){
		$sql_count  = "select count(shortlist_id) as id from tt_shortlist_temp where ip='".$user_IP."'";
		$result_count = mysql_query($sql_count);
		$row_count  = mysql_fetch_array($result_count);
		if($row_count[0]>10){
		 	echo "greater"; exit;
		}else{
			$insQry = "insert into tt_shortlist_temp set ip = '".$user_IP."', bId='".$_GET['bId']."', date_added = NOW()"; 
			mysql_query($insQry) or die (mysql_error());
			echo "done";exit;
		}
	}else{
		echo "already";exit;
	}
	
}
if ($_GET['p']=='delete'){
	$sql_email	=	"delete from tt_shortlist where bId = '".$_GET['bId']."'";
	mysql_query($sql_email) or die (mysql_error());
	echo "done";exit;
}
?>