<?php 
	header("Content-Type: application/xml; charset=ISO-8859-1"); 
	$rsstype =  $_GET['s'];
	//$id =  strtolower( end(explode("_",$_GET['o'])));
	$rss = new rss($rsstype); 
	echo $rss->GetFeed(); 

	echo "dfsdfsd"; exit;
	class rss 
	{
		var $ru;
		var $rsstype;
		var $id;
		var $domain;
		public function rss($rsstype) 
		{ 
			//require_once ('../connect/connect.php'); 
			$this->ru = $ru;
			$this->rsstype = $rsstype;
			//$this->id = $id;
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
	        $detailsTable = "tt_quotes"; 
	        $this->dbConnect($detailsTable); 
	        if($this->rsstype == 'rss2'){
				$query = "SELECT * FROM `tt_quotes` order by posted_date  desc limit 0,10"; 
			}else{
				$query = "SELECT *  FROM `tt_quotes` order by posted_date  desc limit 0,10"; 
			}		
	        $result = mysql_db_query (ACSQL_DB_NAME, $query, LINK); 
		  $details = '<?xml version="1.0" encoding="ISO-8859-1" ?> 
	                <rss version="2.0"> ';
					
	        while($row = mysql_fetch_array($result)) 
	        { 
	            $details = ' 
	                    <channel> 
	                        <title>'. $row['keyword'] .'</title> 
	                        <link>' . $this->ru .$row['link'] .'/</link> 
	                        <description>'. $row['description'] .'</description> 
	                        <language>'. $row['language'] .'</language> 
	                        <image> 
	                            <title>'. $row['image_title'] .'</title> 
	                            <url>' . $this->ru . $row['file_attechmen'] .'</url> 
	                            <link>' . $this->ru . $row['file_attechmen'] .'</link> 
	                        </image>'; 
	        } 
	        return $details; 
	    } 
	 
	    private function getItems() 
	    { 
	        $itemsTable = "tt_quotes"; 
	        $this->dbConnect($itemsTable); 
	        if($this->rsstype == 'rss2'){
				//$query = "SELECT * , tb.bussName FROM `tbl_products` left join tbl_bussiness as tb on tb.bussId = tbl_products.bId where tbl_products.bId = ".$this->id." order by dated  desc limit 0,10"; 
				$query = "SELECT * from tt_quotes order by posted_date  desc limit 0,10";
			}else{
				$query = "SELECT *  FROM `tt_quotes`  order by posted_date  desc limit 0,10"; 
			}			
	        //$result = mysql_db_query (ACSQL_DB_NAME, $query, LINK); 
			//echo $query;exit;
			$result = mysql_query($query);
	        $items = ''; 
			
        
        
      
			if($this->rsstype == 'rss2'){
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
				<title> '. str_replace('&','&amp;', $row['keyword']).' </title>
				<link>' . $this->ru . 'job_particulars/'.$row['quotes_id'].'_'.encodeURL($row['keyword']).'/</link> 
				<address> '. str_replace('&','&amp;', $row['location']).' </address>
				<state> '. str_replace('&','&amp;', $row['state']).' </state>
				<city> '. str_replace('&','&amp;', $row['city']).' </city>
				<zipCode> '. str_replace('&','&amp;', $row['post_code']).' </zipCode>
				<phoneNo> '. str_replace('&','&amp;', $row['phone']).' </phoneNo>
				<fax> '. str_replace('&','&amp;', $row['fax']).' </fax>
				
				<description><![CDATA['. substr(strip_tags(str_replace('&','&amp;', $row['message'])),0,500) .']]></description> 
				<pubDate>' . date('d/m/Y',$row['posted_date']) . '</pubDate>
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
				<link>' . $this->ru . 'job_particulars/'.$row['quotes_id'].'_'.encodeURL($row['keyword']).'/</link> 
				<description><![CDATA['. substr(strip_tags(str_replace('&','&amp;', $row['message'])),0,500) .']]></description> 
				<pubDate>'.$row['posted_date'].'</pubDate>
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