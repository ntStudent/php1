<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <title>Главная</title>
 </head>
 <body>

 </body>
 </html>

 <?php
include_once 'Mosquito.php';
include_once 'Toad.php';
include_once 'superMosquito.php';

$toad1 = new Toad('Jhon', 'Red');
$toad2 = new Toad('Pimple', 'Yellow');

$m1 = new Mosquito();

$sm1 = new superMosquito();



    $toad1->showToad();
    $toad2->showToad();