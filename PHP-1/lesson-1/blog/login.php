

<a href="index.php">home</a>
<a href="add.php">add</a>
<a href="listNews.php">listNews</a>

<hr>
<?php
session_start();
date_default_timezone_set('Asia/Yekaterinburg');
if (count($_POST) > 0) {
	$_SESSION['slog'] = $_POST['login'];
	$_SESSION['spass'] = $_POST['password'];
	if ($_POST['login'] == 'admin' && $_POST['password'] == 'qwerty') {
		$_SESSION['auth'] = true;
		//если стоит галочка 
		//ставим куку log pass
		if ($_POST['remember'] == 'on') {
		setcookie('log', 'admin', time() + 360);
		setcookie('pass', 'qwerty', time() + 360);	
		}
		header('Location: listNews.php');
		exit();
	}
	else{
		$_SESSION['error1'] = "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\">Логин или Пароль неверно</div>";
		echo "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\"><a href=\"index.php\">Назад</a></div>";
	}
}
else{
	unset($_SESSION['auth']);
	unset($_SESSION['error1']);
}
?>

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


