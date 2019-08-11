
    <?php
    include_once('model/messeges.php');
    error_reporting(E_ALL ^ E_NOTICE);
    date_default_timezone_set('Asia/Yekaterinburg');

    $db = new PDO ('mysql:host=localhost;dbname=mySite', 'root', '');//подключаемся к базе данных
    $db->exec("SET NAMES UTF8");//прописываем шрифт для базы данных

    //если отправка произошла из формы
    if(count($_POST) > 0) {
        $name = trim($_POST['name']);
        $text = trim($_POST['text']);

        $name = htmlspecialchars($name);
        $text = htmlspecialchars($text);

        if ($name != '' && $text != ''){
            messeges_add($db, $name, $text);
            header("Location: index.php");
            exit();
        }
    }
    else{
        $name = '';
        $text = '';
    }

    include('view/view_add.php');
    ?>

   
    
