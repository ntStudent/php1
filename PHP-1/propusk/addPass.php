<?php
session_start();

include_once('../function/functions.php');
include_once('model/function_db.php');
$db = connect_db();
if(!is_auth_db()){
	// устанавливаем элемент 'error' для вывода сообщения если авторизация не пройдена
	$_SESSION['error'] = 'Авторизуйтесь';
	// устанавливаем элемент 'back' для возвращения на эту страницу после авторизации 
	$_SESSION['back'] = 'add.php';
	//если авторизация не пройдена перекидывает на эту страницу
	header('Location: login.php');
	exit();		
}
unset($_SESSION['error']);
if (count($_POST)>0) {
    $name1 = ($_POST['name1']);
    $name2 = ($_POST['name2']);
    $name3 = ($_POST['name3']);
    $doc_name = ($_POST['doc']);
    $ser_name = ($_POST['doc_s']);
    $num_doc = ($_POST['doc_n']);
    $org_name = ($_POST['doc_org']);
    $org = ($_POST['org']);

    $name1 = safe($name1);
    $name2 = safe($name2);
    $name3 = safe($name3);
    $doc_name = safe($doc_name);
    $ser_name =  safe($ser_name);
    $num_doc = safe($num_doc);
    $org_name = safe($org_name);
    $org = safe($org);

    $allDataForm = [$name1, $name2, $name3, $doc_name, $ser_name, $num_doc, $org_name, $org];
    $errors = form_validate($allDataForm);
    if (empty($errors)) {
    	guest_add($db, $name1, $name2, $name3, $doc_name, $ser_name, $num_doc, $org_name, $org);
    	header("Location: allDon.php");
		exit();
    }  
}
else{
	$name1 = '';
    $name2 = '';
    $name3 = '';
    $doc_name = '';
    $ser_name = '';
    $num_doc = '';
    $org_name = '';
    $org = '';
	$errors = [] ;
}	
include('view/v_addPass.php');