<?php 
 $cat = array();
 $sql = "SELECT catid, cat_name from tt_category where p_catid <> 0 AND `cat_type` = '1' ";
 $result =@mysql_query($sql);
 while ($row = mysql_fetch_array( $result ) ){ 
	 $cat[$row['catid']] = $row['cat_name'];
 }
 ?>
<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Trade Sub-Category Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Trade Sub-Category Management</h3>
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
<form action="<?php echo $ruadmin ;?>process/process_category.php?p=addsubcat" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #DDDDDD; ">
  <tr>
    <td colspan="3" align="left"><strong>Add New Sub-Category </strong></td>										
  </tr>
  <tr>
    <td  align="right">Select Category: &nbsp;</td>
    <td><select name="cat" id="cat" >
		<?php 
		 $sql = "SELECT catid, cat_name FROM tt_category WHERE p_catid='0' AND `cat_type` = '1' ORDER BY `cat_name` ASC";
		 $result =@mysql_query($sql);
		 while ($row = mysql_fetch_array( $result ) ){ 
		 	$catval = $row['catid'];
			echo '	<option  value="'.$catval.'"  >'.$row['cat_name'].' </option>';
		 }
		?></select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="20%"  align="right">Sub-Category: &nbsp;</td>
    <td width="26%"><input name="txttitle" type="text" id="txttitle"  class="text-input" /></td>
    <td width="37%" style="color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><?php echo $_SESSION['titleerror'];unset($_SESSION['titleerror']);?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><label>
      <input type="submit" class="button" name="Submit" value="Add new sub category" />
    </label></td>
    <td>&nbsp;</td>
  </tr>


</table>
</form>
<br/>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr><td colspan="4" align="center">
    <form method="post" >
    	Sub-Category: <input type="text" size="40" class="text-input"  name="searchkw" value="<?php echo trim( $_POST['searchkw'] )?>" />&nbsp;&nbsp;<input type="submit" class="button" value="Search" name="Search"  /></form>
    </form>

    	</td>
   </tr>
   <tr>
    <td  colspan="4">
	<div style="float:left">
	<?php 
		$filterby 	= "Where  p_catid <> 0 AND cat_type = '1' ";
		
		if( isset ($_GET['cid'] ) and  trim( $_GET['cid']) != '') {
			$cid = $_GET['cid'];
			if($cid==0){ $cid = ""; }
			$filterby .= " and  p_catid = ".$cid ;
		}
		if ( isset ($_POST['searchkw'] ) and trim ($_POST['searchkw']!='')){
			$filterby .= " and cat_name like '".$_POST['searchkw']."%' or cat_name like '%".$_POST['searchkw']."%' ";
		}

		$sql = "SELECT * from tt_category  $filterby order by cat_name";

		$result =@mysql_query($sql);
		$total_pages = @mysql_num_rows($result);
		echo "Total Sub-Category : ".$total_pages;
	?>
    </div>
	 <div style="float:right; margin-right:5px;">
          
     
     &nbsp;&nbsp;
     Filter By Category: <select name="cid" id="cid"  onChange="{window.location='home.php?p=subcategory&cid=' + this.value}" >
				<option  value="" >---------List by Category-------------</option>
				<?php 
		
		 $sqlInds = "SELECT  catid, cat_name  from tt_category where p_catid = 0 AND `cat_type` = '1' ";
		 $resultInds =@mysql_query($sqlInds);
		 while ($rowInds = mysql_fetch_array( $resultInds ) ){ 
		 	$sel = '  ';

		 	if ( $cid == $rowInds	['catid'] ) $sel = ' Selected = "Selected" ';
			echo '	<option  value="'.$rowInds['catid'].'" '.$sel.' >'.$rowInds['cat_name'].' </option>';

		 }
		  ?>
		  <option  value="0" <?php if($cid == 0 ){ ?> Selected = "Selected" <?php } ?>>Other</option>
		  </select>
          </div>
          </td>
  <tr>
  <tr>
  	<td colspan="4"><?php echo $_SESSION['statuss']; unset($_SESSION['statuss']);?></td>
  </tr>
  <tr>
    <td width="12%"><strong>Id</strong></td>
    <td width="36%"><strong>Sub-Category</strong></td>
    <td width="34%"><strong>Category</strong></td>
    <td width="18%"><strong>Action</strong></td>
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
		if(count($rec)>0)
		{
			foreach($rec as $items)
			{
			

			?>
			
			  <tr>
				<td><?php echo ++$i;?> </td>
				<td><?php echo $items['cat_name'];?> </td>
				<td><?php
				
				$sql_category	=	"select * from tt_category where catid = '".$items['p_catid']."'";
				   $row	=	$db->get_row($sql_category,ARRAY_A);
				
				
				 echo $row['cat_name']; 
				 
				?></td>
				<td valign="middle">
					<img src="images/edit.gif"  style="cursor:pointer;" title="Edit Sub-Category" onclick="document.getElementById('<?php echo $items['catid'];?>').style.display='block'"  />	&nbsp;&nbsp;
				    <img src="images/dlt.gif"  style="cursor:pointer;" title="Delete Sub-Category" alt="Delete Sub-Category" onclick="if(confirm('Are sure you want to delete')){window.location='<?php echo $ruadmin;?>process/process_category.php?p=delsubcat&page=<?php echo $_GET['page'];?>&cid=<?php echo $items["catid"]; ?>&kw=<?php echo $items["cat_name"]; ?>' }"  />
				</td>
		      </tr>	
			  <tr>
			   <td colspan="4"><div id="<?php echo $items['catid'];?>" style="display:none;">
			   <form action="<?php echo $ruadmin ;?>process/process_category.php?p=editsubcategory&cid=<?php echo $items['catid'];?>&page=<?php echo $_GET['page'];?>" method="post">
			   Sub-Category:<input  type="text" id="title" name="title"  value="<?php echo $items['cat_name'];?>" size="40"  class="text-input"/>&nbsp;
               <select name="cat" id="cat" > 
				<?php 
				$sqlInds = "SELECT catid, cat_name FROM tt_category WHERE p_catid = 0 AND `cat_type` = '1' ";
				$resultInds =@mysql_query($sqlInds);
				while ($rowInds = mysql_fetch_array( $resultInds ) ){ 
					echo '	<option  value="'.$rowInds['catid'].'" ';
					if ($items['cat_name'] == $rowInds['cat_name'] ) echo '  selected="selected" ';
						echo ' >'.$rowInds['cat_name'].' </option>';
				}
		 	 ?>
		    </select>
				<input type="hidden" id="ctitle" name="ctitle"  value="<?php echo $items['cat_name'];?>"/>
				<input type="submit" class="button" value="Update"  />
				&nbsp;<input type="button"  class="button" value="Cancel" onclick="document.getElementById('<?php echo $items['catid'];?>').style.display='none'"  />
				</form>
				</div>
			  </td> 
			  </tr>
			  
	        <?php
			}
		}
	?>	
  <tr>
    <td  colspan="4"><?php include("../common/paginglayout.php");?></td>
  </tr>	     
</table>
	</div>
</div>	