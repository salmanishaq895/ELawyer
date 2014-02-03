<?php 
if(isset($_GET['subid'])){ $parentid=$_GET['subid']; } else { $parentid=0; }
?>

<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Swear Word Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Swear Word Management</h3>
		<div style="float:right;"> <h3><a href="<?php echo $ruadmin;?>home.php?p=add_swear" style=" margin-left:350px; font-size:12px; font-weight:bold;" > Add New Word </a></h3></div>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
	<?php if ( isset ($_SESSION['msg']) ) {?>
		<div class="notification error png_bg">
			<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
			<div>
				<?php echo  $_SESSION['msg']; unset($_SESSION['msg']); ?>
			</div>
		</div>	
	<?php } ?>	
	<?php if ( isset ($_SESSION['error_add_cat']) ) {?>
		<div class="notification error png_bg">
			<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
			<div>
				<?php foreach ($_SESSION['error_add_cat'] as $ek=>$ev ) echo $ev ."<br />"; ?>
			</div>
		</div>	
		<?php }unset($_SESSION['error_add_cat'] ); ?>	
<table width="100%" border="0" cellpadding="0" cellspacing="0">
   <tr>
    <td colspan="5">
	<?php 
		 $sql = "SELECT * FROM tt_swear_words ";
		 //echo $sql;exit;
		 $result =@mysql_query($sql) or die ( mysql_error());
		 $total_pages = @mysql_num_rows($result);
		 echo "Total Swear Words: ".$total_pages;
	?>
  </tr>
  <tr>
  	<td colspan="5"><?php echo $_SESSION['msg']; unset($_SESSION['msg']);?></td>
  </tr>
  <tr>
    <td width="10%"><strong>Id</strong></td>
    <td width="40%"><strong>Words</strong></td>
    <!--<td width="10%"><strong>Featured</strong></td>	
    <td width="25%"><strong> &nbsp;</strong></td>
   --> <td width="15%"><strong>Action</strong></td>
  </tr>	
  
    <?php 
		 ///////////////////////////////////////////////////////////////////////////////////////
		 include('common/pagingprocess.php');
		 ///////////////////////////////////////////////////////////////////////////////////////
		 $sql .=  " ORDER BY `word` ASC LIMIT ".$start.",".$limit;
		 $i=$i+$start;
		 //echo $sql;exit;
		 $result = @mysql_query($sql);
		 $rec = array();
		 while( $row = @mysql_fetch_array($result) )
		 {
	
			?>
			  <tr>
				<td><?php echo ++$i;?> </td>
				<td><?php echo stripslashes($row['word']);?></td>
		<!--		<td>< ?php if(stripslashes($row['featured'])=='1'){ echo 'yes';} else{ echo 'no'; }	?> </td>
                <td>< ?php //echo $row['b_count'];	?> </td>-->
				<td align="center">
					<img src="images/edit.gif" style="cursor:pointer;" title="Edit categorye" onclick="document.getElementById('<?php echo $row['id'];?>').style.display='block'"  />	&nbsp;&nbsp;
				    <img src="images/dlt.gif" style="cursor:pointer;" title="Delete categorye" alt="Delete categorye" onclick="if(confirm('Are sure you want to delete')){window.location='<?php echo $ruadmin; ?>process/process_swear.php?p=delswear&page=<?php echo $_GET['page'];?>&id=<?php echo $row["id"]; ?>' }"  />
				</td>
		      </tr>	
			  <tr>
			   <td colspan="5">
			   	<div id="<?php echo $row['id'];?>" style="display:none; float:left; width:100%">
				<form action="<?php echo $ruadmin; ?>process/process_swear.php?p=editswear&id=<?php echo $row['id'];?>&page=<?php echo $_GET['page'];?>" method="post" enctype="multipart/form-data">
				<input type="hidden" id="ctitle" name="ctitle"  value="<?php echo stripslashes($row['word']);?>"/>
				<input type="text" id="title" name="title"  value="<?php echo stripslashes($row['word']);?>" class="text-input"/>
				<input type="submit" class="button" value="submit" onclick="if(document.getElementById('title').value==''){alert('Enter cat_name name'); return false;}" />&nbsp;<input type="button" value="Cancel" onclick="document.getElementById('<?php echo $row['id'];?>').style.display='none'" class="button"  />
				</form>
				</div>
			  </td> 
			  </tr>
	        <?php
		}
	?>	
  <tr>
    <td colspan="5"><?php include('common/paginglayout.php');?></td>
  </tr>	  		 
</table>
	</div>
</div>	
<?php unset($_SESSION['add_cat']);?>