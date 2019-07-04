<?php
session_start();
include_once('../../function/functions.php');
$_SESSION['back'] = 'article.php' . '?fname=' . $_GET['fname'];
$auth = auth();
error_reporting(E_ALL ^ E_NOTICE);
#########################################
// if (!isset($_SESSION['auth'])) {
// 	if ($_COOKIE['log'] == 'admin' && $_COOKIE['pass'] == md5('qwerty')){
// 		$_SESSION['auth'] == true;
// 	}
// 	else {
// 		$_SESSION['error'] = "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\"><p>Авторизуйтесь</p><a href=\"index.php\">Назад</a></div>";
// 		header('Location: login.php');
// 		exit();
// 	}	
// }
// else{
// 	unset($_SESSION['error']);
// }
##########################################
// if(!auth()){
// 	$_SESSION['error'] = "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\"><p>Авторизуйтесь</p><a href=\"index.php\">Назад</a></div>";
// 	header('Location: listNews.php');
// 	exit();		
// }
// else{
// 	unset($_SESSION['error']);
// }
##########################################

if (!$auth){
	echo "<a href=\"login.php\">login</a>";
}
			
?>





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
		<a href="index.php">Exit</a>
		<a href="listNews.php">List news</a>
		<a href="add.php">Add news</a>
		
		<hr>
<?php

	include_once('../../function/functions.php');
	error_reporting(E_ALL ^ E_NOTICE);

	$fileName = $_GET['fname'];
	$fileName = safe($fileName);
	$auth = auth();

	//видим что имя файла идет сразу с расширением
	//echo $fileName;

	/*
	проверки:
	- $fileName != ''
	- файл есть
	- файл не папка
	- ../add.php - нельзя предоставлять доступ к верхнему уровню папок(полный запрет) можно использовать 'strpos', или добавить расширение файлам
	*/

	//выводим расширение файла на экран используем функцию
	$gex = getExtension($fileName);
	//echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Расширение файла - \"$gex\"</div>";

	if($fileName != ''){
		
		$fex1 = "data/$fileName";
		//echo $fex1;

		if(!file_exists($fex1)){//проверка существует ли файл
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Вы не можете открыть файл с таким именем</div><br><br>";
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\"><a href=\"listNews.php\">Назад</a></div>";
		}
		elseif (!is_file($fex1)) {//проверка файл или папка
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Вы хотите открыть не файл это запрещено</div><br><br>";
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\"><a href=\"listNews.php\">Назад</a></div>";
		}
		elseif ($gex != 'txt') {//проверка файла на расширение 
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

		if ($auth) {
			echo "<div style=\"font:bold 18px Arial; color:#bc0001; text-align:center;\"><h3><a href=\"edit.php?fname=$fileName\">Edit news</a></h3></div>";
		}
		}
	}
	else{
		echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Нет параметра GET</div>";
	}

	 
?>
	</body>
</html>