<?php
echo "<a href=\"index.php\">home</a> ";
echo " <a href=\"session.php\">session</a>";
echo "<hr align=\"left\" width=\"150px\"><br>";
if(isset($_COOKIE['entry'])){
	$t = $_COOKIE['entry'];
}
else{
	$t = time();
	setcookie('entry', $t, time() + 3600 * 24 * 30);
}

if ((time() - $t) < 1260) {
	echo 'До конца скидки остался час успей купить!!!!';
}
else{
	echo "Через три дня начнется водопад скидок заходи не проспи!!!";
}
echo "<hr align=\"left\" width=\"350px\"><br>";
echo $t . "<br>";
echo time() . "<br>";
echo 'time() - $t = ' . (time() - $t);

?>