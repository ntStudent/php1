<!-- <!DOCTYPE html>
<html lang="ru">
<head>
	<title>Register</title> -->
	<!-- <link rel="shortcut icon" href="../favicon.ico">
	<link rel="stylesheet" href="css/add.css"> -->
<!-- </head>
<body> -->
	<!-- <a href="index.php">Home</a> -->
	<hr size="5px" height="5px" align="left" width="450px" color="gray">
	<div style="font:bold 18px Arial; color:#bc0001; text-align:center;"><h3>Зарегистрируйтесь</h3></div>

	<form method="POST">
		<!-- <p>
			<span class="error"><?//=@$_SESSION['error']?></span>
			<span class="error"><?//=@$_SESSION['error1']?></span>
		</p> -->
		<p>
	       <label for="newsName">Name:</label>
	       <input type="text" name="name" id="newsName" value="<?=@$name;?>"><br>
	       <span class="error"><?=@$errors[msg1]?></span>
	   </p>
	   <br><br>
		<p>
			<label class="text" for="Password_one">Password:</label>
			<input type="text" name="password" id="Password_one" value="<?=@$pass;?>"><br>
			<span class="error"><?=@$errors[msg]?></span>
		</p>
		<p>
			<label class="text" for="Password_to_one">Password replay:</label>
			<input type="text" name="password_too" id="Password_to_one" value="<?=@$pass_to;?>"><br>
			<span class="error"><?=@$errors[msg2]?></span>
		</p>
		<!-- <input type="checkbox" name="remember" value="on">Запомнить меня <br><br> -->
		<input type="submit" value="Зарегистрироваться">
	</form>
<!-- </body>
</html> -->