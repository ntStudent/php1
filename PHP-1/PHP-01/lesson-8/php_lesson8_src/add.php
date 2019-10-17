<?php

    include_once('m/system.php');
    include_once('m/messages.php');
 
    $db = new PDO('mysql:host=localhost;dbname=ek', 'root', '');
    $db->exec("SET NAMES UTF8");

    if(count($_POST) > 0){
        $name = trim($_POST['name']);
        $text = trim($_POST['text']);

        $errors = messages_validate($name, $text);
        
        if(empty($errors)){   
            messages_add($db, $name, $text);
            header("Location: index.php");
            exit();           
        }
    }
    else{
        $name = '';
        $text = '';
        $errors = [];
    }

    $content = template('v/v_add.php', [
        'name' => $name,
        'text' => $text,
        'errors' => $errors,
    ]);
    
    $html = template('v/v_main.php', [
        'title' => 'Добавлние комментария',
        'content' => $content
    ]);
    
    echo $html;
