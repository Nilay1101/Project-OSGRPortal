<?php
                              
$name = $_POST['name'];
$email_address = $_POST['email'];

if(!eregi('smvdu',$email_address)) 
   {
	return false;
   }

require_once('../class.phpmailer.php');
$mail = new PHPMailer();

$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->Username = "osgrp@smvdu.ac.in";
$mail->Password = "*****";

$to = $email_address ;
$data=$email_address;
$enc=sha1($data);
$t=time();
$d=date("Y.m.d");

$myfile = fopen("log.txt", "a") or die("Unable to open file!");
$file=$email_address." ".$enc." ".$t." ".$d."\n";
fwrite($myfile, $file);
fclose($myfile);

$body = '<html><body>';
$body .= '<form action="http://osgrp.smvdu.ac.in/forward.php?" method="post">';
$body .= "Thanks $name for verifying your email. ";
$body .= '<br />';
$body .= "Your confirmation code : $enc";
$body .= " : Attach the code at the end of your complaint";
$body .= '<br />';
$body .= '<label>Submit Your<strong> Compaint</strong> Here</label><br /><br />';
$body .= '<br />';
$body .= '<textarea cols="125" name="complaint" rows="40">Complaint :</textarea><br />';
$body .= '<br />';
$body .= '<input type="submit" value="Submit" />&nbsp;</form>';
$body .= '</body></html>';

$mail->SetFrom('osgrp@smvdu.ac.in');
$mail->Subject = "Email Verification";
$mail->MsgHTML($body);
$mail->AddAddress($to, $name);
   
if($mail->Send()) {
  echo "Message sent!";
} else {
  echo "Mailer Error: " . $mail->ErrorInfo;
}

		
?>