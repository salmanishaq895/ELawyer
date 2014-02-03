<?php 
if ( isset($_GET['quotes_id']) and $_GET['quotes_id'] != '')
{ 
	
	$quotes_id = $_GET['quotes_id'];
	$business_qry = "SELECT  * FROM tt_quotes  where quotes_id =$quotes_id";
	$business_rs = mysql_query($business_qry) or die (mysql_error());
	$buiness_row = mysql_fetch_array($business_rs);

	if ( mysql_num_rows($business_rs) ==0 ){
		header('location:home.php');
		exit;
	}
	
	if ( !isset ($_SESSION['biz_reg']))
	{
		$_SESSION['biz_reg'] =$buiness_row;
		//$_SESSION['biz_reg']['expirydate'] = convert_db_Date($buiness_row['expirydate']);
		
		
	}
}
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
	//alert(pack.value);
	document.getElementById('startDate').value= '<?php echo date("Y-m-d")?>';
	document.getElementById('expiryDate').value= pack.value;
}
</script> 
<h3><a href="home.php?p=business">Trader </a> &raquo; <a href="#" class="active">Edit Job </a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Edit Job - <?php echo stripslashes($buiness_row['name']) ?></h3>
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
                
                	<form  method="post" action="<?php $ruadmin ;?>process/process_job.php" enctype="multipart/form-data">
                    <input type="hidden" name="quotes_id" id="quotes_id" value="<?php echo $quotes_id ?>">
					
                    	<fieldset>
						<?php /*?>	<p>
								<table border="0" width="90%" style="border:0px solid;">
									<tr><td><label>Bookmark count:&nbsp;<?php echo $buiness_row['bookmark_count'] ?></label></td><td><label>View count:&nbsp;<?php echo $buiness_row['view_count'] ?></b></td><td><label>Review count:&nbsp;<?php echo $buiness_row['review_count'] ?></label></td><td><label>RSS Views:&nbsp;<?php echo $buiness_row['rss_count'] ?></label></td></tr>
								</table>
							</p>
						<?php */?>	
                           
						   
						    <p><label>I'm looking for: </label><input name="txt_keyword" id="txt_keyword" type="text" class="text-input small-input" value="<?php echo $_SESSION['biz_reg']['keyword']; ?>" /></p>
							<p><label> City:</label><input name="txt_location" id="txt_location" type="text" class="text-input small-input" value="<?php echo $_SESSION['biz_reg']['location']; ?>" /></p>
							
							<p><label> Post Code:</label><input name="postcode" id="postcode" type="text" class="text-input small-input" value="<?php echo $_SESSION['biz_reg']['post_code']; ?>" /></p>
							 
							 <p><label> Within: </label><select name="miles" id="miles">
            <option value="10" <?php if($_SESSION['biz_reg']['miles']=='10') echo 'selected="selected"';?> >10 Miles</option>
            <option value="25"  <?php if($_SESSION['biz_reg']['miles']=='25') echo 'selected="selected"';?>>25 Miles</option>
            <option value="50"  <?php if($_SESSION['biz_reg']['miles']=='50') echo 'selected="selected"';?>>50 Miles</option>
            <option value="75"  <?php if($_SESSION['biz_reg']['miles']=='75') echo 'selected="selected"';?>>75 Miles</option>
            <option value="100"  <?php if($_SESSION['biz_reg']['miles']=='100') echo 'selected="selected"';?>>100 Miles</option>
          </select></p>
							
							<p><label>Quote Request title:</label><input name="title" id="title" type="text" class="text-input small-input" value="<?php echo $_SESSION['biz_reg']['title']; ?>" /></p>
                            
                            <p><label>Describe what you need: </label><textarea name="message" id="message" rows="4" cols="72" type="text" class="text-input medium-input"><?php echo $_SESSION['biz_reg']['message']; ?></textarea></p>
						   
						  <p><label> When do you need it by?
 </label><select name="within" id="within">
            <option value="whenever" <?php if($_SESSION['biz_reg']['within'] == 'whenever') echo 'selected="selected"'; ?>>Whenever </option>
            <option value="During one day"  <?php if($_SESSION['biz_reg']['within'] == 'During one day') echo 'selected="selected"'; ?> >During one day</option>
            <option value="During one week" <?php if($_SESSION['biz_reg']['within'] == 'During one week') echo 'selected="selected"'; ?>>During one week</option>
            <option value="During two week" <?php if($_SESSION['biz_reg']['within'] == 'During two week') echo 'selected="selected"'; ?>>During two week</option>
          </select></p>
		  
							 
                           <p><label>Your phone Number: </label><input name="phone" id="phone" type="text" class="text-input small-input" value="<?php echo $_SESSION['biz_reg']['phone']; ?>"  onchange="validatePhone(this)"/></p>
						   <p><label>File attachments (Optional):
