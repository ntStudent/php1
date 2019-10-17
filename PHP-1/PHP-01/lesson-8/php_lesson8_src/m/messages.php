<?php
 
    function messages_all($db){
        $query = $db->prepare("SELECT * FROM comments2 ORDER BY dt DESC");
        $query->execute();
        
        if($query->errorCode() != PDO::ERR_NONE){
            $info = $query->errorInfo();
            echo implode('<br>', $info);
            exit();
        }
        
        $result = $query->fetchAll();
        return $result;
    }
    
    function messages_add($db, $name, $text){
        $sql = "INSERT INTO comments2 (name, text) VALUES ('$name', '$text')";
            
        $query = $db->prepare($sql);
        $query->execute();
        
        if($query->errorCode() != PDO::ERR_NONE){
            $info = $query->errorInfo();
            echo implode('<br>', $info);
            exit();
        }
        
        return $db->lastInsertId();
    }
    
    function messages_validate($name, $text){
        $errors = [];
        
        if($name == ''){
            $errors[] = 'Имя не может быть пустым';
        }
        elseif(strlen($name) < 5){
            $errors[] = 'Имя не короче 5 букв';
        }
            
        if($text == ''){
            $errors[] = 'Текст не может быть пустым';
        }

        return $errors;
    }