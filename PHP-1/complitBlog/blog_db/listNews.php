<?php
	session_start();
	include_once('../../function/functions.php');
	include('model/model_add.php');
	include('model/sistem.php');
	error_reporting(E_ALL ^ E_NOTICE);
	unset($_SESSION['don']);
	$db = connect_db();
	$comments = enter_listnews($db);
	$auth = is_auth_db();
	include('view/view_all.php');
	// if($auth){
	// 	echo " <a href=\" add.php \"> add news </a> ";
	// }
	// else{
	// 	echo "<a href=\"login.php\">login</a> ";
	// 	echo " <a href=\"register.php\">register</a>";
	// }

	$a = template('view/view_listnews.php', ['comments' => $comments]);


	$html = template('view/view_main.php', [
	'title' => 'Статьи',
	'content' => $a
	]);
	echo $html;
