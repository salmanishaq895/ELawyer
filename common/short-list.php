<?php 
$flg = false;
$flg2 = false;
$flgshowdiv = true;
if($_GET['ajax'] == 'yes'){
	include("../connect/connect.php");
}
if($_SESSION['TTLOGINDATA']['ISLOGIN'] == 'yes'){
	if($_SESSION['TTLOGINDATA']['TYPE'] == 'c'){
		$userId = $_SESSION['TTLOGINDATA']['USERID'];
		$where = " `userId` = '".$userId."' ";
		$table = ' `tt_shortlist` ';
	}else{
		$flg2 = true;
	}
}else{
	$user_IP = $_SERVER['REMOTE_ADDR'];
	$where = " `ip` = '".$user_IP."' ";
	$table = ' `tt_shortlist_temp` ';
	$flg = true;
}

if($_GET['ajax'] == 'yes'){
	if($flg2){
		echo "not";exit;
	}
	$sql_count = "SELECT COUNT(shortlist_id) AS id FROM $table WHERE $where ";
	$result_count = mysql_query($sql_count);
	$row_count  = mysql_fetch_array($result_count);
	if($row_count[0]>10 and $_GET['action'] =='add'){
		echo "greater"; exit;
	}
	if($_GET['action'] =='del'){
		mysql_query("DELETE FROM $table WHERE $where and `bId` = '".$_GET['bId']."'" ); 
	}else{
		mysql_query("INSERT INTO $table SET `bId` = '".$_GET['bId']."', $where, `date_added` = NOW() " );
	}
	?>
	<span class="short_text_span" style="border-bottom:none;">Your Shortlist<?php /*<span class="edit ">edit</span>*/?></span>
	<?php 
}?>
<div class="short-list-outer-div">
<?php
$res_shortlist = mysql_query("SELECT * FROM $table WHERE $where ");
if($_SESSION['TTLOGINDATA']['TYPE'] == 'c' or $flg){
	while($row_shortlist = mysql_fetch_array($res_shortlist)){ 
		$res_bus_detail = mysql_query("SELECT locationid,name,description FROM `tt_business` WHERE `locationid` = '".$row_shortlist['bId']."'");
		
		$row_bus_detail = mysql_fetch_array($res_bus_detail);
		//echo "<pre>".print_r($row_bus_detail); exit;
		$flgshowdiv = false;
		?>
		<div class="short_text_flied_bar short_text_listing_flied_bar_b">
			<a href="<?php echo $ru; ?>profile/<?php echo $row_bus_detail['locationid'].'_'. encodeURL(stripslashes($row_bus_detail['name'])) ; ?>" style="text-decoration:none; color:#848484;">
				<img src="<?php echo $ru; ?>images/short_listing_icon.png"  />
				<span class="short_text_span2"><?php echo substr(stripslashes($row_bus_detail['name']),0,20); ?></span>
				<span class="short_text_flied_span short_text_span2" ><?php echo substr(stripslashes($row_bus_detail['description']),0,40); ?></span>
			</a>
			<a href="javascript:;" onclick="return bus_add_del('<?php echo $row_bus_detail['locationid'];?>');" style="text-decoration:none;"><img src="<?php echo $ru; ?>images/dlt.gif" style="float: right;"/></a>
		</div>
	<?php 
	} 
}
if($flgshowdiv){
?>
<div class="short_text_flied_bar short_text_listing_flied_bar_b">
	<img src="<?php echo $ru; ?>images/short_listing_icon.png"  />
	<span class="short_text_flied_span" style="font-weight:normal !important; font-size:12px !important; line-height:14px !important; margin:0 0 0 10px !important;">To add traders to your shortlist, simply click at "Add To Shortlist".</span>
</div>
<?php 
}
?>
</div>