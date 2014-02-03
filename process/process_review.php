<?php
include('../connect/connect.php');
include('../connect/functii.php');
foreach ($_POST as $k => $v )
{
	$$k =  addslashes(trim($v ));
} 

$userId = $_SESSION['TTLOGINDATA']['USERID'];
$flgs = false;
if(isset($_POST['SaveReview']))
{

// ____________++++++++++++++++ this validat is used for Description swear word
	$str_review = explode(' ',$review);
				$review_qry = '';
			if(count($str_review)>0){
				foreach($str_review as $st_review){
					//$st_description = trim($st_description);
					if(!empty($st_review)){
					//echo "dfsd"; exit;
						if(empty($review_qry)){
							$review_qry = " WHERE `word` LIKE '$st_review'";
						}else{
							$review_qry .= " OR `word` LIKE '$st_review'";
							//echo $description_qry; exit;
						}
					}
				}
			}
			//if(strlen($str_qry)>5){
				$sql_review = "SELECT * FROM `tt_swear_words` ".$review_qry; // exit;
				$result_review = @mysql_query($sql_review);
				if(mysql_num_rows($result_review) > 0 ){
					//echo 'swear';exit;
					 $_SESSION['review_error']['review'] = 'Swearing is not tolerated on review'; //exit;
					$flgs = true;
				}
//}
	
	
	// __________++++++++++++++++++++ the end of Description swear word
	
	if(strlen($review)<=5)
	{
		$_SESSION['review_error']['review'] = 'Please enter review before submit';
		$flgs = true;
	}
	if( strtolower($pincode) != strtolower($_SESSION['tt_security_code']))
	{
		$_SESSION['review_error']['pincode'] = 'Please provide valid security code';
		$flgs = true;
	}
	unset($_SESSION['tt_security_code']);
	
	if($flgs){
		header("location:".$ru."inc/writereview.php?bId=".$bId);exit;
	}
	$insert_review ="Insert into  tt_business_reviews set 	
		bId ='$bId', userId	= '$userId', review = '$review',
		rating ='$rating',expirtise='$ratinge',cost='$rating2',schedule='$rating3',response='$rating4',professional='$rating5', date_added  = ".time()."";
		$db->query($insert_review);
		echo '<div style=" background-color:#E1E1E1; font-size:18px; padding:66px 0px 191px 95px"> Thanks for your review! </div>';
		
		//$insert_business = "select review_count from tt_business where locationid= '".$bId."'";
		$SQL_act = "select count(reviewId) as rowcount from tt_business_reviews where bId= '".$bId."'";

	 $rs_row		= $db->get_row($SQL_act, ARRAY_A);	
		
		$varr = $rs_row['rowcount'];
		$update = "update tt_business set review_count = '".$varr."' where locationid='".$bId."'";
		$db->query($update);
		
		//header('location:'.$ru.'writereview'); 
		exit;
}
if(isset($_POST['SaveReport']))
{
	if(strlen($review)<=5)
	{
		$_SESSION['review_error']['review'] = 'Please enter Report before submit';
		$flgs = true;
	}
	if( strtolower($pincode) != strtolower($_SESSION['tt_security_code']))
	{
		$_SESSION['review_error']['pincode'] = 'Please provide valid security code';
		$flgs = true;
	}
	unset($_SESSION['tt_security_code']);
	
	if($flgs){
	//echo "<pre>"; print_r($rId); exit;
		header("location:".$ru."inc/report_review.php?rId=".$rId);exit;
	
	}
	$insert_review ="Insert into tt_review_error set 
		reviewId ='$rId', description = '$review',
		 date_added  = now()";
		$db->query($insert_review);
		echo '<div style=" background-color:#E1E1E1; font-size:18px; padding:66px 0px 191px 95px"> Thanks for your Report! </div>';
		//header('location:'.$ru.'writereview'); 
		exit;
}
?>