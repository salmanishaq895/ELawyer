<?php
$_ERR['register']['dob'] = 'Date of birth not valid.';
$_ERR['register']['sc'] = 'invalid Security Code';
$_ERR['register']['fax_number'] = 'Please enter a valid fax number.';

$_ERR['register']['emaile'] = 'The email is already in use by someone else, please try another one.';
$_ERR['register']['emailg'] = 'The email syntax is not valid.';
$_ERR['register']['email'] = 'Please enter  email address';

$_ERR['register']['passc'] = 'The password confirmation is not the same as password.';
$_ERR['register']['passg'] = 'The password syntax must contain minimum 6 characters in lowercase, uppercase or numeric.';

$_ERR['register']['username'] = 'Username must contain 4 to 20 characters';
$_ERR['register']['userVerify'] = 'The user name already exists, please try another one.';
$_ERR['register']['message'] = 'Please enter message.';
$_ERR['register']['phone_number']= 'Please enter phone.';
/*	
	vschoolname($schoolname);
	vfirstnamee($firstname);
	vlastname($lastname);
	vphone($phone);
	vpropertyaddress($propertyaddress);
	vpropertycity($propertycity);
	vpropertyzip($propertyzip);
	vbankaddress($bankaddress);
	vbankcity($bankcity);
	vbankzip($bankzip);
	vloan($bankloan); 
    vssnumber($bankssnumber); 
	vreferral($referral);
	
*/
//-------------------Verification Functions--------------------------------//
//----------------School name----- ---------------//	
	function vschoolname($str)
	{  
		if($str=='')
		{  
			$_SESSION['user_reg_err']['schoolname'] = 'Please Enter valid school name.';
			return $flgs = true;
		}
	}
//----------------first namee----- ---------------//	
	function vfirstnamee($str)
	{
		if($str=='')
		{ 
			$_SESSION['user_reg_err']['firstname'] = 'The first name must contain minimum 2 valid characters (a-z, A-Z).';
			return $flgs = true;
		}
	}
//----------------Last name----- ---------------//	
	function vlastname($str)
	{
		if($str=='')
		{ 
			$_SESSION['user_reg_err']['lastname'] = 'The last name must contain minimum 2 valid characters (a-z, A-Z).';
			return $flgs = true;
		}
	}
//----------------School Grade----- ---------------//	
	function vphone($str)
	{
		if($str=='')
		{ 
			$_SESSION['user_reg_err']['phone'] = 'Please enter a valid School Grade.';
			return $flgs = true;
		}
	}
//-----------Property address ---------------//	
	function vgrade($str)
	{
		if($str=='')
		{ 
			$_SESSION['user_reg_err']['propertyaddress'] = 'Please enter a valid School Grade.';
			return $flgs = true;
		}
	}
//-----------Property City ---------------//	
	function vpropertycity($str)
	{
		if($str=='')
		{ 
			$_SESSION['user_reg_err']['propertycity'] = 'Please enter a valid Property city.';
			return $flgs = true;
		}
	}
//-----------Property zip ---------------//	
	function vpropertyzip($str)
	{
		if($str=='')
		{ 
			$_SESSION['user_reg_err']['propertyzip'] = 'Please enter a valid Property zip code.';
			return $flgs = true;
		}
	}
//-----------Bank Address ---------------//	
	function vbankaddress($str)
	{
		if($str=='')
		{ 
			$_SESSION['user_reg_err']['bankaddress'] = 'Please enter a valid Bank address.';
			return $flgs = true;
		}
	}
//-----------Bank City ---------------//	
	function vbankcity($str)
	{
		if($str=='')
		{ 
			$_SESSION['user_reg_err']['bankcity'] = 'Please enter a valid Bank city.';
			return $flgs = true;
		}
	}
//-----------Bank Zip ---------------//	
	function vbankzip($str)
	{
		if($str=='')
		{ 
			$_SESSION['user_reg_err']['bankzip'] = 'Please enter a valid Bank zip code.';
			return $flgs = true;
		}
	}
//-----------Loan ---------------//	
	function vloan($str)
	{
		if($str=='')
		{ 
			$_SESSION['user_reg_err']['bankloan'] = 'Please enter a valid Loan.';
			return $flgs = true;
		}
	}
