<?php   //echo '<pre>';print_r($_SESSION);
	     $bizId = $_GET['bId'];
		$ru = "http://".$_SERVER['HTTP_HOST']."/";
		
		if( isset ( $_POST['Submit'] )){

			unset($_SESSION['biz_ref']);
			
			foreach ($_POST as $k => $v ){
				$$k =  addslashes(trim($v ));
				$_SESSION['biz_ref'][$k]=$v;
			}
					
						$SQL_act = "SELECT name,ranking1,ranking2,ranking3,ranking4,ranking5,ranking6 FROM tt_business  where locationid =$bizId";
						$rs_row  = $db->get_row($SQL_act, ARRAY_A);	
					
						//echo $sql = "update tt_business set ranking1 = $score1 ,ranking2 = $score2 ,ranking3 = $score3 ,ranking4 = $score4 ,ranking5 = $score5 where locationid =$bizId";
						$sql = "update tt_business set ranking1 ='".$score1."',ranking2 ='".$score2."',ranking3 ='".$score3."',ranking4 ='".$score4."',ranking5 ='".$score5."'  WHERE locationid = $bizId ";
						$db->query($sql);
				
			
			
			}
			
		
		$SQL_act = "SELECT name,ranking1,ranking2,ranking3,ranking4,ranking5,ranking6 FROM tt_business  where locationid =$bizId";
		$rs_row  = $db->get_row($SQL_act, ARRAY_A);
		$_SESSION['ref_1'] = $rs_row ;	
		

		//echo '<pre>';print_r($_REQUEST);exit;
