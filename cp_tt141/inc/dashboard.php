<?php
/*	$qrycounts = "SELECT sum(payment) FROM user WHERE status='Success Full' and `dated`= CURDATE() ";
	$total_Earningtoday		= $db->get_row($qrycounts, ARRAY_A);
	//print_r($rs_row	); echo $total_User['count(userId)']; 
	$qrycounts7 = "SELECT sum(payment) FROM user WHERE status='Success Full'";
	$total_Earning		= $db->get_row($qrycounts7, ARRAY_A);
	$qrycounts2 ="SELECT count(payment) FROM user WHERE status='Success Full'";
	$total_Successfulpayment = $db->get_row($qrycounts2, ARRAY_A);
	$qrycounts5 = "SELECT sum(payment) from user where `dated` >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) and status='Success Full'";
	$total_lastmonthpayment = $db->get_row($qrycounts5, ARRAY_A);
	$qrycounts6 = "SELECT sum(payment) from user where `dated` >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) and status='Success Full'";
	$total_lastsixmonthpayment = $db->get_row($qrycounts6, ARRAY_A);*/
	
	
	//$qrycounts1 = "SELECT count(userId) FROM tt_user WHERE type='u'";
	//$total_User		= $db->get_row($qrycounts1, ARRAY_A);
?>
<h3><a href="home.php">Welcome to  Admin Panel</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Dashboard</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
		<fieldset>
		<table cellpadding="0" cellspacing="0" border="0" >
		<tr>
		<td>
		<strong>Detail</strong>
		</td>
		<td>
		<strong>Active</strong>
		</td>
		<td>
		<strong>Pending</strong>
		</td>
		<td>
		<strong>Total</strong> 
		</td>
		</tr>
		
		<tr>
		<td> Advocate user</td>
		<td>
		<?php 
		$sql_cutomer_active   =	"select count(userId) from tt_user where status='Active' and type='c'";
		$sql_result_active_c  = $db->get_row($sql_cutomer_active, ARRAY_A);
		echo $sql_result_active_c['count(userId)'];?>
		</td>
		<td>
		<?php 
		$sql_cutomer_pending   =	"select count(userId) from tt_user where status='Pending' and type='c'";
		$sql_result_pending_d  = $db->get_row($sql_cutomer_pending, ARRAY_A);
		echo $sql_result_pending_d['count(userId)'];
		?>
		</td>
		<td>
		<?php 
		$sql_cutomer_total   =	"select count(userId) from tt_user where type='c'";
		$sql_result_total_c  = $db->get_row($sql_cutomer_total, ARRAY_A);
		echo $sql_result_total_c['count(userId)'];
		?>
		</td>
		</tr>
		
		
		</table>
		
      
		</fieldset>
	</div>
</div>