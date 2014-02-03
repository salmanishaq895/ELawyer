<?php
ignore_user_abort(true);
set_time_limit(0);
$msg = '';
$tablereporting = '';



if( isset ( $_POST['Submit'] ))	{
	
		
		$uploadedFile = $_FILES['uploadedfile']['tmp_name'];
		$filename = "businessdata-".date('ymdihs').".csv";	 
		if (DIRECTORY_SEPARATOR=='/')
		  $target_path = dirname(__FILE__).'/uploads/'.$filename;
		else
		  $target_path = str_replace('\\', '/', dirname(__FILE__)).'/uploads/'.$filename; 
		
	   $target_path = $target_path . basename($_FILES['uploadedfile']['name']); 
		if(move_uploaded_file($uploadedFile, $target_path)) {
			
			@chmod($target_path, 0777);
			$msg = "The file ".  basename( $_FILES['uploadedfile']['name']). " has been imported";
			
			 $insQry ='load data local infile \''.$target_path.'\' into table tt_business
						fields terminated by \',\'
						enclosed by \'"\'
						lines terminated by \'\n\'  IGNORE 1 LINES (`name`,`address`, `city`, `state`, `zip`,`phone`,`phone2`, `website`, `email`, `btype`,`description`,`dated`)';
	
			mysql_query($insQry)or die (mysql_error());
			$_SESSION['statuss']='Data import feed successfully processed';
			
		} else{
		   $_SESSION['statuss'] = "There was an error uploading the file, please try again!";
		}
	
}
/*
insert into `products_description`(products_id,products_name,products_description) (select que_id, PARTNUMBER,DESCRIPTION from products_preimports);
*/
?>
<h3><a href="#">Home</a> &raquo; <a href="#" class="active">Unregisterd Compnay Data Import</a></h3>
<div class="content-box">
	<div class="content-box-header">
		<h3>Unregisterd Compnay Data Import</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
	<?php if ( isset ($_SESSION['statuss']) ) {?>
		<div class="notification error png_bg">
			<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
			<div>
				<?php echo  $_SESSION['statuss']; unset($_SESSION['statuss']); ?>
			</div>
		</div>	
	<?php } ?>	

	  <form enctype="multipart/form-data" action="<?php echo 'home.php?p=datafeed' ?>" method="POST">
		  <table border="0" cellpadding="0" cellspacing="0" width="100%">
			 <tr>
				<td> <a href="sample.csv">Click Here to download sample data import format</a></td>
			  </tr>
			  <tr>
				<td>&nbsp;<input type="hidden" name="MAX_FILE_SIZE" value="1073741824" /></td>
			  </tr>
			 
			  <tr>
				<td>Choose a file to upload:&nbsp;<input name="uploadedfile" type="file" />&nbsp;<input type="submit" class="button" name="Submit"  value="Upload File" /></td>
			  </tr>		
			  <tr>
				<td>Note: number of column and sequence should be same like given in sample file</td>
			  </tr>	
			  <tr>
				<td>&nbsp;</td>
			  </tr>																			  
		  </table>
	  </form>

	</div>
</div>	
												  