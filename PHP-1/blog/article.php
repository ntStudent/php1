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
	/*
	проверки:
	- $fileName != ''
	- файл есть
	- файл не папка
	*/
	
	if($fileName != ''){
		$fex1 = "data/$fileName";

		if(!file_exists($fex1)){//проверка существует ли файл
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Нет такого файла</div>";
		}
		elseif (!is_file("data/$fileName")) {//проверка файл или папка
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Это не файл</div>";
		}
		else {
		$fileContent = file_get_contents("data/$fileName"); 
		echo "<h1>$fileName</h1>";
		echo "<div>$fileContent</div>";
		}
	}
?>
	</body>
</html>