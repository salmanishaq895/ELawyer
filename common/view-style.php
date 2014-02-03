<?php 
$uri_string = $_GET['page'].'/';
if(isset($_GET['s']) and !empty($_GET['s']))
{
	$uri_string .= $_GET['s'].'/';
}
else{
		$uri_string .= 'all/';
}
if(isset($_GET['o']) and !empty($_GET['o']))
{
	$uri_string .= $_GET['o'].'/';
}
else{
		$uri_string .= 'all/';
}


?>
<style>
/*
.listing_class{		
	padding-left:7px!important;
}
.listing_classs{
padding:0px;
margin:0px;
}
.selected_list{	
	background: none repeat scroll 0 0 #5469F4; color:#fff !important;		
}
.color_white{
	color:#FFFFFF;
}*/
</style>

<div class="drap_down_outer_bar drap_down_map_outer_bar">
  <div class="drap_down_bar">
    <div class="featured_input_outer"> <span style="padding-left:0px;"> <samp > View Style :</samp>
      <div class="featured_div"> <a href="javascript:;" onClick="HideShow_c();"><span><?php if($page=='listings') echo "Listings"; else echo "Map";?></span></a> <a href="javascript:;" onClick="HideShow_c();"><img src="<?php echo $ru; ?>images/drop_down_arrow.png" /></a> </div>
      </span>
      <div class="hide_show_outer_div">
        <div id="hide_show_div_c" style="display:none;  margin: 0 0 0 73px; width: 20.8%;">
			<span class="listing_class">
			<a onClick="HideShow_c();" <?php echo 'href="' . str_replace('listings','map_location',str_replace('page-','',$targetpage)) . '"';?>>
			Map
			</a>
			</span>
			<span  class="listing_class ">
			<a onClick="HideShow_c();" <?php echo 'href="' . str_replace('map_location','listings',str_replace('page-','',$targetpage)) . '"';?>>
			Listing
			</a>
			</span>
		</div>
       </div>
    </div>
  </div>
  <div class="drap_down_bar">
    <div class="featured_input_outer .featured_input_outer1"><span style="padding-left:15px;"><samp>Sort By :</samp>
      <div class="featured_div"><span onClick="HideShow_d();" style="cursor:pointer; margin-left:10px;"><?php   if($_GET['p']=='review'){echo "Review";}else if($_GET['p']=='location') {echo "Location";}else if($_GET['p']=='photo'){echo "Photo";}else{echo "Best Match";}
	  
	  ?></span><a href="javascript:;" onClick="HideShow_d();"><img src="<?php echo $ru; ?>images/drop_down_arrow.png" /></a></div>
      </span>
      <div class="hide_show_outer_div" onClick="HideShow_d();"> 
		<div id="hide_show_div_d" style="display:none;  margin: 0 0 0 88px; width: 20.8%;">
			<span class="listing_class"><a href="<?php echo $ru.$uri_string.'review/';?>" >Reviews </a> </span> 
			<span class="listing_class"><a href="<?php echo $ru.$uri_string.'location/';?>">Location</a></span>
			<span class="listing_class"><a href="<?php echo $ru.$uri_string.'photo/';?>"> Photos</a></span> 
			
		</div>
     </div>
    </div>
  </div>
</div>

    
<!--	<div class="drap_down_outer_bar liting_page_drap_down_outer_bar">
  <div class="drap_down_bar">
    <div class="featured_input_outer"> <span style="padding-left:5px;"> <samp > View Style :</samp>
      <div class="featured_div"> 
	  	<a href="javascript:;" onClick="HideShow_c();"><span>Map</span></a> 
	  	<a href="javascript:;" onClick="HideShow_c();"><img src="<?php echo $ru; ?>images/drop_down_arrow.png" /></a> 
	  </div>
      </span>
      <div class="hide_show_outer_div">
        <div id="hide_show_div_c" style="display:none; margin:0 0 0 76px; padding-left:0; width:20%;">
			<span class="listing_class"><a onClick="HideShow_c();" <?php echo 'href="' . str_replace('listings','map_location',str_replace('page-','',$targetpage)) . '"';?> class="<?php if($page=='map_location') echo 'color_white';?>">Map</a></span>
			<span  class="listing_class <?php if($page=='listings') echo 'selected_list';?>"><a onClick="HideShow_c();" <?php echo 'href="' . str_replace('map_location','listings',str_replace('page-','',$targetpage)) . '"';?> class="<?php if($page=='listings') echo 'color_white';?>">Listing</a></span>
		</div>
       </div>
    </div>
  </div>
  
  <div class="drap_down_bar">
    <div class="featured_input_outer"> <span style="padding-left:5px;"> <samp > Sort By :</samp>
      <div class="featured_div"> 
	  	<a href="javascript:;" onClick="HideShow_c();"><span>Best Match</span></a> 
	  	<a href="javascript:;" onClick="HideShow_c();"><img src="<?php echo $ru; ?>images/drop_down_arrow.png" /></a> 
	  </div>
      </span>
      <div class="hide_show_outer_div" onClick="HideShow_d();"> 
		<div id="hide_show_div_d" style="display:none; padding-left:0; width:20%;">
			<span class="listing_class <?php if($_GET['p']=='date_asc') echo 'selected_list';?>"><a href="<?php echo $ru.$uri_string.'date_asc/';?>" class="<?php if($_GET['p']=='date_asc') echo 'color_white';?>">Date Asc </a> </span> 
			<span class="listing_class <?php if($_GET['p']=='date_desc') echo 'selected_list';?>"><a href="<?php echo $ru.$uri_string.'date_desc/';?>" class="<?php if($_GET['p']=='date_desc') echo 'color_white';?>">Date Desc </a></span>
			<span class="listing_class <?php if($_GET['p']=='name_asc') echo 'selected_list';?>"><a href="<?php echo $ru.$uri_string.'name_asc/';?>" class="<?php if($_GET['p']=='name_asc') echo 'color_white';?>"> Name Asc</a></span> 
			<span class="listing_class <?php if($_GET['p']=='name_desc') echo 'selected_list';?>"><a href="<?php echo $ru.$uri_string.'name_desc/';?>" class="<?php if($_GET['p']=='name_desc') echo 'color_white';?>">Name Desc</a> </span> 
		</div>
       </div>
    </div>
  </div>
  
</div>
-->
<script>
function HideShow_c(){
	if(document.getElementById('hide_show_div_c').style.display == 'none')
		jQuery('#hide_show_div_c').show( ) ;
	else
		jQuery('#hide_show_div_c').hide();
		jQuery('#hide_show_div_d').hide();
}

function HideShow_d(){
	if(document.getElementById('hide_show_div_d').style.display == 'none')
		jQuery('#hide_show_div_d').show();
	else
		jQuery('#hide_show_div_d').hide();
		jQuery('#hide_show_div_c').hide();
		
}
</script>