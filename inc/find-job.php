<?php  
if (isset ($_GET['s']))
{
	$_SESSION['redirect']['page'] = trim($_GET['s'] );
	$_SESSION['redirect']['pagedata'] =	trim($_GET['o']);
}

if(isset($_SERVER['HTTP_REFERER']) and ($_SERVER['HTTP_REFERER'] != $ru.'login') and ($_SERVER['HTTP_REFERER'] != $ru.'accountactivated') )
{	
	$_SESSION['redirectPage'] = $_SERVER['HTTP_REFERER'];
}

$query_string = ' WHERE status = "Active" ';
if( isset ( $_GET['s'] ) )
{
	
	
	$category = trim($_GET['s']);
	$category = str_replace('_',' ', $category);
	
	$city = trim($_GET['o']);
	$city = str_replace('_',' ', $city);
	
	if($city=='all' or $city == ''){
		
		$location = '';
	}
	else{
		$qry_zip = " SELECT * FROM `tt_zipcodes` WHERE city ='$city' or  postcode ='$city' ";		
		$qry_zip_exe = mysql_query($qry_zip);		
		if(mysql_num_rows($qry_zip_exe)){
			$qry_zip_res = mysql_fetch_array($qry_zip_exe);
			$find_city = $qry_zip_res['city'];
			$find_zip = $qry_zip_res['postcode'];			
		    $location = " AND location LIKE '%".$find_city."%' OR location LIKE '%".$find_zip."%' ";
		}
		else{
			$location = " AND location LIKE '%".$city."%'";
		}
	}
	
	if($category=='all' or $category == ''){
			$keyword = '';
	}
	else{
			$keyword = " AND keyword LIKE '%".$category."%'";
		
	}
		
		
		
	$query_string .=  $location ;
	$query_string .=  $keyword ;
	
}

	$sqlcount = "SELECT count(quotes_id) FROM `tt_quotes` $query_string ";	
	$qrycounts = mysql_query($sqlcount);
	$rowcounts = mysql_fetch_array($qrycounts);
	$total_pages = $rowcounts[0];
	
	$quotes_query = "SELECT * FROM tt_quotes $query_string "; //exit;
	
	include("common/pagingprocess_listing.php");
	
	$quotes_query .=  " LIMIT ".$start.",".$limit;
	//echo $business_query; exit;
	//$rs_business = $db->get_results($business_query, ARRAY_A);


?>
<script>	
	function hideshowOver(tthis){
			$('#showhidediv_'+tthis).css('visibility', 'visible');
	}
	function hideshowOut(tthis){
			$('#showhidediv_'+tthis).css('visibility', 'hidden');
	}
