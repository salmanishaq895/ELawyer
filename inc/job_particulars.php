<?php  
if (isset ($_GET['s']))
{
	$_SESSION['redirect']['page'] = trim($_GET['s'] );
	$_SESSION['redirect']['pagedata'] =	trim($_GET['o']);
}



if(isset($_SERVER['HTTP_REFERER']) and ($_SERVER['HTTP_REFERER'] != $ru.'signin') and ($_SERVER['HTTP_REFERER'] != $ru.'accountactivated') )
{	
	$_SESSION['redirectPage'] = $_SERVER['HTTP_REFERER'];
}

$query_string = ' WHERE 1=1 ';
if( isset ( $_GET['s'] ) )
{
	$arr = explode('_',$_REQUEST['s']);
	$job_id = $arr[0];
	$query_string .= " AND quotes_id = '".$job_id."'";	
	$quotes_query = "SELECT * FROM tt_quotes $query_string "; //exit;
	$quotes_row = $db->get_row($quotes_query, ARRAY_A);
}

$chk_qry = "select * from tt_find_trade where jobId = '".$job_id."' ";
$exe_chk = @mysql_query($chk_qry);
while($applied_jobs = @mysql_fetch_array($exe_chk))
{

$applications_list[] = $applied_jobs['tradUid'];

}

/*if(isset($_POST['submit']))
{
	$sql  = "insert into tt_find_trade set userId='".$_SESSION['TTLOGINDATA']['USERID']."',bId='".$job_id."'";
	mysql_query($sql);
}*/
$user_IP = $_SERVER['REMOTE_ADDR']; 
mysql_query("insert into `tt_jobs_view` set fromip = '$user_IP', jobId='".$job_id."',
	`view_date` = NOW(), `view_time` = '" . time() . "'");
?>
<div class="main_quote_bar_b">
  <div id="job_particulars" style="width:auto;">
    <div class="brued_crum_bar brued_crum_bar_c">
      <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Home</a> >  <a href="<?php echo $ru;?>job_particulars" style="text-decoration:none; color:#999999;"><span class="change">Jobs Particulars</span> </a></span> </div>
    </div>
    <div class="profile_page_left">
		<?php if(isset($_SESSION['response_msg'])){ ?>
			<div class="msg"><?php echo $_SESSION['response_msg']; unset($_SESSION['response_msg']); ?></div>
		<?php } ?>
      <div class="listing_wrapper_left"> <span style="width:97%;"><?php echo stripslashes($quotes_row['keyword']);?> </span> </div>
      <div class="search-frm" style="width:643px;">
        <div class="job_particulars_top"> <span class="date_posted">Date Posted: <?php echo $quotes_row['posted_date'];?> </span>
          <h1><?php echo stripslashes($quotes_row['title']);?></h1>
        </div>
		<div style="margin:10px 0 0 0;">
		<?php 
		//echo $ru.'media/quotes/'.$quotes_row['quotes_id'].'/thumb/'.$quotes_row['file_attechmen']; exit;
		if(($quotes_row['file_attechmen']!='') and file_exists($rootpath.'media/quotes/'.$quotes_row['quotes_id'].'/thumb/'.$quotes_row['file_attechmen']) )
		{
		?>
		<img src="<?php echo $ru.'/media/quotes/'.$quotes_row['quotes_id'].'/thumb/'.$quotes_row['file_attechmen'];?>" width="130" height="114" />
		<?php }?>
		</div>
        <p class="description"><?php echo stripslashes($quotes_row['message']);?></p>
        <?php
		/*$qry_location = " SELECT * FROM `tt_zipcodes` WHERE city ='".$quotes_row['location']."' or  postcode ='".$quotes_row['location']."' ";
		$qry_location_exe = mysql_query($qry_location);
		if(mysql_num_rows($qry_location_exe)){
			$qry_location_res = mysql_fetch_array($qry_location_exe);
			$city = $qry_location_res['city'];
			$zip = $qry_location_res['postcode'];
			$lat = $qry_location_res['latitude'];
			$lon = $qry_location_res['longitude'];
		}  */
		?>
<script>
	function initialize(){
		<?php if($quotes_row['latitude'] != '' and $quotes_row['latitude'] != '0' and $quotes_row['longitude'] != '' and $quotes_row['longitude'] != '0'){ ?>
		var myLatlng = new google.maps.LatLng(<?php echo $quotes_row['latitude'];?>,<?php echo $quotes_row['longitude'];?>);
		<?php }else{ ?>
		var myLatlng = new google.maps.LatLng(-25.363882,131.044922);
		<?php 
		}
		?>
		var myOptions = {
		  zoom: 13,
		  center: myLatlng,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		var marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			title:"<?php echo $quotes_row['title'];?>",
			icon:'<?php echo $ru;?>images/marker/moscout-icon.png'
		});
	}
