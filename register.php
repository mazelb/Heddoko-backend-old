<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>Register</title>

    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />

</head>

<body>

<html lang="en">
<head>
 <!-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script> -->
  <script type="text/javascript" src="js/validate.js"></script>
    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>Register</title>
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
                    <a href="#register" class="active">Register</a>
                </li>
                <li>
                    <a href="#reset">Reset Password</a>
                </li>
            </ul>

            <!--/#login.form-action-->
            <div id="register" class="form-action show">
                <h1>Register</h1>
                <p>
                   
                    
                </p>
                <form name="register" action="register.php" method="post" onsubmit="return validateForm(this);">
                    <ul>
                        <li>
                            <input type="text" placeholder="E-mail" name="email"/>
                        </li>
                        <li>
                            <input type="password" placeholder="Password" name="regPassword" />
                        </li>
                        <li>
                            <input type="password" placeholder="Confirm Password" name="confirmPassword" />
                        </li>
                        <li>
                            <input type="submit" value="Sign Up" name="goButton"class="button" />

                        </li>
                    </ul> 
                </br>
                    <input type="button" value="Login" class="button" onclick="location.href='login.php'"/>
                </form>
            </div>
            <!--/#register.form-action-->

            <!--/#register.form-action-->
        </div>
    </div>
    <script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

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
$regPassword=$_POST['regPassword'];
$regPassword = md5($regPassword);
$key = $username . date('mY');
$key = md5($key);


$checkDB=mysql_query("select * from Users where username='{$username}'");
$checkDB = mysql_num_rows($checkDB);
    
    if (empty($checkDB)) 
    {
$sqlconnectUser = "INSERT INTO Users (username, password,confirmkey) VALUES (?, ?,?)";
$stmt = $registerInsert->prepare($sqlconnectUser);
 
$stmt->bind_param('sss', $username,$regPassword,$key);
$stmt->execute();	
$stmt->close();		


     include 'confirmemail.php';
    echo "<div align='center'> A new user has been added...PLEASE check your email for confirmation SUCCESS </br></div>";			
		
	}

    else
    {
     echo "<div align='center'> User already exists. Please login </br></div>";     
    }
	}

             

	
	mysqli_close($registerInsert);

?>
</body>
</html>

  <script src="js/index.js"></script>

</body>

</html>