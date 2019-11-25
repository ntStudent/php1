<?php
include_once 'Controllers/ArticleController.php';
include_once 'Models/ArticleModel.php';

echo "<pre>";
    print_r($_GET);
echo "</pre>";
if (isset($_GET['act'])) {
    $act = $_GET['act'] . 'Action';
}
else{
    $act = 'indexAction';
}
// $act =  isset($_GET['act']) ? $_GET['act'] . 'Action' : 'indexAction';
$ctrl = new ArticleController($_GET);
// $ctrl->indexAction();
$ctrl->$act();