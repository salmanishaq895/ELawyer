<?php 

$_ERR['register']['dob'] = 'Date of birth not valid.';
$_ERR['register']['sc'] = 'invalid Security Code';
$_ERR['register']['fax_number'] = 'Please enter a valid fax number.';

$_ERR['register']['emaile'] = 'The email is already in use by someone else, please try another one.';
$_ERR['register']['emailg'] = 'The email syntax is not valid.';
$_ERR['register']['email'] = 'Please enter email address';

$_ERR['register']['passc'] = 'The password confirmation is not the same as password.';
$_ERR['register']['passg'] = 'The password syntax must contain minimum 6 characters in lowercase, uppercase or numeric.';

$_ERR['register']['firstname'] = 'Please enter the first name.';
$_ERR['register']['lastname'] = 'Please enter the last name.';


$_ERR['register']['username'] = 'Username must contain 4 to 20 characters';
$_ERR['register']['userVerify'] = 'The user name already exists, please try another one.';
$_ERR['register']['message'] = 'Please enter message.';
$_ERR['register']['phone_number']= 'Please enter phone.';


$_ERR['register']['address'] = 'Please enter address.';
$_ERR['register']['city'] = 'Please enter city.';
$_ERR['register']['zip']= 'Please enter zip.';
$_ERR['register']['phone']= 'Please enter phone.';
$_ERR['register']['website']= 'Please enter website.';

function check_Name($PROFILEULR) {
  $PROFILEULR = trim($PROFILEULR); // strip any white space
  $response = array(); // our response
  // if the PROFILEULR is blank 
  if ( in_array($PROFILEULR, array ('easysite' , 'easysitecreator','blog','partners','mysql'))   ){
	$response = array(
      'ok' => false, 
      'msg' => "<font color=#C51200>The selected Domain URL is not available</font>");
  }else if (!$PROFILEULR) {
    $response = array(
      'ok' => false, 
      'msg' => "Please specify sub-domain name");
	  // if the PROFILEULR does not match a-z or '.', '-', '_' then it's not valid
  } else if (!preg_match('/^[a-z0-9]+$/', $PROFILEULR) || strlen ($PROFILEULR) < 4 || strlen ($PROFILEULR) >30 ) {
    $response = array(
      'ok' => false, 
      'msg' => "<font color=#C51200>Domain URL can only contain  4-30 alphanumerics </font>");
  // this would live in an external library just to check if the PROFILEULR is taken
  } else if (domain_taken($PROFILEULR)) {
    $response = array(
      'ok' => false, 
      'msg' => "<font color=#C51200>The selected Domain URL is not available</font>");
  // it's all good
  } else {
    $response = array(
      'ok' => true, 
      'msg' => "<font color=#C51200>This Domain URL is free</font>");
  }
  return $response;        
}

function domain_taken($PROFILEULR){
	$rsVU =mysql_query("select count(*) as uc from business where 	subdomain  like '$PROFILEULR' ");
	$rowUV = mysql_fetch_array($rsVU);
	if ( $rowUV['uc'] > 0 ) return true; else return false;
}

function PROFILEULR_taken($PROFILEULR){

	$rsVU =mysql_query("select count(*) as uc from business where 	subdomain  like '$PROFILEULR' ");
	$rowUV = mysql_fetch_array($rsVU);
	if ( $rowUV['uc'] > 0 ) return true; else return false;
}



function pageTitle ($str)
{
	if (!preg_match("#^[a-zA-Z0-9 ]+$#", $str) )
	{
		return true;
	}
}


function verify_username2 ($valoare)
{
	
	if (!preg_match("#^[a-zA-Z0-9]+$#", $valoare)  )
	{
		return true;
	}
}

function verify_username ($valoare)
{
	if (!preg_match("#^[a-zA-Z0-9]+$#", $valoare) || strlen($valoare) < 4  ||  strlen($valoare) > 20 )
	{
		return true;
	}
}

