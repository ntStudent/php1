<?php 
// проверки для заполнения полей
	function safe($val) {
		$val = trim($val);
		$val = stripslashes($val);
		$val = strip_tags($val);
		$val = htmlspecialchars($val, ENT_QUOTES);
		return $val;
	}

	///получаем расширение файла - Работает следующим образом: strrchr() возвращает участок строки, следующий за указанным параметром (точкой в нашем случае), после чего substr() отрезает первый символ — точку.
	function getExtension($fileName) {
    return substr(strrchr($fileName, '.'), 1);
	}
// склоняет слово секунды
	function endings ($m){
        $ost = $m % 10;

        if ($m >= 5 && $m <= 20){
            $res = ' - секунд';
        }
        elseif ($ost == 1){
            $res = ' - секунда';
        }
        elseif (($ost >= 2 && $ost <= 4)){
            $res = ' - секунды';
        }
        else {
            $res = ' - секунд';
        }

        return ($res);
    }

 ?>
