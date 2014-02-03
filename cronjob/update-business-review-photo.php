<?php
include("../connect/connect.php");
$sql_business  = "select locationid from tt_business";
$result_business  = mysql_query($sql_business);
while($rs_business = mysql_fetch_array($result_business))
{
	
	//$sql_photo  = "select count(id) as  from tt_business_photo where bId= '".$rs_business['locationid']."'" 
	$SQL_act = "select count(id) as rowcount from tt_business_photo where bId= '".$rs_business['locationid']."'";		
	$rs_row		= $db->get_row($SQL_act, ARRAY_A);			
	$varr = $rs_row['rowcount'];
		
	$SQL_review = "select count(reviewId) as rowcount from tt_business_reviews where bId= '".$rs_business['locationid']."'";
	
	 $rs_review		= $db->get_row($SQL_review, ARRAY_A);	
		
	$var = $rs_review['rowcount'];
		
		$update = "update tt_business set photoCount = '".$varr."',review_count = '".$var."' where locationid='".$rs_business['locationid']."'";
		$db->query($update);
	

}



 ?>