<?php
include_once("../connect/connect.php");
$bId	=	$_GET['bId'];
 $sql_review		=	"select * from tt_business where locationid='$bId'";
//exit;
$rs_business	=	$db->get_row($sql_review,ARRAY_A);
echo "<marker>\n";
if(count($rs_business)>0){
foreach($rs_business as $res)
{

		echo "\t"."<marker name='".$res['name']."' phoneNumber='" . $res['phone'] . "'  address='".$res['address']."' lng='".$res['longitude']."' lat='".$res['latitude']."' />"."\n";
	}
}
echo "</marker>\n";
?>