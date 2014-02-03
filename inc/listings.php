<?php  
$s_keyword = '';
if($keyword!='all'){
	$s_keyword = "'".$keyword."'";
}

if ($total_pages > $limit){
	$title_search = 'Showing '.'"'. $limit.'/'.$total_pages.'"'.' results for your search '.substr(stripslashes($s_keyword),0,25);
}elseif ($total_pages <= $limit && $total_pages>0){
	$title_search = 'Showing '.'"'. $total_pages.'"'.' results for your search '.substr(stripslashes($s_keyword),0,25);
}
else
{
	$title_search = 'Sorry no results Found for your search '.substr(stripslashes($s_keyword),0,25);
}
?>
<script>
	function HideShow(){
		if(document.getElementById('hide_show_div').style.display == 'none')
			jQuery('#hide_show_div').slideDown('slow');
		else
			jQuery('#hide_show_div').slideUp('slow');
	}
	function HideShow_b(){
		if(document.getElementById('hide_show_div_b').style.display == 'none')
			jQuery('#hide_show_div_b').slideDown('slow');
		else
			jQuery('#hide_show_div_b').slideUp('slow');
	}
	function HideShow_d(){
		if(document.getElementById('hide_show_div_d').style.display == 'none')
			jQuery('#hide_show_div_d').slideDown('slow');
		else
			jQuery('#hide_show_div_d').slideUp('slow');
	}
	function hideshowOver(tthis){
			$('#showhidediv_'+tthis).css('visibility', 'visible');
	}
	function hideshowOut(tthis){
			$('#showhidediv_'+tthis).css('visibility', 'hidden');
	}
</script>

