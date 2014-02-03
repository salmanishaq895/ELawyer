<?php 
if ( isset ($_SESSION['biz_reg']['busId']) )
{
	unset($_SESSION['biz_reg']);
}
$sql    = "SELECT userId,firstname,lastname,email,username FROM tt_user where type ='c' order by firstname,lastname";
$result_users = mysql_query($sql) or die (mysql_error());
?>
<script type="text/javascript" src="datepicker/jquery.js"></script>
<script type="text/javascript" src="datepicker/date.js"></script>
<script type="text/javascript" src="datepicker/jquery_002.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="datepicker/datePicker.css" />   
          
<script type="text/javascript" charset="utf-8">
Date.firstDayOfWeek = 0;
Date.format = 'dd-mm-yyyy';
$(function()
{
	$('#startDate').datePicker({clickInput:true})
	$('#expirydate').datePicker({clickInput:true})
});
function setdatevalue(pack){
	document.getElementById('startDate').value= '<?php echo date("Y-m-d")?>';
	document.getElementById('expirydate').value= pack.value;
}
</script> 
<h3><a href="home.php?p=business">Trader </a> &raquo; <a href="#" class="active">Add New Job </a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3> Add New Job </h3>
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
                	<form  method="post" action="<?php echo $ruadmin ?>process/process_job.php" enctype="multipart/form-data">
                    	<fieldset>
                            <p><label>I'm looking for: </label><input name="txt_keyword" id="txt_keyword" type="text" class="text-input small-input" value="<?php echo $_SESSION['biz_reg']['txt_keyword']; ?>" /></p>
							<p><label> City:</label><input name="txt_location" id="txt_location" type="text" class="text-input small-input" value="<?php echo $_SESSION['biz_reg']['txt_location']; ?>" /></p>
							
							<p><label> Postcode:</label><input name="postcode" id="postcode" type="text" class="text-input small-input" value="<?php echo $_SESSION['biz_reg']['postcode']; ?>" /></p>
							
							
							 
							 <p><label> Within: </label><select name="miles" id="miles">
            <option value="10">10 Miles</option>
            <option value="25">25 Miles</option>
            <option value="50">50 Miles</option>
            <option value="75">75 Miles</option>
            <option value="100">100 Miles</option>
          </select></p>
							
							<p><label>Quote Request title:</label><input name="title" id="title" type="text" class="text-input small-input" value="<?php echo $_SESSION['biz_reg']['title']; ?>" /></p>
                            
                            <p><label>Describe what you need: </label><textarea name="message" id="message" rows="4" cols="72" type="text" class="text-input medium-input"><?php echo $_SESSION['biz_reg']['description']; ?></textarea></p>
                         <!--   <p><label>Job Category:</label><select name="industry" id="industry" class="text-input small-input">
							< ?php 
								$prodcts ="SELECT * from tt_category where p_catid = 0 AND `cat_type` = '1' order by cat_name asc";
								$prodctsRS = mysql_query($prodcts);
								while ($prodctsRow = mysql_fetch_array($prodctsRS))
								{
									$catname = $prodctsRow['cat_name'];
									$catid = $prodctsRow['catid'];
									echo "<option  value='".$catname."' >".$catname."</option>";
								}							
							?>
							 </select></p>
							  <p><label>Sub Category:</label><select name="sub_cat" id="sub_cat" class="text-input small-input">
							< ?php 
								 $cat = array();
									$sql = "SELECT catid, cat_name from tt_category where p_catid != 0 and cat_type=1";
									$result =@mysql_query($sql);
								while ($row = mysql_fetch_array( $result ) ){ 
									$cat[$row['catid']] = $row['cat_name'];
								    $cat[$cat_Row['catid']] = $cat_Row['cat_name'];
									
			
							echo "<option  value='".$cat[$row['catid']]."' >".$cat[$row['catid']]."</option>";				 
								
							}
									?>								
							 </select></p>
                             <p><label>Address</label><input name="address" id="address" type="text" class="text-input small-input" value="<?php echo stripslashes($_SESSION['biz_reg']['address']); ?>" /></p>
                             <p><label>City:</label><input name="city" id="city" type="text" class="text-input small-input" value="<?php echo $_SESSION['biz_reg']['city']; ?>" /></p>
							 
                             <p><label>State/Province:</label>
							  <select name="state" id="state" class="text-input small-input">
							  < ?php $state ="SELECT * from tt_state order by statename ASC";
								$stateRS = mysql_query($state);
								while ($stateRow = mysql_fetch_array($stateRS))
								{
									$statename = $stateRow['statename'];
									$stateid = $stateRow['stateid'];
									$abriviation = $stateRow['state'];
						echo "<option  value='".$abriviation."'"; if($_SESSION['biz_reg']['state']==$abriviation) { echo "selected='selected'";} echo " >".$statename."</option>";
								}							
							?>
								
							  </select>
							 </p>-->
                             
		  
		  
		  
		   <p><label> When do you need it by?
 </label><select name="within" id="within">
            <option value="whenever" <?php if($_SESSION['get_quote']['within'] == 'whenever') echo 'selected="selected"'; ?>>Whenever </option>
            <option value="During one day" >During one day</option>
            <option value="During one week">During one week</option>
            <option value="During two week">During two week</option>
          </select></p>
		  
							 
                           <p><label>Your phone Number: </label><input name="phone" id="phone" type="text" class="text-input small-input" value="<?php echo $_SESSION['biz_reg']['phone']; ?>"  onchange="validatePhone(this)"/></p>
						   <p><label>File attachments (Optional):
