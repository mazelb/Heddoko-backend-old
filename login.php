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


<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>Login Page</title>

    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />

</head>

<body>

<html lang="en">
<head>
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>Flat Login</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
  ================================================== -->

    <!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>

    <div class="container">
        <div class="flat-form">
            <ul class="tabs">
                <li>
                    <a href="#login" class="active">Login</a>
                </li>

                <li>
                    <a href="#reset">Reset Password</a>
                </li>
            </ul>
            <div id="login" class="form-action show">
                <h1>Login on webapp</h1>
                <p>

                </p>
                <form action = "login_proccess.php" method = "post">
                    <ul>
                        <li>
                            <input type="text" placeholder="E-mail" name="username"/>
                        </li>
                        <li>
                            <input type="password" placeholder="Password" name="password"/>
                        </li>
                        <li>
                            <input type="submit" value="Login" class="button" name="submit" />
                            </br>
                             <input type="button" value="Sign Up" class="button" onclick="location.href='register.php'"/>
                        </li>
                    </ul>
                </form>
            </div>
            <!--/#login.form-action-->

            <!--/#register.form-action-->
            <div id="reset" class="form-action hide">
                <h1>Reset Password</h1>
                <p>
                    To reset your password enter your email and your birthday
                    and we'll send you a link to reset your password.
                </p>
                <form>
                    <ul>
                        <li>
                            <input type="text" placeholder="Email" />
                        </li>
                        <li>
                            <input type="text" placeholder="Birthday" />
                        </li>
                        <li>
                            <input type="submit" value="Send" class="button" />
                        </li>
                    </ul>
                </form>
            </div>
            <!--/#register.form-action-->
        </div>
    </div>
    <script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

  
</body>
</html>

  <script src="js/index.js"></script>

</body>

</html>