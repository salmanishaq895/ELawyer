<?php 
if(isset($_SESSION['TTLOGINDATA']['USERID']) and $_SESSION['TTLOGINDATA']['TYPE']=='t'){


//include("../connect/connect.php");

$userId = $_SESSION['TTLOGINDATA']['USERID'];

$qry_bId  =  "SELECT * FROM tt_business WHERE userId = ".$userId."";
$result_bId = mysql_query($qry_bId);
$row_bId  = mysql_fetch_array($result_bId);
$bId = $row_bId['locationid'];


$width = 400;
$num = 2;
$snip = 100;
$bwidth = 1;
$bcolor = '666666';
$tcolor  = "EEEEEE";
$mcolor = '000000';
$acolor = "0054BC";
$title = "Our reviews on Tradestool.co.uk";
if(isset($_POST['width'])) $width  = $_POST['width'];
if(isset($_POST['num'])) $num  = $_POST['num'];
if( isset($_POST['snip'])) $snip  = $_POST['snip'];
if(isset($_POST['bwidth'])) $bwidth = $_POST['bwidth'];
if(isset($_POST['bcolor'])) $bcolor  = $_POST['bcolor'];
if(isset($_POST['tcolor'])) $tcolor = $_POST['tcolor'];
if(isset($_POST['mcolor'])) $mcolor  = $_POST['mcolor'];
if(isset($_POST['acolor'])) $acolor = $_POST['acolor'];
if(isset($_POST['title'])) $title  = $_POST['title'];



$qry_user  = "SELECT * FROM tt_user WHERE userId = '$userId'";
$result_user  = mysql_query($qry_user);
$row_user  = mysql_fetch_array($result_user);

$name = $row_user['firstname']." ".$row_user['lastname'];
$date = strtotime($row_user['dated']);
//echo $date; exit;
$d  = date("d F Y",$date);




   



?>

<script language="javascript" type="text/javascript" >
	function load_gadget(){
		
			jQuery.facebox('<iframe FRAMEBORDER="0" height="600px" width="900px"   src="<?php echo $ru;?>inc/get_widgat.php" ></iframe>');
		
	}
	
	function load_Mini_Rating_1(){
	
			jQuery.facebox('<iframe FRAMEBORDER="0" height="281px" width="392px"   src="<?php echo $ru;?>inc/mini_rating_1.php?bid=<?php echo $row_bId['locationid'];?>" ></iframe>');
		}
		
		function load_Mini_Rating_2(){
	
			jQuery.facebox('<iframe FRAMEBORDER="0" height="281px" width="392px"   src="<?php echo $ru;?>inc/mini_rating_2.php?bid=<?php echo $row_bId['locationid'];?>" ></iframe>');
		}
		
		
		function load_Mini_Rating_3(){
	
			jQuery.facebox('<iframe FRAMEBORDER="0" height="281px" width="392px"   src="<?php echo $ru;?>inc/mini_rating_3.php?bid=<?php echo $row_bId['locationid'];?>" ></iframe>');
		}
	
	function load_Mini_Rating_4(){
	
			jQuery.facebox('<iframe FRAMEBORDER="0" height="281px" width="392px"   src="<?php echo $ru;?>inc/mini_rating_4.php?bid=<?php echo $row_bId['locationid'];?>" ></iframe>');
		}
		
		
		
		function load_madium_panel(){
	
			jQuery.facebox('<iframe FRAMEBORDER="0" height="281px" width="392px"   src="<?php echo $ru;?>inc/madium_panel.php?bid=<?php echo $row_bId['locationid'];?>" ></iframe>');
		}
	
	
	function load_large_panel(){
	
			jQuery.facebox('<iframe FRAMEBORDER="0" height="281px" width="392px"   src="<?php echo $ru;?>inc/large_panel.php?bid=<?php echo $row_bId['locationid'];?>" ></iframe>');
		}
		
		
			function load_latest_review_panel(){
	
			jQuery.facebox('<iframe FRAMEBORDER="0" height="281px" width="392px"   src="<?php echo $ru;?>inc/latest_review_panel.php?bid=<?php echo $row_bId['locationid'];?>" ></iframe>');
		}
		
	
	
</script>



<div class="main_quote_bar_b">
  <div id="job_particulars" style="width:990px;">
    <div class="brued_crum_bar brued_crum_bar_c">
      <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Home</a> >  <a href="<?php echo $ru;?>job_particulars" style="text-decoration:none; color:#999999;"><span class="change">Widgets</span> </a></span> </div>
    </div>
    <div class="profile_page_left">
		
		<div class="clforh3"> <h3 style="margin:10px 0 20px 34px; padding-bottom:16px; width:940px;">Tradestool Gadgets for your website</h3></div>
      
	  
      <div class="search-frm" style="width:913px; margin:0 0 4px 29px;">
       <p class="description"> 
		These gadgets allow you to get information out of Tradestool and display it on your / other website(s). The gadgets automatically update on your site as new information is added to Tradestool.
      
      <br>
<br>
</p>
<br>
<br>
<div class="dottedline" style="line-height:6px;">&nbsp;</div>
       
		<div class="tb"> 
			
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr> 
<td class="tableHead" width="300">Description</td>
<td class="tableHead">Demo</td>
<td class="tableHead" width="80">&nbsp;</td>
</tr>

<tr>
<td class="tableRow" height="50">
<b>Reviews Feed</b>
<br>
A fully customisable live feed of your reviews. Change the Width, colour, num reviews etc
<br>
<br>
Optionally, you can also control the text
<br>
styles with a
CSS StyleSheet

</td>



<td class="tableRow">
<?php 
$widgetUrl = $ru."widget/reviews.php?bid=".$bId."&num=".$num."&width=".$width."&snip=".$snip."&bwidth=".$bwidth."&bcolor=".$bcolor."&tcolor=".$tcolor."&title=".$title."&mcolor=".$mcolor."&acolor=".$acolor;
?>


<script src= "<?php echo $widgetUrl;?>" type="text/javascript"></script><div style="text-align:center;width:400px;font-size:11px;font-family:arial;">View <a style="font-size:11px;font-family:arial;" href"<?php echo $ru;?>/more_review/<?php echo $row_bId['locationid'].'_'. encodeURL(stripslashes($row_bId['name']));?>">all of our reviews</a> on the Tradestool <a style="font-family:arial;font-size:11px;"  href="<?php echo $ru ; ?>profile/<?php echo $row_bId['locationid'].'_'. encodeURL(stripslashes($row_bId['name']))."/"; if($row_bId['industry']!=''){echo encodeURL(stripslashes($row_bId['industry']))."/";}    if($row_bId['city']!=''){ echo encodeURL(stripslashes($row_bId['city']))."/";} if($row_bId['state']!=''){echo encodeURL(stripslashes($row_bId['state']))."/";} echo $row_bId['zip'] ; ?>" target="_blank"><?php echo $row_bId['name'];?></a></div>






</td>

<td class="tableRow">
<a href="javascript:;" onclick="load_gadget();">
Customise
<br>
&amp; Get Code<img src="<?php echo $ru;?>images/down.gif" style="float:left; margin: 0 0 34px 55px; ">
</a>

</td>

</tr>

<tr> 

<td class="tableRow" height="50">
<b>Mini Rating 1</b>
<br>
Your rating with cool drop down review viewer
<br>
<font style="color:#999;font-size:11px;">100px wide</font>
</td>
	
	
	<td class="tableRow">
	
	<a href="<?php echo $ru ; ?>profile/<?php echo $row_bId['locationid'].'_'. encodeURL(stripslashes($row_bId['name']))."/"; if($row_bId['industry']!=''){echo encodeURL(stripslashes($row_bId['industry']))."/";}    if($row_bId['city']!=''){ echo encodeURL(stripslashes($row_bId['city']))."/";} if($row_bId['state']!=''){echo encodeURL(stripslashes($row_bId['state']))."/";} echo $row_bId['zip'] ; ?>" target="_blank">
	
	<img src="<?php echo $ru;?>images/gad2011_txt1.gif" alt="<?php echo $row_bId['name'];?>" border="0" /></a> 
	
	<script src="<?php echo $ru ; ?>widget/ratting.php?bid=<?php echo $row_bId['locationid'];?>&type=4" type="text/javascript"></script>




</td>
<td class="tableRow"> 
<a class="u" onclick="load_Mini_Rating_1()" href="Javascript:;">Get Code<img src="<?php echo $ru;?>images/down.gif" style="float:left; margin: 0 0 34px 55px; "></a>
</td>

</tr>


<tr>
<td class="tableRow" height="50">
<b>Mini Rating 2</b>
<br>
Your rating with cool drop down review viewer
<br>
<font style="color:#999;font-size:11px;">150px wide</font>
</td>

<td class="tableRow">
<a target="_blank" href="<?php echo $ru ; ?>profile/<?php echo $row_bId['locationid'].'_'. encodeURL(stripslashes($row_bId['name']))."/"; if($row_bId['industry']!=''){echo encodeURL(stripslashes($row_bId['industry']))."/";}    if($row_bId['city']!=''){ echo encodeURL(stripslashes($row_bId['city']))."/";} if($row_bId['state']!=''){echo encodeURL(stripslashes($row_bId['state']))."/";} echo $row_bId['zip'] ; ?>"><img src="<?php echo $ru;?>images/gad2011_txt1.gif" alt="<?php echo $row_bId['name']; ?>" border="0"></a><script src="<?php echo $ru;?>/widget/ratting.php?bid=<?php echo $row_bId['locationid'];  ?>&type=5" type="text/javascript"></script></td>
<td class="tableRow">
<a class="u" onclick="load_Mini_Rating_2()" href="javascript:;">Get Code<img src="<?php echo $ru;?>images/down.gif" style="float:left; margin: 0 0 34px 55px; "></a>
</td>
</tr>




<tr> 
<td class="tableRow" height="50">
<b>Mini Rating 3</b>
<br>
Your rating with cool drop down review viewer
<br>
<font style="color:#999;font-size:11px;">200px wide</font>
</td>
<td class="tableRow">
<script src="<?php echo $ru;?>widget/ratting.php?bid=<?php echo $row_bId['locationid'];?>&type=6" type="text/javascript"></script></td>

<td class="tableRow">
<a class="u" onclick="load_Mini_Rating_3()" href="javascript:;">Get Code <img src="<?php echo $ru;?>images/down.gif" style="float:left; margin: 0 0 34px 55px; "></a>
</td>
</tr>

<?php /*
<tr> 
<td class="tableRow" height="50">
<b>Mini Rating 4</b>
<br>
Your rating with cool drop down review viewer
<br>
<font style="color:#999;font-size:11px;">250px wide</font>
</td>

<td class="tableRow">
<script src="<?php echo $ru;?>widget/ratting.php?bid=<?php echo $row_bId['locationid']; ?>&type=7" type="text/javascript"></script></td>

<td class="tableRow">
<a class="u" onclick="load_Mini_Rating_4()" href="javascript:;">Get Code <img src="<?php echo $ru;?>images/down.gif" style="float:left; margin: 0 0 34px 55px; "></a>
</td>


</tr>
*/ 
?>

<tr> 
<td class="tableRow" height="100">
<b>Medium Panel</b>
<br>
Shows your rating
<br>
<font style="color:#999;font-size:11px;">280px wide</font>
</td>

<td class="tableRow">


<script src="<?php echo $ru;?>widget/ratting.php?bid=<?php echo $row_bId['locationid'];;?>&type=2" type="text/javascript"></script><div style="text-align:center;width:280px;font-size:11px;font-family:arial;">View <a href="<?php echo $ru;?>more_review/<?php echo $row_bId['locationid']."_".encodeURL(stripslashes($row_bId['name']))."/";?>" target="_blank">our reviews</a> on this <a  href="<?php echo $ru ; ?>profile/<?php echo $row_bId['locationid'].'_'. encodeURL(stripslashes($row_bId['name']))."/"; if($row_bId['industry']!=''){echo encodeURL(stripslashes($row_bId['industry']))."/";}    if($row_bId['city']!=''){ echo encodeURL(stripslashes($row_bId['city']))."/";} if($row_bId['state']!=''){echo encodeURL(stripslashes($row_bId['state']))."/";} echo $row_bId['zip'] ; ?>" target="_blank"><?php echo $row_bId['name'];?></a></div>

</td>
<td class="tableRow">
<a class="u" onclick="load_madium_panel()" href="javascript:;">Get Code <img src="<?php echo $ru;?>images/down.gif" style="float:left; margin: 0 0 34px 55px; "></a>
</td>
</tr>

<tr> 
<td class="tableRow" height="120">
<b>Large Panel</b>
<br>
Larger Panel showing your full rating
<br>
<font style="color:#999;font-size:11px;">420px wide</font>
</td>

<td class="tableRow">
<script src="<?php echo $ru;?>/widget/ratting.php?bid=<?php echo $row_bId['locationid'];?>&type=3" type="text/javascript"></script><div style="text-align:center;width:420px;font-size:11px;font-family:arial;">View our <a href="<?php echo $ru;?>more_review/<?php echo $row_bId['locationid']."_".encodeURL(stripslashes($row_bId['name']))."/";?>" target="_blank">great reviews</a> on the <a  href="<?php echo $ru ; ?>profile/<?php echo $row_bId['locationid'].'_'. encodeURL(stripslashes($row_bId['name']))."/"; if($row_bId['industry']!=''){echo encodeURL(stripslashes($row_bId['industry']))."/";}    if($row_bId['city']!=''){ echo encodeURL(stripslashes($row_bId['city']))."/";} if($row_bId['state']!=''){echo encodeURL(stripslashes($row_row_bIdbuss['state']))."/";} echo $row_bId['zip'] ; ?>" target="_blank"><?php echo $row_bId['name'];?></a></div></td>

<td class="tableRow">
<a class="u" onclick="load_large_panel()" href="javascript:;">Get Code <img src="<?php echo $ru;?>images/down.gif" style="float:left; margin: 0 0 34px 55px; "></a>
</td>


</tr>


<tr> 
<td class="tableRow" height="170">
<b>Latest Review Panel</b>
<br>
Shows your Latest Review and a summary
<br>
<font style="color:#999;font-size:11px;">150px wide</font>
</td>

<td class="tableRow">
<script src="<?php echo $ru;?>/widget/ratting.php?bid=<?php echo $row_bId['locationid'];?>&type=8" type="text/javascript"></script></td>

<td class="tableRow">
<a class="u" onclick="load_latest_review_panel()" href="javascript:;">Get Code <img src="<?php echo $ru;?>images/down.gif" style="float:left; margin: 0 0 34px 55px; "></a>
</td>


</tr>




</table>

</div>

		
		
		 </div>
        <!-- this div is used for the trader user and not login user-->
        <div class="bottom_line" style="float:left; width:95%; margin:27px 0 11px;"></div>
      </div>
    </div>
 
 
 
</div>
<?php }else{
header("location:home");

}?>