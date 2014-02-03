<?php 
	//echo "dddd"; exit;
	header("Content-Type: application/xml; charset=ISO-8859-1"); 
	$rsstype =  $_GET['s'];
//	echo $rsstype; exit;
	$id =  strtolower( end(explode("_",$_GET['o'])));
	$rss = new rss($rsstype,$id); 
	echo $rss->GetFeed(); 
//echo "dfsdfsd"; exit;
	class rss 
	{
		var $ru;
		var $rsstype;
		var $id;
		var $domain;
		public function rss($rsstype,$id) 
		{ 
			require_once ('../connect/connect.php'); 
			$this->ru = $ru;
			$this->rsstype = $rsstype;
			$this->id = $id;
			$this->domain = DOMAIN;
			  // Make the connnection and then select the database. 
			  $dbc = @mysql_connect (ACSQL_DB_HOST, ACSQL_DB_USER, ACSQL_DB_PASSWORD) OR die ('Could not connect to MySQL: ' . mysql_error() ); 
			  mysql_select_db (ACSQL_DB_NAME) OR die ('Could not select the database: ' . mysql_error() ); 
		} 
	 
	    public function GetFeed() 
	    { 
	       // return $this->getDetails() . $this->getItems(); 
		    return $this->getItems(); 
	    } 
	 
	    private function dbConnect() 
	    { 
	        DEFINE ('LINK', mysql_connect (ACSQL_DB_HOST, ACSQL_DB_USER, ACSQL_DB_PASSWORD)); 
	    } 
	 
	    private function getDetails() 
	    { 
	        $detailsTable = "tbl_products"; 
	        $this->dbConnect($detailsTable); 
	        if($this->rsstype == 'trades'){
				$query = "SELECT * FROM tt_business locationid = ".$this->id." order by dated  desc limit 0,10"; 
			}
	        else if($this->rsstype == 'customer'){
				$query = "SELECT * FROM tt_business locationid  =  ".$this->id." "; 
			}			
	        else if($this->rsstype == 'keyword'){
				$query = "SELECT * FROM tt_business where 
										keywords like  '".$this->id."' or 
										keywords like  '%,".$this->id.",%' or 
										keywords like  '".$this->id.",%'  or 
										keywords like  '%,".$this->id."' order by dated  desc limit 0,10"; 
			}else{
				$query = "SELECT * FROM `tt_business` order by dated  desc limit 0,10"; 
			}		
	        $result = mysql_db_query (ACSQL_DB_NAME, $query, LINK); 
		  $details = '<?xml version="1.0" encoding="ISO-8859-1" ?> 
	                <rss version="2.0"> ';
					
	        while($row = mysql_fetch_array($result)) 
	        { 
	            $details = ' 
	                    <channel> 
	                        <title>'. $row['title'] .'</title> 
	                        <link>' . $this->ru .$row['link'] .'/</link> 
	                        <description>'. $row['description'] .'</description> 
	                        <language>'. $row['language'] .'</language> 
	                        <image> 
	                            <title>'. $row['image_title'] .'</title> 
	                            <url>' . $this->ru . $row['image_url'] .'</url> 
	                            <link>' . $this->ru . $row['image_link'] .'</link> 
	                        </image>'; 
	        } 
	        return $details; 
	    } 
	 
	    private function getItems() 
	    { 
	        $itemsTable = "tbl_products"; 
	        $this->dbConnect($itemsTable); 
	        if($this->rsstype == 'listing'){
				//$query = "SELECT * , tb.bussName FROM `tbl_products` left join tbl_bussiness as tb on tb.bussId = tbl_products.bId where tbl_products.bId = ".$this->id." order by dated  desc limit 0,10"; 
				$query = "SELECT * from tt_business WHERE `locationid` = ".$this->id."";
			}else if($this->rsstype == 'trades'){
				$query = "SELECT * from tt_business WHERE `locationid`  = ".$this->id." "; 
			}else if($this->rsstype == 'keyword'){
				$query = "SELECT * FROM tt_business ` where 
										keywords like  '".$this->id."' or 
										keywords like  '%,".$this->id.",%' or 
										keywords like  '".$this->id.",%'  or 
										keywords like  '%,".$this->id."' order by dated  desc limit 0,10"; 
			}elseif($this->rsstype == 'website'){
				$query = "SELECT * from `tt_business` WHERE `locationid` = ".$this->id."";
			}else{
				$query = "SELECT *  FROM `tt_business` order by dated  desc limit 0,10"; 
			}			
	        //$result = mysql_db_query (ACSQL_DB_NAME, $query, LINK); 
			//echo $query;exit;
			$result = mysql_query($query);
	        $items = ''; 
			
        
        
      
			if($this->rsstype == 'company'){
$items = '<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
	<channel>
		<title>Business Detail on ' . $this->domain . '</title>
		<link>' . $this->ru . 'rss</link>
		<description>Updated every minute of every day</description>
		<language>en-us</language>
		<copyright>Copyright: (C) BD Directories.</copyright>';
				$row = mysql_fetch_array($result);
				$items .= '
			<item>
				<title> '. str_replace('&','&amp;', $row['name']).' </title>
				<link>' . $this->ru . 'listing/all/'.  encodeURL($row['name']).'_'.$row['locationid'] .'/</link> 
				<address> '. str_replace('&','&amp;', $row['address']).' </address>
				<state> '. str_replace('&','&amp;', $row['state']).' </state>
				<city> '. str_replace('&','&amp;', $row['city']).' </city>
				<zipCode> '. str_replace('&','&amp;', $row['zip']).' </zipCode>
				<phoneNo> '. str_replace('&','&amp;', $row['phone']).' </phoneNo>
				<fax> '. str_replace('&','&amp;', $row['fax']).' </fax>
				<websiteurl> '. str_replace('&','&amp;', $row['website']).' </websiteurl>
				<description><![CDATA['. substr(strip_tags(str_replace('&','&amp;', $row['description'])),0,500) .']]></description> 
				<pubDate>' . date('d/m/Y',$row['dated']) . '</pubDate>
			</item>';
			}elseif($this->rsstype == 'website'){
$items = '<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
	<channel>
		<title>Website detail on ' . $this->domain . '</title>
		<link>' . $this->ru . 'rss/</link>
		<description>Updated every minute of every day</description>
		<language>en-us</language>
		<copyright>Copyright: (C) BD Directories.</copyright>';
				$row = mysql_fetch_array($result);
				$items .= '
			<item>
				<title> '. str_replace('&','&amp;', $row['name']).' </title>
				<link>http://www.' . $row['domain'] . '.' . $this->domain . '</link> 
				<address> '. str_replace('&','&amp;', $row['address']).' </address>
				<state> '. str_replace('&','&amp;', $row['state']).' </state>
				<city> '. str_replace('&','&amp;', $row['city']).' </city>
				<zipCode> '. str_replace('&','&amp;', $row['postcode']).' </zipCode>
				<phoneNo> '. str_replace('&','&amp;', $row['phone']).' </phoneNo>
				<fax> '. str_replace('&','&amp;', $row['fax']).' </fax>';
				if(strlen(trim($row['website']))>1)
				{
					$items .= '<websiteurl>http://www.'. str_replace('&','&amp;', $row['website']).' </websiteurl>';
				}
				$items .= '
				<sub_heading><![CDATA['. substr(strip_tags(str_replace('&','&amp;', $row['sub_heading'])),0,32) .']]></sub_heading>
				<about_us><![CDATA['. substr(strip_tags(str_replace('&','&amp;', $row['about_us'])),0,500) .']]></about_us>
				<products><![CDATA['. substr(strip_tags(str_replace('&','&amp;', $row['products'])),0,500) .']]></products>';
				
				$items .= '
					<pubDate>' . date('d/m/Y',$row['dated']) . '</pubDate>
			</item>';
			}else{
				 $items = '<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
	<channel>
    	<title>Products &amp; Services articles on ' . $this->domain . '</title>
        <link>' . $this->ru . 'rss/</link>
        <description>Updated every minute of every day</description>
        <language>en-us</language>
		<copyright>Copyright: (C) BD Directories.</copyright>';
				while($row = mysql_fetch_array($result)) 
				{ 
			$items .= '
			<item>
				<title> '. str_replace('&','&amp;', $row['title']).' </title>
				<link>' . $this->ru . 'listing/all/'. encodeURL($row['name']).'_'.$row['locationid'] .'/'.  encodeURL($row['title']).'_'.$row['Id'] .'/</link> 
				<description><![CDATA['. substr(strip_tags(str_replace('&','&amp;', $row['description'])),0,500) .']]></description> 
				<pubDate>'.$row['dated'].'</pubDate>
			</item>';
				} 
			}
				$items .= '
	</channel>
</rss>'; 
	        return $items; 
	    } 
	 
	} 
 
?> 