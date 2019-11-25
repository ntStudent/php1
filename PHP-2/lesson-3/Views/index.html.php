<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Блог</title>
</head>
<body>
    <?php foreach($articles as $article):?>
        <a href="index.php?act=one&id=<?=$article['id']?>"><?=$article['name']?></a>
        <hr align="left" width="300px">
    <?php endforeach?>
</body>
</html>