//-----------ss number ---------------//	
	function vssnumber($str)
	{
		if($str=='')
		{ 
			$_SESSION['user_reg_err']['bankssnumber'] = 'Please enter a valid Social Security Number.';
			return $flgs = true;
		}
	}
//-----------Referral ID ---------------//	
	function vreferral($str)
	{
		if($str=='')
		{ 
			$_SESSION['user_reg_err']['referral'] = 'Please enter a valid referral ID';
			return $flgs = true;
		}
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
	if( !preg_match("#^[a-zA-Z0-9]+$#", $valoare) || (strlen($valoare) < 4)  || (strlen($valoare)> 20) )
	{
		return true;
	}
}

function verifypassword ($valoare)
{
	// Parola
	if (!preg_match("#^[a-zA-Z0-9]+$#", $valoare) || strlen($valoare) < 6)
	{
		return true;
	}
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


function VerifyDBUsername ($username)
{

	$rsVU =mysql_query("select count(*) as uc from user where username like '$username' ");
	$rowUV = mysql_fetch_array($rsVU);
	
	if ( $rowUV['uc']> 0 ) return true; else return false;
	

	
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

function blockDomain ($str)
{
	if (preg_match("/^[a-z0-9-]+$/", $str) || strlen($str) < 2)
	{
		return true;
	}
}


function verifyDomain ($str)
{
	if (!preg_match("/^[a-z0-9-]+$/", $str) || strlen($str) < 2)
	{
		return true;
	}
}
function VerifyDB_Domain($str)
{
	$rsVU = mysql_query("SELECT COUNT( * ) AS uc FROM tt_business WHERE sub_domain LIKE '$str' AND `userId` <> '".$_SESSION['TTLOGINDATA']['USERID']."' ");
	$rowUV = mysql_fetch_array($rsVU);
	if ( $rowUV['uc'] > 0 ) return true; else return false;
	
}




/*function verifyDomain ($str)
{
	
	if (!preg_match("#^[a-zA-Z\s.-]+$#", $str) || strlen($str) < 2)
	{
		return true;
	}
}
function VerifyDB_Domain($str)
{
	$rsVU =mysql_query("select count(*) as uc from auction where domain like '$str' ");
	$rowUV = mysql_fetch_array($rsVU);
	if ( $rowUV['uc']> 0 ) return true; else return false;
	
}
*/



function vpemail ($email)
{
	// Email
	if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email))
	{
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

function wordLimit($string, $length = 400)
{
   return count($words = preg_split('/\s+/', ltrim($string), $length + 1))> $length ?
       rtrim(substr($string, 0, strlen($string) - strlen(end($words)))) :
       $string;
}


function wordLimitskill($string, $length = 30)
{
   return count($words = preg_split('/\s+/', ltrim($string), $length + 1))> $length ?
       rtrim(substr($string, 0, strlen($string) - strlen(end($words)))) :
       $string;
}

function wordLimitqualificationtitle($string, $length = 50)
{
   return count($words = preg_split('/\s+/', ltrim($string), $length + 1))> $length ?
       rtrim(substr($string, 0, strlen($string) - strlen(end($words)))) :
       $string;
}

function wordLimit_keyservices($string, $length = 450)
{
   return count($words = preg_split('/\s+/', ltrim($string), $length + 1))> $length ?
       rtrim(substr($string, 0, strlen($string) - strlen(end($words)))) :
       $string;
}



function wordLimit_keytitle($string, $length = 40)
{
   return count($words = preg_split('/\s+/', ltrim($string), $length + 1))> $length ?
       rtrim(substr($string, 0, strlen($string) - strlen(end($words)))) :
       $string;
}



function stringLimit($string, $length = 50, $ellipsis = '...')
{
   return strlen($fragment = substr($string, 0, $length + 1 - strlen($ellipsis))) < strlen($string) + 1 ?
       preg_replace('/\s*\S*$/', '', $fragment) . $ellipsis : $string;
}
function splitlimit($string, $length = 50, $ellipsis = '...')
{
   if (strlen($string)> $length)return substr($string, 0, $length) . ' ' . $ellipsis;
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
$StateArray = array("Alabama" => "AL", "Alaska" => "AK", "Arizona" => "AZ", "Arkansas" => "AR", "California" => "CA", "Colorado" => "CO", "Columbia" => "DC", "Connecticut" => "CT", "Delaware" => "DE", "Florida" => "FL", "Georgia" => "GA", "Hawaii" => "HI", "Idaho" => "ID", "Illinois" => "IL", "Indiana" => "IN", "Iowa" => "IA", "Kansas" => "KS", "Kentucky" => "KY", "Louisiana" => "LA", "Maine" => "ME", "Maryland" => "MD", "Massachusetts" => "MA", "Michigan" => "MI", "Minnesota" => "MN", "Mississippi" => "MS", "Missouri" => "MO", "Montana" => "MT", "Nebraska" => "NE", "Nevada" => "NV", "New Hampshire" => "NH", "New Jersey" => "NJ", "New Mexico" => "NM", "New York" => "NY", "North Carolina" => "NC", "North Dakota" => "ND", "Ohio" => "OH", "Oklahoma" => "OK", "Oregon" => "OR", "Pennsylvania" => "PA", "Rhode Island" => "RI", "South Carolina" => "SC", "South Dakota" => "SD", "Tennessee" => "TN", "Texas" => "TX", "Utah" => "UT", "Vermont" => "VT", "Virginia" => "VA", "Washington" => "WA", "West Virginia" => "WV", "Wisconsin" => "WI", "Wyoming" => "WY");

$StateArray = array("VIC","NSW","SA","QLD","TAS","NT","WA","ACT");
	

function cleaner($url) {
  $U = explode(' ',$url);

  $W =array();
  foreach ($U as $k => $u) {
    if (stristr($u,'http') || (count(explode('.',$u)) > 1)) {
      unset($U[$k]);
      return cleaner( implode(' ',$U));
    }
  }
  return implode(' ',$U);
}
function keywor_filter($keyword){
	$keyword_arr = explode(',',$keyword);
	$keyword2='';
	if(count($keyword_arr)>0)
	{
		$i=0;
		foreach($keyword_arr as $key){
			$key = trim($key);
			if(!empty($key)){
				if(empty($keyword2)){
					$keyword2 = $key;
					$i++;
				}else{
					$keyword2 .= ','.$key;
					$i++;
				}
				if($i>=5)
					return $keyword2;
			}
		}
		return $keyword2;
	}
}


function adv_count_words($str) 
{
$words = 0;
$str = eregi_replace(" +", " ", $str);
$array = explode(" ", $str);
for($i=0;$i < count($array);$i++)
{
if (eregi("[0-9A-Za-zÀ-ÖØ-öø-ÿ]", $array[$i])) 
$words++;
}
/*if($words>=50){
return $words;
echo $word;  exit;
}else{*/
return $words;
/*echo $word;  exit;

}*/
}

function updateCatBusCount(){
	$res = mysql_query("SELECT * from `tt_category`");
	while($row = mysql_fetch_array($res)){
		if($row['cat_type'] == '1')
			$res_count = mysql_query("SELECT COUNT(locationid) AS tot FROM `tt_business` WHERE `status` = '1' AND (mcatid = '" . $row['catid'] . "' OR scatids LIKE '%," . $row['catid'] . ",%')");
		else
			$res_count = mysql_query("SELECT COUNT(locationid) AS tot FROM `tt_business` WHERE `status` = '1' AND (name LIKE '%" . $row['cat_name'] . "%' 
				OR keywords LIKE '" . $row['cat_name'] . ",%'
				OR keywords LIKE '%," . $row['cat_name'] . ",%'
				OR keywords LIKE '%," . $row['cat_name'] . "'
				OR keywords LIKE '%" . $row['cat_name'] . "')
				");
		$row_count = mysql_fetch_array($res_count);
		mysql_query("UPDATE `tt_category` SET `b_count` = " . $row_count[0] . " WHERE `catid` = ".$row['catid']);
	}
}
function updatePhotoCount($bussId){
	$res = mysql_query("SELECT COUNT(id) FROM `tt_business_photo` WHERE `bId` = '$bussId'");
	$row = mysql_fetch_array($res);
	mysql_query("UPDATE `tt_business` SET `photoCount` = ".$row[0]." WHERE `locationid` = ".$bussId."");
}
function checkSwear($str){
	$str_arr = explode(' ',$str);
	if(count($str_arr)>0){
		foreach($str_arr as $st){
			$st = trim($st);
			if(!empty($st)){
				if(empty($str_qry)){
					$str_qry = " WHERE `word` LIKE '$st'";
				}else{
					$str_qry .= " OR `word` LIKE '$st'";
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
?>