<style >p{ float:left 	!important; }</style>
<div class="main_quote_bar_b main_quote_bar_c">
	<div class="map_page_right_bar terms_condition_bar">
		<div class="brued_crum_bar brued_crum_bar_c">
			<div class="listing_page_brued_crum">
				<span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Advocate</a> ></span>
			</div>
		</div>
			
		<div class="profile_page_left">
			<div class="company_detail_description">
				<span class="company_detail_span">Advocate</span>
				<?php 
				$query='select * from tt_user where type ="c"';
				$querys=mysql_query($query);
				while($row=mysql_fetch_array($querys)){
					
				?>
                <p><img src="<?php echo $ru.'media/user/'.$row['userId'].'/'.$row['photo'];?>"/></p>
                <p><?php echo $row['firstname'].' '.$row['lastname'];?></p>
                <?php } ?>
			</div>
		</div>
	</div>
</div>