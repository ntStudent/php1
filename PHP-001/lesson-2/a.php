<?php
echo "<a href=\"index.php\">home</a> ";
echo " <a href=\"session.php\">session</a>";
echo "<hr align=\"left\" width=\"150px\"><br>";

session_start();
echo '<pre>';
print_r($_SESSION);
echo '</pre>';