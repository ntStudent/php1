
<?php
session_start();
include_once('../../function/functions.php');
include('model/model_add.php');
include('model/sistem.php');
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
// if (!$auth){
// 	$msg133 = 'login.php';
// 	$vLog = 'login';
// }
// // если пользователь авторизован то показываем ссылку для редактирования
if($auth){
	$vEdit = "<li><a href=\"edit.php?id=$id\">Edit news</a></li>";
	//echo $vEdit;
}
// if(empty($errors)){
// 	//выводим содержание статьи
// 	foreach ($comments as $key) {
// 		$dtrN = $key['dt_reg'];
// 		$dtrE = $key['dt_edit'];
// 		$atN = $key['title'];
// 		$cta = $key['content'];
// 	}
// }
$content = template('view/view_article.php', [
	'comments' => $comments,
	'ref' => $msg132,
	'ref_name' => $vEdit,
	'errors' => $errors

]);
// $content = template('view/view_article.php', [
// 	// 'aview' => $msg132,
// 	// 'aview1' => $msg133,
// 	// 'aview2' => $vLog,
// 	'comments' => $comments,
// 	'aview3' => $errors,
// 	'aview4' => $dtrN,
// 	'aview5' => $dtrE,
// 	'aview6' => $atN,
// 	'aview7' => $cta,
// 	'aview8' => $vEdit
// ]);

$html = template('view/view_main.php', [
	'title' => "Статья № $id",
	'content' => $content,
	'content1' => $vEdit
]);
echo $html;
// echo $content;
include('view/view_all.php');
// include('view/view_article.php');