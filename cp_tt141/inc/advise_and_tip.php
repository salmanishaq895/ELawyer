<?php 
if ( isset ($_POST['doSearch'] ) || isset ($_POST['do_Search'] ) ) 
{
	$_SESSION['bl_bizStatus']=$_POST['userStatus'];
	$_SESSION['bl_sType']=$_POST['sType'];
	$_SESSION['bl_sText']=trim($_POST['sText']);
	$_SESSION['bl_SortBy']=$_POST['SortBy'];
	
	header("location:home.php?p=advise_and_tip");exit;
}
$qryString = " where 1 ";
$qryString .= " AND category_id <> 0 ";
/*if ( isset ($_GET['userId']) && ($_GET['userId']!='')){
	$qryString .= " and tt_quotes.	userId=".$_GET['userId'];
}

if ( !isset($_SESSION['bl_bizStatus']))
{
	$_SESSION['bl_bizStatus'] = 'n'; 
}
*/




/*if($_SESSION['bl_bizStatus']=="n")
{
	$qryString .=  " ";
}
else
{
	$qryString .= " and  tt_job.status = ".$_SESSION['bl_bizStatus']." ";	
}*/








/*if($_SESSION['bl_bizPackage'] == '0')
{
	$qryString .= " and tt_business.btype = '0'";	
}
elseif($_SESSION['bl_bizPackage'] == '1')
{
	$qryString .= " and tt_business.btype = '1'";
}*/


if ( $_SESSION['bl_sText'] != '' )
{
	$qryString .= " and seo_page  like '".$_SESSION['bl_sText']."%'";
	
}

/*
	
if ( !isset($_SESSION['bl_SortBy']))
{
	$_SESSION['bl_SortBy'] = ' tt_quotes.quotes_id desc';
}*/

//-------------------------------------------------------------------------

	if( isset ($_GET['cid'] ) and  trim( $_GET['cid']) != '') {
			$cid = $_GET['cid'];
			$qryString = "where  category_id = '".$cid."' " ;
		}
	
	$sortyby = '  order by advise_title';
 	//$sql = "SELECT tt_quotes.quotes_id, tt_quotes.keyword,tt_quotes.location,tt_quotes.title,tt_quotes.message,tt_quotes.phone,tt_quotes.userId,tt_user.firstname,tt_user.lastname FROM `tt_quotes` LEFT JOIN `tt_user` ON (tt_quotes.userId=tt_user.userId)  $qryString $sortyby "; 
//exit; 
$sql = "select * from tt_advise $qryString $sortyby";

	$sqlcount = "SELECT count(advise_id) FROM `tt_advise` $qryString $sortyby"; 
