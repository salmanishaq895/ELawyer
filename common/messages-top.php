<?php
    /*************************************************************************
    *
    * Simple Private Messaging Tutorial for Pixel2Life Community
    * 
    * Features:
    * 
    * - Messaging using Usernames 
    * - No HTML allowed (bbcode can simply be included) 
    * - You can see if somebody has deleted or read the pm 
    * - On reply, the old mail will be quoted
    *
    * by Christian Weber
    * 
    * 
    *************************************************************************/
    
    // Load the config file!
    //include('config.php');
    // Load the class
    require('common/messages.php');
    // Set the userid to 2 for testing purposes... you should have your own usersystem, so this should contain the userid
    $userid = $_SESSION['TTLOGINDATA']['USERID'];
    // initiate a new pm class
    $pm = new cpm($userid);
    
    // check if a new message had been send
    if(isset($_POST['newmessage'])) {
        // check if there is an error while sending the message (beware, the input hasn't been checked, you should never trust users input!)
        if($pm->sendmessage($_POST['to'],$_POST['jobId'],$_POST['subject'],$_POST['message'],$_POST['msg_thread'],$_POST['message_frm'])) {
            // Tell the user it was successful
            $_SESSION['response_msg'] = "Message successfully sent!";
        } else {
            // Tell user something went wrong it the return was false
            $_SESSION['response_msg'] = "Error, couldn't send.";
        }
    }
    
    // check if a message had been deleted
    if(isset($_POST['delete'])) {
        // check if there is an error during deletion of the message
        if($pm->deleted($_POST['did'])) {
            echo "Message successfully deleted!";
        } else {
            echo "Error, couldn't delete PM!";
        }
    }
    
?>
