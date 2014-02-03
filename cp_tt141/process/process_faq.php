<?php 
require_once("../../connect/connect.php");
foreach($_POST  as $key => $value)
{
   $$key = addslashes($value);
}
foreach($_GET as $key => $value)
{
   $$key = addslashes($value);
}
if(isset($chstatus))
{	
	$queryupdatestatus="update tt_faq set faq_status=$chstatus where faq_id=$faqid";
	if($db->query($queryupdatestatus))
	{
		 $msg=base64_encode("Question Updated Successfully");
		 header("location:".$ruadmin."home.php?p=faq_list&msg=$msg");
		 exit;
	} 
}
//*************************************************************	
if(isset($deletepage))
{	
	$querydelete="delete from tt_faq where faq_id=$deletepage";
	if($db->query($querydelete))
	{
		 $msg=base64_encode("Question Deleted Successfully");
		 header("location:".$ruadmin."home.php?p=faq_list&msg=$msg");
		 exit;
	}
}
//add new page********************************************
if(isset($addquestion))
{
	
	$msg = "";
	if($question == "")
	{
		$questionerror = "Please enter question.";
		$msg = $questionerror;
	}
	
	if($answer == "")
	{
		$answererror = "Enter enter answer to the question.";
		$msg = $answererror;
	}
	
	if($msg == "")
	{
		$querycheck="select count(*) as COUNT from tt_faq where faq_question='$question'";
		$rowcheck=$db->get_row($querycheck,ARRAY_A);
		if($rowcheck[COUNT]==0)	
		{
			if(isset($active))
			$status=1;
			else
			$status=0;
			
			$queryinsert="insert into tt_faq(faq_question,faq_answer,faq_status,faq_groupid) values('$question','$answer',$status,$qgroup)";
			if($db->query($queryinsert))
			{
				 $msg=base64_encode("Question Added Successfully");
				 header("location:".$ruadmin."home.php?p=faq_list&msg=$msg");
				 exit;
			}
		}
		else
		{
			$title=$question;
			$msg=$title. " is Already Exist!";
			$msg=base64_encode($msg);
			header("location:".$ruadmin."home.php?p=faq_list&msg=$msg");
			exit;
		}
	}
	else
	{
		$questerror=base64_encode($questionerror);
		$anserror=base64_encode($answererror);
		header("location:".$ruadmin."home.php?p=faq_list_add&questerror=$questerror&anserror=$anserror");
		exit;
	}	
}
//update page title*******************************************************************************
if(isset($updatequestion))
{
	//echo $pagetitle=addcslashes($pagetitle); exit;
	$msg = "";
	if($question == "")
	{
		$questionerror = "Please enter question.";
		$msg = $questionerror;
	}
	
	if($answer == "")
	{
		$answererror = "Enter enter answer to the question.";
		$msg = $answererror;
	}
	
	if($msg == "")
	{
		if(isset($active))
		$status=1;
		else
		$status=0;
		$queryupdate="update tt_faq set faq_question='$question',faq_answer='$answer',faq_status=$status,faq_groupid=$qgroup where faq_id=$faqid";
		if($db->query($queryupdate))
		{
			 $msg=base64_encode("Question Updated Successfully");
			 header("location:".$ruadmin."home.php?p=faq_list&msg=$msg");
			 exit;
		} 
		else
		{
			$msg=base64_encode(mysql_error());
			header("location:".$ruadmin."home.php?p=faq_list&msg=$msg");
			exit;	
		}
	}
	else
	{
		$questerror=base64_encode($questionerror);
		$anserror=base64_encode($answererror);
		header("location:".$ruadmin."home.php?p=faq_list_add&editid=$faqid&questerror=$questerror&anserror=$anserror");
		exit;
	}	
}

