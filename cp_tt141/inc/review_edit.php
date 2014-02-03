<?php 
if ( isset($_GET['reviewId']) and $_GET['reviewId'] != '')
{ 

	
	$reviewId = $_GET['reviewId'];
  
  $Review_sql    = "SELECT `tt_business_reviews`.reviewId,`tt_business_reviews`.bId,`tt_business_reviews`.userId,`tt_business_reviews`.review,`tt_business_reviews`.rating,`tt_business_reviews`.expirtise,`tt_business_reviews`.cost,`tt_business_reviews`.schedule,`tt_business_reviews`.response,`tt_business_reviews`.professional,`tt_business_reviews`.date_added,`tt_user`.firstname,`tt_user`.lastname,`tt_business`.name,`tt_business`.locationid
										FROM 
								  `tt_business_reviews` 
								   LEFT JOIN `tt_user` ON (`tt_business_reviews`.userId = `tt_user`.userId)  
								   LEFT JOIN `tt_business` ON (`tt_business_reviews`.bId=`tt_business`.locationid)
								   where reviewId='$reviewId' ";
								   //`tt_business_reviews`.bId,`tt_business_reviews`.userId,
	
	//exit;
	$Review_rs = mysql_query($Review_sql) or die (mysql_error());
	if ( mysql_num_rows($Review_rs) ==0 ){
		
		header('location:'.$ruadmin.'home.php');
		exit;
	}
	
	//if ( !isset ($_SESSION['review_update']) or ($_SESSION['review_update']['reviewId'] != $reviewId ) )
	//{
		$Review_row = mysql_fetch_array($Review_rs);
		$_SESSION['review_update'] =$Review_row;
		
		
	//}
	
}
//echo $_SESSION['review_update']['userId'] ;
//echo $_SESSION['review_update']['firstname'].' '. $_SESSION['review_update']['lastname'];
?>
<script type="text/javascript">

/*function updateRetingImg()
 {
 var pos = document.getElementById('rating').value*15*-1;
 document.getElementById('starrating').style.backgroundPosition ='0px '+pos+'px';
 } 
*/





function updateRetingImg()
 {
 var pos = document.getElementById('rating').value*15*-1;
 document.getElementById('starrating').style.backgroundPosition ='0px '+pos+'px';
 
 } 
function updateRetingImge()
 {
 var pose = document.getElementById('ratinge').value*15*-1;
 document.getElementById('starratinge').style.backgroundPosition ='0px '+pose+'px';
 
 } 
 
 function updateRetingImg2()
 {
 var pos2 = document.getElementById('rating2').value*15*-1;
 document.getElementById('starrating2').style.backgroundPosition ='0px '+pos2+'px';
 
 } 
 function updateRetingImg3()
 {
 var pos3 = document.getElementById('rating3').value*15*-1;
 document.getElementById('starrating3').style.backgroundPosition ='0px '+pos3+'px';
 
 } 
 function updateRetingImg4()
 {
 var pos4 = document.getElementById('rating4').value*15*-1;
 document.getElementById('starrating4').style.backgroundPosition ='0px '+pos4+'px';
 
 } 
 function updateRetingImg5()
 {
 var pos5 = document.getElementById('rating5').value*15*-1;
 document.getElementById('starrating5').style.backgroundPosition ='0px '+pos5+'px';
 
 } 


