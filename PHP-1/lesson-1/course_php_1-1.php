
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<link rel="shortcut icon" href="favicon.ico">
		<title>course-php_lesson_1</title>
	</head>
	<body>
		<a href="../../../index.php">home</a>
		<!-- здесь "referer" показывает откуда пришел пользователь -->
		<!-- <a href="http://ntschool.ru" target="_blank">school11</a> -->
		
		<!-- а здесь не показывает, проходит через "go.php" -->
		<a href="go.php?c=http://ntschool.ru" target="_blank">school</a>
		<a href="course_php_1_admin.php">admin</a>
		<a href="blog/index.php">my blog</a>
		<div>
			<p>выводим массив сервера print_r($_SERVER) в тегах pre через echo</p>
		</div>
	</body>
</html>

<?php  
	// выводим массив сервера
	echo "<pre>";
	print_r($_SERVER);
	echo "</pre>";
	date_default_timezone_set('Asia/Yekaterinburg');
	// создаем строку массива для записи в файл
	$info = [ 
		date("Y-m-d H:i:s"),
		// берем данные из массива "$_SERVER"
		$_SERVER['REQUEST_URI'],//урл
		$_SERVER['HTTP_REFERER'],//откуда пришел
		$_SERVER['REMOTE_ADDR'],//ip
		$_SERVER['HTTP_USER_AGENT']//браузер, система и т.д.
	];
	// implode - футкция соединения данных в строку через разделитель
	// в отличии от функции "explode" - которая вносит разделитель в строку
	// разрывая ее на отдельные элементы
	$to_save = implode('~@~', $info);

#####################################################################################
	// работа с файлом записываем информацию в файл
	/* нативный(природный, основной, базовый) сложный метод. 

	используем функцию "fopen", первым параметром: передаем имя файла
	второй параметр: r - чтение, w - запись, r+ - чтение и запись с созданием файла, w+ - перезапись с затиранием и созданием файла,   a - добавление в конец файла, a+ - добавление с созданием файла.(read, write, append)
	*/
	//$f = fopen('log.txt', 'a+');
	//fwrite($f, $to_save . "\n");//запись в файл $f - дает путь к файлу, $to_save - это переменная со строкой, так же делаем преренос строки
	// для того что бы каждый вход был на новой строке
	//fclose($f);//закрытие файла, сохранение происходит в момет закрытия

######################################################################################
	// Простой метод
	file_put_contents('log.txt', $to_save . "\n", FILE_APPEND);//помещает информацию внутрь файла

?>
