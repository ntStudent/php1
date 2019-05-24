<?php
//подключаем файл с функциями
include_once ('functions.php');
if(count($_POST) > 0){
	//POST

	$title = ($_POST['title']);
	$content = ($_POST['content']);

	//прогоняем через функцию
	$title = safe($title);
	$content = safe($content);

	$fex = "data/$title.txt";
	/*
	проверкa валидации 
	   1) полей*/ 
	// 2) (*)что такого файла еще нет

	if ((mb_strlen($title) < 3)){//проверка длинны строки
		$msg1 = "В имени файла должно быть больше чем три символа";
	}
	elseif(!preg_match("/^[a-zA-Z0-9]+$/", $title)){//установка по тому из каких символов должна состоять строка
		$msg1 = "Имя файла может содержать цифры, и буквы латинского алфавита";
	}
	elseif(file_exists($fex)){//проверка существования файла
		$msg1 = "Такой файл уже существует введите другое имя";
	}
	elseif (mb_strlen($content) < 4){//проверка длинны строки содержания файла
		$msg = "Содержимое файла должно содержать больше символов";
	}
	else{
		file_put_contents($fex, $content);
		header("Location: index.php");
		exit();
	}			
}
else{
	//GET
}
	
?>


<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<title>add news</title>
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
		           <label for="newsName">Название файла:</label>
		           <input type="text" name="title" id="newsName" value="<?=@$title;?>"><br>
		           <span class="error"><?=@$msg1?></span>
	           </p>
	           <br>
	            <p>
	            	<label class="text" for="newsContent">Содержимое файла:</label>
	            	<textarea name="content" id="newsContent"><?=@$content;?></textarea><br>
	            	<span class="error"><?=@$msg?></span>
	            </p>
	            <br>
	            <p>
	            	<input type="submit" value="Сохранить"><br>
	            </p>
		    </form>
		    <hr>
	    </div>
	    <hr>
<!-- <?php
	//echo $msg . '<br>';

	// echo 'Количество символов в имени - ' . mb_strlen($title) . '<br>';
	// echo 'Количество символов в содержании - ' . mb_strlen($content);
?> -->
	</body>
</html>