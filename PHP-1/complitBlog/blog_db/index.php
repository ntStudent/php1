
<?php
session_start();
include('view/view_all.php');
include('view/view_index.php');
include('model/sistem.php');
error_reporting(E_ALL ^ E_NOTICE);
unset($_SESSION['error']);
unset($_SESSION['don']);
unset($_SESSION['auth_db']);
unset($_SESSION['back']);
setcookie('log',  time() - 1);
setcookie('pass',  time() - 1);
$rf = "<li><a href=\"../../lesson-1/blog/index.php\">lesson-1</a></li>";

$html = template('view/view_main.php', [
    'title' => 'Главная страница',
    'content' => $count,
    'content2' => $rf
]);
echo $html;






