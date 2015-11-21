<?php
$to = "nilayjayswalnj@gmail.com";
$email_subject = "Admin - Complaint : ";

$headers = "From: OSGRP@smvdu.net.in\n";

$co = $_POST['complaint'];
$message = "Complaint : $co ,";

 mail($to,$email_subject,$message,$headers);
 return true;
		
?>
