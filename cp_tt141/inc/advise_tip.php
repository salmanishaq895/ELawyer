<?php
if(isset($_GET['advise_id'])){
	$type = $_GET['advise_id'];
}else{
	$type =1;
}

$qry="select * from tt_advise  where advise_id =".$type." ";;
$rs=mysql_query($qry);
$row =mysql_fetch_array($rs);
$htmlData=$row['advise_description'];
$htmlData = $htmlData;	
?>
<script language="javascript" type="text/javascript">
function mailcontent()
{
	var type = document.getElementById('advise_id').value;
	window.location = "<?php echo $ruadmin; ?>home.php?p=advise_tip&advise_id="+type;
}
</script>
<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Advice & tips Category Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Advice & tips Category Management</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
	<?php if ( isset ($_SESSION['msgText']) ) {?>
		<div class="notification error png_bg">
			<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
			<div>
				<?php echo  $_SESSION['msgText'];  ?>
			</div>
		</div>	
	<?php } unset($_SESSION['msgText']); ?>	
	<?php // echo $ruadmin; exit;?>	
<form   method="post" action="<?php echo $ruadmin; ?>process/process_advise.php" enctype="multipart/form-data">
<fieldset>
<p> 

<label>Select Advice Category:&nbsp;</label>
		<select class="normal" name="advise_id" id="advise_id" onchange="mailcontent();">	
			<option <?php if($type == "1"){ ?> selected="selected" <?php } ?> value="1">Advise And Tip 1</option>					
			<option <?php if($type == "2"){ ?> selected="selected" <?php } ?> value="2">Advise And Tip 2</option>			
			<option <?php if($type == "3"){ ?> selected="selected" <?php } ?> value="3">Advise And Tip 3</option>			
			<option <?php if($type == "4"){ ?> selected="selected" <?php } ?> value="4">Advise And Tip 4</option>
			
			
		</select>		
		</p>
		
		<P> <label> Advise Category Title:&nbsp;&nbsp;&nbsp;</label>
		<input name="advise_title" id="advise_title" type="text" class="text-input small-input"  value="<?php echo $row['advise_title']; ?>" onkeyup="friendly_url_abc(this.value,100);" />
		</P>
		
		<P><label>  Seo Page Name:&nbsp;&nbsp;&nbsp;</label>
		<input name="pagename" id="pagename" type="text" class="text-input small-input"  value="<?php echo $row['seo_page']; ?>" onkeyup="changeg();" onkeypress="return numbersonly(this, event)"/>  Only [a-z/A-Z/0-9/_ /-/] allowed
        </P>
		
		
				 <p> 
		<label> Meta Title:&nbsp;&nbsp;&nbsp;</label>
		<input name="meta_title" id="meta_title" type="text" class="text-input medium-input"  value="<?php echo $row['meta_title']; ?>"  />
        <p> 
		<p>
		
		<label> Meta Keyword:&nbsp;&nbsp;&nbsp;</label>
		<input name="metakeyword" id="metakeyword" type="text" class="text-input medium-input"  value="<?php echo $row['meta_keyword']; ?>" > 
        </p>
		 
		 	 <p> 
		<label> Meta Description :&nbsp;&nbsp;&nbsp;</label>
				<input name="meta_desc" id="meta_desc" type="text" class="text-input large-input"  value="<?php echo $row['meta_description']; ?>" > 
        </p> 
		
		
		
		
		<p> 
		<label> Category Short Description:&nbsp;&nbsp;&nbsp;</label>
		<input name="advise_short_description" id="advise_short_description" type="text" class="text-input medium-input"  value="<?php echo $row['advise_short_description']; ?>" />
		</p>
		
		<p> <label>  Advise Category Image:&nbsp;&nbsp;&nbsp;</label>
		<input name="advise_image" id="advise_image" type="file" class="text-input small-input" /></p>
		<?php if($row['advise_image']!=""){ ?>	
		<img src="<?php echo $ru."media/advise_image/".$row['advise_id']."/".$row['advise_image'];?>" height="100" width="100" />
		<?php }?>
        <p> <input type="submit" class="button" name="SaveTextAdvise" value="Update"></p>
	
	</fieldset>
</form>
	</div>
</div>	        

<script type="text/javascript"> 
function changeg(){
var k = document.getElementById('pagename');
//var key=$("#pagename").val();

    keys=k.value.replace(" ","_");
    
	var wcount = keys.split(' ').length;
	//alert(wcount);
	for(var i=0;i<wcount;i++)
	{
	keys=k.value.replace(" ","_");
	}
	//$("#pagename").val(keys);
	k.value= keys;
	}



function numbersonly(myfield, e, dec)
	
			{
		
					var key;
					var keychar;
					if (window.event)
					   key = window.event.keyCode;
					else if (e)
					   key = e.which;
					else
				
					   return true;
				
					keychar = String.fromCharCode(key);
					
					// control keys
				
					if ((key==null) || (key==0) || (key==8) || 
						(key==9) || (key==13) || (key==27) )
					   return true;
					// numbers
					else if ((("abcdefghijklmnopqrstuvwxyzABCDEFHGIJKLMNOPQRSTUVWXYZ-_0123456789").indexOf(keychar) > -1))
					   return true;
					/*decimal point jump
					else if (dec && (keychar == "."))
					   {
					   myfield.form.elements[dec].focus();
					   return false;
				
					   }*/
				
					else
					   return false;
		}




function friendly_url_abc(str,max_val) {
  if (max_val === undefined) max_val = 32;
  var a_chars = new Array(
    new Array("a",/[·‡‚„™¡¿¬√]/g),
    new Array("e",/[ÈËÍ…» ]/g),
    new Array("i",/[ÌÏÓÕÃŒ]/g),
    new Array("o",/[ÚÛÙı∫”“‘’]/g),
    new Array("u",/[˙˘˚⁄Ÿ€]/g),
    new Array("c",/[Á«]/g),
    new Array("n",/[—Ò]/g)
  );
  // Replace vowel with accent without them
  for(var i=0;i<a_chars.length;i++)
    str = str.replace(a_chars[i][1],a_chars[i][0]);
  // first replace whitespace by -, second remove repeated - by just one, third turn in low case the chars,
  // fourth delete all chars which are not between a-z or 0-9, fifth trim the string and
  // the last step truncate the string to 32 chars
  var str_val =  str.replace(/\s+/g,'-').toLowerCase().replace(/[^a-z0-9\-]/g, '').replace(/\-{2,}/g,'-').replace(/(^\s*)|(\s*$)/g, '').substr(0,max_val);
  
     $("#pagename").val(str_val);
	 return true;
}

</script>