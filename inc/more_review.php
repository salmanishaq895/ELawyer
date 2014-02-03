<?php 
//$loc =	explode("_",$_GET['s']);
//$locationid   = $loc[0];

//$sql_business = "select * from tt_business where locationid='".$locationid."'";
//echo $sql_business; exit;
//$row_business  = mysql_query($sql_business);
//$rs_business   = mysql_fetch_array($row_business);


	//echo $business_query; exit;
	//$rs_business = $db->get_row($sql_business, ARRAY_A);
//echo $rs_business[locationid]; exit;
$sql_review = "
	SELECT 
		COUNT(`reviewId`) AS tot, 
		
		SUM(`rating`) AS trating,
		SUM(`expirtise`) AS expirtise, 
		SUM(`cost`) AS cost,
		SUM(`schedule`) AS schedule,
		SUM(`response`) AS response,
		SUM(`professional`) AS professional 
	FROM 
		`tt_business_reviews`
	WHERE 
		bId = '".$rs_business['locationid']."' GROUP BY `bId`";

$sqlcount = "SELECT count(reviewId) FROM `tt_business_reviews` WHERE bId = '".$rs_business['locationid']."' GROUP BY `bId` ";	
	$qrycounts = mysql_query($sqlcount);
	$rowcounts = mysql_fetch_array($qrycounts);
	$total_pages = $rowcounts[0];

include("common/pagingprocess_listing.php");
	
	$sql_review .=  " LIMIT ".$start.",".$limit;
		
$result_rev = mysql_query($sql_review); 
$tot_rating = 0;
$tot_reviews=0;
if(mysql_num_rows($result_rev)>0)
{
	$row_rating		= mysql_fetch_array($result_rev);
	$tot_rating = round( ((($row_rating['trating']/$row_rating['tot']) + ($row_rating['expirtise']/$row_rating['tot']) + ($row_rating['cost']/$row_rating['tot']) + ($row_rating['schedule']/$row_rating['tot']) + ($row_rating['response']/$row_rating['tot']) + ($row_rating['professional']/$row_rating['tot']))/6),1);
	$tot_reviews = $row_rating['tot'];
}

?>

	<div class="main_quote_bar_b main_quote_bar_c">
  <div class="map_page_right_bar prof_page_right_bar profile_left_bar">
    <div class="brued_crum_bar brued_crum_bar_c">
      <div class="listing_page_brued_crum">
	  	<span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Home</a> >  <a href="<?php echo $ru;?>more_review/<?php echo $rs_business['locationid']."_".$rs_business['name'];?>" style="text-decoration:none; color:#999999;"> <span class="change">All Reviews of <?php echo $rs_business['name'];?></span> </a></span>
	  </div>
    </div>
    <div class="profile_page_left">
	
	  <div class="company_detail_description_bg">
            <div class="company_detail_description_bg_text"><span>All Reviews of <a href="<?php echo $ru;?>profile/<?php echo $rs_business['locationid']."_".encodeURL(stripslashes($rs_business['name']));?>" style="color:#525252"><?php echo $rs_business['name'];?></a></span> </div>
          </div>

	  <?php
	  $profile_top_second  = file_get_contents('ads/profile_top_second.html',true);
	  echo stripslashes($profile_top_second);
		
		//include("ads/profile_top_second.html");
		?>
		
	
      <div class="company_detail_description">
	  <div style="margin:5px 0 5px 0; border-bottom: 1px dashed #000000; "> </div>
        <div class="company_detail_description_span">
   <!--       <div class="company_detail_description_bg">
            <div class="company_detail_description_bg_text"><span>All Reviews of <?php echo $rs_business['name'];?></span> </div>
          </div>-->
        </div>
		<?php 
		$sql_ratting	=	"SELECT * FROM tt_business_reviews where bId = '".$locationid."'";
		///////////////////////////////////////////////////////////////////////////////////////
	include("common/pagingprocess_listing.php");
	///////////////////////////////////////////////////////////////////////////////////////

