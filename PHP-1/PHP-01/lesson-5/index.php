<?php
session_start();
if(isset($_SESSION['don'])){
	echo $_SESSION['don'] . '<br>';
}
unset($_SESSION['don']);
//echo "string";
?>
<a href="dbSQLadd.php">add article</a>
<a href="listNews.php">Loock all articles</a>
<a href="blog/addDb.php">addDb</a>