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
		$id = $_GET['id_article'];

		//прогоняем через функцию
		$fileName = safe($fileName);
		$name = safe($name);
		$text = safe($text);
		$lg = safe($lg);
		$id = safe($id);

		$fex = 'data/error.log';
		$dtr = date('Y.m.d - H:i:s');

		//Проверяем уникальность имени статьи при редактировании проверяя все статьи кроме текущей определяя ее по id
		$sql = "SELECT * FROM articles WHERE title = :n AND id_article != :i";
		$params = ['n' => $name, 'i' => $id];
		$query = $db->prepare($sql);
		$query->execute($params);
		$count = $query->fetch();

		if($query->errorCode() != PDO::ERR_NONE){
			$info = $query->errorInfo();
			// Создаем лог файл ошибок добавить дату
			echo 'ошибка1 <br>';
			echo "<a href=\"index.php\">Back</a>";
			file_put_contents($fex, $dtr . " > " . implode('-@-', $info) . "\n", FILE_APPEND);
			exit();
		}

		if ((mb_strlen($name) < 3)){//проверка длинны строки имени файла
			$msg1 = "В имени файла должно быть больше чем три символа";
		}
		elseif(!preg_match("/[0-9a-zA-Zа-яА-ЯЁё\s]/", $name)){
			$msg1 = "Имя файла может содержать цифры, и буквы";
		}
		elseif(mb_strlen($text) < 4){//проверка длинны строки содержания файла
			$msg = "Содержимое файла должно содержать больше символов";
		}
		elseif($name != $fileName){//сравниваем имя файла в строке($_POST) и имя файла которое было($_GET)
			if (isset($_POST['save'])){
		 		if ($count){//проверка существования файла
		 	   		$msg1 = "Такой файл уже существует введите другое имя";
		 		}
		 		else{
		 			$sql = "DELETE FROM articles WHERE title=:n";
					$params = ['n' => $fileName];
					$query = $db->prepare($sql);
					$query->execute($params);
					// $count = $query->fetch();

					if($query->errorCode() != PDO::ERR_NONE){
						$info = $query->errorInfo();
						// Создаем лог файл ошибок добавить дату
						echo 'ошибка1 <br>';
						echo "<a href=\"index.php\">Back</a>";
						file_put_contents($fex, $dtr . " > " . implode('-@-', $info) . "\n", FILE_APPEND);
						exit();
					}


					$sql = "INSERT INTO articles (title, content, lang) VALUES(:n, :t, :l)";
					$params = ['n' => $name, 't' => $text, 'l' => $lg];
					$query = $db->prepare($sql);// подготавливаем
					$query->execute($params);//Выполняем запрос
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
		 	elseif (isset($_POST['delete'])) {
		    	if ($count){//проверка существования файла
		 	   $msg1 = "Вы не можете удалить другой файл введите имя открытого файла";
		 		}
		    }
		}
		elseif (isset($_POST['save'])){

			$sql = "DELETE FROM articles WHERE title=:n";
			$params = ['n' => $fileName];
			$query = $db->prepare($sql);
			$query->execute($params);
			// $count = $query->fetch();

			if($query->errorCode() != PDO::ERR_NONE){
				$info = $query->errorInfo();
				// Создаем лог файл ошибок добавить дату
				echo 'ошибка1 <br>';
				echo "<a href=\"index.php\">Back</a>";
				file_put_contents($fex, $dtr . " > " . implode('-@-', $info) . "\n", FILE_APPEND);
				exit();
			}



			$sql = "INSERT INTO articles (title, content, lang) VALUES(:n, :t, :l)";
			$params = ['n' => $name, 't' => $text, 'l' => $lg];
			$query = $db->prepare($sql);// подготавливаем
			$query->execute($params);//Выполняем запрос
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
	    elseif (isset($_POST['delete'])) {
	    	$sql = "DELETE FROM articles WHERE title=:n";
			$params = ['n' => $fileName];
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

	$fileName = $_GET['fname'];
	$fileName = safe($fileName);

	$sql = "SELECT content FROM articles WHERE title=:fN";
	$params = ['fN' => $fileName];
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
			}
	if($fileName != ''){
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
		           <input type="text" name="name" id="newsName" value="<?=@$fileName;?>"><br>
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
