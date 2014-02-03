<?php 
$ads_arr = array('listing_top','listing_buttom','listing_lift','profile_top','profile_top_second','profile_middel','profile_right1','profile_right2','profile_image1','profile_image2','map');
if(isset($_POST['updateads'])){
	foreach($ads_arr as $adsname){
		$myFile = "../ads/".$adsname.".html";
		$fh = fopen($myFile, 'w') or die("can't open file");
		//echo "HIHIHI".$adsname;exit;
		$stringData =   $_POST[$adsname];
		fwrite($fh, $stringData);
		fclose($fh);
	}
	header("location:home.php?p=ads_management");exit;
}
foreach($ads_arr as $adsname){
	$$adsname = @file_get_contents('../ads/'.$adsname.'.html', true);
}

?>
<?php //include("ads/headerads.html"); ?>
<h3><a href="<?php echo $ruadmin; ?>home.php?p=ads_management">Ads Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Ads Management</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
  <?php if ( isset ($_SESSION['cms_cal_err']) ) {?>
		<div class="notification error png_bg">
			<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
			<div>
				<?php echo $_SESSION['cms_cal_err'] ; ?>
			</div>
		</div>	
  <?php } unset ($_SESSION['cms_cal_err']); ?>
	<div id="main">
		<form method="post" action="">
			<fieldset>
				<p><label>Listing Top Ads:(659x155)</label>
                <textarea name="listing_top" id="listing_top" rows="4" cols="72" type="text"><?php echo stripslashes($listing_top);  ?></textarea></p>
			</fieldset>
            <fieldset>
				<p><label>Listing Buttom Ads: (659x155)</label>
                <textarea name="listing_buttom" id="listing_buttom" rows="4" cols="72" type="text"><?php echo stripslashes($listing_buttom);  ?></textarea></p>
			</fieldset>
            <fieldset>
				<p><label>Listing Lift Ads:(270x548)</label>
                <textarea name="listing_lift" id="listing_lift" rows="4" cols="72" type="text"><?php echo stripslashes($listing_lift);  ?></textarea></p>
			</fieldset>
            <fieldset>
				<p><label>Profile Top Ads:(250x250)</label>
                <textarea name="profile_top" id="profile_top" rows="4" cols="72" type="text"><?php echo stripslashes($profile_top);  ?></textarea></p>
			</fieldset>
			 <fieldset>
				<p><label>Profile Top Second Ads:(647x90)</label>
                <textarea name="profile_top_second" id="profile_top_second" rows="4" cols="72" type="text"><?php echo stripslashes($profile_top_second);  ?></textarea></p>
			</fieldset>
			 <fieldset>
				<p><label>Profile Middel Ads:(647x90)</label>
                <textarea name="profile_middel" id="profile_middel" rows="4" cols="72" type="text"><?php echo stripslashes($profile_middel);  ?></textarea></p>
			</fieldset>
			<fieldset>
				<p><label>Profile Image 1 Ads:(276x217)</label>
                <textarea name="profile_image1" id="profile_image1" rows="4" cols="72" type="text"><?php echo stripslashes($profile_image1);  ?></textarea></p>
			</fieldset>
			 <fieldset>
				<p><label>Profile Right 1 Ads:(247x220)</label>
                <textarea name="profile_right1" id="profile_right1" rows="4" cols="72" type="text"><?php echo stripslashes($profile_right1);  ?></textarea></p>
			</fieldset>
			<fieldset>
				<p><label>Profile Image 2 Ads:(276x217)</label>
                <textarea name="profile_image2" id="profile_image2" rows="4" cols="72" type="text"><?php echo stripslashes($profile_image2);  ?></textarea></p>
			</fieldset>
			<fieldset>
				<p><label>Profile Right 2 Ads:(247x217)</label>
                <textarea name="profile_right2" id="profile_right2" rows="4" cols="72" type="text"><?php echo stripslashes($profile_right2);  ?></textarea></p>
			</fieldset>

<fieldset>
				<p><label>Map top left:(248x129)</label>
                <textarea name="map" id="map" rows="4" cols="72" type="text"><?php echo stripslashes($map);  ?></textarea></p>
			</fieldset>


            
            <p style="width:100%"><input type="submit" class="button" value="&nbsp;&nbsp;&nbsp;Update&nbsp;&nbsp;&nbsp;" name="updateads" id="submit" />
                </p>
		</form>
		</div>
	</div>
</div>