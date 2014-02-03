<div class="map_page_left_bar listing_left_bar">
  <div class="map_page_left_bar_top"></div>
  <div class="map_page_left_bar_mid">
    <div class="listing_wrapper_left"> <span>Additional Search Options </span> </div>
	<form method="post" action="<?php echo $ru; ?>process/search.php">
		<div class="short_text_bar liting_barshort_text"> <span class="key_word ">Keyword Search</span>
		  <div class="short_text_flied_bar short_listing_input_flied">
			<input name="txt_keyword" id="txt_keyword" type="text" value="e.g plumber, builder, electrician" onfocus="if(this.value==this.defaultValue){this.value=''; this.style.color=''; jQuery('#cat_div, #sub_cat_div').hide();jQuery('#cat_div_disable,#sub_cat_div_disable').show(); jQuery('#searchby').val('keyword');}" onblur="if(this.value==''){this.value=this.defaultValue; this.style.color='#bebebe';jQuery('#cat_div,#sub_cat_div').show();jQuery('#cat_div_disable,#sub_cat_div_disable').hide();}" style="color:#bebebe;" class="listing_input"/>
		  </div>
		</div>
		<img src="<?php echo $ru; ?>images/listing_page_or.png"  class="map_page_left_img"/>
		<div class="short_text_bar liting_barshort_text">
		  <span class="key_word" style="cursor:default;">Category Search</span>
		  <div class="short_text_flied_bar short_listing_input_flied">
		  	
			<div id="cat_div_disable" style="display:none;">
			  <a><span>Category Search</span></a>
			  <a><img src="<?php echo $ru; ?>images/gray_drop_down_arrow.png" /></a>
			</div>
			<div id="cat_div" onClick="HideShow_e();" style="cursor:pointer;">
			  <a><span>Category Search</span></a>
			  <a><img src="<?php echo $ru; ?>images/drop_down_arrow.png" /></a>
			</div>
			
			<div class="hide_show_outer_div">
			  <div id="hide_show_div_e" style="display:none;">
				<?php 
				
				$subCatStr = '';
				$res = mysql_query("SELECT * FROM `tt_category` WHERE `cat_type` = '1' and `p_catid` = '0' ORDER BY `cat_name` ASC");
				while($row = mysql_fetch_array($res)){
				?>
				<span><?php echo $row['cat_name']; ?></span>
				<?php 
					$res_sub = mysql_query("SELECT * FROM `tt_category` WHERE `cat_type` = '1' and `p_catid` = '0' ORDER BY `cat_name` ASC");
					while($row_sub = mysql_fetch_array($res_sub)){
						$subCatStr = '<span>' . $row_sub['cat_name'] . '</span>';
					}
				}
				?>
				</div>
			  <input type="hidden" name="search_cat" id="search_cat" value="" />
			</div>
			
		  </div>
		</div>
		<input type="hidden" name="searchby" id="searchby" value="keyword" />
		<div class="short_text_bar liting_barshort_text"> <span class="key_word">Sub Category (optional)</span>
		  <div class="short_text_flied_bar short_listing_input_flied">
		  	<div id="sub_cat_div_disable" style="display:none;">
				<a><span>Sub Category (optional)</span></a>
				<a><img src="<?php echo $ru; ?>images/gray_drop_down_arrow.png" /></a>
			</div>
			<div id="sub_cat_div" onClick="HideShow_f();" style="cursor:pointer;">
				<a><span>Sub Category (optional)</span></a>
				<a><img src="<?php echo $ru; ?>images/drop_down_arrow.png" /></a>
			</div>
			<div class="hide_show_outer_div">
			  <div id="hide_show_div_f" style="display:none;">
			  <?php echo $subCatStr; ?>
			  </div>
			</div>
			<input type="hidden" name="search_sub_cat" id="search_sub_cat" value="" />
		  </div>
		</div>
		<div class="bottom_line" style="float:left;"></div>
		<div class="short_text_bar liting_barshort_text"> <span class="key_word">Location</span>
		  <div class="short_text_flied_bar short_listing_input_flied_b">
			<input name="txt_location" type="text" value="e.g city or postcode" onfocus="if(this.value == this.defaultValue){this.value=''; this.style.color='';}" onblur="if(this.value==''){this.value=this.defaultValue; this.style.color='#bebebe';}" style="color:#bebebe;" class="listing_input"/>
		  </div>
		</div>
		<div class="short_text_bar">
		  <div class="short_text_flied_bar short_listing_input_flied list_drap_down">
			<div class="hide_show_outer_div_drow" id="miles_div"><a href="javascript:;" onClick="HideShow_g();"><span>Distance in miles</span></a><a href="javascript:;" onClick="HideShow_g();"><img src="<?php echo $ru; ?>images/drop_down_arrow.png" /></a></div>
			<div class="hide_show_outer_div"> 
			  <div id="hide_show_div_g" style=" display:none;">
				<?php $distanc = array(5,10,25,50,75,100); 
				foreach($distanc as $dist)
					echo '<span>'.$dist.' Miles</span>';
				?>
				<input type="hidden" name="search_miles" id="search_miles" value="" />
			  </div>
			  </div>
		  </div>
		</div>
		<div class="search_bar_outer"> 
			<input type="submit" name="detailed_search" value="Search" class="search_btn" />
		</div>
	</form>
	<div class="short_text_bar" id="shortlist_bar">
	<span class="short_text_span" style="border-bottom:none;">Your Shortlist<?php /*<span class="edit ">edit</span>*/?></span>
	<?php include("short-list.php"); ?>
	</div>
	<?php 
	if(!empty($markers_center)){?>
		<div class="listing_wrapper_left list_map_bar">
			<span>Trades Mans Locations</span> 
			<div id="map_canvas" style="width:282px; height:300px;"> </div>
			<!--<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $markers_center;?>&zoom=6&size=275x291&maptype=roadmap<?php echo $markers ?>&sensor=false"/>-->
		</div>
	 <?php 
	 }
	 ?>
	<?php 
	
	$listing_lift = file_get_contents('ads/listing_lift.html',true);
	echo  stripslashes($listing_lift);
