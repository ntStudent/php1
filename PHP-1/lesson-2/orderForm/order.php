<?php
echo "<a href=\"../index.php\">home</a> ";
echo " <a href=\"../session.php\">session</a>";
echo "<hr align=\"left\" width=\"150px\"><br>";
echo "you in chat!!!";

session_start();

echo "Здравствуйте, {$_SESSION['name']}!";
