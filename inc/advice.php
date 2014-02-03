<?php
	if(isset($_GET['s'])){
		$advice_sel = $_GET['s'];
		$query_category = "SELECT * FROM `tt_advise` WHERE `seo_page` = '$advice_sel' and `category_id` = 0 " ; 
		//echo $query_category; exit;
		$rs_category = $db->get_row($query_category, ARRAY_A);
		if($rs_category){
			$selected_cat_id = $rs_category['advise_id'];
			$advice_sel = $rs_category['seo_page'];
		}
		else
		{
			$query_cms = "SELECT * FROM `tt_advise` WHERE `category_id` = 0 and sublink=0 limit 1" ; 
			$rs_cms = $db->get_row($query_cms, ARRAY_A);
			$advice_sel = $rs_cms['seo_page'];
			header("location: ".$ru."advice/".$advice_sel);
			exit;
		}
	}
	
	if(isset($_GET['o'])){
		$seo_page = $_GET['o'];
		$query_cms = "SELECT * FROM `tt_advise` WHERE `seo_page` = '$seo_page' and `category_id` = ".$selected_cat_id."  " ; 	
	}
	else
	{
		$query_cms = "SELECT * FROM `tt_advise` WHERE `category_id` = ".$selected_cat_id." " ; 	
	}

	$rs_cms = $db->get_row($query_cms, ARRAY_A);	
	if($rs_cms){
		$advice_sel = $_GET['s'];
	}
	else
	{
		$query_cms = "SELECT * FROM `tt_advise` WHERE `category_id` = 1 limit 1" ; 
		$rs_cms = $db->get_row($query_cms, ARRAY_A);
		$advice_sel = $rs_cms['seo_page'];
	}