</script>
<div class="main_quote_bar_b">
  <div class="map_page_right_bar" style="width:auto;">
    <div class="brued_crum_bar brued_crum_bar_c">
      <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>">Home</a> > <a href="<?php echo $ru;?>find-job"> <span class="change">Find Jobs</span></a></span> </div>
    </div>
    <div class="profile_page_left">
      <div class="listing_wrapper_left"> <span style="width:97%;">Find Jobs </span> </div>
      <form method="post" action="<?php echo $ru; ?>process/find-job.php">
	  <input type="hidden" name="form_name" value="find-job" />
        <div class="search-frm" style="width:643px;">
          <div class="short_text_bar liting_barshort_text" style="margin-top:10px;">
            <div class="short_text_flied_bar short_listing_input_flied">
              <div id="cat_div_disable" style="display:none;"> <a><span>Category Search</span></a> <a><img src="<?php echo $ru; ?>images/gray_drop_down_arrow.png" /></a> </div>
              <div id="cat_div" onClick="HideShow_e();" style="cursor:pointer; width:214px;"> <a><span>All Trades</span></a> <a><img src="<?php echo $ru; ?>images/drop_down_arrow.png" /></a> </div>
              <div class="hide_show_outer_div">
                <div id="hide_show_div_e" style="display:none; width:35%;"> <span style="padding:0px !important; margin:0 !important;">				
                  <?php if(isset($_POST['search_cat']) and $_POST['search_cat'] != '' and $_POST['search_cat'] != 'All Trades')
				  				 echo $_POST['search_cat'];
							  else 
							  	echo 'All Trades'; ?>
                  </span>
                  <?php 
					$subCatStr = '';
					$res = mysql_query("SELECT * FROM `tt_category` WHERE `cat_type` = '1' and `p_catid` = '0' ORDER BY `cat_name` ASC");
					while($row = mysql_fetch_array($res)){
					?>
                  <span style="padding:0px !important; margin:0 !important;"><?php echo $row['cat_name']; ?></span>
                  <?php 
						$res_sub = mysql_query("SELECT * FROM `tt_category` WHERE `cat_type` = '1' and `p_catid` = '0' ORDER BY `cat_name` ASC");
						while($row_sub = mysql_fetch_array($res_sub)){
							$subCatStr = '<span>' . $row_sub['cat_name'] . '</span>';
						}
					}
					?>
                </div>
                <input type="hidden" name="search_cat" id="search_cat" value="<?php echo $_POST['search_cat']; ?>" />
              </div>
            </div>
          </div>
          <?php /*
          <input type="hidden" name="searchby" id="searchby" value="keyword" />
          <div class="short_text_bar liting_barshort_text"> <span class="key_word">Sub Category (optional)</span>
            <div class="short_text_flied_bar short_listing_input_flied">
              <div id="sub_cat_div_disable" style="display:none;"> <a><span>Sub Category (optional)</span></a> <a><img src="<?php echo $ru; ?>images/gray_drop_down_arrow.png" /></a> </div>
              <div id="sub_cat_div" onClick="HideShow_f();" style="cursor:pointer;"> <a><span>Sub Category (optional)</span></a> <a><img src="<?php echo $ru; ?>images/drop_down_arrow.png" /></a> </div>
              <div class="hide_show_outer_div">
                <div id="hide_show_div_f" style="display:none; width:39%;"> <?php echo $subCatStr; ?> </div>
              </div>
              <input type="hidden" name="search_sub_cat" id="search_sub_cat" value="" />
            </div>
          </div>
		  */?>
          <div class="short_text_bar liting_barshort_text" style="margin-top:10px;">
            <div class="short_text_flied_bar short_listing_input_flied" style="width:150px;">
              <input name="txt_location" type="text" value="<?php if(isset($_POST['txt_location']) and $_POST['txt_location'] != '' and $_POST['txt_location'] != 'e.g city or postcode'){ echo $_POST['txt_location']; $color = ''; }else{ $color = 'color:#bebebe;'; echo 'e.g city or postcode';} ?>" onfocus="if(this.value == 'e.g city or postcode'){this.value=''; this.style.color='';}" onblur="if(this.value==''){this.value='e.g city or postcode'; this.style.color='#bebebe';}" style="<?php echo $color; ?>width:120px; margin-left:0;"/>
            </div>
            <div class="search_bar_outer" style="width:100px; margin:0;">
              <input type="submit" name="detailed_search" value="Search" class="search_btn2" />
            </div>
          </div>
          <?php /*
          <div class="short_text_bar liting_barshort_text">
            <div class="short_text_flied_bar short_listing_input_flied">
              <div class="hide_show_outer_div_drow" id="miles_div"><a href="javascript:;" onClick="HideShow_g();"><span>Distance in miles</span></a><a href="javascript:;" onClick="HideShow_g();"><img src="<?php echo $ru; ?>images/drop_down_arrow.png" /></a></div>
              <div class="hide_show_outer_div">
                <div id="hide_show_div_g" style=" display:none; width:39%;">
                  <?php $distanc = array(5,10,25,50,75,100); 
					foreach($distanc as $dist)
						echo '<span>'.$dist.' Miles</span>';
					?>
                  <input type="hidden" name="search_miles" id="search_miles" value="" />
                </div>
              </div>
            </div>
          </div>
		  */?>
          <div class="bottom_line" style="float:left; width:95%; margin:27px 0 11px;"></div>
        </div>
      </form>
    </div>
	<?php 
	
		$qry_exe = mysql_query($quotes_query);		
		if(mysql_num_rows($qry_exe)){
		while($qry_row = mysql_fetch_array($qry_exe)){
		
	?>
    <div onmouseout="hideshowOut(<?php echo $qry_row['quotes_id'];?>)" onmouseover="hideshowOver(<?php echo $qry_row['quotes_id'];?>)" class="listing_outer_tabe">
      <div id="buss_cover_div_<?php echo $qry_row['quotes_id'];?>" style="height:auto;" class="listing_inner_top_bar">
        <div class="listing_inner_top_bar_a"> 
			<span>
				<a href="<?php echo $ru.'job_particulars/'.$qry_row['quotes_id']."_".encodeURL($qry_row['title']);?>" style="color:#5F5F5F; text-decoration:none;"><?php echo stripslashes(ucfirst($qry_row['keyword']));?></a>
			</span>
			<div class="listing_inner_top_bar_a_right"> 
				<span style="width:100% !important;"><b>Posted:</b> <?php echo $qry_row['posted_date'];?> &nbsp;<b>Views:</b> <?php 
				$res_view = mysql_query("SELECT COUNT(`Id`) FROM `tt_jobs_view` WHERE `jobId` = '".$qry_row['quotes_id']."'");
				$row_view = mysql_fetch_array($res_view);
				echo $row_view[0];?> </span>
			</div>
				</div>
        
        <p style="margin-left:10px; font-weight:bold;"><a href="<?php echo $ru.'job_particulars/'.$qry_row['quotes_id']."_".encodeURL($qry_row['title']);?>" style="color:#5F5F5F; text-decoration:none;"><?php echo ucfirst( $qry_row['title'] );?></a></p>
        <p class="listing_inner_top_p" style="margin-left:10px; width:auto;"><img src="<?php echo $ru; ?>images/listing_home_icon.png">
		<a href="<?php echo $ru.'job_particulars/'.$qry_row['quotes_id']."_".encodeURL($qry_row['title']);?>" style="color:#5F5F5F; text-decoration:none;"><?php echo stripslashes(ucfirst( $qry_row['message']));?></a></p>
      </div>
      <div style="visibility: hidden;" id="showhidediv_<?php echo $qry_row['quotes_id'];?>" class="listing_inner_footer_bar">
        <div class="listing_info_bar">
          <div class="listing_info_text"><a style="text-decoration:none;  color: #7A9000;" href="<?php echo $ru.'job_particulars/'.$qry_row['quotes_id']."_".encodeURL($qry_row['title']);?>">More information</a></div>
          <!-- <img src="http://192.168.5.66/mehran/tt/images/more_info_icon.png"  />-->
        </div>
        <div class="listing_inner_right_bar">
		  <?php /*
          <div data-show-faces="false" data-width="70" data-layout="button_count" data-send="false" class="fb-like fb_edge_widget_with_comment fb_iframe_widget"><span>
            <iframe scrolling="no" id="f15dfc82e2bc90a" name="f1ad121cc252986" style="border: medium none; overflow: hidden; height: 20px; width: 90px;" title="Like this content on Facebook." class="fb_ltr" src="http://www.facebook.com/plugins/like.php?api_key=121377744618272&amp;channel_url=https%3A%2F%2Fs-static.ak.fbcdn.net%2Fconnect%2Fxd_proxy.php%3Fversion%3D3%23cb%3Dfa6264887194c%26origin%3Dhttp%253A%252F%252F192.168.5.66%252Ff3624531cff2cb4%26relation%3Dparent.parent%26transport%3Dpostmessage&amp;extended_social_context=false&amp;href=http%3A%2F%2F192.168.5.66%2Fmehran%2Ftt%2Flistings%2Fall%2Fall%2F&amp;layout=button_count&amp;locale=en_US&amp;node_type=link&amp;sdk=joey&amp;send=false&amp;show_faces=false&amp;width=90"></iframe>
            </span></div>
          <iframe scrolling="no" frameborder="0" allowtransparency="true" src="http://platform.twitter.com/widgets/tweet_button.1326407570.html#_=1328331223316&amp;_version=2&amp;count=horizontal&amp;enableNewSizing=false&amp;id=twitter-widget-2&amp;lang=en&amp;original_referer=http%3A%2F%2F192.168.5.66%2Fmehran%2Ftt%2Flistings%2Fall%2Fall%2F&amp;size=m&amp;text=Trades%20Tool%20directory%20%7C%20Find%20local%20trades%20people&amp;url=http%3A%2F%2F192.168.5.66%2Fmehran%2Ftt%2Flistings%2Fall%2Fall%2F" class="twitter-share-button twitter-count-horizontal" style="width: 110px; height: 20px;" title="Twitter Tweet Button"></iframe>
          <script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
          <div id="___plusone_1" style="height: 20px; width: 90px; display: inline-block; text-indent: 0pt; margin: 0pt; padding: 0pt; background: none repeat scroll 0% 0% transparent; border-style: none; float: none; line-height: normal; font-size: 1px; vertical-align: baseline;">
            <iframe width="100%" scrolling="no" frameborder="0" title="+1" vspace="0" tabindex="-1" style="position: static; left: 0pt; top: 0pt; width: 90px; margin: 0px; border-style: none; height: 20px; visibility: visible;" src="https://plusone.google.com/_/+1/fastbutton?url=http%3A%2F%2F192.168.5.66%2Fmehran%2Ftt%2Flistings%2Fall%2Fall%2F&amp;size=medium&amp;count=true&amp;annotation=&amp;hl=en-US&amp;jsh=m%3B%2F_%2Fapps-static%2F_%2Fjs%2Fgapi%2F__features__%2Frt%3Dj%2Fver%3Dc4HND9yJipY.en_GB.%2Fsv%3D1%2Fam%3D!uXA1SJUHioGIFdxJYA%2Fd%3D1%2F#id=I2_1328331221737&amp;parent=http%3A%2F%2F192.168.5.66&amp;rpctoken=395477530&amp;_methods=onPlusOne%2C_ready%2C_close%2C_open%2C_resizeMe%2C_renderstart" name="I2_1328331221737" marginwidth="0" marginheight="0" id="I2_1328331221737" hspace="0" allowtransparency="true"></iframe>
          </div>
			<script type="text/javascript">
				(function() {
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
				})();
			</script>
			*/?>
        </div>
      </div>
    </div>
	<?php } }?>
	<?php include("common/paginglayout_listing.php");?>
  </div>
  <?php //include("common/find-job-left.php"); ?>
