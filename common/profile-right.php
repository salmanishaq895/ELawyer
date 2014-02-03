<div class="map_page_left_bar prof_page_left_bar">
  <div class="map_page_left_bar_top"></div>
  <div class="map_page_left_bar_mid">
    <div class="listing_wrapper_left">
	  <span class="review">Review Summary </span>
	  <span class="total_review">Total:
	    <span><?php echo $tot_reviews; ?></span> reviews</span>
		
	   <span class="total_review detail_rev"><samp><a href="javascript:;" onclick="HideShow_rating();">Detailed Review</a> 
	   	  <img src="<?php echo $ru; ?>images/plus_icon.jpg" />
		  <div class="listing_inner_top_bar_a_right" style="width:85px; float:left; margin:2px 0 0 4px;">
			<div id="ratingbar" style="width:85px;">
			  <ul id="starrating" style="background-position: 0px <?php echo (round($tot_rating,0)*16*-1); ?>px;">
				<li id="star<?php echo round($tot_rating); ?>"> </li>
			  </ul>
			</div>
		  </div>
        <?php if($row_rating['tot'] == 0) echo '0'; else echo round($tot_rating,1); ?></samp></span>
	  
	  <div class="hide_show_outer_div">
		<div id="hide_show_rating">
			<div class="listing_inner_top_bar_a_right" style="width:190px; float:left; margin:3px 0 3px 4px;">
				<div class="label">Quality:</div> <div id="ratingbar" style="width:90px;">
				  <ul id="starrating" style="background-position: 0px <?php if($row_rating['tot'] == 0) echo '0'; else echo (round($row_rating['trating']/$row_rating['tot'],0)*16*-1); ?>px;">
					<li id="star<?php if($row_rating['tot'] == 0) echo '0'; else echo round($row_rating['trating']/$row_rating['tot']); ?>"> </li>
				  </ul>
				</div>
				<?php if($row_rating['tot'] == 0) echo '0'; else echo round($row_rating['trating']/$row_rating['tot'],1); ?>
			</div>
			
			<div class="listing_inner_top_bar_a_right" style="width:190px; float:left; margin:3px 0 3px 4px;">
			<div class="label">Expirtise</div><div id="ratingbar" style="width:90px;">
			  <ul id="starrating" style="background-position: 0px <?php if($row_rating['tot'] == 0) echo '0'; else echo (round($row_rating['expirtise']/$row_rating['tot'],0)*16*-1); ?>px;">
				<li id="star<?php if($row_rating['tot'] == 0) echo '0'; else echo round($row_rating['expirtise']/$row_rating['tot']); ?>"> </li>
			  </ul>
			</div>
			<?php if($row_rating['tot'] == 0) echo '0'; else echo round($row_rating['expirtise']/$row_rating['tot'],1); ?>
			</div>
			
			<div class="listing_inner_top_bar_a_right" style="width:190px; float:left; margin:3px 0 3px 4px;">
			<div class="label">Cost</div><div id="ratingbar" style="width:90px;">
			  <ul id="starrating" style="background-position: 0px <?php if($row_rating['tot'] == 0) echo '0'; else echo (round($row_rating['cost']/$row_rating['tot'],0)*16*-1); ?>px;">
				<li id="star<?php if($row_rating['tot'] == 0) echo '0'; else echo round($row_rating['cost']/$row_rating['tot']); ?>"> </li>
			  </ul>
			</div>
			<?php if($row_rating['tot'] == 0) echo '0'; else echo round($row_rating['cost']/$row_rating['tot'],1); ?>
			</div>
			
			<div class="listing_inner_top_bar_a_right" style="width:190px; float:left; margin:3px 0 3px 4px;">
			<div class="label">Schedule</div><div id="ratingbar" style="width:90px;">
			  <ul id="starrating" style="background-position: 0px <?php if($row_rating['tot'] == 0) echo '0'; else echo (round($row_rating['schedule']/$row_rating['tot'],0)*16*-1); ?>px;">
				<li id="star<?php if($row_rating['tot'] == 0) echo '0'; else echo round($row_rating['schedule']/$row_rating['tot']); ?>"> </li>
			  </ul>
			</div>
			<?php if($row_rating['tot'] == 0) echo '0'; else echo round($row_rating['schedule']/$row_rating['tot'],1); ?>
			</div>
			
			<div class="listing_inner_top_bar_a_right" style="width:190px; float:left; margin:3px 0 3px 4px;">
			<div class="label">Response</div><div id="ratingbar" style="width:90px;">
			  <ul id="starrating" style="background-position: 0px <?php if($row_rating['tot'] == 0) echo '0'; else echo (round($row_rating['response']/$row_rating['tot'],0)*16*-1); ?>px;">
				<li id="star<?php if($row_rating['tot'] == 0) echo '0'; else echo round($row_rating['response']/$row_rating['tot']); ?>"> </li>
			  </ul>
			</div>
			<?php if($row_rating['tot'] == 0) echo '0'; else echo round($row_rating['response']/$row_rating['tot'],1); ?>
			</div>
			
			<div class="listing_inner_top_bar_a_right" style="width:190px; float:left; margin:3px 0 3px 4px;">
			<div class="label">Professional</div><div id="ratingbar" style="width:90px;">
			  <ul id="starrating" style="background-position: 0px <?php if($row_rating['tot'] == 0) echo '0'; else echo (round($row_rating['professional']/$row_rating['tot'],0)*16*-1); ?>px;">
				<li id="star<?php if($row_rating['tot'] == 0) echo '0'; else echo round($row_rating['professional']/$row_rating['tot']); ?>"> </li>
			  </ul>
			</div>
			<?php if($row_rating['tot'] == 0) echo '0'; else echo round($row_rating['professional']/$row_rating['tot'],1); ?>
			</div>
			
		</div>
	  </div>
	  
	 </div>
    <div class="short_text_bar">
