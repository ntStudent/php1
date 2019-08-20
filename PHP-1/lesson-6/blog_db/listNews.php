<?php
	session_start();
	include_once('../../function/functions.php');
	include('model/model_add.php');

	error_reporting(E_ALL ^ E_NOTICE);
	unset($_SESSION['don']);

	$db = connect_db();
	$comments = enter_listnews($db);
	$auth = is_auth_db();

	// foreach($comments as $one){ //:  "<div><h3><a href=\"article.php?fname=$one\">$one</a></h3></div>"
	// 		$ot = $one['title'];
	// 		$od = $one['id_article'];
		// echo "<div><h3><a href=\"article.php?id=$od\">$ot</a></h3></div>";

		//echo $one['title'];
		// echo $one['content'];
	// }
	include('view/view_all.php');
	
	
	if($auth){
		echo " <a href=\" add.php \"> add news </a> ";
	}
	else{
		echo "<a href=\"login.php\">login</a> ";
		echo " <a href=\"register.php\">register</a>";
	}

	include('view/view_listnews.php');
?>


