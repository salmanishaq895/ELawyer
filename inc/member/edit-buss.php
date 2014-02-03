 <?php //echo '<pre>'; print_r($_GET);exit;
if ( isset($_GET['o']) and $_GET['o'] != '')
{ 
	$ruadmins = $_SERVER['HTTP_REFERER'];
	$bId = $_GET['o'];
	$business_qry = "SELECT * FROM ht_business where locationid = $bId";
	$business_rs = mysql_query($business_qry) or die (mysql_error());
	$buiness_row = mysql_fetch_array($business_rs);
	$_SESSION['biz_reg'] = $buiness_row;
}
?>
<script type="text/javascript" >  

function ShowHide(divId)
{

document.getElementById(divId).style.display='none';
}

function Show(divId)
{
if(document.getElementById(divId).style.display == 'none')
{
document.getElementById(divId).style.display='block';
}else{
document.getElementById(divId).style.display='none';

}

}
</script>
 
 
 
 <div class="cpanel_right_bar">
            	<div class="profile_left_inner_bar_wrapper">
            		<div class="cpanel_right_top_bar">
                    	<h3>Add<span>Business </span></h3>
                       
                    </div>
                    <div class="cpane_right_inner_bar">
                    	<div class="contact_us_left_inner_bar">
						<?php if ( isset ($_SESSION['biz_reg_err']) ) {?>
    <div class="notification error png_bg"> <a href="javascript:;" onclick="$('.notification').hide();" class="close"><img src="<?php echo $ru;?>images/cross_grey_small.png" title="Close this notification" alt="close" /></a>
      <div>
        <?php foreach ($_SESSION['biz_reg_err'] as $ek=>$ev ) echo $ev ."<br />"; ?>
      </div>
    </div>
    <?php } unset ($_SESSION['biz_reg_err']); ?>
	
	
	
		<form  method="post" action="<?php echo $ru;?>process/process_business.php" enctype="multipart/form-data">
                    <input type="hidden" name="bId" id="bId" value="<?php echo $bId ?>">
					<input type="hidden" name="bName" id="bName" value="<?php echo stripslashes($buiness_row['name']) ?>">
                    
							<p><h3><font>Basic Information:</font></h3>
							</p>					
                            <p>
							<div class="one-row topmar10">
          <div class="label">Business Name <span>* </span></div>
							<input name="name" id="name" type="text" class="text-input" value="<?php echo stripslashes($_SESSION['biz_reg']['name']); ?>" />
							</div>
							
							<div class="one-row topmar10">
				
				
				<div class="label">Business Description <span>* </span></div>
		<textarea name="description" id="description" style="width:403px !important; height:127px !important; border: 1px solid #E1E1E1;" class="text-input"><?php echo $_SESSION['biz_reg']['description']; ?></textarea>
				
			</div>
        
                          
								
								<!--CATYEGORY-->
						<div class="one-row topmar10">
          <div class="label">Select Category <span>* </span></div>
		  				<select name="Category[]" id="Category" class="select1" multiple="multiple" style="font-size:11px;width:350px;height:135px;">
                              <?php 
							$sql	=	"select * from ht_category where p_catid=0";
							$result	=  mysql_query($sql);
							 
							 while($rows = mysql_fetch_array($result))
							 {
							 	echo "<optgroup label='$rows[category]' style='font-size:12px;  font-family:Arial, Helvetica, sans-serif'>"; 
							 	$query	=	"select * from ht_category where p_catid='".$rows['categoryid']."'";
								$row	=	$db->get_results($query,ARRAY_A);
								if(count($row)>0)
								{
									foreach($row as $rs)
									{
									?>
									<option value="<?php echo $rs['categoryid'];?>" <?php if( $_SESSION['biz_reg']['categoryid'] == $rs['category']){ ?> selected="selected" <?php } ?> > <?php echo $rs['category'];?></option>
									<?php 
									}
								}
								echo "</optgroup>";
							}?>
                            </select></div>
									
							
							<!--CATEGROY-->
								
								
                            <div class="one-row topmar10">
         					<div class="label">Logo <span>* </span></div>
							<input name="logo" id="logo" type="file"   />&nbsp;&nbsp;&nbsp;(image size 200 X 100 )
							</div>
							<div class="one-row topmar10">
							<div class="label">&nbsp;</div>
                            <?php if ($buiness_row['logo']) {
								if(!empty($buiness_row['logo'])){
							?>
                            <img src="<?php echo $ru;?>media/<?php echo $buiness_row['locationid'];?>/logo/<?php echo $buiness_row['logo'] ;?>" width="200" height="100" alt="Logo" title="logo">
                            <?php }
							}
							?>
							</div>
							<!--THIS SECTION IS USED FOR THE TIME-->
							
							
							<h3 class="hb" style="margin-top:20px;"><font>Hours:</font></h3>
							
							 <div class="one-row topmar10">
          <div class="label">Sunday:</div>
            <input type="radio" name="sun_oc" id="sunday" value="1" onfocus="Show('sundaydiv');" <?php if($_SESSION['biz_reg']['sun_oc'] == '1') echo 'checked="checked"';?>/>
            Open
            <input type="radio" name="sun_oc" id="sunday" value="0"  onfocus="ShowHide('sundaydiv');" <?php if($_SESSION['biz_reg']['sun_oc'] == '0') echo 'checked="checked"';?>/>
            Closed
			<div style="margin-bottom:2px;">
				Message: <input name="sunday_msg" id="sunday_msg" style="float:none;" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['sun_msg']; ?>" />
				 	</div>
			<div class="label">&nbsp;</div>
            <div id="sundaydiv" ><strong style="margin-left:10px;">From:</strong>
            <select name="sun_frm_hr" id="sun_frm_hr" class="text-input" style="width:50px;">
              <?php for($i=0;$i<24;$i++){ ?>
              <option value="<?php echo (60*$i); ?>"
			  
			  <?php
			     $minsnf = $_SESSION['biz_reg']['sun_f']%60;
			     $hrsnf = $_SESSION['biz_reg']['sun_f']-$minsnf;
			  
			    if($hrsnf==(60*$i)){?> selected="selected"<?php }?>
			  
			  >
              <?php if($i<10) echo '0'.$i; else echo $i; ?>
              </option>
              <?php 
			}
			 ?>
            </select>
            
            :
            
            <select name="sun_frm_min" id="sun_frm_min" class="text-input" style="width:50px;">
              <?php for($i=0;$i<4;$i++){ ?>
              <option value="<?php echo (15*$i); ?>" <?php if($minsnf==(15*$i)){?> selected="selected"<?php }?>>
              <?php if($i==0) echo '00' ; else echo 15*$i; ?>
              </option>
              <?php 
			}
			 ?>
            </select>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<strong>To:</strong>  
            <select name="sun_to_hr" id="sun_to_hr" class="text-input" style="width:50px;">
              <?php for($i=0;$i<24;$i++){ ?>
              <option value="<?php echo (60*$i); ?>"
			  
			   <?php
			     $minsnt = $_SESSION['biz_reg']['sun_t']%60;
			   $hrsnt = $_SESSION['biz_reg']['sun_t']-$minsnt;
			  
			   if($hrsnt==(60*$i)){?> selected="selected"<?php }?>
			  
			  >
              <?php if($i<10) echo '0'.$i; else echo $i; ?>
              </option>
              <?php 
			}
			 ?>
            </select>
             
            :
             
            <select name="sun_to_min" id="sun_to_min" class="text-input" style="width:50px;">
              <?php for($i=0;$i<4;$i++){ ?>
              <option value="<?php echo (15*$i); ?>" <?php if($minsnt==(15*$i)){?> selected="selected"<?php }?>>
              <?php if($i==0) echo '00' ; else echo (15*$i); ?>
              </option>
              <?php 
			}
			 ?>
            </select>
          </div>
		  </div>
		<div class="one-row topmar10">
          <div class="label">Monday:</div>
            <input type="radio" name="mon_oc" id="mon_on" value="1" onfocus="Show('mondaydiv');" <?php if($_SESSION['biz_reg']['mon_oc'] == '1') echo 'checked="checked"';?> />
            Open
            <input type="radio" name="mon_oc" id="mon_off" value="0" onfocus="ShowHide('mondaydiv');" <?php if($_SESSION['biz_reg']['mon_oc'] == '0') echo 'checked="checked"';?>/>
            Closed
            <div style="margin-bottom:2px;">
				Message: <input name="monday_msg" id="monday_msg" style="float:none;" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['mon_msg']; ?>" />
		  	</div>
			<div class="label">&nbsp;</div>
			
			<div id="mondaydiv"> <strong style="margin-left:10px;">From:</strong>
            <select name="mon_frm_hr" id="mon_frm_hr" class="text-input" style="width:50px;">
              <?php for($i=0;$i<24;$i++){ ?>
              <option value="<?php echo (60*$i); ?>" <?php
			     $minmf = $_SESSION['biz_reg']['mon_f']%60;
			   $hrmf = $_SESSION['biz_reg']['mon_f']-$minmf;
			  
			   if($hrmf==(60*$i)){?> selected="selected"<?php }?>>
              <?php if($i<10) echo '0'.$i; else echo $i; ?>
			  
			  
              </option>
              <?php 
        }
         ?>
            </select>
            
            :
           
            <select name="mon_frm_min" id="mon_frm_min" class="text-input" style="width:50px;">
              <?php for($i=0;$i<4;$i++){ ?>
              <option value="<?php echo (15*$i); ?>" <?php if($minmf==(15*$i)){?> selected="selected"<?php }?>>
              <?php if($i==0) echo '00' ; else echo (15*$i); ?>
              </option>
              <?php 
			}
			 ?>
            </select>
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <strong>To:</strong>  
            <select name="mon_to_hr" id="mon_to_hr" class="text-input" style="width:50px;">
              <?php for($i=0;$i<24;$i++){ ?>
              <option value="<?php echo (60*$i); ?>"
			  <?php
			     $minmt = $_SESSION['biz_reg']['mon_t']%60;
			   $hrmt = $_SESSION['biz_reg']['mon_t']-$minmt;
			  
			   if($hrmt==(60*$i)){?> selected="selected"<?php }?>
			  
			  
			  >
              <?php if($i<10) echo '0'.$i; else echo $i; ?>
              </option>
              <?php 
			}
			 ?>
            </select>
             
            :
            
            <select name="mon_to_min" id="mon_to_min" class="text-input" style="width:50px;">
              <?php for($i=0;$i<4;$i++){ ?>
              <option value="<?php echo (15*$i); ?>" <?php if($minmt==(15*$i)){?> selected="selected"<?php }?>>
              <?php if($i==0) echo '00' ; else echo (15*$i); ?>
              </option>
              <?php 
			}
			 ?>
            </select>
          </div>
		  </div>
          
          <div class="one-row topmar10">
          <div class="label">Tuesday:</div>
            <input type="radio" name="tue_oc" id="tuesday" value="1" onfocus="Show('tuesdaydiv');" <?php if($_SESSION['biz_reg']['tue_oc'] == '1') echo 'checked="checked"';?> />
            Open
            <input type="radio" name="tue_oc" id="tuesday" value="0" onfocus="ShowHide('tuesdaydiv');" <?php if($_SESSION['biz_reg']['tue_oc'] == '0') echo 'checked="checked"';?>/>
            Closed
			<div style="margin-bottom:2px;">
				Message: <input name="tuesday_msg" id="tuesday_msg" style="float:none;" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['tue_msg']; ?>" />
		  	</div>
			<div class="label">&nbsp;</div>
            <div id="tuesdaydiv"> <strong style="margin-left:10px;">From:</strong>
            <select name="tue_frm_hr" id="tue_frm_hr" class="text-input" style="width:50px;">
              <?php for($i=0;$i<24;$i++){ ?>
              <option value="<?php echo (60*$i); ?>"
			  
			  <?php
			     $mintf = $_SESSION['biz_reg']['tue_f']%60;
			   $hrtf = $_SESSION['biz_reg']['tue_f']-$mintf;
			  
			   if($hrtf==(60*$i)){?> selected="selected"<?php }?>
			  
			  
			  >
              <?php if($i<10) echo '0'.$i; else echo $i; ?>
              </option>
              <?php 
			}
			 ?>
            </select>
             
            :
             
            <select name="tue_frm_min" id="tue_frm_min" class="text-input" style="width:50px;">
              <?php for($i=0;$i<4;$i++){ ?>
              <option value="<?php echo (15*$i); ?>" <?php if($mintf==(15*$i)){?> selected="selected"<?php }?>>
              <?php if($i==0) echo '00' ; else echo (15*$i); ?>
              </option>
              <?php 
			}
			 ?>
            </select>
           &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <strong>To:</strong> 
            <select name="tue_to_hr" id="tue_to_hr" class="text-input" style="width:50px;">
              <?php for($i=0;$i<24;$i++){ ?>
              <option value="<?php echo (60*$i); ?>" 
			  <?php
			     $mintt = $_SESSION['biz_reg']['tue_t']%60;
			   $hrtt = $_SESSION['biz_reg']['tue_t']-$mintt;
			  
			   if($hrtt==(60*$i)){?> selected="selected"<?php }?>
			  >
              <?php if($i<10) echo '0'.$i; else echo $i; ?>
              </option>
              <?php 
			}
			 ?>
            </select>
           
            :
             
            <select name="tue_to_min" id="tue_to_min" class="text-input" style="width:50px;">
              <?php for($i=0;$i<4;$i++){ ?>
              <option value="<?php echo (15*$i); ?>" <?php if($mintt==(15*$i)){?> selected="selected"<?php }?>>
              <?php if($i==0) echo '00' ; else echo (15*$i); ?>
              </option>
              <?php 
			}
			 ?>
            </select>
          </div>
		  </div>
         <div class="one-row topmar10">
          <div class="label">Wednesday:</div>
            <input type="radio" name="wed_oc" id="wednesday" value="1"  onfocus="Show('wednesdaydiv');" <?php if($_SESSION['biz_reg']['wed_oc'] == '1') echo 'checked="checked"';?>/>
            Open
            <input type="radio" name="wed_oc" id="wednesday" value="0" onfocus="ShowHide('wednesdaydiv');" <?php if($_SESSION['biz_reg']['wed_oc'] == '0') echo 'checked="checked"';?> />
            Closed
			<div style="margin-bottom:2px;">
				Message: <input name="wednesday_msg" id="wednesday_msg" style="float:none;" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['wed_msg']; ?>" />
		  	</div>
			<div class="label">&nbsp;</div>
            <div id="wednesdaydiv" > <strong style="margin-left:10px;">From:</strong>
            <select name="wed_frm_hr" id="wed_frm_hr" class="text-input" style="width:50px;">
              <?php for($i=0;$i<24;$i++){ ?>
              <option value="<?php echo ($i*60); ?>"
			  <?php
			     $minwf = $_SESSION['biz_reg']['wed_f']%60;
			   $hrwf = $_SESSION['biz_reg']['wed_f']-$minwf;
			  
			   if($hrwf==(60*$i)){?> selected="selected"<?php }?>
			  
			  >
              <?php if($i<10) echo '0'.$i; else echo $i; ?>
              </option>
              <?php 
			}
			 ?>
            </select>
             
            :
             
            <select name="wed_frm_min" id="wed_frm_min" class="text-input" style="width:50px;">
              <?php for($i=0;$i<4;$i++){ ?>
              <option value="<?php echo (15*$i); ?>" <?php if($minwf==(15*$i)){?> selected="selected"<?php }?>>
              <?php if($i==0) echo '00' ; else echo (15*$i); ?>
              </option>
              <?php 
			}
			 ?>
            </select>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;  <strong>To:</strong>  
            <select name="wed_to_hr" id="wed_to_hr" class="text-input" style="width:50px;">
              <?php for($i=0;$i<24;$i++){ ?>
              <option value="<?php echo (60*$i); ?>"  
			   <?php
			     $minwt = $_SESSION['biz_reg']['wed_t']%60;
			   $hrwt = $_SESSION['biz_reg']['wed_t']-$minwt;
			  
			   if($hrwt==(60*$i)){?> selected="selected"<?php }?>
			  >
              <?php if($i<10) echo '0'.$i; else echo $i; ?>
              </option>
              <?php 
			}
			 ?>
            </select>
            
            :
            
            <select name="wed_to_min" id="wed_to_min" class="text-input" style="width:50px;">
              <?php for($i=0;$i<4;$i++){ ?>
              <option value="<?php echo (15*$i); ?>" <?php if($minwt==(15*$i)){?> selected="selected"<?php }?>>
              <?php if($i==0) echo '00' ; else echo (15*$i); ?>
              </option>
              <?php 
			}
			 ?>
            </select>
          </div>
		  </div>
          <div class="one-row topmar10">
          <div class="label">Thursday:</div>
            <input type="radio" name="thu_oc" id="thu_on" value="1" onfocus="Show('thursdaydiv');" <?php if($_SESSION['biz_reg']['thu_oc'] == '1') echo 'checked="checked"';?> />
            Open
            <input type="radio" name="thu_oc" id="thursday" value="0" onfocus="ShowHide('thursdaydiv');" <?php if($_SESSION['biz_reg']['thu_oc'] == '0') echo 'checked="checked"';?> />
            Closed
			<div style="margin-bottom:2px;">
				Message: <input name="thursday_msg" id="thursday_msg" style="float:none;" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['thu_msg']; ?>" />
		  	</div>
			<div class="label">&nbsp;</div>
            <div id="thursdaydiv" ><strong style="margin-left:10px;">From:</strong>
            <select name="thu_frm_hr" id="thu_frm_hr" class="text-input" style="width:50px;">
              <?php for($i=0;$i<24;$i++){ ?>
              <option value="<?php echo (60*$i); ?>"
			  <?php
			     $minthf = $_SESSION['biz_reg']['thu_f']%60;
			   $hrthf = $_SESSION['biz_reg']['thu_f']-$minthf;
			  
			   if($hrthf==(60*$i)){?> selected="selected"<?php }?>
			  
			  >
              <?php if($i<10) echo '0'.$i; else echo $i; ?>
              </option>
              <?php 
			}
			 ?>
            </select>
            
            :
            
            <select name="thu_frm_min" id="thu_frm_min" class="text-input" style="width:50px;">
              <?php for($i=0;$i<4;$i++){ ?>
              <option value="<?php echo (15*$i); ?>" <?php if($minthf==(15*$i)){?> selected="selected"<?php }?>>
              <?php if($i==0) echo '00' ; else echo (15*$i); ?>
              </option>
              <?php 
			}
			 ?>
            </select>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;  <strong>To:</strong> 
            <select name="thu_to_hr" id="thu_to_hr" class="text-input" style="width:50px;">
              <?php for($i=0;$i<24;$i++){ ?>
              <option value="<?php echo (60*$i); ?>"
			  <?php
			     $mintht = $_SESSION['biz_reg']['thu_t']%60;
			   $hrtht = $_SESSION['biz_reg']['thu_t']-$mintht;
			  
			   if($hrtht==(60*$i)){?> selected="selected"<?php }?>
			  
			  >
              <?php if($i<10) echo '0'.$i; else echo $i; ?>
              </option>
              <?php 
			}
			 ?>
            </select>
             
            :
             
            <select name="thu_to_min" id="thu_to_min" class="text-input" style="width:50px;">
              <?php for($i=0;$i<4;$i++){ ?>
              <option value="<?php echo (15*$i); ?>" <?php if($mintht==(15*$i)){?> selected="selected"<?php }?>>
              <?php if($i==0) echo '00' ; else echo (15*$i); ?>
              </option>
              <?php 
			}
			 ?>
            </select>
          </div>
		  </div>
          <div class="one-row topmar10">
          <div class="label">Friday:</div>
            <input type="radio" name="fri_oc" id="friday" value="1"  onfocus="Show('fridaydiv');" <?php if($_SESSION['biz_reg']['fri_oc'] == '1') echo 'checked="checked"';?>/>
            Open
            <input type="radio" name="fri_oc" id="friday" value="0" onfocus="ShowHide('fridaydiv');" <?php if($_SESSION['biz_reg']['fri_oc'] == '0') echo 'checked="checked"';?> />
            Closed
			<div style="margin-bottom:2px;">
				Message: <input name="friday_msg" id="friday_msg" style="float:none;" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['fri_msg']; ?>" />
		  	</div>
			<div class="label">&nbsp;</div>
            <div id="fridaydiv" > <strong style="margin-left:10px;">From:</strong>
            <select name="fri_frm_hr" id="fri_frm_hr" class="text-input" style="width:50px;">
              <?php for($i=0;$i<24;$i++){ ?>
              <option value="<?php echo (60*$i); ?>"
			   <?php
			     $minff = $_SESSION['biz_reg']['fri_f']%60;
			   $hrff = $_SESSION['biz_reg']['fri_f']-$minff;
			  
			   if($hrff==(60*$i)){?> selected="selected"<?php }?>
			  
			  >
              <?php if($i<10) echo '0'.$i; else echo $i; ?>
              </option>
              <?php 
			}
			 ?>
            </select>
             
            :
            
            <select name="fri_frm_min" id="fri_frm_min" class="text-input" style="width:50px;">
              <?php for($i=0;$i<4;$i++){ ?>
              <option value="<?php echo (15*$i); ?>" <?php if($minff==(15*$i)){?> selected="selected"<?php }?>>
              <?php if($i==0) echo '00' ; else echo (15*$i); ?>
              </option>
              <?php 
			}
			 ?>
            </select>
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<strong>To:</strong>  
            <select name="fri_to_hr" id="fri_to_hr" class="text-input" style="width:50px;">
              <?php for($i=0;$i<24;$i++){ ?>
              <option value="<?php echo (60*$i); ?>"
			  <?php
			     $minft = $_SESSION['biz_reg']['fri_t']%60;
			   $hrft = $_SESSION['biz_reg']['fri_t']-$minft;
			  
			   if($hrft==(60*$i)){?> selected="selected"<?php }?>
			  
			  >
              <?php if($i<10) echo '0'.$i; else echo $i; ?>
              </option>
              <?php 
			}
			 ?>
            </select>
             
            :
             
            <select name="fri_to_min" id="fri_to_min" class="text-input" style="width:50px;">
              <?php for($i=0;$i<4;$i++){ ?>
              <option value="<?php echo (15*$i); ?>" <?php if($minft==(15*$i)){?> selected="selected"<?php }?>>
              <?php if($i==0) echo '00' ; else echo (15*$i); ?>
              </option>
              <?php 
			}
			 ?>
            </select>
          </div>
		  </div>
          <div class="one-row topmar10">
          <div class="label">Saturday:</div>
            <input type="radio" name="sat_oc" id="saturday" value="1" onfocus="Show('saturdaydiv');" <?php if($_SESSION['biz_reg']['sat_oc'] == '1') echo 'checked="checked"';?>/>
            Open
            <input type="radio" name="sat_oc" id="saturday" value="0" onfocus="ShowHide('saturdaydiv');" <?php if($_SESSION['biz_reg']['sat_oc'] == '0') echo 'checked="checked"';?> />
            Closed
			<div style="margin-bottom:2px;">
				Message: <input name="saturday_msg" id="saturday_msg" style="float:none;" type="text" class="text-input medium-input" value="<?php echo $_SESSION['biz_reg']['sat_msg']; ?>" />
		  	</div>
			<div class="label">&nbsp;</div>
            <div id="saturdaydiv" ><strong style="margin-left:10px;">From:</strong>
            <select name="sat_frm_hr" id="sat_frm_hr" class="text-input" style="width:50px;">
              <?php for($i=0;$i<24;$i++){ ?>
              <option value="<?php echo (60*$i); ?>" 
			  
			  <?php
			     $minsf = $_SESSION['biz_reg']['sat_f']%60;
			   $hrsf = $_SESSION['biz_reg']['sat_f']-$minsf;
			  
			   if($hrsf==(60*$i)){?> selected="selected"<?php }?>
			  
			  >
              <?php if($i<10) echo '0'.$i; else echo $i; ?>
              </option>
              <?php 
			}
			 ?>
            </select>
            
            :
            
            <select name="sat_frm_min" id="sat_frm_min" class="text-input" style="width:50px;">
              <?php for($i=0;$i<4;$i++){ ?>
              <option value="<?php echo (15*$i); ?>" <?php if($minsf==(15*$i)){?> selected="selected"<?php }?>>
              <?php if($i==0) echo '00' ; else echo (15*$i); ?>
              </option>
              <?php 
			}
			 ?>
            </select>
           &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <strong>To:</strong>  
            <select name="sat_to_hr" id="sat_to_hr" class="text-input" style="width:50px;">
              <?php for($i=0;$i<24;$i++){ ?>
              <option value="<?php echo (60*$i); ?>"
			  
			  <?php
			     $minst = $_SESSION['biz_reg']['sat_t']%60;
			   $hrst = $_SESSION['biz_reg']['sat_t']-$minst;
			  
			   if($hrst==(60*$i)){?> selected="selected"<?php }?>
			  
			   >
              <?php if($i<10) echo '0'.$i; else echo $i; ?>
              </option>
              <?php 
			}
			 ?>
            </select>
             
            :
             
            <select name="sat_to_min" id="sat_to_min" class="text-input" style="width:50px;">
              <?php for($i=0;$i<4;$i++){ ?>
              <option value="<?php echo (15*$i); ?>" <?php if($minst==(15*$i)){?> selected="selected"<?php }?>>
              <?php if($i==0) echo '00' ; else echo (15*$i); ?>
              </option>
              <?php 
			}
			 ?>
            </select>
          </div>
		  </div>
          		<!--END OF TIME SECTION-->
						<!--THIS SECTION IS USED FOR THE HOLIDAY-->
	      <h3><font>Holidays:</font></h3>
          <?php 
	
	$sql_holiday	=	"select * from ht_holiday";
	$row_holiday	=	$db->get_results($sql_holiday,ARRAY_A); 
	if(count($row_holiday)>0)
	{
	  foreach($row_holiday as $rs_holiday)
	  {
	  
			$sql	= "select * from ht_holiday_time where holidayid= " . $rs_holiday['holidayid'] . " and bId='".$_SESSION['biz_reg']['locationid']."'";
			$result	= mysql_query($sql);
			$total_rows = mysql_num_rows($result);
			$row	= mysql_fetch_array($result);
		?>
          <div class="one-row topmar10">
          <div class="label"> <?php echo $rs_holiday['holiday_date'];?>::<strong><?php echo $rs_holiday['holiday_title'];?></strong></div>
            <input type="radio" <?php if($row['holiday_oc'] == '1') echo 'checked="checked"'; ?> name="holiday_<?php echo $rs_holiday['holidayid'];?>" id="<?php echo $rs_holiday['holidayid'];?>" value="1" onfocus="document.getElementById('hol_hd_<?php echo $rs_holiday['holidayid'];?>').value=<?php echo $rs_holiday['holidayid'];?>;Show('div_<?php echo $rs_holiday['holidayid'];?>');" />
            Open
            <input type="radio" <?php if($row['holiday_oc'] == '0') echo 'checked="checked"'; ?> name="holiday_<?php echo $rs_holiday['holidayid'];?>" id="<?php echo $rs_holiday['holidayid'];?>" value="0"  onfocus="document.getElementById('hol_hd_<?php echo $rs_holiday['holidayid'];?>').value='';ShowHide('div_<?php echo $rs_holiday['holidayid'];?>');"/>
            Closed
            <input type="hidden" name="holidays[]" id="hol_hd_<?php echo $rs_holiday['holidayid'];?>" value="<?php echo $rs_holiday['holidayid'] ?>" />
			<div style="margin-bottom:2px;">
				Message:
            	<input type="text" style="float:none;" name="holiday_message_<?php echo $rs_holiday['holidayid'];?>" id="holiday_message_<?php echo $rs_holiday['holidayid'];?>" class="text-input" value="<?php echo trim($row['holiday_massage']);?>" />
			</div>
		<div class="label">&nbsp;</div>
          <div id="div_<?php echo $rs_holiday['holidayid'];?>" <?php if($row['holiday_oc'] == '0') echo 'style="display:none;"';?> > 
			 <strong style="margin-left:10px;">From:</strong>
            <select name="hol_frm_hr_<?php echo $rs_holiday['holidayid'];?>" id="hol_frm_hr_<?php echo $rs_holiday['holidayid'];?>" class="text-input" style="width:50px;">
            <?php 
			for($i=0;$i<24;$i++){ ?>
              <option value="<?php echo (60*$i); ?>" <?php 
			  $hf	=	$row['holiday_from']-($row['holiday_from']%60);
			  if($hf==(60*$i)) echo 'selected="selected"'; ?> ><?php if($i<10) echo '0'.$i; else echo $i; ?></option>
            <?php 
        	}
         	?>
            </select>
            
            :
            
            <select name="hol_frm_min_<?php echo $rs_holiday['holidayid'];?>" id="hol_frm_min_<?php echo $rs_holiday['holidayid'];?>" class="text-input" style="width:50px;">
              <?php for($i=0;$i<4;$i++){ ?>
				<option value="<?php echo (15*$i); ?>" <?php if(($row['holiday_from']%60)==(15*$i)){?> selected="selected"<?php }?>><?php if($i==0) echo '00' ; else echo (15*$i); ?></option>
              <?php 
				}
			 ?>
            </select>
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<strong>To:</strong> 
            <select name="hol_to_hr_<?php echo $rs_holiday['holidayid'];?>" id="hol_to_hr_<?php echo $rs_holiday['holidayid'];?>" class="text-input" style="width:50px;">
              <?php for($i=0;$i<24;$i++){ ?>
              <option value="<?php echo (60*$i); ?>" 
			 <?php
			  $mt	=	$row['holiday_to']%60;
			  $ht	=	$row['holiday_to']-$mt;
			  if($ht==(60*$i)){?> selected="selected"<?php }?>
			  
			  >
              <?php if($i<10) echo '0'.$i; else echo $i; ?>
              </option>
              <?php 
			}
			 ?>
            </select>
            
            :
             
            <select name="hol_to_min_<?php echo $rs_holiday['holidayid'];?>" id="hol_to_min_<?php echo $rs_holiday['holidayid'];?>" class="text-input" style="width:50px;">
              <?php for($i=0;$i<4;$i++){ ?>
              <option value="<?php echo (15*$i); ?>" <?php if($mt==(15*$i)){?> selected="selected"<?php }?>><?php if($i==0) echo '00' ; else echo (15*$i); ?></option>
              <?php 
			}
			 ?>
            </select>
			</div>
			<input type="hidden" name="holidaysdate_<?php echo $rs_holiday['holidayid'];?>" id="holidaysdate_<?php echo $rs_holiday['holidayid'];?>" value="<?php echo $rs_holiday['holiday_date'];?>" />
          </div>
          <?php 
	}
}
?>
         
		 <script type="text/javascript" >

