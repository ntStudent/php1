<?php
session_start();
include_once('../../function/functions.php');
include('model/model_add.php');
include('model/sistem.php');
include('view/view_all.php');
$db = connect_db();
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
	$errors = messages_validate($count, $name, $text);

	if(empty($errors)){
		article_add($db, $name, $text, $lg);
		header("Location: listNews.php");
		exit();
	}
}
else{
	$name = '' ;
	$text = '' ;
	$errors = [] ;
}
$count = template('view/view_add.php', [
	'name' => $name,
	'text' => $text,
	'errors' => $errors
]);

$html = template('view/view_main.php', [
	'title' => 'Добавить новость',
	'content' => $count
]);
echo $html;
//include('view/view_add.php');


