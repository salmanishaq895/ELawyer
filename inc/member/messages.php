<div class="map_page_right_bar listing_right_bar">
  <div class="brued_crum_bar brued_crum_bar_c">
    <div class="listing_page_brued_crum"> <span class="brurd_curm_inner"><a href="<?php echo $ru;?>" style="text-decoration:none; color:#999999;">Home</a> > <?php if($_SESSION['TTLOGINDATA']['TYPE']=='t') {?><a href="<?php echo $ru;?>member/statistics" style=" text-decoration:none; color:#999999;">Account Panel></a> <?php }else{?> <a href="<?php echo $ru;?>member/profile" style=" text-decoration:none; color:#999999;">Account Panel></a><?php }?>  <a href="<?php echo $ru;?>member/messages" style="text-decoration:none; color:#999999;"> <span class="change"> Manage Responses </span> </a></span></div>
  </div>
	<?php //include('notice.php'); ?>
    <div class="cpanel_right_bar">
      <div class="company_detail_description">
	  	<span class="company_detail_span">Manage Enquiry</span>

<?php
// In this switch we check what page has to be loaded, this way we just load the messages we want using numbers from 0 to 3 (0 is standart, so we don't need to type this)
if(isset($_GET['o'])) {
//echo $_GET['o']; exit;
    switch($_GET['o']) {
        // get all new / unread messages
        case 'new': $pm->getmessages(); $newclass='selected'; break;
		
        // get all send messages
        case 'send': $pm->getmessages(2); $sendclass='selected'; break;
        // get all read messages
        case 'read': $pm->getmessages(1); $readclass='selected'; break;
        // get all deleted messages
        case 'deleted': $pm->getmessages(3); $deletedclass='selected'; break;
        // get a specific message
        case 'view': $pm->getmessage($_GET['p']); $readclass='selected'; break;
        // get all new / unread messages
        default: $pm->getmessages(); $newclass='selected'; break;
    }
} else {
    // get all new / unread messages
    $pm->getmessages();
	$newclass='selected';
}
// Standard links
?>
<style>
	.messge-menu{
		float:left;
		margin:10px 17px;
		padding:0;
		list-style-type:none;
		font-family:Arial, Helvetica, sans-serif;
		width:95%;
	}
	.messge-menu li{
		float:left;
		font-size:14px;
		font-weight:bold;
		margin:2px 10px;
		padding:0 0 10px;
	}
	.messge-menu li a{
		color:#222222;
		text-decoration:none;
		padding:0 5px 10px;
	}
	.messge-menu li.selected{
		border-bottom: 4px solid #8EA800;
	}
	.messge-menu li.selected a{
		color:#7B0099;
	}
	.response-row{
		float:left;
		width:620px;
		padding:7px 5px;
	}
	.response-row .col1{
		float:left;
		width:200px;
	}
	.response-row .col2{
		float:left;
		width:300px;
	}
	.responses-wrapper{
		font-family:Arial, Helvetica, sans-serif;
		float:left;
		width:630px;
		margin:15px 20px;
	}
	.response-row .head{
		font-weight:bold;
		padding:7px 0;
	}
	.response-row a{ color:#000000; text-decoration:none;}
	.response-row a:hover{ text-decoration:underline;}
	.response-row .col3{
		float:left;
		width:118px;
	}
	.no-data{ padding:20px; text-align:center; }
	.response-effect:hover{
		background-color:#F7F7F7;
	}
	.response-detail .frm{
		float:left;
		width:20px;
		font-weight:bold;
		margin:5px;
		width:60px;
	}
	.response-detail .frm-msg{
		float:left;
		margin:5px;
		width:545px;
	}
	.response-btn{
		float:left;
		width:200px;
		margin:10px 0;
	}
	.response-btn .search_btn{ width:auto !important; font-size:14px; padding:2px; margin:0 12px; }
	.reply-frm{ float:left;}
	.response-txt{ float:left; width:600px;}
	.response-txt textarea{ width:580px; height:200px;}
</style>
<ul class="messge-menu">
	<li class="<?php echo $newclass;?>"><a href='<?php echo $ru; ?>member/messages/new'>New Messages</a></li>
	<li class="<?php echo $readclass;?>"><a href='<?php echo $ru; ?>member/messages/read'>Read Messages</a></li>
	<li class="<?php echo $sendclass;?>"><a href='<?php echo $ru; ?>member/messages/send'>Sent Messages</a></li>
	
	<?php /*<li class="<?php echo $deletedclass;?>"><a href='<?php echo $ru; ?>member/messages/deleted'>Deleted Messages</a></li>*/?>
</ul>
<div class="responses-wrapper">
<?php
if(!isset($_GET['o']) || $_GET['o'] == 'new') {
?>
<div class="response-row">
	<div class="col1 head">From</div>
	<div class="col2 head">Title</div>
	<div class="col3 head">Date</div>
</div>
<?php
	// If there are messages, show them
	if(count($pm->messages)) {
		// message loop
		for($i=0;$i<count($pm->messages);$i++) {
			?>
			<div class="response-row response-effect">
				<div class="col1"><a href='<?php echo $ru; ?>member/messages/view/<?php echo $pm->messages[$i]['id']; ?>'><?php echo $pm->messages[$i]['from']; ?></a></div>
				<div class="col2"><a href='<?php echo $ru; ?>member/messages/view/<?php echo $pm->messages[$i]['id']; ?>'><?php echo $pm->messages[$i]['title'] ?></a></div>
				<div class="col3"><?php echo $pm->messages[$i]['created']; ?></div>
			</div>
			<?php
		}
	} else {
		// else... tell the user that there are no new messages
		echo '<div class="response-row"><div class="no-data">No new messages found</div></div>';
	}
} elseif($_GET['o'] == 'send') {
?>
<div class="response-row">
	<div class="col1 head">To</div>
	<div class="col2 head">Title</div>
	<div class="col3 head">Date</div>
</div>
    <?php
        // if there are messages, show them
        if(count($pm->messages)) {
            // message loop
            for($i=0;$i<count($pm->messages);$i++) {
                ?>
                <div class="response-row response-effect">
                    <div class="col1"><?php echo $pm->messages[$i]['to']; ?></div>
                    <div class="col2"><a href='<?php echo $ru; ?>member/messages/view/<?php echo $pm->messages[$i]['id']; ?>'><?php echo $pm->messages[$i]['title'] ?></a></div>
					<?php /*
                    <div class="col3">
                    <?php  
                        // If a message is deleted and not viewed
                        if($pm->messages[$i]['to_deleted'] && !$pm->messages[$i]['to_viewed']) {
                            echo "Deleted without reading";
                        // if a message got deleted AND viewed
                        } elseif($pm->messages[$i]['to_deleted'] && $pm->messages[$i]['to_viewed']) {
                            echo "Deleted after reading";
                        // if a message got not deleted but viewed
                        } elseif(!$pm->messages[$i]['to_deleted'] && $pm->messages[$i]['to_viewed']) {
                            echo "Read";
                        } else {
                        // not viewed and not deleted
                            echo "Not read yet";
                        }
                    ?>
                    </div>*/?>
                    <div class="col3"><?php echo $pm->messages[$i]['created']; ?></div>
                </div>
                <?php
            }
        } else {
            // else... tell the user that there are no new messages
            echo '<div class="response-row"><div class="no-data">No send messages found</div></div>';
        }
} elseif($_GET['o'] == 'read') {
?>
	<div class="response-row">
		<div class="col1 head">From</div>
		<div class="col2 head">Title</div>
		<div class="col3 head">Date</div>
	</div>
    <?php
        // if there are messages, show them
        if(count($pm->messages)) {
            // message loop
            for($i=0;$i<count($pm->messages);$i++) {
                ?>
                <div class="response-row response-effect">
					<div class="col1"><?php echo $pm->messages[$i]['from']; ?></div>
                    <div class="col2"><a href='<?php echo $ru; ?>member/messages/view/<?php echo $pm->messages[$i]['id']; ?>'><?php echo $pm->messages[$i]['title'] ?></a></div>
                    <div class="col3"><?php echo $pm->messages[$i]['to_vdate']; ?></div>
                </div>
                <?php
            }
        } else {
			echo '<div class="response-row"><div class="no-data">No read messages found</div></div>';
        }
} elseif($_GET['o'] == 'deleted') {
?>
	<div class="response-row">
		<div class="col1 head">From</div>
		<div class="col2 head">Title</div>
		<div class="col3 head">Date</div>
	</div>    <?php
        // if there are messages, show them
        if(count($pm->messages)) {
            // message loop
            for($i=0;$i<count($pm->messages);$i++) {
                ?>
                <div class="response-row response-effect">
					<div class="col1"><?php echo $pm->messages[$i]['from']; ?></div>
                    <div class="col2"><a href='<?php echo $ru; ?>member/messages/view/<?php echo $pm->messages[$i]['id']; ?>'><?php echo $pm->messages[$i]['title'] ?></a></div>
                    <div class="col3"><?php echo $pm->messages[$i]['to_ddate']; ?></div>
                </div>
                <?php
            }
        } else {
			echo '<div class="response-row"><div class="no-data">No deleted messages found</div></div>';
        }
} elseif($_GET['o'] == 'view' && isset($_GET['p'])) {
	if($userid == $pm->messages[0]['toid'] && !$pm->messages[0]['to_viewed']) {
		$pm->viewed($pm->messages[0]['id']);
	}
	/*echo "<pre>";
	print_r($pm->messages);exit;*/
?>
    <div class="response-detail">
		<div class="frm">From:</div>
		<div class="frm-msg"><?php echo $pm->messages[0]['from']; ?></div>
        <div class="frm">Date:</div>
		<div class="frm-msg"><?php echo $pm->messages[0]['created']; ?></div>
        <div class="frm">Subject:</div>
		<div class="frm-msg"><?php echo $pm->messages[0]['title']; ?></div>
        <div class="frm-msg" style="width:600px;"><?php echo $pm->render($pm->messages[0]['message']); ?></div>
		<div class="response-btn">
		<form name='reply' method='post' action='<?php echo $ru; ?>member/messages/view/<?php echo $_GET['p']; ?>'>
			<input type='hidden' name='rfrom' value='<?php echo $pm->messages[0]['fromid']; ?>' />
			<input type='hidden' name='rjobId' value='<?php echo $pm->messages[0]['jobId']; ?>' />
			<?php if($_SESSION['TTLOGINDATA']['TYPE'] == 't')
					$message_frm = 'Trader';
				else
					$message_frm = 'Customer';
			?>
			<input type='hidden' name='message_frm' value='<?php echo $message_frm; ?>' />
			<input type='hidden' name='rsubject' value='Re: <?php echo $pm->messages[0]['title']; ?>' />
			<?php /*<input type='hidden' name='rmessage' value='[quote]<?php echo $pm->messages[0]['message']; ?>[/quote]' />*/?>
			<input type='hidden' name='rmsg_thread' value='<?php echo $pm->messages[0]['id']; ?>' />
			<input type='submit' name='reply' value='Reply' class="search_btn" />
		</form>
		</div>
		<div class="response-btn" style="float:right; width:130px;">
		<form name='delete' method='post' action='<?php echo $ru; ?>member/messages/view/<?php echo $_GET['p']; ?>'>
			<input type='hidden' name='did' value='<?php echo $pm->messages[0]['id']; ?>' />
			<input type='submit' name='delete' value='Delete' class="search_btn" />
		</form>
		</div>
	</div>
<?php
}
if(isset($_POST['reply'])){
?>
<div class="reply-frm">
	<form name="new" method="post" action="<?php echo $ru; ?>member/messages/view/<?php echo $_GET['p']; ?>">
		<?php /*<strong>To:</strong>*/?>
		<input type='hidden' name='to' value='<?php echo $_POST['rfrom']; ?>' />
		<input type='hidden' name='message_frm' value='<?php echo $_POST['message_frm']; ?>' />
		<input type='hidden' name='jobId' value='<?php echo $_POST['rjobId']; ?>' />
		<input type='hidden' name='msg_thread' value='<?php echo $_POST['rmsg_thread']; ?>' />
		<?php /*<strong>Subject:</strong>*/?>
		<input type='hidden' name='subject' value='<?php echo $_POST['rsubject']; ?>' />
		<div class="response-txt">
			<strong>Message:</strong><br  />
			<textarea name='message'><?php //echo $_POST['rmessage']; ?></textarea>
		</div>
		<div class="response-btn" >
			<input type='submit' name='newmessage' value='Send' class="search_btn" />
		</div>
	</form>
</div>
<?php 
}
?>
</div>
</div>
</div>
</div>
