<?php 
include_once('connect/connect.php');
$page = 'Advocate';

include($rootpath . 'common/top.php'); 
include($rootpath . 'common/header.php');
include($rootpath . 'inc/' . $page  .'.php'); 
include($rootpath . 'common/footer.php');
?>