<?php
// error_reporting(E_ALL); так настроено по умолчанию показывает все ошибки
// error_reporting(E_ALL ^ E_NOTICE); так не показываются нотайсы
?>


<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<title>news</title>
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" href="css/add.css">
	</head>
	<body>
		<a href="index.php">all news</a>
		<a href="add.php">add news</a>
		<hr>
<?php
	$fileName = $_GET['fname'];
	$fileName = trim($fileName);
	$fileName = stripslashes($fileName);
	$fileName = htmlspecialchars($fileName);
	/*
	проверки:
	- $fileName != ''
	- файл есть
	- файл не папка
	- ../add.php - нельзя предоставлять доступ к верхнему уровню папок(полный запрет) можно использовать 'strpos', или добавить расширение файлам
	*/

	// ПРОВЕРКА С РАСШИРЕНИЕМ НЕ СРАБАТЫВАЕТ НАДО ДОДЕЛАТЬ!!!!!!!!!!!!!!!!!!!!!!!!!!!!

	// if($fileName != '' && file_exists("data/$fileName") && is_file("data/$fileName")){
	// 	$fileContent = file_get_contents("data/$fileName"); 
	// 	echo "<h1>$fileName</h1>";
	// 	echo "<div>$fileContent</div>";
	// }
	// else{
	// 	echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">404 - Нет такой страницы</div>";
	// }

	if($fileName != ''){
		
		$fex1 = "data/$fileName";

		if(!file_exists($fex1)){//проверка существует ли файл
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Нет такого файла</div>";
		}
		elseif (!is_file($fex1)) {//проверка файл или папка добавляем расширение для защиты доступа к родительской папке
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Это не файл</div>";
		}
		else {
		$fileContent = file_get_contents("data/$fileName"); 
		echo "<h1>$fileName</h1>";
		echo "<div>$fileContent</div>";
		}
	}
	else{
		echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Нет параметра GET</div>";
	}
?>
	</body>
</html>