function verifypassword ($valoare)
{
	// Parola
	if ( strlen($valoare) < 6)
	{
		return true;
	}
}

function isValidURL($url)
{
return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}

function testurl ($url)
{
	// Parola
	if (eregi('^([[:alnum:]\-\.])+(\.)([[:alnum:]]){2,4}([[:alnum:]/+=%&_\.~?\-]*)$', $url))
	{
		return false;
	}
	elseif (!eregi('^([[:alnum:]\-\.])+(\.)([[:alnum:]]){2,4}([[:alnum:]/+=%&_\.~?\-]*)$',$url)){return true;}
}


$_ERR['register']['userValidate'] = 'The user name must contain minimum 4 valid characters (a-z, A-Z, 0-9, _).';


function ValidateUsername ($username)
{

	if(!preg_match("#^[a-zA-Z0-9\_]+$#", $username) || strlen($username) < 4)
	{
		return true;
	}	
}

function Validatedes($des)
{

	if(!preg_match("#^[a-zA-Z0-9\_]+$#", $des))
	{
		return true;
	}	
}


function VerifyDBUsername ($username)
{

	$rsVU =mysql_query("select count(*) as uc from user where username like '$username' ");
	if (isset($_SESSION['LOGINDATA_tmp']['USERID_tmp']))		
				$rsVU =mysql_query("select count(*) as uc from user where username like '$username' and userId <> ". $_SESSION['LOGINDATA_tmp']['USERID_tmp'] );
	$rowUV = mysql_fetch_array($rsVU);	
	if ( $rowUV['uc'] > 0 ) return true; else return false;
}

$_ERR['register']['cpname'] = 'The company name must contain minimum 2 valid characters (a-z, A-Z).';


function verifyName ($str)
{
	
	if (!preg_match("#^[a-zA-Z\s.-]+$#", $str) || strlen($str) < 2)
	{
		return true;
	}
}

function verifyName2 ($str)
{
	
	if (!preg_match("#^[a-zA-Z\s.-]+$#", $str) || strlen($str) < 2)
	{
		return true;
	}
}


function validateURL($url)
{
$pattern = '/^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&amp;?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/';
return preg_match($pattern, $url);
}
 



function blockDomain ($str)
{
	
	if (!preg_replace("#^[a-zA-Z\s.-]+$#", $str) || strlen($str) < 2)
	{
		return true;
	}
}


function verifyDomain ($str)
{
	
	if (!preg_match("#^[a-zA-Z\s.-]+$#", $str) || strlen($str) < 2)
	{
		return true;
	}
}
function VerifyDB_Domain($str)
{
	$rsVU =mysql_query("select count(*) as uc from ms_business where domain like '$str' ");
	$rowUV = mysql_fetch_array($rsVU);
	if ( $rowUV['uc'] > 0 ) return true; else return false;
	
}




function vpemail ($email)
{
	// Email
	if(!preg_match('/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9\-])*(\.[a-z0-9]{2,3})*$/i', $email) || empty($email)){

		return true;
	}
}



function reducere($text)
{
	$a = array("\r", "\t", "\n");
	$r = str_replace($a, '', $text);
	return $r;
}

// Functii pregmatch de verificare

function vState ($valoare)
{
	// Parola
	if (!preg_match("#^[0-9]+$#", $valoare) || strlen($valoare) < 5)
	{
		return true;
	}
}

function vpphone ($valoare)
{
	// Parola
	if (!preg_match("#^[0-9]+$#", $valoare)/* || strlen($valoare) < 6*/)
	{
		return true;
	}
}

function vpparolac ($valoare, $valoarec)
{
	// Parola confirmare
	if (!($valoare == $valoarec))
	{
		return true;
	}
}
function vpparolav ($tb, $valoare)
{
	// Utilizator existent
	$parolav	=	selectaren("*", $tb, "and parola = '".md5($valoare)."' and id = ".$_SESSION['sesID']);
	if ($parolav != 1)
	{
		return true;
	}
}



