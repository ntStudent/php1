<?php
 
    function template($path, $vars = []){
        ob_start();
        extract($vars);
        include($path);
        $res = ob_get_clean();
        return $res;
    }
    
    /*
       $vars['comments'] = [...]; 
    
       $comments = [...]; 
    
    
        $vars['name'] = '123'; 
        $vars['text'] = '321';
        $vars['errors'] = [];
    
        $name = '123'; 
        $text = '321';
        $errors = [];
        
    */