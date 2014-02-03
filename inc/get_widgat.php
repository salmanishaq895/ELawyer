<?php include("../connect/connect.php");

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript" src="<?php echo $ru;?>js/jscolor.js"> </script>
<style type="text/css" >
.dottedline {
    background-image: url("../images/dottedline.gif");
    background-position: center bottom;
    background-repeat: repeat-x;
    margin-bottom: 5px;
	font-size:16px;

}
h3.dottedline { float:left; font-size:14px; color:#333333; text-align:left; line-height:30px; width:860px; border: none; font-family:Arial, Helvetica, sans-serif}
h3.dottedline.preview{width:418px;}
</style>
</head>
<body>
<h3 class="dottedline">Review Widget Customisation Controls</h3>
<table cellspacing="0" cellpadding="2" border="0" style=" float: left;">
<form action="" method="post" name="reviewswidget">
<tbody>
<tr>
<td width="150" align="right" style="font-size:16px;">Width :</td>
<td style="font-size:16px;">
<input type="text" size="8" value="<?php echo $width; ?>" name="width">
&nbsp;&nbsp;The width of the reviews widget in Pixels.
</td>
</tr>
<tr>
<td align="right" style="font-size:16px;">Num. of Reviews :</td>
<td style="font-size:16px;">
<input type="text" size="8" value="<?php echo $num; ?>" name="num">
&nbsp;&nbsp;The number of reviews that will be displayed (Latest First)
</td>
</tr>
<tr>
<td align="right" style="font-size:16px;">Snippet Length :</td>
<td style="font-size:16px;">
<input type="text" size="8" value="<?php echo $snip; ?>" name="snip">
&nbsp;&nbsp;The amount of review which is displayed before the More Arrow Link is shown.
</td>
</tr>

<tr>
<td align="right" style="font-size:16px;">Border Width :</td>
<td style="font-size:16px;">
<input  type="text" size="8" value="<?php echo $bwidth; ?>" name="bwidth">
&nbsp;&nbsp;The width of the border
</td>
</tr>


<tr>
<td align="right" style="font-size:16px;">Border Colour : #</td>
<td style="font-size:16px;">
<input  class="color" type="text" size="8" value="<?php echo $bcolor; ?>" name="bcolor" autocomplete="off" style="background-color: rgb(102, 102, 102); color: rgb(255, 255, 255);" id="colorpickerField1">

&nbsp;&nbsp;The colour of the border
</td>
</tr>

<tr>
<td align="right" style="font-size:16px;"> Title Back Colour : #</td>
<td style="font-size:16px;">
<input  class="color" type="text" size="8" value="<?php echo $tcolor; ?>" name="tcolor" autocomplete="off" style="background-color: rgb(238, 238, 238); color: rgb(0, 0, 0);" id="colorpickerField2">
&nbsp;&nbsp;The background colour for the top and bottom title bars
</td>
</tr>

<tr>
<td align="right" style="font-size:16px;">Main Text Colour : #</td>
<td style="font-size:16px;">
<input class="color" type="text" size="8" value="<?php echo $mcolor; ?>" name="mcolor" autocomplete="off" style="background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);" id="colorpickerField3">
&nbsp;&nbsp;The colour of the title &amp; main review text
</td>
</tr>

<tr>
<td align="right" style="font-size:16px;">Additional Text Colour : #</td>
<td style="font-size:16px;">
<input class="color" type="text" size="8" value="<?php echo $acolor; ?>" name="acolor" autocomplete="off" style="background-color: rgb(0, 84, 188); color: rgb(255, 255, 255);" id="colorpickerField4">
&nbsp;&nbsp;The colour of Additional Text
</td>
</tr>
<tr>
<td align="right" style="font-size:16px;">Title :</td>
<td style="font-size:16px;">
<input type="text" size="35" value="<?php echo $title; ?>" name="title">
&nbsp;&nbsp;The title text displayed at the top
</td>
</tr>
<tr>
<td align="right">&nbsp;</td>
<td style="font-size:11px;">
<input type="submit" value="Update Preview / Code" name="go" onclick="SelectAll()">
</td>
</tr>
</tbody>
</form>
</table>
<br>
<br>

<table cellspacing="0" cellpadding="0" border="0" style="float: left;">
<tbody>
<tr>
<td valign="top" style="padding-right:15px;float: left; width:418px">
<h3 class="dottedline preview">The HTML Code :</h3>
<?php 
$widgetUrl = $ru."widget/reviews.php?bid=".$bId."&num=".$num."&width=".$width."&snip=".$snip."&bwidth=".$bwidth."&bcolor=".$bcolor."&tcolor=".$tcolor."&title=".$title."&mcolor=".$mcolor."&acolor=".$acolor;
?>
<textarea size="4" name="yourcode" id="yourcode" style="font-size:10px;width:415px;height:200px;font-family:arial;" onclick="SelectAll()"><script src= "<?php echo $widgetUrl;?>" type="text/javascript"></script><div style="text-align:center;width:400px;font-size:11px;font-family:arial;">View <a style="font-size:11px;font-family:arial;" href"<?php echo $ru;?>more_review/<?php echo $row_bId['locationid']."_".stripslashes(encodeURL($row_bId['name']));?>">all of our reviews</a> on the Tradestool <a style="font-family:arial;font-size:11px;" href="<?php echo $ru ; ?>profile/<?php echo $row_bId['locationid'].'_'. encodeURL(stripslashes($row_bId['name']))."/"; if($row_bId['industry']!=''){echo encodeURL(stripslashes($row_bId['industry']))."/";}    if($row_bId['city']!=''){ echo encodeURL(stripslashes($row_bId['city']))."/";} if($row_bId['state']!=''){echo encodeURL(stripslashes($row_bId['state']))."/";} echo $row_bId['zip'] ; ?>" target="_blank"><?php echo $row_bId['name'];?></a></div></textarea>
</td>
<td valign="top" style="float: left;">
<h3 class="dottedline preview">Preview :</h3>

<script src= "<?php echo $widgetUrl;?>" type="text/javascript"></script><div style="text-align:center;width:400px;font-size:11px;font-family:arial;">View <a style="font-size:11px;font-family:arial;" href"<?php echo $ru;?>/more_review/<?php echo $row_business['locationid'].'_'. encodeURL(stripslashes($row_business['name']));?>">all of our reviews</a> on the Tradestool <a style="font-family:arial;font-size:11px;" target="_blank"  href="<?php echo $ru ; ?>profile/<?php echo $row_bId['locationid'].'_'. encodeURL(stripslashes($row_bId['name']))."/"; if($row_bId['industry']!=''){echo encodeURL(stripslashes($row_bId['industry']))."/";}    if($row_bId['city']!=''){ echo encodeURL(stripslashes($row_bId['city']))."/";} if($row_bId['state']!=''){echo encodeURL(stripslashes($row_bId['state']))."/";} echo $row_bId['zip'] ; ?>"><?php echo $row_bId['name'];?></a></div>

</td>
</tr>
</tbody>
</table>






</body>
</html>
<script type="text/javascript">
function SelectAll()
{
    document.getElementById("yourcode").focus();
    document.getElementById("yourcode").select();
}

</script>
