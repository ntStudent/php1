<?php
	foreach ($comments as $key) {
		$ct = $key['content'];
		$nt = $key['title'];
	}

	// foreach ($coun as $key) {
	// 	$atN = $key['title'];
	// 	$cta = $key['content'];
	// 	$ida = $key['id_article'];
	// }
?>







<!-- <!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<title>edit news</title>
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" href="css/add.css">
		<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	</head>
	<body> -->
		<!-- <a href="index.php">Exit</a>
		<a href="../course_php_1-1.php">Home</a>
		<a href="add.php">Add news</a>
		<a href="listNews.php">List  news</a> -->
		<hr>
		<span class="error"><?=@$errors[msg12]?></span>
		<!-- <span class="error"><?=@$msg22?></span> -->

	    <div class="newsForm">
	    	<form method="post">
	           <p>
		           <label for="newsName">Название файла:</label><br>
		           <input type="text" name="name" id="newsName" value="<?=@$nt;?>"><br>
		           <span class="error"><?=@$errors[msg1]?></span>
	           </p>
	           <br>
	            <p>
	            	<label class="text" for="Content">Содержимое файла:</label><br>
	            	<textarea id="Content" name="text"><?=@$ct;?></textarea>
					<script>
						CKEDITOR.replace('Content');
					</script> <br>
	            	<span class="error"><?=@$errors[msg]?></span>
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
<!-- 	</body>
</html> -->