</div>
<?php 
unset($_SESSION['user_con_err']);
unset($_SESSION['contact']);
?>
<script>
function HideShow_e(){
	if(document.getElementById('hide_show_div_e').style.display == 'none')
		jQuery('#hide_show_div_e').slideDown('slow');
	else
		jQuery('#hide_show_div_e').slideUp('slow');
}
		
jQuery('#hide_show_div_e span').live('click',function(){
	/*$.ajax({
	  url: '<?php echo $ru; ?>process/subcats.php?catname='+$(this).html(),
	  success: function(data) {
		$('#hide_show_div_f').html(data);
	  }
	});
	jQuery('#txt_keyword').attr('disabled', 'disabled');
	jQuery('#searchby').val('category');*/
	if($(this).html() == 'All Trades'){
		jQuery('#search_cat').val('');
		jQuery('#cat_div a span').css("color","#CCCCCC")
	}else{
		jQuery('#search_cat').val($(this).html());
		jQuery('#cat_div a span').css("color","#000000")
	}
	//jQuery('#search_sub_cat').val('');
	jQuery('#cat_div a span').html($(this).html());
	//jQuery('#sub_cat_div a span').html('Sub Category (optional)');
	//jQuery('#sub_cat_div a span').css("color","#CCCCCC")
	jQuery('#hide_show_div_e').slideUp('slow');
})
 
</script>
