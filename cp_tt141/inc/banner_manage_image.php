<script type="text/javascript">
function showUser(str,id,cat,name,type)
{ //alert('azeem');
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  { 
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    { //alert('azeem');
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","<?php echo $ruadmin; ?>process/process_ajax.php?q="+str+"&id="+id+"&cat="+cat+"&name="+name+"&type="+type,true);
xmlhttp.send();
}
</script>
<?php 
if ( isset ($_POST['doSearch'] ) || isset ($_POST['do_Search'] ) ) 
{
	$_SESSION['banner_img_bizStatus']=$_POST['userStatus'];
	$_SESSION['banner_img_sType']=$_POST['sType'];
	$_SESSION['banner_img_sText']=trim($_POST['sText']);
	$_SESSION['banner_img_SortBy']=$_POST['SortBy'];
	$_SESSION['ltype'] = $_POST['ltype'];
	header("location:".$ruadmin."home.php?p=banner_manage_image");exit;
}
$qryString = " where 1 and banner_type ='image'  ";

if ( isset ($_GET['userId']) && ($_GET['userId']!='')){
	$qryString .= " and tt_banner.userId=".$_GET['userId'];
}

if ( !isset($_SESSION['banner_img_bizStatus']))
{
	$_SESSION['banner_img_bizStatus'] = 'n'; 
}

if($_SESSION['banner_img_bizStatus']=="n")
{
	$qryString .=  " ";
}
else
{
	$qryString .= " and  tt_banner.status = ".$_SESSION['banner_img_bizStatus']." ";	
}

if(isset($_SESSION['ltype']) && $_SESSION['ltype'] != 'a')
{
	$qryString .= " and tt_banner.ltype = ".$_SESSION['ltype'] ." ";	
}



if ( $_SESSION['banner_img_sText'] != '' )
{
	$qryString .= " and ".$_SESSION['banner_img_sType'] ." like '".$_SESSION['banner_img_sText']."%'";
}
	
if ( !isset($_SESSION['banner_img_SortBy']))
{
	$_SESSION['banner_img_SortBy'] = ' tt_banner.userId ';
}

//-------------------------------------------------------------------------

$t.='
	<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td style="border:1px solid #DDDDDD; padding:4px;">
		<form method="post" action="">Status:&nbsp;<select name="userStatus"  onchange="document.getElementById(\'sText\').focus()">			
			<option';
			if ($_SESSION['banner_img_bizStatus'] =='n' )  $t.=' selected="selected" ';
			$t.=' value="n">All </option><option ';
			if ($_SESSION['banner_img_bizStatus'] =='1' )  $t.=' selected="selected" ';
			$t.=' value="1">Active</option>	<option ';
			if ($_SESSION['banner_img_bizStatus'] =='0' )  $t.=' selected="selected" ';
			$t.=' value="0">Block</option>
						
			</select>&nbsp;Search:&nbsp;<select name="sType" id="sType"   onchange="document.getElementById(\'sText\').focus()">			
			
			<option ';
			if ($_SESSION['banner_img_sType'] =='tt_user.firstname' )  $t.=' selected="selected" ';
			$t.='value="tt_user.firstname">Advertiser First Name</option>	
			<option ';
			if ($_SESSION['banner_img_sType'] =='tt_user.lastname' )  $t.=' selected="selected" ';
			$t.='value="tt_user.lastname">Advertiser Last Name</option>						

			<option ';
			if ($_SESSION['banner_img_sType'] =='tt_user.email' )  $t.=' selected="selected" ';
			$t.=' value="tt_user.email">Email</option>
			
			<option ';
			if ($_SESSION['banner_img_sType'] =='tt_banner.site_url' )  $t.=' selected="selected" ';
			$t.=' value="tt_banner.site_url">Site URL</option>
			
			<option ';
			if ($_SESSION['banner_img_sType'] =='tt_banner.logo' )  $t.=' selected="selected" ';
			$t.=' value="tt_banner.logo">Image Name</option>				

			</select>
			<input type="text" id="sText"  name="sText" class="text-input" value="'.$_SESSION['banner_img_sText'].'">
			<input type="hidden"	value="do_Search" name="do_Search" id="do_Search">
			<input type="submit" class="button" name="doSearch" id="doSearch" value="Filter Listing"   /> </form>			
				
		</td>
	</tr>	
</table>';
	$sortyby = '  order by '.$_SESSION['banner_img_SortBy'];
	$sql = "SELECT tt_user.firstname
					 , tt_user.lastname
					 , tt_user.email
					 , tt_banner.banner_id
					 , tt_banner.status
					 , tt_banner.banner_type
					 , tt_banner.logo
					 , tt_banner.site_url
				FROM
				  tt_user
				INNER JOIN tt_banner
				ON tt_user.userId = tt_banner.userId $qryString $sortyby ";  
	
	
    $sqlcount = "SELECT  count(tt_banner.banner_id)
					FROM
					  tt_user
					INNER JOIN tt_banner
					ON tt_user.userId = tt_banner.userId $qryString"; 
	unset($_SESSION['banner_img_bizStatus']);
	unset($_SESSION['ltype']);
	unset($_SESSION['banner_img_sText']);
	unset($_SESSION['banner_img_SortBy']);
	unset($_SESSION['banner_img_bizPackage']);	
?>
<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Top Image Banner Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
			<h3>Top Image Banner Management</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">			
		<?php echo $t;  ?>
		<?php if ( isset ($_SESSION['msg']) ) {?>

			<div class="notification error png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					<?php echo  $_SESSION['msg']; unset($_SESSION['msg']); ?>
				</div>
			</div>	
	     <?php } ?>	
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				 <tr>
					<td colspan="12"><strong><div id="txtHint"><b></b></div></strong></td>																										
				  </tr>
				 <tr>
					<td colspan="12">
					<?php 
						$qrycounts = mysql_query($sqlcount);
						$rowcounts = mysql_fetch_array($qrycounts);
						$total_pages = $rowcounts[0];
						echo "Company count: ".$rowcounts[0];
					?>
				  </tr>					  
				  <tr>
					<td width="3%"><strong>Id</strong></td>
					<td width="20%"><strong>Advertiser Name</strong></td>
					<td width="12%"><strong>Advertiser Email</strong></td>	
					<td width="12%"><strong>Site URL</strong></td>				
					<td width="30%"><strong>Image</strong></td>									                    	
   					<td width="11%"><strong>Action</strong></td>																										
				  </tr>	
				  <?php
						 ///////////////////////////////////////////////////////////////////////////////////////
						 include('common/pagingprocess.php');
						 ///////////////////////////////////////////////////////////////////////////////////////
						   $sql .=  " LIMIT ".$start.",".$limit;
						 $i=$i+$start;
						 $result = @mysql_query($sql);
						 $rec = array();
						 while( $row = @mysql_fetch_array($result) )
						 {
							$rec[] = $row;
						 }
							//echo '<pre>';print_r($rec);exit;
							if(count($rec)>0){
							foreach($rec as $items)
							{
								//echo '<pre>';print_r($items);exit;
							?>
							   <tr>
								<td><?php echo ++$i;?> </td>
								<td><?php echo stripslashes($items['firstname']).' '.stripslashes($items['lastname']);?></td>
								<td><?php echo $items['email'];?> </td>
								<td><?php echo $items['site_url'];?> </td>
								<td><img src="<?php echo $ru.'media/banner/'.$items['banner_id'].'/logo/'.$items['logo'];?>" width="98%"  /></td>                       
								<td>
									<select name="status" id="status" class="select1" style="width:100%" 
									onchange="showUser(this.value,'<?php echo $items['banner_id']; ?>','status',
									'<?php echo stripslashes($items['firstname']).' '.stripslashes($items['lastname']);?>','image')"  >
										<option value="1" <?php if( $items['status'] == '1'){ ?> selected="selected" <?php } ?>>Active</option>
										<option value="0" <?php if( $items['status'] == '0'){ ?> selected="selected" <?php } ?>>Block</option>    	
									</select>
							    </td>			                   
							  </tr>	
							<?php
							}
						}
					?>	
				  <tr>
					<td colspan="12"><?php include('common/paginglayout.php');?></td>
				  </tr>	     			
			</table>	
			
	</div>
</div>	