</script>

	<h3><a href="<?php echo $ruadmin; ?>home.php?p=review_edit">Users</a> &raquo; <a href="#" class="active">Edit Review</a></h3> 
	<div class="content-box">
	<div class="content-box-header">
	
		<h3>Edit Review</h3> 

	
	
		<div class="clear"></div>
	</div>
	<div class="content-box-content">                    

			<?php if ( isset ($_SESSION['review_update_err']) ) {?>
					<div class="notification error png_bg">
						<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
						<div>
							<?php foreach ($_SESSION['review_update_err'] as $ek=>$ev ) echo $ev ."<br />"; ?>
						</div>
					</div>	
			<?php } unset ($_SESSION['review_update_err']);  ?>					
				
                <div id="main">
                
                	<form  method="post" action="process/process_review.php">
					
					
					
					
					 <input id="rating" type="hidden" name="rating" value="5">
	<input id="ratinge" type="hidden" name="ratinge" value="5">
	<input id="rating2" type="hidden" name="rating2" value="5">
	<input id="rating3" type="hidden" name="rating3" value="5">
	<input id="rating4" type="hidden" name="rating4" value="5">
	<input id="rating5" type="hidden" name="rating5" value="5">
   <!-- <input id="bId" type="hidden" name="bId" value="< ?php echo $bId;?>">
    <input id="userId" type="hidden" name="userId" value="< ?php echo $_SESSION['cp_tt']['userId'];?>">-->
					<input type="hidden" name="reviewId" id="reviewId" value="<?php echo $reviewId ?>"  /> 
					
					
					
                    
					 
                    	<fieldset>
							<p><strong>User Name:&nbsp;&nbsp; </strong><?php echo $_SESSION['review_update']['firstname'].' '. $_SESSION['review_update']['lastname']; ?>
							<input id="userId" type="hidden" name="userId" value="<?php echo $_SESSION['review_update']['userId'];?>">
							</p>
							
							<p><strong>Buniness:</strong><?php if($_SESSION['review_update']['name']!=''){ ?>
							 <a href="<?php echo $ruadmin; ?>home.php?p=viewbusiness&bId=<?php echo $_SESSION['review_update']['locationid'];?> ">
							<?php echo $_SESSION['review_update']['name']; ?>
							</a>
							<?php }else{ }?> 
							
							<input id="businessId" type="hidden" name="businessId" value="<?php echo $_SESSION['review_update']['bId'];?>">
							
							</p>
							
							
							
							
							
							
							<p><label>Quality:</label>  <div id="ratingbar" style="margin: -15px 10px 10px 0px; padding:0 0 0 90px; width:75%;">
      <ul id="starrating" onmouseout="updateRetingImg();" style="background-position: 0px <?php echo ($_SESSION['review_update']['rating']*15*-1); ?>px;">
        <li id="star1"> <a href="Javascript:void(0);" onclick="document.getElementById('rating').value ='1';" onmouseover="document.getElementById('starrating').style.backgroundPosition ='0px -15px';">star1</a> </li>
        <li id="star2"> <a href="Javascript:void(0);" onclick="document.getElementById('rating').value ='2';" onmouseover="document.getElementById('starrating').style.backgroundPosition ='0px -30px';">star2</a> </li>
        <li id="star3"> <a href="Javascript:void(0);" onclick="document.getElementById('rating').value ='3';" onmouseover="document.getElementById('starrating').style.backgroundPosition ='0px -45px';">star3</a> </li>
        <li id="star4"> <a href="Javascript:void(0);" onclick="document.getElementById('rating').value ='4';" onmouseover="document.getElementById('starrating').style.backgroundPosition ='0px -60px';">star4</a> </li>
        <li id="star5"> <a href="Javascript:void(0);" onclick="document.getElementById('rating').value ='5';" onmouseover="document.getElementById('starrating').style.backgroundPosition ='0px -75px';">star5</a> </li>
      </ul>
    </div>
	</p>
	
	<p><label> Expirtise:</label>
	
	<div id="ratingbare" style="margin: -15px 10px 10px 0px; padding:0 0 0 90px; width:75%;">
      <ul id="starratinge" onmouseout="updateRetingImge();" style="background-position: 0px <?php echo ($_SESSION['review_update']['expirtise']*15*-1); ?>px;">
        <li id="star1"> <a href="Javascript:void(0);" onclick="document.getElementById('ratinge').value ='1';" onmouseover="document.getElementById('starratinge').style.backgroundPosition ='0px -15px';">star1</a> </li>
        <li id="star2"> <a href="Javascript:void(0);" onclick="document.getElementById('ratinge').value ='2';" onmouseover="document.getElementById('starratinge').style.backgroundPosition ='0px -30px';">star2</a> </li>
        <li id="star3"> <a href="Javascript:void(0);" onclick="document.getElementById('ratinge').value ='3';" onmouseover="document.getElementById('starratinge').style.backgroundPosition ='0px -45px';">star3</a> </li>
        <li id="star4"> <a href="Javascript:void(0);" onclick="document.getElementById('ratinge').value ='4';" onmouseover="document.getElementById('starratinge').style.backgroundPosition ='0px -60px';">star4</a> </li>
        <li id="star5"> <a href="Javascript:void(0);" onclick="document.getElementById('ratinge').value ='5';" onmouseover="document.getElementById('starratinge').style.backgroundPosition ='0px -75px';">star5</a> </li>
      </ul>
    </div>
	</p>
	
	<p><label> Cost:</label>
	
	<div id="ratingbar2" style="margin: -15px 10px 10px 0px; padding:0 0 0 90px; width:75%;">
      <ul id="starrating2" onmouseout="updateRetingImg2();" style="background-position: 0px <?php echo ($_SESSION['review_update']['cost']*15*-1); ?>px;">
        <li id="star1"> <a href="Javascript:void(0);" onclick="document.getElementById('rating2').value ='1';" onmouseover="document.getElementById('starrating2').style.backgroundPosition ='0px -15px';">star1</a> </li>
        <li id="star2"> <a href="Javascript:void(0);" onclick="document.getElementById('rating2').value ='2';" onmouseover="document.getElementById('starrating2').style.backgroundPosition ='0px -30px';">star2</a> </li>
        <li id="star3"> <a href="Javascript:void(0);" onclick="document.getElementById('rating2').value ='3';" onmouseover="document.getElementById('starrating2').style.backgroundPosition ='0px -45px';">star3</a> </li>
        <li id="star4"> <a href="Javascript:void(0);" onclick="document.getElementById('rating2').value ='4';" onmouseover="document.getElementById('starrating2').style.backgroundPosition ='0px -60px';">star4</a> </li>
        <li id="star5"> <a href="Javascript:void(0);" onclick="document.getElementById('rating2').value ='5';" onmouseover="document.getElementById('starrating2').style.backgroundPosition ='0px -75px';">star5</a> </li>
      </ul>
    </div>
	</p>
	
	<p><label>Schedule :</label>
	
	<div id="ratingbar3" style="margin: -15px 10px 10px 0px; padding:0 0 0 90px; width:75%;">
      <ul id="starrating3" onmouseout="updateRetingImg3();" style="background-position: 0px <?php echo ($_SESSION['review_update']['schedule']*15*-1); ?>px;">
        <li id="star1"> <a href="Javascript:void(0);" onclick="document.getElementById('rating3').value ='1';" onmouseover="document.getElementById('starrating3').style.backgroundPosition ='0px -15px';">star1</a> </li>
        <li id="star2"> <a href="Javascript:void(0);" onclick="document.getElementById('rating3').value ='2';" onmouseover="document.getElementById('starrating3').style.backgroundPosition ='0px -30px';">star2</a> </li>
        <li id="star3"> <a href="Javascript:void(0);" onclick="document.getElementById('rating3').value ='3';" onmouseover="document.getElementById('starrating3').style.backgroundPosition ='0px -45px';">star3</a> </li>
        <li id="star4"> <a href="Javascript:void(0);" onclick="document.getElementById('rating3').value ='4';" onmouseover="document.getElementById('starrating3').style.backgroundPosition ='0px -60px';">star4</a> </li>
        <li id="star5"> <a href="Javascript:void(0);" onclick="document.getElementById('rating3').value ='5';" onmouseover="document.getElementById('starrating3').style.backgroundPosition ='0px -75px';">star5</a> </li>
      </ul>
    </div>
	</p>
	
	<p><label> Response :</label>
	
	<div id="ratingbar4" style="margin: -15px 10px 10px 0px; padding:0 0 0 90px; width:75%;">
      <ul id="starrating4" onmouseout="updateRetingImg4();" style="background-position: 0px <?php echo ($_SESSION['review_update']['response']*15*-1); ?>px;">
        <li id="star1"> <a href="Javascript:void(0);" onclick="document.getElementById('rating4').value ='1';" onmouseover="document.getElementById('starrating4').style.backgroundPosition ='0px -15px';">star1</a> </li>
        <li id="star2"> <a href="Javascript:void(0);" onclick="document.getElementById('rating4').value ='2';" onmouseover="document.getElementById('starrating4').style.backgroundPosition ='0px -30px';">star2</a> </li>
        <li id="star3"> <a href="Javascript:void(0);" onclick="document.getElementById('rating4').value ='3';" onmouseover="document.getElementById('starrating4').style.backgroundPosition ='0px -45px';">star3</a> </li>
        <li id="star4"> <a href="Javascript:void(0);" onclick="document.getElementById('rating4').value ='4';" onmouseover="document.getElementById('starrating4').style.backgroundPosition ='0px -60px';">star4</a> </li>
        <li id="star5"> <a href="Javascript:void(0);" onclick="document.getElementById('rating4').value ='5';" onmouseover="document.getElementById('starrating4').style.backgroundPosition ='0px -75px';">star5</a> </li>
      </ul>
    </div>
	</p>
	
	<p><label> Professional:</label>
	
	<div id="ratingbar5" style="margin: -15px 10px 10px 0px; padding:0 0 0 90px; width:75%;">
      <ul id="starrating5" onmouseout="updateRetingImg5();" style="background-position: 0px <?php echo ($_SESSION['review_update']['professional']*15*-1); ?>px;">
        <li id="star1"> <a href="Javascript:void(0);" onclick="document.getElementById('rating5').value ='1';" onmouseover="document.getElementById('starrating5').style.backgroundPosition ='0px -15px';">star1</a> </li>
        <li id="star2"> <a href="Javascript:void(0);" onclick="document.getElementById('rating5').value ='2';" onmouseover="document.getElementById('starrating5').style.backgroundPosition ='0px -30px';">star2</a> </li>
        <li id="star3"> <a href="Javascript:void(0);" onclick="document.getElementById('rating5').value ='3';" onmouseover="document.getElementById('starrating5').style.backgroundPosition ='0px -45px';">star3</a> </li>
        <li id="star4"> <a href="Javascript:void(0);" onclick="document.getElementById('rating5').value ='4';" onmouseover="document.getElementById('starrating5').style.backgroundPosition ='0px -60px';">star4</a> </li>
        <li id="star5"> <a href="Javascript:void(0);" onclick="document.getElementById('rating5').value ='5';" onmouseover="document.getElementById('starrating5').style.backgroundPosition ='0px -75px';">star5</a> </li>
      </ul>
    </div>
					
		</p>			

							
							
							
							
							
							
							
							<p><label>Review</label><?php 
		include("FCKeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor('review');
		$oFCKeditor->BasePath = "FCKeditor/";
		//$oFCKeditor->Config['SkinPath'] = $ru.$fckpath.'editor/skins/silver/';
		$oFCKeditor->Width		= '100%' ;
		$oFCKeditor->Height		= '250' ;
		$oFCKeditor->Value = $_SESSION['review_update']['review'];
		$oFCKeditor->Create();
		?></p>
		
							
							<p style="width:100%">
                            <input type="submit" class="button" value="&nbsp;&nbsp;&nbsp;Update&nbsp;&nbsp;&nbsp;" name="UpdateMember" id="UpdateMember2" />
                            </p>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>	     
