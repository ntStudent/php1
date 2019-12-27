<?php
include_once 'Animal.php';
class Toad extends Animal
    {
        private $name;

        public function __construct($n, $c)
        {
            parent::__construct();
            $this->hp = 100;
            $this->power = 5;
            $this->name = $n;
            $this->color = $c;
        }

        public function getName()
        {
            return $this->name;
        }

        public function move()
        {
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



        public function showToad()
        {
            echo $this->color . ' toad - ' . $this->name . "<br>" . ' power - ' . $this->power . "<br>" . 'hp - ' . $this->hp . "<br>" . 'is now at the point - ' . $this->x . ' : ' . $this->y . "<br><br>";
        }
    }