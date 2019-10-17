<!-- <head>
    <meta charset="UTF-8">
    <title>edit news</title>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" href="css/add.css">
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head> -->
<form method="post">
  <p>
    <label for="newsName">Название файла:</label><br>
    <input type="text" name="name" id="newsName" value="<?=@$name;?>"><br>
    <span class="error"><?=@$errors[msg1]?></span>
  </p>
  <p>
    <label class="text" for="newsContent">Содержимое файла:</label><br>
    <textarea id="newsContent" name="text"><?=@$text;?></textarea><br>
    <script>
      CKEDITOR.replace('newsContent');
    </script>
    <span class="error"><?=@$errors[msg]?></span>
  </p>
  <p>
    Выберите язык <br>
    <select name="lang">
      <option value="" selected="selected">-</option>
      <option>english</option>
      <option>russian</option>
    </select>
  </p>
  <p>
    <input type="submit" value="Сохранить"><br>
  </p>
</form>
