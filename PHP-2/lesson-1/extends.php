
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Наследование</title>
</head>
<body>
    <a href="index.php">домой</a><br><br>
    <hr color="red">
</body>
</html>
<?php
// один класс один файл
// создаем класс для дальнейшего наследования переносим в него все что одинаковое у классов -Toad- и -Mosquito-
    abstract class Animal//нельзя получить экземпляр этого класса, так как он абстрактный это нужно так как этот класс необходим только для наследования
    {
        // protected - так же как и private не доступен из вне, но передается наследнику
        protected $x;
        protected $y;
        protected $power;
        protected $color;
        protected $hp;

        public function __construct()
        {
            $this->setXY();
        }

        public function getPower()
        {
            return $this->power;
        }

        public function getPlace()
        {
            return $this->x . ' ' . $this->y;
        }

        public function showPlace()
        {
            echo $this->x . ' ' . $this->y . '<br>';
        }

// так как все наследники двигаются по разному то делаем этот метод абстрактным
// абстрактный метод это метод который не содержит реализации но обязательно должен быть переопределен в классе потомке, служит подсказкой
        // До этого было так
        // public function move()
        // {
            // $this->x += 1;
            // $this->y += 1;
        // }
        abstract public function move();

        protected  function setXY()
        {
            $this->x = mt_rand(1, 100);
            $this->y = mt_rand(1, 100);
        }
    }

#####################################################
    //объявляем класс и обозначаем имя
    class Toad extends Animal
    {
        private $name;

        public function __construct($n, $c)
        {
            // обращаемся к родительскому конструктору
            parent::__construct();

            $this->hp = 100;
            $this->power = 5;
            $this->name = $n;
            $this->color = $c;
        }
        // создаем метод который будет возвращать имя объекта
        public function getName()
        {
            return $this->name;
        }

        public function move()
        {

            // parent::move();
            // $this->x += 4;
            // $this->y += 4;
        // так как этот метод у родителя является абстрактным то переопределяем его у наследника
            $this->x += 5;
            $this->y += 5;
        }

        public function jump()
        {
            $this->x = $this->x * 10;
        }

        public function strike()
        {

        }
    }
########################################################
    class Mosquito extends Animal
    {
        // свойства класса (то что характеризует объект)
        protected $trunk;

        // методы класса (то что умеет делать объект)
        public function __construct()
        {
            parent::__construct();

            $this->hp = 10;
            $this->power = 1;
            $this->color = 'orange';
            $this->trunk = 2;
        }
        public function move()
        {
            // parent::move(); так как этот метод у родителя является абстрактным то переопределяем его у наследника
            $this->x += 1;
            $this->y += 1;
        }


        public function fly()
        {
            $this->x = $this->x * 10;
        }

        public function bite()
        {
            $this->power = $this->power * $this->trunk;
        }
    }

    class superMosquito extends Mosquito
    {
        public function __construct()
        {
            parent::__construct();

            $this->power *= 3;
            $this->color = 'black';
            $this->trunk += 2;
        }

         public function move()
        {

            parent::move();
            $this->x += 4;
            $this->y += 4;
        }
    }
#######################################################

    $toad1 = new Toad('Jhon', 'Red');//имя в скобках это переменная -$n- функции конструктор
    // с помощью метода возвращающего имя мы можем вывести имя из вне, такой метод называется -геттер-
    echo $toad1->getName() . ': сейчас тут - ' . $toad1->getPlace() . "<br>";
    $toad1->showPlace();


// Если свойства приватны то такие запросы приведут к ошибке
    // echo  $toad1->x = 999999 . "<br>";
    // echo  $toad1->name;
    // echo  $toad1->name = 'Victor';
    $toad2 = new Toad('Pimple', 'Yellow');
    echo $toad2->getName() . ': сейчас тут - ' . $toad2->getPlace() .  "<br>";
    // echo $toad1->getPlace() . '<br>';
    // echo $toad2->getPlace() . '<br>';
    $toad2->showPlace();

    $toad1->move();
    $toad2->move();
    echo '<br>';
    echo $toad1->getName() . ': сейчас тут - ' . $toad1->getPlace() . "<br>";
    echo $toad2->getName() . ': сейчас тут - ' . $toad2->getPlace() .  "<br><br>";

    $m1 = new Mosquito();
    echo 'комар1 - ' . $m1->getPlace() . '<br>';
    echo $m1->move();
    echo 'комар1 перелетел - ' . $m1->getPlace() . '<br><br>';

    $sm1 = new superMosquito();
    echo 'суперкомар - ' . $sm1->getPlace() . '<br>';
    echo $sm1->move();
    echo 'суперкомар перелетел - ' . $sm1->getPlace() . '<br>';
    echo $sm1->getPower() . '- сила супер комара<br>';
    echo $m1->getPower() . '- сила комара <br>';
    echo $toad1->getPower() . '- сила жабы - Jhon<br>';
    echo $toad2->getPower() . '- сила жабы - Pimple<br>';
