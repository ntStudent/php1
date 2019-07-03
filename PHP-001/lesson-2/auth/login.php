<?php
session_start();

if(count($_POST) > 0){
	if($_POST['login'] == 'admin' && $_POST['password'] == 'qwerty'){
		$_SESSION['auth'] = true;//делаем метку в сессию что пароль и логин введены правильно

		header('Location: secretPage.php');
		exit();
	}
}
else{
	unset($_SESSION['auth']);
}

?>





<a href="../index.php">home</a>
<hr>
<form method="post">
	Логин<br>
	<input type="text" name="login"><br><br>
	Пароль<br>
	<input type="text" name="password"><br>
	<input type="checkbox" name="remember">Запомнить меня<br><br>
	<input type="submit" value="Войти">
	<!-- <p><?php//echo $msg; ?></p> -->
</form>