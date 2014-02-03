<?php
	$bId = $_GET['o'];
	$business_qry = "SELECT  * FROM tt_quotes  where quotes_id =$bId"; //exit;
	$business_rs = mysql_query($business_qry) or die (mysql_error());
	$buiness_row = mysql_fetch_array($business_rs);

	if ( !isset ($_SESSION['biz_reg']) or ($_SESSION['biz_reg']['busId'] != $bId ) )
	{
		$_SESSION['biz_reg'] =  $buiness_row;
		//$_SESSION['biz_reg']['expirydate'] = convert_db_Date($buiness_row['expirydate']);
		
		
	}
//}
?>
<script type="text/javascript" src="<?php echo $ru;?>datepicker/jquery.js"></script>
<script type="text/javascript" src="<?php echo $ru;?>datepicker/date.js"></script>
<script type="text/javascript" src="<?php echo $ru;?>datepicker/jquery_002.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $ru;?>datepicker/datePicker.css" />   
          
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
  $("#expirydate").datepicker({dateFormat:'dd-mm-yy'});
  $("#ondate").datepicker({dateFormat: "yy-mm-dd", minDate:0});
});
Date.firstDayOfWeek = 0;
Date.format = 'dd-mm-yyyy';
$(function()
{
	//$('#startDate').datePicker({clickInput:true})
	//$('#expirydate').datePicker({clickInput:true})
});
function setdatevalue(pack){
	document.getElementById('startDate').value= '<?php echo date("Y-m-d")?>';
	document.getElementById('expirydate').value= pack.value;
}
			function ValidateField($field){
			
				if($field.value=='SPECIFIC'){
					$("#specific_date").show();	
				}
				else{
					$("#specific_date").hide();
				}
			}
			
