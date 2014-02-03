<?php // echo $rs_business['name']; exit;?>
<script>
function HideShow(){
	if(document.getElementById('hide_show_div').style.display == 'none')
		jQuery('#hide_show_div').slideDown('slow');
	else
		jQuery('#hide_show_div').slideUp('slow');
}
function HideShow_b(){
    if(document.getElementById('hide_show_div_b').style.display == 'none')
        jQuery('#hide_show_div_b').slideDown('slow');
    else
        jQuery('#hide_show_div_b').slideUp('slow');
}
function HideShow_c(){
    if(document.getElementById('hide_show_div_c').style.display == 'none')
        jQuery('#hide_show_div_c').slideDown('slow');
    else
        jQuery('#hide_show_div_c').slideUp('slow');
}
function HideShow_d(){
    if(document.getElementById('hide_show_div_d').style.display == 'none')
        jQuery('#hide_show_div_d').slideDown('slow');
    else
        jQuery('#hide_show_div_d').slideUp('slow');
}
</script>
<script src="<?php echo $ru; ?>js/jquery.tools.min.js"></script>	
		<link rel="stylesheet" type="text/css" href="<?php echo $ru;?>css/scrollable-horizontal.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $ru;?>css/scrollable-buttons.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $ru;?>css/scrollable-navigator.css" />
		
<script src="<?php echo $ru;?>js/jscrolbar/jquery.mousewheel.js" type="text/javascript"></script>
<script src="<?php echo $ru;?>js/jscrolbar/jquery.em.js" type="text/javascript"></script>
<script src="<?php echo $ru;?>js/jscrolbar/jScrollPane.js" type="text/javascript"></script>
<link href="<?php echo $ru;?>js/jscrolbar/jScrollPane.css" rel="stylesheet" type="text/css"  />

<div class="main_quote_bar_b">
  <?php include("common/map-left.php"); ?>
  <div class="map_page_right_bar map_right_bar map_page_right_bar_b">
    <div class="brued_crum_bar"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Home</a> >  <a href="<?php echo $ru;?>map_location" style="text-decoration:none; color:#999999;"><span class="change">Map Page</span> </a></span>
      <?php include('common/view-style.php'); ?>
    </div>
    <div  style="width:670px; height:442px;" id="map_canvas"></div>
  </div>
</div>
