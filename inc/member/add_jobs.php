<?php 
//$sql_job	=	"select * from tt_job where userid='".$userId."'";
//$result	=	$db->get_row($sql_profile,ARRAY_A);
?>
<script type="text/javascript" src="<?php echo $ru;?>datepicker/jquery.js"></script>
<script type="text/javascript" src="<?php echo $ru;?>datepicker/date.js"></script>
<script type="text/javascript" src="<?php echo $ru;?>datepicker/jquery_002.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $ru;?>datepicker/datePicker.css" />   
          
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
  $("#expirydate").datepicker({dateFormat:'dd-mm-yy'});
});
Date.firstDayOfWeek = 0;
Date.format = 'dd-mm-yyyy';
$(function()
{
	//$('#startDate').datePicker({clickInput:true})
	//$('#expirydate').datePicker({clickInput:true})
});
function setdatevalue(pack){
	document.getElementById('startDate').value= '<?php echo date("Y-m-d")?>';
	document.getElementById('expirydate').value= pack.value;
}
</script> 
<div class="map_page_right_bar listing_right_bar">
  <div class="brued_crum_bar brued_crum_bar_c">
    <div class="listing_page_brued_crum"> <span class="brurd_curm_inner">Home > <span class="change">Account Panel > Jobs</span></span></div>
  </div>
  <form name="form1" id="form1" method="post" action="<?php echo $ru;?>process/process_jobb.php" enctype="multipart/form-data" >
    <input type="hidden" name="userId" value="<?php echo $result['userId'];?>" />
    <div class="cpanel_right_bar">
    <div class="company_detail_description"> <span class="company_detail_span">Add Jobs</span>
      <div class="cpanel_right_inner_bar_a">
        <?php if( isset($_SESSION['biz_reg_err']) ) {?>
        <div class="notification error png_bg" style="margin:15px 0; background-color:#E4E4E4"> <a href="javascript:;" onclick="$('.notification').hide();" class="close"><img src="<?php echo $ru;?>images/cross_grey_small.png" title="Close this notification" alt="close" /></a>
          <div>
            <?php //echo $_SESSION['update_profile']; 
			foreach ($_SESSION['biz_reg_err'] as $ek=>$ev ) echo $ev ."<br />"; ?>
          </div>
        </div>
        <?php }  unset ($_SESSION['biz_reg_err']);  ?>
        <div class="input_flied">
          <div>Jop Name <samp>* </samp></div>
          <input name="name" id="name" type="text" value="<?php echo $_SESSION['biz_reg']['name']; ?>" class="text-input" border="0" />
        </div>
		  
        <div class="input_flied">
          <div>Attachment</div>
          <input  name="logo" id="logo" type="file"  class="text-input" />
        </div>
        <div class="input_flied">
          <div>Description<samp>* </samp></div>
          <textarea name="description" id="description" rows="4" cols="72" type="text" class="text-input medium-input"><?php echo $_SESSION['biz_reg']['description']; ?></textarea>
        </div>
		
		
        <div class="input_flied">
          <div>Job Category: <samp>* </samp></div>
          <select name="industry" id="industry" class="text-input small-input">
			<?php 
			$prodcts ="SELECT * FROM `tt_category` WHERE `p_catid` = 0 AND `cat_type` = '1' ORDER BY cat_name ASC";
			$prodctsRS = mysql_query($prodcts);
			$curmcatName = '';
			while ($prodctsRow = mysql_fetch_array($prodctsRS))
			{
				if(empty($curmcatName) and empty($_SESSION['biz_reg']['cat_name']))
					$curmcatName = $prodctsRow['cat_name'];
				elseif(empty($curmcatName))
					$curmcatName = $_SESSION['biz_reg']['cat_name'];
				echo "<option  value='".$prodctsRow['cat_name']."'";
				if($_SESSION['biz_reg']['category']==$prodctsRow['cat_name']) echo "selected='selected'"; echo " >".$prodctsRow['cat_name']."</option>";
			}							
			?>
			 </select>
        </div>
		
		
		<div class="input_flied">
          <div>Sub Category:<samp>* </samp></div>
		  	<select name="sub_cat" id="sub_cat" style="width:250px;">
              <?php 
				$sql_m_cat = "SELECT * FROM `tt_category` WHERE `cat_name` = '" . addslashes($curmcatName) . "' AND `cat_type` = '1' ORDER BY cat_name ASC ";
				$res_m_cat = @mysql_query($sql_m_cat);
				$result_m_cat = mysql_fetch_array($res_m_cat);
				
				$sql = "SELECT * FROM `tt_category` WHERE `p_catid` = '".$result_m_cat['catid']."' AND `cat_type` = '1' ORDER BY cat_name ASC ";
				$result = @mysql_query($sql);
				while($row = mysql_fetch_array( $result ) ){
					echo "<option  value='".$row['cat_name']."'";
					//if(in_array($row['catid'],$subcates_arr)) { echo "selected='selected'";} echo " >".$row['cat_name']."</option>";
					if( $_SESSION['biz_reg']['subcategory'] == $row['cat_name']) { echo "selected='selected'";} echo " >".$row['cat_name']."</option>";
				}
				?>
            </select>
			</div>
			
		 <script>
		  	$(function(){
			  $("select#industry").change(function(){
				$.getJSON("<?php echo $ru; ?>process/select-cat2.php",{mcatName: $(this).val()}, function(j){
				  var options = '';
					for (var i = 0; i < j.length; i++) {
					  options += '<option value="' + j[i].optionDisplay + '">' + j[i].optionDisplay + '</option>';
					}
					$("#sub_cat").html(options);
					$('#sub_cat option:first').attr('selected', 'selected');
				})
			  })
			  
		  })
		  </script>
		<div class="input_flied">
          <div>Zip/Postal code <samp>* </samp></div>
<input name="zip" id="zip" maxlength="5" type="text" class="text-input small-input" value="<?php echo $_SESSION['biz_reg']['zip']; ?>" />        </div>
		
		<div class="input_flied">
          <div>Keywords: <samp>* </samp></div>
<input name="keywords" id="keywords" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['keywords']; ?>" />        </div>
		
		
		<div class="input_flied">
          <div>Keywords: </div>

                            <select name="status" id="status" class="text-input small-input">
                            	<option value="1" <?php if( $_SESSION['biz_reg']['status'] == '1'){ ?> selected="selected" <?php } ?>>Active</option>
                            	<option value="0" <?php if( $_SESSION['biz_reg']['status'] == '0'){ ?> selected="selected" <?php } ?>>Pending</option>
                            	<option value="-1" <?php if( $_SESSION['biz_reg']['status'] == '-1'){ ?> selected="selected" <?php } ?>>Expired</option>								
                            </select> </div>
							
							<div class="input_flied">
          <div>Expiry Date: </div>
<input name="expirydate" id="expirydate" type="text" class="text-input small-input" value="<?php echo date('d-m-Y',mktime(0, 0, 0, date('m')+1, date('d'), date('Y')));?>" /> </div>
		
		
		
		<div class="profile_botton_outer">
          <div class="contact_us_gray_botton_inner cpanel_right_botton_button">
            <input type="submit" name="Insert_Job" id="Insert_Job" value="Save" class="inner_gray_botton" />
          </div>
        </div>
      </div>
    </div>
	</div>
  </form>
</div>
