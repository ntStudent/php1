<?php
include_once 'Animal.php';
class Mosquito extends Animal
    {
        protected $trunk;

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