<?php   
	$subdomain_flg = false;
	if ($_SERVER['HTTP_HOST'] != 'www.tradestool.co.uk' and $_SERVER['HTTP_HOST'] != 'tradestool.co.uk')
	{
		define("DOMAIN_MAIN",'tradestool.co.uk');
		$ru_sub = "http://".DOMAIN_MAIN."/";
		$tmpDomain = str_replace(array('www.','.tradestool.co.uk','tradestool.co.uk'),'', $_SERVER['HTTP_HOST']);

		if ( $tmpDomain != ''  and $tmpDomain != DOMAIN_MAIN) 
		{
			$domainname = $tmpDomain;
			$biz_Qry ="select * from tt_business WHERE status = '1' AND sub_domain='$domainname'";
			$biz_rs = mysql_query($biz_Qry);
			if(  mysql_num_rows($biz_rs) == 0 ) {
				header('location:http://www.tradestool.co.uk/'); 
				exit;
			}else{
				$page = 'profile';
				$biz_row = mysql_fetch_array($biz_rs);
				$subdomain_flg = true;
				$rs_business   = $db->get_row($biz_Qry, ARRAY_A); 
			}
		}
	}
?>