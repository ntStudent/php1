<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<title>add news</title>
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" href="css/add.css">
	</head>
	<body>
		<a href="index.php">Exit</a>
		<a href="listNews.php">List news</a>

		<hr size="5px" height="5px" align="left" width="400px" color="gray">

	    <div class="newsForm">
	    	<form method="post">
	           <p>
		           <label for="newsName">Название файла:</label>
		           <input type="text" name="name" id="newsName" value="<?=@$name;?>"><br>
		           <span class="error"><?=@$msg1?></span>
	           </p>

	           <br>

	            <p>
	            	<label class="text" for="newsContent">Содержимое файла:</label>
	            	<textarea name="text" id="newsContent"><?=@$text;?></textarea><br>
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

	            <p>
	            	<input type="submit" value="Сохранить"><br>
	            </p>
		    </form>
		    
		    <hr align="left" width="400px" color="red">
	    </div>
	    
	    <hr align="left" width="400px" color="red">
		<!-- <?php
			//echo $msg . '<br>';

			// echo 'Количество символов в имени - ' . mb_strlen($title) . '<br>';
			// echo 'Количество символов в содержании - ' . mb_strlen($content);
		?> -->
	</body>
</html>