<?php
session_start();
include_once('../../function/functions.php');
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Yekaterinburg');

$db = connect_db();

// с помощью подключенной функции проверяем авторизацию
if(!is_auth_db()){
	
	// устанавливаем элемент 'error' для вывода сообщения если авторизация не пройдена
	$_SESSION['error'] = "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\"><p>Авторизуйтесь1</p></div>";

	// устанавливаем элемент 'back' для возвращения на эту страницу после авторизации 
	$_SESSION['back'] = 'add.php';

	//если авторизация не пройдена перекидывает на эту страницу
	header('Location: login.php');
	exit();		
}
unset($_SESSION['error']);

if(count($_POST) > 0){
	//POST
	$name = ($_POST['name']);
	$text = ($_POST['text']);
	$lg = ($_POST['lang']);

	//прогоняем через функцию
	$name = safe($name);
	$text = safe($text);
	$lg = safe($lg); 

	$fex = 'data/error.log';
	$dtr = date('Y.m.d - H:i:s');

	//проверкa валидации 
	// 1) полей
	// 2) (*)что такого файла еще нет

//Проверка на уникальность
	$sql = "SELECT * FROM articles WHERE title = :n";
	$params = ['n' => $name];
	$query = $db->prepare($sql);
	$query->execute($params);
	//так как имя статьи уникальное и может быть только одно такое имя то можго использовать просто - fetch - , виесто fetchAll.
	$count = $query->fetch();

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

	//проверка длинны строки
	if ((mb_strlen($name) < 3)){
		$msg1 = "В имени  должно быть больше чем три символа";
	}
	//установка по тому из каких символов должна состоять строка
	elseif(!preg_match("/[0-9a-zA-Zа-яА-ЯЁё\s]/", $name)){
	 	$msg1 = "Имя  может содержать цифры, и буквы";
	 }
	//проверка существования такого же имени в базе данных
	 elseif($count){
	 	$msg1 = "Такое имя уже существует введите другое имя";
	 }
	//проверка длинны строки содержания файла
	elseif (mb_strlen($text) < 4){
		$msg = "Содержимое должно содержать больше символов";
	}
	else{
		
		$query = $db->prepare("INSERT INTO articles (title, content, lang) VALUES(:n, :t, :l)");// подготавливаем
		$params = ['n' => $name, 't' => $text, 'l' => $lg];
		$query->execute($params);//Выполняем запрос
	    $_SESSION['don'] = "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\"><p>Данные успешно добавлены</p></div>";

		//ПРОВЕРКА ОТПРАВКИ ЗАПРОСА В БАЗУ ДАННЫХ добавить для всех  SQL - запросов!!!!!!!!!!!!!!!!!!!!!!!!!
		if($query->errorCode() != PDO::ERR_NONE){
			$info = $query->errorInfo();
			// Создаем лог файл ошибок добавить дату
			echo 'ошибка <br>';
			echo "<a href=\"index.php\">Back</a>";
			file_put_contents($fex, $dtr . " > " . implode('-@-', $info) . "\n", FILE_APPEND);
			exit();
		}
		header("Location: listNews.php");
		exit();
	}			
}
// else{
// 	//GET
// }	
?>


<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<title>add news</title>
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" href="../css/add.css">
	</head>
	<body>
		<a href="index.php">Exit</a>
		<a href="listNews.php">List news</a>

		<hr size="5px" height="5px" align="left" width="400px" color="gray">

	    <div class="newsForm">
	    	<form method="post">
	           <p>
		           <label for="newsName">Название файла:</label>
		           <input type="text" name="name" id="newsName" value="<?=@$name;?>"><br>
		           <span class="error"><?=@$msg1?></span>
	           </p>

	           <br>

	            <p>
	            	<label class="text" for="newsContent">Содержимое файла:</label>
	            	<textarea name="text" id="newsContent"><?=@$text;?></textarea><br>
	            	<span class="error"><?=@$msg?></span>
	            </p>

	            <br>

	            <p>
				Выберите язык <br>
				<select name="lang">
					<option value="" selected="selected">-</option>
					<option>english</option>
					<option>russian</option>
				</select>
				</p>

	            <p>
	            	<input type="submit" value="Сохранить"><br>
	            </p>
		    </form>
		    
		    <hr align="left" width="400px" color="red">
	    </div>
	    
	    <hr align="left" width="400px" color="red">
		<!-- <?php
			//echo $msg . '<br>';

			// echo 'Количество символов в имени - ' . mb_strlen($title) . '<br>';
			// echo 'Количество символов в содержании - ' . mb_strlen($content);
		?> -->
	</body>
</html>