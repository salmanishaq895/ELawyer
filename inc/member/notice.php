<?php if($_SESSION['biz_reg']['status'] == '0'){ 
$sql_keys = mysql_query("select * from `tt_business_keyservices` WHERE `userId` = '$userId' ");
?>
<ul class="notice">
	<?php //if(  $sql_keys) ?>
	<li>At least 1 key service is required</li>
	<li>At least 1 key skill is required</li>
</ul>
<?php 
}
?>