<?php
session_start();

include_once('../../function/functions.php');
include('model/model_add.php');

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

	$count = unic_add($db);

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


