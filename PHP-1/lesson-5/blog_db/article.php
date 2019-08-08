
<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include_once('../../function/functions.php');

// устанавливаем элемент 'back' для возвращения на эту страницу после авторизации 
$_SESSION['back'] = 'article.php' . '?fname=' . $_GET['fname'];

$db = connect_db();

//присваеваем переменной результат подключенной функции по авторизации
$auth = is_auth_db();
//показываем ссылку для авторизации если пользователь не авторизован
if (!$is_auth_db){
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
		<link rel="stylesheet" href="../css/add.css">
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
	$artName = $_GET['fname'];
	$id = $_GET['id'];
	$artName = safe($artName);
	$id = safe($id);
	$fex = 'data/error.log';
	$dtr = date('Y.m.d - H:i:s');

	$sql = "SELECT content FROM articles WHERE title=:aN";
	$params = ['aN' => $artName];
	$query = $db->prepare($sql);
	$query->execute($params);
	$comments = $query->fetchAll();
	
	if($query->errorCode() != PDO::ERR_NONE){
		$info = $query->errorInfo();
		// Создаем лог файл ошибок добавить дату
		echo 'ошибка <br>';
		echo "<a href=\"index.php\">Back</a>";
		file_put_contents($fex, $dtr . " > " . implode('-@-', $info) . "\n", FILE_APPEND);
		exit();
	}
	// header("Location: index.php");
	// exit();

	if($artName != ''){
		if (!$comments) {
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Нет такой статьи</div>";
		}
		else{
			echo "<h1>$artName</h1>";
			//выводим содержание статьи
			foreach ($comments as $key) {
				echo $key['content'];
			}
		}
		
		// если пользователь авторизован то показываем ссылку для редактирования
		if ($auth) {
		echo "<div style=\"font:bold 18px Arial; color:#bc0001; text-align:center;\"><h3><a href=\"edit.php?fname=$artName\">Edit news</a></h3></div>";
		}
	}
	else{
		echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Нет параметра GET</div>";
	}	
?>