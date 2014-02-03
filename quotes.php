<?php 
include_once('connect/connect.php');
$page = 'quotes';

include($rootpath . 'common/top.php'); 
include($rootpath . 'common/header.php');
include($rootpath . 'inc/' . $page  .'.php'); 
include($rootpath . 'common/footer.php');
?>