function vpemailc ($valoare, $valoarec)
{
	// Email confirmare
	if (!($valoare == $valoarec))
	{
		return true;
	}
}

function wordLimit($string, $length = 50, $ellipsis = '...')
{
   return count($words = preg_split('/\s+/', ltrim($string), $length + 1)) > $length ?
       rtrim(substr($string, 0, strlen($string) - strlen(end($words)))) . $ellipsis :
       $string;
}

function stringLimit($string, $length = 50, $ellipsis = '...')
{
   return strlen($fragment = substr($string, 0, $length + 1 - strlen($ellipsis))) < strlen($string) + 1 ?
       preg_replace('/\s*\S*$/', '', $fragment) . $ellipsis : $string;
}
function splitlimit($string, $length = 50, $ellipsis = '...')
{
   if (strlen($string) > $length)return substr($string, 0, $length) . ' ' . $ellipsis;
   else return $string;
}



/////////////////////////// Create File Path Function////////////////////////// 
function createpath($path)
{
		$exp=explode("/",$path);
				$way='';
				foreach($exp as $n)
				{
					
					$way.=$n;
						@mkdir($way, 0777);
						@chmod($way, 0777);
					$way.='/';
						
				}
}/// end of create path($path)
//////////////////////////////////// check image type ////////////////////////////////////
function checkimagetype($imagetype){

		$filetype = array(
		   'image/bmp', 
		   'image/gif', 
		   'image/icon', 
		   'image/jpeg',
		   'image/jpg', 
		   'image/png', 
		   'image/tiff', 
		 );
        if( in_array($imagetype,$filetype))
			return true;
		else 
			return 0;

}// end function
///////////////////////////////////////////////////////////////////////////////////////////



function getBussId()
{
	if(isset($_COOKIE['bussVarInc']))
	{
		$bussId = $_COOKIE['bussVarInc'];
		$bussId = base64_decode($bussId);
		$res = mysql_query("select count(bussId) from tbl_buss_tmp where bussId = '".$bussId."'");
		$row = mysql_fetch_array($res);
		if($row[0] == 0)
		{
			$bussId = 0;
		}
	}
	else
	{
		$bussId = 0;
	}
	return $bussId;
}

function pageTitleTop ($str)
{
	if (!preg_match("#^[a-zA-Z0-9 ]+$#", $str) )
	{
		return true;
	}
}


function fullname_validation($fname){
	$array = explode(" ",$fname);
	if(count($array) < 3 && count($array) > 0 && $fname != "")
	{
		return 'valid';
	}else{
		return 'invalid';
	}
}

function email_validation($email,$userId = 0){
	 
	 if(!preg_match('/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])*(\.([a-z0-9])([-a-z0-9_-])([a-z0-9])+)*$/i', $email)){

		return 'inavlid';
	}else{
		if($userId == 0){
			$qry_count_email = mysql_query("select count(id) from tblusers where email = '".$email."'");
		}else{
			$qry_count_email = mysql_query("select count(id) from tblusers where email = '".$email."' and id != '".$userId."'");
		}
		
		$row_count_email = mysql_fetch_array($qry_count_email);
		if($row_count_email[0] == 0)
			return 'valid';
		else
			return 'exist';
	}
}

function validate_password( $password ) {
  if(preg_match('/^[a-zA-Z0-9_]{4,50}$/', $password)) {
    return true;
  }
  return false;
}

function phone_number($Phone){

	if (!preg_match('/^[(0-9)]{5} [0-9]{3}-[0-9]{4}$/', $Phone)) return false;
	return true;
}
function phone_numberTxt($Phone){
	// Parola

	if (!preg_match('/^[(0-9)]{5} [a-zA-Z0-9]{3}-[a-zA-Z0-9]{4}$/', $Phone)) return false;
	return true;
}


