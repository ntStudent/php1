<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<title>add news</title>
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" href="css/add.css">
		<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	</head>
	<body>
		<a href="index.php">Exit</a>
		<a href="listNews.php">List news</a>

		<hr size="5px" height="5px" align="left" width="700px" color="gray">
		
		<div class="name_page">
			<p>
				Добавить статью
			</p>
		</div>
		<hr size="3px" height="5px" align="left" width="700px" color="gray">

	    <div class="newsForm">
	    	<form method="post">
	           <p>
		           <label for="newsName">Название файла:</label><br>
		           <input type="text" name="name" id="newsName" value="<?=@$name;?>"><br>
		           <span class="error"><?=@$errors[msg1]?></span>
	           </p>
	             <p>
	            	<label class="text" for="newsContent">Содержимое файла:</label><br>
	            	<textarea id="newsContent" name="text"><?=@$text;?></textarea><br>
					<script>
						CKEDITOR.replace('newsContent');
					</script>
	            	<span class="error"><?=@$errors[msg]?></span>
	            </p>
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

	    </div>
	    <div>
	    	<hr align="left" width="700px" color="blue">
	    	<hr size="5px" align="left" width="700px" color="red">
	    </div>
	    
	    
		<!-- <?php
			//echo $msg . '<br>';

			// echo 'Количество символов в имени - ' . mb_strlen($title) . '<br>';
			// echo 'Количество символов в содержании - ' . mb_strlen($content);
		?> -->
	</body>
</html>