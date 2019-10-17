
<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include_once('../../function/functions.php');

// устанавливаем элемент 'back' для возвращения на эту страницу после авторизации 
$_SESSION['back'] = 'article.php' . '?id=' . $_GET['id'];

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
	$id = $_GET['id'];
	$id = (int)$id;
	//$artName = safe($artName);
	$fex = 'data/error.log';
	$dtr = date('Y.m.d - H:i:s');

	$sql = "SELECT * FROM articles WHERE id_article=:i";
	$params = ['i' => $id];
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

	if($id != ''){
		if (!$comments) {
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Нет такой статьи</div>";
		}
		else{
			
			//выводим содержание статьи
			foreach ($comments as $key) {
				$atN = $key['title'];
				$cta = $key['content'];
				$id = $key['id_article'];

				echo "<h2>$atN</h2>";
				echo "<h4>$cta</h4>";
			}
		}
		
		// если пользователь авторизован то показываем ссылку для редактирования
		if ($auth) {
		echo "<div style=\"font:bold 18px Arial; color:#bc0001; text-align:center;\"><h3><a href=\"edit.php?id=$id\">Edit news</a></h3></div>";
		}
	}
	else{
		echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Нет параметра GET</div>";
	}	
?>