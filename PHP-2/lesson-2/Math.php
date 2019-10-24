<?php
class Math
{
    const PI = 3.14;

    public static function circleRange($r)
    {
        return self::PI * $r * $r;// self-обращение к стачическому методу или константе внутри класса
    }
}