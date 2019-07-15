
<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include_once('../../function/functions.php');

// устанавливаем элемент 'back' для возвращения на эту страницу после авторизации 
$_SESSION['back'] = 'article.php' . '?fname=' . $_GET['fname'];

//присваеваем переменной результат подключенной функции по авторизации
$auth = is_auth();
//показываем ссылку для авторизации если пользователь не авторизован
if (!$is_auth){
	echo "<a href=\"login.php\">login</a>";
}			
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
		<a href="index.php">Exit</a>
		<a href="listNews.php">List news</a>
		<a href="add.php">Add news</a>
		<hr>
	</body>
</html>
<?php
// назначение переменной гет параметра
	$fileName = $_GET['fname'];
	$fileName = safe($fileName);
	$auth = is_auth();

	//видим что имя файла идет сразу с расширением
	//echo $fileName;
	/*
	проверки:
	- $fileName != ''
	- файл есть
	- файл не папка
	- ../add.php - нельзя предоставлять доступ к верхнему уровню папок(полный запрет) можно использовать 'strpos', или добавить расширение файлам
	*/

	//выделение расширения файла используем подключенную функцию
	$gex = getExtension($fileName);
	//выводим на экран
	//echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Расширение файла - \"$gex\"</div>";

	if($fileName != ''){
		
		$fex1 = "data/$fileName";

		//проверка существует ли файл
		if(!file_exists($fex1)){
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Вы не можете открыть файл с таким именем</div><br><br>";
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\"><a href=\"listNews.php\">Назад</a></div>";
		}

		//проверка файл или папка
		elseif (!is_file($fex1)) {
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Вы хотите открыть не файл это запрещено</div><br><br>";
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\"><a href=\"listNews.php\">Назад</a></div>";
		}

		//проверка файла на расширение
		elseif ($gex != 'txt') { 
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">У вас нет доступа для открытия этого файла</div><br><br>";
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\"><a href=\"listNews.php\">Назад</a></div>";
		}
		else {
			$fileContent = file_get_contents($fex1); 
			//убираем расширение txt
			$fn = basename($fileName,"." . $gex);
			//выводим имя статьи без расширения
			echo "<h1>$fn</h1>";
			//выводим содержание статьи
			echo "<div>$fileContent</div>";
			// если пользователь авторизован то показываем ссылку для редактирования
			if ($auth) {
				echo "<div style=\"font:bold 18px Arial; color:#bc0001; text-align:center;\"><h3><a href=\"edit.php?fname=$fileName\">Edit news</a></h3></div>";
			}
		}
	}
	else{
		echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Нет параметра GET</div>";
	}	
?>