<?php
session_start();
include_once('../../function/functions.php');
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Yekaterinburg');

$db = connect_db();
#########################################
// с помощью подключенной функции проверяем авторизацию
if(!is_auth()){
	// устанавливаем элемент 'error' для вывода сообщения если авторизация не пройдена
	$_SESSION['error'] = "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\"><p>Авторизуйтесь</p></div>";
	// устанавливаем элемент 'back' для возвращения на эту страницу после авторизации 
	$_SESSION['back'] = 'add.php';
	//если авторизация не пройдена перекидывает на эту страницу
	header('Location: login.php');
	exit();		
}
else{
	// уничтожаем элемент 'error' если авторизация пройдена
	unset($_SESSION['error']);
}

##########################################
if(count($_POST) > 0){
	//POST
	$name = ($_POST['name']);
	$text = ($_POST['text']);
	$lg = ($_POST['lang']);

	//прогоняем через функцию
	$name = safe($name);
	$text = safe($text);
	$lg = safe($lg); 
	$fex = "data/error.log";
	$dt_er_log = date('Y.m.d - H:i:s');

	//проверкa валидации 
	// 1) полей
	// 2) (*)что такого файла еще нет

#############################################################################################
//Проверка на уникальность
	$query = $db->prepare("SELECT * FROM articles WHERE title = 'name'");
	$query->execute();
	// if($query->errorCode() != PDO::ERR_NONE){
	// 	$info = $query->errorInfo();
	// 	 echo 'ошибка2<br>';
	// 	 file_put_contents($fex, $dt_er_log . " - " . implode('@', $info) . "\n", FILE_APPEND);
	// 	 exit();
	// }
//так как имя статьи уникальное и может быть только одно такое имя то можго использовать просто - fetch - , вместо fetchAll.
	$count = $query->fetch();
	if($count){
	 	$msg1 = " введите другое имя";
	}
	#############################################################################################
		//проверка длинны строки
	elseif ((mb_strlen($name) < 3)){
		$msg1 = "В имени  должно быть больше чем три символа";
	}
	//установка по тому из каких символов должна состоять строка
	elseif(!preg_match("/^[a-zA-Z0-9\s]+$/i", $name)){
		$msg1 = "Имя  может содержать цифры, и буквы латинского алфавита";
	}
	//проверка длинны строки содержания файла
	elseif (mb_strlen($text) < 4){
		$msg = "Содержимое должно содержать больше символов";
	}
	else{
		$query = $db->prepare("INSERT INTO articles (title, content, lang) VALUES(:name, :text, :lg)");// подготавливаем
		$params = ['name' => $name, 'text' => $text, 'lg' => $lg];
		$query->execute($params);
		// $_SESSION['don'] = 'Данные успешно добавлены';

		//ПРОВЕРКА ОТПРАВКИ ЗАПРОСА В БАЗУ ДАННЫХ добавить для всех  SQL - запросов!!!!!!!!!!!!!!!!!!!!!!!!!
		if($query->errorCode() != PDO::ERR_NONE){
			//echo 'Ошибка';
			$info = $query->errorInfo();
	###############################
			// Создаем лог файл ошибок добавить дату
			 echo 'ошибка1 <br>';
			 file_put_contents($fex, $dt_er_log . " - " . implode('@', $info) . "\n", FILE_APPEND);
			 exit();
	################################
			 // echo implode('<br>', $info);
			 // var_dump($info);
			 // die();
			// //exit();
		}
		header("Location: index.php");
		exit();
	}	
}		
?>


<!-- <!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<title>add news</title>
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" href="css/add.css">
	</head>
	<body> -->
		<!-- <a href="../course_php_1-1.php">home</a> -->
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