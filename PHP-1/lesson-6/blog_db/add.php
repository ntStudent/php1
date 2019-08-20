<?php
session_start();
include_once('../../function/functions.php');
include('model/model_add.php');
$db = connect_db();

//$_SESSION['error'] = "Авторизуйтесь-authEror-addphp";
// с помощью подключенной функции проверяем авторизацию
if(!is_auth_db()){
	// устанавливаем элемент 'error' для вывода сообщения если авторизация не пройдена
	$_SESSION['error'] = 'Авторизуйтесь';
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
	$count = unic_add($db, $name);
	//проверка существования такого же имени в базе данных
	if($count){
	 	$msg1 = "Такое имя уже существует введите другое имя";
	}
	//проверка длинны строки
	elseif ((mb_strlen($name) < 3)){
		$msg1 = "В имени  должно быть больше чем три символа";
	}
	//установка по тому из каких символов должна состоять строка
	elseif(!preg_match("/[0-9a-zA-Zа-яА-ЯЁё\s]/", $name)){
	 	$msg1 = "Имя  может содержать цифры, и буквы";
	}
	//проверка длинны строки содержания файла
	elseif (mb_strlen($text) < 4){
		$msg = "Статья должна содержать больше символов";
	}
	else{
		article_add($db, $name, $text, $lg);
		header("Location: index.php");
		exit();
	}			
}
else{
	//GET
}	
include('view/view_all.php');
include('view/view_add.php');
?>