/*if ( !isset ($_SESSION['biz_ref']['busId']) )
{
	unset($_SESSION['biz_ref']);
}*/
?>
<script type="text/javascript">
function fetchUrl(source)
{
	$('.msgcontainer').show();
	$('.msgcontainer').html('<img src="<?php echo $ru ?>images/LoadingImg.gif" />');
	$.ajax({
	   url: '<?php echo $ru; ?>ajax/'+source.replace('http://',''),
	  success: function(data) {
		$('.result').html(data);
			if(data == 'done')
			{
				$('.msgcontainer').html('Data added successfully...');
			}
			else if(data == 'error')
			{
				$('.msgcontainer').html('Error fetching URL ...');
			}
			else if(data == 'error2')
			{
				$('.msgcontainer').html('Unknown data format returned ...');
			}
			else if(data == 'error3')
			{
				$('.msgcontainer').html('Error on saving data ...');
			}
			var toPr=setInterval(function(){
				clearInterval(toPr);
				$('.msgcontainer').fadeOut("slow");
			},2000)
	  }
	});
}
</script><style type="text/css">
<!--
body,td,th {
	font-size: 56px;
}
-->
</style>
<h3><a href="<?php echo $ruadmin; ?>home.php?p=business">Company</a> &raquo; <a href="#" class="active">Add Company Reference </a>  &raquo; <a href="#" class="active"><?php echo ' '.$rs_row['name']; ?></a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3> Add Company Reference  &raquo;<?php echo $rs_row['name']; ?></h3>
		<div class="clear"></div>
		
	</div>
	<div class="content-box-content"> 
                <div id="mainbussines">
                	<form  method="post" action="#" >
                    	<fieldset>
                            <h3><font color="#A90000">Company Reference:</font></h3>
							<div class="msgcontainer">&nbsp;</div>
							<p><label>Reference Transport Reviews</label><input name="transportreviews" id="transportreviews" type="text" class="text-input medium-input"  value="<?php echo $_SESSION['biz_ref']['name']; ?>"  />
					        <input type="button" class="button" value="&nbsp;&nbsp;&nbsp;Fetch Data&nbsp;&nbsp;&nbsp;" onclick="fetchUrl('transportreviews.php?bid=<?php echo $bizId; ?>&url='+$('#transportreviews').val());"/>
						   &nbsp;&nbsp;&nbsp;Score:&nbsp;&nbsp;&nbsp; <input name="score1" id="score1" type="text" class="text-input"  value="<?php echo $_SESSION['ref_1']['ranking1']; ?>"  /></p>
                        	<div class="ref_div">Example:&nbsp;<?php echo 'http://transportreviews.com/company/[Your_comany_name].asp'; ?></div>
							<p><label>Reference Transport Rankings</label><input name="transportrankings" id="transportrankings" type="text" class="text-input medium-input"  value="<?php echo $_SESSION['biz_ref']['name']; ?>" />
					        <input type="button" class="button" value="&nbsp;&nbsp;&nbsp;Fetch Data&nbsp;&nbsp;&nbsp;"  onclick="fetchUrl('transportrankings.php?bid=<?php echo $bizId; ?>&url='+$('#transportrankings').val());" />
						   &nbsp;&nbsp;&nbsp;Score:&nbsp;&nbsp;&nbsp; <input name="score2" id="score2" type="text" class="text-input"  value="<?php echo $_SESSION['ref_1']['ranking2']; ?>"  /></p>
						   <div class="ref_div">Example:&nbsp;<?php echo 'http://www.transportrankings.com/[Your_comany_name].html'; ?></div>
							<p><label>Reference Central Dispatch</label><input name="centraldispatch" id="centraldispatch" type="text" class="text-input medium-input"  value="<?php echo $_SESSION['biz_ref']['name']; ?>" />
					        <input type="button" class="button" value="&nbsp;&nbsp;&nbsp;Fetch Data&nbsp;&nbsp;&nbsp;" onclick="fetchUrl('centraldispatch.php?bid=<?php echo $bizId; ?>&url='+$('#centraldispatch').val());" />
						   &nbsp;&nbsp;&nbsp;Score:&nbsp;&nbsp;&nbsp; <input name="score3" id="score3" type="text" class="text-input"  value="<?php echo $_SESSION['ref_1']['ranking3']; ?>"  /></p>
							<div class="ref_div">Example:&nbsp;<?php echo 'http://www.centraldispatch.com/protected/client_snapshot.htm?id=[Your_comany_Id]'; ?></div>
							<p><label>Reference BBB</label><input name="bbb" id="bbb" type="text" class="text-input medium-input"  value="<?php echo $_SESSION['biz_ref']['name']; ?>" />
					        <input type="button" class="button" value="&nbsp;&nbsp;&nbsp;Fetch Data&nbsp;&nbsp;&nbsp;" onclick="fetchUrl('bbb.php?bid=<?php echo $bizId; ?>&url='+$('#bbb').val());" />
						   &nbsp;&nbsp;&nbsp;Score:&nbsp;&nbsp;&nbsp; <input name="score4" id="score4" type="text" class="text-input"  value="<?php echo $_SESSION['ref_1']['ranking4']; ?>"  /></p>
							<div class="ref_div">Example:&nbsp;<?php echo 'http://www.bbb.org/atlanta/business-reviews/auto-transporters-and-drive-away-companies/[Your_comany_name_id]'; ?></div>
							<p><label>Reference Afmancon</label><input name="afmancon" id="afmancon" type="text" class="text-input medium-input"  value="<?php echo $_SESSION['biz_ref']['name']; ?>" />
					        <input type="button" class="button" value="&nbsp;&nbsp;&nbsp;Fetch Data&nbsp;&nbsp;&nbsp;"  onclick="fetchUrl('afmancon.php?bid=<?php echo $bizId; ?>&url='+$('#afmancon').val());"  />
						&nbsp;&nbsp;&nbsp;Score:&nbsp;&nbsp;&nbsp; <input name="score5" id="score5" type="text" class="text-input"  value="<?php echo $_SESSION['ref_1']['ranking5']; ?>"  /></p>
							<div class="ref_div">Example:&nbsp;<?php echo 'http://www.afmancon.com/agencyDetails.php?agent_id=[Your_comany_id]&specific=1010290948001.jpg'; ?></div>
						<p align="center"> <br /><input type="submit" class="button" name="Submit" value="Update Score" /></p>
						</fieldset>
                    </form>
            </div>
        </div>	
	</div>      
<?php 
	    unset($_SESSION['biz_ref_err']);
	    unset($_SESSION['biz_ref']);?>