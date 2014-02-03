<?php
if ( isset ($_POST['doSearch'] ) || isset ($_POST['do_Search'] ) ) 
{
	$_SESSION['bl_bizStatus']=$_POST['userStatus'];
	$_SESSION['bl_sType']=$_POST['sType'];
	$_SESSION['bl_sText']=trim($_POST['sText']);
	$_SESSION['bl_SortBy']=$_POST['SortBy'];
	$_SESSION['ltype'] = $_POST['ltype'];
	header("location:".$ruadmin."home.php?p=emails_bulk_company");exit;
}
$qryString = " where 1 and email <>''";

if ( isset ($_GET['userId']) && ($_GET['userId']!='')){
	$qryString .= " and tt_business.userId=".$_GET['userId'];
}

if ( !isset($_SESSION['bl_bizStatus']))
{
	$_SESSION['bl_bizStatus'] = 'n'; 
}

if($_SESSION['bl_bizStatus']=="n")
{
	$qryString .=  " ";
}
else
{
	$qryString .= " and  tt_business.status = ".$_SESSION['bl_bizStatus']." ";	
}

/*if(isset($_SESSION['ltype']) && $_SESSION['ltype'] != 'a')
{
	$qryString .= " and tt_business.ltype = ".$_SESSION['ltype'] ." ";	
}
*/


if ( $_SESSION['bl_sText'] != '' )
{
	$qryString .= " and ".$_SESSION['bl_sType'] ." like '".$_SESSION['bl_sText']."%'";
}
	
if ( !isset($_SESSION['bl_SortBy']))
{
	$_SESSION['bl_SortBy'] = ' tt_business.locationid ';
}

//-------------------------------------------------------------------------

$t.='
	<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td style="border:1px solid #DDDDDD; padding:4px;">
		<form method="post" action="">Status:&nbsp;<select name="userStatus"  onchange="document.getElementById(\'sText\').focus()">			
			<option ';
			if ($_SESSION['bl_bizStatus'] =='1' )  $t.=' selected="selected" ';
			$t.=' value="1">Active</option>	<option ';
			if ($_SESSION['bl_bizStatus'] =='0' )  $t.=' selected="selected" ';
			$t.=' value="0">Pending </option><option';
			if ($_SESSION['bl_bizStatus'] =='-1' )  $t.=' selected="selected" ';
			$t.=' value="-1">Expired</option><option';
			if ($_SESSION['bl_bizStatus'] =='n' )  $t.=' selected="selected" ';
			$t.=' value="n">All </option>
						
			</select>&nbsp;Search:&nbsp;<select name="sType" id="sType"   onchange="document.getElementById(\'sText\').focus()">			
			<option ';
			if ($_SESSION['bl_sType'] =='name' )  $t.=' selected="selected" ';
			$t.='value="name">Company Name</option>

			<option ';
			if ($_SESSION['bl_sType'] =='tt_business.state' )  $t.=' selected="selected" ';
			$t.='value="tt_business.state">State</option>

			<option ';
			if ($_SESSION['bl_sType'] =='tt_business.city' )  $t.=' selected="selected" ';
			$t.='value="tt_business.city">City</option>	
			
			<option ';
			if ($_SESSION['bl_sType'] =='tt_business.zip' )  $t.=' selected="selected" ';
			$t.='value="tt_business.zip">Zipcode</option>							

			<option ';
			if ($_SESSION['bl_sType'] =='tt_business.email' )  $t.=' selected="selected" ';
			$t.=' value="tt_business.email">Email</option>
			</select>
			<input type="text" id="sText"  name="sText" class="text-input" value="'.$_SESSION['bl_sText'].'">
			&nbsp;Sort&nbsp;By:&nbsp;<select name="SortBy" onchange="document.getElementById(\'sText\').focus()">
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.email asc' )  $t.=' selected="selected" ';				$t.=' value="tt_business.email asc">Email Id Asc</option>
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.email desc' )  $t.=' selected="selected" ';				$t.=' value="tt_business.email desc">Email Desc</option>
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.name asc' )  $t.=' selected="selected" '; 			$t.=' value="tt_business.name asc">Company Name Asc</option>
			<option  ';			if ($_SESSION['bl_SortBy'] =='tt_business.name desc' )  $t.=' selected="selected" ';			$t.=' value="tt_business.name desc">Company Name Desc</option>
									
															
			</select>&nbsp;
			
Listing Type:&nbsp;<select name="ltype" id="ltype"  onchange="document.getElementById(\'sText\').focus()">			
			<option ';
			if ($_SESSION['ltype'] =='a' )  $t.=' selected="selected" ';
			$t.=' value="a">All</option>	<option ';
			if ($_SESSION['ltype'] =='2' )  $t.=' selected="selected" ';
			$t.=' value="2">Allied Listing</option><option';
			if ($_SESSION['ltype'] =='1' )  $t.=' selected="selected" ';
			$t.=' value="1">Standard Listing</option><option';
			if ($_SESSION['ltype'] =='0' )  $t.=' selected="selected" ';
			$t.=' value="0">Basic Listing</option>
						
			</select><br/><br/><input type="hidden"	value="do_Search" name="do_Search" id="do_Search">
