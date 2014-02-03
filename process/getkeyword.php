<?php 
include("../connect/connect.php");
if(isset($_GET["term"]))
	$q = strtolower($_GET["term"]);
if (!$q) return; 
$result = array();
//$sql = "SELECT * from `tt_category` WHERE `b_count` > 0 AND `cat_name` like '%".$q."%' and cat_type = '1' order by `b_count` DESC LIMIT 0,9";

$sql = "SELECT * from `tt_category` WHERE `cat_name` like '%".$q."%' and cat_type = '1' order by `b_count` DESC LIMIT 0,9";

//echo $sql;exit;
$dataCity = @mysql_query($sql);
if( mysql_num_rows($dataCity ) == 0 ) return;
	while ($cityRow = mysql_fetch_array($dataCity )) 
	{
		array_push($result, array("id"=>$cityRow['cat_name']  , "label"=>$cityRow['cat_name'], "value" => strip_tags($cityRow['cat_name'])));
		if (count($result) > 11)
		break;
	}
	echo json_encode($result);
exit;
/*
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
}*/
?>