
<?php include_once 'bootstrap.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>php-2 lesson-2</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <span>Выводим имя - </span>
    <?=htmlGenerator::NAME;?><br>
<span>Выводим площадь круга с радиусом - " <?=sqrt((math::circleRange(78))/3.14);?> " - </span>
    <?=math::circleRange(78);?><br>
<span>Выводим число - </span>
    <?=htmlGenerator::$num;?><br>
    <!-- используем статический метод -->
    <?=htmlGenerator::getTitle('Мертвые души! - Н.В. Гоголя', 1)?>
 <div>
     <!-- <?php //echo $hGen_1->getTitle('Мертвые души - Гоголя')?> -->
 </div>


    <?=$hGen_1->beautyTextProperty?>

</body>
</html>