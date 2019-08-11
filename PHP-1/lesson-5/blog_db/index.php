
<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
unset($_SESSION['error']);
unset($_SESSION['don']);
unset($_SESSION['auth_db']);
unset($_SESSION['back']);
setcookie('log',  time() - 1);
setcookie('pass',  time() - 1);	
?>
<link rel="stylesheet" href="../css/add.css">
<title>Home Page</title>
<a href="login.php">login</a>
<a href="add.php">Add news</a>
<a href="listNews.php">List news</a>
<a href="register.php">Register</a>
<a href="../../lesson-1/blog/index.php">lesson-1</a>
<span class="don"><?=@$_SESSION['don']?></span>