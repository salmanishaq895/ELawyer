<?php 
if ( isset ($_SESSION['biz_regg']['busId']) )
{
	unset($_SESSION['biz_regg']);
}
$sql    = "SELECT userId,firstname,lastname,email,username FROM tt_user where type <>'c' order by firstname,lastname";
$result_users = mysql_query($sql) or die (mysql_error());
?>
<script type="text/javascript" src="datepicker/jquery.js"></script>
<script type="text/javascript" src="datepicker/date.js"></script>
<script type="text/javascript" src="datepicker/jquery_002.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="datepicker/datePicker.css" />  
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
          
<script type="text/javascript" charset="utf-8">
Date.firstDayOfWeek = 0;
Date.format = 'yyyy-mm-dd';
$(function()
{
	$('#startDate').datePicker({clickInput:true})
	$('#expiryDate').datePicker({clickInput:true})
});
function setdatevalue(pack){
	document.getElementById('startDate').value= '<?php echo date("Y-m-d")?>';
	document.getElementById('expiryDate').value= pack.value;
}
</script> 
<h3><a href="home.php?p=business">Trader </a> &raquo; <a href="#" class="active">Add New Trader </a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3> Add New Trader </h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
	<?php if ( isset ($_SESSION['biz_reg_err']) ) {?>
			<div class="notification error png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					<?php foreach ($_SESSION['biz_reg_err'] as $ek=>$ev ) echo $ev ."<br />"; ?>
				</div>
			</div>	
	  <?php } unset ($_SESSION['biz_reg_err']); ?>
	  
                <div id="mainbussines">
                	<form  method="post" action="<?php echo $ruadmin ?>process/process_business.php" enctype="multipart/form-data">
                    	<fieldset>
                            <p><label>Trader Name:</label><input name="name" id="name" type="text" class="text-input small-input" value="<?php echo $_SESSION['biz_regg']['name']; ?>" />
							
							<div class="errorr" id="error_name" <?php if( isset($_SESSION['error']['name']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['error']['name']; ?></div>
							</p>
							<!--<p><label>Abn No:</label><input name="abnno" id="abnno" type="text" class="text-input small-input" value="<?php echo $_SESSION['biz_regg']['abnno']; ?>" /></p>
                         -->   <p><label>Logo:</label><input name="logo" id="logo" type="file"   />&nbsp;&nbsp;&nbsp;(image size 350 X 250 )</p>
                            <p><label>Description:</label><textarea name="description" id="description" rows="4" cols="72" type="text" class="text-input medium-input" onkeyup="return textCounter(400)"><?php echo $_SESSION['biz_regg']['description']; ?></textarea>
							</p>
							
							<p><samp id="colorr">
				You can enter upto <samp id="inputString" style="font-size:12px;font-family:'MyriadProCondensed';"><?php
				echo (400 - count(explode(' ',$_SESSION['biz_pro_reg']['description'])));
				 ?></samp> words. And Minimum 50 words</samp>
				 <div class="errorr" id="error_description" <?php if( isset($_SESSION['error']['description']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['error']['description']; ?></div>
          </p>
							
							
							
							<p><label>Profile Video:</label>
							<textarea name="video_embed" id="video_embed"  rows="4" cols="72" type="text"><?php echo stripslashes($_SESSION['biz_regg']['video_embed']); ?></textarea>
							<div class="errorr" id="error_video_embed" <?php if( isset($_SESSION['error']['video_embed']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['error']['video_embed']; ?></div>
							</p>
							<p>
							<samp style="margin:0 0 0 145px; font-size:12px; font-family:'MyriadProCondensed';">
			  For your profile video you need to provide the embed of your profile video. Recommended size: 276pxx190px
			</samp>
			</p>
							
							
							
							
							<p>
            <div><strong>Business Hours</strong></div>
			
		  </p>
		  <!--<div class="input_flied" style="width:263px; margin:0 0 0 61px;"> <hr /> </div>-->
		  <?php 
		  $daysArr = array('sun'=>'sunday','mon'=>'monday','tue'=>'tuesday','wed'=>'wednesday','thu'=>'thursday','fri'=>'friday','sat'=>'saturday');
		  foreach($daysArr as $short=>$long){
		  ?>
		  <P>
            <div> <label><?php echo ucfirst($long); ?>: </label></div>
			<div style="width:auto;">
				<?php 
				if(empty($_SESSION['biz_pro_reg'][$short.'_oc'])) $_SESSION['biz_pro_reg'][$short.'_oc'] = '0';
				?>
				<input type="radio" style="width:auto; float:none; height:auto;" name="<?php echo $short; ?>_oc" id="<?php echo $long; ?>1" value="1" onclick="Show('<?php echo $long.'div'; ?>');" <?php if($_SESSION['biz_pro_reg'][$short.'_oc'] == '1') echo 'checked="checked"';?>/>
				Open
				<input type="radio" style="width:auto; float:none; height:auto;" name="<?php echo $short; ?>_oc" id="<?php echo $long; ?>2" value="0"  onclick="ShowHide('<?php echo $long.'div'; ?>');" <?php if($_SESSION['biz_pro_reg'][$short.'_oc'] == '0') echo 'checked="checked"';?>/>
				Closed
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
		</P>
		<?php 
		}
		?>
          
							
							
							
							
							
							
                            <p><label>Trader Category:</label><select name="industry" id="industry" class="text-input small-input">
							<?php 
								$prodcts ="SELECT * from tt_category where p_catid = 0 AND `cat_type` = '1' order by cat_name asc";
								$prodctsRS = mysql_query($prodcts);
								while ($prodctsRow = mysql_fetch_array($prodctsRS))
								{
									$catname = $prodctsRow['cat_name'];
									$catid = $prodctsRow['catid'];
									echo "<option  value='".$catid."'";if($_SESSION['biz_regg']['industry']==$prodctsRow['catid']) echo "selected='selected'"; echo " >".$catname."</option>";
								}							
							?>
							 </select></p>
							  <p><label>Sub Category:</label><select name="scatids[]" id="scatids" class="text-input small-input" multiple="multiple">
							<?php 
								 $cat = array();
									$sql = "SELECT catid, cat_name from tt_category where p_catid != 0 and cat_type=1";
									$result =@mysql_query($sql);
								while ($row = mysql_fetch_array( $result ) ){ 
									$catid = $row['catid'];
								    $cat_name = $row['cat_name'];
									
			
							echo "<option  value='".$catid."'";  if($_SESSION['biz_regg']['subcat']==catid) { echo "selected='selected'";}echo " >".$cat_name."</option>";				 
								
							}
									?>								
							 </select></p>
							 
							   <script>
		  	$(function(){
			  $("select#industry").change(function(){
				$.getJSON("<?php echo $ruadmin; ?>process/select-cat.php",{industry: $(this).val()}, function(j){
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
							 
                             <p><label>Address</label><input name="address" id="address" type="text" class="text-input small-input" value="<?php echo stripslashes($_SESSION['biz_regg']['address']); ?>" />
							 <div class="errorr" id="error_address" <?php if( isset($_SESSION['error']['address']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['error']['address']; ?></div>
							 
							 </p>
                             <p><label>City:</label><input name="city" id="city" type="text" class="text-input small-input" value="<?php echo $_SESSION['biz_regg']['city']; ?>" />
							 <div class="errorr" id="error_city" <?php if( isset($_SESSION['error']['city']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['error']['city']; ?></div>
							 
							 </p>
							 
                             <p><label>State/Province:</label>
							  <select name="state" id="state" class="text-input small-input">
							  <?php $state ="SELECT * from tt_state order by statename ASC";
								$stateRS = mysql_query($state);
								while ($stateRow = mysql_fetch_array($stateRS))
								{
									$statename = $stateRow['statename'];
									$stateid = $stateRow['stateid'];
									$abriviation = $stateRow['state'];
						echo "<option  value='".$abriviation."'"; if($_SESSION['biz_regg']['state']==$abriviation) { echo "selected='selected'";} echo " >".$statename."</option>";
								}							
							?>
								
							  </select>
							 </p>
                             <p><label>Zip Code:</label><input name="zip" id="zip" maxlength="10" type="text" class="text-input small-input" value="<?php echo $_SESSION['biz_regg']['zip']; ?>" />
							  <div class="errorr" id="error_zip" <?php if( isset($_SESSION['error']['zip']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['error']['zip']; ?></div>
							 
							 </p>
                             <p><label>Phone: (000) 000-0000</label><input name="phone" id="phone" type="text" class="text-input small-input" value="<?php echo $_SESSION['biz_regg']['phone']; ?>"  onchange="validatePhone(this)" onkeypress="return numbersonly(this, event)"/></p>
							 <p><label>Mobile Number:</label><input name="mobile" id="mobile" type="text" class="text-input small-input" value="<?php echo $_SESSION['biz_regg']['mobile']; ?>"  onkeypress="return numbersonly(this, event)"/></p>
							  <!--<p><label>Keywords:</label><input name="keywords" id="keywords" type="text" class="text-input medium-input" value="< ?php echo $_SESSION['biz_regg']['keywords']; ?>" /></p>
                            <p><label>Website:</label><input name="website" id="website" type="text" class="text-input small-input" value="< ?php echo $_SESSION['biz_regg']['website']; ?>" /></p>-->
                             <p><label>Email:</label><input name="email" id="email" type="text" class="text-input small-input" value="<?php echo $_SESSION['biz_regg']['email']; ?>" />
							 
							 <div class="errorr" id="error_email" <?php if( isset($_SESSION['error']['email']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['error']['email']; ?></div>
							 </p>
                             <p><label>Trader Contact Person:</label>
                             <select name="b_userId"  id="b_userId" class="text-input small-input">
                             <?php while ($bOwners = mysql_fetch_array($result_users) ){  
								$selected='';
								if( $_SESSION['biz_regg']['b_userId'] == $bOwners['userId']){
									$selected = 'selected="selected"';
								}
								elseif( $_SESSION['biz_regg']['userId'] == $bOwners['userId']){
									$selected = 'selected="selected"';
								}
							?>
							<option value="<?php echo $bOwners['userId'] ;?>"  <?php echo  $selected; ?>><?php echo $bOwners['firstname'] . ' ' . $bOwners['lastname'] .' ('.$bOwners['email'].') '; ?> </option>
                            <?php  } ?>
                            </select>
                            </p>
                            <p><label>Status:</label>
                            <select name="status" id="status" class="text-input small-input">
                            	<option value="1" <?php if( $_SESSION['biz_regg']['status'] == '1'){ ?> selected="selected" <?php } ?>>Active</option>
                            	<option value="0" <?php if( $_SESSION['biz_regg']['status'] == '0'){ ?> selected="selected" <?php } ?>>Pending</option>
                            	<option value="-1" <?php if( $_SESSION['biz_regg']['status'] == '-1'){ ?> selected="selected" <?php } ?>>Expired</option>								
                            </select>
                            </p>
							
							
							
							
							
							
							 <div  class="input_flied" style="font-weight:bold;"><div style="width:auto; margin:17px 0 20px;"><strong style="border-bottom:1px dotted #6A6A6A;">SEO ( the clever bit that will get you more customers)</strong></div></div>
		 <p>
		  <label>Domain Name:</label><samp style="float:left; line-height:28px;">http://</samp>
		    <input name="sub_domain" id="sub_domain" type="text"  value="<?php echo $_SESSION['biz_regg']['sub_domain'];?>" style="width:150px;"  />
			<samp style="line-height:28px;">.tradetools.co.uk </samp> <input type="button" name="sub_domain" id="sub_domain" onclick="javascript:domain_name();" value="Search" class="inner_gray_botton" style="margin-left:10px;"/>
			<div class="errorr" id="error_sub_domain" <?php if( isset($_SESSION['error']['sub_domain']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['error']['sub_domain']; ?></div>
			</p>
	
	<p> 
	<label> Meta Title:</label>
	
		    <input name="meta_title" id="meta_title" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_regg']['meta_title']; ?>" onKeyDown="meta_title_Counter(document.getElementById('meta_title'),document.getElementById('meta_title_count'),70)"
onKeyUp="meta_title_Counter(document.getElementById('meta_title'),document.getElementById('meta_title_count'),70)" />
		</p>
		
		<samp style="margin:0 0 0 145px; font-size:12px; font-family:'MyriadProCondensed';">You can enter upto 
			<samp id="meta_title_count" style="font-size:12px; font-family:'MyriadProCondensed';"><?php echo (70 - count($_SESSION['biz_regg']['meta_title'])); ?></samp> charecter.</samp><br />
			<div class="errorr" id="error_meta_title" <?php if( isset($_SESSION['error']['meta_title']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['error']['meta_title']; ?></div>
		
			
		
		
		
		
			<p> 
			<label> Meta Description:</label>
			<textarea name="meta_description" id="meta_description" onKeyDown="meta_title_Counter(document.getElementById('meta_description'),document.getElementById('meta_description_count'),160)"
onKeyUp="meta_title_Counter(document.getElementById('meta_description'),document.getElementById('meta_description_count'),160)"><?php echo $_SESSION['biz_regg']['meta_description']; ?></textarea>
			
			
			</p>
			
			
			
			<samp style="margin:0 0 0 145px; font-size:12px; font-family:'MyriadProCondensed';">You can enter upto 
			<samp id="meta_description_count" style="font-size:12px; font-family:'MyriadProCondensed';">  <?php echo (160 - count(explode(' ',$_SESSION['biz_regg']['meta_description']))); ?></samp> Charecter.</samp><br />
			<div class="errorr" id="error_meta_description" <?php if( isset($_SESSION['error']['meta_description']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['error']['meta_description']; ?></div>
          
			
			
			
		  
		  <p>
		  <label>Keywords:</label>
            <input name="keywords" id="keywords" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_regg']['keywords']; ?>" onkeyup="textCounter2(5);" />
		
			</p>
		  
		
				<samp style="margin:0 0 0 145px; font-size:12px; font-family:'MyriadProCondensed';">You can enter upto 
			<samp id="keyWordCounter" style="font-size:12px; font-family:'MyriadProCondensed';"><?php echo (5 - count(explode(',',$_SESSION['biz_pro_reg']['keywords']))); ?></samp> comma seperated keywords.</samp>
			<div class="errorr" id="error_keywords" <?php if( isset($_SESSION['error']['keywords']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['error']['keywords']; ?></div>
         			
							
							
							
							
							
							
							
							
							<!--<p><label>Trader Packages:</label>
                            <select name="btype" id="btype" class="text-input small-input">
                            <option value="0" <?php if( $_SESSION['biz_regg']['btype'] == '0'){ ?> selected="selected" <?php } ?>>Standard Plan</option>
                            <option value="1" <?php if( $_SESSION['biz_regg']['btype'] == '1'){ ?> selected="selected" <?php } ?>>Gold Plan</option>                            <option value="2" <?php if( $_SESSION['biz_regg']['btype'] == '2'){ ?> selected="selected" <?php } ?>>Diamond Plan</option>
                            </select>
							
                            </p>
						    <p><label>Start Date:(for paid only)</label><input name="startDate" id="startDate" type="text" class="text-input small-input" value="<?php echo date('Y-m-d'); ?>" /></p>
                            <p><label>Expiry Date:(for paid only)</label><input name="expiryDate" id="expiryDate" type="text" class="text-input small-input" value="<?php echo date('Y-m-d',mktime(0, 0, 0, date('m')+1, date('d'), date('Y')));?>" /></p>
                        	--><p><input type="submit" class="button" value="&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;" name="SaveTrader" id="SaveTrader"  /></p>
                        </fieldset>
                    </form>
            </div>
        </div>	
	</div> 
	<?php unset($_SESSION['biz_regg']);
	unset($_SESSION['error']);
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
$("#email").focus(function(){
	$('#error_email').hide();
});
$("#email").blur(function(){
	$.ajax({
	  url: "<?php echo $ru?>process/swear-words.php?str="+$(this).val(),
	  context: document.body,
	  success: function(data){
	  	if(data == 'swear'){
			$('#error_email').html('Swearing is not tolerated on TradesTools');
			$('#error_email').show();
		}else if(data == 'less'){
			$('#error_email').html('Must be at least 10 characters long');
			$('#error_email').show();
		}
	  }
	});
});



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
		}/*else if(data == 'less'){
			$('#error_meta_title').html('Must be at least 5 Comma seperated Words');
			$('#error_meta_title').show();
		}*/
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
		}/*else if(data == 'less'){
			$('#error_meta_description').html('Must be at least 5 Comma seperated Words');
			$('#error_meta_description').show();
		}*/
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