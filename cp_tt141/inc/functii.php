<?php

$_ERR['register']['firstname'] = 'The first name must contain minimum 2 valid characters (a-z, A-Z).';
$_ERR['register']['lastname'] = 'The last name must contain minimum 2 valid characters (a-z, A-Z).';

$_ERR['register']['dob'] = 'Date of birth not valid.';
$_ERR['register']['sc'] = 'invalid Security Code';
$_ERR['register']['phone_number'] = 'Please enter a valid phone number.';
$_ERR['register']['fax_number'] = 'Please enter a valid fax number.';

$_ERR['register']['emaile'] = 'The email is already in use by someone else, please try another one.';
$_ERR['register']['emailg'] = 'The email syntax is not valid.';
$_ERR['register']['email'] = 'Please enter  email address';


$_ERR['register']['passc'] = 'The password confirmation is not the same as password.';
$_ERR['register']['passg'] = 'The password syntax must contain minimum 6 characters in lowercase, uppercase or numeric.';

$_ERR['register']['username'] = ' must contain 4 to 20 characters in lowercase, uppercase or numeric.';
$_ERR['register']['userVerify'] = 'The Advocate name already exists, please try another one.';



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
$_ERR['register']['userValidate'] = 'The Advocate name must contain minimum 4 valid characters (a-z, A-Z, 0-9, _).';


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

function verifyDomain ($str)
{
	
	if (!preg_match("#^[a-zA-Z\s.-]+$#", $str) || strlen($str) < 2)
	{
		return true;
	}
}
function VerifyDB_Domain($str)
{
	$rsVU =mysql_query("select count(*) as uc from tt_business where sub_domain like '$str' AND `userId` <> '".$_SESSION['TTLOGINDATA']['USERID']."' ");
	$rowUV = mysql_fetch_array($rsVU);
	if ( $rowUV['uc']> 0 ) return true; else return false;
	
}




function vpemail ($valoare)
{
	// Email
	if (!ereg("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $valoare) || empty($valoare))
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

function wordLimit($string, $length = 50, $ellipsis = '...')
{
   return count($words = preg_split('/\s+/', ltrim($string), $length + 1))> $length ?
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