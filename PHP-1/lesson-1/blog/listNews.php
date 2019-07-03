<?php
session_start();

if (!isset($_SESSION['auth']) && ($_COOKIE['log'] != $_SESSION['slog']) && ($_COOKIE['pass'] != $_SESSION['spass'])) {
	$_SESSION['error'] = "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\"><p>Авторизуйтесь</p><a href=\"index.php\">Назад</a></div>";
	header('Location: login.php');
	exit();	
}
else{
	unset($_SESSION['error']);
}
?>
<a href="login.php">Выйти</a>
<a href="index.php">home</a>




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

		<hr>

		
	</body>
</html>