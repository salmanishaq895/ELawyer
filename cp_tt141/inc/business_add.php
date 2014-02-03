<?php  	//echo '<pre>';print_r($_SESSION);
	    //echo '<pre>';print_r($_REQUEST);exit;
/*if ( !isset ($_SESSION['biz_reg']['busId']) )
{
	unset($_SESSION['biz_reg']);
}*/
$sql    = "SELECT userId,firstname,lastname,email,username FROM tt_user where type <>'u' order by firstname,lastname";
$result_users = mysql_query($sql) or die (mysql_error());
?>
<script type="text/javascript" src="datepicker/jquery.js"></script>
<script type="text/javascript" src="datepicker/date.js"></script>
<script type="text/javascript" src="datepicker/jquery_002.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="datepicker/datePicker.css" />   
          
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
<h3><a href="<?php echo $ruadmin; ?>home.php?p=business">Company</a> &raquo; <a href="#" class="active">Add New Company</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3> Add New Company </h3>
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
                	<form  method="post" action="process/process_business.php" enctype="multipart/form-data">
                    	<fieldset>
                            <p><h3><font color="#A90000">Company Basic Info:</font></h3></p>
							<p><label>Company Name:</label><input name="name" id="name" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['name']; ?>" /></p>
                            <p><label>Company Type:</label>
                            <select name="btype" id="btype" class="select1">
                            	<option value="Broker" <?php if( $_SESSION['biz_reg']['btype'] == 'Broker'){ ?> selected="selected" <?php } ?>>Broker</option>
                            	<option value="Carrier" <?php if( $_SESSION['biz_reg']['btype'] == 'Carrier'){ ?> selected="selected" <?php } ?>>Carrier</option>
                            	<option value="Broker / Carrier" <?php if( $_SESSION['biz_reg']['btype'] == 'Broker / Carrier'){ ?> selected="selected" <?php } ?>>Broker / Carrier</option>                                
                            </select>
                            </p>

							<p><label>Listing Type:</label>
                            <select name="ltype" id="ltype" class="select1">
                            	<option value="2" <?php if( $_SESSION['biz_reg']['ltype'] == '2'){ ?> selected="selected" <?php } ?>>Allied Listing (registered)</option>
                            	<option value="1" <?php if( $_SESSION['biz_reg']['ltype'] == '1'){ ?> selected="selected" <?php } ?>>Standard Listing (registered)</option>
                            	<option value="0" <?php if( $_SESSION['biz_reg']['ltype'] == '0'){ ?> selected="selected" <?php } ?>>Basic Listing (unregistered)</option>
                            </select>
                            </p>
                            <p><label>Logo:</label><input name="logo" id="logo" type="file"   />&nbsp;&nbsp;&nbsp;(image size 200 X 100 )</p>
                            
							<p><h3><font color="#A90000">Company Contact Info:</font></h3></p>
							<p><label>Dispatch Contact:</label><input name="dispatchcontact" id="dispatchcontact" type="text" class="text-input medium-input" value="<?php echo stripslashes($_SESSION['biz_reg']['dispatchcontact']); ?>" /></p>
							<!--<p><label>Description:</label><textarea name="description" id="description" rows="4" cols="72" type="text"><?php echo $_SESSION['biz_reg']['description']; ?></textarea></p>-->
                            <p><label>Email Address::</label><input name="email" id="email" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['email']; ?>" /></p>
							<p><label>Owner:</label><input name="ownername" id="ownername" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['ownername']; ?>" /></p>
							<p><label>Manager:</label><input name="managername" id="managername" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['managername']; ?>" /></p>
							<p><label>Address:</label><input name="address" id="address" type="text" class="text-input medium-input" value="<?php echo stripslashes($_SESSION['biz_reg']['address']); ?>" /></p>
                            <p><label>State:</label>
						<!--	<?php echo '<pre>'; print_r($StateAbArray); ?>-->
							  <select name="state" id="state" class="select1">
								<?php foreach($StateAbArray as $key=>$short){ ?>
							  <option value="<?php echo $key; ?>" <?php if($_SESSION['biz_reg']['state'] == $short) echo 'selected="selected"'; ?>><?php echo $short; ?></option>
								<?php }	?>
							  </select>
							</p>
							 <p><label>City:</label><input name="city" id="city" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['city']; ?>" /></p>
                            <p><label>Zip Code:</label><input name="zip" id="zip" maxlength="5" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['zip']; ?>" /></p>
                            <p><label>Dispatch Phone: (000) 000-0000</label><input name="phone" id="phone" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['phone']; ?>"  onchange="validatePhone(this)"/></p>
                            <p><label>Toll-Free Phone: (000) 000-0000</label><input type="text" name="phone2" id="phone2" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['phone2']; ?>"  onchange="validatePhone(this)"/></p>
                            <p><label>Cell Phone:  (000) 000-0000</label><input type="text" name="phone3" id="phone3" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['phone3']; ?>"  onchange="validatePhone(this)"/></p>
							<p><label>Local Phone: (000) 000-0000</label><input type="text" name="phone4" id="phone4" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['phone4']; ?>"  onchange="validatePhone(this)"/></p>
							<p><label>Fax: (000) 000-0000</label><input type="text" name="fax" id="fax" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['fax']; ?>"  onchange="validatePhone(this)"/></p>
							<p><label>Website:</label><input name="website" id="website" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['website']; ?>" /></p>
                             <p><h3><font color="#A90000">Others:</font></h3></p>
							 <table cellspacing="0" cellpadding="0" style="width:100%; padding:20px;" id="featurDetail">
								  <tr>
									<td  style="border-right:0px; border-bottom:0px;"><strong>Select</strong></td>
									<td  style="border-right:0px; border-bottom:0px;"><strong>Listing Type</strong></td>
								  </tr> 
								  <tr>
									<td style="border-right:0px; border-bottom:0px;"><input type="checkbox" name="dtype[]" id="dtype1"  onclick="maketotal()" value="NA" <?php if(strpos($_SESSION['biz_reg']['dtype'],'NA')===false) {} else { echo  'Checked'; }?>  /></td>
									<td style="border-right:0px; border-bottom:0px;">Nationally - NA</td>
								  </tr>
								  <tr>
									<td style="border-right:0px; border-bottom:0px;"><input type="checkbox" name="dtype[]" id="dtype2"  onclick="maketotal()" value="S1" <?php if(strpos($_SESSION['biz_reg']['dtype'],'S1')===false) {} else { echo  'Checked'; }?>/></td>
									<td style="border-right:0px; border-bottom:0px;">States 1 - S1 ( CA, NY, FL, TX )		
									</td>
								  </tr>
								  <tr>
									<td style="border-right:0px; border-bottom:0px;"><input type="checkbox" name="dtype[]" id="dtype3"  onclick="maketotal()" value="S2"  <?php if(strpos($_SESSION['biz_reg']['dtype'],'S2')===false) {} else { echo  'Checked'; }?>/></td>
									<td style="border-right:0px; border-bottom:0px;">States 2 - S2 ( IL, WA, PA, VA, GA, NC, MA, OH )
									</td>
								  </tr>
								  <tr>
									<td style="border-right:0px; border-bottom:0px;"><input type="checkbox" name="dtype[]" id="dtype4"  onclick="maketotal()" value="S3"  <?php if(strpos($_SESSION['biz_reg']['dtype'],'S3')===false) {} else { echo  'Checked'; }?>/></td>
									<td style="border-right:0px; border-bottom:0px;">States 3 - S3 ( OR, NJ, AZ, MI, CO, MD, MN, TN, IN, CT, WI, MO, LA )
									</td>
								  </tr>
								  <tr>
									<td style="border-right:0px; border-bottom:0px;"><input type="checkbox" name="dtype[]" id="dtype5"  onclick="maketotal()" value="S4" <?php if(strpos($_SESSION['biz_reg']['dtype'],'S4')===false) {} else { echo  'Checked'; }?> /></td>
									<td style="border-right:0px; border-bottom:0px;">States 4 - S4 ( SC, NV, AL, UT, DC, KY, KS, OK, IA, NM, HI, RI, MS, AR, NE, NH, ID, ME, WV, MT, AK, DE, VT, SD, ND, WY )
									</td>
									</tr>
								  <tr>
									<td style="border-right:0px; border-bottom:0px;"><input type="checkbox" name="dtype[]"  id="dtype6" value="IN"  onclick="maketotal()" <?php if(strpos($_SESSION['biz_reg']['dtype'],'IN')===false) {} else { echo  'Checked'; }?>/></td>
									<td style="border-right:0px; border-bottom:0px;">International - ( IN )</td>
									</tr> 
								  <tr>
									<td style="border-right:0px;"><input type="checkbox" name="dtype[]" id="dtype7"  value="SV"  onclick="maketotal()" <?php if(strpos($_SESSION['biz_reg']['dtype'],'SV')===false) {} else { echo  'Checked'; }?>/></td>
									<td style="border-right:0px;">Specialized vehicles - SV</td>
									</tr>   	  
								</table>
							<p><label>Contact Person:</label> 
                             <select name="b_userId"  id="b_userId" class="select1">
                              <option value=""></option>
                             <?php while ($bOwners = mysql_fetch_array($result_users) ){  
								$selected='';
								if( $_SESSION['biz_reg']['b_userId'] == $bOwners['userId']){
									$selected = 'selected="selected"';
								}
								elseif( $_SESSION['cp_cmd']['userId'] == $bOwners['userId']){
									$selected = 'selected="selected"';
								}
							?>
							<option value="<?php echo $bOwners['userId'] ?>"  <?php echo  $selected; ?>><?php echo $bOwners['firstname'] . ' ' . $bOwners['lastname'] .' ('.$bOwners['email'].') '; ?> </option>
                            <?php  } ?>
                            </select>
                            </p>
                            <p><label>Status:</label>
                            <select name="status" id="status" class="select1">
                            	<option value="1" <?php if( $_SESSION['biz_reg']['status'] == '1'){ ?> selected="selected" <?php } ?>>Active</option>
                            	<option value="0" <?php if( $_SESSION['biz_reg']['status'] == '0'){ ?> selected="selected" <?php } ?>>Pending</option>
                            	<option value="-1" <?php if( $_SESSION['biz_reg']['status'] == '-1'){ ?> selected="selected" <?php } ?>>Expired</option>								
                            </select>
                            </p>
					   <input type="hidden" name="claim_flag" value="<?php echo 'plus_icon.png'; ?>" 
					        <p><input type="submit" class="button" value="&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;" name="SaveBusiness" id="SaveBusiness"  /></p>
                        </fieldset>
                    </form>
            </div>
        </div>	
	</div>      
<?php 
	    unset($_SESSION['biz_reg_err']);
	    unset($_SESSION['biz_reg']);?>