</script>
        <h2 class="company_detail_description_h2">Job location : <?php echo $quotes_row['location']; ?></h2>
        <div id="job_map">
          <div id="map_canvas" style=" width:600px; height:250px; float:left"> </div>
        </div>
        <div class="job_status">
          <?php
		if($quotes_row['status']=='Pending')
			$JobState = 'Pending';
		if($quotes_row['status']=='Open')
			$JobState = 'Open';
		if($quotes_row['status']=='Close')
			$JobState = 'Close';
		
		?>
          <strong>Job status:</strong> <span class="<?php echo $JobState;?>"><?php echo $quotes_row['status'];?></span></div>
        <!-- this div is used for the trader user and not login user-->
        <!--this div is used for the Responses (Max 5)-->
       
        <!--this div is used for the Other Companies which have registered their interest.-->
		<?php /*
        <div style="width:600px;">
          <div>
            <h3>Other Companies which have registered their interest. </h3>
          </div>
          <div> </div>
        </div>
		*/?>
       
		
		<?php if($_SESSION['TTLOGINDATA']['ISLOGIN'] == 'yes'){
			if($_SESSION['TTLOGINDATA']['TYPE'] == 't'){
				$distance = "";
				if(isset($quotes_row['latitude']) and !empty($quotes_row['latitude']) and $quotes_row['latitude'] != '0.000000' ){
					$lat = $quotes_row['latitude'];
					$lon = $quotes_row['longitude'];
					$distance = ", ((ACOS(SIN($lat * PI() / 180) * SIN(`latitude` * PI() / 180) + COS($lat * PI() / 180) * COS(`latitude` * PI() / 180) * COS(($lon - `longitude`) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS `distance` ";
				}
				$buss_qry = "SELECT * $distance
					FROM `tt_business` AS b WHERE `userId` = '" . $_SESSION['TTLOGINDATA']['USERID'] . "' ";

				$buss_res = mysql_query($buss_qry);
				$buss_row = mysql_fetch_array($buss_res);
		
		if(@!in_array($_SESSION['TTLOGINDATA']['USERID'],$applications_list))
		{
		?>
		<div style="padding:15px;border-top:1px solid #ccc;background-color:#F5F8F6;width:570px; font-family:Arial, Helvetica, sans-serif; margin:10px 0 0 0; float:left">
		 <br />
        <br />
		<form method="post" action="<?php echo $ru; ?>process/process_quotes.php">
		<div class="clforh3">
          <h3>Respond to this Quote Request</h3>
		  </div>
		  <?php if(false){ ?>
          <b style="color:#cc0000;">Your business is located too far away to officially respond to this quote request. The user specified that they only wanted quotes from companies within 10 miles of Sheffield.</b>
		  <br>
          <br>
		  <div class="clforh3"> 
          <h3>You can still win this job...</h3>
		  </div>
		  <?php 
		  }
		  
		 // echo "<pre>";
		 // print_r($applications_list);
		 // echo $_SESSION['TTLOGINDATA']['USERID'];
		  
		  
		  ?>
          <font style="float:left;"> You can register your interest in this lead and send the user a one off message below. This will be displayed to the user along with any other responses they receive. You will <u>not</u> have access to the user's contact details. </font>
		  <textarea wrap="soft" style="width:563px;height:70px;margin-right:5px;" name="comments" id="comments" onkeyup="return textCounter(400)"><?php echo $_SESSION['register_interest']['comments']; ?></textarea>
		  <div class="error" id="error_comments"></div><br />
		  <samp style="margin:0 0 0 130px; font-size:15px; font-family:'MyriadProCondensed';" id="colorr">
				Please enter a  minimum of 30 words and max <samp id="titleString" style="font-size:15px;font-family:'MyriadProCondensed';">400 </samp>  word    </samp><br />
		  
		  
         
		  
		  <?php 
			if(isset($_SESSION['register_interest_err']['comments'])){
			?>
			<div class="error" style="float:none;" ><?php echo $_SESSION['register_interest_err']['comments']; ?></div>
			<?php 
			}
			?>
		  
		  <ul class="bulets">
			<li>I agree that my response is in specific relation to the user's requirements.</li>
			<li>I agree to conduct all activities with the user in a professional manner.</li>
		  </ul>
			<input type="checkbox" <?php if(isset($_SESSION['register_interest']['quote_terms'])) echo 'checked="checked"';?> name="quote_terms" id="quote_terms"><label for="quote_terms">I have read and I fully agree to the terms and conditions above.</label>
			
			
			<?php 
			if(isset($_SESSION['register_interest_err']['quote_terms'])){
			?>
			<div class="error" style="float:none;"><?php echo $_SESSION['register_interest_err']['quote_terms']; ?></div>
			<?php 
			}
			?>
		
		
		<div class="search_bar_outer" style="float:none;"> 
			<input type="submit" style="float:none !important; margin:0 0 0 30%; width:34% !important; padding:2px;" class="search_btn" value="Register your Interest" name="register_interest">
		</div>
		
		<input type="hidden" name="jobId" value="<?php echo $quotes_row['quotes_id'] ?>" />
		<input type="hidden" name="jobtitle" value="<?php echo encodeURL($quotes_row['title']); ?>" />
		</form>
		</div>
		<?php 
		}
		
			}else{?>
			
			<?php
			}
		}else{ ?>
		<div class="clforh3"> 
			<h3>Respond to this Quote Request</h3>
          </div>
		 <div style="line-height:60px; font-size:20px; float:left;">
		  Please <a href="<?php echo $ru;?>signup" style="text-decoration:none; color:#999999;">register as a business</a> for FREE, or <a href="<?php echo $ru;?>signin/y" style="text-decoration:none; color:#999999;">login</a> to respond to this quote request.</div>
		  <?php
		  }
		   ?>
		 </div>
        <!-- this div is used for the trader user and not login user-->
        <div class="bottom_line" style="float:left; width:95%; margin:27px 0 11px;"></div>
      </div>
    </div>
 
 
  <?php //include("common/find-job-left.php"); ?>
