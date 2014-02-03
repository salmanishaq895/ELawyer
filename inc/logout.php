<?php //echo '<pre>';print_r($_SESSION); exit; 
include("../connect/connect.php");
unset($_SESSION['TTLOGINDATA']['USERID']);
unset($_SESSION['TTLOGINDATA']);
session_destroy();
header('location:'.$ru); exit;
?>