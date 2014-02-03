

<div class="main_quote_bar_b" style="margin-top:13px;">
  <div class="brued_crum_bar brued_crum_bar_c">
    <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>quotes.php" style="text-decoration:none; color:#999999;">Post Your Case</a></span> </div>
  </div>
  <form name="form1" id="form1" method="post" action="<?php echo $ru;?>process/process_quotes.php" enctype="multipart/form-data">
    <div class="profile_page_left">
      <div class="company_detail_description quote-page"> <span class="company_detail_span">Post Your Case</span>
        <?php if ( isset ($_SESSION['user_con_err']['sent']) ) {?>
        <div class="notification error png_bg">
          <div style="margin-left:172px;"> <?php echo $_SESSION['user_con_err']['sent']; ?> </div>
        </div>
        <?php } ?>
		
		
		<?php if ( isset ($_SESSION['msg']) ) {?>
        <div class="notification error png_bg">
          <div style="margin-left:172px;"> <?php echo $_SESSION['msg']; ?> </div>
        </div>
        <?php } unset($_SESSION['msg']);?>
		
		
        <div class="input_flied">
          <div>Name: <samp>* </samp></div>
          <input type="text" name="txt_keyword" id="txt_keyword" value="<?php echo $_SESSION['get_quote']['txt_keyword'];?>" />
          <div class="error" id="error_txt_keyword" <?php if(isset($_SESSION['get_quote_err']['txt_keyword'])) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['get_quote_err']['txt_keyword']; ?></div>
		  
		  
        </div>
        <div class="input_flied">
          <div>Email: <samp>* </samp></div>
          <input type="text" name="txt_location" id="txt_location" value="<?php echo $_SESSION['get_quote']['txt_location'];?>" />
         
		 <div class="error" id="error_txt_location" <?php if(isset($_SESSION['get_quote_err']['txt_location'])) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['get_quote_err']['txt_location']; ?></div>
		 </div>
		 
		 
		 <div class="input_flied">
          <div>Your phone Number: <samp>* </samp></div>
          <input type="text" name="phone" id="phone" style="width:130px;" value="<?php echo $_SESSION['get_quote']['phone']?>" />
          <?php if(isset($_SESSION['get_quote_err']['phone'])){?>
          <div class="error" ><?php echo $_SESSION['get_quote_err']['phone']; ?></div>
          <?php } ?>
        </div>
		 
		
        <div class="input_flied">
          <div>Address: <samp>* </samp></div>
          <input name="title" id="title" type="text" value="<?php echo $_SESSION['get_quote']['title'] ?>" />
          <div class="error" id="error_title" <?php if( isset($_SESSION['get_quote_err']['title']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['get_quote_err']['title']; ?></div>
        </div>
        <div class="input_flied">
          <div>Detail of Case: <samp>* </samp></div>
          <textarea name="message" id="message" style="width:392px; height:125px;" onkeyup="return textCounter(400)" ><?php echo $_SESSION['get_quote']['message'] ?></textarea>
          <div class="error" id="error_message" <?php if( isset($_SESSION['get_quote_err']['message']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['get_quote_err']['message']; ?></div>
		  </div>
		<samp style="margin:0 0 0 230px; font-size:15px; font-family:'MyriadProCondensed';" id="colorr">
				Please enter a minimum of 30 words and max <samp id="inputString" style="font-size:15px;font-family:'MyriadProCondensed';"> <?php
				echo (400 - count(explode(' ',$_SESSION['biz_reg']['description'])));
				 ?></samp>word</samp>
				
				<!--You can enter upto <samp id="inputString" style="font-size:12px;font-family:'MyriadProCondensed';">< ?php
				echo (400 - count(explode(' ',$_SESSION['biz_reg']['description'])));
				 ?></samp> words. And Minimum 30 words</samp>-->
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
			function ValidateField($field){
			
				if($field.value=='SPECIFIC'){
					$("#specific_date").show();	
				}
				else{
					$("#specific_date").hide();
				}
			}
			$(document).ready(function() {
			$("#ondate").datepicker({dateFormat: "yy-mm-dd", minDate:0});
			});
			</script>
        
        <div class="input_flied">
          <div>FIR attachments *: </div>
          <?php if(!empty($_SESSION['get_quote_err']['attachment'])) echo $_SESSION['get_quote']['attachment']."<br/>"; ?>
          <input type="file" name="attachment" id="attachment"/>
          
          
        </div> <div class="error" style="float:left; margin-left:300px"><?php echo $_SESSION['get_quote_err']['attachment']; ?></div>
        
		
		<div class="input_flied" id="specific_date" <?php if($_SESSION['get_quote']['within'] == 'SPECIFIC') echo 'style="display:block;"'; else echo 'style="display:none;"';?>>
          <div>Enter Date : <samp>* </samp></div>
          <input type="text" name="ondate" id="ondate" style="width:130px;" value="<?php echo $_SESSION['get_quote']['ondate']?>" readonly="readonly"/> 
          <?php if(isset($_SESSION['get_quote_err']['ondate'])){?>		  
		  
          <div class="error" style="width:100%;"><?php echo $_SESSION['get_quote_err']['ondate']; ?></div>
          <?php } ?>
        </div>
		
        <div class="input_flied">
          <div>Prefer Contact Method:</div>
          <input type="radio" name="contact_method" id="contact_method_email" value="Email" checked="checked" />
          <label for="contact_method_email">Email</label>
          <input type="radio" name="contact_method" id="contact_method_tel" value="Telephone" />
          <label for="contact_method_tel">Telephone</label>
          
        </div>
        
      
      <div class="contact_us_send_botton_outer contact_us_send_botton_outer_b">
        <div class="contact_us_gray_botton_inner" style="margin:0 0 0 302px;">
          <input type="submit" name="submit_quote_2" value="Add Case" class="inner_gray_botton" />
        </div>
      </div>
    </div>
	</div>
  </form>
</div>
<?php 
unset($_SESSION['get_quote_err']);
//unset($_SESSION['contact']);
?>
<script>
$("#txt_keyword").autocomplete({
	source: "<?php echo $ru; ?>process/getkeyword.php",
	minLength: 2
});


$("#txt_location").autocomplete({
	source: "<?php echo $ru; ?>process/getlocation.php",
	minLength: 2
});


$("#title").focus(function(){
	$('#error_title').hide();
});
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
