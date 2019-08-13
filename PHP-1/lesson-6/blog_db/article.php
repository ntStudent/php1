
<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include_once('../../function/functions.php');
// устанавливаем элемент 'back' для возвращения на эту страницу после авторизации 
$_SESSION['back'] = 'article.php' . '?id=' . $_GET['id'];
$db = connect_db();
//присваеваем переменной результат подключенной функции по авторизации
$auth = is_auth_db();
//показываем ссылку для авторизации если пользователь не авторизован
if (!$auth){
	echo "<a href=\"login.php\">login</a>";
}			
// error_reporting(E_ALL); так настроено по умолчанию показывает все ошибки
// error_reporting(E_ALL ^ E_NOTICE); так не показываются нотайсы
include('view/view_all.php');
include('view/view_article.php');
?>
<?php
include('model/model_add.php');
// назначение переменной гет параметра
	$id = $_GET['id'];
	$id = (int)$id;
	//$artName = safe($artName);
	$comments = enter_article($db, $id);

	if($id != ''){
		if (!$comments) {
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Нет такой статьи</div>";
		}
		else{
			//выводим содержание статьи
			foreach ($comments as $key) {
				$atN = $key['title'];
				$cta = $key['content'];
				echo "<h2>$atN</h2>";
				echo "<h4>$cta</h4>";
			}
		}
		// если пользователь авторизован то показываем ссылку для редактирования
		if ($auth) {
		echo "<div style=\"font:bold 18px Arial; color:#bc0001; text-align:center;\"><h3><a href=\"edit.php?id=$id\">Edit news</a></h3></div>";
		}
	}
	else{
		echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Нет параметра GET</div>";
	}	
?>