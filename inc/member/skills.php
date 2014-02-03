<script >
function textCounter(maxlimit) {
				var k = document.getElementById('shortdescription');
				actstr = k.value.replace('  ',' ');
				
				if (k.selectionStart) {
					cursorPos = k.selectionStart;
				} else if (!document.selection) {
					var cursorPos = 0;
				}
				var wcount = actstr.split(' ').length;
				//alert(wcount);
				if(wcount>10){
				//document.getElementById('colorr').css({"color":"red"}) ;
				//$("#colorr").css("background-color","yellow");
				$("#colorr").css("color","green")
				}
				if(wcount<10){
				//document.getElementById('colorr').css({"color":"red"}) ;
				//$("#colorr").css("background-color","yellow");
				$("#colorr").css("color","#6A6A6A")
				}
				if (wcount > maxlimit){
					var str_arr = actstr.split(' ');
					var actstr2 = '';
					for (var i = 0; i < maxlimit; i++){
						if(i == 0)
							actstr2 = str_arr[i];
						else
							actstr2 += ' '+str_arr[i];
					}
					
					k.value = $.trim(actstr2);
					return false;
				}else{
				
					document.getElementById('inputString').innerHTML = maxlimit - wcount;
					return true;
				}
				
				
				
			}
			

</script>

