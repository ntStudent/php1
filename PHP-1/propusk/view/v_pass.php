<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<title>pass</title>
		<!-- <link rel="shortcut icon" href="../favicon.ico"> -->
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<a href="<?=@$msg133?>"><?=@$vLog?></a>
		<a href="login.php">Exit</a>
		<a href="listPass.php">List pass</a>
		<a href="addPass.php">Add news</a>
		<hr>
		<span class="error"><?=@$errors['msg12']?></span>
		<span><h4><?=@$dtrN?></h4></span>
		<span><h4><?=@$dtrE?></h4></span>
		<span><h2><?=@$atN?></h2></span>
		<span><h3><?=@$cta?></h3></span>
		<a href="<?=@$msg132?>"><?=@$vEdit?></a>
	</body>
</html>