?>
<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Advise & tips Sub Category management</a></h3>
<div class="content-box">
	<div class="content-box-header">
			<h3>Advise & tips Sub Category management</h3>
			<div style="float:right;"> <h3><a href="<?php echo $ruadmin;?>home.php?p=new_advise_and_tip" style=" margin-left:350px; font-size:12px; font-weight:bold;" > Add New Sub Category </a></h3></div>

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
			
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
				   <tr>
					<td colspan="8">
					<?php 
						$qrycounts = mysql_query($sqlcount);
						$rowcounts = mysql_fetch_array($qrycounts);
						$total_pages = $rowcounts[0];
						echo "Advise And Tips count: ".$rowcounts[0];
					?>
					 <div style="float:right; margin-right:5px;">
	 
     
     Sort By: <select name="cid" id="cid"  onChange="{window.location='home.php?p=advise_and_tip&cid=' + this.value + '&sortby='+document.getElementById('cid').value}" >
				<option  value="" >---------List by Category-------------</option>
				<?php 
					$qry_c  = "select * from tt_advise where category_id=0";
					$row_c  = $db->get_results($qry_c,ARRAY_A);
				 foreach($row_c as $key) {
					$sel = '  ';
					if ( $cid == $key['advise_id'] ) $sel = ' Selected = "Selected" ';
					echo '<option  value="'.$key['advise_id'] .'"  '.$sel.'  >'. $key['advise_title'] .'</option>';
		
				 }
		  ?>
		  </select>
          </div> 

			</select>
			</div>
					
					</td>
				  </tr>					  
				  <tr>
					<td width="5%"><strong>Id</strong></td>
					<td width="15%"><strong>Title</strong></td>
					<!--<td width="15%"><strong>Page Name</strong></td>-->
					<td width="15%"><strong> Category </strong></td>
					<!--<td width="15%"><strong> Sub Page </strong></td>-->
					<td width="15%"><strong> URL </strong></td>
					<td width="15%"><strong>Create Date</strong></td>
					
					<!--<td width="12%"><strong>Phone</strong></td>-->	
					<!--<td width="10%"><strong>Location</strong></td>													
					<td width="8%"><strong>Status</strong></td>	
					<td width="10%"><strong>Expiry Date</strong></td>	-->																			
					<td width="5%"><strong>Action</strong></td>
				  </tr>
				  <?php 
						 ///////////////////////////////////////////////////////////////////////////////////////
						 include("../common/pagingprocess.php");
						 ///////////////////////////////////////////////////////////////////////////////////////
						  $sql .=  " LIMIT ".$start.",".$limit;
						 $i=$i+$start;
						 $result = @mysql_query($sql);
						 $rec = array();
						 
						 while( $row = @mysql_fetch_array($result) )
						 {
							$rec[] = $row;
						 }
							if(count($rec)>0){
							foreach($rec as $items)
							{
								
							?>
							  <tr>
								<td><?php echo ++$i;?> </td>
								<td><?php echo stripslashes($items['advise_title']);?> </td>
							<!--	<td> <?php echo $items['seo_page'];?></td>
								<td>< ?php
								//$query_user  =  "select * from tt_user where userId='".$items['userid']."'";
								//$result_user  = mysql_query($query_user);
								//$row_user  = mysql_fetch_array($result_user);
								//echo $row_user['firstname']." ".$row_user['lastname'];
								echo $items['firstname']." ".$items['lastname'];
								 //echo $items['customerName'];?> </td>-->
								<td>
								
								<?php
								$qry_category   = "select * from tt_advise where advise_id = '".$items['category_id']."'";
								$result_category   = mysql_query($qry_category);
								$row_category  = mysql_fetch_array($result_category);
								echo $row_category['advise_title'];
								
								
								?>
								 </td>
								 <!--<td> < ?php if($items['sublink']=='0') {echo "NO";}else{echo "Yes";}  ?></td>-->
								<td><?php echo $ru."advice/".$row_category['seo_page']."/".$items['seo_page'];?> </td> 
								<td><?php echo get_DateFormating($items['date_added']);?> </td>
								<!--<td><?php echo $items['images'];?> </td>
								
								<td><?php  echo $items['location'];?> </td>	

								<?php// if($items['userId']!='1' && $items['userId']!='0'){?>
								<td><a href="home.php?p=editprofile&userId=<?php// echo $items['userId'];?> "><?php //echo $items['firstname'].' '.$items['lastname'];?></a></td>
								<?php // } else {?>
								<td>Admin</td>
								<?php //}?>								
								<td><?php //if($items['btype'] =='0') { echo 'Standard'; } elseif($items['btype'] =='1') { echo 'Premium'; } ?> </td>	
								<td><?php //echo date ('Y-m-d',strtotime( $items['dated']) );?> </td>	
								<td><?php if($items['status'] =='1') { echo 'Active'; } elseif($items['status'] =='0') { echo 'Pending';} elseif($items['status'] =='-1') { echo 'Expired';}?></td>
								<td><?php  echo get_DateFormating($items['expirydate']);?> </td>	-->
								<td>
						<img src="images/edit.gif"  style="cursor:pointer;" title="Edit "   alt="Edit "   onClick="window.location='home.php?p=edit_advise&advise_id=<?php echo $items["advise_id"];?>'"  />&nbsp;&nbsp;
						<img src="images/dlt.gif"  style="cursor:pointer;" title="Delete " alt="Delete " onClick="if(confirm('Are sure you want to delete')){ window.location='<?php echo $ruadmin ;?>process/process_advise.php?action=d&advise_id=<?php echo $items["advise_id"];?>'}"  />								</td>
							  </tr>	
					  
							<?php
							}
						}
					?>	
				  <tr>
					<td colspan="8"><?php include("../common/paginglayout.php");?></td>
				  </tr>	     			
	  </table>	
			
	</div>
</div>	
<?php
unset($_SESSION['bl_bizStatus']);
unset($_SESSION['bl_sType']);
unset($_SESSION['bl_sText']);
unset($_SESSION['bl_SortBy']);
	
?>