?>
<div class="main_quote_bar_b main_quote_bar_c">
	<div class="map_page_right_bar terms_condition_bar">
	
		<div class="brued_crum_bar brued_crum_bar_c">
			<div class="listing_page_brued_crum">
				<span class="brurd_curm_inner">
				<a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">
				Home >
				</a> 
				
				<a href="<?php echo $ru;?>advice/" style="text-decoration:none; color:#999999;">
				Advice & Tips >
				</a>
				
				<?php 
				if(isset($_GET['s']))
				{
				$s = $_GET['s'];
				$qry_first    = "SELECT * FROM `tt_advise` WHERE `seo_page` = '$s' and `category_id` = 0 ";
				$result_first   = $db->get_row($qry_first,ARRAY_A);
				
				?>
				<a href="<?php echo $ru;?>advice/<?php echo $s ;?>" style="text-decoration:none; color:#999999;">
				<?php echo stripslashes($result_first['advise_title']."  > ") ;?> 
				  </a> 
				<?php }
				if(isset($_GET['o']))
				{
				$o = $_GET['o'];
				$qry_second    = "SELECT * FROM `tt_advise` WHERE `seo_page` = '$o'";
				$result_second   = $db->get_row($qry_second,ARRAY_A);
				?>
				
				  <a href="<?php echo $ru;?>advice/<?php echo $s."/".$o;?>" style="text-decoration:none; color:#999999;">
				  
				  <span class="change">
				  <?php echo stripslashes($result_second['advise_title']."  > "); ?> 
				  </span>
				  </a>
				  <?php }
				  if(isset($_GET['p']))
				{
				$p = $_GET['p'];
				$qry_second    = "SELECT * FROM `tt_artical` WHERE `seo_page` = '$p' ";
				$result_second   = $db->get_row($qry_second,ARRAY_A);
				?>
				
				  <a href="<?php echo $ru;?>advice/<?php echo $s."/".$o."/".$p;?>" style="text-decoration:none; color:#999999;">
				  
				  <span class="change">
				  <?php echo stripslashes($result_second['artical_title']); ?> 
				  </span>
				  </a>
				  <?php }
				  ?>
				  </span>
			</div>
		</div>
			
		<div class="profile_page_left guides-left">
			<?php if($s!='' && $o==''){ 
				$qry_first    = "SELECT * FROM `tt_advise` WHERE `seo_page` = '$s' and category_id = 0 ";
				$result_first   = $db->get_row($qry_first,ARRAY_A);
				if($result_first){
					$cat_id = $result_first['advise_id'];
			?>
				<h1><?php echo stripslashes($result_first['advise_title']); ?></h1>
				<p>&nbsp;</p>
				<p><?php echo stripslashes($result_first['advise_short_description']); ?></p>
					<?php
					$query_article = "SELECT * FROM `tt_artical` WHERE `cat_id` = ".$cat_id." and sublink=1 order by advise_id " ; 
					$rs_art = $db->get_results($query_article, ARRAY_A);	
					if($rs_art){
						foreach($rs_art as $rsart){
						$art_url = $ru.'advice/'.$s."/".$result_first['seo_page']."/".$rsart['seo_page'];
					?>
					<p>&nbsp;</p>
					<h2><a href="<?php echo $art_url; ?>"><?php echo stripslashes($rsart['artical_title']); ?></a></h2>
					<p><?php echo stripslashes($rsart['artical_short_description']); ?>&nbsp;<a href="<?php echo $art_url; ?>">read article</a></p>
			<?php 		
					  }
					}
				}
			}elseif($s!='' && $o!='' && $p==''){  				
				 $qry_first    = "SELECT * FROM `tt_advise` WHERE `seo_page` = '$o'";
				$result_first   = $db->get_row($qry_first,ARRAY_A);
				if($result_first){
					$cat_id = $result_first['advise_id'];
			?>
				<h1><?php echo stripslashes($result_first['advise_title']); ?></h1>
				<p>&nbsp;</p>
				<p><?php echo stripslashes($result_first['advise_description']); ?></p>
					<?php
					 $query_article = "SELECT * FROM `tt_artical` WHERE `advise_id` = ".$cat_id." order by advise_id " ; 
					$rs_art = $db->get_results($query_article, ARRAY_A);	
					if($rs_art){
						foreach($rs_art as $rsart){
							$art_url = $ru.'advice/'.$s."/".$o."/".$rsart['seo_page'];
					?>
					<p>&nbsp;</p>
					<h2><a href="<?php echo $art_url; ?>"><?php echo stripslashes($rsart['artical_title']); ?></a></h2>
					<p><?php echo stripslashes($rsart['artical_short_description']); ?>&nbsp;<a href="<?php echo $art_url; ?>">read article</a></p>
			<?php 		
					  }
					}
				}
				}elseif($s!='' && $o!='' && $p!=''){  
				 $qry_first    = "SELECT * FROM `tt_artical` WHERE `seo_page` = '$p'";
				$result_first   = $db->get_row($qry_first,ARRAY_A);
				if($result_first){
					
			?>
				<h1><?php echo stripslashes($result_first['artical_title']); ?></h1>
				<p>&nbsp;</p>
				<p><?php echo stripslashes($result_first['artical_description']); ?></p>		
			
			<?php } 
			
				}
			 ?>				
			
		</div>
		
		<div class="profile_page_left guides-right">
			<ul>
			<?php
				$query_cat = "SELECT * FROM `tt_advise` WHERE `category_id` = 0 order by advise_id " ; 
				$rs_cats = $db->get_results($query_cat, ARRAY_A);	
				if($rs_cats){
					foreach($rs_cats as $rs_cat){
			?>
					<li class="<?php if($advice_sel==$rs_cat['seo_page']) echo "active"; else echo "brdr-btm inactive-list";?>">
						<a href="<?php echo $ru.'advice/'.$rs_cat['seo_page'] ?>"><h3><?php echo stripslashes($rs_cat['advise_title']);?></h3></a>
						<ul>
							<?php
								$query_cat2 = "SELECT * FROM `tt_advise` WHERE `category_id` = ".$rs_cat['advise_id']." and sublink = 0 order by advise_id " ; 
								$rs_cats2 = $db->get_results($query_cat2, ARRAY_A);	
								if($rs_cats2 && $advice_sel==$rs_cat['seo_page']){
									foreach($rs_cats2 as $rs_cat2){
							?>
							<li><a href="<?php echo $ru.'advice/'.$rs_cat['seo_page'].'/'.$rs_cat2['seo_page'] ?>"><?php echo stripslashes($rs_cat2['advise_title']);?></a></li>
							<?php
									}
								}
							?>

						</ul>
					</li>
			<?php
					}
				}
			?>
			</ul>
		</div>
	</div>
</div>