<?php
ob_start();
include 'connect_to_database.php'; //connect the connection page
if(empty($_SESSION)) // if the session not yet started 
ini_set('session.save_path', 'tmp');
   session_start();


if(isset($_SESSION['username'])) { // if already login
   header("location: index.php"); // send to home page
   exit; 
}

ob_flush();
?>
<html>
<head>
<title>Login Page</title>

</head>
<body>
<br />
<br />
<br />
<br />
<p align="center">
<table border="0"> <tr> <th> </th> <th>  </th> <th>  </th> <th></th> </tr>
<tr><td colspan="2" rowspan="3"><img src="logo.png" alt="welcome image" width="250" height="250"></td>
<td>
<form action = "login_proccess.php" method = "post">
Username: </td><td><input type="text" name="username" /> </td></tr>
<tr><td>Password: </td><td><input type="password" name="password" /> </td></tr>
<tr><td colspan="2" align="center"><input class="button" type = "submit" name="submit" value="Login" /></td></tr>
<tr><td> Create an account:</td><td colspan="3" align="center"><a href="register.php" class="button">Register</a></td></tr> 
</form>
</td></tr></table>
</p>

</body>
</html>
