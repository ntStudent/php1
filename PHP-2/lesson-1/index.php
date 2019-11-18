<?php
    //объявляем класс и обозначаем имя
    class Toad
    {
        // свойства класса (то что характеризует объект)
        // private, public, protected - это модификаторы доступа с их помощью можно управлять видимостью свойств и методов класса
        private $x;
        private $y;
        private $name;
        private $power;
        private $color;
        private $hp;
        private $hp1;

        // методы класса (то что умеет делать объект)
        // футкция конструктор в которой происходит первоначальная настройка объекта, вызывается в момент создания экземпляра класса
        public function __construct($n, $c)
        {
            // $this->x = 5;//"$this" - Псевдопеременная, это ссылка (указатель) на вызываемый (текущий) объект, она доступна если метод был вызван в контексте объекта, устанавливаем параметр "х"
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
        // если у метода не указан модификатор доступа то по умолчанию стоит public
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

// если метод что то возвращает то это -get- метод, если метод что то устанавливает то это -set- метод
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
    $toad2 = new Toad('Pimple', 'Yellow');
    $toad3 = new Toad('Лёха', 'Gren');

    // $toad1->name = 'Walner'; что бы таким способом нельзя было перезаписать свойства объекта обозначаем методы и свойства -private-

    // с помощью метода возвращающего имя мы можем вывести имя из вне, такой метод называется -геттер-
    // echo "this" . $toad1->name . "<br>";
    echo $toad1->getName() . ': сейчас тут - ' . $toad1->getPlace() . "<br>";
    $toad1->showPlace();


// Если свойства приватны то такие запросы приведут к ошибке
    // echo  $toad1->x = 999999 . "<br>";
    // echo  $toad1->name;
    // echo  $toad1->name = 'Victor';

    echo $toad2->getName() . ': сейчас тут - ' . $toad2->getPlace() .  "<br>";
    // echo $toad1->getPlace() . '<br>';
    // echo $toad2->getPlace() . '<br>';
    $toad2->showPlace();

    $toad1->move();
    // $toad2->move();
    echo '<br>';
    echo $toad1->getName() . ': сейчас тут - ' . $toad1->getPlace() . "<br>";
    echo $toad2->getName() . ': сейчас тут - ' . $toad2->getPlace() . "<br>";
    echo $toad3->getName() . ': сейчас тут - ' . $toad3->getPlace() . "<br>";
    $toad3->jump();
    echo $toad3->getName() . ': прыгнул сюда - ' . $toad3->getPlace() . "<br>";

