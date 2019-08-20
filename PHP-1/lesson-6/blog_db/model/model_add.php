<?php
	date_default_timezone_set('Asia/Yekaterinburg');
	// error_reporting(E_ALL); так настроено по умолчанию показывает все ошибки
	// error_reporting(E_ALL ^ E_NOTICE); так не показываются нотайсы
	error_reporting(E_ALL ^ E_NOTICE);

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
			echo 'ошибка-101 <br>';
			echo "<a href=\"index.php\">Back</a>";
			file_put_contents($fex, $dtr . " > " . implode('-@-', $info) . "\n", FILE_APPEND);
			exit();
		}
		return $db->lastInsertId();
	}

	function unic_add($db, $name){
		//Проверка на уникальность
		$fex = 'data/error.log';
		$dtr = date('Y.m.d - H:i:s');
		$sql = "SELECT * FROM articles WHERE title = :n";
		$params = ['n' => $name];
		$query = $db->prepare($sql);
		$query->execute($params);

		if($query->errorCode() != PDO::ERR_NONE){
			$info = $query->errorInfo();
			// Создаем лог файл ошибок добавить дату
			echo 'ошибка=202 <br>';
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
			echo 'ошибка-303 <br>';
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
		$sql = "SELECT * FROM articles ORDER BY dt_reg DESC";
		$query = $db->prepare($sql);
		// $query = $db->prepare("SELECT dt_reg, title, content, id_article FROM articles");
		// $query = $db->prepare("SELECT * FROM articles ORDER BY dt_reg DESC");
		$query->execute();

		if($query->errorCode() != PDO::ERR_NONE){
			$info = $query->errorInfo();
			// Создаем лог файл ошибок добавить дату
			echo 'ошибка-404 <br>';
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
			echo 'ошибка-505 <br>';
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
			echo 'ошибка-606 <br>';
			echo "<a href=\"index.php\">Back</a>";
			file_put_contents($fex, $dtr . " > " . implode('@', $info) . "\n", FILE_APPEND);
			exit();
		}
		return $db->lastInsertId();
	}

	function unicNameArticle($db, $name, $id){
		$fex = 'data/error.log';
		$dtr = date('Y.m.d - H:i:s');
		$sql = "SELECT content FROM articles WHERE title = :n AND id_article != :i";
		$params = ['n' => $name, 'i' => $id];
		$query = $db->prepare($sql);
		$query->execute($params);
		//$count = $query->fetchAll();

		if($query->errorCode() != PDO::ERR_NONE){
			$info = $query->errorInfo();
			// Создаем лог файл ошибок добавить дату
			echo 'ошибка1 <br>';
			echo "<a href=\"index.php\">Back</a>";
			file_put_contents($fex, $dtr . " > " . implode('-@-', $info) . "\n", FILE_APPEND);
			exit();
		}
		$result = $query->fetchAll();
		return $result;
	}

	function editArticle($db, $id, $text, $name, $lg){
		$fex = 'data/error.log';
		$dtr = date('Y.m.d - H:i:s');
		$sql = "UPDATE articles SET lang = :l, title = :tl, content=:t WHERE id_article=:i";

		$params = ['i' => $id, 't' => $text, 'tl' => $name, 'l' => $lg];
		$query = $db->prepare($sql);
		$query->execute($params);

		if($query->errorCode() != PDO::ERR_NONE){
			$info = $query->errorInfo();
			// Создаем лог файл ошибок добавить дату
			echo 'ошибка1 <br>';
			echo "<a href=\"index.php\">Back</a>";
			file_put_contents($fex, $dtr . " > " . implode('-@-', $info) . "\n", FILE_APPEND);
			exit();
		}
		return $db->lastInsertId();
	}

	function delArticle($db, $id){
		$fex = 'data/error.log';
		$dtr = date('Y.m.d - H:i:s');
		$sql2 = "DELETE FROM articles WHERE id_article=:i";
		$params2 = ['i' => $id];
		$query = $db->prepare($sql2);
		$query->execute($params2);

		if($query->errorCode() != PDO::ERR_NONE){
			$info = $query->errorInfo();
			// Создаем лог файл ошибок добавить дату
			echo 'ошибка1 <br>';
			echo "<a href=\"index.php\">Back</a>";
			file_put_contents($fex, $dtr . " > " . implode('-@-', $info) . "\n", FILE_APPEND);
			exit();
		}
		return $db->lastInsertId();
	}

		
	
?>