<?php 
//echo '<pre>';print_r($_REQUEST);
//echo '<pre>';print_r($_SESSION);exit;
if ( isset($_GET['bId']) and $_GET['bId'] != '')
{ 
	
	$bId = $_GET['bId'];
	$SQL_samebilling = "SELECT name,btype FROM tt_business WHERE locationid ='$bId'";
	$rs_samebilling		= $db->get_row($SQL_samebilling, ARRAY_A);
	
	if($rs_samebilling['btype'] == 'Broker'){ 
   			$business_qry = "SELECT  bondagent,bondphone FROM tt_business_broker where bId =$bId ";
	}elseif($rs_samebilling['btype']  == 'Carrier'){
		    $business_qry = "SELECT a.company,a.agent,a.phone,a.inslimit,a.deductible,b.trucks,b.route,b.description FROM tt_business_cargo_info as a INNER JOIN tt_business_equipment_info as b ON a.bId=b.bId where a.bId =$bId";
	}elseif($rs_samebilling['btype']  == 'Broker / Carrier' ){
			$business_qry = "SELECT c.bondagent,c.bondphone,a.company,a.agent,a.phone,a.inslimit,a.deductible,b.trucks,b.route,b.description FROM tt_business_cargo_info as a INNER JOIN tt_business_equipment_info as b ON a.bId=b.bId INNER JOIN tt_business_broker as c ON a.bId=c.bId where c.bId =$bId";
	 }
    //echo $business_qry; exit; 
	$business_rs = mysql_query($business_qry) or die (mysql_error());
	$buiness_row = mysql_fetch_array($business_rs);
//echo '<pre>'; print_r($buiness_row); exit;
	
	if ( !isset ($_SESSION['biz_reg3']) or ($_SESSION['biz_reg3']['bId'] != $bId ) )
	{
		$_SESSION['biz_reg3'] = $buiness_row;
	}
	//echo '<pre>'; print_r($_SESSION['biz_reg3']);exit;
}
?>               
<h3><a href="<?php echo $ruadmin; ?>home.php?p=business">Company</a> &raquo; <a href="#" class="active">Edit Company - <?php echo stripslashes($rs_samebilling['name']) ?></a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Edit Company &raquo; <a href="<?php echo $ruadmin; ?>home.php?p=business_edit&bId=<?php echo $bId; ?>">Step 1</a> &raquo; <a href="<?php echo $ruadmin; ?>home.php?p=business_edit_step2&bId=<?php echo $bId; ?>">Step 2</a> &raquo; Step 3 </h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
			<?php if ( isset ($_SESSION['biz_reg_err3']) ) {?>
					<div class="notification error png_bg">
						<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
						<div>
							<?php foreach ($_SESSION['biz_reg_err3'] as $ek=>$ev ) echo $ev ."<br />"; ?>
						</div>
					</div>	
			<?php } unset ($_SESSION['biz_reg_err3']);  ?>			
 
                <div id="mainbussines">
                
                	<form  method="post" action="process/process_business.php" enctype="multipart/form-data">
                    <input type="hidden" name="bId" id="bId" value="<?php echo $bId ?>">
                    	<fieldset>
							<?php if($rs_samebilling['btype'] == 'Broker'){ ?>
							<p><h3><font color="#A90000">Borker Bond Info</font></h3></p>					
                            <p><label>Surety Bond Agent:</label><input name="bondagent" id="bondagent" type="text" class="text-input medium-input" value="<?php echo stripslashes($_SESSION['biz_reg3']['bondagent']); ?>" /></p>
                           	<p><label>Bonding Co. Phone #</label><input name="bondphone" id="bondphone" type="text" class="text-input medium-input" value="<?php echo stripslashes($_SESSION['biz_reg3']['bondphone']); ?>" /></p>
                            
							<?php }elseif($rs_samebilling['btype'] == 'Carrier'){?> 
							<p><h3><font color="#A90000">Cargo Insurance Information:</font></h3></p>
							<p><label>Cargo Ins Co:</label><input name="company" id="company" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg3']['company']; ?>"  /></p>
							<p><label>Cargo Ins Agent</label><input name="agent" id="agent" type="text" class="text-input medium-input" value="<?php echo stripslashes($_SESSION['biz_reg3']['agent']); ?>" /></p>                            
                            <p><label>Phone: ( xxx ) xxx-xxxx</label><input name="phone" id="phone" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg3']['phone']; ?>" /></p>
                            <p><label>Insurance Limit:</label><input name="inslimit" id="inslimit"  maxlength="5" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg3']['inslimit']; ?>" /></p>
							<p><label>Ins. Deductible:</label><input name="deductible" id="deductible" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg3']['deductible']; ?>"  onchange="validatePhone(this)"/></p>
                            
							<p><h3><font color="#A90000">Equipment and Rout Information:</font></h3></p>
							<p><label>Number of Trucks:</label><input type="text" name="trucks" id="trucks" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg3']['trucks']; ?>" /></p>
                            <p><label>Preferred Routes:</label><input type="text" name="route" id="route" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg3']['route']; ?>" /></p>
							<p><label>Description:</label>
                               <textarea name="description" id="description"  rows="4" cols="72" type="text"  ><?php echo stripslashes($_SESSION['biz_reg3']['description']); ?></textarea>
                            </p>
							<?php } elseif($rs_samebilling['btype'] == 'Broker / Carrier' ){?>
							<p><h3><font color="#A90000">Borker Bond Info</font></h3></p>					
                            <p><label>Surety Bond Agent:</label><input name="bondagent" id="bondagent" type="text" class="text-input medium-input" value="<?php echo stripslashes($_SESSION['biz_reg3']['bondagent']); ?>" /></p>
                           	<p><label>Bonding Co. Phone #</label><input name="bondphone" id="bondphone" type="text" class="text-input medium-input" value="<?php echo stripslashes($_SESSION['biz_reg3']['bondphone']); ?>" /></p>
							
							<p><h3><font color="#A90000">Cargo Insurance Information:</font></h3></p>
							<p><label>Cargo Ins Co:</label><input name="company" id="company" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg3']['company']; ?>"  /></p>
							<p><label>Cargo Ins Agent</label><input name="agent" id="agent" type="text" class="text-input medium-input" value="<?php echo stripslashes($_SESSION['biz_reg3']['agent']); ?>" /></p>                            
                            <p><label>Phone: ( xxx ) xxx-xxxx</label><input name="phone" id="phone" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg3']['phone']; ?>" /></p>
                            <p><label>Insurance Limit:</label><input name="inslimit" id="inslimit"  maxlength="5" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg3']['inslimit']; ?>" /></p>
							<p><label>Ins. Deductible:</label><input name="deductible" id="deductible" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg3']['deductible']; ?>"  onchange="validatePhone(this)"/></p>
                            
							<p><h3><font color="#A90000">Equipment and Rout Information:</font></h3></p>
							<p><label>Number of Trucks:</label><input type="text" name="trucks" id="trucks" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg3']['trucks']; ?>" /></p>
                            <p><label>Preferred Routes:</label><input type="text" name="route" id="route" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg3']['route']; ?>" /></p>
							<p><label>Description:</label>
                               <textarea name="description" id="description"  rows="4" cols="72" type="text"  ><?php echo stripslashes($_SESSION['biz_reg3']['description']); ?></textarea>
                            </p>
							
							
							<?php } else {echo 'Please select company type in step 1'; }?>
                        	<p><input type="submit" class="button" value="&nbsp;&nbsp;&nbsp;Update&nbsp;&nbsp;&nbsp;" name="UpdateBusiness3" id="UpdateBusiness3" /></p>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>	
<?php unset($_SESSION['biz_reg3']);?>  