<?php
include("../connect/connect.php");
$bid = $_GET['bid'];

$res_buss = mysql_query("SELECT * FROM `tt_business` WHERE `locationid` = '$bid'"); 

$row_buss = mysql_fetch_array($res_buss);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css" >
body{ background:url(../images/bgg.jpg) repeat-x #F5F5F5;;  margin:0px; padding:0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; }
.inner_top_gray_botton_bb{margin:7px 0; padding:1px 5px; /*background:url(../images/business_botton_bg.jpg);*/ background:none repeat scroll 0 0 #8EA800;  font-family:Arial, Helvetica, sans-serif; float:left; border:none; line-height:26px; behavior: url(../PIE.htc); -moz-border-radius:5px; -webkit-border-radius:5px;  position:relative; cursor:pointer; font-size:16px; color:#FFFFFF;  border: 1px solid #6C7F01;}
.input_flied{ float:left; margin:5px 0 0 0; width:150px; height:26px; border:1px solid #e1e1e1; padding:0px 5px; font-size:11px; behavior: url(PIE.htc); -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; position:relative; line-height:normal}
.error{color:#FF0000; float:left;}
.dottedline {
    background-image: url("../images/dottedline.gif");
    background-position: center bottom;
    background-repeat: repeat-x;
    margin-bottom: 5px;
	font-size:16px;
	}

</style>

</head>

<body>
<h3 class="dottedline">Add the Following HTML code to your site</h3>
Copy all of the following HTML Code and paste it carefully into your website source code. You may need to ask your web designer to give you a hand if you're not familiar with HTML.
<br>
<br>
<textarea style="font-size:12px;font-family:arial;width:333px;" rows="10" ><script src="<?php echo $ru;?>widget/ratting.php?bid=<?php echo $row_buss['locationid'];;?>&type=2" type="text/javascript"></script><div style="text-align:center;width:280px;font-size:11px;font-family:arial;">View <a href="<?php echo $ru;?>more_review/<?php echo $row_buss['locationid']."_".encodeURL(stripslashes($row_buss['name']))."/";?>" target="_blank">our reviews</a> on this <a  href="<?php echo $ru ; ?>profile/<?php echo $row_buss['locationid'].'_'. encodeURL(stripslashes($row_buss['name']))."/"; if($row_buss['industry']!=''){echo encodeURL(stripslashes($row_buss['industry']))."/";}    if($row_buss['city']!=''){ echo encodeURL(stripslashes($row_buss['city']))."/";} if($row_buss['state']!=''){echo encodeURL(stripslashes($row_buss['state']))."/";} echo $row_buss['zip'] ; ?>" target="_blank"><?php echo $row_buss['name'];?></a></div></textarea>


</body>
</html>
