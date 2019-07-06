<?php
session_start();

if(!isset($_SESSION['auth'])){
	header('Location: login.php');
	exit();
}
?>
Secrets
<a href="login.php">Выйти</a>