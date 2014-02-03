<?php
include"connect/connect.php";
/*$host="localhost"; // Host name 
$username=""; // Mysql username 
$password=""; // Mysql password 
$db_name="test"; // Database name 
$tbl_name="test_mysql"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");*/

$sql="SELECT * FROM tt_business";
$result=mysql_query($sql);

$count=mysql_num_rows($result);

?>
<table width="400" border="0" cellspacing="1" cellpadding="0">
<tr>
<td><form name="form1" method="post" action="">
<table width="400" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<td bgcolor="#FFFFFF">&nbsp;</td>
<td colspan="4" bgcolor="#FFFFFF"><strong>Delete multiple rows in mysql</strong> </td>
</tr>
<tr>
<td align="center" bgcolor="#FFFFFF">#</td>
<td align="center" bgcolor="#FFFFFF"><strong>Id</strong></td>
<td align="center" bgcolor="#FFFFFF"><strong>Name</strong></td>
<td align="center" bgcolor="#FFFFFF"><strong>Address</strong></td>
<td align="center" bgcolor="#FFFFFF"><strong>Email</strong></td>
</tr>
<?php
while($rows=mysql_fetch_array($result)){
?>
<tr>
<td align="center" bgcolor="#FFFFFF"><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<? echo $rows['locationid']; ?>"></td>
<td bgcolor="#FFFFFF"><? echo $rows['locationid']; ?></td>
<td bgcolor="#FFFFFF"><? echo $rows['name']; ?></td>
<td bgcolor="#FFFFFF"><? echo $rows['address']; ?></td>
<td bgcolor="#FFFFFF"><? echo $rows['email']; ?></td>
</tr>
<?php
}
?>
<tr>
<td colspan="5" align="center" bgcolor="#FFFFFF"><input name="delete" type="submit" id="delete" value="Delete"></td>
</tr>
<?
// Check if delete button active, start this 
if(isset($_POST['delete'])){
$checkbox = $_POST['checkbox'];
$check  = count($checkbox);
echo $check; exit;
for($i=0;$i<$count;$i++){

$del_id = $checkbox[$i];
$sql = "DELETE FROM tt_business WHERE locationid='$del_id'";
$result = mysql_query($sql);
}

// if successful redirect to delete_multiple.php 

}
mysql_close();
?>
</table>
</form>
</td>
</tr>
</table>