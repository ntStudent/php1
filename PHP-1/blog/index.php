<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<title>All news</title>
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" href="css/add.css">
	</head>
	<body>
		<a href="add.php">add news</a>
		<hr>
		<div><h2>LIST NEWS</h2></div>
		<HR>
		<?php
			$news = scandir('data');//перебираем содержимое папки "data"
			foreach ($news as $one) {
				if (is_file("data/$one")) {//-is_file- проверяет что не папка и выбирает файлы в указанной папке
					echo "<div><h3><a href=\"article.php?fname=$one\">$one</a></h3></div>";
				}
			}
			// echo "<pre>";
			// print_r($news);
			// echo "</pre>";
		?>
		
	</body>
</html>