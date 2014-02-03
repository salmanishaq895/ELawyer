<?php
/*if(isset($_GET['advise_id'])){
	$type = $_GET['advise_id'];
}else{
	$type =1;
}

$qry="select * from tt_advise  where advise_id =".$type."";;
$rs=mysql_query($qry);
$row =mysql_fetch_array($rs);
$htmlData=$row['advise_description'];
$htmlData = $htmlData;	*/
?>
<script language="javascript" type="text/javascript">
function mailcontent()
{
	var type = document.getElementById('advise_id').value;
	window.location = "<?php echo $ruadmin; ?>home.php?p=advise_tip&advise_id="+type;
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
<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Advice & tips Sub Category Management</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Advice & tips Sub Category Management</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
	<?php if ( isset ($_SESSION['biz_reg_err']) ) {?>
					<div class="notification error png_bg">
						<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
						<div>
							<?php foreach ($_SESSION['biz_reg_err'] as $ek=>$ev ) echo $ev ."<br />"; ?>
						</div>
					</div>	
			<?php } unset ($_SESSION['biz_reg_err']);  ?>		
	<?php // echo $ruadmin; exit;?>	
<form   method="post" action="<?php echo $ruadmin; ?>process/process_advise.php" enctype="multipart/form-data">

<fieldset> 
<p> 

<label>  Select Advice Category:&nbsp;</label>
	
	
		<select class="normal" name="advise_id" id="advise_id" >
		
		<?php 
		$sqy_cat    = "select * from tt_advise where category_id = 0";
		$result_cat  = mysql_query($sqy_cat);
		while($row_cat = mysql_fetch_array($result_cat))
		{
		
		?>
			
			<option <?php if($row_cat['advise_id'] == $row_cat['advise_id']){ ?> selected="selected" <?php } ?> value="<?php echo $row_cat['advise_id'];?>"><?php echo $row_cat['advise_title'];?></option>					
		
			<?php }?>
		</select>		
		</p>
		
		<p> 
		<label> Advise Post Title:&nbsp;&nbsp;&nbsp;</label>
		<input name="advise_title" id="advise_title" type="text" class="text-input small-input"  value="<?php echo $_SESSION['biz_reg']['advise_title']; ?>" onkeyup="friendly_url_abc(this.value,100);"/>
        <p> 
		<p>
		
		<label> Seo Page Name:&nbsp;&nbsp;&nbsp;</label>
		<input name="pagename" id="pagename" type="text" class="text-input small-input"  value="<?php echo $_SESSION['biz_reg']['pagename']; ?>" onkeyup="changeg();" onkeypress="return numbersonly(this, event)"/> Only [a-z/A-Z/0-9/_ /-/] allowed
        </p>
		 <p> 
		<label> Meta Title:&nbsp;&nbsp;&nbsp;</label>
		<input name="meta_title" id="meta_title" type="text" class="text-input medium-input"  value="<?php echo $_SESSION['biz_regg']['meta_title']; ?>" />
        <p> 
		<p>
		
		<label> Meta Keyword:&nbsp;&nbsp;&nbsp;</label>
		<input name="metakeyword" id="metakeyword" type="text" class="text-input medium-input"  value="<?php echo $_SESSION['biz_regg']['meta_keyword']; ?>" > 
        </p>
		 
		 	 <p> 
		<label> Meta Description :&nbsp;&nbsp;&nbsp;</label>
				<input name="meta_desc" id="meta_desc" type="text" class="text-input large-input"  value="<?php echo $_SESSION['biz_regg']['meta_description']; ?>" > 
        <p> 
		
		 <p>
		 

<label> 	Short Description:&nbsp;&nbsp;&nbsp;</label>
	 		
			<textarea name="advise_description" id="advise_description" cols="4" rows="5" > </textarea>
			
		
	</p>
	<P>
	<input type="submit" class="button" name="Advise" value="Save">
	
	</P>
	</fieldset>
</form>
	</div>
</div>	
<?php unset($_SESSION['biz_reg']);?>        
<script type="text/javascript">
/*$("#pagename").autocomplete({
	source: "<?php echo $ruadmin; ?>process/getpage.php",
	minLength: 2
});
*/
//$("#pagename").blur(function(){

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
	




</script>
