<div class="map_page_left_bar map_left_bar">
  <div class="map_page_left_bar_top"></div>
  <div class="map_page_left_bar_mid "> <span class="liting_barshort_text">Ads by Google</span> 
  
  <?php
		$listing_buttom  = file_get_contents('ads/map.html',true);
		echo stripslashes($listing_buttom);
		 //include("ads/listing_buttom.html");
		  ?>
  
<!--  <img src="<?php echo $ru;?>images/ads_by_google.png"  />-->
  
    <div class="map_rating_point_bar" id="mcs_container">
      <div class="container">
        <div class="content" >
          <?php
				if(count($rs_business)>0){
				// echo "<pre>".print_r($rs_business); exit;
				$i=0;
				foreach($rs_business as $res){
				
				?>
				
			 <!-- <a style="text-decoration:none;" href="javascript:;" onclick="change_color('<?php echo $res['locationid'];?>');">-->
          
		  <div class="map_rating_point_bar_inner_bar"  onmouseover="openInfoWindow('<?php echo $res['locationid'];?>')">
		
            <div class="pointing_bar_left" > <a style="text-decoration:none; color:#829B04;" href="<?php echo $ru ; ?>profile/<?php echo $res['locationid'].'_'. encodeURL(stripslashes($res['name']))."/"; if($res['industry']!=''){echo encodeURL(stripslashes($res['industry']))."/";}    if($res['city']!=''){ echo encodeURL(stripslashes($res['city']))."/";} if($res['state']!=''){echo encodeURL(stripslashes($res['state']))."/";} echo $res['zip'] ; ?>"><span class="map_plumber_text"><?php
			$str_word_1 = str_word_count($res['name'],1);
			$i=0;
			foreach($str_word_1 as $nameword){
			if($i<2){
				echo $nameword." ";
				}
				$i++;
			}
			 //echo substr(stripslashes($res['name']),0,20); ?></span> <span class="map_rating_point_bar_inner_span map_plumber_text"><?php echo substr(stripslashes($res['address']),0,24)."  </br> ".$res['city']." , ".$res['state'];?></span></a>
            <img src="<?php echo $ru;?>images/rating_person_img.png"  /> <span class="map_person_rating_span map_plumber_text map_person_rating_icon" style="width:20px;" >
              <?php
				  $res_photo = mysql_query("SELECT COUNT(`id`) FROM `tt_business_photo` WHERE `bId` = '".$res['locationid']."'");
					$row_photo = mysql_fetch_array($res_photo);
					$image_count = $row_photo[0];
					echo $image_count;
					?>
					
					<!-- ++++++++++ this code is used for the add remove button -->
					
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
					<a href="javascript:;" onclick="bus_add_del('<?php echo $res['locationid'];?>');" class="add_remove"><?php
					 $sql_short_list  = "SELECT * FROM $table WHERE bId='".$res['locationid']."' AND $where "; 
					$result_short_list = mysql_query($sql_short_list);
					$row_short_list = mysql_fetch_array($result_short_list);
					if($row_short_list['bId']>0){?>
					<samp style="float:right;" id="imgg<?php echo $res['locationid'];?>">
						<img src="<?php echo $ru; ?>images/--icon.png" style="float: left; border:none; margin: 4px 65px 0 0;" />
						</samp>
					<?php }else{?>
					<samp style="float:right;" id="imgg<?php echo $res['locationid'];?>">
						<img src="<?php echo $ru; ?>images/plus_icon1.jpg" style="float: left; border:none; margin: 4px 65px 0 0;" />
						</samp>
						<?php } ?>
						</a>
				<?php }else{ ?>
					<a href="javascript:;" class="add_remove" style="cursor:text;"><img src="<?php echo $ru; ?>images/plus_icon1.jpg" style="color:#CCCCCC !important; float:right; border:none; margin: 4px 10px 0 0;" /></a>
				<?php }?>
					
					
					<!--   ++++++++++++++++++++ the end of add remove button code  -->
					<!--<samp style="float:right;">
						<img src="<?php echo $ru; ?>images/--icon.png"  style="float: left; border:none; margin: 4px 65px 0 0;"/>
					</samp>-->
              </span> </div>
			
            <div class="pointer_inner_bar" >
             <!--<div id="markericon_<?php echo $res['locationid'];?>"> </div>
			 <img src="<?php echo $ru;?>images/marker/moscout-icon.png"/>-->
              <?php 
					/*$sql_review = "SELECT COUNT(`reviewId`) AS tot, SUM(`rating`) AS trating FROM `tt_business_reviews` WHERE bId = '".$res['locationid']."' GROUP BY `bId`"; 
					$result1		= mysql_query($sql_review); 
					$tot_rating = 0;
					$tot_reviews=0;
					if(mysql_num_rows($result1)>0)
					{
						$row1		= mysql_fetch_array($result1);
						$tot_rating = ceil($row1['trating']/$row1['tot']);
						$tot_reviews = $row1['tot'];
					}*/
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
						bId = '".$res['locationid']."' GROUP BY `bId`";
				$result_rev = mysql_query($sql_review); 
				$tot_rating = 0;
				$tot_reviews=0;
				if(mysql_num_rows($result_rev)>0)
				{
					$row		= mysql_fetch_array($result_rev);
					$tot_rating = round( ((($row['trating']/$row['tot']) + ($row['expirtise']/$row['tot']) + ($row['cost']/$row['tot']) + ($row['schedule']/$row['tot']) + ($row['response']/$row['tot']) + ($row['professional']/$row['tot']))/6),1);
					$tot_reviews = $row['tot'];
				}
					?>
              <div id="ratingbar">
                <ul id="starrating" style="background-position: 0px <?php echo (round($tot_rating,0)*16*-1); ?>px;">
                  <li id="star<?php echo round($tot_rating); ?>"> </li>
                </ul>
              </div>
              <span> Rating <?php echo $tot_rating; ?> | <?php echo $tot_reviews; ?> Reviews</span> </div>
          </div>
		 <!--</a>-->
		  
          <?php
		
		  $i++; }
				}
				?>
        </div>
      </div>
      <?php /*
		<div class="dragger_container_arrow">
		  <div class="dragger_container_leftRight"><a href="#" class="scrollUpBtn" style="display: inline-block; "></a></div>
		  <div class="dragger_container" style="display: block; ">
			<div class="dragger ui-draggable" style="display: block; height: 141px; line-height: 141px; top: 0px; "></div>
		  </div>
		  <div class="dragger_container_leftRight"><a href="#" class="scrollDownBtn" style="display: inline-block; "> </a></div>
		</div>
		*/?>
      <?php include("common/paginglayout_map.php");
	  
	  //echo $counter;//exit;?>
    </div>
    <script>			
		$(function()
		{
			$('#mcs_container').jScrollPane({scrollbarWidth:9,showArrows:true});
		});
