<?php
echo "<a href=\"discount.php\">discount</a> ";
echo " <a href=\"session.php\">session</a>";
echo "<hr align=\"left\" width=\"150px\"><br>";
/*
куки содержат
название 
значение
срок истечения
путь
домен
*/
//setcookie(name, value, expires_or_options, path, domain, secure, httponly)
//время отсчитывается от 1970 года в секундах 
//функция -time- показывает сколько секунд прошло с 1970 года
echo time();
//setcookie('login', 'admin', time() + 3600 * 24 * 30);
//setcookie('pass', '8394kdjflskjhdfsflksdjskj', time() + 3600 * 24 * 30);

//так можно удалить куки
//setcookie('pass', '8394kdjflskjhdfsflksdjskj', time() - 1);


echo '<pre>';
print_r($_COOKIE);
echo '</pre>';
session_start();
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
?>