<?php
	session_start();
	include_once('../../function/functions.php');
	include_once('model/model_add.php');
	include_once('view/view_all.php');
	$db = connect_db();

	if(!is_auth_db()){
		$_SESSION['error'] = 'Авторизуйтесь';
		// "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\"><p>Авторизуйтесь</p></div>";
		header('Location: login.php');
		exit();		
	}
	else{
		unset($_SESSION['error']);
	}
	if(count($_POST) > 0){
		//POST
		$name = ($_POST['name']);
		$text = ($_POST['text']);
		$lg = ($_POST['lang']);
		$fileName = $_GET['fname'];
		$id = $_GET['id'];

		//прогоняем через функцию
		$fileName = safe($fileName);
		$name = safe($name);
		$text = safe($text);
		$lg = safe($lg);
		$id = safe($id);

		$coun = enter_article($db, $id);
		$count = unicNameArticle($db, $name, $id);
		foreach ($coun as $key) {
			$atN = $key['title'];
			$cta = $key['content'];
			$ida = $key['id_article'];
		}
		if ((mb_strlen($name) < 2)){//проверка длинны строки имени файла
			$msg1 = "В имени файла должно быть больше чем три символа";
		}
		elseif(!preg_match("/[0-9a-zA-Zа-яА-ЯЁё\s]/", $name)){
			$msg1 = "Имя файла может содержать цифры, и буквы";
		}
		elseif(mb_strlen($text) < 4){//проверка длинны строки содержания файла
			$msg = "Содержимое файла должно содержать больше символов";
		}
		elseif (isset($_POST['save'])){
	 		if ($count){//проверка существования файла
	 	   		$msg1 = "Такой файл уже существует введите другое имя";
	 		}
	 		else{
				editArticle($db, $id, $text, $name, $lg);
				header("Location: listNews.php");
				exit();	
	 		}
	 	}
	 	elseif (isset($_POST['delete'])) {
	    	if ($count){//проверка существования файла
		 	   $msg1 = "Вы не можете удалить другой файл введите имя открытого файла";
	 		}
	 		else{
				delArticle($db, $id);
				header("Location: listNews.php");
				exit();
		    }
	    }
	}
	$id = $_GET['id'];
	$id = safe($id);
	$comments = enter_article($db, $id);
	foreach ($comments as $key) {
				$ct = $key['content'];
				$nt = $key['title'];
			}
	if($id != ''){
		if (!$comments) {
			$msg21 = 'Нет такой статьи-101';
			// echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Нет такой статьи1</div>";
		}
	}
	else{
		$msg22 = 'Нет параметра GET-101';
		// echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Нет параметра GE1T</div>";
	}
include_once('view/view_edit.php');
?>	


