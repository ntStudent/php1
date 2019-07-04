<?php
include_once('../function/functions.php');
echo "<a href=\"../../../index.php\">home</a> ";
echo "<a href=\"discount.php\">discount</a> ";
echo " <a href=\"session.php\">session</a>";
echo " <a href=\"orderForm/form.php\">form</a>";
echo " <a href=\"auth/login.php\">Login in secret</a>";
echo "<hr align=\"left\" width=\"150px\"><br>";
/*
куки содержат:
1)название 
2)значение
3)срок истечения
4)путь
5)домен
*/
//setcookie(name, value, expires_or_options, path, domain, secure, httponly)
//время отсчитывается от 1970 года в секундах 
//функция -time- показывает сколько секунд прошло с 1970 года
$set = time();
echo "функция -time- показывает сколько секунд прошло с 1970 года - ";
echo $set . endings($set);
//setcookie(); - создаем куки
//setcookie('name', 'value', 'time');
// задать можно три параметра: имя, значение, время(срок истечения)
setcookie('name', 'Vadim', time() + 3600 * 24 * 7);
setcookie('parole', '8394kdjflskjhdfsflksdjskj', time() + 3600 * 24 * 30);

//Все куки хранятся в массиве $_COOKIE


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