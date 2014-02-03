<?php 
	/*$sql_CMS = "SELECT content  FROM `tblarticles`  where id ='32'";
	$query_sel_CMS = mysql_query($sql_CMS) or die(mysql_error());
	$row_CMS = mysql_fetch_array($query_sel_CMS);
	$data 	= 	$row_CMS ['content'];*/
?>
<div class="topmar40">
    <div class="listtopan">
    	<h6 class="gray">Your payment has been cancelled successfully!</h6>
        <h6>Remember you can still keep your listing up to date.</h6>
        <ul>
          <li>
            <ul>
              <li>Update your business regularly</li>
              <li>Submit News to your profile on products / services and discounts</li>
              <li>Add sales Coupons</li>
              <li>Upload Photo's</li>
              <li>Share your listing using social media and book marking</li>
            </ul>
          </li>
        </ul>
        <div class="sharelinks">
        <img src="<?php echo $ru;?>image/twiter.png" /> &nbsp; <img src="<?php echo $ru;?>image/google1.png" /> &nbsp; <img src="<?php echo $ru;?>image/facebook.png" />
        </div>
        
      </div>
     <div class="creatwelink">
     <a href="<?php echo $ru; ?>memberarea/mybusiness/">Get Started Now!</a>
     </div>
</div>
<?php /*
<table cellpadding="0" cellspacing="0" width="90%">
  <tr>
    <td colspan="2"><?php echo $data; ?></td>
  </tr>
  <tr>
    <td width="50%" align="center"><input type="button" value="Ok, Move Next Step" onClick="window.location='<?php echo $ru;?>memberarea/packages/<?php echo $_GET['o']; ?>';" style="cursor:pointer;" /></td>
    <td width="50%" align="center"><input type="button" value="Cancel" onClick="window.location='<?php echo $ru;?>memberarea/mybusiness';" style="cursor:pointer;" /></td>
  </tr>
</table>
*/?>