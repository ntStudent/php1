 <?php
class htmlGenerator
{
        // создаем 1-e свойство в которое положим путь к файлу с текстом
    private $pathProperty;
    // добавляем свойство куда присвоим текст
    private $textProperty;
    // 3-е свойство, в него будем скидывать готовый в выводу текст
    public $beautyTextProperty;

    // свойства так же могут быть статическими
    public static $num = '83473874';

    // константы всегда статичны
    const NAME = 'bill';


    public function __construct($pathVar)//вводим переменную в которую будет присваиваться путь к файлу, который(путь) будет указываться при создании нового экземпляра класса
    {
        $this->pathProperty = $pathVar;//присваеваем свойству значение переменной

        // так как конструктор запускается сразу при создании экземпляра класса то вызываем через него метод для загрузки файлов
        $this->loadText();

        // $this->num = 'hi';
    }

    // создаем метод с помощью которого укажем путь к файлу с текстом для загрузки файлов
    private function loadText()
    {
        // так как свойству "pathProperty" уже присвоена переменная хранящая путь к файлу, то и указываем его как параметр функции "file_get_content"
        $this->textProperty = file_get_contents($this->pathProperty);

        // выводим текст, это черновой вариант для демонстрации комментим его после проверки того что текст из заданного файла выводится
        // echo $this->textProperty;

        // приравниваем бьютитекст к тексту
        $this->beautyTextProperty = $this->textProperty;
    }


    // продолжаем работу и создаем метод для нахождения абзацев и обертки их в тег <p>
    public function wrapEachInP()
    {
        //любой переменной присваеваем разрыв строки по знаку переноса на новую строку, текста из свойства - "textProperty", должен получится массив из абзацев
        //$p = explode("\n", $this->textProperty);//закаментим эту строку так как перенесли ее в метод explodeText

        // проверим получился ли массив
        // echo "<pre>";
        // var_dump($p);
        // echo "</pre>";

        // так более наглядно
        // echo "<pre>";
        // print_r($p);
        // echo "</pre>";

        // выводим на экран массив который получился с помощью новой функции "explodeText"
        // в итоге это все комментим, передаем массив и циклом проходим по массиву и помещаем каждый элемент в тег <p>
        // echo "<pre>";
        // var_dump($this->explodeText($this->textProperty));
        // echo "</pre>";
        $arr = $this->explodeText($this->beautyTextProperty);
        $intermediateText = '';
                foreach($arr as $p){
            $intermediateText .= "<p>$p</p>";
        }
        $this->beautyTextProperty = $intermediateText;
        // Возвращает сам себя
        return $this;
    }


    // так как разрывать текст(строку) на абзацы нам придеться постоянно, то создадим для этого отдельный метод
    private function explodeText($textVar)
    {
         // создаем отдельную переменную для разрыва например текст с нижним подчеркиванием
        $_text = explode("\n", $textVar);

        // проходим циклом по всему тексту
        $res = [];
        foreach ($_text as $p){
            if (mb_strlen($p)>5){
                $res[] = $p;
            }
        }
        return $res;
    }


    // создадим еще один метод по оборачиванию, например всего текста в -div-
    // далее усложним действия метода, добавив работу с переменной
    // public function wrapAllInBox()
    public function wrapAllInBox($class = '')
    {
        $class = $class === '' ? '' : "class='$class'";

        // это эквиволент верхней строчки
        // if ($class === '') {
        //     $class = '';
        // }else{
        //     $class = "class='$class'";
        // }
        // фигурные скобки нужны для того что бы PHP понял что это свойство, а не отдельная переменная и текст
        $this->beautyTextProperty = "<div $class>{$this->beautyTextProperty}</div>";
        // Возвращает сам себя
        return $this;
    }
    // метод выводящий заголовок
    // так как ради одного заголовка использовать стандартный метод очень ресурсозатратно, потому что приходится вызывать объект то есть создавать новый экземпляр класса соответственно будет отробатывать все что есть в конструкторе, есть способ вызвать только этот метод, сделать этот метод статическим.
    // public function getTitle($text, $level = '3')
    // {
    //     return "<h$level>$text</h$level>";
    // }
    // статический метод привязан к классу, а не к объекту
    public static function getTitle($text, $level = '2')
    {
        return "<h$level>$text</h$level>";
    }

    // создадим метод который будет дабавлять текст в основной блок beautyText
    public function addTextToTop($topText)
    {
        $this->beautyTextProperty = $topText . $this->beautyTextProperty;

        return $this;
    }

    // домашняя работа
    public static function getImg($path, $title = '')
    {
        return "<img src=\"$path\" alt=\"$title\" title=\"$title\">";
    }

    // ДЗ № 2
    public function findByTag($tag, $pos = null)
    {
        preg_match_all("#<$tag*>(.*?)</$tag>#", $this->beautyTextProperty, $match);

        if (isset($pos) && $pos > 0) {
            $match[0] = $match[0][$pos - 1];
            $match[1] = $match[1][$pos - 1];
        }

        // echo "<pre>";
        // var_dump($match);
        // die;

        return $match;
    }

    //  ДЗ № 3
    public function addTo($html, $tagName, $number = null, $where = 0)
    {
        $tags = $this->findByTag($tagName, $number);

        if(is_array($tags[$where])){
            foreach($tags[$where] as $line) {
                $this->beautyTextProperty = str_replace($line, $html . $line, $this->beautyTextProperty);
            }
        }
        else{
             $this->beautyTextProperty = str_replace($tags[$where], $html . $tags[$where], $this->beautyTextProperty);
        }
        // var_dump($tags);
        // $this->beautyTextProperty = str_replace($tags[$where], $html . $tags[$where], $this->beautyTextProperty);
        return $this;
    }
}