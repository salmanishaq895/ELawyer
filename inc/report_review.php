<?php 
include_once("../connect/connect.php");
$rId	=	$_GET['rId'];
 $sql_review		=	"select * from tt_business_reviews where reviewId='$rId'";
//exit;
$rows	=	$db->get_row($sql_review,ARRAY_A);
//$sql  = "select * from tt_review_error where reviewId='".$rId."'  ";
//$resultt	=	mysql_query($sql);
//$row = mysql_num_rows($resultt);
//if($row>0){
  //echo '<div style=" background-color:#E1E1E1; font-size: 16px; padding: 87px 0 227px 0;">You Already First Gave The Review Reporting For This Business!</div>';
//}else{*/
?>
	<style type="text/css" >
	body{ background:url(../images/bgg.jpg) repeat-x #F5F5F5;;  margin:0px; padding:0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; }
	.inner_top_gray_botton_bb{margin:7px 0; padding:1px 5px; background:url(../images/business_botton_bg.jpg); font-family:'MyriadProSemibold'; float:left; border:none; line-height:26px; behavior: url(../PIE.htc); -moz-border-radius:5px; -webkit-border-radius:5px;  position:relative; cursor:pointer; font-size:16px; color:#FFFFFF;}
	.input_flied{ float:left; margin:5px 0 0 0; width:150px; height:26px; border:1px solid #e1e1e1; padding:0px 5px; font-size:11px; behavior: url(PIE.htc); -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; position:relative; line-height:normal}
	</style>
	<div style="margin:20px 0px 0px 37px">
	  <form name="form1" id="form1" method="post" action="<?php echo $ru; ?>process/process_review.php?">
		
		<input id="rId" type="hidden" name="rId" value="<?php echo $rId;?>">
		<div >
      		<h3 style="margin:5px 0;"> <span style="color:#7B0099; font-size:21px;">Report this review</span></h3>
    	</div>
		<div> 
		<?php echo substr($rows['review'],0,100);?>
		</div>
		<div > <span style="font-size:12px; font-weight:bold; color:#666666;"> Reason: </span> </div>
		<textarea name="review" id="review" cols="40" rows="5" style="margin:5px 5px 0 0;"></textarea>
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
        <?php if ($_SESSION['review_error']['pincode'] ) {?>
		<div style="clear:both;"></div>
		<div style="color:#FF0000; margin:0 0 2px 0; font-size:11px;"><?php echo $_SESSION['review_error']['pincode'];?></div>
        <?php }  unset($_SESSION['review_error']['pincode']);?>
      </div>
    </div>
		<div style="clear:both;"></div>
		<div >
		  <input type="submit" class="inner_top_gray_botton_bb" value="&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;" name="SaveReport" id="SaveReport"/>
		</div>
	  </form>
	</div>
<?php //} ?>
