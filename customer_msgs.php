<?php 
include_once('connect/connect.php');
include('api_class.php');
if (isset ($_GET['id']))
{
	/*$var="http://api.smilesn.com/sendsms?sid=167d2es224s9494eqs23&receivenum=03xx1234567&textmessage=Hello world&sendernum=03439255516";
	$ne="http://api.smilesn.com/session?username=2&password=rainbow8333";
	$as=json_encode($ne);
	echo "<pre>";
	print_r($as);
	exit;*/
	$sql = "Update  tt_quotes set status ='Active' where quotes_id='".$_GET['id']."' ";// exit;
	$mysq=mysql_query($sql);
	
	header('location:'.$ru.'cases.php');
}

	
?>
<div class="map_page_right_bar listing_right_bar">
  
  <div class="main_quote_bar_b">
  <div class="map_page_right_bar">
    <div class="brued_crum_bar brued_crum_bar_c">
      <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Home</a> > <a href="<?php echo $ru;?>member/manage_applicants/<?php echo $job_id; ?>/" style="text-decoration:none; color:#999999;">Manage Applicants</a> > <a href="<?php echo $ru;?>member/customer_msgs/<?php echo $job_id ?>/<?php echo $to_id; ?>" style="text-decoration:none; color:#999999;"> <span class="change">Messages</span></a></span> </div>
    </div>
    <div class="profile_page_left">
      <div class="listing_wrapper_left"> <span style="width:97%;">Send Message To Trader </div>
      <form method="post" action="<?php echo $ru; ?>process/process_customer_msg.php">
	  <input type="hidden" name="from_id" value="<?php echo  $user_id; ?>" />
	  <input type="hidden" name="to_id" value="<?php echo $to_id; ?>" />
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
			  
			  
			  <div class="error" id="error_msg" <?php if( isset($_SESSION['get_quote_err']['msg']) ) echo 'style="display:block; width:220px;"'; else echo 'style="display:none; width:220px;"';?>><?php echo $_SESSION['get_quote_err']['msg']; ?></div>
			  
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
	
	
	//include("common/paginglayout_listing.php");?>
  </div>
  <?php //include("common/find-job-left.php"); ?>
</div>
  
	<?php //include('notice.php'); ?>
    
</div>

<script>
// ++++++++++++++++++======= this is used for the I'm looking for 
$("#msg").focus(function(){
	$('#error_msg').hide();
});
$("#msg").blur(function(){
	$.ajax({
	  url: "<?php echo $ru?>process/swear-words.php?str="+$(this).val(),
	  context: document.body,
	  success: function(data){
	  	if(data == 'swear'){
			$('#error_msg').html('Swearing is not tolerated on TradesTools');
			$('#error_msg').show();
		}/*else if(data == 'less'){
			$('#error_txt_keyword').html('Must be at least 10 characters long');
			$('#error_txt_keyword').show();
		}*/
	  }
	});
});
</script>
