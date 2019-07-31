<?php
session_start();
include_once('../../function/functions.php');
error_reporting(E_ALL ^ E_NOTICE);

$db = connect_db();
// $stmt = $dbh->prepare('SELECT EXISTS(SELECT 1 FROM articles WHERE title =:name LIMIT 1)');
// $stmt->bindValue(':title', $name, PDO::PARAM_INT);
// $stmt->execute();
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
// else{
// 	// уничтожаем элемент 'error' если авторизация пройдена
// 	unset($_SESSION['error']);
// }
unset($_SESSION['error']);
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
	
	//$fex = "data/$title.txt";

	//проверкa валидации 
	// 1) полей
	// 2) (*)что такого файла еще нет

#############################################################################################
//Проверка на уникальность
	$sql = "SELECT * FROM articles WHERE title = 'name'";
	$query = $db->prepare(sql);
	$query->execute();

	//так как имя статьи уникальное и может быть только одно такое имя то можго использовать просто - fetch - , виесто fetchAll.
	$count = $query->fetch();

	if (!$count){
		//такого имени нет можно создавать такую статью
	}
	else{
		//такое имя есть в базе нужно поменять имя
	}

	#############################################################################################

	//проверка длинны строки
	if ((mb_strlen($name) < 3)){
		$msg1 = "В имени  должно быть больше чем три символа";
	}
	//установка по тому из каких символов должна состоять строка
	// elseif(!preg_match('/[^0-9a-zA-Zа-яА-ЯЁё\s]+/msi', $name)){
	// 	$msg1 = "Имя  может содержать цифры, и буквы латинского алфавита";
	// }
	//проверка существования файла
	// elseif($stmt->fetch(PDO::FETCH_NUM)){
	// 	$msg1 = "Такой  уже существует введите другое имя";
	// }
	//проверка длинны строки содержания файла
	elseif (mb_strlen($text) < 4){
		$msg = "Содержимое должно содержать больше символов";
	}
	else{
		//$sql = "INSERT INTO articles (title, content, lang) VALUES(:name, :text, :lg)";
		//$sql = "INSERT INTO articles SET title='$name', content='$text', lang='$lg'";
		//Добавляем физически строку в базу данных двумя нижними строками
		$query = $db->prepare("INSERT INTO articles (title, content, lang) VALUES(:name, :text, :lg)");// подготавливаем

		$params = ['name' => $name, 'text' => $text, 'lg' => $lg];

		$query->execute($params);//Выполняем запрос
		$_SESSION['don'] = 'Данные успешно добавлены';

		//ПРОВЕРКА ОТПРАВКИ ЗАПРОСА В БАЗУ ДАННЫХ добавить для всех  SQL - запросов!!!!!!!!!!!!!!!!!!!!!!!!!
		if($query->errorCode() != PDO::ERR_NONE){
			//echo 'Ошибка';
			$info = $query->errorInfo();
###############################
			// Создаем лог файл ошибок добавить дату
			// echo 'ошибка <br>';
			// file_put_contents("error.log", implode('@@@', $info) . "\n", FILE_APPEND);
			// exit();
################################
			echo implode('<br>', $info);
			//var_dump($info);
			die();
			//exit();
		}
		header("Location: index.php");
		exit();
	}			
}
else{
	//GET
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