</label><input name="logo" id="logo" type="file"   /></p>




<p>	 <label>Status: </label><input type="radio" name="statuse" id="status_active" value="Active" <?php if($_SESSION['biz_reg']['status'] == 'Active') echo 'checked="checked"'; ?>  />
          Active 
          <input type="radio" name="statuse" id="status_expired" value="Pending" <?php if($_SESSION['biz_reg']['status'] == 'Pending') echo 'checked="checked"'; ?>  />
          Expired 
          </p>


						   
					<p>	 <label>Prefer Contact Method: </label><input type="radio" name="contact_method" id="contact_method_email" value="Email" <?php if($_SESSION['biz_reg']['contact_method'] == 'Email') echo 'checked="checked"'; ?>  />
          Email
          <input type="radio" name="contact_method" id="contact_method_tel" value="Telephone" <?php if($_SESSION['biz_reg']['contact_method'] == 'Telephone') echo 'checked="checked"'; ?>  />
          Telephone
          <input type="radio" name="contact_method" id="contact_method_either" value="Either"  <?php if($_SESSION['biz_reg']['contact_method'] == 'Either') echo 'checked="checked"'; ?> />
          Either</p>
						   
		 <p><label>Job Contact Person:</label>
                             <select name="b_userId"  id="b_userId" class="text-input small-input">
                             <?php 	$sql    = "SELECT  userId,firstname,lastname,email,username FROM tt_user where type = 'c' order by firstname,lastname ";
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
						   
						   
						<img src="<?php echo $ru."media/job_images/".$_SESSION['biz_reg']['jobid']."/logo/thumb/".$_SESSION['biz_reg']['logo'];?>" title="thumb" alt="" />
							
							<img src="<?php echo $ru; ?>media/no_img.gif" title="" alt="" />
							
							
						<!--	 <p><label>Job Category:</label><select name="industry" id="industry">
							< ?php 
								$prodcts ="SELECT * from tt_category where p_catid = 0 AND `cat_type` = '1' order by cat_name asc";
								$prodctsRS = mysql_query($prodcts);
								while ($prodctsRow = mysql_fetch_array($prodctsRS))
								{
									$catname = $prodctsRow['cat_name'];
									$catid = $prodctsRow['catid'];
									echo "<option  value='".$catname."'"; if($_SESSION['biz_reg']['category']==$catname) { echo "selected='selected'";} echo " >".$catname."</option>";									
								
								}							
							?>
							 </select></p>
							  <p><label>Sub Category:</label><select name="sub_cat" id="sub_cat">
							< ?php 
								 $cat = array();
									$sql = "SELECT * from tt_category where p_catid != 0 AND `cat_type` = '1' order by cat_name asc ";
									$result =@mysql_query($sql);
								while ($row = mysql_fetch_array( $result ) ){
									    $cat_id = $row['catid'];
										$sub = $row['cat_name'];
										
								echo "<option  value='".$sub."'"; if($_SESSION['biz_reg']['subcategory']==$sub) { echo "selected='selected'";} echo " >".$sub."</option>";				 
								
							}
									?>								
							 </select></p>
                        
-->                                             	<p><input type="submit" class="button" value="&nbsp;&nbsp;&nbsp;Update&nbsp;&nbsp;&nbsp;" name="UpdateJob" id="UpdateJob" /></p>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>	      
		<?php unset($_SESSION['biz_reg']); ?>