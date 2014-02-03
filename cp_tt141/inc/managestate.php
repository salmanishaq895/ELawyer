<h3><a href="home.php">Home</a> &raquo; <a href="#" class="active">Manage State</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3> Manage State </h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
    <?php if ( isset ($_SESSION['statuss']) ) {?>
		<div class="notification information png_bg">
			<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
			<div>
				<?php echo  $_SESSION['statuss']; unset($_SESSION['statuss']); ?>
			</div>
		</div>	
   <?php } ?>	

<form action="<?php echo $ruadmin;?>process/process.php?p=addnewstate" method="post" >
<table  border="0" cellspacing="0" cellpadding="0"  style="border:1px solid #DDDDDD; ">
  <tr>
    <td  colspan="3"><strong>Add New State</strong><?php if(isset($_GET['categ'])){ echo "   &gt;&gt;  ".$_GET['categ']; }?></td>
  </tr>
  <tr>
    <td>State&nbsp;name:&nbsp;<input name="Region" type="text" id="Region"   class="text-input" />&nbsp;&nbsp;
    <input name="Code" type="hidden" id="Code" size="10"   class="text-input" /><input type="submit" name="Submit" value="Add New State" class="button" /></td>
    <td><?php echo $_SESSION['Regionerror'];unset($_SESSION['Regionerror']);?>&nbsp;<?php echo $_SESSION['Codeerror'];unset($_SESSION['Codeerror']);?></td>
  </tr>
</table>
</form>
<br>

	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="4">
		<?php 
			 $sql = "SELECT statename ,state,stateid from tt_state  ";
			 $result =@mysql_query($sql) or die ( mysql_error());
			 $total_pages = @mysql_num_rows($result);
			 echo "Total records: ".$total_pages;
		?>
		</td>
  </tr>
  <tr>
    <td width="5%"><strong>Id</strong></td>
    <td width="28%"><strong>State</strong></td>
    <td width="19%"><strong>Action</strong></td>
  </tr>
  <?php 
		 ///////////////////////////////////////////////////////////////////////////////////////
		 include('common/pagingprocess.php');
		 ///////////////////////////////////////////////////////////////////////////////////////
		 $sql .=  " order by  statename asc LIMIT ".$start.",".$limit;
		 $result = mysql_query($sql);
		 $i=$start;

		if(mysql_num_rows($result)>0)
		{
			while( $row = @mysql_fetch_array($result) )
		 	{

			?>
			
			  <tr>
				<td><?php echo ++$i; ?>  </td>
				<td><?php echo $row['statename'];?> </td>
               
               
               	
				<td>
					<img src="images/edit.gif"  style="cursor:pointer;" title="Edit Category" onclick="document.getElementById('div<?php echo $row['stateid'];?>').style.display='block'"  />	&nbsp;&nbsp;
				    <img src="images/dlt.gif"  style="cursor:pointer;" title="Delete State" alt="Delete State" onclick="if(confirm('Are sure you want to delete ')){window.location='<?php echo $ruadmin;?>process/process.php?p=delnewState&page=<?php echo $_GET['page'];?>&cid=<?php echo $row['stateid']; ?>' }"  />
				</td>
		      </tr>	
			  <tr>
			   <td colspan="4" ><div id="div<?php echo $row['stateid'];?>" style="display:none;" >
			   <form action="<?php echo $ruadmin;?>process/process.php?p=editnewState&cid=<?php echo $row['stateid'];?>&page=<?php echo $_GET['page'];?>" method="post" >
			    
                <input type="text" id="Region" name="Region"  value="<?php echo $row['statename'];?>"  class="text-input"  />
                <input type="hidden" id="Code" name="Code"  value="<?php echo $row['state'];?>"   class="text-input" />
                <input type="submit" value="Update" class="button" />&nbsp;<input type="button" value="Cancel" onclick="document.getElementById('div<?php echo $row['stateid'];?>').style.display='none'" class="button"  />
				</form>
				</div>
			  </td> 
			  </tr>
	        <?php
			}
		}
	?>	
  <tr>
    <td colspan="4"><?php include('common/paginglayout.php');?></td>
  </tr>	
</table>
</div>
</div>