<center><input type="submit" class="button" name="doSearch" id="doSearch" value="Filter Listing"   /></center> </form>			
				
		</td>
	</tr>	
	<tr>
		<td>&nbsp;</td>
	</tr></table>';
	$sortyby = '  order by '.$_SESSION['bl_SortBy'];
	 $sql_sel_user = "SELECT locationid,name,btype,ltype, city,state,zip,phone,email,website,dated,keywords,status FROM `tt_business` $qryString  $sortyby ";  
	//echo $sortyby;exit;
	$query_sel_user = mysql_query($sql_sel_user) or die(mysql_error());
	
	$qry = "select * from  tt_emails where type = 'bulkemail'";
	
	$rs=mysql_query($qry);
	$row =mysql_fetch_array($rs);
	 
	$subject=$row['subject'];
	$htmlData=$row['body'];
	$type =$row['type'];
	$mailfrom = $row['touser'];
	$htmlData = $htmlData;
	unset($_SESSION['em_userStatus']);
	unset($_SESSION['em_sText']);
	unset($_SESSION['em_SortBy']);
	unset($_SESSION['userType']);	
?>
<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Bulk Email</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Bulk Email to Company</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
	<?php echo $t;  ?>
  <?php if ( isset ($_GET['s'] ) ) {?>
		<div class="notification error png_bg">
			<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
			<div>
				<?php if($_GET['s']=='1') echo "Email sent in Queue list successfully!"; else echo "Email not sent. Please select to addresses"; ?>
			</div>
		</div>	
  <?php } ?>	
	<form   method="post" action="process/process_bluckemail.php">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td><strong>To:</strong></td>
	  </tr>	  
	  <tr>
		<td>
		<?php if(mysql_num_rows($query_sel_user)>0){?>
		  <select name="slect_all[]" size="10" multiple="multiple" id="slect_all[]">
		  <?php while($row_user = mysql_fetch_array($query_sel_user)) {?>
			<option value="<?php echo $row_user['firstname']."{:".$row_user['lastname']."{:".$row_user['zip']."{:".$row_user['city']."{:".$row_user['state']."{:UK {:".$row_user['email'];?>"><?php echo $row_user['firstname']." ".$row_user['lastname']." (".$row_user['email'].")";?></option>
		  <?php }?>
		  </select>
		  <br/><a href="javascript:void(0);" onclick="allSelected();">Select all </a>&nbsp;/<a href="javascript:void(0);" onclick="deSelected();"> Deselect </a>
		</td>
	  </tr>
	  <tr>
		<td><strong>Email From:</strong></td>
	  </tr>
	  <tr>
	  		<td><input type="hidden" name="savepage" value="<?php echo $type; ?>">
			<input type="hidden" name="mailto" value="<?php echo $email_row['touser'];?>" />
			<input type="text" name="mailfrom" value="<?php echo $mailfrom; ?>" size="93" class="text-input">
			</td>
		</tr>	
		<tr>
			<td><strong>Email&nbsp;Subject:</strong></td>
		</tr>
		<tr>
			<td><input type="text" name="txtSubject" value="<?php echo $subject; ?>" size="93" class="text-input"></td>
		</tr>			
		<tr>
			<td  valign="top"><strong>Email&nbsp;Body:</strong></td>
		</tr>
		<tr>
			<td>User Keyword {{FirstName}}, {{LastName}} <br/>
			<?php		
				include("FCKeditor/fckeditor.php");		
				$oFCKeditor = new FCKeditor('txtData') ;
				$oFCKeditor->BasePath = 'FCKeditor/';
				$oFCKeditor->Value = nl2br($htmlData);
				$oFCKeditor->Create() ;
		?></td>
		</tr>
		<tr>
			<td>
			<input type="submit" class="button" name="SaveTextData_carrier" value="Send Email Carrier"  /></td>
		</tr>
	</table>
	<?php } else {echo "No user fond";}?>
	</form>
	</div>
</div>	
<script language="javascript" type="text/javascript">
function getSelected()
{
	ob=document.getElementById("idmare_category[]");
	nlength=ob.length;
	tmp='';
	for ( i=0; i<nlength; i++ ) 
	{
		if (ob.options[i].selected == true) 
		{
			if (tmp == '' )
			{
				tmp= ob.options[i].value;
			}
			else
			{
				tmp=tmp + ',' + ob.options[i].value;
			}
		}
	}
	alert (tmp);
}

function allSelected()
{
	ob=document.getElementById("slect_all[]");
	nlength=ob.length;
	for ( i=0; i<nlength; i++ ) 
	{
		ob.options[i].selected = true;
	}
}
allSelected();
function deSelected()
{
	ob=document.getElementById("slect_all[]");
	nlength=ob.length;
	for ( i=0; i<nlength; i++ ) 
	{
		ob.options[i].selected = false;
	}
}
</script>