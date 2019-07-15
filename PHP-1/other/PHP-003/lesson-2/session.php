<?php
echo "<a href=\"index.php\">home</a> ";
echo " <a href=\"discount.php\">discount</a> ";
echo " <a href=\"a.php\">aaa</a> ";
echo "<hr align=\"left\" width=\"150px\"><br>";
session_start();
$_SESSION['cart'] = ['stuff-1', 'stuff-2'];