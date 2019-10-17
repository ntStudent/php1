<?php
	session_start();
	include_once('../../function/functions.php');
	include_once('model/model_add.php');
	include_once('view/view_all.php');
	$db = connect_db();
//AUTH
	if(!is_auth_db()){
		$_SESSION['error'] = 'Авторизуйтесь';
		header('Location: login.php');
		exit();		
	}
	else{
		unset($_SESSION['error']);
	}
//GET
	$id = $_GET['id'];
	$id = safe($id);
	$comments = enter_article($db, $id);
	$errors = [];
	foreach ($comments as $key) {
				$ct = $key['content'];
				$nt = $key['title'];
			}
	if($id != ''){
		if (!$comments) {
			$msg21 = 'Нет такой статьи-101';	
		}
	}
	else{
		$msg22 = 'Нет параметра GET-101';
	}
//POST
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
		$errors = messages_validate($count, $name, $text);
		foreach ($coun as $key) {
			$atN = $key['title'];
			$cta = $key['content'];
			$ida = $key['id_article'];
		}
		if(empty($errors)){
			if(isset($_POST['save'])){
				editArticle($db, $id, $text, $name, $lg);
				header("Location: listNews.php");
				exit();
		 	}	
		 	elseif(isset($_POST['delete'])){//проверка существования файла
	    		delArticle($db, $id);
				header("Location: listNews.php");
				exit();   
	 		}
		}
	}
include('view/view_edit.php');
?>	