function array_to_json( $array ){

    if( !is_array( $array ) ){
        return false;
    }

    $associative = count( array_diff( array_keys($array), array_keys( array_keys( $array )) ));
    if( $associative ){

        $construct = array();
        foreach( $array as $key => $value ){

            // We first copy each key/value pair into a staging array,
            // formatting each key and value properly as we go.

            // Format the key:
            if( is_numeric($key) ){
                $key = "key_$key";
            }
            $key = "\"".addslashes($key)."\"";

            // Format the value:
            if( is_array( $value )){
                $value = array_to_json( $value );
            } else if( !is_numeric( $value ) || is_string( $value ) ){
                $value = "\"".addslashes($value)."\"";
            }

            // Add to staging array:
            $construct[] = "$key: $value";
        }

        // Then we collapse the staging array into the JSON form:
        $result = "{ " . implode( ", ", $construct ) . " }";

    } else { // If the array is a vector (not associative):

        $construct = array();
        foreach( $array as $value ){

            // Format the value:
            if( is_array( $value )){
                $value = array_to_json( $value );
            } else if( !is_numeric( $value ) || is_string( $value ) ){
                $value = "'".addslashes($value)."'";
            }

            // Add to staging array:
            $construct[] = $value;
        }

        // Then we collapse the staging array into the JSON form:
        $result = "[ " . implode( ", ", $construct ) . " ]";
    }

    return $result;
}
	
	function showColorOption ($divId , $sel , $colorDemoURL,   $OrignalImage)
	{ ?>

Select Color:
<select name="colorOpt_<?php echo $divId ?>" id="colorOpt_<?php echo $divId ?>"  onchange="reloadImag('<?php echo $colorDemoURL ?>'+  this.value ,'img_<?php echo $divId ?>' ,'<?php echo $OrignalImage ?>' ,this.value)"   >
  <option <?php if ( $sel == 0 ) echo ' selected="selected" ' ?>  value="0" >Original</option>
  <option <?php if ( $sel == 1 ) echo ' selected="selected" ' ?> value="1" >Bold</option>
  <option <?php if ( $sel == 2 ) echo ' selected="selected" ' ?> value="2" >Clean</option>
  <option <?php if ( $sel == 3 ) echo ' selected="selected" ' ?> value="3" >Forest</option>
  <option <?php if ( $sel == 4 ) echo ' selected="selected" ' ?> value="4" >Desert</option>
  <option <?php if ( $sel ==  $_SESSION['biz_reg']['locationid'] ) echo ' selected="selected" ' ?> value="<?php echo $_SESSION['biz_reg']['locationid'] ?>" >Custom</option>
</select>
<?php
}
function showCategory()
{
?>
<h6>-or-</h6>
<div class="menu_bar_inner_wrapper">
  <h4>Search by <span> Categories </span> </h4>
  <div class="menu_selecter_bar_drapdownlist">
    <ul>
      <?php 
		$res_mcat = mysql_query("select * from ht_category where p_catid = 0");
		while($row_mcat = mysql_fetch_array($res_mcat))
		{
		?>
      <li onclick="catOpenClose('<?php echo $row_mcat['categoryid'];?>',this);"><?php echo $row_mcat['category'];?>
        <div></div>
      </li>
      <?php 
		$res_scat = mysql_query("select * from ht_category where p_catid ='".$row_mcat['categoryid']."'");
		if(mysql_num_rows($res_scat)>0)
		{
		?>
      <li class="sub_cat" id="sub_cat_<?php echo $row_mcat['categoryid'];?>" style="display:none;" >
        <ul>
          <?php 
				while($row_scat = mysql_fetch_array($res_scat))
				{ ?>
          <li><a href="javescript:;" onclick="return loadXMLDoc('<?php echo $row_scat['categoryid'];?>');"><?php echo $row_scat['category']; ?></a></li>
          <?php 
			  //<?php echo $ru."listing/".encodeURL(strtolower($row_scat['category'])) . '_'.$row_scat['categoryid'] 
			  
				}
				?>
        </ul>
      </li>
      <?php 
		}
			}
		?>
    </ul>
  </div>
</div>
<?php
}

