
<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include_once('../../function/functions.php');
$db = connect_db();
//echo md5('fffffff1111114444444');устаревшая функция шифрования
if (count($_POST) > 0) {
	$name = ($_POST['name']);
	$pass = ($_POST['password']);
	$pass_to = ($_POST['password_too']);
	//$lg = ($_POST['lang']);

	//прогоняем через функцию
	$name = safe($name);
	$pass = safe($pass);
	$pass_to = safe($pass_to);
	//$lg = safe($lg); 
	//$fex = "data/$title.txt";

	//проверкa валидации 
	// 1) полей
	// 2) (*)что такого файла еще нет

	//проверка длинны строки
	if ((mb_strlen($name) < 3)){
		$msg1 = "В имени  должно быть больше чем три символа";
	}
	//установка по тому из каких символов должна состоять строка
	elseif(!preg_match("/[0-9a-zA-Zа-яА-ЯЁё]/", $name)){
		$msg1 = "Имя  может содержать цифры, и буквы";
	}
	//проверка существования файла
	// elseif(file_exists($fex)){
	// 	$msg1 = "Такой  уже существует введите другое имя";
	// }
	//проверка длинны строки содержания файла
	elseif (mb_strlen($pass) < 8){
		$msg = "Пароль должен содержать не менее 8 символов";
	}
	elseif(!preg_match("/[0-9a-zA-Z]/", $pass)){
		$msg = "Имя  может содержать цифры, и буквы латинского алфавита";
	}
	elseif ($pass != $pass_to){
		$msg = "Пароль и повтор пароля должны совпадать";
	}
	else{
		$sql = "INSERT INTO users (log_in, pass_word) VALUES(:l, :p)";
		$params = ['l' => $name, 'p' => $pass];
		//$sql = "INSERT INTO articles SET title='$name', content='$text', lang='$lg'";
		//Добавляем физически строку в базу данных двумя нижними строками
		$query = $db->prepare($sql);// подготавливаем
		$query->execute($params);//Выполняем запрос
		//$_SESSION['don'] = 'Данные успешно добавлены в базу данных';

		//ПРОВЕРКА ОТПРАВКИ ЗАПРОСА В БАЗУ ДАННЫХ
		if($query->errorCode() != PDO::ERR_NONE){
			//echo 'Ошибка';
			$info = $query->errorInfo();
			echo implode('<br>', $info);
			//var_dump($info);
			die();
			//exit();
		}
		header("Location: login.php");
		exit();
	}	
}
else		
	// if ($_POST['login'] == 'admin' && md5($_POST['password']) == md5('qwerty')) {
	// 	$_SESSION['auth'] = true;

		// если стоит галочка в чекбоксе ## так как если чекбокс не отмечен галочкой то информация не уходит на
		// сервер поэтому достаточно проверить существует ли информация по этой галочке,
		// то есть if (isset($_POST['remember']));

		//ставим куку log pass если стоит галка в чекбоксе
		// if ($_POST['remember'] == 'on') {
		// 	setcookie('log', 'admin', time() + 360);
		// 	setcookie('pass', md5('qwerty'), time() + 360);	
		// }
		// проверяем есть ли в сессии элемент 'back' который устанавливается
		// на страницах, где нужна авторизация, если этот элемень есть то переходим по этому элементу
// 	if (isset($_SESSION['back'])) {
// 		header('Location: '.$_SESSION['back']);
// 		exit();
// 	}
// 	// если элемента 'back' нет переходим так
// 	else{
// 		header('Location: listNews.php');
// 		exit();
// 	}	
// 	// else{
// 	// 	$_SESSION['error1'] = "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\"> Заполните Логин и Пароль</div>";	
// 	// }
// }
// else{
// 	unset($_SESSION['auth']);
// 	unset($_SESSION['error1']);
// 	setcookie('log', 'admin', time() - 1);
//     setcookie('pass', 'qwerty', time() - 1);
// }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<title>Register</title>
	<link rel="shortcut icon" href="../favicon.ico">
	<link rel="stylesheet" href="../css/add.css">
</head>
<body>
	<a href="index.php">Home</a>
	<hr size="5px" height="5px" align="left" width="450px" color="gray">
	<div style="font:bold 18px Arial; color:#bc0001; text-align:center;"><h3>Зарегистрируйтесь</h3></div>
	
	<form method="POST">
		<!-- <p>
			<span class="error"><?=@$_SESSION['error']?></span>
			<span class="error"><?=@$_SESSION['error1']?></span>
		</p> -->
		<p>
	       <label for="newsName">Name:</label>
	       <input type="text" name="name" id="newsName" value="<?=@$name;?>"><br>
	       <span class="error"><?=@$msg1?></span>
	   </p>
	   <br><br>
		<p>
			<label class="text" for="Password_one">Password:</label>
			<input type="text" name="password" id="Password_one" value="<?=@$pass;?>"><br>
			<span class="error"><?=@$msg?></span>
		</p>
		<p>
			<label class="text" for="Password_to_one">Password replay:</label>
			<input type="text" name="password_too" id="Password_to_one" value="<?=@$pass_to;?>"><br>
			<span class="error"><?=@$msg?></span>
		</p>
		<!-- <input type="checkbox" name="remember" value="on">Запомнить меня <br><br> -->
		<input type="submit" value="Войти">
	</form>
</body>
</html>