$sql_ratting .=  " LIMIT ".$start.",".$limit;
//echo $limit; exit;
	//$rs_business = $db->get_row($sql_business, ARRAY_A);
		
		$result_ratting	=	mysql_query($sql_ratting);
		$totalRviews = mysql_num_rows($result_ratting);
		if($totalRviews>0){
			while($rs_ratting = mysql_fetch_array($result_ratting)){
				$sql_user	 = "select * from tt_user where userId = '".$rs_ratting['userId']."'";
				$result_user = mysql_query($sql_user);
				$row_user	 = mysql_fetch_array($result_user);
				$tot_rating = round(($rs_ratting['rating'] + $rs_ratting['expirtise'] + $rs_ratting['cost'] + $rs_ratting['schedule'] + $rs_ratting['response'] + $rs_ratting['professional'])/6,1);
		?>
        <div class="company_detail_inner_bar">
          <div class="company_img_bar" style="width:13%;"> 
		  <?php if($row_user['photo']!='' and file_exists("media/user/".$row_user['userId']."/thumb/".$row_user['photo'])){?>
			<img src="<?php echo $ru."media/user/".$row_user['userId']."/thumb/".$row_user['photo'];?>" title="<?php $row_user['firstname'];?>" alt="logo" width="66" />
			<?php }else{?>
			<img src="<?php echo $ru; ?>images/review_img.jpg"  />
			<?php }?>
            <span><?php echo $row_user['firstname']." ".$row_user['lastname'];?></span>
		  	</div>
          <samp style="width:84%;">
		  <div class="review_outer">
			  <div class="listing_inner_top_bar_a_right" style="float:left; width:85px; margin:0;">
				<div id="ratingbar">
					<ul id="starrating" style="background-position: 0px <?php echo (round($tot_rating,0)*16*-1); ?>px;">
					  <li id="star<?php echo round($tot_rating,0); ?>"> </li>
					</ul>
				</div>
			  </div>
			  <div class="inner_review">
				  <samp> Rating</samp><?php echo $tot_rating;?> out of 5.0
			  </div>
		  </div>
          <p class="review_span"> <?php echo stripslashes($rs_ratting['review']);?></p>
          <div class="inner_review" style="margin-top:5px; padding-left:5px;">
		  
		  
		  <img src="<?php echo $ru; ?>images/posted_img.png"  /><samp>Posted: </samp> <?php echo date("M d, Y",$rs_ratting['date_added']);?></div>
		  <?php 
		  if( ($_SESSION['TTLOGINDATA']['ISLOGIN'] == 'yes') and $_SESSION['TTLOGINDATA']['USERID'] == $rs_business['userId']){
		  ?>
		  <div class="inner_review" style="margin-top:5px; padding-left:50px;"><samp><a href="javascript:;" onclick="jQuery.facebox('<iframe FRAMEBORDER=0 height=350 width=450 src=<?php echo $ru;?>inc/report_review.php?rId=<?php echo $rs_ratting['reviewId'];?> ></iframe>');" style="color:#FF0000;">Report this review as spam</a></samp></div>
		  <?php } ?>
          </samp> </div>
		 <?php 
			}
		}else{
		?>
		<div class="company_detail_inner_bar" style="padding:10px 0; text-align:center;">
		  	No review
		</div>
		<?php
		}
		?>
		

      </div>

    </div>
	

 <?php include("common/paginglayout_listing.php");?>
	
  </div>
  
  
  <?php include("common/profile-right_review_more.php"); ?>
</div>
 
<script>
function HideShow_h(){
	$.ajax({
		url:"<?php echo $ru; ?>process/mobile-info.php?bId="+<?php echo $rs_business['locationid'];?>,
		beforeSend: function( xhr ) {
			xhr.overrideMimeType( 'text/plain; charset=x-user-defined' );
		},
		success: function( data ) {
			jQuery('#hide_show_div_h').html(data);
			jQuery('#hide_show_div_h').slideDown('slow');
		}
	});
}
function expand_div(id){
	$('.showclas').show();
	$('.hideclas').hide();
	$('#show_div_'+id).hide();
	$('#hide_div_'+id).show();
}

</script>
