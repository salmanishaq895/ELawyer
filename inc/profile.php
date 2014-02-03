<?php 
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
	  	<span class="brurd_curm_inner"><a href="<?php echo $ru;?>" >Home</a> >
		<?php if(!empty($rs_business['industry'])) {?>
		<a href="<?php echo $ru;?>listings/<?php echo encodeURL(stripslashes($rs_business['industry'])) . "/all/";?>"><?php echo stripslashes($rs_business['industry']);?> ></a>  
		<?php }
		
		 if(!empty($rs_business['city'])){?>
		<a href="<?php echo $ru."listings/all/".$rs_business['city'];?>" ><?php echo $rs_business['city'];?> ></a>
		<?php }
		 if(!empty($rs_business['address2'])) {?>
		<a href="<?php echo $ru."listings/all/".$rs_business['address2'];?>" > <?php echo $rs_business['address2'];?> ></a>
		<?php }
		if(!empty($rs_business['zip'])) {?>
				<a href="<?php echo $ru."listings/all/".$rs_business['zip'];?>" > <span class="change"><?php echo $rs_business['zip'];?> ></span></a><?php }?>
		<!-- <a href="<?php echo $ru."listings/all/".$rs_business['city'];?>" style="text-decoration:none; color:#999999;"> <?php echo $rs_business['city'];?> ></a> <a href="<?php echo $ru;?>listings/<?php echo encodeURL(stripslashes($rs_business['industry'])) . "/" . encodeURL(stripslashes($rs_business['city'])) . "/";?>" style="text-decoration:none; color:#999999;"> <span class="change"><?php echo stripslashes($rs_business['industry']);?></span></a>--> </span>
	  </div>
    </div>
    <div class="profile_page_left">
      <div class="profile_page_detail_bar">
	  	<?php 
		if($_GET['o'] == 'preview' and $_SESSION['TTLOGINDATA']['ISLOGIN'] == 'yes'){
		?><div class="edit-bar">
			 <span style="float:right; margin-right:20px;"><a style="text-decoration:none; color: #000000;" href="<?php echo $ru; ?>member/trade-profile">Continue Editing</a></span>
			 <div style="float:right; padding:0 10px; background-color:#8EA800; color:#87329C; font-size:14px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; line-height:27px;">In Preview Mode</div>
		  </div>
		<?php
		}
		?>
        <div class="profile_page_detail_inner_bar_left">		
		<?php /*<span>Ads by Google</span> <img src="<?php echo $ru; ?>images/google_ads_b.jpg"  />*/
			
			$profile_top  = file_get_contents('ads/profile_top.html',true);
			echo stripslashes($profile_top);
			//include("ads/profile_top.html");
			$user_IP = $_SERVER['REMOTE_ADDR']; 
			mysql_query("insert into `tt_business_view` set fromip = '$user_IP', bussId='".$rs_business['locationid']."', `view_date` = NOW(), `view_time` = '" . time() . "'");
		?></div>
        <div class="profile_page_detail_inner_bar_right"> 
		<?php
		if( ($rs_business['logo']!='') and file_exists($rootpath . 'media/buisness_images/' . $rs_business['locationid'] . '/logo/thumb/' . $rs_business['logo']) ){
			?><img src="<?php echo $ru.'media/buisness_images/'.$rs_business['locationid'].'/logo/thumb/'.$rs_business['logo'];?>" width="147" style="margin-left:10px;" border="0" alt=""><?php
		}else{
			?><img src="<?php echo $ru ;?>images/listing_bar_image.jpg" width="147" style="margin-left:10px;" border="0" alt=""><?php 
		}
		 ?>
		<span>
		<strong><?php echo $rs_business['name']; ?></strong><br/>
		<?php echo $rs_business['address'];?>
		<?php if(!empty($rs_business['address2']))
				echo '<br/>'.$rs_business['address2']; ?>,<br/>
          <?php echo $rs_business['city']; ?>, <br/>
		  <?php if(!empty($rs_business['zip']))
		  			echo $rs_business['zip'];
		 ?> 
			
				
		 
		 </span> 
			<?php if($rs_business['website'] != '#' and !empty($rs_business['website'])){ ?>
			<a href="<?php echo 'http://'.trim($rs_business['website'],'http://'); ?>" target="_blank" class="company_email"><?php  echo $rs_business['website']; ?></a>
			<?php }?>
		  <span class="profile_page_detail_span" style="width:160px !important;">
          	<div class="profile_page_span" onclick="HideShow_h();" style="width:144px !important;">View Tel / Mob. Details</div>
          	<a href="javascript:;" onclick="HideShow_h();"><img  src="<?php echo $ru; ?>images/mobile_detail_arrow.png"  /></a></span>
          	<div class="hide_show_outer_div">
				<div id="hide_show_div_h" style=" display:none;">
					
				</div>
			</div>
			<script>
