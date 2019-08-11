
<!doctype html>
<html lang="ru">
	<head>
	    <meta charset="UTF-8">
	    <meta name="viewport"
	          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	    <title>SQL-unjedtions</title>
	    <link rel="stylesheet" href="css/lesson-5.css">
	</head>
	<body>
	    
	    <ul class="link">
	        <li><a href="SQL-injections.php">add</a></li>
	        <li><a href="../index.php">home</a></li>
	        <!-- <li><a href="SQL-fix.php">FIX</a></li>
	        <li><a href="XSS-attack.php">XSS</a></li> -->
	    </ul>
	    
	
	    <hr>
	    <hr>
	</body>
</html>





<!-- <a href="SQL-fix.php">SQL-fix</a>
<a href="SQL-injections.php">SQL-injections</a> -->


<?php

	foreach ($comments as $key) {
	    $dtc = $key['dt'];
        $cn = $key['name'];
        $ct = $key['text'];
        echo $dtc . " - " . "<strong>" . $cn . "</strong>" . "<br>" . $ct . "<hr>";
    }
?>

