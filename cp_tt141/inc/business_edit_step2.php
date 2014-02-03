<script type="text/javascript" src="<?php echo $ru; ?>datepicker/date.js"></script>
<script type="text/javascript" src="<?php echo $ru; ?>datepicker/jquery_002.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $ru; ?>datepicker/datePicker.css" />             
<script type="text/javascript" charset="utf-8">
Date.format = 'yyyy-mm-dd';
Date.startDate = '1996-01-01';
$(function()
{
	$('#yearestablished').datePicker({clickInput:true})

});
</script>
<?php // echo '<pre>';print_r($_REQUEST); exit;
      //echo '<pre>';print_r($_SESSION);
	  
if ( isset($_GET['bId']) and $_GET['bId'] != '')
{ 
	
	$bId = $_GET['bId'];
	//$business_qry = "SELECT  * FROM tt_business_billing_info where bId =$bId";
	$business_qry = "SELECT a.contact,a.phone,a.state,a.city,a.zip,a.address,b.yearestablished,b.iccmc,b.description FROM tt_business_billing_info as a INNER JOIN tt_business_additional_info as b ON a.bId=b.bId where a.bId =$bId";
	$business_rs = mysql_query($business_qry) or die (mysql_error());
	$buiness_row = mysql_fetch_array($business_rs);

	$SQL_samebilling = "SELECT name,state,dispatchcontact,city,address,zip FROM tt_business WHERE locationid ='$bId'";
	$rs_samebilling		= $db->get_row($SQL_samebilling, ARRAY_A);
	
	
	if ( !isset ($_SESSION['biz_reg2']) or ($_SESSION['biz_reg2']['busId'] != $bId ) )
	{   
	    unset($_SESSION['biz_reg2']);
		$_SESSION['biz_reg2'] = $buiness_row;

	}
	
$bilingstate = $rs_samebilling['state'];

	$selectedindexval = '';
	$i=0;
	foreach($StateAbArray as $key=>$val){
			if($key==$bilingstate){
			$selectedindexval = $i;
			break;
			}
			$i++;
	}
//echo $selectedindexval; exit;	
	
}
//echo '<pre>';print_r($_POST);exit;
?> 
<script language="javascript">
function setDefaultValues(){
//alert('azeem');
	document.getElementById('phone').value = '<?php echo $rs_samebilling['phone'];?>';
	document.getElementById('address').value = '<?php echo $rs_samebilling['address'];?>';
	document.getElementById('state').selectedIndex = '<?php echo $selectedindexval;?>';
	document.getElementById('city').value = '<?php echo $rs_samebilling['city'];?>';
	document.getElementById('zip').value = '<?php echo $rs_samebilling['zip'];?>';
	
}
</script> 
<h3><a href="<?php echo $ruadmin; ?>home.php?p=business">Company</a> &raquo; <a href="#" class="active">Edit Company - <?php echo $rs_samebilling['name'] ?></a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Edit Company &raquo; <a href="<?php echo $ruadmin; ?>home.php?p=business_edit&bId=<?php echo $bId; ?>">Step 1</a> &raquo; Step 2 &raquo; <a href="<?php echo $ruadmin; ?>home.php?p=business_edit_step3&bId=<?php echo $bId; ?>">Step 3 </a></h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
			<?php if ( isset ($_SESSION['biz_reg_err2']) ) {?>
					<div class="notification error png_bg">
						<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
						<div>
							<?php foreach ($_SESSION['biz_reg_err2'] as $ek=>$ev ) echo $ev ."<br />"; ?>
						</div>
					</div>	
			<?php } unset ($_SESSION['biz_reg_err2']);  ?>			
 
                <div id="mainbussines">
                
                	<form  method="post" action="process/process_business.php" enctype="multipart/form-data">
                    <input type="hidden" name="bId" id="bId" value="<?php echo $bId ?>">
					
                    	<fieldset>
							<p><h3><font color="#A90000">Company Billing Info:</font></h3></p>					
                            <p><label>Billing Contact:</label><input name="contact" id="contact" type="text" class="text-input medium-input" value="<?php echo stripslashes($_SESSION['biz_reg2']['contact']); ?>" /></p>
                            <p><input type="checkbox" value="1" onclick="setDefaultValues();" /><label style="display:inline">Same address as Contact  info</label>
                            </p>

                             <p><label>Billing Phone: (000) 000-0000</label><input name="phone" id="phone" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg2']['phone']; ?>"  onchange="validatePhone(this)"/></p>
							<p><label>Address:</label><input name="address" id="address" type="text" class="text-input medium-input" value="<?php echo stripslashes($_SESSION['biz_reg2']['address']); ?>" /></p>                            
                            <p><label>State:</label>
 							   <select name="state" id="state" class="select1">
										<?php foreach($StateAbArray as $short){	?>
										<option value="<?php echo $key; ?>" <?php if($_SESSION['biz_reg2']['state'] == $key) echo 'selected="selected"'; ?>><?php echo $short; ?></option>
										<?php }	?>
								</select>
							</p>
							<p><label>City:</label><input name="city" id="city" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg2']['city']; ?>" /></p>
                            <p><label>Zip Code:</label><input name="zip" id="zip"  maxlength="5" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg2']['zip']; ?>" /></p>
                            
							<p><h3><font color="#A90000">Company Additional Info:</font></h3></p>
							<p><label>Year Established:</label><input name="yearestablished" id="yearestablished" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg2']['yearestablished']; ?>"  ></p>
                            <p><label>ICC-MC#</label><input type="text" name="iccmc" id="iccmc" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg2']['iccmc']; ?>"  onchange="validatePhone(this)"/></p>
                            <p><label>Description:</label>
                               <textarea name="description" id="description"  rows="4" cols="72" type="text"  ><?php echo stripslashes($_SESSION['biz_reg2']['description']); ?></textarea>
                            </p>
                        	<p><input type="submit" class="button" value="&nbsp;&nbsp;&nbsp;Update&nbsp;&nbsp;&nbsp;" name="UpdateBusiness2" id="UpdateBusiness2" /></p>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>	