function saveJob($userId,$flg){
			$addressbuss = "";
			$city  = $_SESSION['get_quote']['txt_location'];
			$postcode  = $_SESSION['get_quote']['postcode']; 
			if($city != ''){
			$addressbuss .= ", ".$city;
		}
		
		
		
		if($postcode != ''){
			$addressbuss .= ", ".$postcode;
		}

		//$addressbuss = str_replace('United States,','',$addressbuss);
		//$addressbuss = str_replace(' ','+',$addressbuss);
		
		$where = stripslashes($addressbuss);
		$whereurl = urlencode($where);
			
	
	$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$whereurl.'&sensor=false');

		$output= json_decode($geocode);
		
		$Latitude = $output->results[0]->geometry->location->lat;
		$Longitude = $output->results[0]->geometry->location->lng;
	
	
	$sql_quotes = "insert into tt_quotes set `userId` = '$userId',
			`keyword` = '" . addslashes($_SESSION['get_quote']['txt_keyword']) . "',
			`location` = '" . addslashes($_SESSION['get_quote']['txt_location']) . "',
			`post_code` = '" . addslashes($_SESSION['get_quote']['postcode']) . "',
			`miles` = '".$_SESSION['get_quote']['miles']."',
			`title` = '".$_SESSION['get_quote']['title']."',
			`message` = '".$_SESSION['get_quote']['message']."',
			`file_attechmen` = '".$_SESSION['get_quote']['attachment']."',
			`within` = '".$_SESSION['get_quote']['within']."',						
			`phone` = '".$_SESSION['get_quote']['phone']."',
			`contact_method` = '".$_SESSION['get_quote']['contact_method']."',
			`ondate` = '".$_SESSION['get_quote']['ondate']."',
			`posted_date` = '".date("Y-m-d H:i:s")."',
			`latitude` = '".$Latitude."',
			`longitude` = '".$Longitude."'";
	mysql_query($sql_quotes) or die(mysql_error());
	$quote_id = mysql_insert_id();
	
	/*Relevant Email Send*/
	$keyword = addslashes($_SESSION['get_quote']['txt_keyword']);
	$location = $_SESSION['get_quote']['txt_location'];
	$postcode = $_SESSION['get_quote']['postcode'];
	
	$qrystring = "WHERE 1=1";
	if($keyword!='' && $location!='' && $postcode!='') {
	
$qrystring .= " AND name LIKE '%$keyword%' OR (industry LIKE '%$keyword%' OR subcat LIKE '%$keyword%' OR keywords LIKE '%$keyword%') OR city LIKE '%$location%' OR zip LIKE '%$postcode%' ";	
		} else{
		
		
		}
	/*if($location!=''){
	$qrystring .= " OR city LIKE '%$location%'";	
	}
	 if($postcode!=''){
	 	$qrystring .= " OR zip LIKE '%$postcode%' ";	
	 }*/
	
	//SELECT bId, count(reviewId)  FROM `tt_business_reviews` group by bId order by bId limit 0,5
	
	
	 $sql_trade   = "SELECT * FROM tt_business $qrystring"; //exit;
	$result_trade  = mysql_query($sql_trade);
	$row_trade = mysql_num_rows($result_trade);
	//echo $row_trade; exit;
	if($row_trade>0){
	while($rss = mysql_fetch_array($result_trade))
	{
	
			
			
		 	$res_user = mysql_query("select * from `tt_user` WHERE `userId` = '".$userId."'"); 
			$row_user = mysql_fetch_array($res_user);
			
			
			
			
			$email_trade = $rss['email'];
			
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From:'.$row_user['email']. "\r\n";
			
			$msg  = "Name: ".$row_user['firstname'].' '.$row_user['lastname'];
			$msg .= '<br/>Email: '.$row_user['email'];
			$msg .= '<br/>Phone: '.$_SESSION['get_quote']['phone'];
			$msg .= '<br/>I am looking for: '.$keyword;
			$msg .= '<br/>Location: '.$location;
			$msg .= '<br/>Title: '.$_SESSION['get_quote']['title'];
			$msg .= '<br/>With In : '.$_SESSION['get_quote']['within'];
			$msg .= '<br/>Contact Me With: '.$_SESSION['get_quote']['contact_method'];
			$message = stripslashes($_SESSION['get_quote']['message']);
			$msg .= '<br/>Message:<br/>'.nl2br($message);
			$subject = "TradesTools - Contact Message from visitor";
			mail($email_trade, $subject, $msg, $headers);
	
	}
	
	}else{
	
			$stri = "";
			$qr_lat = "";
			$addressbuss = "";
			$stri .= " WHERE b.status = 1 AND b.name <> '' ";
	
			if($location != ''){
			$addressbuss .= ", ".$location;
		}
		
		
		
		if($postcode != ''){
			$addressbuss .= ", ".$postcode;
		}

		//$addressbuss = str_replace('United States,','',$addressbuss);
		//$addressbuss = str_replace(' ','+',$addressbuss);
		
		$where = stripslashes($addressbuss);
		$whereurl = urlencode($where.", UK");
			
	
	
			//$postCodeAds = urlencode(stripslashes($cityZip).", UK");
			$geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$whereurl.'&sensor=false') or die('ZAHIDFDFD');
			$output = json_decode($geocode);
			$lat = $output->results[0]->geometry->location->lat;
			$long = $output->results[0]->geometry->location->lng;
			if( !empty($lat) and !empty($long) ){
				$qr_lat .= " , ( 6371 * acos( cos( radians( {$lat} ) ) * cos( radians( b.latitude ) ) * cos( radians( b.longitude ) - radians( {$long} ) ) 
					+ sin( radians( {$lat} ) ) * sin( radians( b.latitude ) ) ) ) as radius ";
					$radd  .= "HAVING radius <= '".$_SESSION['get_quote']['miles']."'";
					}
					
					
					 $bus_query = "SELECT b.* $qr_lat FROM tt_business as b  $stri $radd";
					$bus_result = mysql_query($bus_query);
					$bus_row = mysql_num_rows($bus_result);
	//echo $row_trade; exit;
	if($bus_row>0){
	while($bus_rss = mysql_fetch_array($bus_result))
	{
	
			
			
		    $bus_user = mysql_query("select * from `tt_user` WHERE `userId` = '".$bus_rss['userId']."'");
			$bus_row_user = mysql_fetch_array($bus_user);
			
			
			
			
			$bus_email_trade = $bus_rss['email'];
			
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From:'.$bus_row_user['email']. "\r\n";
			
			$msg  = "Name: ".$bus_row_user['firstname'].' '.$bus_row_user['lastname'];
			$msg .= '<br/>Email: '.$row_user['email'];
			$msg .= '<br/>Phone: '.$_SESSION['get_quote']['phone'];
			$msg .= '<br/>I am looking for: '.$keyword;
			$msg .= '<br/>Location: '.$location;
			$msg .= '<br/>Title: '.$_SESSION['get_quote']['title'];
			$msg .= '<br/>With In : '.$_SESSION['get_quote']['within'];
			$msg .= '<br/>Contact Me With: '.$_SESSION['get_quote']['contact_method'];
			$message = stripslashes($_SESSION['get_quote']['message']);
			$msg .= '<br/>Message:<br/>'.nl2br($message);
			$subject = "TradesTools - Contact Message from visitor";
			mail($bus_email_trade, $subject, $msg, $headers);
	
			}
	
		}
	
	}
	
	/*End Relevant Eamil Send*/
	if($flg){
		//____________________________ this code is used for the email send to trader
			sendQuoteMail($quote_id);
		  }
		//}
	//}
	//_____________________________ the end of email code to send the multiple trader  
	unset($_SESSION['get_quote']);
	unset($_SESSION['quote_save_data']);
	return $quote_id;
}