</label><input name="logo" id="logo" type="file"   /></p>
						   
					<p>	 <label>Prefer Contact Method: </label><input type="radio" name="contact_method" id="contact_method_email" value="Email" checked="checked" />
          Email
          <input type="radio" name="contact_method" id="contact_method_tel" value="Telephone" />
          Telephone
          <input type="radio" name="contact_method" id="contact_method_either" value="Either" />
          Either</p>
						   
						   
							 <!--  <p><label>Mobile Number:</label><input name="mobile" id="mobile" type="text" class="text-input small-input" value="<?php echo $_SESSION['biz_reg']['mobile']; ?>" /></p>-->
							<!--   <p><label>Keywords:</label><input name="keywords" id="keywords" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['keywords']; ?>" /></p>
                           <p><label>Website:</label><input name="website" id="website" type="text" class="text-input small-input" value="<?php echo $_SESSION['biz_reg']['website']; ?>" /></p>
                             <p><label>Email:</label><input name="email" id="email" type="text" class="text-input small-input" value="<?php echo $_SESSION['biz_reg']['email']; ?>" /></p>-->
                             <p><label>Job Contact Person:</label>
                             <select name="b_userId"  id="b_userId" class="text-input small-input">
                             <?php while ($bOwners = mysql_fetch_array($result_users) ){  
								$selected='';
								if( $_SESSION['biz_reg']['b_userId'] == $bOwners['userId']){
									$selected = 'selected="selected"';
								}
								elseif( $_SESSION['biz_reg']['userId'] == $bOwners['userId']){
									$selected = 'selected="selected"';
								}
							?>
							<option value="<?php echo $bOwners['userId'] ;?>"  <?php echo  $selected; ?>><?php echo $bOwners['firstname'] . ' ' . $bOwners['lastname'] .' ('.$bOwners['email'].') '; ?> </option>
                            <?php  } ?>
                            </select>
                            </p>
                           <!-- <p><label>Status:</label>
                            <select name="status" id="status" class="text-input small-input">
                            	<option value="1" <?php if( $_SESSION['biz_reg']['status'] == '1'){ ?> selected="selected" <?php } ?>>Active</option>
                            	<option value="0" <?php if( $_SESSION['biz_reg']['status'] == '0'){ ?> selected="selected" <?php } ?>>Pending</option>
                            	<option value="-1" <?php if( $_SESSION['biz_reg']['status'] == '-1'){ ?> selected="selected" <?php } ?>>Expired</option>								
                            </select>
                            </p>
							<p><label>Trader Packages:</label>
                            <select name="btype" id="btype" class="text-input small-input">
                            <option value="0" <?php if( $_SESSION['biz_reg']['btype'] == '0'){ ?> selected="selected" <?php } ?>>Standard Plan</option>
                            <option value="1" <?php if( $_SESSION['biz_reg']['btype'] == '1'){ ?> selected="selected" <?php } ?>>Gold Plan</option>                            <option value="2" <?php if( $_SESSION['biz_reg']['btype'] == '2'){ ?> selected="selected" <?php } ?>>Diamond Plan</option>
                            </select>
							
                            </p>
						    <p><label>Start Date:(for paid only)</label><input name="startDate" id="startDate" type="text" class="text-input small-input" value="<?php echo date('Y-m-d'); ?>" /></p>
                            <p><label>Expiry Date:(for paid only)</label><input name="expirydate" id="expirydate" type="text" class="text-input small-input" value="<?php echo date('d-m-Y',mktime(0, 0, 0, date('m')+1, date('d'), date('Y')));?>" /></p>-->
                        	<p><input type="submit" class="button" value="&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;" name="SaveJob" id="SaveTrader"  /></p>
                        </fieldset>
                    </form>
            </div>
        </div>	
	</div> 
	<?php unset($_SESSION['biz_reg']); ?>     