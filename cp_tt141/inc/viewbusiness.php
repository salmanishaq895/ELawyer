<?php 
if ( isset($_GET['bId']) and $_GET['bId'] != '')
{ 
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
		$_SESSION['biz_reg'] =$buiness_row;
	}
}
?>              
<h3><a href="home.php?p=business">Business</a> &raquo; <a href="#" class="active">View Business</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>View Business - <?php echo $buiness_row['name'] ?></h3>
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
                    	<fieldset>
                            <p><strong>Business Name:</strong>&nbsp; <?php echo stripslashes($_SESSION['biz_reg']['name']); ?></p>
                           
                            <p><strong>Logo:</strong>&nbsp;
                            <p><label></label><?php if(isset($_SESSION['biz_reg']['logo']) and $_SESSION['biz_reg']['logo']!=""){ ?>	
							
						<img src="<?php echo $ru."media/buisness_images/".$_SESSION['biz_reg']['locationid']."/logo/thumb/".$_SESSION['biz_reg']['logo'];?>" title="thumb" alt="" />
							<?php } else{?>
							<img src="<?php echo $ru; ?>media/images.jpg" title="" alt="" width="100" height="80" />
							
							 
							<?php }?>
							</p>
						    <p><strong>Description:</strong>&nbsp;<?php echo strip_tags(stripslashes($_SESSION['biz_reg']['description'])); ?></p>
                            <p><strong>Business Category:</strong>&nbsp;<?php echo $_SESSION['biz_reg']['industry']; ?></p>
                            <p><strong>Business Sub-Category:</strong>&nbsp;<?php echo $_SESSION['biz_reg']['subcat']; ?></p>
						    <p><strong>Address:</strong>&nbsp;<?php echo stripslashes($_SESSION['biz_reg']['address']); ?></p>
                            <p><strong>City:</strong>&nbsp;<?php echo $_SESSION['biz_reg']['city']; ?></p>
                            <p><strong>State:</strong>&nbsp;<?php echo $_SESSION['biz_reg']['state']; ?></p>
                            <p><strong>Zipcode</strong>&nbsp;<?php echo $_SESSION['biz_reg']['zip']; ?></p>
                            <p><strong>Phone:</strong>&nbsp;<?php echo $_SESSION['biz_reg']['phone']; ?></p>
							 <p><strong>Keywords:</strong>&nbsp;<?php echo $_SESSION['biz_reg']['keywords']; ?></p>
                            <p><strong>Website:</strong>&nbsp;<?php echo $_SESSION['biz_reg']['website']; ?></p>
                            <p><strong>Email:</strong>&nbsp;<?php echo $_SESSION['biz_reg']['email']; ?></p>
                            <p><strong>Business Owner:</strong>&nbsp;
                            <?php 	
									$sql="SELECT  userId,firstname,lastname,email,username FROM tt_user where type <>'u' ";
									$result_users = mysql_query($sql) or die (mysql_error());
									while ($bOwners = mysql_fetch_array($result_users) ){  
							?>
                            <?php if( $_SESSION['biz_reg']['b_userId'] == $bOwners['userId']){ ?>
                            <?php echo $bOwners['firstname'] . ' ' . $bOwners['lastname'] .' ('.$bOwners['email'].') '; ?>
                            <?php  }} ?>
                            </p>
                            <p><strong>Status:</strong>&nbsp;
                            <?php if( $_SESSION['biz_reg']['status'] == '1'){ echo "Active"; } ?>
                            <?php if( $_SESSION['biz_reg']['status'] == '0'){ echo "Pending"; } ?>
                            <?php if( $_SESSION['biz_reg']['status'] == '-1'){ echo "Expired"; } ?>
                            </p>
							
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>	      