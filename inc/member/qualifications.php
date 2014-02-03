 <script type="text/javascript">
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
			
			
			
			//_______________________ this function is used for the title
			function titlecount(maxlimit) {
				var k = document.getElementById('title');
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
				
					document.getElementById('titleString').innerHTML = maxlimit - wcount;
					return true;
				}
				
				
				
			}
			
			
			
			</script>

<div class="map_page_right_bar listing_right_bar">
  <div class="brued_crum_bar brued_crum_bar_c">
    <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;" >Home</a> > <a href="<?php echo $ru;?>member/statistics" style="text-decoration:none; color:#999999;"> Account Panel</a> ><a href="<?php echo $ru;?>member/trade-profile" style="text-decoration:none; color:#999999;"> Trader Profile ></a> <a href="<?php echo $ru;?>member/qualifications/<?php if(isset($_GET['o'])) echo $_GET['o'];?>" style="text-decoration:none; color:#999999;" > <span class="change"> Qualifications </span> </a></span></div>
  </div>

	<?php include('notice.php'); ?>

    <div class="cpanel_right_bar">
      <div class="company_detail_description">
	  	<span class="company_detail_span">Manage Qualifications</span>
		<?php if(isset($_SESSION['qualification_msg'])){?>
			<div style="float:left; width:500px; margin-left:50px; color:#FF0000;"><?php echo $_SESSION['qualification_msg']; ?></div>
		<?php } unset($_SESSION['qualification_msg']); ?>
	  	<?php 
		$res_key = mysql_query("SELECT * FROM `tt_business_qualification` WHERE `userId` = '$userId' "); 
		$count = 0;
		$keyId = 0;
		if(isset($_GET['o']))
			$keyId = (int)$_GET['o'];
		if(mysql_num_rows($res_key)>0){
		?>
		<div class="list-row" style="margin-bottom:0;">
		  <div class="title" style="font-weight:bold;">Title</div>
		  <div class="img" style="font-weight:bold;">Image</div>
		  <div class="desc" style="font-weight:bold;">Description</div>
		  <div class="action" style="font-weight:bold;">Action</div>
		</div>
		<?php
			while($row_key = mysql_fetch_array($res_key)){
			?>
			<div class="list-row list-row-hover" style="margin-top:0; margin-bottom:0px;">
			<?php 
			if( $keyId==$row_key['id'] ){
				$qry_key = mysql_query("SELECT * FROM `tt_business_qualification` WHERE `id` = '$keyId'");
				$_SESSION['qualification'] = mysql_fetch_array($qry_key);
			?>
	  		<form name="form1" id="form1" method="post" action="<?php echo $ru;?>process/process_business.php" enctype="multipart/form-data" >
          <div class="input_flied">
            <div>Title <samp>* </samp></div>
            <input name="title" id="title" type="text" <?php if(isset($_SESSION['qualification_err']['title'])) echo 'style="border:1px solid #FF0000;"';?> class="text-input" value="<?php echo stripslashes($_SESSION['qualification']['title']); ?>" onkeyup="return titlecount(50);" />
			<samp style="margin:0 0 0 130px; font-size:12px; font-family:'MyriadProCondensed';" id="colorr">
				You can enter upto <samp id="titleString" style="font-size:12px;font-family:'MyriadProCondensed';"><?php
				echo (50 - count(explode(' ',$_SESSION['skill']['title'])));
				 ?></samp> words</samp><br />
			<div class="error" id="error_title" <?php if( isset($_SESSION['qualification_err']['title']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['qualification_err']['title']; ?></div>
          </div>
		  <?php if(!empty($_SESSION['qualification']['img']) and file_exists($rootpath . "media/qualification/" . $userId . "/thumb/".$_SESSION['qualification']['img']) ){ ?>
          <div class="input_flied">
            <div>&nbsp;</div>
            <div class="upload_image_bar" style="text-align:left; width:85px;">
              
			  
			  <!--<a href="<?php echo $ru . 'media/qualification/'.$userId.'/'.$_SESSION['qualification']['img'];?>" target="_blank">	<img src="<?php echo $ru.'images/link.jpg';?>" style="max-width:43px;" /></a>
			</div>
			</div>
-->			 
			  
			  <img src="<?php echo $ru."media/qualification/" . $userId . "/thumb/".$_SESSION['qualification']['img'];?>" title="thumb" style="margin:0;" alt="" />
              <br/>
              Image </div>
          </div>
		  <?php 
		  }else if(!empty($_SESSION['qualification']['img']) and file_exists($rootpath . "media/qualification/" . $userId . "/".$_SESSION['qualification']['img'])){
		  ?>
		  <div class="input_flied">
            <div>&nbsp;</div>
            <div class="upload_image_bar" style="text-align:left; width:85px;">
              <img src="<?php echo $ru;?>images/link.jpg" title="thumb" style="margin:0;" alt="" width="50" />
              <br/>
              file </div>
          </div>
		  <?php 
		 
		  }?>
		  
		  
          <div class="input_flied">
            <div>Image / file </div>
            <input name="img" id="img" type="file" style="width:auto; font-size:12px;" />
            &nbsp;&nbsp;&nbsp;(image size 170 X 115 )
            <input type="hidden" name="oldImg" value="<?php echo $_SESSION['qualification']['img'];?>" />
          </div>
          <div class="input_flied">
            <div>Description <samp>* </samp></div>
            <textarea name="shortdescription" id="shortdescription"  rows="4" cols="72" type="text" <?php if(isset($_SESSION['qualification_err']['shortdescription'])) echo 'style="border:1px solid #FF0000;"';?>  onkeyup="return textCounter(450);"><?php echo stripslashes($_SESSION['qualification']['shortdescription']); ?></textarea>
			<samp style="margin:0 0 0 130px; font-size:12px; font-family:'MyriadProCondensed';" id="colorr">
				You can enter upto <samp id="inputString" style="font-size:12px;font-family:'MyriadProCondensed';"><?php
				echo (450 - count(explode(' ',$_SESSION['skill']['shortdescription'])));
				 ?></samp> words</samp> <br />
			<div class="error" id="error_shortdescription" <?php if( isset($_SESSION['qualification_err']['shortdescription']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['qualification_err']['shortdescription']; ?></div>
          </div>
		  <div class="profile_botton_outer" style="margin-bottom:10px; float:left;">
            <div class="contact_us_gray_botton_inner cpanel_right_botton_button">
			  <input type="hidden" name="keyId" value="<?php echo $keyId; ?>" />
              <input type="submit" value="&nbsp;&nbsp;&nbsp;Update&nbsp;&nbsp;&nbsp;" name="addQualification" id="addQualification" class="inner_gray_botton" />
			  <input type="button" style="margin-left:10px;" onclick="window.location='<?php echo $ru; ?>member/qualifications/';" value="&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;" class="inner_gray_botton" />
            </div>
          </div>
		  </form>
		  <?php
		  }else{ ?>
			<div class="title"><?php echo $row_key['title']; ?></div>
			 <div class="img"><?php 
			  if(file_exists($rootpath.'media/qualification/'.$userId.'/thumb/'.$row_key['img']) and !empty($row_key['img'])){?>
			  	
				
				<!--<a href="<?php echo $ru . 'media/qualification/'.$userId.'/'.$row_key['img'];?>" target="_blank">	<img src="<?php echo $ru.'images/link.jpg';?>" style="max-width:43px;" /></a>-->
				
				
				<img src="<?php echo $ru.'media/qualification/'.$userId.'/thumb/'.$row_key['img'];?>" width="57" />
			  <?php 
			  }else if(!empty($row_key['img']) and file_exists($rootpath . "media/qualification/" . $userId . "/".$row_key['img'])){
		  ?>
		  <div class="input_flied">
            <div>&nbsp;</div>
            <div class="upload_image_bar" style="text-align:left; width:85px;">
              <img src="<?php echo $ru;?>images/link.jpg" title="thumb" style="margin:0;" alt="" width="45" height="40" />
        </div>
          </div>
		  <?php
		   }?>
			   </div>
			<div class="desc"><?php echo $row_key['shortdescription']; ?></div>
			 <div class="action">
			  	<a href="<?php echo $ru; ?>member/qualifications/<?php echo $row_key['id']; ?>"><img src="<?php echo $ru; ?>images/edit.gif" /></a>
				<a onclick="return confirm('Are you sure you want to delte this service?');" href="<?php echo $ru; ?>process/process_business.php?action=dlt_qualification&keyid=<?php echo $row_key['id']; ?>"><img src="<?php echo $ru; ?>images/drop.gif" /></a>
			  </div>
		 <?php 
		  $count++;
		}
		?>
			</div>
			<?php
		}
	  }
		if( ($count<5) and ($keyId==0)){
		?>
	  <form name="form1" id="form1" method="post" action="<?php echo $ru;?>process/process_business.php" enctype="multipart/form-data" >
          <div class="input_flied">
		  <h2>Add new Qualification</h2>
		  </div>
          <div class="input_flied">
            <div>Title <samp>* </samp></div>
            <input name="title" id="title" type="text" class="text-input" <?php if(isset($_SESSION['qualification_err']['title'])) echo 'style="border:1px solid #FF0000;"';?> value="<?php echo stripslashes($_SESSION['qualification']['title']); ?>" onkeyup="return titlecount(50);"/>
			<samp style="margin:0 0 0 130px; font-size:12px; font-family:'MyriadProCondensed';" id="colorr">
				You can enter upto <samp id="titleString" style="font-size:12px;font-family:'MyriadProCondensed';"><?php
				echo (50 - count(explode(' ',$_SESSION['skill']['title'])));
				 ?></samp> words</samp><br />
			<div class="error" id="error_title" <?php if( isset($_SESSION['qualification_err']['title']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['qualification_err']['title']; ?></div>
          </div>
          <div class="input_flied">
            <div>Image / file</div>
            <input name="img" id="img" type="file" value="<?php echo $_SESSION['qualification']['img'];?>" style="width:auto; font-size:12px;" />
            &nbsp;&nbsp;&nbsp;(image size 170 X 115 )
          </div>
          <div class="input_flied">
            <div>Description <samp>* </samp></div>
            <textarea name="shortdescription" id="shortdescription" <?php if(isset($_SESSION['qualification_err']['shortdescription'])) echo 'style="border:1px solid #FF0000;"';?> rows="4" cols="72" type="text" onkeyup="return textCounter(450);" ><?php echo stripslashes($_SESSION['qualification']['shortdescription']); ?></textarea>
			<samp style="margin:0 0 0 130px; font-size:12px; font-family:'MyriadProCondensed';" id="colorr">
				You can enter upto <samp id="inputString" style="font-size:12px;font-family:'MyriadProCondensed';"><?php
				echo (450 - count(explode(' ',$_SESSION['skill']['shortdescription'])));
				 ?></samp> words</samp> <br />
			<div class="error" id="error_shortdescription" <?php if( isset($_SESSION['qualification_err']['shortdescription']) ) echo 'style="display:block;"'; else echo 'style="display:none;"';?>><?php echo $_SESSION['qualification_err']['shortdescription']; ?></div>
          </div>
		  <div class="profile_botton_outer">
            <div class="contact_us_gray_botton_inner cpanel_right_botton_button">
			  <input type="submit" value="&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;" name="addQualification" id="addQualification" class="inner_gray_botton" />
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
unset($_SESSION['qualification_err']); 
unset($_SESSION['qualification']); 
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
		}else if(data == 'less'){
			$('#error_shortdescription').html('Must be at least 10 words long and less than 400 words');
			$('#error_shortdescription').show();
		}
	  }
	});
});


//___________++++++++++++ this is used for the description 

$("#title").focus(function(){
	$('#error_title').hide();
});
$("#title").blur(function(){
	$.ajax({
	  url: "<?php echo $ru?>process/swear-words-desc_key.php?str="+$(this).val(),
	  context: document.body,
	  success: function(data){
	  	if(data == 'swear'){
			$('#error_title').html('Swearing is not tolerated on TradesTools');
			$('#error_title').show();
		}
	  }
	});
});


</script>