function load_enquiry(){
<?php if(isset($_SESSION['TTLOGINDATA']['USERID']))
{
if($_SESSION['TTLOGINDATA']['TYPE'] == 'c'){

?>
	jQuery.facebox('<iframe FRAMEBORDER="0" height="400" width="450"   src="<?php echo $ru;?>inc/enquiry1.php?bId=<?php echo $rs_business['locationid'];?>" ></iframe>');
<?php 
	}else{
	?>
	jQuery.facebox('Trader Can Not Send the enquiry!');
	<?php 
	}
}else{?>
	window.location="<?php echo $ru;?>signin/y"; 
<?php }?>
}



function load_job(){
<?php if(isset($_SESSION['TTLOGINDATA']['USERID']))
{
if($_SESSION['TTLOGINDATA']['TYPE'] == 'c'){

//$sql  = "select * from tt_invite_job where userId='".$_SESSION['TTLOGINDATA']['USERID']."' AND bId = '".$rs_business['locationid']."' ";
//$resultt	=	mysql_query($sql);
//$row = mysql_num_rows($resultt);
//if($row>0){/*
 // echo '<div style=" background-color:#E1E1E1; font-size: 17px; padding: 68px 0 173px 0;">You Already Post The Job For This Business!</div>';*/
  ?>
  //jQuery.facebox('You have already invited this trader for job.');
  
  <?php 
 // }else{
?>
	jQuery.facebox('<iframe FRAMEBORDER="0" height="234" width="700"   src="<?php echo $ru;?>inc/job.php?bId=<?php echo $rs_business['locationid'];?>" ></iframe>');
<?php //}

	}else{?>
	jQuery.facebox('Trader Can Not post the jobs!');
	<?php
	}
}else{?>
	window.location="<?php echo $ru;?>signin/y"; 
<?php }?>
}
</script>

          <div class="profile_detail_btn_bar"> <a href="javascript:;" onclick="load_enquiry()" style="font-family: Arial,Helvetica,sans-serif;">Send Enquiry</a>
		  
		   <a href="javascript:;" onclick="load_job()" style="font-family: Arial,Helvetica,sans-serif;">Invite to Job</a> </div>
        </div>
      </div>
      <!--<span>Ads by Google</span> <img src="<?php echo $ru; ?>images/google_add_b.png"  class="map_page_right_img" />-->
	  <?php
		$profile_top_second  = file_get_contents('ads/profile_top_second.html',true);
		echo stripslashes($profile_top_second);
		
		//include("ads/profile_top_second.html");
		?>
	  
      <div class="company_detail_description">
        <div class="company_detail_description_bg">
          <div class="company_detail_description_bg_text"><span>Company description</span></div>
        </div>
        <p><?php echo $rs_business['description']; ?></p>
      </div>
	<?php 
	$images_html = '';
	$res_photoes = mysql_query("SELECT * FROM `tt_business_photo` WHERE `bId` = '" . $rs_business['locationid'] . "'");
	if(mysql_num_rows($res_photoes)>0){
		?>
		<script src="<?php echo $ru; ?>js/jquery.tools.min.js"></script>	
		<link rel="stylesheet" type="text/css" href="<?php echo $ru;?>css/scrollable-horizontal.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $ru;?>css/scrollable-buttons.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $ru;?>css/scrollable-navigator.css" />
		<script language="javascript" src="<?php echo $ru; ?>js/jquery.lightbox-0.5.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo $ru; ?>css/jquery.lightbox-0.5.css" media="screen" />

		<div class="company_detail_description">
			<div class="company_detail_description_bg" id="photos">
			  <div class="company_detail_description_bg_text"><span>Portfolio </span></div>
			</div>
			<!-- "previous page" action -->
			<a class="prev browse left"></a>
			<div class="scrollable" id="browsable">
				<div class="items">
				<?php 
				$img=0;
				while($row_photoes = mysql_fetch_array($res_photoes)){
					if(file_exists($rootpath.'media/bussPics/'.$rs_business['locationid'].'/thumbs/'.$row_photoes['name']) and !empty($row_photoes['name'])){
						if($img%6==0) echo '<div>'; 
						?><a title="<?php echo $row_photoes['title']; ?>" href="<?php echo $ru.'media/bussPics/'.$rs_business['locationid'].'/'.$row_photoes['name']; ?>"><img src="<?php echo $ru.'media/bussPics/'.$rs_business['locationid'].'/thumbs/'.$row_photoes['name']; ?>" /></a><?php
						$img++;
						if($img%6==0) echo '</div>';
					}
				}
				if($img%6!=0 and $img>0) echo '</div>';
				?>
				</div>
			</div>
		<a class="next browse right"></a>
		<div class="navi"></div>
	</div>
	<script>
		$(document).ready(function() {
			$("#browsable").scrollable().navigator();	
			$(function() {$('#browsable a').lightBox();});
		});
	</script>
	<?php
}
	
      /*<!--<span>Ads by Google</span> <img src="<?php echo $ru; ?>images/listing_google_add.png"  class="map_page_right_img" />-->
	  */ 
	  
	  $profile_middel   = file_get_contents('ads/profile_middel.html',true);
	  echo stripslashes($profile_middel);
	 // include("ads/profile_middel.html");
	  $res_keyservices = mysql_query("SELECT * FROM `tt_business_keyservices` WHERE `userId` = '".$rs_business['userId']."' "); 
	  if(mysql_num_rows($res_keyservices)>0){
	  ?>
      <div class="company_detail_description">
        <div class="company_detail_description_bg">
          <div class="company_detail_description_bg_text"><span>Key Services </span></div>
        </div>
		<?php while($row_keyservices = mysql_fetch_array($res_keyservices)){ ?>
        <div class="company_detail_inner_bar showclas" id="show_div_service_<?php echo $row_keyservices['id']; ?>">
          <div class="company_img_bar">
		  <?php if( !empty($row_keyservices['img']) and file_exists($rootpath . 'media/key-services/'.$rs_business['userId'].'/thumb/'.$row_keyservices['img']) ){ ?>
		  <a href="<?php echo $ru . 'media/key-services/'.$rs_business['userId'].'/'.$row_keyservices['img'];?>" target="_blank"> <img src="<?php echo $ru.'media/key-services/'.$rs_business['userId'].'/thumb/'.$row_keyservices['img'];?>"  /> </a>
		  <?php } ?>
		  <img src="<?php echo $ru; ?>images/plus_icon.jpg" onclick="expand_div('service_<?php echo $row_keyservices['id'] ?>');" style="cursor:pointer;" /> </div>
          <samp>
          <p class="inner_detail"><?php echo substr(stripslashes($row_keyservices['title']),0,55); ?></p>
          <p><?php echo substr( stripslashes($row_keyservices['shortdescription']),0,100); ?></p>
          </samp> </div>
        <div class="company_detail_inner_bar hideclas" id="hide_div_service_<?php echo $row_keyservices['id'] ?>" style="display:none;">
          <div class="company_img_bar">
		  <?php if( !empty($row_keyservices['img']) and file_exists($rootpath . 'media/key-services/'.$rs_business['userId'].'/'.$row_keyservices['img']) ){ ?>
		  <img src="<?php echo $ru.'media/key-services/'.$rs_business['userId'].'/'.$row_keyservices['img'];?>" style="max-width:200px;"  /> 
		  <?php } ?>
		  
		  </div>
          <samp>
          <p class="hide_text"><?php echo stripslashes($row_keyservices['title']); ?></p>
          <p class="hide_text_b"><?php echo $row_keyservices['shortdescription']; ?></p>
          </samp> </div>
		 <?php }?>
      </div>
	  <?php } ?>
	  <?php 
	  $res_skill = mysql_query("SELECT * FROM `tt_business_skills` WHERE `userId` = '".$rs_business['userId']."' "); 
	  $skill_sum = "";
	  if(mysql_num_rows($res_skill)>0){
	  ?>
      <div class="company_detail_description">
        <div class="company_detail_description_bg">
          <div class="company_detail_description_bg_text"><span>Skills </span></div>
        </div>
		<?php while($row_skill = mysql_fetch_array($res_skill)){ ?>
        <div class="company_detail_inner_bar">
          <div class="company_img_bar"> &nbsp; </div>
          <samp style="width:95%;">
          <p class="skill_text_bar"><?php if(empty($skill_sum)) $skill_sum .= trim(stripslashes($row_skill['shortdescription'])); else $skill_sum .= ",".trim(stripslashes($row_skill['shortdescription'])); echo stripslashes($row_skill['shortdescription']); ?></p>
          <img src="<?php echo $ru; ?>images/rating_<?php echo $row_skill['skill_level']; ?>.png"  /> </samp> </div>
		 <?php } ?>
      </div>
	  <?php } ?>
	  <?php 
	  $res_qualification = mysql_query("SELECT * FROM `tt_business_qualification` WHERE `userId` = '".$rs_business['userId']."' "); 
	  if(mysql_num_rows($res_qualification)>0){
	  ?>
      <div class="company_detail_description_b">
        <div class="company_detail_description_bg">
          <div class="company_detail_description_bg_text"><span>Qualifications </span></div>
        </div>
		<?php while($row_qualification = mysql_fetch_array($res_qualification)){ ?>
        <div class="company_detail_inner_bar showclas" id="show_div_qualification_<?php echo $row_qualification['id']; ?>">
          <div class="company_img_bar">
		  	<?php if( !empty($row_qualification['img']) and file_exists($rootpath . 'media/qualification/'.$rs_business['userId'].'/thumb/'.$row_qualification['img']) ){ ?>
	       <a href="<?php echo $ru . 'media/qualification/'.$rs_business['userId'].'/'.$row_qualification['img'];?>" target="_blank"><img src="<?php echo $ru.'media/qualification/'.$rs_business['userId'].'/thumb/'.$row_qualification['img'];?>" style="max-width:200px;" /></a>
		<!--<a href="<?php echo $ru . 'media/qualification/'.$rs_business['userId'].'/'.$row_qualification['img'];?>" target="_blank">	<img src="<?php echo $ru.'images/link.jpg';?>" style="max-width:43px;" /></a>-->
		  	<?php }else if(!empty($row_qualification['img']) and file_exists($rootpath . 'media/qualification/'.$rs_business['userId'].'/'.$row_qualification['img'])){?>
			
			<a href="<?php echo $ru . 'media/qualification/'.$rs_business['userId'].'/'.$row_qualification['img'];?>" target="_blank">	<img src="<?php echo $ru.'images/link.jpg';?>" style="max-width:43px;" /></a>
			<?php }?>
			
		  	<img src="<?php echo $ru; ?>images/plus_icon.jpg" onclick="expand_div('qualification_<?php echo $row_qualification['id'] ?>');" style="cursor:pointer;" />
		  </div>
		  
		  
		  
          <samp>
          	<p class="inner_detail"><?php echo substr(stripslashes($row_qualification['title']),0,55); ?></p>
          	<p><?php echo substr(stripslashes($row_qualification['shortdescription']),0,100); ?></p>
          </samp>
		</div>
        <div class="company_detail_inner_bar hideclas" id="hide_div_qualification_<?php echo $row_qualification['id'] ?>" style="display:none;">
          <div class="company_img_bar">
		
		  <?php if( !empty($row_qualification['img']) and file_exists($rootpath . 'media/qualification/'.$rs_business['userId'].'/thumb/'.$row_qualification['img']) ){ ?>
		  <img src="<?php echo $ru.'media/qualification/'.$rs_business['userId'].'/'.$row_qualification['img'];?>" style="max-width:200px;"  /> 
		  <?php }else if(!empty($row_qualification['img']) and file_exists($rootpath . 'media/qualification/'.$rs_business['userId'].'/'.$row_qualification['img'])){ ?>
		  <a href="<?php echo $ru . 'media/qualification/'.$rs_business['userId'].'/'.$row_qualification['img'];?>" target="_blank">	<img src="<?php echo $ru.'images/link.jpg';?>" style="max-width:43px;" /></a>
			<?php }?>
		  
		  </div>
          <samp>
          <p class="hide_text"><?php echo stripslashes($row_qualification['title']); ?></p>
          <p class="hide_text_b"><?php echo stripslashes($row_qualification['shortdescription']); ?></p>
          </samp> </div>
		 <?php
		 }?>
      </div>
	  <?php 
	  }
	  ?>
	  <?php 
	  $res_insurance = mysql_query("SELECT * FROM `tt_business_insurance` WHERE `userId` = '".$rs_business['userId']."' "); 
	  if(mysql_num_rows($res_insurance)>0){
	  ?>
      <div class="company_detail_description">
        <div class="company_detail_description_bg">
          <div class="company_detail_description_bg_text"><span>Insurnace </span></div>
        </div>
		<?php while($row_insurance = mysql_fetch_array($res_insurance)){ ?>
        <div class="company_detail_inner_bar showclas" id="show_div_insurance_<?php echo $row_insurance['id']; ?>">
          <div class="company_img_bar">
		  	<?php if( !empty($row_insurance['img']) and file_exists($rootpath . 'media/insurance/'.$rs_business['userId'].'/thumb/'.$row_insurance['img']) ){ ?>
		  	<a href="<?php echo $ru . 'media/insurance/'.$rs_business['userId'].'/'.$row_insurance['img'];?>" target="_blank"><img src="<?php echo $ru.'media/insurance/'.$rs_business['userId'].'/thumb/'.$row_insurance['img'];?>"  /></a>
			<!--<a href="<?php echo $ru. 'media/insurance/'.$rs_business['userId'].'/'.$row_insurance['img'] ?>" target="_blank"><img src="<?php echo $ru.'images/link.jpg';?>" style="max-width:43px;" /> </a>-->
		  	<?php } else if(!empty($row_insurance['img']) and file_exists($rootpath . 'media/insurance/'.$rs_business['userId'].'/'.$row_insurance['img']) ){?>
			<a href="<?php echo $ru. 'media/insurance/'.$rs_business['userId'].'/'.$row_insurance['img'] ?>" target="_blank"><img src="<?php echo $ru.'images/link.jpg';?>" style="max-width:43px;" /> </a>
			<?php }?>
			
		  	<img src="<?php echo $ru; ?>images/plus_icon.jpg" onclick="expand_div('insurance_<?php echo $row_insurance['id'] ?>');" style="cursor:pointer;" />
		  </div>
          <samp>
          	<p class="inner_detail"><?php echo substr(stripslashes($row_insurance['title']),0,55); ?></p>
          	<p><?php echo substr(stripslashes($row_insurance['shortdescription']),0,100); ?></p>
          </samp>
		</div>
        <div class="company_detail_inner_bar hideclas" id="hide_div_insurance_<?php echo $row_insurance['id'] ?>" style="display:none;">
         <div class="company_img_bar">
		
		  <?php if( !empty($row_insurance['img']) and file_exists($rootpath . 'media/insurance/'.$rs_business['userId'].'/thumb/'.$row_insurance['img']) ){ ?>
		  <img src="<?php echo $ru.'media/insurance/'.$rs_business['userId'].'/'.$row_insurance['img'];?>" style="max-width:200px;"  /> 
		  <?php }else if(!empty($row_insurance['img']) and file_exists($rootpath . 'media/insurance/'.$rs_business['userId'].'/'.$row_insurance['img']) ){ ?>
		  <a href="<?php echo $ru. 'media/insurance/'.$rs_business['userId'].'/'.$row_insurance['img'] ?>" target="_blank"><img src="<?php echo $ru.'images/link.jpg';?>" style="max-width:43px;" /> </a>
		  <?php }?>
		  
		  </div>
          <samp>
          	<p class="hide_text"><?php echo stripslashes($row_insurance['title']); ?></p>
          	<p class="hide_text_b"><?php echo stripslashes($row_insurance['shortdescription']); ?></p>
          </samp>
		</div>
		 <?php }?>
      </div>
	  <?php 
	  }
	  ?>
      <div class="company_detail_description">
        <div class="company_detail_description_span">
          <div class="company_detail_description_bg">
            <div class="company_detail_description_bg_text"><span>Reviews</span> <span class="company_detail_description_span_view_all"><a href="<?php echo $ru;?>more_review/<?php echo $rs_business['locationid']."_".stripslashes(encodeURL($rs_business['name']));?>" style="color:#000000; text-decoration:none;">View all reviews </a>&nbsp; &nbsp;  l &nbsp; &nbsp; <a href="javascript:;" onClick="load_review();" style="color:#000000; text-decoration:none;">Write your own review</a></span> </div>
          </div>
        </div>
		<?php 
		$sql_ratting	=	"SELECT * FROM tt_business_reviews where bId = '".$rs_business['locationid']."' LIMIT 0,9";
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
          <div class="inner_review" style="margin-top:5px; padding-left:5px;"><img src="<?php echo $ru; ?>images/posted_img.png"  /><samp>Posted: </samp> <?php echo date("M d, Y",$rs_ratting['date_added']);?></div>
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
  </div>
  <?php include("common/profile-right.php"); ?>
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
