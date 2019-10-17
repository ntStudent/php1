<?php
    //объявляем класс и обозначаем имя
    class Toad
    {
        // свойства класса (то что характеризует объект)
        private $x;
        private $y;
        private $name;
        private $power;
        private $color;
        private $hp;

        // методы класса (то что умеет делать объект)
        // футкция конструктор в которой происходит первоначальная настройка объекта, вызывается в момент создания объекта
        public function __construct($n, $c)
        {
            // $this->x = 5;//"$this" - это указатель на текущий объект, устанавливаем параметр "х"
            // $this->y = 5;
            // можно так
            // $this->x =$this->getXY();
            // $this->y =$this->getXY();

            $this->setXY();
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

        // получаем координаты
        public function getPlace()
        {
            return $this->x . ' ' . $this->y;
        }
        // можно так сразу показываем, а не получаем координаты
        public function showPlace()
        {
            echo $this->x . ' ' . $this->y . '<br>';
        }

        public function move()
        {
            $this->x += 5;
            $this->y += 5;
        }

        public function jump()
        {
            $this->x = $this->x * 10;//устанавливаем прыжок умножая параметр "х" на нужное нам число
        }

        public function strike()
        {

        }

        // function getXY()
        //    {
        // return mt_rand(1, 100);
        // }

        private  function setXY()
        {
            $this->x = mt_rand(1, 100);
            $this->y = mt_rand(1, 100);
        }
    }
########################################################
    class Mosquito
    {
        // свойства класса (то что характеризует объект)
        private $x;
        private $y;
        private $power;
        private $color;
        private $hp;
        private $trunk;

        // методы класса (то что умеет делать объект)
        public function __construct()
        {
            $this->setXY();
            $this->hp = 10;
            $this->power = 1;
            $this->color = 'orange';
        }

        public function getPlace()
        {
            return $this->x . ' ' . $this->y;
        }

        public function showPlace()
        {
            echo $this->x . ' ' . $this->y . '<br>';
        }

        public function move()
        {
            $this->x += 1;
            $this->y += 1;
        }

        public function fly()
        {
            $this->x = $this->x * 10;
        }

        public function bite()
        {

        }

        private  function setXY()
        {
            $this->x = mt_rand(1, 100);
            $this->y = mt_rand(1, 100);
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
    // $toad2->move();
    echo '<br>';
    echo $toad1->getName() . ': сейчас тут - ' . $toad1->getPlace() . "<br>";
    echo $toad2->getName() . ': сейчас тут - ' . $toad2->getPlace() .  "<br>";