function sendRelevantMail()
{



}


function sendQuoteMail($quote_id){
	$res_quote = mysql_query("select * from `tt_quotes` WHERE `quotes_id` = '$quote_id'");
	$row_quote = mysql_fetch_array($res_quote);
	
	$res_user = mysql_query("select * from `tt_user` WHERE `userId` = '".$row_quote['userId']."'");
	$row_user = mysql_fetch_array($res_user);
	
	mysql_query("UPDATE `tt_quotes` SET `mail_sent` = 'yes' WHERE `quotes_id` = '$quote_id'");
	
	
	$sql_business = "select bId, count(bId) as tot from tt_business_reviews 
			group by bId order by tot desc limit 0,5";
	$result_business  = mysql_query($sql_business);
		
	$row_business  = mysql_fetch_array($result_business);
	if(count($row_business)>0){
		foreach($row_business as $rs_business){
			$sql_email  ="SELECT * FROM tt_business WHERE status='1' AND locationid='".$rs_business['bId']."'"; 
			$result_email  = mysql_query($sql_email);
			$row_email = mysql_fetch_array($result_email);
			$email = $row_email['email'];
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From:'.$row_user['email']. "\r\n";
			
			$msg  = "Name: ".$row_user['firstname'].' '.$row_user['lastname'];
			$msg .= '<br/>Email: '.$row_user['email'];
			$msg .= '<br/>Phone: '.$row_user['phone'];
			$msg .= '<br/>I am looking for: '.$row_quote['keyword'];
			$msg .= '<br/>Location: '.$row_quote['location'];
			$msg .= '<br/>Title: '.$row_quote['title'];
			$msg .= '<br/>With In : '.$row_quote['within'];
			$msg .= '<br/>Contact Me With: '.$row_quote['contact_method'];
			$message = stripslashes($row_quote['message']);
			$msg .= '<br/>Message:<br/>'.nl2br($message);
			$subject = "TradesTools - Contact Message from visitor";
			mail($email, $subject, $msg, $headers);
		}
	}
}





