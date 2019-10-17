<!doctype html>
<html lang="ru">
	<head>
	    <meta charset="UTF-8">
	    <meta name="viewport"
	          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	    <title>SQL-unjedtions</title>
	    <link rel="stylesheet" href="css/lesson-5.css">
	</head>
	<body>
	    
	    <ul class="link">
	        <li><a href="index.php">comments</a></li>
	        <!-- <li><a href="security.php">security</a></li>
	        <li><a href="SQL-fix.php">FIX</a></li>
	        <li><a href="XSS-attack.php">XSS</a></li> -->
	    </ul>
	    <hr>
	    <hr>
	<div class="form">
	    <form method="post">
	        <p>
	            <label for="name">Укажите ваше имя:</label><br>
	            <input id="name" type="text" name="name" value="<?=@$name;?>" placeholder="Ваше имя" autofocus>
	        </p>
	        <p>
	            <label for="text">Ваше сообщение:</label><br>
	            <textarea name="text" id="text" cols="30" rows="10"><?=@$text;?></textarea>
	        </p>
	        <input type="submit" value="Отправить">
	    </form>
	</div>
	<br>
	    <hr>
	    <hr>
	</body>
</html>