<?php 
include_once("../connect/connect.php");

$bId	=	$_GET['bId'];
//echo $bId; exit;
$sql_review		=	"select * from tt_business where locationid='$bId' AND userId='".$_SESSION['TTLOGINDATA']['USERID']."'";
$rows	=	$db->get_row($sql_review,ARRAY_A);
if($rows>0){
  echo '<div style=" background-color:#E1E1E1; font-size: 17px; padding: 68px 0 173px 0;">You Are The owner of this trader!</div>';
exit;
}//else{
 $sql  = "select * from tt_business_reviews where userId='".$_SESSION['TTLOGINDATA']['USERID']."' AND bId = '".$bId."' ";
//exit;
$resultt	=	mysql_query($sql);
$row = mysql_num_rows($resultt);
if($row>0){
  echo '<div style=" background-color:#E1E1E1; font-size: 17px; padding: 68px 0 173px 0;">You Already First Gave The Review Ratting For This Business!</div>';
}else{
?>
<link href="<?php echo $ru; ?>css/ratting.css" rel="stylesheet" type="text/css"  />
<!--<link href="<?php echo $ru; ?>css/style.css" rel="stylesheet" type="text/css"  />
-->
<style type="text/css" >
body{ background:url(../images/bgg.jpg) repeat-x #F5F5F5;;  margin:0px; padding:0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; }
.inner_top_gray_botton_bb{margin:7px 0; padding:1px 5px; /*background:url(../images/business_botton_bg.jpg); font-family:'MyriadProSemibold';*/background:none repeat scroll 0 0 #8EA800;  font-family:Arial, Helvetica, sans-serif; float:left; border:none; line-height:26px; behavior: url(../PIE.htc); -moz-border-radius:5px; -webkit-border-radius:5px;  position:relative; cursor:pointer; font-size:16px; color:#FFFFFF;}
.input_flied{ float:left; margin:5px 0 0 0; width:150px; height:26px; border:1px solid #e1e1e1; padding:0px 5px; font-size:11px; behavior: url(PIE.htc); -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; position:relative; line-height:normal}
.error{color:#FF0000; float:left;}
</style>
<script language="javascript" type="text/javascript" src="<?php echo $ru?>js/jquery.js" ></script>
<script type="text/javascript">

function updateRetingImg()
 {
 var pos = document.getElementById('rating').value*16*-1;
 document.getElementById('starrating').style.backgroundPosition ='0px '+pos+'px';
 
 } 
function updateRetingImge()
 {
 var pose = document.getElementById('ratinge').value*16*-1;
 document.getElementById('starratinge').style.backgroundPosition ='0px '+pose+'px';
 
 } 
 
 function updateRetingImg2()
 {
 var pos2 = document.getElementById('rating2').value*16*-1;
 document.getElementById('starrating2').style.backgroundPosition ='0px '+pos2+'px';
 
 } 
 function updateRetingImg3()
 {
 var pos3 = document.getElementById('rating3').value*16*-1;
 document.getElementById('starrating3').style.backgroundPosition ='0px '+pos3+'px';
 
 } 
 function updateRetingImg4()
 {
 var pos4 = document.getElementById('rating4').value*16*-1;
 document.getElementById('starrating4').style.backgroundPosition ='0px '+pos4+'px';
 
 } 
 function updateRetingImg5()
 {
 var pos5 = document.getElementById('rating5').value*16*-1;
 document.getElementById('starrating5').style.backgroundPosition ='0px '+pos5+'px';
 
 } 


</script>
<!--<fieldset>
-->
<div style="margin:20px 0px 0px 37px; width:400px;">
  <form name="form1" id="form1" method="post" action="<?php echo $ru; ?>process/process_review.php">
    <input id="rating" type="hidden" name="rating" value="5">
	<input id="ratinge" type="hidden" name="ratinge" value="5">
	<input id="rating2" type="hidden" name="rating2" value="5">
	<input id="rating3" type="hidden" name="rating3" value="5">
	<input id="rating4" type="hidden" name="rating4" value="5">
	<input id="rating5" type="hidden" name="rating5" value="5">
    <input id="bId" type="hidden" name="bId" value="<?php echo $bId;?>">
    <input id="userId" type="hidden" name="userId" value="<?php echo $_SESSION['TTLOGINDATA']['USERID'];?>">
    <div >
      <h3 style="margin:5px 0;"> <span style="color:#7B0099; font-size:21px;">Write A Review</span></h3>
    </div>
    <div style="font-size:12px; font-weight:bold; width:100%; color:#666666; float:left;">Rate the Business:</div>
	
   <div style="margin:10px 0 0 0;">Quality </div> <div id="ratingbar" style="margin: -15px 10px 10px 0px; padding:0 0 0 90px; width:80%;">
      <ul id="starrating" onmouseout="updateRetingImg();" style="background-position: 0px <?php echo (5*16*-1); ?>px;">
        <li id="star1"> <a href="Javascript:void(0);" onclick="document.getElementById('rating').value ='1';" onmouseover="document.getElementById('starrating').style.backgroundPosition ='0px -16px';">star1</a> </li>
        <li id="star2"> <a href="Javascript:void(0);" onclick="document.getElementById('rating').value ='2';" onmouseover="document.getElementById('starrating').style.backgroundPosition ='0px -32px';">star2</a> </li>
        <li id="star3"> <a href="Javascript:void(0);" onclick="document.getElementById('rating').value ='3';" onmouseover="document.getElementById('starrating').style.backgroundPosition ='0px -48px';">star3</a> </li>
        <li id="star4"> <a href="Javascript:void(0);" onclick="document.getElementById('rating').value ='4';" onmouseover="document.getElementById('starrating').style.backgroundPosition ='0px -64px';">star4</a> </li>
        <li id="star5"> <a href="Javascript:void(0);" onclick="document.getElementById('rating').value ='5';" onmouseover="document.getElementById('starrating').style.backgroundPosition ='0px -80px';">star5</a> </li>
      </ul>
    </div>
	
	
	<div style="margin:10px 0 0 0;"> Expirtise</div>
	<div style="clear:both;"></div>
	<div id="ratingbare" style="margin: -15px 10px 10px 0px; padding:0 0 0 90px; width:80%;">
      <ul id="starratinge" onmouseout="updateRetingImge();" style="background-position: 0px <?php echo (5*16*-1); ?>px;">
        <li id="star1"> <a href="Javascript:void(0);" onclick="document.getElementById('ratinge').value ='1';" onmouseover="document.getElementById('starratinge').style.backgroundPosition ='0px -16px';">star1</a> </li>
        <li id="star2"> <a href="Javascript:void(0);" onclick="document.getElementById('ratinge').value ='2';" onmouseover="document.getElementById('starratinge').style.backgroundPosition ='0px -32px';">star2</a> </li>
        <li id="star3"> <a href="Javascript:void(0);" onclick="document.getElementById('ratinge').value ='3';" onmouseover="document.getElementById('starratinge').style.backgroundPosition ='0px -48px';">star3</a> </li>
        <li id="star4"> <a href="Javascript:void(0);" onclick="document.getElementById('ratinge').value ='4';" onmouseover="document.getElementById('starratinge').style.backgroundPosition ='0px -64px';">star4</a> </li>
        <li id="star5"> <a href="Javascript:void(0);" onclick="document.getElementById('ratinge').value ='5';" onmouseover="document.getElementById('starratinge').style.backgroundPosition ='0px -80px';">star5</a> </li>
      </ul>
    </div>
	
	
	<div style="margin:10px 0 0 0;"> Cost</div><div id="ratingbar2" style="margin: -15px 10px 10px 0px; padding:0 0 0 90px; width:80%;">
      <ul id="starrating2" onmouseout="updateRetingImg2();" style="background-position: 0px <?php echo (5*16*-1); ?>px;">
        <li id="star1"> <a href="Javascript:void(0);" onclick="document.getElementById('rating2').value ='1';" onmouseover="document.getElementById('starrating2').style.backgroundPosition ='0px -16px';">star1</a> </li>
        <li id="star2"> <a href="Javascript:void(0);" onclick="document.getElementById('rating2').value ='2';" onmouseover="document.getElementById('starrating2').style.backgroundPosition ='0px -32px';">star2</a> </li>
        <li id="star3"> <a href="Javascript:void(0);" onclick="document.getElementById('rating2').value ='3';" onmouseover="document.getElementById('starrating2').style.backgroundPosition ='0px -48px';">star3</a> </li>
        <li id="star4"> <a href="Javascript:void(0);" onclick="document.getElementById('rating2').value ='4';" onmouseover="document.getElementById('starrating2').style.backgroundPosition ='0px -64px';">star4</a> </li>
        <li id="star5"> <a href="Javascript:void(0);" onclick="document.getElementById('rating2').value ='5';" onmouseover="document.getElementById('starrating2').style.backgroundPosition ='0px -80px';">star5</a> </li>
      </ul>
    </div>
	
	
	<div style="margin:10px 0 0 0;">Schedule </div><div id="ratingbar3" style="margin: -15px 10px 10px 0px; padding:0 0 0 90px; width:80%;">
      <ul id="starrating3" onmouseout="updateRetingImg3();" style="background-position: 0px <?php echo (5*16*-1); ?>px;">
        <li id="star1"> <a href="Javascript:void(0);" onclick="document.getElementById('rating3').value ='1';" onmouseover="document.getElementById('starrating3').style.backgroundPosition ='0px -16px';">star1</a> </li>
        <li id="star2"> <a href="Javascript:void(0);" onclick="document.getElementById('rating3').value ='2';" onmouseover="document.getElementById('starrating3').style.backgroundPosition ='0px -32px';">star2</a> </li>
        <li id="star3"> <a href="Javascript:void(0);" onclick="document.getElementById('rating3').value ='3';" onmouseover="document.getElementById('starrating3').style.backgroundPosition ='0px -48px';">star3</a> </li>
        <li id="star4"> <a href="Javascript:void(0);" onclick="document.getElementById('rating3').value ='4';" onmouseover="document.getElementById('starrating3').style.backgroundPosition ='0px -64px';">star4</a> </li>
        <li id="star5"> <a href="Javascript:void(0);" onclick="document.getElementById('rating3').value ='5';" onmouseover="document.getElementById('starrating3').style.backgroundPosition ='0px -80px';">star5</a> </li>
      </ul>
    </div>
	
	
	<div style="margin:10px 0 0 0;">Response </div><div id="ratingbar4" style="margin: -15px 10px 10px 0px; padding:0 0 0 90px; width:80%;">
      <ul id="starrating4" onmouseout="updateRetingImg4();" style="background-position: 0px <?php echo (5*16*-1); ?>px;">
        <li id="star1"> <a href="Javascript:void(0);" onclick="document.getElementById('rating4').value ='1';" onmouseover="document.getElementById('starrating4').style.backgroundPosition ='0px -16px';">star1</a> </li>
        <li id="star2"> <a href="Javascript:void(0);" onclick="document.getElementById('rating4').value ='2';" onmouseover="document.getElementById('starrating4').style.backgroundPosition ='0px -32px';">star2</a> </li>
        <li id="star3"> <a href="Javascript:void(0);" onclick="document.getElementById('rating4').value ='3';" onmouseover="document.getElementById('starrating4').style.backgroundPosition ='0px -48px';">star3</a> </li>
        <li id="star4"> <a href="Javascript:void(0);" onclick="document.getElementById('rating4').value ='4';" onmouseover="document.getElementById('starrating4').style.backgroundPosition ='0px -64px';">star4</a> </li>
        <li id="star5"> <a href="Javascript:void(0);" onclick="document.getElementById('rating4').value ='5';" onmouseover="document.getElementById('starrating4').style.backgroundPosition ='0px -80px';">star5</a> </li>
      </ul>
    </div>
	
	
	<div style="margin:10px 0 0 0;"> Professional</div><div id="ratingbar5" style="margin: -15px 10px 10px 0px; padding:0 0 0 90px; width:80%;">
      <ul id="starrating5" onmouseout="updateRetingImg5();" style="background-position: 0px <?php echo (5*16*-1); ?>px;">
        <li id="star1"> <a href="Javascript:void(0);" onclick="document.getElementById('rating5').value ='1';" onmouseover="document.getElementById('starrating5').style.backgroundPosition ='0px -16px';">star1</a> </li>
        <li id="star2"> <a href="Javascript:void(0);" onclick="document.getElementById('rating5').value ='2';" onmouseover="document.getElementById('starrating5').style.backgroundPosition ='0px -32px';">star2</a> </li>
        <li id="star3"> <a href="Javascript:void(0);" onclick="document.getElementById('rating5').value ='3';" onmouseover="document.getElementById('starrating5').style.backgroundPosition ='0px -48px';">star3</a> </li>
        <li id="star4"> <a href="Javascript:void(0);" onclick="document.getElementById('rating5').value ='4';" onmouseover="document.getElementById('starrating5').style.backgroundPosition ='0px -64px';">star4</a> </li>
        <li id="star5"> <a href="Javascript:void(0);" onclick="document.getElementById('rating5').value ='5';" onmouseover="document.getElementById('starrating5').style.backgroundPosition ='0px -80px';">star5</a> </li>
      </ul>
    </div>
	
	
	
	
	
    <div > <span style="font-size:12px; font-weight:bold; color:#666666;"> Review: </span> </div>
    <textarea name="review" id="review" cols="40" rows="5" style="margin:5px 5px 0 0;"></textarea><br />
	<div class="error" id="error_review" ></div><br />
	<?php 
	if(isset($_SESSION['review_error']['review'])){
	?>
    <div style="color:#FF0000; margin:2px 0; font-size:11px;"><?php echo $_SESSION['review_error']['review'];?></div>
    <?php 
	unset($_SESSION['review_error']['review']);
	}
	?>
    <div>
      <p style="margin:5px 0; font-size:11px;">Please type the text shown below :</p>
      <div> <img src="<?php echo $ru;?>common/CaptchaSecurityImages.php?width=150&height=40&character=5" style="border: 1px dotted #808080" /> </div>
      <div style="width:100%;">
        <input name="pincode" type="text" class="input_flied" />
        <p style="margin:0 0 0 5px; line-height:37px; float:left; font-size:11px; font-family:Arial, Helvetica, sans-serif;">Case Sensitive</p>
        <?php if( isset($_SESSION['review_error']['pincode']) ) {?>
		<div style="clear:both;"></div>
		<div style="color:#FF0000; margin:0 0 2px 0; font-size:11px;"><?php echo $_SESSION['review_error']['pincode'];?></div>
        <?php } unset($_SESSION['review_error']['pincode']); ?>
      </div>
    </div>
	<div style="clear:both;"></div>
    <div >
      <input type="submit" class="inner_top_gray_botton_bb" value="&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;" name="SaveReview" id="SaveReview"/>
    </div>
  </form>
</div>
<!--							</fieldset>
-->
<?php }
//} ?>
<script>
//___________++++++++++++ this is used for the description 

$("#review").focus(function(){
	$('#error_review').hide();
});
$("#review").blur(function(){
	$.ajax({
	  url: "<?php echo $ru?>process/swear-words-desc_key.php?str="+$(this).val(),
	  context: document.body,
	  success: function(data){
	  	if(data == 'swear'){
			$('#error_review').html('Swearing is not tolerated on TradesTools');
			$('#error_review').show();
		}
	  }
	});
});





</script>
