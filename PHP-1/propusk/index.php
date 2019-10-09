
<?php
session_start();
//include('view/view_all.php');
include('view/v_index.php');
error_reporting(E_ALL ^ E_NOTICE);
unset($_SESSION['error']);
unset($_SESSION['don']);
unset($_SESSION['auth_db']);
unset($_SESSION['back']);
setcookie('log',  time() - 1);
setcookie('pass',  time() - 1);






