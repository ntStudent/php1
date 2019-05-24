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
	include_once('functions.php');

	$fileName = $_GET['fname'];
	$fileName = safe($fileName);

	//видим что имя файла идет сразу с расширением
	echo $fileName;

	/*
	проверки:
	- $fileName != ''
	- файл есть
	- файл не папка
	- ../add.php - нельзя предоставлять доступ к верхнему уровню папок(полный запрет) можно использовать 'strpos', или добавить расширение файлам
	*/

	//выводим расширение файла на экран используем функцию
	$gex = getExtension($fileName);
	echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Расширение файла - \"$gex\"</div>";

	if($fileName != ''){
		
		$fex1 = "data/$fileName";

		if(!file_exists($fex1)){//проверка существует ли файл
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Нет такого файла</div>";
		}
		elseif (!is_file($fex1)) {//проверка файл или папка
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Это не файл</div>";
		}
		elseif (getExtension($fileName) != 'txt') {//проверка файла на расширение 
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Этот файл нельзя открыть</div>";
		}
		else {
		$fileContent = file_get_contents($fex1); 
		//убираем расширение txt
		$fn = basename($fileName, ".txt");
		//выводим имя статьи без расширения
		echo "<h1>$fn</h1>";
		//выводим содержание статьи
		echo "<div>$fileContent</div>";
		}
	}
	else{
		echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Нет параметра GET</div>";
	}

	 echo "<div style=\"font:bold 18px Arial; color:#bc0001; text-align:center;\"><h3><a href=\"edit.php?fname=$fileName\">Edit news</a></h3></div>";
?>
	</body>
</html>