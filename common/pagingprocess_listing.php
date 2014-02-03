<?php
$adjacents = 3;
$limit =  6;

$targetpage = $ru.$page."/";
if($s!=''){ $targetpage .= $s."/"; } else{ $targetpage .= "all/"; }
if($o!=''){ $targetpage .= $o."/"; } else{ $targetpage .= "all/"; }
//if($p!=''){ $targetpage .= $p."/"; }
$arr_p = explode('-',$p);
$arr_q = explode('-',$q);
$arr_r = explode('-',$r);

if($arr_p[0] == 'page'){
	$targetpage .= "page-";
	$page_num = end($arr_p);
}elseif($arr_q[0] == 'page'){
	$targetpage .= $p."/page-";
	$page_num = end($arr_q);
}elseif($arr_r[0] == 'page'){
	$targetpage .= $p.'/'.$q."/page-";
	$page_num = end($arr_r);
}else{
	if(!empty($p))
		$targetpage .= $p.'/';
	if(!empty($q))
		$targetpage .= $q.'/';
	if(!empty($r))
		$targetpage .= $r.'/';
	$targetpage .= 'page-';
}

if($page_num>0)
{
	$start = ($page_num - 1) * $limit; 			//first item to display on this page
}
else
{
	$start = 0;								//if no page var is given, set start to 0
}

if ($page_num == 0) $page_num = 1;
$prev = $page_num - 1;
$next = $page_num + 1;
$lastpage = ceil($total_pages/$limit);
$lpm1 = $lastpage - 1;
?>