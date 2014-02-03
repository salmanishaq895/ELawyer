<?php 
include_once("../connect/connect.php");
$bId	=	$_GET['bId'];
$sql_review		=	"select * from tt_business where locationid='$bId'";
$rows	=	$db->get_row($sql_review,ARRAY_A);
$sql  = "select * from tt_enquiry where userId='".$_SESSION['TTLOGINDATA']['USERID']."' AND bId = '".$bId."' ";
$resultt	=	mysql_query($sql);
$row = mysql_num_rows($resultt);
if($row>0){
  echo '<div style=" background-color:#E1E1E1; font-size: 17px; padding: 68px 0 173px 0;">You Already Send The Enquiry For This Business!</div>';
}else{
?>
<link href="<?php echo $ru; ?>css/ratting.css" rel="stylesheet" type="text/css"  />
<!--<link href="<?php echo $ru; ?>css/style.css" rel="stylesheet" type="text/css"  />
-->
<style type="text/css" >
body{ background:url(../images/bgg.jpg) repeat-x #F5F5F5;;  margin:0px; padding:0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; }
.inner_top_gray_botton_bb{margin:7px 0; padding:1px 5px; /*background:url(../images/business_botton_bg.jpg);*/ background:none repeat scroll 0 0 #8EA800;  font-family:Arial, Helvetica, sans-serif; float:left; border:none; line-height:26px; behavior: url(../PIE.htc); -moz-border-radius:5px; -webkit-border-radius:5px;  position:relative; cursor:pointer; font-size:16px; color:#FFFFFF;  border: 1px solid #6C7F01;}
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

</script>
<!--<fieldset>
-->
<div style="margin:20px 0px 0px 37px">
  <form name="form1" id="form1" method="post" action="<?php echo $ru; ?>process/process_enquiry.php">
    <input id="rating" type="hidden" name="rating" value="5">
    <input id="bId" type="hidden" name="bId" value="<?php echo $rows['locationid'];?>">
    <input id="userId" type="hidden" name="userId" value="<?php echo $_SESSION['TTLOGINDATA']['USERID'];?>">
    <div >
      <h3 style="margin:5px 0;"> <span style="color:#7B0099; font-size:21px;">Enquiry</span></h3>
    </div>
    <div style="font-size:12px; font-weight:bold; width:100%; color:#666666; float:left;">Title:</div>
	<input type="text" name="title" id="title" value=""  /><br />
	<div class="error" id="error_title" ></div>
	
   <?php 
	if(isset($_SESSION['review_error']['title'])){
	?>
    <div style="color:#FF0000; margin:2px 0; font-size:11px;"><?php echo $_SESSION['review_error']['title'];?></div>
    <?php 
	unset($_SESSION['review_error']['title']);
	}
	?><br />
    <div > <span style="font-size:12px; font-weight:bold; color:#666666;"> Description: </span> </div>
    <textarea name="review" id="review" cols="40" rows="5" style="margin:5px 5px 0 0;"></textarea><br />
	<div class="error" id="error_review" ></div>
	<?php 
	if(isset($_SESSION['review_error']['review'])){
	?>
    <div style="color:#FF0000; margin:2px 0; font-size:11px;"><?php echo $_SESSION['review_error']['review'];?></div>
    <?php 
	unset($_SESSION['review_error']['review']);
	}
	?><br />
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
      <input type="submit" class="inner_top_gray_botton_bb" value="&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;" name="SaveEnquiry" id="SaveEnquiry"/>
    </div>
  </form>
</div>
<!--							</fieldset>
-->
<?php } ?>
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

//___________++++++++++++ this is used for the title 

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

