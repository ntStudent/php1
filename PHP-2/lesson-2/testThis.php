<?php
class A
{
    private $a;
    private $b;
    private $c;

    function __construct($n)
    {
        $this->c = $n;
        $this->b = $this->c + 34;
    }

    function getA()
    {
        $this->a = $this->b - 22;
        return $this;
    }

    function getA2()
    {
        $this->a = $this->b - 22;
        return $this->a;
    }
}

$test = new A(7);
echo "<pre>";
print_r($test->getA());
echo "</pre>";

// echo $test->getA2();

echo $test
    ->getA()
    ->getA2()
;
