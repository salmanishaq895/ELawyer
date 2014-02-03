<?php  
if (isset ($_GET['s'] ))
{
	$_SESSION['redirect']['page'] = trim($_GET['s'] );
	$_SESSION['redirect']['pagedata'] =	trim($_GET['o']);
}

if(isset($_SERVER['HTTP_REFERER']) and ($_SERVER['HTTP_REFERER'] != $ru.'login') and ($_SERVER['HTTP_REFERER'] != $ru.'accountactivated') )
{	
	$_SESSION['redirectPage'] = $_SERVER['HTTP_REFERER'];
}
?>
<div class="main_quote_bar_b">
  <div class="map_page_right_bar" style="width:auto;">
    <div class="brued_crum_bar brued_crum_bar_c">
      <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Home</a> >  <a href="<?php echo $ru;?>search-traders" style="text-decoration:none; color:#999999;"> <span class="change">Find Jobs</span> </a></span> </div>
    </div>
    <div class="profile_page_left">
      <div class="listing_wrapper_left"> <span style="width:97%;">Additional Search Options </span> </div>
      <form method="post" action="<?php echo $ru; ?>process/search.php">
        <div class="search-frm">
          <div class="short_text_bar liting_barshort_text">
		    <span class="key_word ">Keyword Search</span>
            <div class="short_text_flied_bar short_listing_input_flied">
              <input name="txt_keyword" id="txt_keyword" type="text" value="e.g plumber, builder, electrician" onfocus="if(this.value==this.defaultValue){this.value=''; this.style.color=''; jQuery('#cat_div, #sub_cat_div').hide();jQuery('#cat_div_disable,#sub_cat_div_disable').show(); jQuery('#searchby').val('keyword');}" onblur="if(this.value==''){this.value=this.defaultValue; this.style.color='#bebebe';jQuery('#cat_div,#sub_cat_div').show();jQuery('#cat_div_disable,#sub_cat_div_disable').hide();}" style="color:#bebebe; width:269px; margin:0;"/>
            </div>
          </div>
          <img src="<?php echo $ru; ?>images/or_img-big.png" style="border:none; margin:20px 0 5px 0;" class="map_page_left_img"/>
          <div class="short_text_bar liting_barshort_text"> <span class="key_word" style="cursor:default;">Category Search</span>
            <div class="short_text_flied_bar short_listing_input_flied">
              <div id="cat_div_disable" style="display:none;"> <a><span>Category Search</span></a> <a><img src="<?php echo $ru; ?>images/gray_drop_down_arrow.png" /></a> </div>
              <div id="cat_div" onClick="HideShow_e();" style="cursor:pointer;"> <a><span>Category Search</span></a> <a><img src="<?php echo $ru; ?>images/drop_down_arrow.png" /></a> </div>
              <div class="hide_show_outer_div">
                <div id="hide_show_div_e" style="display:none; width:43%;">
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
              <div id="sub_cat_div_disable" style="display:none;"> <a><span>Sub Category (optional)</span></a> <a><img src="<?php echo $ru; ?>images/gray_drop_down_arrow.png" /></a> </div>
              <div id="sub_cat_div" onClick="HideShow_f();" style="cursor:pointer;"> <a><span>Sub Category (optional)</span></a> <a><img src="<?php echo $ru; ?>images/drop_down_arrow.png" /></a> </div>
              <div class="hide_show_outer_div">
                <div id="hide_show_div_f" style="display:none; width:43%;"> <?php echo $subCatStr; ?> </div>
              </div>
              <input type="hidden" name="search_sub_cat" id="search_sub_cat" value="" />
            </div>
          </div>
          <div class="bottom_line" style="float:left; width:95%; margin:27px 0 11px;"></div>
          <div class="short_text_bar liting_barshort_text"> <span class="key_word">Location</span>
            <div class="short_text_flied_bar short_listing_input_flied">
              <input name="txt_location" type="text" value="e.g city or postcode" onfocus="if(this.value == this.defaultValue){this.value=''; this.style.color='';}" onblur="if(this.value==''){this.value=this.defaultValue; this.style.color='#bebebe';}" style="color:#bebebe; width:269px; margin-left:0;"/>
            </div>
          </div>
          <div class="short_text_bar liting_barshort_text">
            <div class="short_text_flied_bar short_listing_input_flied">
              <div class="hide_show_outer_div_drow" id="miles_div"><a href="javascript:;" onClick="HideShow_g();"><span>Distance in miles</span></a><a href="javascript:;" onClick="HideShow_g();"><img src="<?php echo $ru; ?>images/drop_down_arrow.png" /></a></div>
              <div class="hide_show_outer_div">
                <div id="hide_show_div_g" style=" display:none; overflow:hidden; width:42%;">
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
        </div>
      </form>
    </div>
  </div>
  <?php //include("common/page-left.php"); ?>
</div>
<?php 
unset($_SESSION['user_con_err']);
unset($_SESSION['contact']);
?>
<script>
		function HideShow_e(){
			if(document.getElementById('hide_show_div_e').style.display == 'none')
				jQuery('#hide_show_div_e').slideDown('slow');
			else
				jQuery('#hide_show_div_e').slideUp('slow');
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
			jQuery('#hide_show_div_e').slideUp('slow');
		})
		jQuery('#hide_show_div_f span').live("click",function(){
			jQuery('#search_sub_cat').val($(this).html());
			jQuery('#sub_cat_div a span').html($(this).html());
			jQuery('#sub_cat_div a span').css("color","#000000")
			jQuery('#hide_show_div_f').slideUp('slow');
		})
		jQuery('#hide_show_div_g span').live('click',function(){
			jQuery('#search_miles').val($(this).html());
			jQuery('#miles_div a span').html($(this).html());
			jQuery('#miles_div a span').css("color","#000000")
			jQuery('#hide_show_div_g').slideUp('slow');
		})
		
		function HideShow_f(){
			if(document.getElementById('hide_show_div_f').style.display == 'none')
				jQuery('#hide_show_div_f').slideDown('slow');
			else
				jQuery('#hide_show_div_f').slideUp('slow');
		}
		function HideShow_g(){
			if(document.getElementById('hide_show_div_g').style.display == 'none')
				jQuery('#hide_show_div_g').slideDown('slow');
			else
				jQuery('#hide_show_div_g').slideUp('slow');
		}
		$("#txt_keyword").autocomplete({
			source: "<?php echo $ru; ?>process/getkeyword.php",
			minLength: 2
		});
</script>
