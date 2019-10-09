<?php

function guest_add($db,  $name1, $name2, $name3, $doc_name, $ser_name, $num_doc, $org_name, $org){
    $fex = 'data/error.log';
    $dtr = date('Y.m.d - H:i:s');
    $query = $db->prepare("INSERT INTO guest_passes ( surname, name_g, middle_name, document, series_doc, number_doc, issued_doc, responsible) VALUES(:s, :ng, :mn, :d, :sd, :nd, :id, :r)");// подготавливаем
    $params = ['s' => $name1, 'ng' => $name2, 'mn' => $name3, 'd' => $doc_name, 'sd' => $ser_name, 'nd' => $num_doc, 'id' => $org_name, 'r' => $org];
    $query->execute($params);
    
    if($query->errorCode() != PDO::ERR_NONE){
        $info = $query->errorInfo();
        // Создаем лог файл ошибок добавить дату
        echo 'ошибка-303 <br>';
        echo "<a href=\"index.php\">Back</a>";
        file_put_contents($fex, $dtr . " > " . implode('-@-', $info) . "\n", FILE_APPEND);
        exit();
    }
    return $db->lastInsertId();
}

function enter_guest_id($db){
    $fex = 'data/error.log';
    $dtr = date('Y.m.d - H:i:s');
    $sql = "SELECT id_guest FROM guest_passes";
    // $params = ['i' => $id];
    $query = $db->prepare($sql);
    $query->execute();

    if($query->errorCode() != PDO::ERR_NONE){
        $info = $query->errorInfo();
        // Создаем лог файл ошибок добавить дату
        echo 'ошибка-303 <br>';
        echo "<a href=\"index.php\">Back</a>";
        file_put_contents($fex, $dtr . " > " . implode('-@-', $info) . "\n", FILE_APPEND);
        exit();
    }
    $result = $query->fetchAll();
    return $result;
}


function form_validate($allDataForm){
    $errors = [];
    // //проверка длинны строки
    if ((mb_strlen($allDataForm[0]) < 3)){
         $errors['msg0'] = "Заполните строку1";
    }
    if ((mb_strlen($allDataForm[1]) < 3)){
         $errors['msg1'] = "Заполните строку2";
    }
    if ((mb_strlen($allDataForm[2]) < 3)){
         $errors['msg2'] = "Заполните строку3";
    }
    if ((mb_strlen($allDataForm[3]) < 3)){
         $errors['msg3'] = "Заполните строку4";
    }
    if ((mb_strlen($allDataForm[4]) < 3)){
         $errors['msg4'] = "Заполните строку5";
    }
    if ((mb_strlen($allDataForm[5]) < 3)){
         $errors['msg5'] = "Заполните строку6";
    }
    if ((mb_strlen($allDataForm[6]) < 3)){
         $errors['msg6'] = "Заполните строку7";
    }
    if ((mb_strlen($allDataForm[7]) < 3)){
         $errors['msg7'] = "Заполните строку8";
    }
    return $errors;
}

function enter_listnews($db){
    $fex = 'data/error.log';
    $dtr = date('Y.m.d - H:i:s');
    $sql = "SELECT * FROM guest_passes ORDER BY dt_visit DESC";
    $query = $db->prepare($sql);
    $query->execute();

    if($query->errorCode() != PDO::ERR_NONE){
        $info = $query->errorInfo();
        // Создаем лог файл ошибок добавить дату
        echo 'ошибка-404 <br>';
        echo "<a href=\"index.php\">Back</a>";
        file_put_contents($fex, $dtr . " > " . implode('@', $info) . "\n", FILE_APPEND);
        exit();
    }
    $result = $query->fetchAll();
    return $result;
}

function is_login($db, $log, $pass){
    $fex = 'data/error.log';
    $dtr = date('Y.m.d - H:i:s');
    $sql = "SELECT * FROM users WHERE log_in = :l AND pass_word = :p";
    $params = ['l' => $log, 'p' => $pass];
    $query = $db->prepare($sql);
    $query->execute($params);

    if($query->errorCode() != PDO::ERR_NONE){
        $info = $query->errorInfo();
        // Создаем лог файл ошибок добавить дату
        echo 'ошибка-505 <br>';
        echo "<a href=\"index.php\">Back</a>";
        file_put_contents($fex, $dtr . " > " . implode('@', $info) . "\n", FILE_APPEND);
        exit();
    }
    $result = $query->fetchAll();
    return $result;
}

function enter_guest($db, $id){
    $fex = 'data/error.log';
    $dtr = date('Y.m.d - H:i:s');
    $sql = "SELECT * FROM guest_passes WHERE id_guest=:i";
    $params = ['i' => $id];
    $query = $db->prepare($sql);
    $query->execute($params);
    
    if($query->errorCode() != PDO::ERR_NONE){
        $info = $query->errorInfo();
        // Создаем лог файл ошибок добавить дату
        echo 'ошибка-303 <br>';
        echo "<a href=\"index.php\">Back</a>";
        file_put_contents($fex, $dtr . " > " . implode('-@-', $info) . "\n", FILE_APPEND);
        exit();
    }
    $result = $query->fetchAll();
    return $result;
}

function validate_guest($id, $comments){
    $errors = [];
    if($id != ''){
        echo $id;
        if (!$comments) {
            $errors['msg12'] = "Нет такой статьи-202";
        }
    }
    else{
    $errors['msg12'] = "Нет параметра GET-303";
    }   
    return $errors;
}