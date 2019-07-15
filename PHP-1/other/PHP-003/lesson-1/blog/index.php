
<?php
session_start();
unset($_SESSION['error']);
unset($_SESSION['auth']);
unset($_SESSION['back']);
setcookie('log', 'admin', time() - 1);
setcookie('pass', 'qwerty', time() - 1);	
?>
<a href="login.php">login</a>
<a href="add.php">Add news</a>
<a href="listNews.php">List news</a>