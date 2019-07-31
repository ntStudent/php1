<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include_once('../../function/functions.php');
$db = new PDO('mysql:host=localhost;dbname=php1', 'root', '');
$db ->exec("SET NAMES UTF8");

#########################################
if(!is_auth()){
	$_SESSION['error'] = "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\"><p>Авторизуйтесь</p></div>";
	header('Location: listNews.php');
	exit();		
}
else{
	unset($_SESSION['error']);
}
##########################################

	if(count($_POST) > 0){
		//POST
		$name = ($_POST['name']);
		$text = ($_POST['text']);
		$lg = ($_POST['lang']);
		$fileName = $_GET['fname'];
		$id = $_GET['id_article'];

		//прогоняем через функцию
		$name = safe($name);
		$text = safe($text);
		$lg = safe($lg);
		$fileName = safe($fileName);
		$id = safe($id);
  //       echo "<br>";
		// echo $title . "<br>";
		// echo "$title.txt <br>";
		// echo $fileName . "<br>";
        //путь к файлу присваиваем переменной
		// $fex = "data/$title.txt";
		
		// проверкa валидации 
		//    1) полей
		// 2) (*)что такого файла еще нет

//Проверяем уникальность имени статьи при редактировании проверяя все статьи кроме текущей определяя ее по id
		sql = "SELECT * FROM articles WHERE title = 'name' AND id_article != '$id'";
		$query = $db->prepare(sql);
		$query->execute();

	//так как имя статьи уникальное и может быть только одно такое имя то можго использовать просто - fetch - , виесто fetchAll.
	$count = $query->fetch();

		if ((mb_strlen($name) < 3)){//проверка длинны строки имени файла
			$msg1 = "В имени файла должно быть больше чем три символа";
		}
		elseif(!preg_match('/[^0-9a-zA-Zа-яА-ЯЁё\s]+/msi', $name)){//установка по тому из каких символов должна состоять строка "/[^(\w)|(\x7F-\xFF)|(\s)]/"###"/^[0-9a-zA-Zа-яА-ЯЁё]+$/u"
			$msg1 = "Имя файла может содержать цифры, и буквы латинского алфавита";
		}
		elseif(mb_strlen($text) < 4){//проверка длинны строки содержания файла
			$msg = "Содержимое файла должно содержать больше символов";
		}
		elseif("$name"!= $fileName){//сравниваем имя файла в строке($_POST) и имя файла которое было($_GET)
			// if (file_exists($fex)){//проверка существования файла
		 // 	   $msg1 = "Такой файл уже существует введите другое имя";
		 // 	}
		 	if (isset($_POST['save'])){
		 		// if (file_exists($fex)){//проверка существования файла
		 	 //   $msg1 = "Такой файл уже существует введите другое имя";
		 		// }
		 		
		 			//rename("data/$fileName, data/$title");
					// unlink("data/$fileName");
					// file_put_contents($fex, $content);

		 		###################################################################################
		 		// Защита от SQL - ИНЪЕКЩИЙ
				// 1-й вариант
		 		###########################################################
		 		$sql = "INSERT INTO articles (title, content, lang) VALUES(:n, :t, :l)";
				$params = ['n' => $name, 't' => $text, 'l' => $lg];
				$query = $db->prepare($sql);// подготавливаем
				$query->execute($params);//Выполняем запрос
				###################################################################



				// 2-й вариант
		 		###########################################################
		 		#$sql = "INSERT INTO articles (title, content, lang) VALUES(:n, :t, :l)";
				#$query = $db->prepare($sql);// подготавливаем
				#$query->bindParam(':n', $name);
				#$query->bindParam(':t', $text);
				#$query->bindParam(':l', $lg);
				#$query->execute();//Выполняем запрос
				###################################################################
				##################################################################################



				if($query->errorCode() != PDO::ERR_NONE){
					//echo 'Ошибка';
					$info = $query->errorInfo();
					echo implode('<br>', $info);
					//var_dump($info);
					die();
					//exit();
				}
				
				header("Location: listNews.php");
				exit();
		 	
		    }
		    elseif (isset($_POST['delete'])) {
		    	// $sql = "DELETE FROM articles WHERE title='$fileName'";
		    	// $query->execute();
		    	// if (file_exists($fex)){//проверка существования файла
		 	   $msg1 = "Вы не можете удалить другой файл введите имя открытого файла";
		 		//}
		    }
		}
		elseif (isset($_POST['save'])){
			$sql = "INSERT INTO articles (content) VALUES(:text)";
				//$sql = "INSERT INTO articles SET title='$name', content='$text', lang='$lg'";
				//Добавляем физически строку в базу данных двумя нижними строками
			$query = $db->prepare($sql);// подготавливаем
			$params = ['text' => $text];
			$query->execute($params);//Выполняем запрос
			if($query->errorCode() != PDO::ERR_NONE){
				//echo 'Ошибка';
				$info = $query->errorInfo();
				echo implode('<br>', $info);
				//var_dump($info);
				die();
				//exit();
			}

			$_SESSION['don'] = 'Данные успешно добавлены';

		//ПРОВЕРКА ОТПРАВКИ ЗАПРОСА В БАЗУ ДАННЫХ
			if($query->errorCode() != PDO::ERR_NONE){
			//echo 'Ошибка';
			$info = $query->errorInfo();
			echo implode('<br>', $info);
			//var_dump($info);
			die();
			//exit();
			}
			
			header("Location: listNews.php");
			exit();
	    }
	    elseif (isset($_POST['delete'])) {
	    	$sql = "DELETE FROM articles WHERE title=:fileName";
	    	$query = $db->prepare($sql);
	    	$params = ['fileName' => $fileName];
		    $query->execute($params);
	    	header("Location: listNews.php");
			exit();
	    }	
	}

	
	$fileName = $_GET['fname'];
	$fileName = safe($fileName);
	$sql = "SELECT content FROM articles WHERE title='$fileName'";
	$query = $db->prepare($sql);
	$query->execute();
	$comments = $query->fetchAll();
	foreach ($comments as $key) {
				$ct = $key['content'];
			}

	// if($fileName != ''){
	// 	// $fex1 = "data/$fileName";
	// 	if(!file_exists($fex1)){//проверка существует ли файл
	// 		echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Нет такого файла</div>";
	// 	}
	// 	elseif (!is_file($fex1)) {//проверка файл или папка
	// 		echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Это не файл</div>";
	// 	}
	// 	elseif (getExtension($fileName) != 'txt') {//проверка файла на расширение 
	// 		echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Этот файл нельзя открыть</div>";
	// 	}
	// 	else {
	// 	//получаем содержание файла по пути из переменной $fex1	
	// 	$fileContent = file_get_contents($fex1);

	// 	//убираем расширение txt для вывода имени в строке без расширения
	// 	$fn = basename($fileName, ".txt");
	// 	}	
	// }
	// else{
	// 	echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Нет параметра GET</div>";
	// }
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