</script>
<script type="text/javascript" language="javascript">
function bus_add_del(bid){
	if($('.map_rating_point_bar_inner_bar #imgg'+bid+' img').attr("src")=="<?php echo $ru; ?>images/plus_icon1.jpg")
		{
		var action = 'add';
			}else{
		var action = 'del';
			}//alert(action);
	$.ajax({
		url:"<?php echo $ru; ?>common/short-list.php?ajax=yes&bId="+bid+"&action="+action,
		beforeSend: function( xhr ) {
			xhr.overrideMimeType( 'text/plain; charset=x-user-defined' );
		},
		success: function( data ) {
			if(data=='greater'){
				jQuery.facebox('You can add only 10 business to your shortlist');
			}else if(action == 'not'){
			
			}else{
				$("#shortlist_bar").html(data);
				if(action == 'add'){
				$('.map_rating_point_bar_inner_bar #imgg'+bid+' img').attr("src","<?php echo $ru; ?>images/--icon.png");
				//img.src='<?php echo $ru; ?>images/--icon.png';
				}else{
					$('.map_rating_point_bar_inner_bar #imgg'+bid+' img').attr("src","<?php echo $ru; ?>images/plus_icon1.jpg");
					//img.src='<?php echo $ru; ?>images/plus_icon1.png';
				}
			}
		}
	});
}


</script>
	<div class="short_text_bar" id="shortlist_bar">
		<span class="short_text_span" style="border-bottom:none;">Your Shortlist<?php /*<span class="edit ">edit</span>*/?></span>
		<?php include("short-list.php"); ?>
	</div>
  </div>
  <div class="map_page_left_bar_last"></div>
</div>
