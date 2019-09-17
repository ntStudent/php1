
<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include_once('../../function/functions.php');
include_once('model/model_add.php');
include('view/view_all.php');
$db = connect_db();

if (count($_POST) > 0) {
	$name = ($_POST['name']);
	$pass = ($_POST['password']);
	$pass_to = ($_POST['password_too']);
	//$lg = ($_POST['lang']);

	//прогоняем через функцию
	$name = safe($name);
	$pass = safe($pass);
	$pass_to = safe($pass_to);
	
	//проверка длинны строки
	if ((mb_strlen($name) < 3)){
		$msg1 = "В имени  должно быть больше чем три символа";
	}
	//установка по тому из каких символов должна состоять строка
	elseif(!preg_match("/[0-9a-zA-Zа-яА-ЯЁё]/", $name)){
		$msg1 = "Имя  может содержать цифры, и буквы";
	}
	//проверка длинны строки содержания файла
	elseif (mb_strlen($pass) < 8){
		$msg = "Пароль должен содержать не менее 8 символов";
	}
	elseif(!preg_match("/[0-9a-zA-Z]/", $pass)){
		$msg = "Имя  может содержать цифры, и буквы латинского алфавита";
	}
	elseif ($pass != $pass_to){
		$msg = "Пароль и повтор пароля должны совпадать";
	}
	else{
		is_register($db, $name, $pass);
		header("Location: login.php");
		exit();
	}	
}
else		
?>
<?php
	include('view/view_register.php');
?>






