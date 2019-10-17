<?php
	//Вывели в отдельный файл функцию получения всех сообщений но без доступа к бкзе данных 
	//Доступ в базу в индексе
	function messeges_all($db){
		$fex = 'data/error.log';
		$dtr = date('Y.m.d - H:i:s');

		$query = $db->prepare("SELECT * FROM comments1 WHERE is_moderate='1' ORDER BY dt DESC ");
		$query->execute();

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

	function messeges_add($db, $name, $text){
		$fex = 'data/error.log';
		$dtr = date('Y.m.d - H:i:s');
		$query = $db->prepare("INSERT INTO comments1 SET name='$name', text='$text'");
        $query->execute();

        if($query->errorCode() != PDO::ERR_NONE){
			$info = $query->errorInfo();
			// Создаем лог файл ошибок добавить дату
			echo 'ошибка <br>';
			echo "<a href=\"index.php\">Back</a>";
			file_put_contents($fex, $dtr . " > " . implode('-@-', $info) . "\n", FILE_APPEND);
			exit();
		}

		//return true;
		return $db->lastInsertId();
	}