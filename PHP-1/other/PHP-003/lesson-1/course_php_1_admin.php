<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/course_php-1_admin.css">
		<link rel="shortcut icon" href="favicon.icoa">
		<title>course-php_admin</title>
	</head>
	<body>
		<a href="course_php_1-1.php">lesson № 1</a><hr>
	</body>
</html>

<?php
/* 
нативный метод
$f = fopen('log.txt', 'r');
$str = fread($f, filesize('log.txt')); для прочтения файла нужно узнать колличество символов
fclose($f); закрыли
*/
echo 'используем explode и -file_get_contents-';
$str = file_get_contents('log.txt');
// так как мы получаем одну строку то сначала разбиваем ее на заходы. Используя разделитель перенос строки
$arr = explode("\n", $str);
// var_dump($arr);
 // заменяем на 
echo '<pre>';
print_r($arr);
echo '</pre>'; 
###################################
echo 'используем -file- выводим циклом -foreach-';

$arr1 = file('log.txt');
// оформляем таблицу
echo '<table>';
	echo '<caption>';
		echo '<b>';
			echo 'TABLE AT LOG';
		echo '</b>';
	echo '</caption>';

	echo '<thead>';
		echo '<tr>';
			echo '<th>';
				echo 'DATE';
			echo '</th>';

			echo '<th>';
				echo 'REQUEST_URI';
			echo '</th>';

			echo '<th>';
				echo 'HTTP_REFERER';
			echo '</th>';

			echo '<th>';
				echo 'REMOTE_ADDR';
			echo '</th>';

			echo '<th>';
				echo 'HTTP_USER_AGENT';
			echo '</th>';
		echo '</tr>';
	echo '</thead>';
// цикл
foreach($arr1 as $string){
	$info = explode('~@~', $string);
	echo '<tr>';
	foreach ($info as $elem) {
		echo "<td>$elem</td>";
	}
	echo '</tr>';
}
echo '</table>' . '<br>';

########################################
echo 'используем: file' . '<br>';
echo 'через: print_r($arr1), в тегах pre';
echo '<pre>';
print_r($arr1);
echo '</pre>'; 
?>
