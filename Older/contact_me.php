<?php
                              
$name = $_POST['name'];
$email_address = $_POST['email'];

if(!eregi('smvdu',$email_address)) 
   {
	return false;
   }
	
$to = $email_address ;
$data=$email_address;
$enc=sha1($data);
$t=time();
$d=date("Y.m.d");

$myfile = fopen("log.txt", "a") or die("Unable to open file!");
$file=$email_address." ".$enc." ".$t." ".$d."\n";
fwrite($myfile, $file);
fclose($myfile);

$email_subject = "Email Verification";

$headers = "From: OSGRP@SMVDU.net.in\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
$headers .= "Reply-To: $email_address";

$message = '<html><body>';
$message .= '<form action="http://osgrp.smvdu.ac.in/forward.php?" method="post">';
$message .= "Thanks $name for verifying your email. ";
$message .= '<br />';
$message .= "Your confirmation code : $enc";
$message .= " : Attach the code at the end of your complaint";
$message .= '<br />';
$message .= '<label>Submit Your<strong> Compaint</strong> Here</label><br /><br />';
$message .= '<br />';
$message .= '<textarea cols="125" name="complaint" rows="40">Complaint :</textarea><br />';
$message .= '<br />';
$message .= '<input type="submit" value="Submit" />&nbsp;</form>';
$message .= '</body></html>';

 mail($to,$email_subject,$message,$headers);
 return true;
		
?>