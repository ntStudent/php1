<?php
	session_start();
	error_reporting(E_ALL ^ E_NOTICE);
	include_once('../../function/functions.php');
	$db = connect_db();

	if(!is_auth_db()){
		$_SESSION['error'] = "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\"><p>Авторизуйтесь</p></div>";
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
		echo $name . "qqqq<br>";
		echo $id . "-ddd<br>";
		echo $fileName . "-ddd<br>";

		$fex = 'data/error.log';
		$dtr = date('Y.m.d - H:i:s');

		$sql1 = "SELECT * FROM articles WHERE id_article=:i";
		$params1 = ['i' => $id];
		$query = $db->prepare($sql1);
		$query->execute($params1);
		$coun = $query->fetchAll();

		if($query->errorCode() != PDO::ERR_NONE){
			$info = $query->errorInfo();
			// Создаем лог файл ошибок добавить дату
			echo 'ошибка1 <br>';
			echo "<a href=\"index.php\">Back</a>";
			file_put_contents($fex, $dtr . " > " . implode('-@-', $info) . "\n", FILE_APPEND);
			exit();
		}

		//Проверяем уникальность имени статьи при редактировании проверяя все статьи кроме текущей определяя ее по id
		$sql = "SELECT content FROM articles WHERE title = :n AND id_article != :i";
		$params = ['n' => $name, 'i' => $id];
		$query = $db->prepare($sql);
		$query->execute($params);
		$count = $query->fetchAll();

		if($query->errorCode() != PDO::ERR_NONE){
			$info = $query->errorInfo();
			// Создаем лог файл ошибок добавить дату
			echo 'ошибка1 <br>';
			echo "<a href=\"index.php\">Back</a>";
			file_put_contents($fex, $dtr . " > " . implode('-@-', $info) . "\n", FILE_APPEND);
			exit();
		}
		foreach ($coun as $key) {
			$atN = $key['title'];
			$cta = $key['content'];
			$ida = $key['id_article'];
			echo $atN . "<br>";
			echo $cta . "<br>";
			echo $ida . "<br>";
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
	//elseif($name != $atN){//сравниваем имя файла в строке($_POST) и имя файла которое было($_GET)
		elseif (isset($_POST['save'])){
	 		if ($count){//проверка существования файла
	 	   		$msg1 = "Такой файл уже существует введите другое имя";
	 		}
	 		else{
	 			//$sql = "DELETE FROM articles WHERE id_article=:i";
	 			$sql = "UPDATE articles SET lang = :l, title = :tl, content=:t WHERE id_article=:i";

				$params = ['i' => $id, 't' => $text, 'tl' => $name, 'l' => $lg];
				$query = $db->prepare($sql);
				$query->execute($params);
				header("Location: listNews.php");
				exit();
				// $count = $query->fetch();

				if($query->errorCode() != PDO::ERR_NONE){
					$info = $query->errorInfo();
					// Создаем лог файл ошибок добавить дату
					echo 'ошибка1 <br>';
					echo "<a href=\"index.php\">Back</a>";
					file_put_contents($fex, $dtr . " > " . implode('-@-', $info) . "\n", FILE_APPEND);
					exit();
				}
	 		}
	 	}
	 	elseif (isset($_POST['delete'])) {
	    	if ($count){//проверка существования файла
		 	   $msg1 = "Вы не можете удалить другой файл введите имя открытого файла";
	 		}
	 		 else{
	    		$sql2 = "DELETE FROM articles WHERE id_article=:i";
				$params2 = ['i' => $id];
				$query = $db->prepare($sql2);
				$query->execute($params2);
				header("Location: listNews.php");
				exit();

				if($query->errorCode() != PDO::ERR_NONE){
					$info = $query->errorInfo();
					// Создаем лог файл ошибок добавить дату
					echo 'ошибка1 <br>';
					echo "<a href=\"index.php\">Back</a>";
					file_put_contents($fex, $dtr . " > " . implode('-@-', $info) . "\n", FILE_APPEND);
					exit();
				}
		    }
	    }
	   
	
	}

	$id = $_GET['id'];
	$id = safe($id);

	$sql = "SELECT * FROM articles WHERE id_article=:i";
	$params = ['i' => $id];
	$query = $db->prepare($sql);
	$query->execute($params);

	if($query->errorCode() != PDO::ERR_NONE){
		$info = $query->errorInfo();
		// Создаем лог файл ошибок добавить дату
		echo 'ошибка5 <br>';
		echo "<a href=\"index.php\">Back</a>";
		file_put_contents($fex, $dtr . " > " . implode('-@-', $info) . "\n", FILE_APPEND);
		exit();
	}
			// header("Location: index.php");
			// exit();
	$comments = $query->fetchAll();
	foreach ($comments as $key) {
				$ct = $key['content'];
				$nt = $key['title'];
			}
	if($id != ''){
		if (!$comments) {
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Нет такой статьи</div>";
		}
	}
	else{
		echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Нет параметра GET</div>";
	}

?>	

<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<title>edit news</title>
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" href="../css/add.css">
	</head>
	<body>
		<a href="index.php">Exit</a>
		<a href="../course_php_1-1.php">Home</a>
		<a href="add.php">Add news</a>
		<a href="listNews.php">List  news</a>
		<hr>
		

	    <div class="newsForm">
	    	<form method="post">
	           <p>
		           <label for="newsName">Название файла:</label><br>
		           <input type="text" name="name" id="newsName" value="<?=@$nt;?>"><br>
		           <span class="error"><?=@$msg1?></span>
	           </p>
	           <br>
	            <p>
	            	<label class="text" for="Content">Содержимое файла:</label><br>
	            	<textarea rows="16" cols="150" name="text" id="Content"><?=@$ct;?></textarea><br>
	            	<span class="error"><?=@$msg?></span>
	            </p>
	            <br>


	            <p> 
				Выберите язык <br>
				<select name="lang">
					<option value="" selected="selected">-</option>
					<option>english</option>
					<option>russian</option>
				</select>
				</p>
				<br>
	            <p>
	            	<input type="submit" name="save" value="Сохранить"><br>
	            </p>
	            <p>
	            	<input type="submit" name="delete" value="Удалить"><br>
	            </p>
		    </form>
		    
	    </div>
	   
<!-- <?php
	//echo $msg . '<br>';

	// echo 'Количество символов в имени - ' . mb_strlen($title) . '<br>';
	// echo 'Количество символов в содержании - ' . mb_strlen($content);
?> -->		
	</body>
</html>
