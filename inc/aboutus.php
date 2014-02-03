<?php
	$query_cms = "SELECT * FROM tt_cms WHERE type = 'aboutus' " ; 
	$rs_cms = $db->get_row($query_cms, ARRAY_A);	
	if($rs_cms){
		$htmldata = stripslashes($rs_cms['body']);
	}
?>
<div class="main_quote_bar_b main_quote_bar_c">
	<div class="map_page_right_bar terms_condition_bar">
		<div class="brued_crum_bar brued_crum_bar_c">
			<div class="listing_page_brued_crum">
				<span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Home</a> > <a href="<?php echo $ru;?>aboutus" style="text-decoration:none; color:#999999;"><span class="change">About Us ></span></a></span>
			</div>
		</div>
			
		<div class="profile_page_left">
			<div class="company_detail_description">
				<span class="company_detail_span">About Us</span>
				<p class="company_detail_description company_detail_description_p_b"><?php  echo $htmldata ; ?></p>
			</div>
		</div>
	</div>
</div>