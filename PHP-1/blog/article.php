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

	//видим что имя файла идет сразу с расширением
	echo $fileName;
	/*
	проверки:
	- $fileName != ''
	- файл есть
	- файл не папка
	- ../add.php - нельзя предоставлять доступ к верхнему уровню папок(полный запрет) можно использовать 'strpos', или добавить расширение файлам
	*/

	///получаем расширение файла - Работает следующим образом: strrchr() возвращает участок строки, следующий за указанным параметром (точкой в нашем случае), после чего substr() отрезает первый символ — точку.
	function getExtension($fileName) {
    return substr(strrchr($fileName, '.'), 1);
	}
	//выводим расширение файла на экран
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