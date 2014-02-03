<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Location Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Location Management</h3>
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
<form action="<?php $ruadmin ;?>process/process.php?p=addnewCity" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #DDDDDD; ">
  <tr>
    <td colspan="3" align="left"><strong>Add new city</strong></td>										
  </tr>
  <tr>
    <td  align="right">Select state: &nbsp;</td>
    <td><select name="state" id="state" >
				<?php 
		foreach($StateAbArray as $key => $val) {
			echo '	<option  value="'.$key.'"  >'.$val .' </option>';

		 }
		  ?></select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="20%" align="right">City: &nbsp;</td>
    <td width="26%"><input name="City" type="text" id="City" class="text-input" /></td>
    <td width="37%"><?php echo $_SESSION['Cityerror'];unset($_SESSION['Cityerror']);?></td>
  </tr>
  <tr>
    <td style="text-align:right;">&nbsp;</td>
    <td align="left">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><label>
      <input type="submit" class="button" name="Submit" value="Add new city" />
    </label></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<br/>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr><td colspan="5" align="center">
    <form method="get" action="">
		<input type="hidden" name="p" value="managecities" />
    	Search Keyword: <input type="text" size="40"  name="searchkw" value="<?php echo trim( $_GET['searchkw'] )?>"  class="text-input"  />&nbsp;
		<input type="submit" class="button" value="Search city" /></form>
    </form></td>
   </tr>
   <tr>
    <td  colspan="5">
	<div style="float:left">
	<?php 
		$filterby 	= '';
		
		if ( isset ($_GET['searchkw'] ) and trim ($_GET['searchkw']!='')){
			$filterby = "where city like '%".$_GET['searchkw']."%' ";
		}
		else if( isset ($_GET['cid'] ) and  trim( $_GET['cid']) != '') {
			$cid = $_GET['cid'];
			$filterby = "where  state = '".$cid."' " ;
		}
		
		if($_GET['sortby'] == 'city_desc')
		{
			$sortBy = ' order by city desc ';
		}
		elseif($_GET['sortby'] == 'city_asc')
		{
			$sortBy = ' order by cityid asc ';
		}
		
		else
		{
			$sortBy = '  order by cityid asc ';
		}
		$sql = "select * from tt_citystate $filterby $sortBy";

		$result =@mysql_query($sql);
		$total_pages = @mysql_num_rows($result);
		echo "Total Locations : ".$total_pages;
	?>
    </div>
	
	 <div style="float:right; margin-right:5px;">
     Sort By: <select name="orderby" id="orderby"  onChange="{window.location='home.php?p=managecities&cid=' + document.getElementById('cid').value + '&sortby='+this.value}" >
				<option <?php if($_GET['sortby'] == 'city_asc') echo 'selected="selected"';?> value="city_asc">city asc</option>
                <option <?php if($_GET['sortby'] == 'city_desc') echo 'selected="selected"';?> value="city_desc">city desc</option>

			</select>
     &nbsp;
     Filter By State: <select name="cid" id="cid"  onChange="{window.location='home.php?p=managecities&cid=' + this.value + '&sortby='+document.getElementById('orderby').value}" >
				<option  value="" >---------List by State-------------</option>
				<?php 
				 foreach($StateAbArray as $key => $val) {
					$sel = '  ';
					if ( $cid == $key ) $sel = ' Selected = "Selected" ';
					echo '<option  value="'.$key .'"  '.$sel.'  >'. $val .'</option>';
		
				 }
		  ?>
		  </select>
          </div>          </td>
  </tr>
  <tr>
  	<td colspan="5"><?php echo $_SESSION['statuss']; unset($_SESSION['statuss']);?></td>
  </tr>
  <tr>
    <td width="5%"><strong>Id</strong></td>
    <td width="25%"><strong>City</strong></td>
    <td width="25%"><strong>State</strong></td>
    <td width="15%"><strong>Action</strong></td>
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
		if(count($rec)>0)
		{
			foreach($rec as $items)
			{
				
	?>
			  <tr>
				<td><?php echo ++$i;?> </td>
				<td><?php echo $items['city'];?> </td>
				<td><?php echo $StateAbArray[$items['state']];?> </td>
<!--				<td><?php echo $items['b_count'];?> </td>
				<td><?php if($items['featured']=='1') {echo 'yes'; }else{ echo 'no';}	?> </td>	-->			
				<td valign="middle">
					<img src="images/edit.gif"  style="cursor:pointer;" title="Edit Location" onclick="document.getElementById('<?php echo $items['cityid'];?>').style.display='block'"  />	&nbsp;&nbsp;
				    <img src="images/dlt.gif"  style="cursor:pointer;" title="Delete Location" alt="Delete Location" onclick="if(confirm('Are sure you want to delete')){window.location='<?php $ruadmin ;?>process/process.php?p=delnewCity&page=<?php echo $_GET['page'];?>&state=<?php echo $items["state"]; ?>&cid=<?php echo $items["cityid"]; ?>' }"  />				</td>
		      </tr>	
			  <tr>
			   <td colspan="7"><div id="<?php echo $items['cityid'];?>" style="display:none;">
			   <form action="<?php $ruadmin ;?>process/process.php?p=editnewCity&cid=<?php echo $items['cityid'];?>&page=<?php echo $_GET['page'];?>" method="post">
			   City:&nbsp;<input  type="text" id="City" name="City"  value="<?php echo $items['city'];?>" size="30" class="text-input"/>&nbsp;
			   &nbsp;State:&nbsp;<select name="state" id="state" > 
			   <?php 
				foreach($StateAbArray as $key => $val) {
				 
					echo '	<option  value="'.$key.'" ';
					if ($items['state'] == $key ) echo '  selected="selected" ';
					echo ' >'.$StateAbArray[$key] .' </option>';
				 }
		       ?>
			   </select>
			   &nbsp;
			   <input type="submit" class="button" value="Update"  />&nbsp;<input type="button" value="Cancel" class="button" onclick="document.getElementById('<?php echo $items['cityid'];?>').style.display='none'"  />
			   </form>
				</div>			  </td> 
			  </tr>
			  
	        <?php
			}
		}
	?>	
  <tr>
    <td  colspan="5"><?php include('common/paginglayout.php');?></td>
  <tr>
</table>
	</div>
</div>	