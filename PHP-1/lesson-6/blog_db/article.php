
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
//показываем ссылку для авторизации если пользователь не авторизован
if (!$auth){
	$msg133 = 'login.php';
	$vLog = 'login';
}
// если пользователь авторизован то показываем ссылку для редактирования	
else{
	$msg132 = 'edit.php' . '?id=' . $id;
	$vEdit = 'Edit news';
}	
$comments = enter_article($db, $id);
	//Перенести во view
	if($id != ''){
		if (!$comments) {
			$msg12 = "Нет такой статьи-202";
		}
		else{
			//выводим содержание статьи
			foreach ($comments as $key) {
				$dtrN = $key['dt_reg'];
				$dtrE = $key['dt_edit'];
				$atN = $key['title'];
				$cta = $key['content'];
			}
		}
	}
	else{
		$msg12 = "Нет параметра GET-303";
	}	
include('view/view_all.php');
include('view/view_article.php');
?>