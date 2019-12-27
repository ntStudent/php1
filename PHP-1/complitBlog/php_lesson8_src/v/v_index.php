

<div class="comments">
						<? foreach($comments as $one): ?>
						    <div class="item">
						        <span><?=$one['dt']?></span>
						        <strong><?=$one['name']?></strong>
						        <div><?=$one['text']?></div>
						    </div>
						    <hr>
						<? endforeach; ?>
					</div>
					<a href="add.php">Написать</a>


