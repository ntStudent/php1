<?php
/**
 * Created by PhpStorm.
 * User: uchebavadim
 * Date: 10/04/2019
 * Time: 22:28
 */
?>

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
        FIX-XSS-MODERATE
    </h1>

</div>

<br>
<hr>
<hr>
<ul class="link">
    <li><a href="index.php">home</a></li>
    <li><a href="security.php">security</a></li>
    <li><a href="XSS-attack.php">XSS</a></li>
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

//    htmlspecialchars - преобразует все html-атрибуты в спецсимволы
    $name = htmlspecialchars($name);
    $text = htmlspecialchars($text);

    if ($name != '' && $text != ''){
        $query = $db->prepare("INSERT INTO comments3 SET name='$name', text='$text'");//подготовка занесение данных в таблицу "comments2" в базе данных "mySite"
        $query->execute();//выполнение занесения данных в таблицу

        header("Location: XSS_&_moderate.php");//возвращаемся на нашу страницу методом "GET"
        exit();
    }
}

$query = $db->prepare("SELECT * FROM comments3 WHERE is_moderate='1' ORDER BY dt DESC ");//выбираем все данные в таблице "comments2" с сортировкой по дате "ORDER BY dt DESC" по убыванию новые вверху для вывода данных а из колонки модерирования со значением - "1"
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

