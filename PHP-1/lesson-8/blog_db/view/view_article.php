<?php
// echo $comments;
// foreach($comments as $one){
// 	$qwer = $one['title'];
// 	echo $qwer;
// }
foreach ($comments as $key) {
		$dtrN = $key['dt_reg'];
		$dtrE = $key['dt_edit'];
		$atN = $key['title'];
		$cta = $key['content'];
	}
?>


<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<title>news</title>
		<!-- <link rel="shortcut icon" href="../favicon.ico"> -->
		<link rel="stylesheet" href="css/add.css">
	</head>
	<body>
		<a href="<?=@$msg133?>"><?=@$vLog?></a>
		<!-- <a href="login.php">Exit</a>
		<a href="listNews.php">List news</a>
		<a href="add.php">Add news</a> -->
		<!-- <hr> -->
		<span class="error"><?=@$errors['msg12']?></span>
		<span><h4>Дата создания -<?=@$dtrN?></h4></span>
		<span><h4>Дата редактирования - <?=@$dtrE?></h4></span><br>
		<span><h2><?=@$atN?></h2></span>
		<span><h3><?=@$cta?></h3></span>
	</body>
</html>