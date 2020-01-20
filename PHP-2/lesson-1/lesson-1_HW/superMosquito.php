<?php
include_once 'Mosquito.php';
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