<script type="text/javascript">
function HideShow_rating(){
	jQuery('#hide_show_rating').slideDown('slow');
}

var switchTo5x=true;
</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">
stLight.options({publisher:'bf5e80ed-46ff-462c-8921-f55d5df759af'});
</script>
<div class="review_btn">
	<span style="cursor:pointer;" onClick="load_review();">Write a Review</span> <span class="st_sharethis_custom" style="cursor:pointer;">Share </span>
<script type="text/javascript" language="javascript">
function business_subscribe(userId){
	$.ajax({
		url:"<?php echo $ru; ?>process/process_subscribe.php?p=sent&userId="+userId+"&bId="+<?php echo $rs_business['locationid'];?>,
		beforeSend: function( xhr ) {
			xhr.overrideMimeType( 'text/plain; charset=x-user-defined' );
		},
		success: function( data ) {
			if(data == 'done'){
				var message = 'You request submitted successfully!';
			}else if(data == 'already'){
				var message = 'Your shortlist For this business is already exist';
			}
			jQuery.facebox(message);
		}
	});
	return false;
}
</script>
<span>
<?php 
$flg = true;
if(isset($_SESSION['TTLOGINDATA']['USERID'])){
	if($_SESSION['TTLOGINDATA']['TYPE'] == 'c'){
		$table = 'tt_shortlist';
		$where = " `userId` = '".$userId."' ";
		$userId = $_SESSION['TTLOGINDATA']['USERID'];
	}else{
		$flg = false;
	}
}else{
	$user_IP = $_SERVER['REMOTE_ADDR'];
	$where = " `ip` = '".$user_IP."' ";
	$table = ' `tt_shortlist_temp` ';
}
if($flg){?>
<a href="javascript:;" onclick="bus_add_del('<?php echo $rs_business['locationid'];?>');" class="add_remove"><?php
$sql_short_list  = "SELECT * FROM $table WHERE bId='".$rs_business['locationid']."' AND $where ";
$result_short_list = mysql_query($sql_short_list);
$row_short_list = mysql_fetch_array($result_short_list);
if($row_short_list['bId']>0){
	?>Remove from Shortlist<?php 
}else{
	?>Add To Shortlist<?php 
} ?></a>
<?php }else{ 
?><a href="javascript:;" style="text-decoration:none; color:#999999;">Add To Shortlist</a><?php 
}?></span>
</div>
      <?php 
	  if(!empty($skill_sum)){ 
	  	$skill_sum_ar = explode(",",$skill_sum);
	  	$skill_sum_ar = array_unique($skill_sum_ar);
	  	$skill_sum = implode(", ",$skill_sum_ar);
	  ?>
      <div class="listing_wrapper_left"> <span class="review ">Skill Summary </span> <span class="total_review"><?php echo $skill_sum;?></span> </div>
      <?php 
	  }
	  ?>
	
      <div class="listing_wrapper_left"  > <span class="review">Trades Mans Locations </span> 
	  <div id="map-convas" class="right_small_map_convas"> </div>
	  <?php /*<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $rs_business['latitude'];?>,<?php echo $rs_business['longitude'];?>&zoom=16&size=275x291&maptype=roadmap&markers=<?php echo $rs_business['latitude'];?>,<?php echo $rs_business['longitude'];?>&sensor=false"/> */?>
	  
	   </div>
      <?php if(!empty($rs_business['video_embed'])){ ?>
      <div class="listing_wrapper_left" id="video"> <span class="review">Profile Video</span> <?php echo stripslashes($rs_business['video_embed']); ?></div>
        <script>
		$('#video object').attr('width', '276px');
		$('#video object').attr('height', '190px');
		
		$('#video embed').attr('width', '276px');
		$('#video embed').attr('height', '190px');
		
		$('#video iframe').attr('width', '276px');
		$('#video iframe').attr('height', '190px');
	  </script>
        <?php 
	  }
	  ?>
      
      <div class="listing_wrapper_left"> <span class="review">Business Hours</span>
        <div class="business_hour_timing_inner_bar">
          <div class="business_hour_timing_bar"> <span>Monday</span> <samp><?php 
		  if(($rs_business['mon_f']=='00:00 am' or $rs_business['mon_f']=='') and ($rs_business['mon_t']=='00:00 am' or $rs_business['mon_t']==''))
		  {
		  echo "Close";
		  }else if($rs_business['mon_oc']=='0') {echo "Close";}else{ echo timeDisplay($rs_business['mon_f'],$rs_business['mon_t']);}?></samp> </div>
          <div class="business_hour_timing_gray_bar"> <span>Tuesday</span> <samp><?php 
		  if(($rs_business['tue_f']=='00:00 am' or $rs_business['tue_f']=='') and ($rs_business['tue_t']=='00:00 am' or $rs_business['tue_t']==''))
		  {
		  echo "Close";
		  }else if($rs_business['tue_oc']=='0') {echo "Close";}else{ echo timeDisplay($rs_business['tue_f'],$rs_business['tue_t']);}?></samp> </div>
          <div class="business_hour_timing_bar"> <span>Wednesday</span> <samp><?php 
		  if(($rs_business['wed_f']=='00:00 am' or $rs_business['wed_f']=='') and ($rs_business['wed_t']=='00:00 am' or $rs_business['wed_t']==''))
		  {
		  echo "Close";
		  }else if($rs_business['wed_oc']=='0') {echo "Close";}else{ echo timeDisplay($rs_business['wed_f'],$rs_business['wed_t']);}?></samp> </div>
          <div class="business_hour_timing_gray_bar"> <span>Thursday</span> <samp><?php 
		  if($rs_business['thu_f']=='' or $rs_business['thu_t']=='')
		  {
		  echo "Close";
		  }else if($rs_business['thu_oc']=='0') {echo "Close";}else{echo timeDisplay($rs_business['thu_f'],$rs_business['thu_t']);}?></samp> </div>
          <div class="business_hour_timing_bar"> <span>Friday</span> <samp><?php 
		  if(($rs_business['fri_f']=='00:00 am' or $rs_business['fri_f']=='') and ($rs_business['fri_t']=='00:00 am' or $rs_business['fri_t']==''))
		  {
		  echo "Close";
		  }else if($rs_business['fri_oc']=='0') {echo "Close";}else{ echo timeDisplay($rs_business['fri_f'],$rs_business['fri_t']);}?></samp> </div>
          <div class="business_hour_timing_gray_bar"> <span>Saturday</span> <samp><?php 
		  if(($rs_business['sat_f']=='00:00 am' or $rs_business['sat_f']=='') and ($rs_business['sat_t']=='00:00 am' or $rs_business['sat_t']==''))
		  {
		  echo "Close";
		  }else if($rs_business['sat_oc']=='0') {echo "Close";}else{ echo timeDisplay($rs_business['sat_f'],$rs_business['sat_t']);}?></samp> </div>
          <div class="business_hour_timing_bar" style="border:0px;"> <span>Sunday</span> <samp><?php 
		  if(($rs_business['sun_f']=='00:00 am' or $rs_business['sun_f']=='') and ($rs_business['sun_t']=='00:00 am' or $rs_business['sun_t']==''))
		  {
		  echo "Close";
		  }else if($rs_business['sun_oc']=='0') {echo "Close";}else{ echo timeDisplay($rs_business['sun_f'],$rs_business['sun_t']);}?></samp> </div>
        </div>
      </div>
    </div>
    <div class="short_text_bar">
      <div class="short_text_flied_bar short_listing_input_flied ">
        <div class="hide_show_outer_div"> <a href="javascript:;" onClick="HideShow_g();">
          <div id="hide_show_div_g" style=" display:none;"> <span>Distance in miles </span> <span>Distance in miles</span> <span>Distance in miles </span> <span>Distance in miles </span> </div>
          </a> </div>
      </div>
    </div>
    <div class="short_text_bar" id="shortlist_bar">
	<span class="short_text_span" style="border-bottom:none;">Your Shortlist<?php /*<span class="edit ">edit</span>*/?></span>
	<?php include("short-list.php"); ?>
	</div>
    <div class="listing_wrapper_left">
	
 
	
	<?php 
	
	$profile_image1  = file_get_contents(ABSPATH."ads/profile_image1.html",true);
	echo $profile_image1;
	 
	$profile_right1  = file_get_contents(ABSPATH.'ads/profile_right1.html',true);
	echo stripslashes($profile_right1);
	
	$profile_image2  =  file_get_contents(ABSPATH.'ads/profile_image2.html',true);
	echo stripslashes($profile_image2);
	
	$profile_right2  = file_get_contents(ABSPATH.'ads/profile_right2.html',true);
	echo stripslashes($profile_right2);
	
	//include("ads/profile_image1.html");
	//include("ads/profile_right1.html");
	//include("ads/profile_image2.html");
	//include("ads/profile_right2.html");
	
	
	
	?><!--<img src="<?php echo $ru; ?>images/google_ads_c.jpg" class="add_border" /> <img src="<?php echo $ru; ?>images/add_b.jpg"  /> <img src="<?php echo $ru; ?>images/google_ads_d.jpg" class="add_border" />--> </div>
  </div>
  <div class="map_page_left_bar_last"></div>