//	include("ads/listing_lift.html"); 
	?>
  </div>
  <div class="map_page_left_bar_last"></div>
</div>

<script>
		function HideShow_e(){
			if(document.getElementById('hide_show_div_e').style.display == 'none')
				jQuery('#hide_show_div_e').slideDown(10);
			else
				jQuery('#hide_show_div_e').slideUp(10);
		}
		
		
		jQuery('#hide_show_div_e span').live('click',function(){
			$.ajax({
			  url: '<?php echo $ru; ?>process/subcats.php?catname='+$(this).html(),
			  success: function(data) {
				$('#hide_show_div_f').html(data);
			  }
			});
			jQuery('#txt_keyword').attr('disabled', 'disabled');
			jQuery('#searchby').val('category');
			jQuery('#search_cat').val($(this).html());
			jQuery('#search_sub_cat').val('');
			jQuery('#cat_div a span').html($(this).html());
			jQuery('#sub_cat_div a span').html('Sub Category (optional)');
			jQuery('#cat_div a span').css("color","#000000")
			jQuery('#sub_cat_div a span').css("color","#CCCCCC")
			jQuery('#hide_show_div_e').slideUp(10);
		})
		jQuery('#hide_show_div_f span').live("click",function(){
			jQuery('#search_sub_cat').val($(this).html());
			jQuery('#sub_cat_div a span').html($(this).html());
			jQuery('#sub_cat_div a span').css("color","#000000")
			jQuery('#hide_show_div_f').slideUp(10);
		})
		jQuery('#hide_show_div_g span').live('click',function(){
			jQuery('#search_miles').val($(this).html());
			jQuery('#miles_div a span').html($(this).html());
			jQuery('#miles_div a span').css("color","#000000")
			jQuery('#hide_show_div_g').slideUp(10);
		})
		
		function HideShow_f(){
			if(document.getElementById('hide_show_div_f').style.display == 'none')
				jQuery('#hide_show_div_f').slideDown(10);
			else
				jQuery('#hide_show_div_f').slideUp(10);
		}
		function HideShow_g(){
			if(document.getElementById('hide_show_div_g').style.display == 'none')
				jQuery('#hide_show_div_g').slideDown(10);
			else
				jQuery('#hide_show_div_g').slideUp(10);
		}
		$("#txt_keyword").autocomplete({
		
			source: "<?php echo $ru; ?>process/getkeyword.php",
			minLength: 2
		});
</script>