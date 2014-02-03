<?php 
include_once('connect/connect.php');
unset($_SESSION['TTLOGINDATA']['USERID']);
unset($_SESSION['TTLOGINDATA']);
session_destroy();
header('location:'.$ru); exit;
?>