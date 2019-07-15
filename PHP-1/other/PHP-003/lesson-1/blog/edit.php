<?php
session_start();
include_once('../../function/functions.php');

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
		$title = ($_POST['title']);
		$content = ($_POST['content']);
		$fileName = $_GET['fname'];
		$fileName = $_GET['fname'];

	
		
		//прогоняем через функцию
		$title = safe($title);
		$content = safe($content);
		$fileName = safe($fileName);
        echo "<br>";
		echo $title . "<br>";
		echo "$title.txt <br>";
		echo $fileName . "<br>";
        //путь к файлу присваиваем переменной
		$fex = "data/$title.txt";
		
		// проверкa валидации 
		//    1) полей
		// 2) (*)что такого файла еще нет

		if ((mb_strlen($title) < 3)){//проверка длинны строки имени файла
			$msg1 = "В имени файла должно быть больше чем три символа";
		}
		elseif(!preg_match("/^[a-zA-Z0-9]+$/", $title)){//установка по тому из каких символов должна состоять строка
			$msg1 = "Имя файла может содержать цифры, и буквы латинского алфавита";
		}
		elseif(mb_strlen($content) < 4){//проверка длинны строки содержания файла
			$msg = "Содержимое файла должно содержать больше символов";
		}
		elseif("$title.txt"!= $fileName){//сравниваем имя файла в строке($_POST) и имя файла которое было($_GET)
			// if (file_exists($fex)){//проверка существования файла
		 // 	   $msg1 = "Такой файл уже существует введите другое имя";
		 // 	}
		 	if (isset($_POST['save'])){
		 		if (file_exists($fex)){//проверка существования файла
		 	   $msg1 = "Такой файл уже существует введите другое имя";
		 		}
		 		else{
		 			//rename("data/$fileName, data/$title");
					unlink("data/$fileName");
					file_put_contents($fex, $content);
					header("Location: listNews.php");
					exit();
		 		}
		    }
		    elseif (isset($_POST['delete'])) {
		    	if (file_exists($fex)){//проверка существования файла
		 	   $msg1 = "Вы не можете удалить другой файл введите имя открытого файла";
		 		}
		  //   	unlink("data/$fileName");
		  //   	header("Location: listNews.php");
				// exit();
		    }
		}
		elseif (isset($_POST['save'])){
			file_put_contents($fex, $content);
			header("Location: listNews.php");
			exit();
	    }
	    elseif (isset($_POST['delete'])) {
	    	unlink("data/$fileName");
	    	header("Location: listNews.php");
			exit();
	    }	
	}

	
	$fileName = $_GET['fname'];
	$fileName = safe($fileName);
	if($fileName != ''){
		$fex1 = "data/$fileName";
		if(!file_exists($fex1)){//проверка существует ли файл
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Нет такого файла</div>";
		}
		elseif (!is_file($fex1)) {//проверка файл или папка
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Это не файл</div>";
		}
		elseif (getExtension($fileName) != 'txt') {//проверка файла на расширение 
			echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Этот файл нельзя открыть</div>";
		}
		else {
		//получаем содержание файла по пути из переменной $fex1	
		$fileContent = file_get_contents($fex1);

		//убираем расширение txt для вывода имени в строке без расширения
		$fn = basename($fileName, ".txt");
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
		<link rel="stylesheet" href="css/add.css">
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
		           <input type="text" name="title" id="newsName" value="<?=@$fn;?>"><br>
		           <span class="error"><?=@$msg1?></span>
	           </p>
	           <br>
	            <p>
	            	<label class="text" for="Content">Содержимое файла:</label><br>
	            	<textarea rows="16" cols="150" name="content" id="Content"><?=@$fileContent;?></textarea><br>
	            	<span class="error"><?=@$msg?></span>
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