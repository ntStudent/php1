<?php
session_start();
include_once('../function/functions.php');
error_reporting(E_ALL ^ E_NOTICE);

//Подключение к базе данных
$db = new PDO('mysql:host=localhost;dbname=php1', 'root', '');// для MAMP ВСЕ root
//Установка кодировки
$db ->exec("SET NAMES UTF8");
//$db = connect_db();



if(count($_POST) > 0) {
	$name = ($_POST['name']);
	$text = ($_POST['text']);
	$lg = ($_POST['lang']);

	$name = safe($name);
	$text = safe($text);
	$lg = safe($lg); 

	if($name != '' && $text != '') {
		// Выводим запрос sql в отдельную строку (создаем запрос)
		$sql = "INSERT INTO articles (title, content, lang) VALUES('$name', '$text', '$lg')";
		//$sql = "INSERT INTO articles SET title='$name', content='$text', lang='$lg'";
		//Добавляем физически строку в базу данных двумя нижними строками
		$query = $db->prepare($sql);// подготавливаем
		$query->execute();//Выполняем запрос
		$_SESSION['don'] = 'Данные успешно добавлены в базу данных';

		//ПРОВЕРКА ОТПРАВКИ ЗАПРОСА В БАЗУ ДАННЫХ
		if($query->errorCode() != PDO::ERR_NONE){
			//echo 'Ошибка';
			$info = $query->errorInfo();
			echo implode('<br>', $info);
			//var_dump($info);
			die();
			//exit();
		}

		// Было так
		//$query = $db->prepare("INSERT INTO articles  (title, content, lang) VALUES('$name', '$text', '$lg')");
		//$query->execute();

		header("Location: index.php");
		exit();
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Добавить статью</title>
		<link rel="stylesheet" type="text/css" href="css/add.css">
	</head>
	<body>
		<a href="index.php">back to home</a>
		<form method="post">
			Название статьи <br>
			<input type="text" name="name" value="<?php echo $name;?>"><br>
			Текст статьи <br>
			<textarea name="text"><?php echo $text;?></textarea><br>

			<p>
				Выберите язык <br>
				<select name="lang">
					<option>english</option>
					<option>russian</option>
					
				</select>
			</p>
			<input type="submit" value="Отправить">
		</form>
	</body>
</html>



