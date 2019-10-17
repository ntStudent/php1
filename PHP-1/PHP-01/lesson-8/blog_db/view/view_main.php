<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="media1/add.css">
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" href="css/add.css">
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <title><?=$title?></title>
</head>
<body>
    <div id="wrapper">
        <header>
            <div class="header line">
                <div class="wrapper">
                    <div class="logo"></div>
                    <div class="slogan">
                        <div class="title">Рога и копыта</div>
                        <div class="subtitle">Всем по рогам, всем по копытам.</div>
                    </div>
                    <div class="phone">8 800 800 80 80</div>
                </div>
            </div>
            <div class="menu line">
                <div class="wrapper">
                    <nav>
                        <div class="show_menu">Меню</div>
                        <ul>
                            <li><a href="index.php">Главная</a></li>
                            <li><a href="login.php">Войти</a></li>
                            <li><a href="listNews.php">Статьи</a></li>
                            <li><a href="add.php">Добавить статью</a></li>
                            <li><a href="register.php">Регистрация</a></li>
                            <?=$content1?>
                            <?=$content2?>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <section>
            <div class="content line">
                <div class="wrapper">
                    <?=$content?>
                </div>
            </div>
        </section>
        <footer>
            <div class="footer line">
                <div class="wrapper">
                    <span class="copy">&copy; ООО Рога и Копыта, Москва 2014, все права защищены!</span>
                </div>
            </div>
        </footer>
    </div>
    <script src="media1/js/jquery-1.11.0.min.js" type="text/javascript"></script>
    <script src="media1/js/scripts.js" type="text/javascript"></script>
</body>
</html>