<div class="map_page_right_bar listing_right_bar">
  <div class="brued_crum_bar brued_crum_bar_c">
    <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;" >Home</a> > <a href="<?php echo $ru;?>member/statistics" style="text-decoration:none; color:#999999;"> Account Panel</a> ><a href="<?php echo $ru;?>member/trade-profile" style="text-decoration:none; color:#999999;"> Trader Profile ></a>  <a href="<?php echo $ru;?>member/skills/<?php if(isset($_GET['o'])) echo $_GET['o'];?>" style="text-decoration:none; color:#999999;" > <span class="change"> Skills </span> </a></span></div>
  </div>

	<?php include('notice.php'); ?>

    <div class="cpanel_right_bar">
      <div class="company_detail_description">
	  	<span class="company_detail_span">Manage Skills</span>
		<?php if(isset($_SESSION['skill_msg'])){?>
			<div style="float:left; width:500px; margin-left:50px; color:#FF0000;"><?php echo $_SESSION['skill_msg']; ?></div>
		<?php } unset($_SESSION['skill_msg']); ?>
	  	<?php 
		$res_key = mysql_query("SELECT * FROM `tt_business_skills` WHERE `userId` = '$userId' "); 
		$count = 0;
		$keyId = 0;
		if(isset($_GET['o']))
			$keyId = (int)$_GET['o'];
		if(mysql_num_rows($res_key)>0){
		?>
		<div class="list-row" style="margin-bottom:0;">
		  <div class="desc" style="font-weight:bold;width:380px;">Skill Description</div>
		  <div class="img" style="font-weight:bold;width:140px;">Skill Level</div>
		  <div class="action" style="font-weight:bold;">Action</div>
		</div>
		<?php
		while($row_key = mysql_fetch_array($res_key)){
		?>
			<div class="list-row list-row-hover" style="margin-top:0; margin-bottom:0px;">
			<?php 
			if( $keyId==$row_key['id'] ){
				$qry_key = mysql_query("SELECT * FROM `tt_business_skills` WHERE `id` = '$keyId'");
				$_SESSION['skill'] = mysql_fetch_array($qry_key);
			?>
	  		<form name="form1" id="form1" method="post" action="<?php echo $ru;?>process/process_business.php" enctype="multipart/form-data" >
			<div  style="margin:10px 0 10px 157px;display: table; float: left; height: auto; font-size:12px; font-family:Arial, Helvetica, sans-serif;"> 
		  Be honest about your skills levels where 10 is the best and 1 is the lowest.<br /> Having 10 on everything will look suspicious to anyone who is looking at your profile.<br /> Honesty is the Best Policy
		  </div>
          <div class="input_flied">
            <div>Skill <samp>* </samp></div>
            <textarea name="shortdescription" id="shortdescription"  rows="4" cols="72" type="text" <?php if(isset($_SESSION['skill_err']['shortdescription'])) echo 'style="border:1px solid #FF0000;"';?>  onkeyup="return textCounter(30)" ><?php echo stripslashes($_SESSION['skill']['shortdescription']); ?></textarea>
			<samp style="margin:0 0 0 130px; font-size:12px; font-family:'MyriadProCondensed';" id="colorr">
				You can enter upto <samp id="inputString" style="font-size:12px;font-family:'MyriadProCondensed';"><?php
				echo (30 - count(explode(' ',$_SESSION['skill']['shortdescription'])));
				 ?></samp> words</samp><br />
			<div class="error" id="error_shortdescription" <?php if( isset($_SESSION['skill_err']['shortdescription']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['skill_err']['shortdescription']; ?></div>
          </div>
		  <div class="input_flied">
            <div>Skill Level <samp>* </samp></div>
			<select name="skill_level" id="skill_level">
				<?php 
				$arr_level = array(0,1,2,3,4,5,6,7,8,9,10);
				foreach($arr_level as $skillLvl){
				?>
            	<option <?php if($_SESSION['skill']['skill_level'] == $skillLvl) echo 'selected="selected"';?>><?php echo $skillLvl; ?></option>
				<?php
				}
				?>
			</select>
          </div>
		  <div class="profile_botton_outer" style="margin-bottom:10px; float:left;">
            <div class="contact_us_gray_botton_inner cpanel_right_botton_button">
			  <input type="hidden" name="keyId" value="<?php echo $keyId; ?>" />
              <input type="submit" value="&nbsp;&nbsp;&nbsp;Update&nbsp;&nbsp;&nbsp;" name="addSkill" id="addSkill" class="inner_gray_botton" />
			  <input type="button" style="margin-left:10px;" onclick="window.location='<?php echo $ru; ?>member/skills/';" value="&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;" class="inner_gray_botton" />
            </div>
          </div>
		  </form>
		  <?php
		  }else{ ?>
		  	 <div class="desc" style="width:380px;"><?php echo $row_key['shortdescription']; ?></div>
			 <div class="img" style="width:140px;">
			  	<img src="<?php echo $ru.'images/rating_'.$row_key['skill_level'].'.png';?>" width="57" /><br/>
				<?php echo '('.$row_key['skill_level'].')'; ?>
			 </div>
			 <div class="action">
			  	<a href="<?php echo $ru; ?>member/skills/<?php echo $row_key['id']; ?>"><img src="<?php echo $ru; ?>images/edit.gif" /></a>
				<a onclick="return confirm('Are you sure you want to delte this skill level?');" href="<?php echo $ru; ?>process/process_business.php?action=dlt_skill&keyid=<?php echo $row_key['id']; ?>"><img src="<?php echo $ru; ?>images/drop.gif" /></a>
			  </div>
		 <?php 
		  $count++;
		}
		?>
			</div>
			<?php
		}
	  }
		if( ($count<10) and ($keyId==0)){
		?>
	  <form name="form1" id="form1" method="post" action="<?php echo $ru;?>process/process_business.php" enctype="multipart/form-data" >
          <div class="input_flied">
		  <h2>Add new skill</h2>
		  </div>
		  <div  style="margin:10px 0 10px 157px;display: table; float: left; height: auto; font-size:13px; font-family:Arial, Helvetica, sans-serif;"> 
		  Be honest about your skills levels where 10 is the best and 1 is the lowest.<br /> Having 10 on everything will look suspicious to anyone who is looking at your profile.<br /> Honesty is the Best Policy
		  </div>
		  <div class="input_flied">
            <div>skill <samp>* </samp></div>
            <textarea name="shortdescription" id="shortdescription" <?php if(isset($_SESSION['skill_err']['shortdescription'])) echo 'style="border:1px solid #FF0000;"';?> rows="4" cols="72" type="text"  onkeyup="return textCounter(30)"><?php echo stripslashes($_SESSION['skill']['shortdescription']); ?></textarea>
			<samp style="margin:0 0 0 130px; font-size:12px; font-family:'MyriadProCondensed';" id="colorr">
				You can enter upto <samp id="inputString" style="font-size:12px;font-family:'MyriadProCondensed';"><?php
				echo (30 - count(explode(' ',$_SESSION['skill']['shortdescription'])));
				 ?></samp> words</samp><br />
			 <div class="error" id="error_shortdescription" <?php if( isset($_SESSION['skill_err']['shortdescription']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['skill_err']['shortdescription']; ?></div>
			
          </div>
		 
          <div class="input_flied">
            <div>Skill Level<samp>* </samp></div>
            <select name="skill_level" id="skill_level">
				<?php 
				$arr_level = array(0,1,2,3,4,5,6,7,8,9,10);
				foreach($arr_level as $skillLvl){
				?>
            	<option <?php if($_SESSION['skill']['skill_level'] == $skillLvl) echo 'selected="selected"';?>><?php echo $skillLvl; ?></option>
				<?php
				}
				?>
			</select>
          </div>
          
		  <div class="profile_botton_outer">
            <div class="contact_us_gray_botton_inner cpanel_right_botton_button">
			  <input type="submit" value="&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;" name="addSkill" id="addSkill" class="inner_gray_botton" />
            </div>
          </div>
		  </form>
		<?php 
		}
		?>
      </div>
	</div>
  
</div>
<?php
unset($_SESSION['skill_err']); 
unset($_SESSION['skill']); 
?>
<script>
//___________++++++++++++ this is used for the description 

$("#shortdescription").focus(function(){
	$('#error_shortdescription').hide();
});
$("#shortdescription").blur(function(){
	$.ajax({
	  url: "<?php echo $ru?>process/swear-words-desc_key.php?str="+$(this).val(),
	  context: document.body,
	  success: function(data){
	  	if(data == 'swear'){
			$('#error_shortdescription').html('Swearing is not tolerated on TradesTools');
			$('#error_shortdescription').show();
		}
	  }
	});
});

</script>