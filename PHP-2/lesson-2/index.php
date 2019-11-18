<?php
include_once 'bootstrap.php'
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <!-- <title><?=$hGen->getTitle('Title page')?></title> -->
    <title>PHP-2::Lesson-2</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <!-- выводим Title на экран -->
     <?//=htmlGenerator::getTitle('Title')?>
    <?=$hGen->beautyText;?>
</body>
</html>


