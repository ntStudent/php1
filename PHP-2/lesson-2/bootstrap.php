<?php
// include_once 'htmlGenerator.php';

function __autoload($name)
{
    // echo $name;
    include_once "$name.php";
}

echo Math::circleRange(5);

$hGen = new htmlGenerator('data/article_1.txt');

// обращение к статичному свойству
// htmlGenerator::$property;

// обращение к константе
// htmlGenerator::NAME;


// так как объект вернул сам себя  то можем создать такую цепочку
// $hGen->wrapEachInP()->addTextToTop('Title')->wrapAllInBox("wrapper1");

// вот так оформляем по другому
$hGen
    ->wrapEachInP()
    ->addTextToTop(htmlGenerator::getTitle('Title page'))
    ->wrapAllInBox('wrapper1');