function checkSwear($str){
	$str_arr = explode(' ',$str);
	if(count($str_arr)>0){
		foreach($str_arr as $st){
			$st = trim($st);
			if(!empty($st)){
				if(empty($str_qry)){
					$str_qry = " WHERE `word` LIKE '" . addslashes($st) . "'";
				}else{
					$str_qry .= " OR `word` LIKE '" . addslashes($st) . "'";
				}
			}
		}
	}
	if(strlen($str_qry)>10){
		$sql = "SELECT * FROM `tt_swear_words` $str_qry ";
		$result = @mysql_query($sql);
		if(mysql_num_rows($result) > 0 ){
			return true;
		}
	}
	return false;
}





function get_web_page( $url )
{
	$options = array(
		CURLOPT_RETURNTRANSFER => true,     // return web page
		CURLOPT_HEADER         => false,    // don't return headers
		CURLOPT_FOLLOWLOCATION => true,     // follow redirects
		CURLOPT_FILETIME	   => true,				
		CURLOPT_ENCODING       => "",       // handle all encodings
		CURLOPT_USERAGENT      => "spider", // who am i
		CURLOPT_AUTOREFERER    => true,     // set referer on redirect
		CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
		CURLOPT_TIMEOUT        => 120,      // timeout on response
		CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
	);
	
	$ch      = curl_init( $url );
	curl_setopt_array( $ch, $options );
	$content = curl_exec( $ch );
	$err     = curl_errno( $ch );
	$errmsg  = curl_error( $ch );
	$header  = curl_getinfo( $ch );

	curl_close( $ch );
	
	$header['errno']   = $err;
	$header['errmsg']  = $errmsg;
	$header['content'] = $content;
	return $header;
}
//$url = 'https://maps.googleapis.com/maps/api/place/search/json?location=' . 40.7443280 . ',' . -73.97656490 . '&radius=50&sensor=false&keyword=benjamin+restaurant&key=AIzaSyCSI6JpUyPw2_V3v5vfINqo2aXabYXTNVA';
//$content_arr = get_web_page( $url );
//echo "<pre>";
//print_r($content_arr);
//exit;







?>