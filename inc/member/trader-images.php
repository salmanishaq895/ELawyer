<?php 
$res_photoes = mysql_query("select * from `tt_business_photo` WHERE `bId` = '".$_SESSION['biz_reg']['locationid']."'");
?>
<div class="map_page_right_bar listing_right_bar">
  <div class="brued_crum_bar brued_crum_bar_c">
    <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;" >Home</a> > <a href="<?php echo $ru;?>member/statistics" style="text-decoration:none; color:#999999;"> Account Panel</a> ><a href="<?php echo $ru;?>member/trade-profile" style="text-decoration:none; color:#999999;"> Trader Profile ></a>   <a href="<?php echo $ru;?>member/trader-images" style="text-decoration:none; color:#999999;" > <span class="change"> Traders Images </span> </a></span></div>
  </div>
	<?php include('notice.php'); ?>
    <div class="cpanel_right_bar">
      <div class="company_detail_description">
	  	<span class="company_detail_span">Manage Traders Images</span>
		<?php if(isset($_SESSION['imager_uploade_msg'])){?>
			<div style="float:left; width:500px; margin-left:50px; color:#FF0000;"><?php echo $_SESSION['imager_uploade_msg']; ?></div>
		<?php } unset($_SESSION['imager_uploade_msg']); ?>
			<div class="input_flied">
				<div><strong>Trader Images:</strong></div>
			</div>
			<?php 
			$loopLimit = 30;
			$j=1;
			$totalUploaded = mysql_num_rows($res_photoes);
			if( $totalUploaded > 0 ){
			?>
			<div id="gallery">
				<ul>
					<?php
					 while( $row_photoes = mysql_fetch_array($res_photoes) ){
					 ?>
					  <li class="floatpics" id="imgli_<?php echo $row_photoes['id']; ?>">
						<a title="<?php echo $row_photoes['title']; ?>" href="<?php echo $ru."media/bussPics/".$_SESSION['biz_reg']['locationid'].'/'.$row_photoes['name']; ?>">
							<img src="<?php echo $ru."media/bussPics/".$_SESSION['biz_reg']['locationid'].'/thumbs/'.$row_photoes['name']; ?>" alt="<?php echo $row_photoes['name']; ?>" title="<?php echo $row_photoes['name']; ?>" border="0" />
						</a>
						<img src="<?php echo $ru; ?>images/dlt.gif" style="cursor:pointer;" onclick="deleteImage('<?php echo $row_photoes['id']; ?>');" />
						<form onsubmit="return updateCapion(<?php echo $row_photoes['id'] ?>);">
						<div class="caption">
							<?php if(empty($row_photoes['title'])){?>
								<span id="caption_txt_<?php echo $row_photoes['id'] ?>" style="color:#929292;" onclick="editCapion(<?php echo $row_photoes['id'] ?>);">(Image Caption)</span>
							<?php }else{ ?>
								<span id="caption_txt_<?php echo $row_photoes['id'] ?>" onclick="editCapion(<?php echo $row_photoes['id'] ?>);"><?php echo $row_photoes['title'] ?></span>
							<?php } ?>
								<input type="text" autocomplete="off" id="caption_input_<?php echo $row_photoes['id'] ?>" value="<?php echo $row_photoes['title'] ?>" onblur="updateCapion(<?php echo $row_photoes['id'] ?>);" style="display:none;" />
						</div>
						</form>
					  </li>
					  <?php
					 }
				  ?>
				</ul>
          	</div>
			<?php 
			}else{
				$totalUploaded = 0;
			}
			$totalImgs = $loopLimit - $totalUploaded;
		//echo $totalImgs; exit;
		?>
		<form name="form1" id="form1" method="post" action="<?php echo $ru;?>process/process_business.php" enctype="multipart/form-data" >
        <div class="images-uploade">
            Picture minimum 100x100 dimension and maximum 512kb size.
            <input type="file" name="bussPic[]" class="multi file_box max-<?php echo $totalImgs; ?>" style="" <?php $j++; ?> accept="gif|jpg|jpeg|png|bmp'" multiple />
			
			<div style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"> 
			(press CTRL to add multiple images at once)
			</div>
			<?php /*<input type="hidden" name ="MAX_FILE_SIZE" value="512000" />*/?>
		</div>
		<div class="profile_botton_outer">
            <div class="contact_us_gray_botton_inner cpanel_right_botton_button">
              <input type="submit" value="&nbsp;&nbsp;&nbsp;Uploade Images&nbsp;&nbsp;&nbsp;" name="UpdateTraderImages" id="UpdateTraderImages" class="inner_gray_botton" />
            </div>
        </div>
		</form>
	</div>
  </div>
</div>
<script>
$(document).ready(function() { 
	$(function() {
		$('#gallery a').lightBox();
	});
});
function editCapion(ImageId){
	$('#caption_txt_'+ImageId).hide();
	$('#caption_input_'+ImageId).show();
	$('#caption_input_'+ImageId).focus();
}
function updateCapion(ImageId){
	if($('#caption_input_'+ImageId).val() == ''){
		$('#caption_txt_'+ImageId).html('(Image Caption)');
		$('#caption_txt_'+ImageId).css("color","#929292");
		$('#caption_txt_'+ImageId).show();
		$('#caption_input_'+ImageId).hide();
	}else{
		$('#caption_txt_'+ImageId).css("color","#000");
		$('#caption_txt_'+ImageId).html($('#caption_input_'+ImageId).val());
		$('#caption_txt_'+ImageId).show();
		$('#caption_input_'+ImageId).hide();
	}
	$('#imgli_'+ImageId).attr('title',$('#caption_input_'+ImageId).val());
	$.ajax({
	  url: "<?php echo $ru?>process/process_business.php?imgid="+ImageId+'&title='+$('#caption_input_'+ImageId).val()+"&action=updateImgTitle",
	  context: document.body,
	  success: function(data){
	  	
	  }
	});
	
	return false;
}
function deleteImage(ImageId){
	if(confirm('Are you sure you want to delete this Traders profile display picture?'))
	{
		window.location = '<?php echo $ru; ?>process/process_business.php?delimid='+ImageId;
	}
}

</script>