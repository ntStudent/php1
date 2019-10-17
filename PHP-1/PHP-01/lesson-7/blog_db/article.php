
<?php
session_start();
include_once('../../function/functions.php');
include('model/model_add.php');
// назначение переменной гет параметра
$id = $_GET['id'];
$id = (int)$id;
// устанавливаем элемент 'back' для возвращения на эту страницу после авторизации 
$_SESSION['back'] = 'article.php' . '?id=' . $id;
$db = connect_db();
//присваеваем переменной результат подключенной функции по авторизации
$auth = is_auth_db();
$comments = enter_article($db, $id);
$errors = validate_article($id, $comments);
//показываем ссылку для авторизации если пользователь не авторизован
if (!$auth){
	$msg133 = 'login.php';
	$vLog = 'login';
}
// если пользователь авторизован то показываем ссылку для редактирования	
elseif(empty($errors)){
	$msg132 = 'edit.php' . '?id=' . $id;
	$vEdit = 'Edit news';
}	
if(empty($errors)){
	//выводим содержание статьи
	foreach ($comments as $key) {
		$dtrN = $key['dt_reg'];
		$dtrE = $key['dt_edit'];
		$atN = $key['title'];
		$cta = $key['content'];
	}
}	
include('view/view_all.php');
include('view/view_article.php');