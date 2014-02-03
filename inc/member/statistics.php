<?php 
$userId = $_SESSION['TTLOGINDATA']['USERID'];
/*$sql_profile = "select * from tt_user where userId='".$userId."'";
$result	= $db->get_row($sql_profile,ARRAY_A);*/
?>
<script type="text/javascript" language="JavaScript" src="<?php echo $ru; ?>stats/js/AnyChart.js"></script>
<div class="map_page_right_bar listing_right_bar">
  <div class="brued_crum_bar brued_crum_bar_c">
    <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;" >Home</a> > <a href="<?php echo $ru;?>member/statistics" style="text-decoration:none; color:#999999;"> Account Panel</a> > <a href="<?php echo $ru;?>member/statistics" style="text-decoration:none; color:#999999;" > <span class="change"> Statistics</span> </a></span></div>
  </div>
  <div class="cpanel_right_bar">
    <div class="company_detail_description"> <span class="company_detail_span">Statistics</span>
      <div class="cpanel_right_inner_bar_a">
	  	<div id="sample" style="height:350px; width:670px;">
		<noscript>
			<object id="chart" name="chart" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
				<param name="movie" value="<?php echo $ru; ?>stats/swf/AnyChart.swf" />
				<param name="bgcolor" value="#FFFFFF" />
				<param name="allowScriptAccess" value="always" />
				<param name="flashvars" value="XMLFile=<?php echo $ru; ?>stats/xml/xml.php?fromDate=<?php echo $strFtime; ?>&toDate=<?php echo $strTtime; ?>" />
				<embed type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" src="<?php echo $ru; ?>mbd/stats/swf/AnyChart.swf" width="100%" height="100%" id="chart" name="chart" bgColor="#FFFFFF" allowScriptAccess="always"
				flashvars="XMLFile=<?php echo $ru; ?>stats/xml/xml.php?fromDate=<?php echo $strFtime; ?>&toDate=<?php echo $strTtime; ?>" />
			</object>				
		</noscript>
	</div>
	
	<script type="text/javascript" language="JavaScript">
		//<![CDATA[
		var chartSample = new AnyChart('<?php echo $ru; ?>stats/swf/AnyChart.swf');
		chartSample.width = '100%';
		chartSample.height = '100%';
		chartSample.setXMLFile('<?php echo $ru; ?>stats/xml/xml.php?fromDate=<?php echo $strFtime; ?>&toDate=<?php echo $strTtime; ?>&btype=<?php echo $btype; ?>');
		chartSample.write('sample');
		init();
		//]]>
	</script>
	  
	  	<?php /*
        <table cellpadding="0" cellspacing="0" >
          <tr>
            <td width="10%" style=" font-size:16px; color:#333333; margin:10px 0 0 0px; padding:43px 0 0 0px;">Number Of Visits: </td>
            <td width="50%" style=" font-size:16px; color:#333333; margin:10px 0 0 20px; padding:43px 0 0 20px;"><?php 
				$sql_business  = " select * from tt_business where userId = '".$userId."'";
				$result_business = mysql_query($sql_business);
				$row_business   = mysql_fetch_array($result_business);
				$sql_visit   = "SELECT count(Id) FROM tt_business_view WHERE bussId ='".$row_business['locationid']."'";
				$qrycounts = mysql_query($sql_visit);
				$rowcounts = mysql_fetch_array($qrycounts);
				if(count($rowcounts)>0){
					$total_pages = $rowcounts[0];
					echo $rowcounts[0];
				}
			  ?>
            </td>
          </tr>
          <tr>
            <?php 
			$sql_ratting   = "SELECT count(rating) FROM tt_business_reviews where bId = '".$row_business['locationid']."'";
			$result_ratting	=	mysql_query($sql_ratting);
			$totalRviews = mysql_num_rows($result_ratting);
			if($totalRviews>0){
				while($rs_ratting = mysql_fetch_array($result_ratting)){
			?>
            <td style=" font-size:16px; color:#333333; margin:10px 0 0 20px; padding:43px 0 0 20px;"> Rating </td>
            <td style=" font-size:16px; color:#333333; margin:10px 0 0 20px; padding:43px 0 0 20px;"><?php echo $rs_ratting[0];?> </td>
            <?php
			    }
			  }?>
          </tr>
          <?php 
			$sql_ratting   = "SELECT count(review) FROM tt_business_reviews where bId = '".$row_business['locationid']."'";
			$result_ratting	=	mysql_query($sql_ratting);
			$totalRviews = mysql_num_rows($result_ratting);
			if($totalRviews>0){
				while($rs_ratting = mysql_fetch_array($result_ratting)){
				?>
          <td style=" font-size:16px; color:#333333; margin:10px 0 0 20px; padding:43px 0 0 20px;"> Review </td>
            <td style=" font-size:16px; color:#333333; margin:10px 0 0 20px; padding:43px 0 0 20px;"><?php echo $rs_ratting[0];?> </td>
            <?php
			    }
			  }?>
          </tr>
        </table>
		*/?>
      </div>
    </div>
  </div>
</div>
