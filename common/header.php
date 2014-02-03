
<div class="main_top_outer_bar">
  <div class="main_top_bar">
    <div class="main_top_logo_bar"> <a href="<?php echo $ru; ?>"><img style="width:200px; height:200px;" src="<?php echo $ru; ?>images/logo1.png" class="main_top_logo_img" /></a> </div>
  </div>
  <div class="menu_bar">
    <ul>
		<?php  if($_SESSION['TTLOGINDATA']['ISLOGIN'] == 'yes'){?>
		<li class="<?php if(in_array($page,array('member'))) echo 'selected';?>"><a href="<?php echo $ru; ?>member.php">My Account</a></li>
		<?php }else{ ?>
		<li class="creat_profile <?php if(in_array($page,array('signup'))) echo 'selected';?>"><a href="<?php echo $ru; ?>signup.php">Register Advocate</a></li>
		<?php }
		?>
	
		<li class="<?php if(in_array($page,array('Advocate'))) echo 'selected';?>"><a href="<?php echo $ru; ?>Advocate.php">Lawyers</a></li>
		
		<li class="<?php if(in_array($page,array('quotes'))) echo 'selected';?>"><a href="<?php echo $ru; ?>quotes.php">Post Your Case</a></li>
		<li class="<?php if(in_array($page,array('home'))) echo 'selected';?>">
		<a  href="<?php echo $ru; ?>">Online Juidicial System </a>
		<ul class="submenu" id="how_it_works_sub" style="display:none;">
			<li><a href="<?php echo $ru; ?>how_it_work_for_user/">For Home Owners</a></li>
			<li><a href="<?php echo $ru; ?>how_it_work_for_trader/">For Trades People</a></li>
		</ul>
		</li>
		
    </ul>
    <!--<img src="images/menu_bar_bottom_line.jpg"  />-->
  </div>
</div>
<script>
	$('#how-it-works,.submenu').bind({
		mouseenter: function(){
			$('#how_it_works_sub').show();
		},
		mouseleave: function(){
			$('#how_it_works_sub').hide();
		}
	});
</script>
