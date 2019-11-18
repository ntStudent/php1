<?php
class math
{
    const PI = 3.14;
    // public $rad;


    public static function circleRange($r)
    {
        // $this->rad = $r;
        // что бы не использовать имя класса для вызова статического свойства, так как имя константы может измениться используем слово 'self'
        return self::PI * $r * $r;
    }
}