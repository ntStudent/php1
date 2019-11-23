<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Блог</title>
</head>
<body>
    <?php foreach($articles as $article):?>
        <?=$article['name']?>
        <hr align="left" width="300px">
    <?php endforeach?>
</body>
</html>