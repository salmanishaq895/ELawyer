<?php 
include_once("../connect/connect.php");
$bId	=	$_GET['bId'];
$sql_review		=	"select * from tt_business where locationid='$bId'";
$rows	=	$db->get_row($sql_review,ARRAY_A);
//$sql  = "select * from tt_invite_job where userId='".$_SESSION['TTLOGINDATA']['USERID']."' AND bId = '".$bId."' ";
//$resultt	=	mysql_query($sql);
//$row = mysql_num_rows($resultt);
//if($row>0){
  //echo '<div style=" background-color:#E1E1E1; font-size: 17px; padding: 68px 0 173px 0;">You Already Post The Job For This Business!</div>';
//}else{
?>
<link href="<?php echo $ru; ?>css/ratting.css" rel="stylesheet" type="text/css"  />
<!--<link href="<?php echo $ru; ?>css/style.css" rel="stylesheet" type="text/css"  />
-->
<style type="text/css" >
body{ background:url(../images/bgg.jpg) repeat-x #F5F5F5;;  margin:0px; padding:0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; }
.inner_top_gray_botton_bb{margin:7px 0; padding:1px 5px; /*background:url(../images/business_botton_bg.jpg);*/  background:none repeat scroll 0 0 #8EA800;  font-family:Arial, Helvetica, sans-serif; float:left; border:none; line-height:26px; behavior: url(../PIE.htc); -moz-border-radius:5px; -webkit-border-radius:5px;  position:relative; cursor:pointer; font-size:16px; color:#FFFFFF;}
.input_flied{ float:left; margin:5px 0 0 0; width:150px; height:26px; border:1px solid #e1e1e1; padding:0px 5px; font-size:11px; behavior: url(PIE.htc); -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; position:relative; line-height:normal}
</style>
<!--<fieldset>

-->

<body>
	<div class="pickjobforinvite">
	<h2>
Send an invitation to
<strong><?php echo $rows['name'];?></strong>
</h2>
	
<ul>
<li>
<p>For an existing job:</p>
 <form name="form1" id="form1" method="post" action="<?php echo $ru; ?>process/process_job.php">
 
    <input id="bId" type="hidden" name="bId" value="<?php echo $bId;?>">
    <input id="userId" type="hidden" name="userId" value="<?php echo $_SESSION['TTLOGINDATA']['USERID'];?>">

<ul class="radio_list">
<li>
<?php  
	$sql_job = "select * from tt_quotes where userId='".$_SESSION['TTLOGINDATA']['USERID']."'";
	$result_job  = mysql_query($sql_job);
	//echo $sql_job; exit;
	//$result_job  = $db->get_results($sql_job);
	//echo $result_job['title']; exit;
	//echo "<pre>".print_r($result_job); exit;
	//if(count($result_job)>0)
	//{
	//foreach($result_job as $rs)
	while($rs = mysql_fetch_array($result_job))
	{
	//echo $rs['title']; exit;
	?>

<input type="radio" name="title" id="<?php echo $rs['title'];?>" value="<?php echo $rs['quotes_id'];?>" checked="checked"/>
<label for="<?php echo $rs['title'];?>"><?php echo $rs['title'];?></label><br />
   <?php
   }
   //}
    ?>
</li>
</ul>
 <input type="submit" class="inner_top_gray_botton_bb" value="&nbsp;&nbsp;&nbsp;Send Request&nbsp;&nbsp;&nbsp;" name="SaveJob" id="SaveJob"/></form>
</li>
<li class="postjob">
<p>Post a new job:</p>
<p>If you would like a quote for a job you haven't posted yet ...</p>
<a class="inner_top_gray_botton_bb" href="<?php echo $ru;?>quotes" target="_blank" style="text-decoration:none;">Post a new Job</a>
</li>
</ul>

</div>
</body>
<!--							</fieldset>
-->
<?php // } ?>
