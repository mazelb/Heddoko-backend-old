<?php
//required Info
$to=$username;
$subject="Your confirmation link here";
$header="from: Heddoko Web App <loay@live.ca>";

// Your message
$message="Your Comfirmation link \r\n";
$message.="Click on this link to activate your account \r\n";
$message.="http://loay.yzi.me/webapp/activateaccount.php?passkey=$key";

// send email
$sentmail = mail($to,$subject,$message,$header);



?>