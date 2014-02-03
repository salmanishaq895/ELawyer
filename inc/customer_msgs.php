<?php  
if (isset ($_GET['s']))
{
	$_SESSION['redirect']['page'] = trim($_GET['s'] );
	$_SESSION['redirect']['pagedata'] =	trim($_GET['o']);
}

$job_id = $_GET['o'];

$user_id = $_GET['p'];

//$trader_id = $_SESSION['TTLOGINDATA']['USERID'];



$job_qry = "SELECT * FROM tt_quotes where 	quotes_id = '".$job_id."' "; //exit;
$exe_job_qry = @mysql_query($job_qry);
$job_data = @mysql_fetch_array($exe_job_qry);
$job_posted_by = $job_data['userId']; 	


$messages_qry = "SELECT * FROM tt_messages where 	jobId = '".$job_id."' and (`from` = '".$user_id."' or `to` = '".$user_id."') ORDER BY  created desc "; //exit;
	
?>
<div class="map_page_right_bar listing_right_bar">
  
  <div class="main_quote_bar_b">
  <div class="map_page_right_bar">
    <div class="brued_crum_bar brued_crum_bar_c">
      <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Home</a> > <a href="<?php echo $ru;?>member/applied_job/" style="text-decoration:none; color:#999999;">Applied Jobs</a> > <a href="<?php echo $ru;?>messages/<?php echo $job_id ?>" style="text-decoration:none; color:#999999;"> <span class="change">Messages</span></a></span> </div>
    </div>
    <div class="profile_page_left">
      <div class="listing_wrapper_left"> <span style="width:97%;">Send Message </span> </div>
      <form method="post" action="<?php echo $ru; ?>process/process_customer_msg.php">
	  <input type="hidden" name="from_id" value="<?php echo  $user_id; ?>" />
	  <input type="hidden" name="to_id" value="<?php echo $job_posted_by; ?>" />
	  <input type="hidden" name="job_id" value="<?php echo $job_id; ?>" />
	  
	  <div class="search-frm" style="width:643px;">
          <div class="short_text_bar liting_barshort_text" style="margin-top:10px;">
            <div class="short_text_flied_bar short_listing_input_flied">
              <div id="cat_div_disable" style="display:none;"> <a><span>Category Search</span></a> <a><img src="<?php echo $ru; ?>images/gray_drop_down_arrow.png" /></a> </div>
              
              
            </div>
          </div>
          
          <div class="short_text_bar liting_barshort_text" style="margin-top:10px;">
            <div class="short_text_flied_bar short_listing_input_flied" style="width:150px; height:90px;">
              
			  
			  <textarea wrap="soft" style="width:563px;height:70px;margin-right:5px;" name="msg" id="msg" ><?php echo $_SESSION['register_interest']['msg']; ?></textarea>
			  
            </div>
            <div class="search_bar_outer" style="width:100px; float:none; padding-top:35px;">
              <input type="submit" name="detailed_search" value="Send" class="search_btn2" />
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
	
		$qry_exe = mysql_query($messages_qry);		
		if(mysql_num_rows($qry_exe)){
		while($qry_row = mysql_fetch_array($qry_exe)){
		
	?>
    <div onMouseOut="hideshowOut(<?php echo $qry_row['quotes_id'];?>)" onMouseOver="hideshowOver(<?php echo $qry_row['quotes_id'];?>)" class="listing_outer_tabe">
      <div id="buss_cover_div_<?php echo $qry_row['quotes_id'];?>" style="height:auto;" class="listing_inner_top_bar">
        <div class="listing_inner_top_bar_a"> 
			<span>
				<a href="#" style="color:#5F5F5F; text-decoration:none;"><?php echo stripslashes(ucfirst($qry_row['keyword']));?></a>
			</span>
			<div class="listing_inner_top_bar_a_right"> 
				<span style="width:100% !important;"><b>Posted:</b> <?php echo $qry_row['created'];?> &nbsp; 
				<?php 
				echo "From: ".$qry_row['message_frm'];
				
				?> 
				
				</span>
			</div>
				</div>
        
        <p style="margin-left:10px; font-weight:bold;"><a href="javascript:" style="color:#5F5F5F; text-decoration:none;"><?php echo stripslashes(ucfirst( $qry_row['title']));?></a></p>
        <p class="listing_inner_top_p" style="margin-left:10px;"><img src="<?php echo $ru; ?>images/listing_home_icon.png">
		<a href="javascript:" style="color:#5F5F5F; text-decoration:none;"><?php echo ucfirst( $qry_row['message'] );?></a></p>
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
	<?php //include("common/paginglayout_listing.php");?>
  </div>
  <?php //include("common/find-job-left.php"); ?>
</div>
  
	<?php //include('notice.php'); ?>
    
</div>
