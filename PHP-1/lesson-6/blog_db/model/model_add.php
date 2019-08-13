<?php
	date_default_timezone_set('Asia/Yekaterinburg');
	function article_add($db, $name, $text, $lg){
		$fex = 'data/error.log';
		$dtr = date('Y.m.d - H:i:s');
		$query = $db->prepare("INSERT INTO articles (title, content, lang) VALUES(:n, :t, :l)");// подготавливаем
		$params = ['n' => $name, 't' => $text, 'l' => $lg];
		$query->execute($params);//Выполняем запрос
	    $_SESSION['don'] = "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\"><p>Статья успешно добавлена</p></div>";

		//ПРОВЕРКА ОТПРАВКИ ЗАПРОСА В БАЗУ ДАННЫХ добавить для всех  SQL - запросов!!!!!!!!!!!!!!!!!!!!!!!!!
		if($query->errorCode() != PDO::ERR_NONE){
			$info = $query->errorInfo();
			// Создаем лог файл ошибок добавить дату
			echo 'ошибка <br>';
			echo "<a href=\"index.php\">Back</a>";
			file_put_contents($fex, $dtr . " > " . implode('-@-', $info) . "\n", FILE_APPEND);
			exit();
		}
		return $db->lastInsertId();
	}

	function unic_add($db){
		//Проверка на уникальность
		$fex = 'data/error.log';
		$dtr = date('Y.m.d - H:i:s');
		$sql = "SELECT * FROM articles WHERE title = :n";
		$params = ['n' => $name];
		$query = $db->prepare($sql);
		$query->execute($params);
		//так как имя статьи уникальное и может быть только одно такое имя то можго использовать просто - fetch - , виесто fetchAll.
		$count = $query->fetch();

		if($query->errorCode() != PDO::ERR_NONE){
			$info = $query->errorInfo();
			// Создаем лог файл ошибок добавить дату
			echo 'ошибка <br>';
			echo "<a href=\"index.php\">Back</a>";
			file_put_contents($fex, $dtr . " > " . implode('-@-', $info) . "\n", FILE_APPEND);
			exit();
		}

		$result = $query->fetchAll();
		return $result;
	}

	function enter_article($db, $id){
		$fex = 'data/error.log';
		$dtr = date('Y.m.d - H:i:s');
		$sql = "SELECT * FROM articles WHERE id_article=:i";
		$params = ['i' => $id];
		$query = $db->prepare($sql);
		$query->execute($params);
		
		
		if($query->errorCode() != PDO::ERR_NONE){
			$info = $query->errorInfo();
			// Создаем лог файл ошибок добавить дату
			echo 'ошибка <br>';
			echo "<a href=\"index.php\">Back</a>";
			file_put_contents($fex, $dtr . " > " . implode('-@-', $info) . "\n", FILE_APPEND);
			exit();
		}
		$result = $query->fetchAll();
		return $result;
	}

	function enter_listnews($db){
		$fex = 'data/error.log';
		$dtr = date('Y.m.d - H:i:s');
		$query = $db->prepare("SELECT dt_reg, title, content, id_article FROM articles");
		$query->execute();

		if($query->errorCode() != PDO::ERR_NONE){
			$info = $query->errorInfo();
			// Создаем лог файл ошибок добавить дату
			echo 'ошибка <br>';
			echo "<a href=\"index.php\">Back</a>";
			file_put_contents($fex, $dtr . " > " . implode('@', $info) . "\n", FILE_APPEND);
			exit();
		}
		$result = $query->fetchAll();
		return $result;
	}

	function is_login($db, $log, $pass){
		$fex = 'data/error.log';
		$dtr = date('Y.m.d - H:i:s');
		$sql = "SELECT * FROM users WHERE log_in = :l AND pass_word = :p";
		$params = ['l' => $log, 'p' => $pass];
		$query = $db->prepare($sql);
		$query->execute($params);

		if($query->errorCode() != PDO::ERR_NONE){
			$info = $query->errorInfo();
			// Создаем лог файл ошибок добавить дату
			echo 'ошибка <br>';
			echo "<a href=\"index.php\">Back</a>";
			file_put_contents($fex, $dtr . " > " . implode('@', $info) . "\n", FILE_APPEND);
			exit();
		}
		$result = $query->fetchAll();
		return $result;
	}

	function is_register($db, $name, $pass){
		$fex = 'data/error.log';
		$dtr = date('Y.m.d - H:i:s');
		$sql = "INSERT INTO users (log_in, pass_word) VALUES(:l, :p)";
		$params = ['l' => $name, 'p' => $pass];
		//$sql = "INSERT INTO articles SET title='$name', content='$text', lang='$lg'";
		//Добавляем физически строку в базу данных двумя нижними строками
		$query = $db->prepare($sql);// подготавливаем
		$query->execute($params);//Выполняем запрос
		//$_SESSION['don'] = 'Данные успешно добавлены в базу данных';

		if($query->errorCode() != PDO::ERR_NONE){
			$info = $query->errorInfo();
			// Создаем лог файл ошибок добавить дату
			echo 'ошибка <br>';
			echo "<a href=\"index.php\">Back</a>";
			file_put_contents($fex, $dtr . " > " . implode('@', $info) . "\n", FILE_APPEND);
			exit();
		}
		return $db->lastInsertId();
	}
		
	
?>