<?php

 include 'connect_to_database.php'; //connect to DB

// Passkey that got from link 
$passkey=$_GET['passkey'];
$activate=1;

// Retrieve data from table where row that match this passkey 
    $activateInsert=mysqli_connect($db_host,$db_username,$db_password) or die(mysql_error()); 
    if (!$activateInsert) 
    {
    die('Could not connect: ' . mysql_error());
	}
    mysqli_select_db($activateInsert,$db_name)or die(mysql_error()) ;


$checkActive=mysql_query("select * from Users where confirmkey='{$passkey}'");
$checkActive = mysql_num_rows($checkActive);


if($checkActive==1)
{

       $sqlactivateUser = "UPDATE  Users set active=? WHERE confirmkey=? ";
       $stmt = $activateInsert->prepare($sqlactivateUser);
 
       $stmt->bind_param('is', $activate,$passkey);
       $stmt->execute();	
       $stmt->close();		
       echo "<div align='center'>Your account has been activated. <a href='http://loay.yzi.me/webapp/login.php'>Please Login</a>";
}

// if not found passkey, display message "Wrong Confirmation code" 
else 
{
     echo "<div align='center'> Wrong Confirmation code. Account still not Active";
     echo "<div align='center'>Please try again later or contact our team";
 }



mysqli_close($activateInsert);
?>