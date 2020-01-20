<?php
session_start();
include_once('../../function/functions.php');

	error_reporting(E_ALL ^ E_NOTICE);
	unset($_SESSION['don']);

	$db = connect_db();
	$fex = 'data/error.log';
	$dtr = date('Y.m.d - H:i:s');
//WHERE is_moderate='0'    WHERE lang='english'   ORDER BY dt_reg DESC
	 // $query = $db->prepare("SELECT dt_reg, title, content, id_article FROM articles");
	// Поменяем запрос в бд так что бы последняя статья была с верху
	 $query = $db->prepare("SELECT * FROM articles ORDER BY dt_reg DESC");
	 $query->execute();

	 if($query->errorCode() != PDO::ERR_NONE){
		$info = $query->errorInfo();
		// Создаем лог файл ошибок добавить дату
		echo 'ошибка <br>';
		echo "<a href=\"index.php\">Back</a>";
		file_put_contents($fex, $dtr . " > " . implode('@', $info) . "\n", FILE_APPEND);
		exit();
	}

	 $comments = $query->fetchAll();


	 // $res = $query->fetch();
	 // echo '<pre>';
	 // print_r($res);
	 // echo '</pre>';
?>

	<title>listNews</title>
	<link rel="stylesheet" type="text/css" href="../css/add.css">
	<a href="index.php"> home </a>
	<?php
	if(is_auth_db()){
		echo " <a href=\" add.php \"> add news </a> ";
	}
	else{
		echo "<a href=\"login.php\">login</a> ";
		echo " <a href=\"register.php\">register</a>";
	}

	?>
	<br>

<!-- <div class="comments">
	<? //foreach($comments as $one) : ?>
		<div class="item">
			<span><?//=$one['dt_reg']?></span>
			<strong><?//=$one['title']?></strong>
			<div><?//=$one['content']?></div>
		</div>
		<hr>
	<?// endforeach; ?>
</div> -->

<?php
  foreach($comments as $one){ //:  "<div><h3><a href=\"article.php?fname=$one\">$one</a></h3></div>"
  		$ot = $one['title'];
  		$od = $one['id_article'];
		echo "<div><h3><a href=\"article.php?id=$od\">$ot</a></h3></div>";

		//echo $one['title'];
		// echo $one['content'];
  }



	 //endforeach;
?>