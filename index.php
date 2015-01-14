<?php
session_start();	
 
if(empty($_SESSION['oauth_provider']))
{
	session_destroy();
 include ('session_header.php'); //start session
}


?>
<!doctype html>
<html lang="en">
<meta http-equiv="refresh" content="2" name="viewport" content="width=device-width, initial-scale=1.0">
<head>
<title>Index</title>

    </head>
   
<body>

<h3 align="right"> Welcome <?php echo $_SESSION['username']; ?>, <a href="logout.php">logout</a> </h3> 


</body>
</html>


