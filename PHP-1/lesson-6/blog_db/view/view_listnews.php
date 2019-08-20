<title>listNews</title>
<!-- <link rel="shortcut icon" href="../favicon.ico"> -->
	
	<a href="index.php"> home </a>
	<!-- <div><h3><a href=\"article.php?id=$od\">$ot</a></h3></div> -->

<?php
	foreach($comments as $one){ //:  "<div><h3><a href=\"article.php?fname=$one\">$one</a></h3></div>"
			$ot = $one['title'];
			$od = $one['id_article'];
		echo "<div><h3><a href=\"article.php?id=$od\">$ot</a></h3></div>";

	// 	//echo $one['title'];
	// 	// echo $one['content'];
	}



	 //endforeach;
?>