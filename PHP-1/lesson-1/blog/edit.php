
<?php 
	include_once('functions.php');

	if(count($_POST) > 0){
		//POST
		$title = ($_POST['title']);
		$content = ($_POST['content']);
		echo "22222" . $title;
		//прогоняем через функцию
		$title = safe($title);
		$content = safe($content);
		$fex = "data/$title.txt";
		// проверкa валидации 
		//    1) полей
		// 2) (*)что такого файла еще нет

		if ((mb_strlen($title) < 3)){//проверка длинны строки
			$msg1 = "В имени файла должно быть больше чем три символа";
		}
		elseif(!preg_match("/^[a-zA-Z0-9]+$/", $title)){//установка по тому из каких символов должна состоять строка
			$msg1 = "Имя файла может содержать цифры, и буквы латинского алфавита";
		}
		// elseif(("$title.txt" != $_POST['title']) && (file_exists($fex))){//проверка существования файла
		// 	$msg1 = "Такой файл уже существует введите другое имя";
		// }
		elseif (mb_strlen($content) < 4){//проверка длинны строки содержания файла
			$msg = "Содержимое файла должно содержать больше символов";
		}
		else{
			unlink("data/$title.txt");
			file_put_contents($fex, $content);
			header("Location: index.php");
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
		$fileContent = file_get_contents($fex1); 
		//убираем расширение txt
		$fn = basename($fileName, ".txt");
		//выводим имя статьи без расширения
		//echo "<h1>$fn</h1>" . $fn . "<br>";
		//выводим содержание статьи
		// echo "<div>$fileContent</div>";
		}	
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
		<a href="../course_php_1-1.php">home</a>
		<a href="index.php">all news</a>
		<hr>
		

	    <div class="newsForm">
	    	<form method="post">
	           <p>
		           <label for="newsName">Название файла:</label><br>
		           <input type="text" name="title" id="newsName" value="<?=@$fn.@$title;?>"><br>
		           <span class="error"><?=@$msg1?></span>
	           </p>
	           <br>
	            <p>
	            	<label class="text" for="Content">Содержимое файла:</label><br>
	            	<textarea rows="16" cols="150" name="content" id="Content"><?=@$fileContent,@$content;?></textarea><br>
	            	<span class="error"><?=@$msg?></span>
	            </p>
	            <br>
	            <p>
	            	<input type="submit" value="Сохранить"><br>
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