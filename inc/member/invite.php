<?php 
$sql_profile	=	"select * from tt_user where userId='".$_SESSION['TTLOGINDATA']['USERID']."'";
$result	=	$db->get_row($sql_profile,ARRAY_A);
?>
<div class="map_page_right_bar listing_right_bar">
  <div class="brued_crum_bar brued_crum_bar_c">
    <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Home</a> > <?php if($_SESSION['TTLOGINDATA']['TYPE']=='t') {?><a href="<?php echo $ru;?>member/statistics" style=" text-decoration:none; color:#999999;">Account Panel></a> <?php }else{?> <a href="<?php echo $ru;?>member/profile" style=" text-decoration:none; color:#999999;">Account Panel></a><?php }?>  <a href="<?php echo $ru;?>member/invite" style="text-decoration:none; color:#999999;"> <span class="change">Invite Friend</span> </a></span></div>
  </div>
  
  <?php include($rootpath . "invite/sample/inviter.php"); ?>
  
</div>
<?php 
unset($_SESSION['user_reg_err']);
?>