if(isset($editid))
{
	$queryedit="select * from tt_faq where faq_id=$editid";
	$rowedit=$db->get_row($queryedit,ARRAY_A);
	
}	
//*********************************************change group status
if(isset($faqgroupid))
{
	$queryupdatestatus="update tt_faq_groups set group_status=$st where faqg_id=$faqgroupid";
	if($db->query($queryupdatestatus))
	{
		 $msg=base64_encode("Group Update Successfully");
		 header("location:".$ruadmin."home.php?p=faq_group_list&msg=$msg");
		 exit;
	}
}
if(isset($addgroup))
{	
	//print_r($_POST);exit;
	//$fag	=	false;
	$msg = "";
	if($groupname == "")
	{
		$groupnameerror = "Please enter group name.";
		$msg = $groupnameerror;
		//$fag = true;
	}
	
	if($groupdesc == "")
	{
		$groupdescerror = "Please enter group description.";
		$msg = $groupdescerror;
	}
	
	if($sortingorder == "")
	{
		$sortingordererror = "Enter sort order.";
		$msg = $sortingordererror;
	}
	
	if($msg == "")
	{
		if(isset($active))
		$status=1;
		else
		$status=0;
		$querychk="select count(*) as COUNT from tt_faq_groups where group_title='$groupname'";
		$rowchk=$db->get_row($querychk,ARRAY_A);
		if($rowchk[COUNT]==0)
		{
			 $queryinsert="insert into tt_faq_groups(group_title,group_desc,sortorder,group_status) values('$groupname','$groupdesc','$sortingorder',$status)"; 
			//exit;
			if($db->query($queryinsert))
			{
					 $msg=base64_encode("Group Added Successfully");
					 header("location:".$ruadmin."home.php?p=faq_group_list&msg=$msg");
					 exit;
			}
			else
			{
					$msg=base64_encode(mysql_error());
					header("location:".$ruadmin."home.php?p=faq_group_list&msg=$msg");
					exit;
			}
		}
		else
		{
			// $title = base64_encode($_POST['group_title']);
			$msg=base64_encode($title."Already Exist!");
			header("location:".$ruadmin."home.php?p=faq_group_list&msg=$msg");
			exit;
		}
	}
	else
	{
		$grerror=base64_encode($groupnameerror);
		$sorterror=base64_encode($sortingordererror);
		$grerror2=base64_encode($groupdescerror);
		header("location:".$ruadmin."home.php?p=faq_group_add&grerror=$grerror&sorterror=$sorterror&grerror2=$grerror2");
		exit;
	}
}
//***************************************************************
if(isset($changesortingorder))
{
	
	 	$querysel="select * from tt_faq_groups order by sortorder $limit";
	   $rowsel=$db->get_results($querysel,ARRAY_A);
		if(isset($rowsel))
		foreach($rowsel as $arrsel)
		{	
			$sortorder="srtorder".$arrsel[faqg_id];
			$sortorder=$$sortorder;
			$queryupdate="update faq_groups set sortorder='$sortorder' where faqg_id=$arrsel[faqg_id]"; 
			$db->query($queryupdate);
		}
	
}
//*********************************
if($delid != "")
	{
		//echo $delid;exit;
		$sqldel1 = "delete from tt_faq where faq_groupid = '$delid' ";
		$db->query($sqldel1);
		
		$sqldel = "delete from tt_faq_groups where faqg_id = '$delid' ";
		
		if($db->query($sqldel))
		{
			 $msg=base64_encode("Group Deleted Successfully");
			 header("location:".$ruadmin."home.php?p=faq_group_list&msg=$msg");
			 exit;
		}
	}
if(isset($editidgroup))
{
	$editidgroup=base64_decode($editidgroup);
	$queryeditg="select * from tt_faq_groups where faqg_id=$editidgroup";
	$roweditg=$db->get_row($queryeditg,ARRAY_A);
}
if(isset($updategroup)) 
{

	$msg = "";
	if($groupname == "")
	{
		$groupnameerror = "Please enter group name.";
		$msg = $groupnameerror;
	}
	if($groupdesc == "")
	{
		$groupdescerror = "Please enter group description.";
		$msg = $groupdescerror;
	}
	if($sortingorder == "")
	{
		$sortingordererror = "Enter sort order.";
		$msg = $sortingordererror;
	}
	
	if($msg == "")
	{
	
		if(isset($active))
		$status=1;
		else
		$status=0;
		$queryupdate="update tt_faq_groups set group_title='$groupname',group_desc='$groupdesc',sortorder='$sortingorder',group_status=$status where faqg_id=$faqgid"; 
		if($db->query($queryupdate))
		{
			 $msg=base64_encode("Group Update Successfully");
			 header("location:".$ruadmin."home.php?p=faq_group_list&msg=$msg");
			 exit;
		}
		else
		{
			$msg=base64_encode(mysql_error());
			header("location:".$ruadmin."home.php?p=faq_group_list&msg=$msg");
			exit;
		}
	}
	else
	{
		$grerror=base64_encode($groupnameerror);
		$sorterror=base64_encode($sortingordererror);
		$grerror2=base64_encode($groupdescerror);
		$editidgroup=base64_encode($faqgid);
		header("location:".$ruadmin."home.php?p=faq_group_add&editidgroup=$editidgroup&grerror=$grerror&sorterror=$sorterror&grerror2=$grerror2");
		exit;
	}	
}
?>
