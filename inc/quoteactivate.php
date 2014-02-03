<?php 
if ( isset ($_GET['page']) and ( trim( $_GET['page']) != '') )
{ 
//echo "<pre>".$_GET; exit;
	//$userId = base64_decode($_REQUEST['s']);
	$sql_business = "select bId, count(bId) as tot from tt_business_reviews 
group by bId order by tot desc limit 0,5
";
$result_business  = mysql_query($sql_business);
	
	$row_business  = mysql_fetch_array($result_business);
	  if(count($row_business)>0)
	  {
	  foreach($row_business as $rs_business)
	  {
	
	
	$sql_email  ="select * from tt_business where status='1' AND locationid='".$rs_business['bId']."'"; 
			$result_email  = mysql_query($sql_email);
			$row_email = mysql_fetch_array($result_email);
			//echo "<pre>"; print_r($row_email); exit;
			//foreach($row_email as $rs_email)
			//{
	  
	$email = $row_email['email'];
	//echo $email1; exit;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From:'.$email. "\r\n";
		
		$msg  = "Name: ".$name;
		$msg .= '<br/>Email: '.$email;
		//$msg .= '<br/>Phone: '.$phone;
		$message = stripslashes($Message);
		$msg .= '<br/>Message:<br/>'.nl2br($message);
		
		$subject = "TradesTools - Contact Message from visitor";

		
		mail($email, $subject, $msg, $headers);
		//}
			}
				}
}
?>	
<div class="main_quote_bar_b main_quote_bar_c">
  <div class="map_page_right_bar terms_condition_bar">
    <div class="brued_crum_bar brued_crum_bar_c">
      <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Home</a> >  <a href="<?php echo $ru;?>quoteactivate" style="text-decoration:none; color:#999999;"> <span class="change">Quotes Completed</span> </a></span> </div>
    </div>
    <div class="profile_page_left">
      <div class="company_detail_description"> <span class="company_detail_span">Quotes Completed</span>
        <p class="company_detail_description company_detail_description_p_b"> Congratulations,Your Quotes is posted.<br /> You can add other quotes.</p>
      </div>
    </div>
  </div>
</div>