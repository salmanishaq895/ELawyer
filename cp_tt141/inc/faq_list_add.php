<h3><a href="#">Home</a> &raquo; <a href="#" class="active">FAQ Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Add/Edit New FAQ</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">                
	<?php if ( isset ($_SESSION['msgText']) ) {?>
	<div class="notification error png_bg">
		<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
		<div>
			<?php echo  $_SESSION['msgText']; unset($_SESSION['msgText']); ?>
		</div>
	</div>	
	<?php } ?>	
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
	<form name="newfaq" action="<?php echo $ruadmin; ?>process/process_faq.php?p=faq_list" method="post">
		<table cellpadding="2" cellspacing="0" border="0" width="100%" id="internaltable">
			 
			</tr>
			<tr>
				<td colspan="3">
				<h2><?php echo 	$_SESSION['question'];?></h2>
				</td>
			</tr>
			<?php if(isset($editid)){
				$qry=mysql_query("select * from tt_faq where faq_id = '".$editid."'");
				$rowedit=mysql_fetch_array($qry);
				
				}
			?>
			<tr>
				<td colspan="3" width="100%">
					<table cellpadding="0" cellspacing="2" border="0" width="100%">
						
						  <?php if($_GET['questerror']!='')
						  		{ 
									$questerror=base64_decode($_GET['questerror']); ?>
								<tr>
								  <td align="right" id="txtlebel">&nbsp;</td>
								  <td id="madfield">&nbsp;</td>
								  <td align="left" class="msg"><?php echo $questerror; ?>	</td>
					  			</tr>	
						  	<?php
								 
								}
								if($_GET['anserror']!='')
						  		{ 
									$anserror=base64_decode($_GET['anserror']);
						  		?>
								<tr>
								  <td align="right" id="txtlebel">&nbsp;</td>
								  <td id="madfield">&nbsp;</td>
								  <td align="left" class="msg"><?php echo $anserror; ?>	</td>
					  			</tr>	
						  <?php }
						 ?>
						
						<tr>
							<td width="18%" align="right" id="txtlebel">
							FAQ Question							</td>
							<td width="4%" id="madfield">
								*							</td>
							<td width="78%" align="left">
								<input type="text" class="text-input" name="question" id="question" size="40" <?php if(isset($editid)){ ?>value="<?php echo $rowedit[faq_question] ?>" <?php }?> />						  </td>
						</tr>
							<tr>
							<td width="18%" align="right" id="txtlebel">
							FAQ Group Name							</td>
							<td width="4%" id="madfield">
								*							</td>
							<td width="78%" align="left">
								<select name="qgroup" id="qgroup">
									<?php $querygp="select * from tt_faq_groups";
									     $rowgp=$db->get_results($querygp,ARRAY_A);
										 if(isset($rowgp))
										 foreach($rowgp as $arrgp)
										 {
										 	if($arrgp[faqg_id]==$rowedit[faq_groupid])
											echo "<option value='$arrgp[faqg_id]' selected='selected'>$arrgp[group_title]</option>";
											else
											echo "<option value='$arrgp[faqg_id]'>$arrgp[group_title]</option>";
											
										}
									 ?>
								</select>						  </td>
						</tr>
						<tr>
							<td align="right" id="txtlebel" >
								Status							</td>
							<td id="madfield">
								*							</td>
						  <td  align="left">
								
								<input type="checkbox" name="active" value="1" id="active" <?php if($rowedit[faq_status]==1)	{ ?> checked="checked" <?php }?> />
								Active				</td>
						</tr>
						<tr>
							<td colspan="3" id="txtlebel">
								Answer
								<br>
								<span class="text-input" >
							<?php
								include("FCKeditor/fckeditor.php");
								$content = $rowedit[faq_answer];
								//FCK Editor-------------------------------
								$oFCKeditor = new FCKeditor('answer') ;
								$oFCKeditor->BasePath = 'FCKeditor/';
								$oFCKeditor->Value = $content;
								$oFCKeditor->Width  = '650' ;
								$oFCKeditor->Height = '500' ;
								$oFCKeditor->Create() ;
								//------------------------------------------
							?>
							</span>							</td>
						</tr>
						
						<tr>
							<td colspan="3" align="center">
								<?php if(isset($editid)) {?>
								<input type="submit" class="button" value="Update Page"  name="updatequestion" class="txtbutton"/>
								<input type="hidden" name="faqid" value="<?php echo $editid?>"   />
								<?php } else {?>
								<input type="submit" class="button" value="Add Question"  name="addquestion"  class="txtbutton"/>
								<?php }?>							</td>
						</tr>
					
					</table>
				</td>
			</tr>
		</table>
		<input type="hidden" name="userid" value="<?php echo $authauserid;?>" />
		</form>
	</div>
</div>	
        
	