</script> 
<div class="map_page_right_bar listing_right_bar">
  <div class="brued_crum_bar brued_crum_bar_c">
    <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"> <a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Home > </a><a href="<?php echo $ru;?>member/profile" style="text-decoration:none; color:#999999;">  Account Panel > </a> <a href="<?php echo $ru;?>member/edit_jobs/<?php echo $bId;?>" style="text-decoration:none; color:#999999;">  <span class="change">Jobs</span> </a></span></div>
  </div>
  <form name="form1" id="form1" method="post" action="<?php echo $ru;?>process/process_jobb.php" enctype="multipart/form-data" >
    <input type="hidden" name="userId" value="<?php echo $_SESSION['TTLOGINDATA']['USERID'];?>" />
	 <input type="hidden" name="bId" value="<?php echo $_SESSION['biz_reg']['quotes_id'];?>" />
    <div class="cpanel_right_bar">
    <div class="company_detail_description"> <span class="company_detail_span">Edit Job - <?php echo stripslashes($buiness_row['name']) ?></span>
      <div class="cpanel_right_inner_bar_a">
        <?php if( isset($_SESSION['biz_reg_err']) ) {?>
        <div class="notification error png_bg" style="margin:15px 0; background-color:#E4E4E4"> <a href="javascript:;" onclick="$('.notification').hide();" class="close"><img src="<?php echo $ru;?>images/cross_grey_small.png" title="Close this notification" alt="close" /></a>
          <div>
            <?php //echo $_SESSION['update_profile']; 
			foreach ($_SESSION['biz_reg_err'] as $ek=>$ev ) echo $ev ."<br />"; ?>
          </div>
        </div>
        <?php }  unset ($_SESSION['biz_reg_err']);  ?>
        <div class="input_flied">
          <div>I'm looking for:  <samp>* </samp></div>
		  
          <input type="text" name="txt_keyword" id="txt_keyword" value="<?php echo stripslashes($_SESSION['biz_reg']['keyword']);?>"  class="text-input" border="0" />
		  <div class="error" id="error_txt_keyword" <?php if(isset($_SESSION['get_quote_err']['txt_keyword'])) echo 'style="display:block; width:161px;"'; else echo 'style="display:none; width:161px;"';?>><?php echo $_SESSION['get_quote_err']['txt_keyword']; ?></div>

        </div>
		
		
		
		<div class="input_flied">
          <div>Jop City:  <samp>* </samp></div>
           <input type="text" name="txt_location" id="txt_location" value="<?php echo stripslashes($_SESSION['biz_reg']['location']);?>" />
		    <div class="error" id="error_txt_location" <?php if(isset($_SESSION['get_quote_err']['txt_location'])) echo 'style="display:block; width:161px;"'; else echo 'style="display:none; width:161px;"';?>><?php echo $_SESSION['get_quote_err']['txt_location']; ?></div>

        </div>
		
		
		
		
		
		<div class="input_flied">
          <div>Job Postcode:  <samp>* </samp></div>
           <input type="text" name="postcode" id="postcode" value="<?php echo stripslashes($_SESSION['biz_reg']['post_code']);?>" />
		    <div class="error" id="error_postcode" <?php if(isset($_SESSION['get_quote_err']['postcode'])) echo 'style="display:block; width:161px;"'; else echo 'style="display:none; width:161px;"';?>><?php echo $_SESSION['get_quote_err']['postcode']; ?></div>

        </div>
		
		
		
		
		
		
		<div class="input_flied">
          <div>Within:  <samp>* </samp></div>
          <select name="miles" id="miles">
            <option value="10" <?php if($_SESSION['biz_reg']['miles']=='10') echo 'selected="selected"';?> >10 Miles</option>
            <option value="25" <?php if($_SESSION['biz_reg']['miles']=='25') echo 'selected="selected"';?>>25 Miles</option>
            <option value="50" <?php if($_SESSION['biz_reg']['miles']=='50') echo 'selected="selected"';?>>50 Miles</option>
            <option value="75" <?php if($_SESSION['biz_reg']['miles']=='75') echo 'selected="selected"';?>>75 Miles</option>
            <option value="100" <?php if($_SESSION['biz_reg']['miles']=='100') echo 'selected="selected"';?>>100 Miles</option>
          </select>
        </div>
		
		<div class="input_flied">
          <div>Quote Request title:   <samp>* </samp></div>
          <input name="title" id="title" type="text" value="<?php echo stripslashes($_SESSION['biz_reg']['title']) ?>" />
		  
		  <div class="error" id="error_title" <?php if( isset($_SESSION['get_quote_err']['title']) ) echo 'style="display:block; width:161px;"'; else echo 'style="display:none; width:161px;"';?>><?php echo $_SESSION['get_quote_err']['title']; ?></div>
   
		  
        </div>
		
		<div class="input_flied">
          <div>Describe what you need:  <samp>* </samp></div>
           <textarea name="message" id="message" style="width:305px; height:125px;" onkeyup="return textCounter(400)" ><?php echo stripslashes($_SESSION['biz_reg']['message']); ?></textarea>
		   
		   <div class="error" id="error_message" <?php if( isset($_SESSION['get_quote_err']['message']) ) echo 'style="display:block; width:220px;"'; else echo 'style="display:none; width:220px;"';?>><?php echo $_SESSION['get_quote_err']['message']; ?></div>
		   
		   <samp style="margin:2% 0 1% 34%; font-size:12px; font-family:'MyriadProCondensed'; float:left;" id="colorr">
				You can enter upto <samp id="inputString" style="font-size:12px;font-family:'MyriadProCondensed';"><?php
				echo (400 - count(explode(' ',$_SESSION['biz_reg']['description'])));
				 ?></samp> words. And Minimum 30 words</samp>
		<script type="text/javascript">		
			function textCounter(maxlimit) {
				var k = document.getElementById('message');
				actstr = k.value.replace('  ',' ');
				
				if (k.selectionStart) {
					cursorPos = k.selectionStart;
				} else if (!document.selection) {
					var cursorPos = 0;
				}
				var wcount = actstr.split(' ').length;
				//alert(wcount);
				if(wcount>30){
				//document.getElementById('colorr').css({"color":"red"}) ;
				//$("#colorr").css("background-color","yellow");
				$("#colorr").css("color","green")
				}
				if(wcount<30){
				//document.getElementById('colorr').css({"color":"red"}) ;
				//$("#colorr").css("background-color","yellow");
				$("#colorr").css("color","#6A6A6A")
				}
				if (wcount > maxlimit){
					var str_arr = actstr.split(' ');
					var actstr2 = '';
					for (var i = 0; i < maxlimit; i++){
						if(i == 0)
							actstr2 = str_arr[i];
						else
							actstr2 += ' '+str_arr[i];
					}
					
					k.value = $.trim(actstr2);
					return false;
				}else{
				
					document.getElementById('inputString').innerHTML = maxlimit - wcount;
					return true;
				}
				
				
				
			}
			
			
			$(document).ready(function() {
			$("#ondate").datepicker({dateFormat: "yy-mm-dd", minDate:0});
			});
			</script>
		   
        </div>
		
		
		
		
		<div class="input_flied">
          <div>Your phone Number:   <samp>* </samp></div>
          <input type="text" name="phone" id="phone" style="width:130px;" value="<?php echo $_SESSION['biz_reg']['phone']?>" />
        </div>
		
		
		
		
		
		
		  <?php if(isset($_SESSION['biz_reg']['file_attechmen']) and $_SESSION['biz_reg']['file_attechmen']!=""){ ?>	
							
						<img src="<?php echo $ru."media/quotes/".$_SESSION['biz_reg']['quotes_id']."/thumb/".$_SESSION['biz_reg']['file_attechmen'];?>" title="thumb" alt="" />
							<?php } ?>
        <div class="input_flied">
          <div>File attachments (Optional):</div>
		  
          <input type="file" name="attachment" id="attachment"/>
        </div>
        <div class="input_flied">
          <div>When do you need it by?<samp>* </samp></div>
          <select name="within" id="within" onchange="javascript:ValidateField(this);">
		  	<option value="">- Select -</option>
			<option value="SPECIFIC" <?php if($_SESSION['biz_reg']['within'] == 'SPECIFIC') echo 'selected="selected"'; ?>>On a specific date</option>
			<option value="WHENEVER" <?php if($_SESSION['biz_reg']['within'] == 'WHENEVER') echo 'selected="selected"'; ?>>Whenever</option>
		  	<option value="WEEKS" <?php if($_SESSION['biz_reg']['within'] == 'WEEKS') echo 'selected="selected"'; ?>>Within the next couple of weeks</option>
		  	<option value="ASAP" <?php if($_SESSION['biz_reg']['within'] == 'ASAP') echo 'selected="selected"'; ?>>As soon as possible</option>            
          </select>
		   <?php if(isset($_SESSION['biz_reg_err']['within'])){?>		  
		  
          <div class="error" style="width:100%;"><?php echo $_SESSION['biz_reg_err']['within']; ?></div>
          <?php } ?>
        </div>
		
		<div class="input_flied" id="specific_date" <?php if($_SESSION['biz_reg']['within'] == 'SPECIFIC') echo 'style="display:block;"'; else echo 'style="display:none; "';?>>
          <div>Enter Date : <samp>* </samp></div>
          <input type="text" name="ondate" id="ondate" style="width:130px;" value="<?php echo $_SESSION['biz_reg']['ondate']?>" /> 
          <?php if(isset($_SESSION['biz_reg_err']['ondate'])){?>		  
		  
          <div class="error" style="width:100%;"><?php echo $_SESSION['biz_reg_err']['ondate']; ?></div>
          <?php } ?>
        </div>
		
		<div class="input_flied" style="font-size:15px;">
		<div> Status: </div>
		<input type="radio" name="status" id="status_active" value="Active" <?php if($_SESSION['biz_reg']['status'] == 'Active') echo 'checked="checked"'; ?>  style="width:50px;"/>
		
         Active
		
          <input type="radio" name="status" id="status_expired" value="Expired" <?php if($_SESSION['biz_reg']['status'] == 'Expired') echo 'checked="checked"'; ?> style="width:50px;"/>
        
		 Expired
	
		</div>
		
       
		<div class="input_flied" style="font-size:15px;">
          <div>Prefer Contact Method: <samp>* </samp></div>
