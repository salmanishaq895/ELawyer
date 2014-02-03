<?php 
	if( isset ( $_POST['Submit'] ))
	{	
	//print_r($_POST);exit;
/*		$s_nationally 		= 	trim($_POST['s_nationally']);
		$s_states1 			= 	trim($_POST['s_states1']);
		$s_states2 			= 	trim($_POST['s_states2']);
		$s_states3 			= 	trim($_POST['s_states3']);
		$s_states4 			= 	trim($_POST['s_states4']);
		$s_international 	= 	trim($_POST['s_international']);
		$s_special 			= 	trim($_POST['s_special']);

		$a_nationally 		= 	trim($_POST['a_nationally']);
		$a_states1 			= 	trim($_POST['a_states1']);
		$a_states2 			= 	trim($_POST['a_states2']);
		$a_states3 			= 	trim($_POST['a_states3']);
		$a_states4 			= 	trim($_POST['a_states4']);
		$a_international 	= 	trim($_POST['a_international']);
		$a_special 			= 	trim($_POST['a_special']);*/
	unset($_SESSION['user_reg']);
	
	foreach ($_POST as $k => $v ){
		$$k =  addslashes(trim($v ));
		$_SESSION['user_setting'][$k]=$v;
	}
		//echo '<pre>'; print_r($_SESSION['upgrade_reg']); exit;
	
			$sql= "update tt_settings set  s_nationally	 	='".$s_nationally."', 
										s_states1			='".$s_states1."',
										s_states2			='".$s_states2."', 
										s_states3			='".$s_states3."', 
										s_states4			='".$s_states4."',
										s_international		='".$s_international."',
										s_special			='".$s_special."', 
										
										a_nationally	 	='".$a_nationally."', 
										a_states1			='".$a_states1."',
										a_states2			='".$a_states2."', 
										a_states3			='".$a_states3."', 
										a_states4			='".$a_states4."',
										a_international		='".$a_international."',
										a_special			='".$a_special."',
										
										annually_s_nationally	 	='".$annually_s_nationally."', 
										annually_s_states1			='".$annually_s_states1."',
										annually_s_states2			='".$annually_s_states2."', 
										annually_s_states3			='".$annually_s_states3."', 
										annually_s_states4			='".$annually_s_states4."',
										annually_s_international		='".$annually_s_international."',
										annually_s_special			='".$annually_s_special."', 
										
										annually_a_nationally	 	='".$annually_a_nationally."', 
										annually_a_states1			='".$annually_a_states1."',
										annually_a_states2			='".$annually_a_states2."', 
										annually_a_states3			='".$annually_a_states3."', 
										annually_a_states4			='".$annually_a_states4."',
										annually_a_international		='".$annually_a_international."',
										annually_a_special			='".$annually_a_special."',
										
										time_monthly				='".$time_monthly."', 
										duration_monthly			='".$duration_monthly."' ";
			$db->query($sql);
			if($db->query($sql))
			{
				$_SESSION['statuss'] = "Package setting updated successfuly "; 
				header('location:'.$ruadmin.'home.php?p=manage_package');
				exit;
			}

	}
	$qry_config="SELECT * FROM tt_settings";
	$rs_config = mysql_query($qry_config) or die ( mysql_error());
	$row_config = mysql_fetch_array($rs_config);
     $_SESSION['setting'] = $row_config ;