<div class="main_quote_bar_b">
	<div class="map_page_right_bar listing_right_bar">
        <div class="brued_crum_bar brued_crum_bar_b">
          <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Home</a> > <a href="<?php echo $ru;?>listings/" style="text-decoration:none; color:#999999;"> <span class="change">Listing Page</span> </a></span> <span class="brurd_curm_inner brued_crum_span">Results for Category: AS</span> <span class="brurd_curm_inner brued_crum_span_b"><?php echo $total_pages; ?> Results (viewing <?php echo ($start+1); ?>-<?php echo ($start+count($rs_business)); ?> of <?php echo $total_pages; ?>)</span> </div>
          <?php include('common/view-style.php'); ?>
        </div>
        <span>
			<?php 
			$file = file_get_contents('ads/listing_top.html', true);		
			//$file = file_get_contents('./people.txt', FILE_USE_INCLUDE_PATH);
			echo stripslashes($file);
			//include("ads/listing_top.html");
			?>
		</span>	
		<?php
		$markers = '';
		if($rs_business){
			foreach($rs_business as $row_business){
				if(!empty($row_business['latitude']) and $row_business['latitude'] != '0.000000' and !empty($row_business['longitude']) and $row_business['longitude'] != '0.000000')
				{
					$markers .= '&markers=' . $row_business['latitude'].','.$row_business['longitude'];
					$markers_center = $row_business['latitude'].','.$row_business['longitude'];
				}
			?>
			<div class="listing_outer_tabe" onmouseover="hideshowOver(<?php echo $row_business['locationid']; ?>)" onmouseout="hideshowOut(<?php echo $row_business['locationid']; ?>) ;openInfoWindow('<?php echo $row_business['locationid']; ?>');">
			  <div class="listing_inner_top_bar" style="height:auto;" id="buss_cover_div_<?php echo $row_business['locationid']; ?>">
				<div class="listing_inner_top_bar_a"> <span><a style="color:#5F5F5F; text-decoration:none;" href="<?php echo $ru ; ?>profile/<?php echo $row_business['locationid'].'_'. encodeURL(stripslashes($row_business['name']))."/"; if($row_business['industry']!=''){echo encodeURL(stripslashes($row_business['industry']))."/";}    if($row_business['city']!=''){ echo encodeURL(stripslashes($row_business['city']))."/";} if($row_business['state']!=''){echo encodeURL(stripslashes($row_business['state']))."/";} echo $row_business['zip'] ; ?>"><?php echo substr(stripslashes($row_business['name']),0,60); ?></a></span>
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
						bId = '".$row_business['locationid']."' GROUP BY `bId`";
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
				  <div class="listing_inner_top_bar_a_right"> 
				  <div id="ratingbar">
				  	<ul id="starrating" style="background-position: 0px <?php echo (round($tot_rating,0)*16*-1); ?>px;">
						<li id="star<?php echo round($tot_rating); ?>"> </li>
            		</ul>
				  </div>
				  <span>Rating <?php echo $tot_rating; ?> | <?php echo $tot_reviews; ?> Reviews</span>
				  </div>
				</div>
				<?php 
				$target_path = $rootpath.'media/buisness_images/'.$row_business['locationid'].'/logo/thumb/';
				?>
				<div style="width:92px; height:76px;">
				<a href="<?php echo $ru ; ?>profile/<?php echo $row_business['locationid'].'_'. encodeURL(stripslashes($row_business['name']))."/"; if($row_business['industry']!=''){echo encodeURL(stripslashes($row_business['industry']))."/";}    if($row_business['city']!=''){ echo encodeURL(stripslashes($row_business['city']))."/";} if($row_business['state']!=''){echo encodeURL(stripslashes($row_business['state']))."/";} echo $row_business['zip'] ; ?>">
				
				<?php 
					if( ($row_business['logo']!='') and file_exists($target_path.$row_business['logo']) ){
						?>
						
						<img src="<?php echo $ru.'media/buisness_images/'.$row_business['locationid'].'/logo/thumb/'.$row_business['logo'];?>" width="92" border="0" alt="">
						
						<?php
					}else{
						?><img src="<?php echo $ru ;?>images/listing_bar_image.jpg" width="92"border="0" alt=""><?php 
					} ?>
					
					</a>
					</div>
				<p><?php echo substr(stripslashes($row_business['description']),0,200); ?></p>
				<p class="listing_inner_top_p"><img src="<?php echo $ru; ?>images/listing_home_icon.png"  /><?php echo stripslashes($row_business['address']).', '.$row_business['zip'].' '.$row_business['city'].', United Kindgdom'; ?><span style="width:98%;"></span> </p>
				<div class="listing_inner_mid_bar">
					<?php 
					$res_photo = mysql_query("SELECT COUNT(`id`) FROM `tt_business_photo` WHERE `bId` = '".$row_business['locationid']."'");
					$row_photo = mysql_fetch_array($res_photo);
					$image_count = $row_photo[0];
					?>
					 <?php if($image_count>0){?>
					<span style="color:#585858 !important;"><a href="<?php echo $ru ; ?>profile/<?php echo $row_business['locationid'].'_'. encodeURL(stripslashes($row_business['name']))."#photos" ; ?>" style="text-decoration:none; color: #585858 !important;"><img src="<?php echo $ru; ?>images/lising_photo_icon.png" />Photo (<?php echo $image_count; ?>)</a></span>
					<?php }else{?>
					<span style="color:#ccc !important;"><img src="<?php echo $ru; ?>images/lising_photo_icon.png" />Photo (0)</span>
					<?php }?>
					
					
					<span><a href="javascript:;" onclick="load_map('<?php echo $row_business['locationid'];?>')" style="color: #585858 !important; text-decoration:none;" ><img src="<?php echo $ru; ?>images/map_icon.png" />Map View</a></span>
					<?php if($row_business['video_embed']!=''){?>
					<span style="color:#585858 !important;">
					<a href="<?php echo $ru ; ?>profile/<?php echo $row_business['locationid'].'_'. encodeURL(stripslashes($row_business['name']))."#video" ; ?>" style="text-decoration:none; color: #585858 !important;"><img src="<?php echo $ru; ?>images/video_icon.jpg" />Video</a></span>
					<?php }else{?>
					<span style="color:#ccc !important;">
					<img src="<?php echo $ru; ?>images/video_icon.jpg" />Video</span>
					<?php }?>
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
					<span><a href="javascript:;" onclick="bus_add_del('<?php echo $row_business['locationid'];?>');" class="add_remove"><?php
					$sql_short_list  = "SELECT * FROM $table WHERE bId='".$row_business['locationid']."' AND $where ";
					$result_short_list = mysql_query($sql_short_list);
					$row_short_list = mysql_fetch_array($result_short_list);
					if($row_short_list['bId']>0){?>
						<img src="<?php echo $ru; ?>images/--icon.png" /><span>Remove from Shortlist</span>
					<?php }else{?>
						<img src="<?php echo $ru; ?>images/plus_icon1.jpg" /><span>Add To Shortlist</span>
						<?php } ?>
						</a></span>
				<?php }else{ ?>
					<span><a href="javascript:;" class="add_remove" style="cursor:text;"><img src="<?php echo $ru; ?>images/plus_icon1.jpg" /><span style="color:#CCCCCC !important;">Add To Shortlist</span></a></span>
				<?php }?>
				</div>
			  </div>
			  
			  <div class="listing_inner_footer_bar" id="showhidediv_<?php echo $row_business['locationid']; ?>" style="visibility:hidden;">
				<div class="listing_info_bar">
				  <div class="listing_info_text"><a href="<?php echo $ru ; ?>profile/<?php echo $row_business['locationid'].'_'. encodeURL(stripslashes($row_business['name'])) ; ?>" style="text-decoration:none;  color: #7A9000;">More information</a></div>
				 <!-- <img src="<?php echo $ru; ?>images/more_info_icon.png"  />--> </div>
				<div class="listing_inner_right_bar">
			<?php /*
		  <div class="fb-like" data-send="false" data-layout="button_count" data-width="70" data-show-faces="false"></div>
          <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a>
          <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
          
         <g:plusone size="medium"></g:plusone>

          <script type="text/javascript">
(function() {
var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
po.src = 'https://apis.google.com/js/plusone.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>*/?>
			</div>
			  </div>
			</div>
		<?php 
			}
		}
		?>
        <span>
		<?php
		$listing_buttom  = file_get_contents('ads/listing_buttom.html',true);
		echo stripslashes($listing_buttom);
		 //include("ads/listing_buttom.html");
		  ?>
		</span>
		<?php include("common/paginglayout_listing.php");?>
    </div>
	<?php include("common/listing-left-bar.php"); ?>
