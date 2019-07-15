<?php
	session_start();

	unset($_SESSION['don']);

	$db = new PDO('mysql:host=localhost;dbname=php1', 'root', '');
	$db ->exec("SET NAMES UTF8");

	 $query = $db->prepare("SELECT * FROM articles
						   WHERE is_moderate='1'
						   ORDER BY dt_reg DESK");

	 if($query->errorCode() != PDO::ERR_NONE){
			$info = $query->errorInfo();
			echo implode('<br>', $info);
			die();

	 //$query->execute();

	 $comments = $query->fetchAll();

	 $res = $query->fetch();
	 echo '<pre>';
	 print_r($res);
	 echo '</pre>';
?>

<div class="comments">
<? foreach($comments as $one): ?>
	<div class="item">
		<span><?=$one['dt_reg']?></span>
		<strong><?=$one['name']?></strong>
		<div><?=$one['text']?></div>
	</div>
	<hr>
<? endforeach; ?>
</div>

<link rel="stylesheet" type="text/css" href="../css/add.css">
	<title>listNews</title>
	<a href="index.php">back to home</a>