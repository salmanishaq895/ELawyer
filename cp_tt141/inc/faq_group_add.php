<h3><a href="#">Home</a> &raquo; <a href="#" class="active">FAQ Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Add New FAQ Group</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">    
	<?php if (isset($msg)) {?>
	<div class="notification error png_bg">
		<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
		<div>
			<?php echo base64_decode($msg); ?>
		</div>
	</div>	
	<?php } ?>	            
<?php 
foreach($_POST  as $key => $value)
{
   $$key = $value;
}
foreach($_GET as $key => $value)
{
   $$key = $value;
}
?>
<form name="faq_list_add" action="<?php echo $ruadmin; ?>process/process_faq.php?p=faqgroup" method="post">
          <table cellpadding="2" cellspacing="0" border="0" width="100%" id="internaltable">
			  <?php 
			  	if(isset($editidgroup))
				{ 	
					$editidgroup = base64_decode($editidgroup);
			  	 	$qry=mysql_query("select * from tt_faq_groups where faqg_id = '".$editidgroup."'");
					$roweditg=mysql_fetch_array($qry);		
			  	}
			  ?>
			  
                  <tr>
                    <td width="18%"> FAQ Group Name: </td>
                    <td width="4%" id="madfield"> * </td>
                    <td width="78%" align="left"><input type="text" class="text-input" name="groupname" id="groupname" size="40" <?php if(isset($editidgroup)){ ?>value="<?php echo $roweditg[group_title] ?>" <?php }?> />&nbsp;<font style="color:#FF0000; font-weight:bold;"><?php echo base64_decode($grerror); ?></font>
                    </td>
                  </tr>
				  <tr>
                    <td width="18%" style="vertical-align:top;"> FAQ Group Description: </td>
                    <td width="4%" style="vertical-align:top;" id="madfield"> * </td>
                    <td width="78%" align="left"><textarea type="text" class="text-input" name="groupdesc" id="groupdesc" size="40" ><?php if(isset($editidgroup)){ echo $roweditg[group_desc]; }?></textarea>&nbsp;<font style="color:#FF0000; font-weight:bold;"><?php echo base64_decode($grerror2); ?></font>
                    </td>
                  </tr>
                  <tr>
                    <td width="18%" align="right" id="txtlebel"> Sorting Order: </td>
                    <td width="4%" id="madfield"> * </td>
                    <td width="78%" align="left"><input type="text" size="10" class="text-input" name="sortingorder" id="sortingorder" <?php if(isset($editidgroup)){ ?>value="<?php echo $roweditg[sortorder] ?>" <?php }?> />&nbsp;<font style="color:#FF0000; font-weight:bold;"><?php echo base64_decode($sorterror); ?></font>
                    </td>
                  </tr>
                  <tr>
                    <td align="right" id="txtlebel" > Status: </td>
                    <td id="madfield"> * </td>
                    <td  align="left"><input type="checkbox" name="active" value="1" id="active" <?php if($roweditg[group_status]==1)	{ ?> checked="checked" <?php }?> />
                      Active
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center"><?php if(isset($editidgroup)) {?>
                      	<input type="submit" class="button" value="Update Group"  name="updategroup">
                     	 <input type="hidden" name="faqgid" value="<?php echo $editidgroup?>"   />
                      <?php } else {?>
                      	<input type="submit" class="button" value="Add Group"  name="addgroup">
                      <?php }?>
                    </td>
                  </tr>

                </table>
          <input type="hidden" name="userid" value="<?php echo $authauserid;?>" />
        </form>
	</div>
</div>	