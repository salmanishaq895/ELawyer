<?php 
$sql_profile = "select * from `tt_business` where `userId` = '".$_SESSION['TTLOGINDATA']['USERID']."'";
$result  = mysql_query($sql_profile)or die (mysql_error());
$buiness_row = mysql_fetch_array($result);
//$result	= $db->get_row($sql_profile,ARRAY_A);
if(! isset ( $_SESSION['biz_pro_reg']) )
{

$_SESSION['biz_pro_reg'] = $buiness_row;
}
?>
<script type="text/javascript" charset="utf-8">
function ShowHide(divId)
{
	document.getElementById(divId).style.display='none';
}

function Show(divId)
{
	document.getElementById(divId).style.display='block';
}
</script>

<div class="map_page_right_bar listing_right_bar">
  <div class="brued_crum_bar brued_crum_bar_c">
    <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;" >Home</a> > <a href="<?php echo $ru;?>member/statistics" style="text-decoration:none; color:#999999;"> Account Panel</a> > <a href="<?php echo $ru;?>member/trade-profile" style="text-decoration:none; color:#999999;" > <span class="change">Trader Profile</span> </a></span></div>
  </div>
  <form name="form1" id="form1" method="post" action="<?php echo $ru;?>process/process_business.php" enctype="multipart/form-data" >
    <div class="cpanel_right_bar">
      <div class="company_detail_description"> <span class="company_detail_span">Manage Trader Profile</span>
          <?php if ( isset ($_SESSION['biz_reg_err']) ) {?>
          <div class="notification error png_bg">
            <div>
              <?php foreach ($_SESSION['biz_reg_err'] as $ek=>$ev ) echo $ev ."<br />"; ?>
            </div>
          </div>
          <?php } unset ($_SESSION['biz_reg_err']);  ?>
          <div class="input_flied">
            <div>Trader Name  <samp>* </samp></div>
            <input name="name" id="name" type="text" class="text-input" value="<?php echo $_SESSION['biz_pro_reg']['name']; ?>" />
			<div class="error" id="error_name" <?php if( isset($_SESSION['error']['name']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['error']['name']; ?></div>
          </div>
          <div class="input_flied">
            <div>&nbsp;</div>
            <div class="upload_image_bar" style="text-align:left;">
              <?php
			  if(!empty($_SESSION['biz_pro_reg']['logo']) and file_exists($rootpath . "media/buisness_images/".$_SESSION['biz_pro_reg']['locationid']."/logo/thumb/".$_SESSION['biz_pro_reg']['logo']) ){
			   //if(isset($_SESSION['biz_pro_reg']['logo']) and $_SESSION['biz_pro_reg']['logo']!=""){ ?>
			  <a href="<?php echo $ru ; ?>profile/<?php echo $_SESSION['biz_pro_reg']['locationid'].'_'. encodeURL(stripslashes($_SESSION['biz_pro_reg']['name'])) ; ?>" style="text-decoration:none;">
              <img src="<?php echo $ru."media/buisness_images/".$_SESSION['biz_pro_reg']['locationid']."/logo/thumb/".$_SESSION['biz_pro_reg']['logo'];?>" title="thumb" alt="" /></a>
              <?php } else{?>
             <a href="<?php echo $ru ; ?>profile/<?php echo $_SESSION['biz_pro_reg']['locationid'].'_'. encodeURL(stripslashes($_SESSION['biz_pro_reg']['name'])) ; ?>" style="text-decoration:none;">  <img src="<?php echo $ru; ?>images/listing_bar_image.jpg" title="" alt="" /></a>
              <?php }?>
              <br/>
              Trader Logo </div>
          </div>
          <div class="input_flied">
            <div>Profile Image </div>
            <input name="logo" id="logo" type="file" value="<?php echo $_SESSION['biz_pro_reg']['logo'];?>" style="width:auto; font-size:12px;" />
            &nbsp;&nbsp;&nbsp;(image size 350 X 250 )
            <input type="hidden" name="oldImg" value="<?php echo $_SESSION['biz_pro_reg']['logo'];?>" />
          </div>
          <div class="input_flied">
            <div>Description <samp>* </samp></div>
            <textarea name="description" id="description"  rows="4" cols="72" type="text" onkeyup="return textCounter(400)"  ><?php echo stripslashes($_SESSION['biz_pro_reg']['description']); ?></textarea>
			<samp style="margin:0 0 0 145px; font-size:12px; font-family:'MyriadProCondensed';" id="colorr">
				You can enter upto <samp id="inputString" style="font-size:12px;font-family:'MyriadProCondensed';"><?php
				echo (400 - count(explode(' ',$_SESSION['biz_pro_reg']['description'])));
				 ?></samp> words. And Minimum 50 words</samp>
				 <div class="error" id="error_description" <?php if( isset($_SESSION['error']['description']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['error']['description']; ?></div>
          </div>
		  <script type="text/javascript">
			function textCounter(maxlimit) {
				var k = document.getElementById('description');
				actstr = k.value.replace('  ',' ');
				
				if (k.selectionStart) {
					cursorPos = k.selectionStart;
				} else if (!document.selection) {
					var cursorPos = 0;
				}
				var wcount = actstr.split(' ').length;
				//alert(wcount);
				if(wcount>50){
				//document.getElementById('colorr').css({"color":"red"}) ;
				//$("#colorr").css("background-color","yellow");
				$("#colorr").css("color","green")
				}
				if(wcount<50){
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
			function textCounter2(maxlimit) {
				var k = document.getElementById('keywords');
				actstr = k.value.replace(',,',',');
				if (k.selectionStart) {
					cursorPos = k.selectionStart;
				} else if (!document.selection) {
					var cursorPos = 0;
				}
				var wcount = actstr.split(',').length;
				if (wcount > maxlimit){
					var str_arr = actstr.split(',');
					var actstr2 = '';
					for (var i = 0; i < maxlimit; i++){
						if( i == 0 )
							actstr2 = str_arr[i];
						else
							actstr2 += ','+str_arr[i];
					
					}
					k.value = $.trim(actstr2);
					return false;
				}else{
					document.getElementById('keyWordCounter').innerHTML = maxlimit - wcount;
					return true;
				}
			}
			
			//  ++++++++++++++++++ this function is used for the charecter count 
			
			function meta_title_Counter(field,cntfield,maxlimit) {
				if (field.value.length > maxlimit) // if too long...trim it!
				field.value = field.value.substring(0, maxlimit);
				// otherwise, update 'characters left' counter
				else
				cntfield.innerHTML = maxlimit - field.value.length;
				}
			// ----+++++++++++++++++ this function is used for the meta description 
			function meta_description_Counter(maxlimit) {
				var k = document.getElementById('meta_description');
				actstr = k.value.replace('  ',' ');
				
				if (k.selectionStart) {
					cursorPos = k.selectionStart;
				} else if (!document.selection) {
					var cursorPos = 0;
				}
				var wcount = actstr.split(' ').length;
				//alert(wcount);
				if(wcount>50){
				//document.getElementById('colorr').css({"color":"red"}) ;
				//$("#colorr").css("background-color","yellow");
				$("#colorr").css("color","green")
				}
				if(wcount<50){
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
					document.getElementById('meta_description_count').innerHTML = maxlimit - wcount;
					return true;
				}
			}
			
			
			
</script>
		  <div class="input_flied">
            <div>Profile Video</div>
            <textarea name="video_embed" id="video_embed"  rows="4" cols="72" type="text"><?php echo stripslashes($_SESSION['biz_pro_reg']['video_embed']); ?></textarea>
			<samp style="margin:0 0 0 145px; font-size:12px; font-family:'MyriadProCondensed';">
			  For your profile video you need to provide the embed of your profile video. Recommended size: 276pxx190px
			</samp>
			<div class="error" id="error_video_embed" <?php if( isset($_SESSION['error']['video_embed']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['error']['video_embed']; ?></div>
         
          </div>
		  
		  <div class="input_flied">
            <div><strong>Business Hours</strong></div>
			
		  </div>
		  <!--<div class="input_flied" style="width:263px; margin:0 0 0 61px;"> <hr /> </div>-->
		  <?php 
		  $daysArr = array('sun'=>'sunday','mon'=>'monday','tue'=>'tuesday','wed'=>'wednesday','thu'=>'thursday','fri'=>'friday','sat'=>'saturday');
		  foreach($daysArr as $short=>$long){
		  ?>
		  <div class="input_flied">
            <div><?php echo ucfirst($long); ?>: </div>
			<div style="width:auto;">
				<?php 
				if(empty($_SESSION['biz_pro_reg'][$short.'_oc'])) $_SESSION['biz_pro_reg'][$short.'_oc'] = '0';
				?>
				<input type="radio" style="width:auto; float:none; height:auto;" name="<?php echo $short; ?>_oc" id="<?php echo $long; ?>1" value="1" onclick="Show('<?php echo $long.'div'; ?>');" <?php if($_SESSION['biz_pro_reg'][$short.'_oc'] == '1') echo 'checked="checked"';?>/>
				<label for="<?php echo $long; ?>1">Open</label>
				<input type="radio" style="width:auto; float:none; height:auto;" name="<?php echo $short; ?>_oc" id="<?php echo $long; ?>2" value="0"  onclick="ShowHide('<?php echo $long.'div'; ?>');" <?php if($_SESSION['biz_pro_reg'][$short.'_oc'] == '0') echo 'checked="checked"';?>/>
				<label for="<?php echo $long; ?>2">Closed</label>
			</div>
			<div id="<?php echo $long.'div'; ?>" <?php if($_SESSION['biz_pro_reg'][$short.'_oc'] == '0') echo 'style="display:none;"'; ?>>
				<label>From:</label>
			<?php $hr = splitTime($_SESSION['biz_pro_reg'][$short.'_f']);?>
			<select name="<?php echo $short; ?>_frm_hr" id="<?php echo $short; ?>_frm_hr" style="width:50px;">
			  <?php 
			  for($i=0;$i<12;$i++){ $i2 = sprintf("%02s", $i);
			  ?>
			  <option value="<?php echo $i2; ?>" <?php if($hr[0] == $i2){?> selected="selected"<?php } ?> ><?php echo $i2; ?></option>
			  <?php }?>
			</select> : 
			<select name="<?php echo $short; ?>_frm_min" id="<?php echo $short; ?>_frm_min" class="text-input" style="width:50px;">
			  <?php for($i=0;$i<12;$i++){ $i2 = sprintf("%02s", $i*5); ?>
			  <option value="<?php echo $i2; ?>" <?php if($hr[1]==$i2){?> selected="selected"<?php }?>><?php echo $i2; ?></option>
			  <?php }?>
			</select>
			<select name="<?php echo $short; ?>_frm_ampm">
				<option value="am" <?php if($hr[2] == 'am') echo 'selected="selected"'; ?>>AM</option>
				<option value="pm" <?php if($hr[2] == 'pm') echo 'selected="selected"'; ?>>PM</option>
			</select>
			<label>To:</label>
			<?php $hr = splitTime($_SESSION['biz_pro_reg'][$short.'_t']);?>
			<select name="<?php echo $short; ?>_to_hr" id="<?php echo $short; ?>_to_hr" style="width:50px;">
			  <?php 
			  for($i=0;$i<12;$i++){ $i2 = sprintf("%02s", $i);
			  ?>
			  <option value="<?php echo $i2; ?>" <?php if($hr[0] == $i2){?> selected="selected"<?php } ?> ><?php echo $i2; ?></option>
			  <?php } ?>
			</select> : 
			<select name="<?php echo $short; ?>_to_min" id="<?php echo $short; ?>_to_min" style="width:50px;">
			  <?php for($i=0;$i<12;$i++){ $i2 = sprintf("%02s", $i*5); ?>
			  <option value="<?php echo $i2; ?>" <?php if($hr[1]==$i2){?> selected="selected"<?php }?>><?php echo $i2; ?></option>
			  <?php }?>
			</select>
			<select name="<?php echo $short; ?>_to_ampm">
				<option value="am" <?php if($hr[2] == 'am') echo 'selected="selected"'; ?>>AM</option>
				<option value="pm" <?php if($hr[2] == 'pm') echo 'selected="selected"'; ?>>PM</option>
			</select>
			</div>
		</div>
		<?php 
		}
		?>
          <div class="input_flied">
            <div>Trader Category:<samp>* </samp></div>
            <select name="mcatid" id="mcatid" style="width:250px;">
              <?php 
			$prodcts ="SELECT * FROM `tt_category` WHERE `p_catid` = 0 AND `cat_type` = '1' ORDER BY cat_name ASC";
			$prodctsRS = mysql_query($prodcts);
			$curmcatId = '';
			while ($prodctsRow = mysql_fetch_array($prodctsRS))
			{
				if(empty($mcatId) and empty($_SESSION['biz_pro_reg']['mcatid']))
					$curmcatId = $prodctsRow['catid'];
				elseif(empty($mcatId))
					$curmcatId = $_SESSION['biz_pro_reg']['mcatid'];
				echo "<option  value='".$prodctsRow['catid']."'";
				if($_SESSION['biz_pro_reg']['mcatid']==$prodctsRow['catid']) echo "selected='selected'"; echo " >".$prodctsRow['cat_name']."</option>";
			}							
		?>
            </select>
          </div>
		  <?php 
		  $subcates_arr = array();
			$subcates = trim($_SESSION['biz_pro_reg']['scatids'],',');
			if(!empty($subcates))
				$subcates_arr = explode(',',$subcates);
		  ?>
          <div class="input_flied">
            <div>Sub Category:<samp>* </samp></div>
            <select name="scatids[]" id="scatids" multiple="multiple" style="width:250px; height:80px;">
              <?php 
				$sql = "SELECT * FROM `tt_category` WHERE `p_catid` = '$curmcatId' AND `cat_type` = '1' ORDER BY cat_name ASC ";
				$result = @mysql_query($sql);
				while($row = mysql_fetch_array( $result ) ){
					echo "<option  value='".$row['catid']."'";
					if(in_array($row['catid'],$subcates_arr)) { echo "selected='selected'";} echo " >".$row['cat_name']."</option>";
				}
				?>
            </select><br />
			<samp style="margin:0 0 0 145px; font-size:12px; font-family:'MyriadProCondensed';">
			to select more than one Sub Category press Shift or CRTL
          </samp>
		  </div>
		  <script>
		  	$(function(){
			  $("select#mcatid").change(function(){
				$.getJSON("<?php echo $ru; ?>process/select-cat.php",{mcatId: $(this).val()}, function(j){
				  var options = '';
					for (var i = 0; i < j.length; i++) {
					  options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
					}
					$("#scatids").html(options);
					$('#scatids option:first').attr('selected', 'selected');
				})
			  })
			  
		  })
		  </script>
          <div class="input_flied">
            <div>Address 1:<samp>* </samp></div>
            <input name="address" id="address" type="text" class="text-input medium-input" value="<?php echo stripslashes($_SESSION['biz_pro_reg']['address']); ?>" style="font-size:13px; font-family:Arial, Helvetica, sans-serif;" />
			<div class="error" id="error_address" <?php if( isset($_SESSION['error']['address']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['error']['address']; ?></div>
          </div>
		  <div class="input_flied">
            <div>Address 2:</div>
            <input name="address2" id="address2" type="text" class="text-input medium-input" value="<?php echo stripslashes($_SESSION['biz_pro_reg']['address2']); ?>" style="font-size:13px; font-family:Arial, Helvetica, sans-serif;" />
			<div class="error" id="error_address2" <?php if( isset($_SESSION['error']['address2']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['error']['address2']; ?></div>
          </div>
          <div class="input_flied">
            <div>City:<samp>* </samp></div>
            <input name="city" id="city" type="text" class="text-input" value="<?php echo $_SESSION['biz_pro_reg']['city']; ?>" />
			<div class="error" id="error_city" <?php if( isset($_SESSION['error']['city']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['error']['city']; ?></div>
          </div>
          <div class="input_flied">
            <div>State/Province:<samp>* </samp></div>
            <select name="state" id="state">
              <?php $state ="SELECT * from tt_state order by statename ASC";
					$stateRS = mysql_query($state);
					while ($stateRow = mysql_fetch_array($stateRS)){
						$statename = $stateRow['statename'];
						$stateid = $stateRow['stateid'];
						$abriviation = $stateRow['state'];
						echo "<option  value='".$abriviation."'"; if($_SESSION['biz_pro_reg']['state']==$abriviation) { echo "selected='selected'";} echo " >".$statename."</option>";
					}							
				?>
            </select>
          </div>
          <div class="input_flied">
            <div>Zip/Postal Code:<samp>* </samp></div>
            <input name="zip" id="zip"  maxlength="8" type="text" class="text-input" value="<?php echo $_SESSION['biz_pro_reg']['zip']; ?>" /><div class="error" id="error_zip" <?php if( isset($_SESSION['error']['zip']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['error']['zip']; ?></div>
          </div>
          <div class="input_flied">
            <div>Business Telephone:<samp>* </samp></div>
            <input name="phone" id="phone" type="text" class="text-input" value="<?php echo $_SESSION['biz_pro_reg']['phone']; ?>"  onchange="validatePhone(this)"  onkeypress="return numbersonly(this, event)"/>
          </div>
          <div class="input_flied">
            <div>Mobile Number:</div>
            <input name="tracked_phone" id="tracked_phone" type="text" class="text-input small-input" value="<?php echo $_SESSION['biz_pro_reg']['tracked_phone']; ?>"  onkeypress="return numbersonly(this, event)"/>
          </div>
          
          <?php /*<div class="input_flied">
            <div>Website:<samp>* </samp></div>
            <input name="website" id="website" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['website']; ?>" />
          </div>*/ ?>
          <div class="input_flied">
            <div>Email:<samp>* </samp></div>
            <input name="email" id="email" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_pro_reg']['email']; ?>" />
          </div>
		  
		  
		  
		  
		  
		  
		 <div  class="input_flied" style="font-weight:bold;"><div style="width:auto; margin:17px 0 20px;"><strong style="border-bottom:1px dotted #6A6A6A;">SEO ( the clever bit that will get you more customers)</strong></div></div>
		 <div class="input_flied">
		  <div style="margin:7px 10px 0 0;">Domain Name:<samp>* </samp></div><samp style="float:left; line-height:28px;">http://</samp>
		    <input name="sub_domain" id="sub_domain" type="text"  value="<?php echo $_SESSION['biz_pro_reg']['sub_domain'];?>" style="width:150px;"  />
			<samp style="line-height:28px; float:left;">.tradetools.co.uk </samp> <input type="button" name="sub_domain" id="sub_domain" onclick="javascript:domain_name();" value="Search" class="inner_gray_botton" style="margin-left:10px;"/>
			<div class="error" id="error_sub_domain" <?php if( isset($_SESSION['error']['sub_domain']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['error']['sub_domain']; ?></div>
	
		 </div>
		 <div class="input_flied">
		  <div>Meta Title:<samp>* </samp></div>
		    <input name="meta_title" id="meta_title" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_pro_reg']['meta_title']; ?>" onKeyDown="meta_title_Counter(document.getElementById('meta_title'),document.getElementById('meta_title_count'),70)"
onKeyUp="meta_title_Counter(document.getElementById('meta_title'),document.getElementById('meta_title_count'),70)" />
			<script>
function load_meta_title(){

	jQuery.facebox('<iframe FRAMEBORDER="0" height="142" width="550"   src="<?php echo $ru;?>inc/meta_title.php" ></iframe>');
}
</script>
			<a href="javascript:;" style="text-decoration:none;" onclick="load_meta_title()">
			<img src="<?php echo $ru;?>images/question_icon.jpg" alt="HELP" style="margin:5px 0 0 10px" />
			</a>
			<samp style="margin:0 0 0 145px; font-size:12px; font-family:'MyriadProCondensed';">You can enter upto 
			<samp id="meta_title_count" style="font-size:12px; font-family:'MyriadProCondensed';"><?php echo (70 - count($_SESSION['biz_pro_reg']['meta_title'])); ?></samp> charecter.</samp><br />
			<div class="error" id="error_meta_title" <?php if( isset($_SESSION['error']['meta_title']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['error']['meta_title']; ?></div>
		
			</div>
			
			<div class="input_flied">
            <div>Meta Description:<samp>* </samp></div>
			<textarea name="meta_description" id="meta_description" onKeyDown="meta_title_Counter(document.getElementById('meta_description'),document.getElementById('meta_description_count'),160)"
onKeyUp="meta_title_Counter(document.getElementById('meta_description'),document.getElementById('meta_description_count'),160)"><?php echo $_SESSION['biz_pro_reg']['meta_description']; ?></textarea>
			<script>
function load_meta_description(){

	jQuery.facebox('<iframe FRAMEBORDER="0" height="160" width="655"   src="<?php echo $ru;?>inc/meta_description.php" ></iframe>');
}
</script>
			<a href="javascript:;" style="text-decoration:none;" onclick="load_meta_description()">
			<img src="<?php echo $ru;?>images/question_icon.jpg" alt="HELP" style="margin:5px 0 0 10px" />
			</a>
			<samp style="margin:0 0 0 145px; font-size:12px; font-family:'MyriadProCondensed';">You can enter upto 
			<samp id="meta_description_count" style="font-size:12px; font-family:'MyriadProCondensed';">  <?php echo (160 - count(explode(' ',$_SESSION['biz_pro_reg']['meta_description']))); ?></samp> Charecter.</samp><br />
			<div class="error" id="error_meta_description" <?php if( isset($_SESSION['error']['meta_description']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['error']['meta_description']; ?></div>
          </div>
		  
			
			
		  <div class="input_flied">
            <div>Keywords:<samp>* </samp></div>
            <input name="keywords" id="keywords" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_pro_reg']['keywords']; ?>" onkeyup="textCounter2(5);" />
			<script>
function load_help(){

	jQuery.facebox('<iframe FRAMEBORDER="0" height="143" width="655"   src="<?php echo $ru;?>inc/keyword_help.php" ></iframe>');
}
</script>
			<a href="javascript:;" style="text-decoration:none;" onclick="load_help()">
			<img src="<?php echo $ru;?>images/question_icon.jpg" alt="HELP" style="margin:5px 0 0 10px" />
			</a>
			<samp style="margin:0 0 0 145px; font-size:12px; font-family:'MyriadProCondensed';">You can enter upto 
			<samp id="keyWordCounter" style="font-size:12px; font-family:'MyriadProCondensed';"><?php echo (5 - count(explode(',',$_SESSION['biz_pro_reg']['keywords']))); ?></samp> comma seperated keywords.</samp>
			<div class="error" id="error_keywords" <?php if( isset($_SESSION['error']['keywords']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['error']['keywords']; ?></div>
          </div>
		  
		  
		  
		  
          <div class="profile_botton_outer">
            <div class="contact_us_gray_botton_inner cpanel_right_botton_button">
              <input type="submit" value="&nbsp;&nbsp;&nbsp;Update&nbsp;&nbsp;&nbsp;" name="UpdateTrader" id="UpdateTrader" class="inner_gray_botton" />
            </div>
          </div>
      </div>
	</div>
  </form>
</div>
<?php 
unset($_SESSION['biz_pro_reg']);
unset ($_SESSION['error']); 
function splitTime($time){
	$sun_frm = explode(':',$time);
	$return_time[0] = sprintf("%02s", $sun_frm[0]);
	$min_time = explode(' ',$sun_frm[1]);
	$return_time[1] = sprintf("%02s", $min_time[0]);
	$return_time[2] = $min_time[1];
	return $return_time;
}
?>
<script type="text/javascript">		
	function getkeywords(fld){
		val = fld.value;
		var items = fld.getElementsByTagName("option");
		var count=0;
		showalert = true;
		for(var i=0;i<fld.options.length;i++){
			if(fld.options[i].selected) count++;
			if(count>5){
				if(showalert == true)
				{
					alert("Can't select more than five sub categories");
					showalert = false;
				}
				j = i-1;
				fld.options[i].selected = false;
				//return false;
			}					
		}
	}
	
	// ___________++++++++++++++++ this function is use to check the sub domain name
	
	
	function domain_name()
	{
	
	$.ajax({
	  url: "<?php echo $ru?>process/domaincheck.php?str="+$("#sub_domain").val(),
	  context: document.body,
	  success: function(data){
	  	if(data == '#invalid'){
			$('#error_sub_domain').html('Sub-domain can only contain 3-30 alphanumerics and dash(-)');
			$('#error_sub_domain').show();
		}else if(data == '#already'){
			$('#error_sub_domain').html('Not available');
			$('#error_sub_domain').show();
		}else if(data == '#success'){
			$('#error_sub_domain').html('Success! your domain is available');
			$('#error_sub_domain').show();
		}else if(data == '#swear'){
			$('#error_sub_domain').html('Swearing is not tolerated on domain name');
			$('#error_sub_domain').show();
		}
	  }
	});
	}
	
	
	
	//  __________________ this code is used for the sub domain 
	

$("#sub_domain").focus(function(){
	$('#error_sub_domain').hide();
});
/*$("#sub_domain").blur(function(){
	$.ajax({
	  url: "<?php echo $ru?>process/swear-words_subdomain.php?str="+$(this).val(),
	  context: document.body,
	  success: function(data){
	  	if(data == 'swear'){
			$('#error_sub_domain').html('This domain name already exist');
			$('#error_sub_domain').show();
		}else if(data == 'less'){
			$('#error_sub_domain').html('You must enter the 5 to 30 charecter ');
			$('#error_sub_domain').show();
		}
	  }
	});
});*/
//  __________________ this code is used for the swear words 
$("#name").focus(function(){
	$('#error_name').hide();
});
$("#name").blur(function(){
	$.ajax({
	  url: "<?php echo $ru?>process/swear-words.php?str="+$(this).val(),
	  context: document.body,
	  success: function(data){
	  	if(data == 'swear'){
			$('#error_name').html('Swearing is not tolerated on TradesTools');
			$('#error_name').show();
		}else if(data == 'less'){
			$('#error_name').html('Must be at least 10 characters long');
			$('#error_name').show();
		}
	  }
	});
});

//___________++++++++++++ this is used for the description 

$("#description").focus(function(){
	$('#error_description').hide();
});
$("#description").blur(function(){
	$.ajax({
	  url: "<?php echo $ru?>process/swear-words-desc_trade.php?str="+$(this).val(),
	  context: document.body,
	  success: function(data){
	  	if(data == 'swear'){
			$('#error_description').html('Swearing is not tolerated on TradesTools');
			$('#error_description').show();
		}else if(data == 'less'){
			$('#error_description').html('Must be at least 50 words long and less than 400 words');
			$('#error_description').show();
		}
	  }
	});
});

//__________+++++++++++++++++++ this is used for the video

$("#video_embed").focus(function(){
	$('#error_video_embed').hide();
});
$("#video_embed").blur(function(){
	$.ajax({
	  url: "<?php echo $ru?>process/swear-words-desc_trade.php?str="+$(this).val(),
	  context: document.body,
	  success: function(data){
	  	if(data == 'swear'){
			$('#error_video_embed').html('Swearing is not tolerated on TradesTools');
			$('#error_video_embed').show();
		}
	}
	});
});


//____________+++++++++++++++ this code is used for the address 1
$("#address").focus(function(){
	$('#error_address').hide();
});
$("#address").blur(function(){
	$.ajax({
	  url: "<?php echo $ru?>process/swear-words.php?str="+$(this).val(),
	  context: document.body,
	  success: function(data){
	  	if(data == 'swear'){
			$('#error_address').html('Swearing is not tolerated on TradesTools Address 1');
			$('#error_address').show();
		}
	  }
	});
});

	
	
	
	
	//____________+++++++++++++++ this code is used for the City
$("#address2").focus(function(){
	$('#error_address2').hide();
});
$("#address2").blur(function(){
	$.ajax({
	  url: "<?php echo $ru?>process/swear-words.php?str="+$(this).val(),
	  context: document.body,
	  success: function(data){
	  	if(data == 'swear'){
			$('#error_address2').html('Swearing is not tolerated on TradesTools Address 2');
			$('#error_address2').show();
		}
	  }
	});
});


//____________+++++++++++++++ this code is used for the address 2
$("#city").focus(function(){
	$('#error_city').hide();
});
$("#city").blur(function(){
	$.ajax({
	  url: "<?php echo $ru?>process/swear-words.php?str="+$(this).val(),
	  context: document.body,
	  success: function(data){
	  	if(data == 'swear'){
			$('#error_city').html('Swearing is not tolerated on TradesTools City');
			$('#error_city').show();
		}
	  }
	});
});


//____________+++++++++++++++ this code is used for the Zip code
$("#zip").focus(function(){
	$('#error_zip').hide();
});
$("#zip").blur(function(){
	$.ajax({
	  url: "<?php echo $ru?>process/swear-words.php?str="+$(this).val(),
	  context: document.body,
	  success: function(data){
	  	if(data == 'swear'){
			$('#error_zip').html('Swearing is not tolerated on TradesTools Post Code');
			$('#error_zip').show();
		}
	  }
	});
});


//____________+++++++++++++++ this code is used for the Keyword
$("#keywords").focus(function(){
	$('#error_keywords').hide();
});
$("#keywords").blur(function(){
	$.ajax({
	  url: "<?php echo $ru?>process/swear-words_key.php?str="+$(this).val(),
	  context: document.body,
	  success: function(data){
	  	if(data == 'swear'){
			$('#error_keywords').html('Swearing is not tolerated on TradesTools Keywords');
			$('#error_keywords').show();
		}else if(data == 'less'){
			$('#error_keywords').html('Must be at least 5 Comma seperated Words');
			$('#error_keywords').show();
		}
	  }
	});
});
	
	
	//____________+++++++++++++++ this code is used for the Meta Title
$("#meta_title").focus(function(){
	$('#error_meta_title').hide();
});
$("#meta_title").blur(function(){
	$.ajax({
	  url: "<?php echo $ru?>process/swear-words.php?str="+$(this).val(),
	  context: document.body,
	  success: function(data){
	  	if(data == 'swear'){
			$('#error_meta_title').html('Swearing is not tolerated on TradesTools Meta Title');
			$('#error_meta_title').show();
		}else if(data == 'less'){
			$('#error_meta_title').html('Must be at least 5 Comma seperated Words');
			$('#error_meta_title').show();
		}
	  }
	});
});
	
	//____________+++++++++++++++ this code is used for the Meta Description
$("#meta_description").focus(function(){
	$('#error_meta_description').hide();
});
$("#meta_description").blur(function(){
	$.ajax({
	  url: "<?php echo $ru?>process/swear-words.php?str="+$(this).val(),
	  context: document.body,
	  success: function(data){
	  	if(data == 'swear'){
			$('#error_meta_description').html('Swearing is not tolerated on TradesTools Keywords');
			$('#error_meta_description').show();
		}else if(data == 'less'){
			$('#error_meta_description').html('Must be at least 5 Comma seperated Words');
			$('#error_meta_description').show();
		}
	  }
	});
});
	
	
	/*function IsNumeric(theField) {
    var sText = getObj(theField).value;
    sText = Trim(sText);
    var validChars = "0123456789.:";
    var bIsNumber = true;
    var aChar;
    for (var i = 0; i < sText.length && bIsNumber == true; i++) {
        aChar = sText.charAt(i);
        if (validChars.indexOf(aChar) == -1) {
            bIsNumber = false;
        }
    }
    return bIsNumber;
}*/
	
	
	 function numbersonly(myfield, e, dec)
	
			{
		
					var key;
					var keychar;
					if (window.event)
					   key = window.event.keyCode;
					else if (e)
					   key = e.which;
					else
				
					   return true;
				
					keychar = String.fromCharCode(key);
					
					// control keys
				
					if ((key==null) || (key==0) || (key==8) || 
						(key==9) || (key==13) || (key==27) )
					   return true;
					// numbers
					else if ((("0123456789-").indexOf(keychar) > -1))
					   return true;
					/*decimal point jump
					else if (dec && (keychar == "."))
					   {
					   myfield.form.elements[dec].focus();
					   return false;
				
					   }*/
				
					else
					   return false;
		}
	
		
</script>