</div>
<?php 
unset($_SESSION['user_con_err']);
unset($_SESSION['contact']);
?>
<script>
initialize();
</script>
<script>
//___________++++++++++++ this is used for the description 

$("#comments").focus(function(){
	$('#error_comments').hide();
});
$("#comments").blur(function(){
	$.ajax({
	  url: "<?php echo $ru;?>process/swear-words_comment.php?str="+$(this).val(),
	  context: document.body,
	  success: function(data){
	  	if(data == 'swear'){
			$('#error_comments').html('Swearing is not tolerated on TradesTools');
			$('#error_comments').show();
		}else if(data=='less'){
		$('#error_comments').html('Must Enter the 30 charecter');
			$('#error_comments').show();
		
		
		}
	  }
	});
});



/*function comment_Counter(field,cntfield,maxlimit) {
				if (field.value.length > maxlimit) // if too long...trim it!
				field.value = field.value.substring(0, maxlimit);
				// otherwise, update 'characters left' counter
				else
				cntfield.innerHTML = maxlimit - field.value.length;
				}

*/

function textCounter(maxlimit) {
				var k = document.getElementById('comments');
				actstr = k.value.replace('  ',' ');
				
				if (k.selectionStart) {
					cursorPos = k.selectionStart;
				} else if (!document.selection) {
					var cursorPos = 0;
				}
				var wcount = actstr.split(' ').length;
				//alert(wcount);
				if(wcount>30){
				//document.getElementById('colorr').css({"color":"red"}) ;
				//$("#colorr").css("background-color","yellow");
				$("#colorr").css("color","green")
				}
				if(wcount<30){
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