function custom(divId)
{

/*var ele = document.getElementById("toggleText");
	var text = document.getElementById("displayText");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "show";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "hide";
	}*/


if(document.getElementById(divId).style.display == 'none')
{
document.getElementById(divId).style.display='block';
}else{document.getElementById(divId).style.display = 'none'}

}
</script>
<div class="one-row topmar10">
          <div  style="font-size:14px; font-weight:bold; cursor:pointer;"><a href="javascript:custom('customid');" style="text-decoration:none;"> Add Custom Day</a></div>
			<!-- THIS DIV CODE IS USED FOR THE CUSTOM DAY -->
			<?php 
	
	  
			 $sql	= "select * from ht_custom where bId='".$_SESSION['biz_reg']['locationid']."'";
		
			$result	= mysql_query($sql);
			$total_rows = mysql_num_rows($result);
			//echo $total_rows; exit;
			$row	= mysql_fetch_array($result);
		?>
     
	 <div id="customid" <?php if($row['custom_date'] == 0 AND $row['custom_f'] == 0 AND $row['custom_t'] == 0 AND $row['custom_message'] == 0) echo 'style="display:none;"';?> > 
       <!--   	<input type="radio" name="custom" id="custom" value="customon" onfocus="Show('customid');" checked="checked"/>
            Open
            <input type="radio" name="custom" id="custom" value="customoff" onfocus="ShowHide('customid');" />
            Closed
		-->	
		 <script>
		$(document).ready(function() {
			$("#custom_date").datepicker({dateFormat: "M dd yy", minDate:0});
			
		});
	  </script>
		
		<div class="input_flied">
                            	<div class="label">Date</div>
           
            <input type="text" name="custom_date" id="custom_date" class="text-input" value="<?php echo $row['custom_date'];?>" readonly=""/>
			 </div>
