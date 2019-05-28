<?php
session_start();

if(isset($_POST['name'])){
	$_SESSION['name'] = $_POST['name'];
}
else{
	$_SESSION['name'] = '';
}
?>
<form method="post">
	Представтесь<br>
	<input type="text" name="name"><br><br>
	<input type="submit" value="Войти">
</form>
<?php
if ($_SESSION['name'] != '') {
	echo "Здравствуйте, {$_SESSION['name']}!";
}
?>
<a href="order.php">go to chat</a>
<a href="../index.php">go to home</a>