
<?php
	foreach($comments as $one){
			$ot = $one['title'];
			$od = $one['id_article'];
		echo "<div><h3><a href=\"article.php?id=$od\">$ot</a></h3></div>";
	}
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
<!-- <div class="comments">
	<?//foreach($comments as $one):?>
		<div class="item">
			<strong><?//$ot = $one['title']?></strong>
			<span><?//$od = $one['id_article']?></span>
			<span><?//$path = "article.php?id=$od;"?></span>
		</div>
		<hr>
	<?//endforeach;?>

</div>
<div>
<h3><a href="<?$path?>"><?=$ot?></a></h3>
</div>
<a href="add.php">Написать</a> -->
