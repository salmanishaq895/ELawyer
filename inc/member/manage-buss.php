<?php 
 //$sql_business	=	"select * from ht_business where userId='".$_SESSION['HTLOGINDATA']['USERID']."'";

//$result = @mysql_query($sql_business);
//$total_pages = @mysql_num_rows($result);
//$targetpage = $ru."member/manage-buss/";
///////////////////////////////////////////////////////////////////////////////////////
include($rootpath.'pagination/function.php');

    	$page = (int) (!isset($_GET["o"]) ? 1 : $_GET["o"]);
		if($page == '' or $page == 0)
		$page = 1;
		//echo $page ; exit;
    	$limit = 6;
    	$startpoint = ($page * $limit) - $limit;
        
        //to make pagination
		//echo $_SESSION['HTLOGINDATA']['USERID']; exit;
        $statement = "ht_business where userId='".$_SESSION['HTLOGINDATA']['USERID']."'";

///////////////////////////////////////////////////////////////////////////////////////
$sql_business =  "select * from $statement LIMIT $startpoint,$limit";
//echo $sql_business; exit;
$result	=	@mysql_query($sql_business);
$targetpage = $ru."member/manage-buss/";
//echo $sql_business; exit;
$i=$i+$start;
//$result = @mysql_query($sql_business);
$sqlcount = "SELECT count(locationid) FROM `ht_business` "; 
?>


    
<div class="cpanel_right_bar">
  <div class="profile_left_inner_bar_wrapper" >
    <div class="cpanel_right_top_bar">
      <h3>Manage<span>Business </span></h3>
    </div>
    <div class="cpane_right_inner_bar">
      <div class="contact_us_left_inner_bar">
        <!--THIS SECTION IS USED FOR THE LISTING-->
       
        <?php if ( isset ($_SESSION['msg']) ) {?>
        <div class="notification error png_bg"> <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
          <div> <?php echo  $_SESSION['msg']; unset($_SESSION['msg']); ?> </div>
        </div>
        <?php } ?>
        <ul class="buss-listing">
        <li class="heading">
            <div class="hcol1">Name</div>
            <div class="hcol2">Category</div>
			 <div class="hcol3">Bussiness Type</div>
			 <div class="hcol3">Date Added</div>
            <div class="hcol3">Upgrade</div>
            <div class="hcol4">Action</div>
        </li>
        <?php 
		$j=1;
		while($row = @mysql_fetch_array($result))
		{
			if($j%2==0){
				$rowcolor = 'style="background-color:#F5F5F5"';
			}else{
			   $rowcolor = '';
			}
		?>
        	<li <?php echo $rowcolor;?>>
              <div class="col1" ><?php echo $row['name'];?>&nbsp;</div>
              <div class="col2"><?php 
					$cat_str = '';
					$ids = explode(',',$row['categoryid']);
					$tot = count($ids);
					for($i=0; $i<$tot; $i++)
					{
						$qry = "SELECT * FROM `ht_category` Where categoryid = '".$ids[$i]."'";
						$cat	=	$db->get_row($qry,ARRAY_A);
						$cat_str    .=$cat['category']."   " ." ,  ";		
					}
					echo trim($cat_str,",  ");?>&nbsp;
                </div>
				<div class="col3"><?php 
						if($row['featured']=='yes')
						{						
							echo "Featured";
				        }
						else
						{
						 echo "Regular";
						}
				?>&nbsp;</div>
				<div class="col3"><?php if($row['date_added']!='0') { echo date('d-M-y',$row['date_added']); } else echo "No Date Added ";?>&nbsp;</div>
              <div class="col3"><?php echo "<a href='".$ru."member/upgrade_bussiness/".$row['locationid']."'>Enhance</a>&nbsp;"; ?></div>
              <div class="col4"><a href="<?php echo $ru;?>member/edit-buss/<?php echo $row['locationid'];?>" >Edit</a> | <a href="<?php echo $ru;?>process/process_business.php?p=<?php echo $row['locationid'];?>" onclick="return confirm('Are You Sure To Delete The Record');" > Delete </a></div>
            </li>
          <?php $j++; }?>
          </ul>
        </div>
        <div class="paging_bar">
            <div class="paging_bar_inner" id="user_paging_admin">
			  <?php
            echo pagination($statement,$limit,$page,$targetpage);
            ?> <?php  //include($rootpath.'common/paginglayout.php');?>
         <!--<ul>
												<li class="selected">1</li>
												<li>2</li>
												<li>3</li>
												<li>4</li>
												<li>5</li>
												<li>6</li>
												<p>Next  l  Last Page</p>
											</ul>-->
            </div>
          </div>
       
        <!--THIS SECTION IS END FOR USED THE LISTING-->
      </div>
    </div>
  </div>
</div>