<br />	 

			<div class="input_flied">
                            	<div class="label">Message</div>
           
            <input type="text" name="custom_message" id="custom_message" class="text-input" value="<?php echo $row['custom_message'];?>"/>
			 </div>
			 
    <div  style="margin:41px 0 6px 172px">
		   	<input type="radio" name="custom_oc" id="custom" value="1" onfocus="Show('custom_time');" <?php if($row['custom_oc'] == '1') echo 'checked="checked"'?> />
            Open
            <input type="radio" name="custom_oc" id="custom" value="0" onfocus="ShowHide('custom_time');" <?php if($row['custom_oc'] == '0') echo 'checked="checked"'?> />
            Closed
			</div>
	<div id="custom_time" >	
		<strong style="margin-left:178px;">From:</strong>
           
			<select name="custom_frm_hr" id="custom_frm_hr" class="text-input" style="width:50px;">
            <?php 
			for($i=0;$i<24;$i++){ ?>
              <option value="<?php echo (60*$i); ?>"
			  
			  <?php 
			  $cfm = $row['custom_f']%60;
			   $cfh = $row['custom_f']-$cfm;
			  
			   if($cfh==(60*$i)){?> selected="selected"<?php }?>
			  
			   
			  ><?php if($i<10) echo '0'.$i; else echo $i; ?></option>
            <?php 
        	}
         	?>
            </select>
            
            :
            
            <select name="custom_frm_min" id="custom_frm_min" class="text-input" style="width:50px;">
              <?php for($i=0;$i<4;$i++){ ?>
				<option value="<?php echo (15*$i); ?>" <?php if($cfm==(15*$i)){?> selected="selected"<?php }?> ><?php if($i==0) echo '00' ; else echo (15*$i); ?></option>
              <?php 
				}
			 ?>
            </select>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;  <strong>To:</strong>  
            <select name="custom_to_hr" id="custom_to_hr" class="text-input" style="width:50px;">
              <?php for($i=0;$i<24;$i++){ ?>
              <option value="<?php echo (60*$i); ?>"
			  <?php 
			  $ctm = $row['custom_t']%60;
			   $cth = $row['custom_t']-$ctm;
			  
			   if($cth==(60*$i)){?> selected="selected"<?php }?>
			  
			  >
              <?php if($i<10) echo '0'.$i; else echo $i; ?>
              </option>
              <?php 
			}
			 ?>
            </select>
           
            :
           
            <select name="custom_to_min" id="custom_to_min" class="text-input" style="width:50px;">
              <?php for($i=0;$i<4;$i++){ ?>
              <option value="<?php echo (15*$i); ?>" <?php if($ctm==(15*$i)){?> selected="selected"<?php }?>><?php if($i==0) echo '00' ; else echo (15*$i); ?></option>
              <?php 
			}
			 ?>
            </select>
            </div>
	 
			<!-- THE END OF CUSTOM DAY CODE  -->