<input type="radio" name="contact_method" id="contact_method_email" value="Email" <?php if($_SESSION['biz_reg']['contact_method'] == 'Email') echo 'checked="checked"'; ?>  style="width:50px;"/>
          Email
          <input type="radio" name="contact_method" id="contact_method_tel" value="Telephone" <?php if($_SESSION['biz_reg']['contact_method'] == 'Telephone') echo 'checked="checked"'; ?> style="width:50px;"/>
        Telephone
          <input type="radio" name="contact_method" id="contact_method_either" value="Either" <?php if($_SESSION['biz_reg']['contact_method'] == 'Either') echo 'checked="checked"'; ?> style="width:50px;"/>
          Either       </div>
		
	
		
		
		
		<div class="profile_botton_outer">
          <div class="contact_us_gray_botton_inner cpanel_right_botton_button">
            <input type="submit" name="Update_Job" id="Update_Job" value="Update" class="inner_gray_botton" />
          </div>
        </div>
      </div>
    </div>
	</div>
  </form>
</div>
<?php unset($_SESSION['biz_reg']); ?>
<script>
// ++++++++++++++++++======= this is used for the I'm looking for 
$("#txt_keyword").focus(function(){
	$('#error_txt_keyword').hide();
});
$("#txt_keyword").blur(function(){
	$.ajax({
	  url: "<?php echo $ru?>process/swear-words.php?str="+$(this).val(),
	  context: document.body,
	  success: function(data){
	  	if(data == 'swear'){
			$('#error_txt_keyword').html('Swearing is not tolerated on TradesTools');
			$('#error_txt_keyword').show();
		}/*else if(data == 'less'){
			$('#error_txt_keyword').html('Must be at least 10 characters long');
			$('#error_txt_keyword').show();
		}*/
	  }
	});
});


