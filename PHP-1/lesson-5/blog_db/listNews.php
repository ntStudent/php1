<?php
session_start();
include_once('../../function/functions.php');

	error_reporting(E_ALL ^ E_NOTICE);
	unset($_SESSION['don']);

	$db = new PDO('mysql:host=localhost;dbname=php1', 'root', '');
	$db ->exec("SET NAMES UTF8");
//WHERE is_moderate='0'    WHERE lang='english'   ORDER BY dt_reg DESC
	 $query = $db->prepare("SELECT dt_reg, title, content FROM articles  ");
	 $query->execute();

	 if($query->errorCode() != PDO::ERR_NONE){
	 	$info = $query->errorInfo();
			echo implode('<br>', $info);
			die();
	 }

	 $comments = $query->fetchAll();
	

	 // $res = $query->fetch();
	 // echo '<pre>';
	 // print_r($res);
	 // echo '</pre>';
?>

	<title>listNews</title>
	<link rel="stylesheet" type="text/css" href="../css/add.css">
	<a href="index.php">back to home</a>
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
		echo "<div><h3><a href=\"article.php?fname=$ot\">$ot</a></h3></div>";

		//echo $one['title'];
		// echo $one['content'];
  }



	 //endforeach;
?>