<?php
// черновой вариант прдключаем файл генератор
// include_once 'htmlGenerator.php';

// создаем автолоад функция с двумя подчеркиваниями впереди
function __autoload($name)
{
    include_once "$name.php";
}


// создаем новый объект класса и  вписываем путь для переменной "path"
$hGen_1 = new htmlGenerator('data/article_1.txt');
// $mGen = new math();


// так как команду -echo- убрали из функции зкгрузки текста то вызываем метод по оборочиванию в тег <p> у уже созданного объекта
//так как цепочка получается длинной переделаем строку ниже

// $hGen_1->wrapEachInP()->wrapAllInBox('wrapper')->wrapAllInBox();//Такие цепочки нам позволяет делать то что мы сделали возвращение самих себя в этих методах "return $this"

// выводим на экран текст хранящийся в новом свойстве где каждый абзац обернут в тег -р- после того как создали файл bootstrap.php и перенесли в него данный код, а в index.php оставили только верстку html комментим эту строку, и переносим отображение готового текста через index.php
// echo $hGen_1->beautyTextProperty;

// вызываем статичное свойство
// echo htmlGenerator::$num;

// вызываем константу
// echo htmlGenerator::NAME;


// вот так переделали строку ниже
$hGen_1
    ->wrapEachInP()
    ->addTextToTop(htmlGenerator::getTitle('Мертвые души - Н.В. Гоголя', 4))
    ->addTo(htmlGenerator::getImg('crazy.jpg', 'relax'),'p', 5, 1)
    // ->addTextToTop(htmlGenerator::getImg('crazy.jpg', 'relax'))
    // ->findByTag('p', 5)
    ->wrapAllInBox('wrapper');
    // ->wrapAllInBox();

  // echo math::circleRange(3);
