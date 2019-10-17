<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Yekaterinburg');
/**
 * Created by PhpStorm.
 * User: uchebavadim
 * Date: 07/04/2019
 * Time: 23:16
 */
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SQL-unjedtions</title>
    <link rel="stylesheet" href="css/lesson-5.css">
</head>
<body>
<div class="name">
    <h1>
        SQL - инъекции - FIX
    </h1>
    <p>это выполнение произвольного запроса к базе</p>
    <p>сделана защита от xss-атак и модерация</p>
    <p>необходимо экранировать ковычки в возможном запросе</p>
    <p>mysql_escape_string</p>
    <p>mysqli_escape_string</p>
    <p>mysql_real_escape_string</p>
    <p>mysqli_real_escape_string</p>
    <p>в PDO есть функция - quote</p>


</div>

<br>
<hr>
<hr>
<ul class="link">
    <li><a href="index.php">home</a></li>
    <li><a href="security.php">security</a></li>
    <li><a href="SQL-injections.php">SQL</a></li>
</ul>
<hr>
<hr>

<?php

$db = new PDO ('mysql:host=localhost;dbname=mySite', 'root', '');//подключаемся к базе данных
$db->exec("SET NAMES UTF8");//прописываем шрифт для базы данных

//если отправка произошла из формы
if(count($_POST) > 0) {
    $name = trim($_POST['name']);
    $text = trim($_POST['text']);

    $name = htmlspecialchars($name);
    $text = htmlspecialchars($text);

    if ($name != '' && $text != ''){
//        делаем прдготовленный запрос
//        $query = $db->prepare("INSERT INTO comments1 SET name='$name', text='$text'");
//        $query->execute();
        $query = $db->prepare("INSERT INTO comments1 SET name=:name, text=:text");//двоеточее ставит маску как бы прорезь в строке а то что идет после двоеточия будет являться ключом для заполнения этой прорези дырки с помощью массива
//        создаем массив
        $params = ['name' => $name, 'text' => $text];
//        используем созданный массив
        $query->execute($params);

        header("Location: SQL-fix.php");
        exit();
    }
}

$query = $db->prepare("SELECT * FROM comments1 WHERE is_moderate='1' ORDER BY dt DESC ");
$query->execute();
$comments = $query->fetchAll();
?>

<div class="form">
    <form method="post">
        <p>
            <label for="name">Укажите ваше имя:</label><br>
            <input id="name" type="text" name="name" value="<?=@$name;?>" placeholder="Ваше имя" autofocus>
        </p>
        <p>
            <label for="text">Ваше сообщение:</label><br>
            <textarea name="text" id="text" cols="30" rows="10"><?=@$text;?></textarea>
        </p>
        <input type="submit" value="Отправить">
    </form>
</div>
<br>
<hr>
<hr>

<div class="comments">
    <? foreach ($comments as $one) :?>
        <div class="item">
            <span><?=$one['dt']?></span>
            <div class="name_comment">
                <strong>--><?=$one['name']?>:</strong>
            </div>

            <div><?=$one['text']?></div>
        </div>
        <hr>
    <? endforeach; ?>
</div>
</body>
</html>
