<?php
	function article_add($db, $name, $text, $lg){
		$query = $db->prepare("INSERT INTO articles (title, content, lang) VALUES(:n, :t, :l)");// подготавливаем
		$params = ['n' => $name, 't' => $text, 'l' => $lg];
		$query->execute($params);//Выполняем запрос
	    $_SESSION['don'] = "<div style=\"font:bold 18px Arial; color:#bc0000; text-align:center;\"><p>Данные успешно добавлены</p></div>";

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
		
	
?>