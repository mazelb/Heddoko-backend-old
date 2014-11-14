<?php
define('DB_SERVER', 'mysql.2freehosting.com');
define('DB_USERNAME', 'u618879135_wapp');    // DB username
define('DB_PASSWORD', 'AwesomeApp');    // DB password
define('DB_DATABASE', 'u618879135_wapp');      // DB name
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die( "Unable to connect");
$database = mysql_select_db(DB_DATABASE) or die( "Unable to select database");
?>