//+++++++++++++++++++++===== this is used for zip or location 

$("#txt_location").focus(function(){
	$('#error_txt_location').hide();
});
$("#txt_location").blur(function(){
	$.ajax({
	  url: "<?php echo $ru?>process/swear-words.php?str="+$(this).val(),
	  context: document.body,
	  success: function(data){
	  	if(data == 'swear'){
			$('#error_txt_location').html('Swearing is not tolerated on TradesTools');
			$('#error_txt_location').show();
		}/*else if(data == 'less'){
			$('#error_title').html('Must be at least 10 characters long');
			$('#error_title').show();
		}*/
	  }
	});
});







//+++++++++++++++++++++===== this is used for zip or location 

$("#postcode").focus(function(){
	$('#error_postcode').hide();
});
$("#postcode").blur(function(){
	$.ajax({
	  url: "<?php echo $ru?>process/swear-words.php?str="+$(this).val(),
	  context: document.body,
	  success: function(data){
	  	if(data == 'swear'){
			$('#error_postcode').html('Swearing is not tolerated on TradesTools');
			$('#error_postcode').show();
		}/*else if(data == 'less'){
			$('#error_title').html('Must be at least 10 characters long');
			$('#error_title').show();
		}*/
	  }
	});
});





//  +++++++++++++ this is used for the title swear word
$("#title").blur(function(){
	$.ajax({
	  url: "<?php echo $ru?>process/swear-words.php?str="+$(this).val(),
	  context: document.body,
	  success: function(data){
	  	if(data == 'swear'){
			$('#error_title').html('Swearing is not tolerated on TradesTools');
			$('#error_title').show();
		}else if(data == 'less'){
			$('#error_title').html('Must be at least 10 characters long');
			$('#error_title').show();
		}
	  }
	});
});
$("#message").focus(function(){
	$('#error_message').hide();
});
$("#message").blur(function(){
	$.ajax({
	  url: "<?php echo $ru?>process/swear-words-desc.php?str="+$(this).val(),
	  context: document.body,
	  success: function(data){
	  	if(data == 'swear'){
			$('#error_message').html('Swearing is not tolerated on TradesTools');
			$('#error_message').show();
		}else if(data == 'less'){
			$('#error_message').html('Must be at least 30 words long and less than 400 words');
			$('#error_message').show();
		}
	  }
	});
});
</script>
