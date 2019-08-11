
<?php
	
	include_once('model/messeges.php');

	$db = new PDO ('mysql:host=localhost;dbname=mySite', 'root', '');//подключаемся к базе данных
	$db->exec("SET NAMES UTF8");//прописываем шрифт для базы данных

	
	$comments=messeges_all($db);

	include('view/view_index.php');

?>