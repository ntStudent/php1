<?php
// черновой вариант прдключаем файл генератор
// include_once 'htmlGenerator.php';

// создаем автолоад функция с двумя подчеркиваниями впереди
// при запуске PHP пытается найти класс -htmlGenerator- что бы создать экземпляр класса, но не находит и тогда запускается функция "__autoload"
// с параметром "$name". И используя этот параметр мы подключаем все классы, которые находятся в одноимённых отдельных файлах.
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
// $hGen_1->GetA();

// строка -32-  вот так переделали строку ниже
$hGen_1
    ->wrapEachInP()
    ->addTextToTop(htmlGenerator::getTitle('Мертвые души - Н.В. Гоголя', 4))// так как метод "getTitle" является статическим "htmlGenerator строчка 123" то мы вызываем его напрямую из класса. так делают что бы лишний раз не вызывать весь объект, а только метод.
    ->addTo(htmlGenerator::getImg('crazy.jpg', 'relax'),'p', 5, 1)
    // ->addTextToTop(htmlGenerator::getImg('crazy.jpg', 'relax'))
    // ->findByTag('p', 5)
    ->wrapAllInBox('wrapper');
    // ->wrapAllInBox();

  // echo math::circleRange(3);

    // если бы в методах не было вызова объекта "return $this" то было бы так
    /*
    $hGen_1->wrapEachInP();
    $hGen_1->addTextToTop(htmlGenerator::getTitle('Мертвые души - Н.В. Гоголя', 4));
    $hGen_1->addTo(htmlGenerator::getImg('crazy.jpg', 'relax'),'p', 5, 1);
    $hGen_1->addTextToTop(htmlGenerator::getImg('crazy.jpg', 'relax'));
    $hGen_1->findByTag('p', 5);
    $hGen_1->wrapAllInBox('wrapper');
    */
