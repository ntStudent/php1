<title>listNews</title>
<!-- <link rel="shortcut icon" href="../favicon.ico"> -->
	
	<a href="index.php"> home </a>
	<!-- <div><h3><a href=\"article.php?id=$od\">$ot</a></h3></div> -->

<?php
	foreach($comments as $one){ //:  "<div><h3><a href=\"article.php?fname=$one\">$one</a></h3></div>"
			$ot = $one['title'];
			$od = $one['id_article'];
		echo "<div><h3><a href=\"article.php?id=$od\">$ot</a></h3></div>";

	// 	//echo $one['title'];
	// 	// echo $one['content'];
	}





	 //endforeach;
?>
<!-- короткая форма записи 
убираем -php- и фигурные скобки ставим вместо них двоеточия делаем разрыв
по коду умещая его в сторку и между кодом пишем верстку html
<?//if(empty($news)):?>
<div>Новостей нет</div>
<?//else:?>
<div>Новости есть</div>
<?//endif;?> 

пример

<div class="comments">
<?//foreach($comments as $one):?>
	<div class="item">
		<strong><?//=$one['title']?></strong>
		<span><?//=$one['id_article']?></span>
	</div>
	<hr>
<?//endforeach;?>
</div>
<a href="add.php">Написать</a>

-->