</div>
          <!--THIS SECTION IS USED FOR THE HOLIDAY-->
 <!--THIS SECTION IS USED FOR THE HOLIDAY-->
         
										<!--THIS SECTION IS USED FOR THE HOLIDAY-->
							
							
							
							
						<h3><font>Contact Information:</font></h3>
							
                           <div class="one-row topmar10">
          <div class="label">Email <span>* </span></div>
							<input name="email" id="email" type="text" class="text-input" value="<?php echo $_SESSION['biz_reg']['email']; ?>" /></div>
							<div class="one-row topmar10">
          <div class="label">Address <span>* </span></div>
							<input name="address" id="address" type="text" class="text-input" value="<?php echo stripslashes($_SESSION['biz_reg']['address']); ?>" />
							</div>
							<div class="one-row topmar10">
          <div class="label">State <span>* </span></div>
							
 							   <select name="state" id="state" class="select1">
										<?php foreach($StateAbArray as $key=>$short){	?>
										<option value="<?php echo $key; ?>" <?php if($_SESSION['biz_reg']['state'] == $key) echo 'selected="selected"'; ?>><?php echo $short; ?></option>
										<?php }	?>
							  </select>
					    </div>
							<div class="one-row topmar10">
          <div class="label">City <span>* </span></div>
							<input name="city" id="city" type="text" class="text-input" value="<?php echo $_SESSION['biz_reg']['city']; ?>" />
							</div>
							<div class="one-row topmar10">
          <div class="label">Zip Code <span>* </span></div>
							<input name="zip" id="zip"  maxlength="5" type="text" class="text-input" value="<?php echo $_SESSION['biz_reg']['zip']; ?>" />
							</div>
							<div class="one-row topmar10">
          <div class="label">Phone: (000) 000-0000 <span>* </span></div>
							<input name="phone" id="phone" type="text" class="text-input" value="<?php echo $_SESSION['biz_reg']['phone']; ?>"  onchange="validatePhone(this)"/>
							</div>
							<div class="one-row topmar10">
          <div class="label">Website</div>
							<input name="website" id="website" type="text" class="text-input" value="<?php echo $_SESSION['biz_reg']['website']; ?>" />
							</div>
							<input type="submit" class="inner_gray_botton" value="&nbsp;&nbsp;&nbsp;Update&nbsp;&nbsp;&nbsp;" name="UpdateBusiness" id="UpdateBusiness" style="margin:20px 0px 10px 313px;"/></p>
        
                    </form>
	
	
	
	
	
	
						</div>
						</div>
						</div>
						</div>
						
						<?php 
	    unset($_SESSION['biz_reg_err']);
	    unset($_SESSION['biz_reg']);?>