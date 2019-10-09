
<?php
session_start();
include_once('../function/functions.php');
include_once('model/function_db.php');
// назначение переменной гет параметра
$id = $_GET['id'];
$id = (int)$id;
echo $id;
// устанавливаем элемент 'back' для возвращения на эту страницу после авторизации 
$_SESSION['back'] = 'pass.php' . '?id=' . $id;
$db = connect_db();
//присваеваем переменной результат подключенной функции по авторизации
$auth = is_auth_db();
$comments = enter_guest($db, $id);
// $errors = [];
$errors = validate_guest($id, $comments);
//показываем ссылку для авторизации если пользователь не авторизован
if (!$auth){
	$msg133 = 'login.php';
	$vLog = 'login';
}
// если пользователь авторизован то показываем ссылку для редактирования	
// elseif(empty($errors)){
// 	$msg132 = 'edit.php' . '?id=' . $id;
// 	$vEdit = 'Edit news';
// }	
if(empty($errors)){
	//выводим содержание статьи
	foreach ($comments as $key) {
		$dtrN = $key['dt_visit'];
		$dtrE = $key['dt_departure'];
		$atN = $key['surname'];
		$cta = $key['name_g'];
		echo $dtrN;
	}
}	
// include('view/view_all.php');
include('view/v_pass.php');