
<!doctype html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
<link rel="stylesheet" type"text/css" href="mailBox.css"> 
<title>Registration form</title>
<script type="text/javascript" src="validate.js"></script>
    </head>
&nbsp; </br>


<body>
<h3> Please register</h3>
* required field
&nbsp; </br>
<form name="register" action="register.php" method="post" onsubmit="return validateForm(this);">
<table border="0"> 

<tr><td><label for="email">E-mail Address:</label></td> <td><input type="text" name="email">*<br></td></tr>
<tr><td><label for="password">Password: </label></td><td><input type="password" name="password">*<br></td></tr>
<tr><td><label for="confirmPassword">Confirm Password:</td> <td><input type="password" name="confirmPassword">*<br></td></tr>

<tr><td align="center"><input class="button" type="submit" name="goButton" value="Register" colspan="2" ><br></td></tr>
</form>	
</table>
* Required field

<?php


include 'connect_to_database.php'; //connect to DB
$registerInsert=mysqli_connect($db_host,$db_username,$db_password) or die(mysql_error()); 
if (!$registerInsert) {
    die('Could not connect: ' . mysql_error());
	}
mysqli_select_db($registerInsert,$db_name)or die(mysql_error()) ;




if (isset($_POST['goButton']))
{	

$username=$_POST['email'];
$password=$_POST['password'];
$password = md5($password);
$sqlconnectUser = "INSERT INTO Users (username, password) VALUES (?, ?)";
$stmt = $registerInsert->prepare($sqlconnectUser);
 
$stmt->bind_param('ss', $username,$password );
$stmt->execute();	
$stmt->close();		
echo "A new user has been added... SUCCESS </br>";			
			
	}
	


	
	mysqli_close($registerInsert);

?>

</body>
</html>
