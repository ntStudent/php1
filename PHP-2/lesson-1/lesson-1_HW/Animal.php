<?php
abstract class Animal
    {
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
            return $this->x . ' : ' . $this->y;
        }

        public function showPlace()
        {
            echo $this->x . ' ' . $this->y . '<br>';
        }

        abstract public function move();

        protected  function setXY()
        {
            $this->x = mt_rand(1, 100);
            $this->y = mt_rand(1, 100);
        }
    }
