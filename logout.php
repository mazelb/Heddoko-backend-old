<?php
ob_start();
ini_set('session.save_path', 'tmp');
session_start();
session_destroy();

header("Location: login.php");
exit;
ob_flush();
?>
