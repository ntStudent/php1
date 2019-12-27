
<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include_once('../../function/functions.php');
include_once('model/model_add.php');
include('view/view_all.php');
include('model/sistem.php');
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
	$errors = validate_register($name, $pass, $pass_to);

	if(empty($errors)){
		is_register($db, $name, $pass);
		header("Location: login.php");
		exit();
	}
}

$content = template('view/view_register.php', [
	'comments' => $comments,
	'n' => $name,
	'p' => $pass,
	'pt' => $pass_to,
	'errors' => $errors
]);

$html = template('view/view_main.php', [
	'title' => 'Регистрация',
	'content' => $content,
]);
echo $html;
	// include('view/view_register.php');






