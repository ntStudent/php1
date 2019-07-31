
<?php
session_start();
//echo md5('fffffff1111114444444');устаревшая функция шифрования
if (count($_POST) > 0) {
	if ($_POST['login'] == 'admin' && md5($_POST['password']) == md5('qwerty')) {
		$_SESSION['auth'] = true;

		// если стоит галочка в чекбоксе ## так как если чекбокс не отмечен галочкой то информация не уходит на
		// сервер поэтому достаточно проверить существует ли информация по этой галочке,
		// то есть if (isset($_POST['remember']));

		//ставим куку log pass если стоит галка в чекбоксе
		if ($_POST['remember'] == 'on') {
			setcookie('log', 'admin', time() + 360);
			setcookie('pass', md5('qwerty'), time() + 360);	
		}
		// проверяем есть ли в сессии элемент 'back' который устанавливается
		// на страницах, где нужна авторизация, если этот элемень есть то переходим по этому элементу
		if (isset($_SESSION['back'])) {
			header('Location: '.$_SESSION['back']);
			exit();
		}
		// если элемента 'back' нет переходим так
		else{
			header('Location: listNews.php');
			exit();
		}	
	}
	else{
		$_SESSION['error1'] = "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Логин или Пароль неверны</div>";	
	}
}
else{
	unset($_SESSION['auth']);
	unset($_SESSION['error1']);
	setcookie('log', 'admin', time() - 1);
    setcookie('pass', 'qwerty', time() - 1);
}
?>

<title>Login</title>
<link rel="shortcut icon" href="../favicon.ico">
<!-- <link rel="stylesheet" href="css/add.css"> -->
<a href="index.php">Home</a>
<hr>
<form method="POST">
	<p>
		<span class="error"><?=@$_SESSION['error']?></span>
		<span class="error"><?=@$_SESSION['error1']?></span>
	</p>
	Логин <br>
	<input type="text" name="login"><br><br>
	Пароль <br>
	<input type="text" name="password"> <br>
	<input type="checkbox" name="remember" value="on">Запомнить меня <br><br>
	<input type="submit" value="Войти">
</form>


