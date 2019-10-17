<form method="post">
    Имя<br>
    <input type="text" name="name" value="<?=$name?>"><br>
    Комментарий<br>
    <textarea name="text"><?=$text?></textarea><br>
    <input type="submit" value="Отправить">
</form>
<? foreach($errors as $error): ?>
    <p class="error"><?=$error?></p>
<? endforeach; ?>