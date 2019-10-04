<!DOCTYPE html>
<html>
<head>
	<title>TEST CKEDITOR PHP</title>
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head>
<body>
	<a href="index.php">ckeditorHtml</a>
	<a href="testInclude.php">include</a>
	<a href="../testworkckeditor/twcke/blog_db/add.php">include</a>
	<textarea id="editor1"></textarea>
	<script>
		CKEDITOR.replace('editor1');
	</script>

</body>
</html>