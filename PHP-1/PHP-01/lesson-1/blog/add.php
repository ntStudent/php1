<?php
session_start();
//подключаем файл с функциями
include_once('../../function/functions.php');
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
	$title = ($_POST['title']);
	$content = ($_POST['content']);

	//прогоняем через функцию
	$title = safe($title);
	$content = safe($content);
	$fex = "data/$title.txt";

	//проверкa валидации 
	// 1) полей
	// 2) (*)что такого файла еще нет

	//проверка длинны строки
	if ((mb_strlen($title) < 3)){
		$msg1 = "В имени файла должно быть больше чем три символа";
	}
	//установка по тому из каких символов должна состоять строка
	elseif(!preg_match("/^[a-zA-Z0-9]+$/", $title)){
		$msg1 = "Имя файла может содержать цифры, и буквы латинского алфавита";
	}
	//проверка существования файла
	elseif(file_exists($fex)){
		$msg1 = "Такой файл уже существует введите другое имя";
	}
	//проверка длинны строки содержания файла
	elseif (mb_strlen($content) < 4){
		$msg = "Содержимое файла должно содержать больше символов";
	}
	else{
		file_put_contents($fex, $content);
		header("Location: index.php");
		exit();
	}			
}
else{
	//GET
}	
?>


<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<title>add news</title>
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" href="css/add.css">
	</head>
	<body>
		<!-- <a href="../course_php_1-1.php">home</a> -->
		<a href="index.php">Exit</a>
		<a href="listNews.php">List news</a>

		<hr size="5px" height="5px" align="left" width="400px" color="gray">

	    <div class="newsForm">
	    	<form method="post">
	           <p>
		           <label for="newsName">Название файла:</label>
		           <input type="text" name="title" id="newsName" value="<?=@$title;?>"><br>
		           <span class="error"><?=@$msg1?></span>
	           </p>

	           <br>

	            <p>
	            	<label class="text" for="newsContent">Содержимое файла:</label>
	            	<textarea name="content" id="newsContent"><?=@$content;?></textarea><br>
	            	<span class="error"><?=@$msg?></span>
	            </p>

	            <br>

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