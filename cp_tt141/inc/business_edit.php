<?php //echo '<pre>'; print_r($_SESSION);exit;
if ( isset($_GET['bId']) and $_GET['bId'] != '')
{ 
	$ruadmins = $_SERVER['HTTP_REFERER'];
	$bId = $_GET['bId'];
	$business_qry = "SELECT  * FROM tt_business  where locationid =$bId";
	$business_rs = mysql_query($business_qry) or die (mysql_error());
	$buiness_row = mysql_fetch_array($business_rs);

	if ( mysql_num_rows($business_rs) ==0 ){
		header('location:'.$ruadmin.'home.php');
		exit;
	}
	
	if ( !isset ($_SESSION['biz_reg']) or ($_SESSION['biz_reg']['busId'] != $bId ) )
	{
		$_SESSION['biz_reg'] = $buiness_row;
	}
}
?>               
<h3><a href="<?php echo $ruadmin; ?>home.php?p=business">Company</a> &raquo; <a href="#" class="active">Edit Company - <?php echo stripslashes($buiness_row['name']) ?></a></h3>
<div class="content-box">
	<div class="content-box-header">
		<!--<h3>Edit Company &raquo; <a href="<?php echo $ruadmin; ?>home.php?p=business_edit&bId=<?php echo $bId; ?>">Step 1</a> &raquo; <a href="<?php echo $ruadmin; ?>home.php?p=business_edit_step2&bId=<?php echo $bId; ?>">Step 2</a> &raquo; <a href="<?php echo $ruadmin; ?>home.php?p=business_edit_step3&bId=<?php echo $bId; ?>">Step 3 </a></h3>-->
		<h3>Edit Company &raquo; Step 1 &raquo; <a href="<?php echo $ruadmin; ?>home.php?p=business_edit_step2&bId=<?php echo $bId; ?>">Step 2</a> &raquo; <a href="<?php echo $ruadmin; ?>home.php?p=business_edit_step3&bId=<?php echo $bId; ?>">Step 3 </a></h3>
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
			<?php } unset ($_SESSION['biz_reg_err']);  ?>			
 
                <div id="mainbussines">
                
                	<form  method="post" action="process/process_business.php" enctype="multipart/form-data">
                    <input type="hidden" name="bId" id="bId" value="<?php echo $bId ?>">
					<input type="hidden" name="bName" id="bName" value="<?php echo stripslashes($buiness_row['name']) ?>">
                    	<fieldset>
							<p><h3><font color="#A90000">Company Basic Info:</font></h3></p>					
                            <p><label>Company Name:</label><input name="name" id="name" type="text" class="text-input medium-input" value="<?php echo stripslashes($_SESSION['biz_reg']['name']); ?>" /></p>
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

                            <p><label>Logo:</label><input name="logo" id="logo" type="file"   />&nbsp;&nbsp;&nbsp;(image size 200 X 100 )
                            <?php if ($buiness_row['logo']) {?>
                            <br /><br />
                            <img src="<?php echo $ru;?>media/1211/logo/<?php echo $buiness_row['logo'] ?>" width="200" height="100" alt="Logo" title="logo">
                            <br />
                            <?php } ?>
							</p>
							<p><h3><font color="#A90000">Company Contact Info:</font></h3></p>
							<p><label>Dispatch Contact:</label><input name="dispatchcontact" id="dispatchcontact" type="text" class="text-input medium-input" value="<?php echo stripslashes($_SESSION['biz_reg']['dispatchcontact']); ?>" /></p>

<!--                        <p><label>Description:</label>
                               <textarea name="description" id="description"  rows="4" cols="72" type="text"  ><?php echo stripslashes($_SESSION['biz_reg']['description']); ?></textarea>
                            </p>-->
                            <p><label>Email Address::</label><input name="email" id="email" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['email']; ?>" /></p>
							<p><label>Owner:</label><input name="ownername" id="ownername" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['ownername']; ?>" /></p>
							<p><label>Manager:</label><input name="managername" id="managername" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['managername']; ?>" /></p>
							<p><label>Address:</label><input name="address" id="address" type="text" class="text-input medium-input" value="<?php echo stripslashes($_SESSION['biz_reg']['address']); ?>" /></p>                            
                            <p><label>State:</label>
 							   <select name="state" id="state" class="select1">
										<?php foreach($StateAbArray as $key=>$short){	?>
										<option value="<?php echo $key; ?>" <?php if($_SESSION['biz_reg']['state'] == $key) echo 'selected="selected"'; ?>><?php echo $short; ?></option>
										<?php }	?>
								</select>
							</p>
							<p><label>City:</label><input name="city" id="city" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['city']; ?>" /></p>
                            <p><label>Zip Code:</label><input name="zip" id="zip"  maxlength="5" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['zip']; ?>" /></p>
                            <p><label>Dispatch Phone: (000) 000-0000</label><input name="phone" id="phone" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['phone']; ?>"  onchange="validatePhone(this)"/></p>
                            <p><label>Toll-Free Phone: (000) 000-0000</label><input type="text" name="phone2" id="phone2" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['phone2']; ?>"  onchange="validatePhone(this)"/></p>
                            <p><label>Cell Phone:  (000) 000-0000</label><input type="text" name="phone3" id="phone3" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['phone3']; ?>"  onchange="validatePhone(this)"/></p>
							<p><label>Local Phone: (000) 000-0000</label><input type="text" name="phone4" id="phone4" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['phone4']; ?>"  onchange="validatePhone(this)"/></p>
							<p><label>Fax: (000) 000-0000</label><input type="text" name="fax" id="fax" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['fax']; ?>"  onchange="validatePhone(this)"/></p>
                            <p><label>Website: </label><input name="website" id="website" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['website']; ?>" /></p>
                            <p><h3><font color="#A90000">Others:</font></h3></p>
                          <?php  if( $_SESSION['cp_tt']['email'] !='info@TradesTool.co.uk'){ ?>
					   <p><label>Contact Person:</label>
                            <select name="userId"  id="userId" class="select1">
                            <option value=""></option>
                            <?php 	
									$sql    = "SELECT userId,firstname,lastname,email,username FROM tt_user where type <>'u' order by firstname,lastname";
									$result_users = mysql_query($sql) or die (mysql_error());
									while ($bOwners = mysql_fetch_array($result_users) ){ 
							 ?>
								<option value="<?php echo $bOwners['userId'] ?>"  
								<?php if( $_SESSION['biz_reg']['userId'] == $bOwners['userId']){ ?> selected="selected" <?php } ?>>
								<?php echo $bOwners['firstname'] . ' ' . $bOwners['lastname'] .' ('.$bOwners['email'].') '; ?> 
								</option>
								<?php  } ?>
                            </select>
                            </p>
					   <?php }?>
							<p><label>Status:</label>
                            <select name="status" id="status" class="select1">
                            	<option value="1" <?php if( $_SESSION['biz_reg']['status'] == '1'){ ?> selected="selected" <?php } ?>>Active</option>
                            	<option value="0" <?php if( $_SESSION['biz_reg']['status'] == '0'){ ?> selected="selected" <?php } ?>>Pending</option>
                            	<option value="-1" <?php if( $_SESSION['biz_reg']['status'] == '-1'){ ?> selected="selected" <?php } ?>>Expired</option>
                            </select>
                            </p>						
                        	<p><input type="submit" class="button" value="&nbsp;&nbsp;&nbsp;Update&nbsp;&nbsp;&nbsp;" name="UpdateBusiness" id="UpdateBusiness" /></p>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>	      