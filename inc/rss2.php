<?php 
	header("Content-Type: application/xml; charset=ISO-8859-1"); 
				$query = "SELECT * FROM `tt_quotes` order by posted_date  desc limit 0,10"; 
				$result = mysql_query($query);
				$row = mysql_fetch_array($result);
			 	 echo '<xml version="1.0" encoding="ISO-8859-1" >';
	    	 	// echo '<rss version="2.0"> ';
						
	          	 echo        '  <channel> ';
	                        echo  '<title>'. $row['keyword'] .'</title> ';
	                        echo '<link>' . $this->ru .$row['link'] .'/</link>'; 
	                        echo '<description>'. $row['description'] .'</description> ';
	                        echo '<language>en-us</language>';
				while($row = mysql_fetch_array($result)) 
				{
			
			echo '<item>';
			echo '	<title> '. str_replace('&','&amp;', $row['keyword']).' </title>';
				echo '<link>' . $this->ru . 'job_particulars/'.$row['quotes_id'].'_'.encodeURL($row['keyword']).'/</link> ';
				echo '<address> '. str_replace('&','&amp;', $row['location']).' </address>';
				echo '<state> '. str_replace('&','&amp;', $row['state']).' </state>';
				echo '<city> '. str_replace('&','&amp;', $row['city']).' </city>';
				echo '<zipCode> '. str_replace('&','&amp;', $row['post_code']).' </zipCode>';
				echo '<phoneNo> '. str_replace('&','&amp;', $row['phone']).' </phoneNo>';
				echo '<fax> '. str_replace('&','&amp;', $row['fax']).' </fax>';
				
				echo '<description><![CDATA['. substr(strip_tags(str_replace('&','&amp;', $row['message'])),0,500) .']]></description> ';
				echo '<pubDate>' . date('d/m/Y',$row['posted_date']) . '</pubDate>';
			echo '</item>';
				}
			echo '</channel>';
			echo '</rss>';
			echo '</xml>';
	 
 
?> 