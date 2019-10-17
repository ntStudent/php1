<?php
function template($path, $vars = []){
    ob_start();
    extract($vars);
    include ($path);
    $res = ob_get_clean();
    return $res;
}

function template1($path, $comments, $msg132, $vEdit){
    ob_start();
    include ($path);
    $res = ob_get_clean();
    return $res;
}

function template12($path, $var = []){
    ob_start();
    extract($var);
    include ($path);
    $res = ob_get_clean();
    return $res;
}