</div>
<?php 
function timeDisplay($frm_time,$to_time){

	return $frm_time. ' to ' .$to_time;
}
?>
<script type="text/javascript">
		function load_review(){
		<?php if(isset($_SESSION['TTLOGINDATA']['USERID'])){
				$qry1 = mysql_query("SELECT reviewId FROM tt_business_reviews WHERE userId = '".$_SESSION['TTLOGINDATA']['USERID']."' AND bId = '".$rs_business['locationid']."'");
				if(mysql_num_rows($qry1) > 0){
				?>
				jQuery.facebox('You already reviewed this business.');
				<?php
				}elseif($_SESSION['TTLOGINDATA']['USERID'] == $rs_business['userId']){
				?>
				jQuery.facebox('You can not  review on  your own profile.');
				<?php 
				}else{?>
					jQuery.facebox('<iframe FRAMEBORDER="0" height="534" width="500" src="<?php echo $ru;?>inc/writereview.php?bId=<?php echo $rs_business['locationid'];?>" ></iframe>');
				<?php 
				}/*else{?>
					jQuery.facebox('Traders are not allowed to post review on another trader\'s profile.');
				<?php }*/
}else{?>
	window.location="<?php echo $ru;?>signin/y"; 
<?php }?>
}
</script>
<script type="text/javascript" language="javascript">
function bus_add_del(bid){
	if($('.add_remove').html() == 'Add To Shortlist')
		var action = 'add';
	else
		var action = 'del';
	$.ajax({
		url:"<?php echo $ru; ?>common/short-list.php?ajax=yes&bId="+bid+"&action="+action,
		beforeSend: function( xhr ) {
			xhr.overrideMimeType( 'text/plain; charset=x-user-defined' );
		},
		success: function( data ) {
			if(data == 'greater'){
				jQuery.facebox('You can add only 10 business to your shortlist');
			}else if(data == 'not'){
			
			}else{
				$("#shortlist_bar").html(data);
				if(action == 'add'){
					$('.add_remove').html('Remove from Shortlist');
				}else{
					$('.add_remove').html('Add To Shortlist');
				}
			}
		}
	});
}
</script>