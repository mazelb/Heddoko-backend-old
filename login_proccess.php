<?php
ob_start();
include 'connect_to_database.php'; //connect the connection page
  
if(empty($_SESSION)) // if the session not yet started 
{
  ini_set('session.save_path', 'tmp');
   session_start();
  }
if(!isset($_POST['submit'])) { // if the form not yet submitted
   header("Location: login.php");
   exit; 
}
$username = $_POST["username"];
$password = $_POST["password"];
$password = md5($password);


$connectLogin=mysqli_connect($db_host,$db_username,$db_password) or die(mysql_error()); 
if (!$connectLogin) {
    die('Could not connect: ' . mysql_error());
	}
mysqli_select_db($connectLogin,$db_name)or die(mysql_error()) ;



//check if the username entered is in the database.
$test_query = "SELECT username,password,active FROM Users WHERE Users.username = '{$username}'";
$stmt = $connectLogin->prepare($test_query);

$stmt->bind_result($fusername, $fpassword,$factive);
 $stmt->execute();  
  $stmt->store_result();

   if($stmt->num_rows==0)
   {
//if username entered not yet exists
    echo "Invalid User name and/or Password";
}
else  
{
	while ($stmt->fetch())
   {
		 if($fpassword==$password && $factive==1)
     {

             $_SESSION['password'] = $fpassword; 
             $_SESSION['username'] = $fusername;
             header("Location: index.php");  
      }
       else
       { // if not
            echo "Invalid User name and/Or Password  and/or account is not yet activated"; 
        }
		
		
	}
}

  $stmt->close();

/* close connection */
$connectLogin->close();


ob_flush();
?>