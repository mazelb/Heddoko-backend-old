<?php
ob_start();
ini_set('session.save_path', 'tmp');
//session_start();
//session_destroy();

session_start();
session_unset();
    $_SESSION['FBID'] = NULL;
    $_SESSION['USERNAME'] = NULL;
    $_SESSION['FULLNAME'] = NULL;
    $_SESSION['EMAIL'] =  NULL;
    $_SESSION['LOGOUT'] = NULL;


header("Location: login.php");
exit;
ob_flush();
?>

