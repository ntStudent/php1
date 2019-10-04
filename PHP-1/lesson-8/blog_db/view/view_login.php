<!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="media1/add.css">
	<title>Login</title>
</head>
<body>
	<div id="wrapper">
		<header>
			<div class="header line">
				<div class="wrapper">
					<div class="logo"></div>
					<div class="slogan">
						<div class="title">Рога и копыта</div>
						<div class="subtitle">Всем по рогам, всем по копытам.</div>
					</div>
					<div class="phone">8 800 800 80 80</div>
				</div>
			</div>		
			<div class="menu line">
				<div class="wrapper">
					<nav>
						<div class="show_menu">Меню</div>
						<ul>
							<li><a href="index.php">Главная</a></li>
							<li><a href="#">О компании</a></li>
							<li><a href="#">Продукты</a></li>
							<li><a href="#">Услуги</a></li>
							<li><a href="#">Контакты</a></li>
						</ul>					
					</nav>
				</div>
			</div>		
		</header>
		<section>
			<div class="content line">
				<div class="wrapper">
					<div class="content">
						<!-- <a href="index.php">Home</a> -->
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
					</div>
					
				</div>
			</div>
		</section>
		<footer>
			<div class="footer line">
				<div class="wrapper">
					<span class="copy">&copy; ООО Рога и Копыта, Москва 2014, все права защищены!</span>
				</div>
			</div>
		</footer>
	</div>	
	<script src="media1/js/jquery-1.11.0.min.js" type="text/javascript"></script>
	<script src="media1/js/scripts.js" type="text/javascript"></script>
</body>
</html>
