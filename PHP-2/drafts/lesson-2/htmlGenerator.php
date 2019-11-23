<?php
class htmlGenerator
{
    // константы являются статичными изачально
    const NAME = 'AAAA';
    public $beautyText;//создаем для хранения разобранного -$arr-
    private $path;
    private $text;
    // так же статическими могут быть свойства
    // public static $property;

    public function __construct($pas)
    {
        $this->path = $pas;

        $this->loadText();
    }

// создаем статический метод что бы обращаться к нему на прямую через класс
    public static function getTitle($text, $level = '1')
    {
        return "<h$level>$text</h$level>";
    }

    public function wrapEachInP()
    {
        // первоначальный вариант затем делаем метод -explodeText- ниже
        //$p = //explode("\n", $this->text);
        // var_dump($p);

        // echo "<pre>";
        // print_r($this->explodeText($this->text));
        //var_dump($this->explodeText($this->text));//присваеваем это все переменной
        $t = '';
        $arr = $this->explodeText($this->beautyText);
        foreach ($arr as $pbt){
            $t .= "<p>$pbt</p>";
        }
        $this->beautyText = $t;
        // echo "<pre>";
        return $this;//возвращаем объект(объект возвращает сам себя)
    }

    public function wrapAllInBox($class = "")
    {
        // добавляем класс в див
        // $class = $class === "" ? "" : "сlass='$class'";// это эквивалент

        if($class === ''){
            $class = '';
        }
        else{
            $class = "class='$class'";
        }

// оборачиваем в див
        $this->beautyText = "<div $class>{$this->beautyText}</div>";
        return $this;//возвращаем объект(объект возвращает сам себя)
    }

// внесем Title в div wrapper1
    public function addTextToTop($text)
    {
        $this->beautyText = $text . $this->beautyText;

        return $this;
    }


// делаем отдельный метод для разделения текста
    private function explodeText($tex)
    {
        // $_text = explode("\n", $this->text); //// было так
        // сделали так
        $t = explode("\n", $tex);


        $res = [];
        foreach ($t as $p) {
        //так отображаются все пустые строки показывая там 1 символ, а если ставить тег "<br>" то показывает 5 символов
            // if($p != ''){
            //     $res[] = $p;
            // }
            // так пустые строки не показывает и каждый абзац с новой строки
            if (mb_strlen($p) > 5) {
                $res[] = $p;
                // $res[] = $p . "<br>";
            }
        }
        return $res;
    }

    private function loadText()
    {
        $this->text = file_get_contents($this->path);
        $this->beautyText = $this->text;

        // echo $this->text;
    }
}