?>
<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Package Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Package Settings</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
	<?php if ( isset ($_SESSION['statuss']) ) {?>
		<div class="notification error png_bg">
			<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
			<div>
				<?php echo  $_SESSION['statuss']; unset($_SESSION['statuss']); ?>
			</div>
		</div>	
	<?php } ?>	
	<form action="<?php echo $ruadmin; ?>home.php?p=manage_package" method="post">
		<table width="100%" cellpadding="0" cellspacing="0">
		  <tr>
			<td width="5%" rowspan="2"><strong>Sr</strong></td>
			<td width="35%" rowspan="2"><strong>Package Description</strong></td>
			<td width="15%" colspan="2" style="text-align:center"><strong>Standard Listing</strong></td>
			<td width="15%" colspan="2" style="text-align:center"><strong>Allied Listing</strong></td>
		  </tr>
		 <tr >
			<td width="15%"  ><strong>Monthly </strong></td>
			<td width="15%" ><strong>Annually </strong></td>
			<td width="15%" ><strong>Monthly </strong></td>
			<td width="15%" ><strong>Annually </strong></td>
		  </tr>
		  <tr>
			<td width="5%" ><strong></strong></td>
			<td width="35%"><strong></strong></td>
			<td width="15%"><strong></strong></td>
			<td width="15%"><strong></strong></td>
			<td width="15%"><strong></strong></td>
			<td width="15%"><strong></strong></td>
		  </tr>
		  <tr>
		    <td>1</td>
			<td>Nationally - NA</td>
			<td> <strong> $</strong><input type="text" name="s_nationally" id="s_nationally" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['s_nationally'] ?>" class="text-input" /></td>
			<td> <strong> $</strong><input type="text" name="annually_s_nationally" id="annually_s_nationally" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['annually_s_nationally'] ?>" class="text-input" /></td>
			<td> <strong> $</strong><input type="text" name="a_nationally" id="a_nationally" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['a_nationally'] ?>" class="text-input" /></td>
			<td> <strong> $</strong><input type="text" name="annually_a_nationally" id="annually_a_nationally" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['annually_a_nationally'] ?>" class="text-input" /></td>
		  </tr>
		  <tr>
		    <td>2</td>
			<td>States 1 - S1 ( CA, NY, FL, TX ) </td>
			<td> <strong> $</strong><input type="text" name="s_states1" id="s_states1" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['s_states1'] ?>" class="text-input" /></td>
			<td> <strong> $</strong><input type="text" name="annually_s_states1" id="annually_s_states1" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['annually_s_states1'] ?>" class="text-input" /></td>
			<td> <strong> $</strong><input type="text" name="a_states1" id="a_states1" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['a_states1'] ?>" class="text-input" /></td>
			<td> <strong> $</strong><input type="text" name="annually_a_states1" id="annually_a_states1" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['annually_a_states1'] ?>" class="text-input" /></td>
		  </tr>
		  <tr>
		    <td>3</td>
			<td>States 2 - S2 ( IL, WA, PA, VA, GA, NC, MA, OH ) </td>
			<td> <strong> $</strong><input type="text" name="s_states2" id="s_states2" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['s_states2'] ?>" class="text-input" /></td>
			<td> <strong> $</strong><input type="text" name="annually_s_states2" id="annually_s_states2" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['annually_s_states2'] ?>" class="text-input" /></td>
			<td> <strong> $</strong><input type="text" name="a_states2" id="a_states2" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['a_states2'] ?>" class="text-input" /></td>
			<td> <strong> $</strong><input type="text" name="annually_a_states2" id="annually_a_states2" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['annually_a_states2'] ?>" class="text-input" /></td>
		  </tr>
		  <tr>
		     <td>4</td>
			<td>States 3 - S3 ( OR, NJ, AZ, MI, CO, MD, MN, TN, IN, CT, WI, MO, LA ) </td>
			<td> <strong> $</strong><input type="text" name="s_states3" id="s_states3" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['s_states3'] ?>" class="text-input" /></td>
			<td> <strong> $</strong><input type="text" name="annually_s_states3" id="annually_s_states3" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['annually_s_states3'] ?>" class="text-input" /></td>
			<td> <strong> $</strong><input type="text" name="a_states3" id="a_states3" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['a_states3'] ?>" class="text-input" /></td>
			<td> <strong> $</strong><input type="text" name="annually_a_states3" id="annually_a_states3" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['annually_a_states3'] ?>" class="text-input" /></td>
		  </tr>
		  <tr>
		     <td>5</td>
			<td>States 4 - S4 ( SC, NV, AL, UT, DC, KY, KS, OK, IA, NM, HI, RI, MS, AR,NE, NH, ID, ME, WV, MT, AK, DE, VT, SD, ND, WY )</td>
			<td> <strong> $</strong><input type="text" name="s_states4" id="s_states4" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['s_states4'] ?>" class="text-input" /></td>
			<td> <strong> $</strong><input type="text" name="annually_s_states4" id="annually_s_states4" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['annually_s_states4'] ?>" class="text-input" /></td>
			<td> <strong> $</strong><input type="text" name="a_states4" id="a_states4" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['a_states4'] ?>" class="text-input" /></td>
			<td> <strong> $</strong><input type="text" name="annually_a_states4" id="annually_a_states4" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['annually_a_states4'] ?>" class="text-input" /></td>
		  </tr>
		  <tr>
		     <td>6</td>
			<td>International - ( IN )</td>
			<td> <strong> $</strong><input type="text" name="s_international" id="s_international" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['s_international'] ?>" class="text-input" /></td>
			<td> <strong> $</strong><input type="text" name="annually_s_international" id="annually_s_international" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['annually_s_international'] ?>" class="text-input" /></td>
			<td> <strong> $</strong><input type="text" name="a_international" id="a_international" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['a_international'] ?>" class="text-input" /></td>
			<td> <strong> $</strong><input type="text" name="annually_a_international" id="annually_a_international" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['annually_a_international'] ?>" class="text-input" /></td>
		  </tr>
		  <tr>
		     <td>7</td>
			<td>Specialized vehicles - SV</td>
			<td> <strong> $</strong><input type="text" name="s_special" id="s_special" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['s_special'] ?>" class="text-input" /></td>
			<td> <strong> $</strong><input type="text" name="annually_s_special" id="annually_s_special" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['annually_s_special'] ?>" class="text-input" /></td>
			<td> <strong> $</strong><input type="text" name="a_special" id="a_special" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['a_special'] ?>" class="text-input" /></td>
			<td> <strong> $</strong><input type="text" name="annually_a_special" id="annually_a_special" size="10" maxlength="7"   value="<?php echo $_SESSION['setting']['annually_a_special'] ?>" class="text-input" /></td>
		  </tr>
		</table>
		<fieldset >	
          <p><label>Free Promotion Time: (In Days)</label>
		 <input name="time_monthly" id="time_monthly" type="text" class="text-input" value="<?php echo $_SESSION['setting']['time_monthly']; ?>" />
<!--		Allied <input name="time_annually" id="time_annually" type="text" class="text-input" value="<?php echo $_SESSION['setting']['time_annually']; ?>" />-->
		</p>
		<p><label>Valid Recursion For: (In Months) Note:This should be less than 10 </label>
		 <input name="duration_monthly" id="duration_monthly" type="text" class="text-input" value="<?php echo $_SESSION['setting']['duration_monthly']; ?>" />
<!--		Allied <input name="duration_annually" id="duration_annually" type="text" class="text-input" value="<?php echo $_SESSION['setting']['duration_annually']; ?>" />-->
		</p>
		<p> <input type="submit" class="button" name="Submit" value="Update Signup Fee" /></p>
		</fieldset>
	</form>
	</div>
</div>	