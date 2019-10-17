
<?php
session_start();
include_once('../../function/functions.php');
include('model/model_add.php');
include_once('view/view_all.php');
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Yekaterinburg');
$db = connect_db();
$log = $_POST['login'];
$pass = $_POST['password'];
$log = safe($log);
$pass = safe($pass);
$count = is_login($db, $log, $pass);
foreach ($count as $key) {	 
}
//echo md5('fffffff1111114444444');устаревшая функция шифрования
if (count($_POST) > 0) {
	if ($_POST['login'] != '' && $_POST['password'] != '') {
		if ($_POST['login'] ==  $key['log_in'] && md5($_POST['password']) == md5($key['pass_word'])) {
			$_SESSION['auth_db'] = true;
			// если стоит галочка в чекбоксе ## так как если чекбокс не отмечен галочкой то информация не уходит на
			// сервер поэтому достаточно проверить существует ли информация по этой галочке,
			// то есть if (isset($_POST['remember']));
			//ставим куку log pass если стоит галка в чекбоксе
			if ($_POST['remember'] == 'on') {
				setcookie('log',  $key['log_in'], time() + 360);
				setcookie('pass', md5($key['pass_word']), time() + 360);	
			}
			// проверяем есть ли в сессии элемент 'back' который устанавливается
			// на страницах, где нужна авторизация, если этот элемень есть то переходим по этому элементу
			if (isset($_SESSION['back'])) {
				header('Location: '. $_SESSION['back']);
				exit();
			}
			// если элемента 'back' нет переходим так
			else{
				header('Location: listNews.php');
				exit();
			}	
		}
		else{
			$_SESSION['error1'] = "Логин или Пароль неверны";	
		}
	}
	else{
		$_SESSION['error1'] = "Введите Логин и Пароль";
	}
}
else{
	unset($_SESSION['auth_db']);
	unset($_SESSION['error1']);
	setcookie('log',   $key['log_in'], time() - 1);
    setcookie('pass',  md5($key['pass_word']), time() - 1);
}
include('view/view_login.php');
?>




