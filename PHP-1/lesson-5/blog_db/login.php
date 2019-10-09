
<?php
session_start();
include_once('../../function/functions.php');
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Yekaterinburg');

$db = connect_db();
$fex = 'data/error.log';
$dtr = date('Y.m.d - H:i:s');

$log = $_POST['login'];
$pass = $_POST['password'];

$log = safe($log);
$pass = safe($pass);

$sql = "SELECT * FROM users WHERE log_in = :l AND pass_word = :p";
		$params = ['l' => $log, 'p' => $pass];
		$query = $db->prepare($sql);
		$query->execute($params);

	
		$count = $query->fetchAll();

		//foreach ($count as $key) {
			 
		//}


//echo md5('fffffff1111114444444');устаревшая функция шифрования
//if (count($_POST) > 0) {
	//if ($_POST['login'] ==  $key['log_in'] && md5($_POST['password']) == md5($key['pass_word'])) {
if ($_POST['login'] != '' && $_POST['password'] != '') {
	if ($count){
		$_SESSION['auth_db'] = true;

		// если стоит галочка в чекбоксе ## так как если чекбокс не отмечен галочкой то информация не уходит на
		// сервер поэтому достаточно проверить существует ли информация по этой галочке,
		// то есть if (isset($_POST['remember']));

		//ставим куку log pass если стоит галка в чекбоксе
		if ($_POST['remember'] == 'on') {
			setcookie('log',  $key['log_in'], time() + 360);
			setcookie('pass', md5($key['pass_word']), time() + 360);	
		}
		// проверяем есть ли в сессии элемент 'back' который устанавливается
		// на страницах, где нужна авторизация, если этот элемень есть то переходим по этому элементу
		if (isset($_SESSION['back'])) {
			header('Location: '. $_SESSION['back']);
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
	unset($_SESSION['auth_db']);
	unset($_SESSION['error1']);
	setcookie('log',   $key['log_in'], time() - 1);
    setcookie('pass',  md5($key['pass_word']), time() - 1);
}
?>

<title>Login</title>
<link rel="shortcut icon" href="../favicon.ico">
<link rel="stylesheet" href="../css/add.css">

<a href="index.php">Home</a>
<hr>

<p>
		<span class="error"><?=@$_SESSION['error']?></span>
		<span class="error"><?=@$_SESSION['error1']?></span>
	</p>

<form method="POST">
	

	<p>
	       <label for="newsName">Логин:</label>
	       <input type="text" name="login" id="newsName" value="<?=@$log;?>"><br>
	       
  
	<p>
		<label class="text" for="Password_one">Пароль:</label>
		<input type="password" name="password" id="Password_one" value="<?=@$pass;?>"><br>
		
	</p>
	 <br>
	<p>
		<label class="checkbox" for="Password_to_one">Запомнить меня</label>
		<input type="checkbox" name="remember" id="Password_to_one" value="on"><br>
		
	</p>

	<!-- Логин <br>
	<input type="text" name="login"><br><br>
	Пароль <br>
	<input type="password" name="password"> <br>
	<input type="checkbox" name="remember" value="on">Запомнить меня <br><br> -->
	<input type="submit" value="Войти">
</form>