</div>
<script type="text/javascript" language="javascript">
function bus_add_del(bid){
	if($('#buss_cover_div_'+bid+' .add_remove span').html() == 'Add To Shortlist')
		var action = 'add';
	else
		var action = 'del';
		//alert(action);
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
					$('#buss_cover_div_'+bid+' .add_remove span').html('Remove from Shortlist');
					$('#buss_cover_div_'+bid+' .add_remove img').attr("src","<?php echo $ru; ?>images/--icon.png");
				}else{
					$('#buss_cover_div_'+bid+' .add_remove span').html('Add To Shortlist');
					$('#buss_cover_div_'+bid+' .add_remove img').attr("src","<?php echo $ru; ?>images/plus_icon1.jpg");
				}
			}
		}
	});
}
function business_subscribe(id){
	$.ajax({
		url:"<?php echo $ru; ?>process/process_subscribe.php?ajax=yes&bId="+id,
		beforeSend: function( xhr ) {
			xhr.overrideMimeType( 'text/plain; charset=x-user-defined' );
		},
		success: function( data ) {
			//$("#shortlist_bar").html(data);
			if(data == 'done'){
				var message = 'Your request submitted successfully!';
			}else if(data == 'already'){
				var message = 'Your shortlist For this business is already exist';
			}else if(data=='greater'){
			var message = 'You can only short list the 10 business';
			}
			jQuery.facebox(message);
		}
	});
	return false;
}

function business_delete(bid)
{
	$.ajax({
		url:"<?php echo $ru; ?>common/short-list.php?ajax=yes&action=del&bId="+bid,
		beforeSend: function( xhr ) {
			xhr.overrideMimeType( 'text/plain; charset=x-user-defined' );
		},
		success: function( data ) {
		$("#shortlist_bar").html(data);
			/*if(data == 'done')
			{
				var message = 'You request Deleted successfully!';
			}
			jQuery.facebox(message);*/
			//$("#shortlist_bar").html(date);
		}
	});
	return false;
}


/*function business_subscribe(userid,id){
	$.ajax({
		url:"<?php echo $ru; ?>process/process_subscribe.php?p=sent&userId="+userid+"&bId="+id,
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
}*/


		
/*function business_delete(id)
{
	$.ajax({
		url:"<?php echo $ru; ?>process/process_subscribe.php?p=delete&bId="+id,
		beforeSend: function( xhr ) {
			xhr.overrideMimeType( 'text/plain; charset=x-user-defined' );
		},
		success: function( data ) {
			if(data == 'done')
			{
				var message = 'You request Deleted successfully!';
			}
			jQuery.facebox(message);
		}
	});
	return false;
}*/
function load_map(id){
	var id = parseInt(id);
	jQuery.facebox('<iframe FRAMEBORDER="0" height="400" width="600"   src="<?php echo $ru;?>inc/map.php?bId='+id+'" ></iframe>');
}
</script>
<style>
	iframe{ visibility:inherit !important;}
</style>